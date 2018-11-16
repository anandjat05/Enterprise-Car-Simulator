<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

    /**
     * Description of Page
     * Created by Anand Jat
     * Id: 700 67 3474
     * Index Page for this controller.   
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user');
        $this->load->library('session');
        $this->load->model('common');
        $this->load->library('cart');
        $this->load->library('grocery_CRUD'); 
        $this->load->helper('string');
        $this->load->library('encryption');
        $this->load->helper(array('form', 'url'));
    }

    /**
     * @info Index page will load
     * @param type $page
     */
    public function index($page = "home") {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('templates/header', $data);
        $this->load->view('templates/header_slider', $data);
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * This function allows you to Login. 
     */
    public function login($page = 'login') {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['title'] = ucfirst($page); // Capitalize the first letter


        if ($this->input->post('loginSubmit')) {

            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'password', 'required');
            if ($this->form_validation->run() == TRUE) {
                $con['returnType'] = 'single';
                $con['conditions'] = array(
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post("password"),
                    'status' => '1'
                );


                $checkLogin = $this->user->getRows($con);

                if ($checkLogin) {

                    if ($checkLogin['NoOfLogin'] == 0) {

                        $promoCode = 'LOGINPROMO';
                        $config = Array(
                            'protocol' => 'smtp',
                            'smtp_host' => 'ssl://smtp.googlemail.com',
                            'smtp_port' => 465,
                            'smtp_user' => 'info.onthewheel@gmail.com',
                            'smtp_pass' => 'anandjat'
                        );
                        $this->load->library('email', $config);
                        $this->email->set_newline("\r\n");
                        $this->email->from('info.onthewheel@gmail.com', 'ON-the Wheel');
                        $this->email->to($this->input->post('email'));
                        $this->email->subject('ON-the Wheel: Promo Code');
                        $this->email->message('Welcome to ON-the wheel car services. You are entitled for the promotion code '. '' . $promoCode . '. Please Use this code for avail discount');
                        if ($this->email->send()) {
                            $this->session->set_userdata('promoCode', 'Please check your email to avail promo code');
                        }
                        $insertCarPoints = array(
                            'UserId' => $checkLogin['id'],
                            'PointEarned' => '20'
                        );
                        $carsPoint = $this->common->InsertCommon('tbl_usercarpoints', $insertCarPoints);

                        $key = array(
                            'email' => $this->input->post('email'),
                            'id' => $checkLogin['id'],
                        );
                        $value = array(
                            'NoOfLogin' => 1
                        );
                        /**
                         * Update 'NoOfLogin' after 1st login
                         */
                        $updateLoginStatus = $this->common->UpdateByMultipleKeyValues('users', $key, $value);
                        
                    }

                    $this->session->set_userdata('isUserLoggedIn', TRUE);
                    $this->session->set_userdata('userId', $checkLogin['id']);
                    $this->session->set_userdata('uName', $checkLogin['name']);
                    $this->session->set_userdata('success_msg', 'Success! Thank you for login');

                    // @info If the user logged in: Set cart count

                    $this->UpdateCartCount();

                    //@description After successful login redirect page to Home page

                    redirect('page', 'refresh');
                } else {
                    $this->session->set_userdata('error_msg', 'Incorrect email or password, please try again.');
                }
            }
        }

        if ($this->session->userdata('success_msg')) {
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }

        if ($this->session->userdata('error_msg')) {
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }
        $data['jsFile'] = $page;
        $this->load->view('templates/header', $data);
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer', $data);
        //
    }

    /**
     * @info Update Cart count
     * @desctiption If the user logged in, check users cart count and update it.
     */
    public function UpdateCartCount() {
        if ($this->session->userdata('isUserLoggedIn') == TRUE) {
            $keyvalue = array(
                'UserId' => $this->session->userdata('userId'),
                'CartStatus' => 1
            );
            $cart['items'] = $this->common->SelectByMultipleKeyValues('tbl_cart', $keyvalue);
            $this->session->set_userdata('cartcount', count($cart['items']));
        }
    }

    /**
     * 
     * @param type $page
     * @description: This function helps to reset users password
     */
    public function resetpassword($page = 'resetpassword') {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['title'] = ucfirst('Reset Password'); // Capitalize the first letter 

        if ($this->input->post('resetSubmit')) {
            $this->form_validation->set_rules('txtResetEmail', 'Email', 'required|valid_email');

            if ($this->form_validation->run() == TRUE) {
                $data['result'] = $this->common->SelectById('users', 'email', $this->input->post('txtResetEmail'));
                if (count($data['result'])) {

                    $newPassword = random_string('alnum', 6);
                    $config = Array(
                        'protocol' => 'smtp',
                        'smtp_host' => 'ssl://smtp.googlemail.com',
                        'smtp_port' => 465,
                        'smtp_user' => 'info.onthewheel@gmail.com',
                        'smtp_pass' => 'anandjat'
                    );
                    $this->load->library('email', $config);
                    $this->email->set_newline("\r\n");
                    $this->email->from('info.onthewheel@gmail.com', 'ON-the Wheel');
                    $this->email->to($this->input->post('txtResetEmail'));
                    $this->email->subject('ON-the Wheel: Reset password');
                    $this->email->message('Thank you for being a part of ON-the Wheel Services. Your new Password will be: ' . $newPassword);

                    if (!$this->email->send()) {
                        $data['errorMessage'] = "Failed to update changes, Incorrect password " . show_error($this->email->print_debugger());
                    } else {
                        $key = array(
                            'email' => $this->input->post('txtResetEmail'),
                            'id' => $data['result'][0]->id,
                        );
                        $value = array(
                            'password' => $newPassword
                        );
                        $resetResult = $this->common->UpdateByMultipleKeyValues('users', $key, $value);
                        if ($resetResult) {
                            $data['successMessage'] = 'Please check your mail';
                        }
                    }
                } else {
                    $data['errorMessage'] = 'The email id you are provided is not registred with ON-the Wheel.';
                }
            } else {
                echo 'Failed to validate';
            }
        } else {
            //echo 'Form not submitting';
        }

        $this->load->view('templates/header', $data);
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * @info User Logout
     */
    public function logout() {
        $session_items = array('isUserLoggedIn', 'userId', 'uName');
        $this->session->unset_userdata($session_items);
        
        redirect('page', 'refresh');
    }

    /**
     * @info New user registration
     * 
     */
    public function register($page = "register") {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            // if page not found
            show_404();
        }

        if ($this->session->userdata('success_msg')) {
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }

        if ($this->session->userdata('error_msg')) {
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }
        $data = [];
        $userData = [];
        if ($this->input->post('regisSumbit')) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('conf_password', 'conf_password', 'required|matches[password]');

            $userData = array(
                'name' => strip_tags($this->input->post('name')),
                'email' => strip_tags($this->input->post('email')),
                'password' => $this->input->post('password'),
                'gender' => $this->input->post('gender'),
                'phone' => strip_tags($this->input->post('phone')),
                'licenseNumber' => strip_tags($this->input->post('licenseNumber'))
            );

            if ($this->form_validation->run() == TRUE) {
                $insert = $this->user->insert($userData);
                if ($insert) {
                    $this->session->set_userdata('success_msg', 'Success! Your Registration completed Successfully, Please login with your credentials');

                    $userAddr = array(
                        'userId' => $insert,
                        'streetAddr' => strip_tags($this->input->post('streetAddress')),
                        'addrLine2' => strip_tags($this->input->post('address2')),
                        'state' => strip_tags($this->input->post('state')),
                        'country' => strip_tags($this->input->post('country')),
                        'zipCode' => strip_tags($this->input->post('zipcode'))
                    );

                    $insertAddr = $this->common->InsertCommon('useraddress', $userAddr);




                   
                    //It will redirect to login Page
                    redirect('page/login', 'refresh');
                    
                } else {
                    $this->session->set_userdata('error_msg', 'Something went wrong!, please try again..');
                    //$data['error_msg'] = "Something went wrong!, please try again..";
                }
            }
        }
        $data['user'] = $userData;
        $data['jsFile'] = $page;
        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('templates/header', $data);
        $this->load->view('templates/breadcrumbs', $data);
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/end_breadcrumbs', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * 
     * @param type $page
     */
    public function carpackagetype($page = "carpackagetype") {
        $data['title'] = ucfirst($page);
        $data['result'] = $this->common->SelectAll('tbl_packagecategory');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/breadcrumbs', $data);
        //$this->load->view('templates/left_services', $data);
        $this->load->view('pages/' . $page, $data);
        //$this->load->view('templates/right_sideBar', $data);
        $this->load->view('templates/end_breadcrumbs', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * 
     * @param type $pkg
     * @all car packages
     */
    public function packages($pkg = 0) {
        $page = "packages";
        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['result'] = $this->common->SelectById('packages', 'CategoryId', $pkg);
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/breadcrumbs', $data);
        $this->load->view('templates/left_services', $data);
        $this->load->view('pages/' . $page, $data);
        //$this->load->view('templates/right_sideBar', $data);
        $this->load->view('templates/end_breadcrumbs', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * 
     * @param type $page
     * @info Save packages
     */
    public function custompackages($pkgId = 0) {
        $page = "custompackages";
        $selectedVehicle = [];
        $data['title'] = ucfirst($page); // Capitalize the first letter  
        $data['carPackage'] = $pkgId;
        $data['jsFile'] = $page;
        $data['result'] = $this->common->SelectCustomPackages();

        if ($this->session->userdata('successMessage')) {
            $data['successMessage'] = $this->session->userdata('successMessage');
            $this->session->unset_userdata('successMessage');
        }
        if ($this->session->userdata('errorMessage')) {
            $data['errorMessage'] = $this->session->userdata('errorMessage');
            $this->session->unset_userdata('errorMessage');
        }
        if ($this->session->userdata('pkgCustomMsg')) {
            $data['pkgCustomMsg'] = $this->session->userdata('pkgCustomMsg');
            $this->session->unset_userdata('pkgCustomMsg');
        }
        if ($this->session->userdata('pkgConfirmation')) {
            $data['pkgConfirmation'] = $this->session->userdata('pkgConfirmation');
            $this->session->unset_userdata('pkgConfirmation');
        }

        if ($this->input->post('btnCustomPackage')) {
            
            if (!empty($this->input->post('check_Car'))) {
                foreach ($this->input->post('check_Car') as $selectCar) {
                    array_push($selectedVehicle, $selectCar);
                }
            }
            if (!empty($this->input->post('check_Truck'))) {
                foreach ($this->input->post('check_Truck') as $selectTruck) {
                    array_push($selectedVehicle, $selectTruck);
                }
            }
            if (!empty($this->input->post('check_SUV'))) {
                foreach ($this->input->post('check_SUV') as $selectSuv) {
                    array_push($selectedVehicle, $selectSuv);
                }
            }
            $data['selectedVehicle'] = $selectedVehicle;
        }

        if (!$this->session->userdata('isUserLoggedIn')) {
            $this->session->set_userdata('success_msg', 'Please login to avail the services');
            redirect('page/login', 'refresh');
        } else {


            if ($this->input->post('btnSubmitForAppmnt')) {

                $this->form_validation->set_rules('fullName', 'Full name', 'required');
                $this->form_validation->set_rules('location', 'Location', 'required');
                $this->form_validation->set_rules('txtEmailId', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('txtContactNum', 'Contact number', 'required');
                $this->form_validation->set_rules('txtAppoDate', 'Date', 'required');
                $this->form_validation->set_rules('txtAppoTime', 'Time', 'required');

                $appointmentData = array(
                    'FullName' => strip_tags($this->input->post('fullName')),
                    'Location' => strip_tags($this->input->post('location')),
                    'EmailId' => strip_tags($this->input->post('txtEmailId')),
                    'ContactNum' => strip_tags($this->input->post('txtContactNum')),
                    'AppoDate' => strip_tags($this->input->post('txtAppoDate')),
                    'AppoTime' => strip_tags($this->input->post('txtAppoTime')),
                    'userId' => $this->session->userdata('userId')
                );
                
                if ($this->form_validation->run() == TRUE) {
                    $insert = $this->common->InsertCommon('tbl_bookappointment', $appointmentData);
                    if ($insert) {
                        foreach ($this->input->post('mSlctPackages') as $pkgValue) {
                            $refTable = array(
                                'ApointmentID' => $insert,
                                'pkgId' => $pkgValue
                            );
                            $refInsert = $this->common->InsertCommon('tbl_appointreferpackage', $refTable);
                            
                            $resPackages = $this->common->SelectById('packages', 'pkgId', $pkgValue);

                            if ($refInsert) {
                                foreach ($resPackages as $findCustomRow) {
                                    if ($findCustomRow->CategoryId == '7') {
                                        $this->session->set_userdata('pkgCustomMsg', 'You are entitled for free Car Services.');
                                    }
                                }
                                $this->session->set_userdata('pkgConfirmation', 'Your Test Drive booking has confirmed');
                                redirect('page/custompackages', 'refresh');
                            } else {
                                //$this->session->userdata('errorMessage') = "Failed to Insert";
                            }
                        }
                    }
                } else {
                    echo "Failed to Validate";
                }
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/breadcrumbs', $data);
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * 
     * @param type $page
     */
    public function appointment($pkgId, $page = "appointment") {
        $data['title'] = ucfirst($page); // Capitalize the first letter

        if (!$this->session->userdata('isUserLoggedIn')) {
            $this->session->set_userdata('success_msg', 'Please login to avail the services');
            redirect('page/login', 'refresh');
        } else {
            if ($this->input->post('appoSumbit')) {
                $this->form_validation->set_rules('fName', 'Name', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
                $this->form_validation->set_rules('password', 'password', 'required');
                $this->form_validation->set_rules('confirmemail', 'confirmemail', 'required|matches[password]');

                $userData = array(
                    //'userId' => strip_tags($this->input->post('fName')),
                    'fName' => strip_tags($this->input->post('fName')),
                    'lName' => strip_tags($this->input->post('email')),
                    'email' => md5($this->input->post('password')),
                    'phone' => $this->input->post('gender'),
                    'appoDate' => strip_tags($this->input->post('phone')),
                    'appoTime' => strip_tags($this->input->post('phone'))
                );

                if ($this->form_validation->run() == TRUE) {
                    $insert = $this->user->insert($userData);
                    if ($insert) {
                        //$this->session->set_userdata('success_msg', 'Success! Your Registration completed Successfully, Please login with your credentials');

                        $userAddr = array(
                            'userId' => $insert,
                            'streetAddr' => strip_tags($this->input->post('streetAddress')),
                            'addrLine2' => strip_tags($this->input->post('address2')),
                            'state' => strip_tags($this->input->post('state')),
                            'country' => strip_tags($this->input->post('country')),
                            'zipCode' => strip_tags($this->input->post('zipcode'))
                        );

                        $insertAddr = $this->common->InsertCommon('useraddress', $userAddr);



                       

                        //echo $insertPup;
                        redirect('page/login', 'refresh');
                        //$data['success_msg'] = "Your registration was successfull. Please login to your account";
                    } else {
                        $this->session->set_userdata('error_msg', 'Something went wrong!, please try again..');
                        //$data['error_msg'] = "Something went wrong!, please try again..";
                    }
                }
            }
        }

        $data['result'] = $this->common->SelectById('packages', 'pkgId', $pkgId);
        $data['addon'] = $this->common->SelectById('packages', 'pkgType', 'Add-On');

        //print_r($data);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/breadcrumbs', $data);
        //$this->load->view('templates/left_sideBar', $data);
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/right_sideBar', $data);
        $this->load->view('templates/end_breadcrumbs', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * 
     * @param 
     * @desciption: This option allows you to view cart of logged in users. 
     */
    public function viewcart($storetype = "all") {
        $this->CheckIfLoggedIn();
        $page = "cart";
        $data['title'] = ucfirst($page); // Capitalize the first letter        
        $keyvalue = array(
            'UserId' => $this->session->userdata('userId'),
            'CartStatus' => 1
        );
        $data['myCart'] = $this->common->SelectByMultipleKeyValues('tbl_cart', $keyvalue);
        $data['jsFile'] = $page;





        //print_r($data['myCart']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/breadcrumbs', $data);
        //$this->load->view('templates/left_sideBar', $data);
        $this->load->view('pages/' . $page, $data);
        //$this->load->view('templates/right_sideBar', $data);
        $this->load->view('templates/end_breadcrumbs', $data);
        $this->load->view('templates/footer', $data);
    }

    public function CheckIfLoggedIn() {
        if ($this->session->userdata('isUserLoggedIn') !== TRUE) {
            redirect('page/login', 'refresh');
        }
    }

    /**
     * 
     * @param type $cartId
     * @info Remove Cart Item
     * @description: Remove cart item by cart ID and user ID
     */
    public function removecart($cartId = 0) {
        $page = "cart";
        $data['title'] = ucfirst($page); // Capitalize the first letter  
        $keyvalues = array(
            'CartId' => $cartId,
            'UserId' => $this->session->userdata('userId')
        );
        $delFromInit = $this->common->DeleteById('tbl_initcheckout', $keyvalues);
        $delResult = $this->common->DeleteById('tbl_cart', $keyvalues);
        if ($delResult) {
            $this->UpdateCartCount();
            redirect('page/viewcart', 'refresh');
        } else {
            echo 'someting went wrong';
        }
    }

    /**
     * 
     * @param type $page
     * @desciption: This function allows you to view all products. 
     */
    public function products($prodType = 0) {
        $page = "products";
        $data['title'] = ucfirst($page); // Capitalize the first letter  
       
        //$data['product'] = $this->common->SelectAll('tbl_products');
        
        if ($prodType == 0) {
            $data['product'] = $this->common->SelectAll('tbl_products');
            $data['redeemPoints'] = $this->common->SelectFeaturedPoints();
        } else {
            $data['product'] = $this->common->SelectById('tbl_products', 'Category_Id', $prodType);
            $data['redeemPoints'] = $this->common->SelectFeaturedPoints();
        }
        //print_r($data['redeemPoints']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/breadcrumbs', $data);
        //$this->load->view('templates/left_sideBar', $data);
        $this->load->view('pages/' . $page, $data);
        //$this->load->view('templates/right_sideBar', $data);
        $this->load->view('templates/end_breadcrumbs', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * 
     */
    public function addtocart() {
        if ($this->session->userdata('isUserLoggedIn') == TRUE) {

            $prodId = $_POST["product_id"];
            $carPoint = '20';
            $data = array(
                "id" => $_POST["product_id"],
                "name" => $_POST["product_name"],
                "price" => $_POST["product_price"]
            );
            $this->cart->insert($data);
            $data['prdoDetails'] = $this->common->SelectById('tbl_products', 'product_Id', $prodId);
            $data['carPoints'] = $this->common->SelectById('tbl_usercarpoints', 'UserId', $this->session->userdata('userId'));
            $cartdata = array(
                'product_Id' => $data['prdoDetails'][0]->product_Id,
                'UserId' => $this->session->userdata('userId'),
                'prodName' => $data['prdoDetails'][0]->Product_Name,
                'prodPrice' => $data['prdoDetails'][0]->Product_Price,
                
                'prodImage' => $data['prdoDetails'][0]->file_url
            );

            $keyvalue = array(
                'userId' => $this->session->userdata('userId'),
                'product_Id' => $prodId,
                'prodPrice' => $price
            );
            $checkCartProd = $this->common->SelectByMultipleKeyValues('tbl_cart', $keyvalue);

            // Select carpoint by user if exists
            $keyCarpoints = array(
                'userId' => $this->session->userdata('userId')
            );
            $carpointResult = $this->common->SelectByMultipleKeyValues('tbl_usercarpoints', $keyCarpoints);
            $carPointData = array(
                'UserId' => $this->session->userdata('userId'),
                'PointEarned' => $carPoint
            );
            if (count($carpointResult) > 0) {

                
                $currentPoint = 0;
                foreach ($carpointResult as $rowPoint):
                    $currentPoint = $rowPoint->PointEarned;
                    $effective = $checkCartProd->prodPrice;
                endforeach;
                $currentPoint = $currentPoint + ($carPoint *$prodQty);

                $updateKey = array(
                    'UserId' => $this->session->userdata('userId'),
                    'CarPointId' => $carpointResult[0]->CarPointId
                );
                $updateValue = array(
                    'PointEarned' => $currentPoint
                );
                $updateResult = $this->common->UpdateByMultipleKeyValues('tbl_usercarpoints', $updateKey, $updateValue);
            }else {
                
                if ($carPoint > 0) {
                    $insertCarPoint = $this->common->InsertCommon('tbl_usercarpoints', $carPointData);
                }
            }

            if (count($checkCartProd) > 0) {
                $fetchedQty = 0;
                foreach ($checkCartProd as $rowSelected):
                    $fetchedQty = $rowSelected->CartQty;
                endforeach;

                // Get the Exact Qty
                $updatedQty = $fetchedQty + $prodQty;

                $key = array(
                    'userId' => $this->session->userdata('userId'),
                    'product_Id' => $prodId
                );

                $values = array(
                    'CartQty' => $updatedQty
                );


                $updateResult = $this->common->UpdateByMultipleKeyValues('tbl_cart', $key, $values);
                $this->UpdateCartCount();
                if ($updateResult):
                    echo "alert('Product added to cart')";
                endif;
            } else {
                $insert = $this->common->InsertCommon('tbl_cart', $cartdata);
                $this->UpdateCartCount();
            }
        } else {
            echo "Please Login First ON-the Wheel!";
        }

    }

    /**
     * @description this function allows user to update cart quantity
     */
    public function updateCartQty() {
        $key = array(
            'CartId' => $_POST["cartid"]
        );

        $values = array(
            'CartQty' => $_POST["quantity"]
        );

        $updateResult = $this->common->UpdateByMultipleKeyValues('tbl_cart', $key, $values);
    }

    /**
     * @Description: This function will redeem
     */
    // public function redeemCode() {
        
    // }

    /**
     * 
     * @param type $page
     * @description this function allows user to checkout cart products
     */
    public function checkout($page = "checkout") {
        $this->CheckIfLoggedIn();
        $data['title'] = ucfirst($page); // Capitalize the first letter
        $userId = $this->session->userdata('userId');
        $data['jsFile'] = $page;
        $data['addressinfo'] = $this->common->SelectById('useraddress', 'userId', $userId);
        //$data['myCart'] = $this->common->SelectById('tbl_cart', 'UserId', $userId);
        $keyvalue = array(
            'UserId' => $this->session->userdata('userId'),
            'CartStatus' => 1
        );
        $data['myCart'] = $this->common->SelectByMultipleKeyValues('tbl_cart', $keyvalue);
        $data['initCart'] = $this->common->SelectById('tbl_initcheckout', 'UserId', $userId);
        $data['myCarPoints'] = $this->common->SelectById('tbl_usercarpoints', 'UserId', $userId); // Fetch my CarPoints

        if ($this->input->post('btnSubmittoCheckout')) {
            //echo 'I am posting successfully';
            $this->form_validation->set_rules('radioShippingaddress', 'Address', 'required');
            $this->form_validation->set_rules('txtHdnTotal', 'Total', 'required');
            $this->form_validation->set_rules('paymentMethod', 'PaymentMethod', 'required');
            $this->form_validation->set_rules('txtNameOnCard', 'NameonCard', 'required');
            $this->form_validation->set_rules('txtCardNum', 'cardNumber', 'required');
            $this->form_validation->set_rules('slctExpMonth', 'Month', 'required');
            $this->form_validation->set_rules('txtExpYear', 'Year', 'required');
            $this->form_validation->set_rules('txtCardCCV', 'Year', 'required');
            $this->form_validation->set_rules('pickupDate', 'pickupDate', 'required');
            $this->form_validation->set_rules('returnDate', 'returnDate', 'required');

        }

        if ($this->form_validation->run() == TRUE) {
            //echo 'I am validating successfully';
            $orderData = array(
                'UserId' => $this->session->userdata('userId'),
                'pickupDate' => $this->input->post('pickupDate'),
                'returnDate' => $this->input->post('returnDate'),
                'AddressId' => $this->input->post('radioShippingaddress'),
                'TotalAmnt' => number_format((float) $this->input->post('txtHdnTotal'), 2, '.', '')

            );
             // Insert into Order table
            $orderResult = $this->common->InsertCommon('tbl_orders', $orderData);
            //create car points in database
            // $totalAmount = $_POST['txtHdnTotal'];
            // $earnedCarPoint = ($totalAmount*50)/100;
            // $insert = array(
            //     'UserId' => $this->session->userdata('userId'),
            //     'PointEarned' => $this->input->post('earnedCarPoint')
               
            // );

            // $CarPoints = $this->common->InsertCommon('tbl_usercarpoints', $insert);
            

            //$orderResult = 1;
            if ($orderResult > 0) {
                foreach ($data['myCart'] as $cartData) {
                    $orderDetails = array(
                        'OrderId' => $orderResult,
                        'ProdId' => $cartData->product_Id,
                        'oPrice' => $cartData->prodPrice,
                        'oQuantity' => $cartData->CartQty
                    );
                    //Insert into Order details table
                    $orderDetailResult = $this->common->InsertCommon('tbl_orderdetails', $orderDetails);
                    if ($orderDetailResult) {

                        $keyvalues = array(
                            'UserId' => $this->session->userdata('userId')
                        );
                        $this->common->DeleteById('tbl_initcheckout', $keyvalues);
                        $this->common->DeleteById('tbl_cart', $keyvalues);
                        $this->UpdateCartCount();
                        $this->session->set_userdata('order_notification', "Your Car order placed successfully, your Order ID is: #" . $orderResult);
                        redirect('page/ordersuccess', 'refresh');
                    }
                }
            }
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/breadcrumbs', $data);
        //$this->load->view('templates/left_sideBar', $data);
        $this->load->view('pages/' . $page, $data);
        //$this->load->view('templates/right_sideBar', $data);
        $this->load->view('templates/end_breadcrumbs', $data);
        $this->load->view('templates/footer', $data);
    }
   

    /**
     * @info: Apply Redeem Code - Login code which is sent by ON-the wheel 
     */
    public function applyredeemcode() {
        $this->CheckIfLoggedIn();
        $initId = $_POST["initId"];
        $inittotal = $_POST["initTotal"];

        //tbl_redeemedusers

        $data['redeemedUsers'] = $this->common->SelectById('tbl_redeemedusers', 'UserId', $this->session->userdata('userId'));
        if (count($data['redeemedUsers']) > 0) {
            echo 'Code already used';
        } else {
            $discPercentage = $this->common->SelectById('tbl_promocodes', 'Code', 'LOGINPROMO');
            $discount = $inittotal * ($discPercentage[0]->CodeDiscount / 100);
            $inittotal = $inittotal - $discount;
            $key = array(
                'InitId' => $initId
            );
            $values = array(
                'CartTotal' => $inittotal,
                'initDiscount' => number_format((float) $discount, 2, '.', '')
            );
            $updateResult = $this->common->UpdateByMultipleKeyValues('tbl_initcheckout', $key, $values);
            if ($updateResult) {
                echo 'Coupon code applied successfully';
            }
        }
    }

    public function applycarpoints() {
        $this->CheckIfLoggedIn();

        $initId = $_POST['initId'];
        $totalpoint = $_POST["totalpoint"];
        $availpoint = $_POST["availpoint"];
        $initTotal = $_POST['totalamnt'];

        $userId = $this->session->userdata('userId');
        $deductedpoint = $totalpoint - $availpoint;
        $discount = $availpoint*2 / 10;
        $grandTotal = $initTotal - $discount;
        //$earnedCarPoint = ($grandTotal*50)/100;




        $keypoint = array(
            'UserId' => $userId
        );
        $valuespoint = array(
            'PointEarned' => $deductedpoint
        );

        $pointResult = $this->common->UpdateByMultipleKeyValues('tbl_usercarpoints', $keypoint, $valuespoint);
        
        if ($pointResult) {
            $key = array(
                'UserId' => $userId
            );
            $values = array(
                'CartTotal' => $grandTotal,
                'initDiscount' => $discount
            );
            $updateResult = $this->common->UpdateByMultipleKeyValues('tbl_initcheckout', $key, $values);
        }
        echo $updateResult;
    }

    public function ordersuccess($title = 'Order Confirmation') {

        $this->CheckIfLoggedIn();
        $data['title'] = ucfirst($title); // Capitalize the first letter
        $page = 'ordersuccess';

        if ($this->session->userdata('order_notification')) {
            $data['order_notification'] = $this->session->userdata('order_notification');
            $this->session->unset_userdata('order_notification');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/breadcrumbs', $data);
        //$this->load->view('templates/left_sideBar', $data);
        $this->load->view('pages/' . $page, $data);
        //$this->load->view('templates/right_sideBar', $data);
        $this->load->view('templates/end_breadcrumbs', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * @info This method Check and insert values in tbl_InitiateCheckout table if value not exist
     */
    public function InitiateCheckout() {

        $CartId = $_POST["cartid"];
        $total = $_POST["total"];
        $prodId = $_POST['prodId'];

        $slctProdDetails = $this->common->SelectById('tbl_products', 'product_Id', $prodId);
        $selectCartId = $this->common->SelectById('tbl_initcheckout', 'UserId', $this->session->userdata('userId'));
        if (count($selectCartId) <= 0) {
            $initData = array(
                'CartId' => $CartId,
                'UserId' => $this->session->userdata('userId'),
                'CartTotal' => $total
            );
            $initResult = $this->common->InsertInTo('tbl_initcheckout', $initData);
            print_r($initResult);
        } else {
            $key = array(
                'UserId' => $this->session->userdata('userId')
            );

            $values = array(
                'CartTotal' => $total
            );

            $updateResult = $this->common->UpdateByMultipleKeyValues('tbl_initcheckout', $key, $values);
        }
    }
   
    /**
     * @info User settings page
     * @description this method allows logged in user to 
     */
    public function usersettings() {
        $data['title'] = 'User Settings';
        $page = 'usersettings';

        //$data['userDetails'] = $this->common->SelectUserProfile();
        $data['userDetails'] = $this->common->SelectById('users', 'id', $this->session->userdata('userId'));

        //print_r($data['userDetails']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/breadcrumbs', $data);
        $this->load->view('templates/left_usersettings', $data);
        $this->load->view('pages/' . $page, $data);
        //$this->load->view('templates/right_sideBar', $data);
        $this->load->view('templates/end_breadcrumbs', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * @info View all order history
     */
    public function myorderhistory() {

        $data['title'] = 'Order History';
        $page = 'myorderhistory';

        $data['myOrders'] = $this->common->SelectById('tbl_orders', 'UserId', $this->session->userdata('userId'));

        //print_r($data['myOrders']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/breadcrumbs', $data);
        $this->load->view('templates/left_usersettings', $data);
        $this->load->view('pages/' . $page, $data);
        //$this->load->view('templates/right_sideBar', $data);
        $this->load->view('templates/end_breadcrumbs', $data);
        $this->load->view('templates/footer', $data);
    }

    public function myorderdetails($orderId = 0) {
        $data['title'] = 'Order History';
        $page = 'myorderdetails';

        $data['myOrdersById'] = $this->common->SelectById('tbl_orders', 'OrderId', $orderId);
        $data['orderAddress'] = $this->common->SelectById('useraddress', 'addrId', $data['myOrdersById'][0]->AddressId);
    }

    public function mycarpoints($page = 'mycarpoints') {
        $data['title'] = 'My Carpoints';

        $data['mycarpoints'] = $this->common->SelectById('tbl_usercarpoints', 'UserId', $this->session->userdata('userId'));

        //print_r($data['myOrders']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/breadcrumbs', $data);
        $this->load->view('templates/left_usersettings', $data);
        $this->load->view('pages/' . $page, $data);
        //$this->load->view('templates/right_sideBar', $data);
        $this->load->view('templates/end_breadcrumbs', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * 
     * @param type $page
     * @info User Profile settings - Address
     */
    public function addaddress($type = 'view', $addrId = 0) {
        $page = 'addaddress';
        $data['title'] = 'User Profile';
        $data['jsFile'] = $page;

        // Edit Address
        if ($type == 'edit' && $addrId !== 0) {
            $data['EditMyAddress'] = $this->common->SelectById('useraddress', 'addrId', $addrId);
            if ($this->input->post('btnEditMyAddress')) {
                $this->form_validation->set_rules('txtEditstreetAddress', 'Street Address', 'required');
                $this->form_validation->set_rules('txtEditstate', 'state', 'required');
                $this->form_validation->set_rules('txtEditcountry', 'country', 'required');
                $this->form_validation->set_rules('txtEditzipcode', 'zipcode', 'required');
            }
            if ($this->form_validation->run() == TRUE) {

                $addrEditData = array(
                    'addrType' => strip_tags($this->input->post('txtEditAddrType')),
                    'streetAddr' => strip_tags($this->input->post('txtEditstreetAddress')),
                    'addrLine2' => strip_tags($this->input->post('txtEditaddrLine2')),
                    'state' => strip_tags($this->input->post('txtEditstate')),
                    'country' => strip_tags($this->input->post('txtEditcountry')),
                    'zipCode' => strip_tags($this->input->post('txtEditzipcode'))
                );

                $editkey = array(
                    'addrId' => $addrId,
                    'addrType' => $this->input->post('txtEditAddrType')
                );
                $addrEditResult = $this->common->UpdateByMultipleKeyValues('useraddress', $editkey, $addrEditData);
                if ($addrEditResult) {
                    redirect('page/addaddress/view', 'refresh');
                }
            }
        }
        // Add new Address
        if ($type == 'add' && $addrId == 0) {
            //echo 'I am add';
            $data['AddMyAddress'] = 'AddMyAddress';
            if ($this->input->post('btnAddMyAddress')) {

                //echo 'Add is posting';

                $this->form_validation->set_rules('slctAddressType', 'Choose Type', 'required');
                $this->form_validation->set_rules('streetAddress', 'Street Address', 'required');
                $this->form_validation->set_rules('state', 'State', 'required');
                $this->form_validation->set_rules('country', 'Country', 'required');
                $this->form_validation->set_rules('zipcode', 'zipcode', 'required');
            }

            if ($this->form_validation->run() == TRUE) {

                //echo 'Add is validating';

                $addrData = array(
                    'userId' => $this->session->userdata('userId'),
                    'addrType' => strip_tags($this->input->post('slctAddressType')),
                    'streetAddr' => strip_tags($this->input->post('streetAddress')),
                    'addrLine2' => strip_tags($this->input->post('address2')),
                    'state' => strip_tags($this->input->post('state')),
                    'country' => strip_tags($this->input->post('country')),
                    'zipCode' => strip_tags($this->input->post('zipcode'))
                );


                $addResult = $this->common->InsertCommon('useraddress', $addrData);

                redirect('page/addaddress/view', 'refresh');
            }
        }
        if ($type == 'view' && $addrId == 0) {
            $data['ViewMyAddress'] = $this->common->SelectById('useraddress', 'userId', $this->session->userdata('userId'));
        }
        //print_r($data['userDetails']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/breadcrumbs', $data);
        $this->load->view('templates/left_usersettings', $data);
        $this->load->view('pages/' . $page, $data);
        //$this->load->view('templates/right_sideBar', $data);
        $this->load->view('templates/end_breadcrumbs', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * @info Allows user to change password
     */
    public function userchagepassword() {
        $data['title'] = 'Change password';
        $page = 'userchagepassword';
        $data['jsFile'] = $page;

        if ($this->input->post('resetPassSubmit')) {
            $this->form_validation->set_rules('txtCrntPass', 'password', 'required');
            $this->form_validation->set_rules('txtNewPass', 'password', 'required');
            $this->form_validation->set_rules('txtConfirmPass', 'Confirm password', 'required');
            if ($this->form_validation->run() == TRUE) {
                $keyvalues = array(
                    'id' => $this->session->userdata('userId'),
                    'password' => $this->input->post("txtCrntPass")
                );

                $resultSlcted = $this->common->SelectByMultipleKeyValues('users', $keyvalues);
                if (count($resultSlcted) > 0) {
                    $key = array(
                        'id' => $this->session->userdata('userId')
                    );

                    $values = array(
                        'password' => $this->input->post("txtNewPass")
                    );

                    $updateResult = $this->common->UpdateByMultipleKeyValues('users', $key, $values);

                    if ($updateResult) {
                        $data['successMessage'] = "Successfully updated your password";
                    } else {
                        $data['errorMessage'] = "Failed to update changes, Please try again..";
                    }
                } else {
                    $data['errorMessage'] = "Failed to update changes, Incorrect password";
                }
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/breadcrumbs', $data);
        $this->load->view('templates/left_usersettings', $data);
        $this->load->view('pages/' . $page, $data);
        //$this->load->view('templates/right_sideBar', $data);
        $this->load->view('templates/end_breadcrumbs', $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * 
     * @param type $type
     * @info Allows user to read created 
     */
    public function whyFinanceWithUs($type = 0) {
        $data['title'] = 'why Finance With Us';
        $page = 'whyFinanceWithUs';

        if ($type == 0) {
            $data['selectedEvent'] = $this->common->SelectAll('tbl_whyfinancewithus');
        } else {
            $data['selectedEvent'] = $this->common->SelectById('tbl_whyfinancewithus', 'TypeId', $type);
        }
        if (count($data['selectedEvent']) <= 0) {
            $data['nullRow'] = 1;
        }

       
        $this->load->view('templates/header', $data);
        $this->load->view('templates/breadcrumbs', $data);
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/end_breadcrumbs', $data);
        $this->load->view('templates/footer', $data);
    }

    public function specialoffers() {
        $data['title'] = 'Special Offers';
        $page = 'specialoffers';

        $data['jsFile'] = $page;                                                                                                                                
        $this->load->view('templates/header', $data);
        $this->load->view('templates/breadcrumbs', $data);
        //$this->load->view('templates/left_sideBar', $data);
        $this->load->view('pages/' . $page, $data);
        //$this->load->view('templates/right_sideBar', $data);
        $this->load->view('templates/end_breadcrumbs', $data);
        $this->load->view('templates/footer', $data);

    }


    public function autoloancalculator() {
        $data['title'] = 'Auto Loan Calculator';
        $page = 'autoloancalculator';

        $data['jsFile'] = $page;                                                                                                                                
        $this->load->view('templates/header', $data);
        $this->load->view('templates/breadcrumbs', $data);
        //$this->load->view('templates/left_sideBar', $data);
        $this->load->view('pages/' . $page, $data);
        //$this->load->view('templates/right_sideBar', $data);
        $this->load->view('templates/end_breadcrumbs', $data);
        $this->load->view('templates/footer', $data);

    }


    public function getprequalified() {
        $data['title'] = 'Get Pre-qualified';
        $page = 'getprequalified';

        //get prequalified php code

        $this->load->view('templates/header', $data);
        $this->load->view('templates/breadcrumbs', $data);
        //$this->load->view('templates/left_sideBar', $data);
        $this->load->view('pages/' . $page, $data);
        //$this->load->view('templates/right_sideBar', $data);
        $this->load->view('templates/end_breadcrumbs', $data);
        $this->load->view('templates/footer', $data);
    }

    public function ourlocation($page = 'ourlocation') {
        $data['title'] = 'Our Prime Locations';

       
        //location page comes here

        $this->load->view('templates/header', $data);
        $this->load->view('templates/breadcrumbs', $data);
        //$this->load->view('templates/left_sideBar', $data);
        $this->load->view('pages/' . $page, $data);
        //$this->load->view('templates/right_sideBar', $data);
        $this->load->view('templates/end_breadcrumbs', $data);
        $this->load->view('templates/footer', $data);
    }

    public function carTrading($page = 'carTrading'){
        $data['title'] = 'Car Price Calculator';
        $data['year'] = $this->user->fetch_year();
        $data['make'] = $this->user->fetch_make();

       //$data['jsFile'] = $page;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/breadcrumbs', $data);
        //$this->load->view('templates/left_sideBar', $data);
        $this->load->view('pages/' . $page, $data);
        //$this->load->view('templates/right_sideBar', $data);
        $this->load->view('templates/end_breadcrumbs', $data);
        $this->load->view('templates/footer', $data);
    }


      public function fetch_model(){  
        if($this->input->post('make_Id')){
            echo $this->user->fetch_model($this->input->post('make_Id'));
        }
    }
    //trading / and booking appontment form
    public function tradecar($page = "tradecar") {
     if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
                // if page not found
                show_404();
            }


            if ($this->session->userdata('success_msg')) {
                $data['success_msg'] = $this->session->userdata('success_msg');
                $this->session->unset_userdata('success_msg');
            }

            if ($this->session->userdata('error_msg')) {
                $data['error_msg'] = $this->session->userdata('error_msg');
                $this->session->unset_userdata('error_msg');
            }
            $data = [];
            $userData = [];
            if ($this->input->post('appointmentConfirm')) {
                $this->form_validation->set_rules('name', 'Name', 'required');
               $this->form_validation->set_rules('license', 'License', 'required');

                $userData = array(
                    'name' => strip_tags($this->input->post('name')),
                    'license' => strip_tags($this->input->post('license')),
                     'cell'       => strip_tags($this->input->post('cell')),
                    'mileDriven' => strip_tags($this->input->post('mileDriven')),
                    'carcondition' => strip_tags($this->input->post('carcondition')),
                    'year'       => strip_tags($this->input->post('year')),
                    'make'       => strip_tags($this->input->post('make')),
                    'model'      => strip_tags($this->input->post('model'))
                    
                );

                if ($this->form_validation->run() == TRUE) {
                    $insert = $this->user->bookAppointment($userData);
                    if ($insert) {
                      
                        //It will redirect to login Page
                       redirect('page/carTrading', 'refresh');
                        
                    } else {
                        $this->session->set_userdata('error_msg', 'Something went wrong!, please try again..');
                        //$data['error_msg'] = "Something went wrong!, please try again..";
                    }
                }
            }
            $data['user'] = $userData;
            $data['jsFile'] = $page;
            $data['title'] = ucfirst($page); // Capitalize the first letter

            $this->load->view('templates/header', $data);
            $this->load->view('templates/breadcrumbs', $data);
            //$this->load->view('templates/left_services', $data);
            $this->load->view('pages/' . $page, $data);
            //$this->load->view('templates/right_sideBar', $data);
            $this->load->view('templates/end_breadcrumbs', $data);
            $this->load->view('templates/footer', $data);
    }




}

