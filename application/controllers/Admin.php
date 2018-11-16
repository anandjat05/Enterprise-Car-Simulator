<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin
 *
 * @author Mamatha Kamath
 * @role Manage admin part
 */
class Admin extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('adminlogin');
        $this->load->model('common');
        $this->load->library('grocery_CRUD');
        $this->session->unset_userdata('admerror_msg');
        $this->session->unset_userdata('admsuccess_msg');
        //$this->checkIfAdminLoggedIn();
    }

    /**
     * Checks if admin logged in or not
     */
    function checkIfAdminLoggedIn() {
        if ($this->session->userdata('isAdminLoggedIn') !== TRUE) {
            redirect('admin/login', 'refresh');
        }
    }

    public function index($page = "home") {
        $crud = new grocery_CRUD();
        if (!file_exists(APPPATH . 'views/admin/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        if ($this->session->userdata('isAdminLoggedIn') == TRUE) {
            $data['title'] = ucfirst($page); // Capitalize the first letter  
            $crud->set_theme('datatables');
            $crud->set_table('adminlogin');
            $crud->columns('AdmName', 'AdmcrDate', 'AdmStatus');
            $data = $crud->render();

            $this->load->view('templates/admintemp/header', $data);
            $this->load->view('templates/admintemp/navigation', $data);
            $this->load->view('admin/' . $page, $data);
            $this->load->view('templates/admintemp/footer', $data);
        } else {
            // do something when doesn't exist
            redirect('admin/login');
            //echo md5("password");
        }
    }

    public function dashboard() {
        if ($this->session->userdata('isAdminLoggedIn') == TRUE) {
            redirect('admin', 'refresh');
        } else {
            redirect('admin/login');
        }
    }

    /**
     * 
     * @param type $page
     * @info Allows admin to login with credentials
     */
    public function login($page = 'login') {
        $data['page'] = $page;
        if (!file_exists(APPPATH . 'views/admin/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        if ($this->session->userdata('isAdminLoggedIn') == TRUE) {
            redirect('admin');
        }
        
        if ($this->input->post('loginSubmit')) {
            //echo 'LoginSubmit Started'."\n";
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'password', 'required');

            if ($this->form_validation->run() == TRUE) {
                //echo "form Validation Started". "\n";
                $con['returnType'] = 'single';
                $con['conditions'] = array(
                    'admname' => $this->input->post('username'),
                    'admpass' => md5($this->input->post('password')),
                    'admstatus' => '1'
                );
                $checkLogin = $this->adminlogin->getRows($con);

                if ($checkLogin) {
                    $this->session->set_userdata('isAdminLoggedIn', TRUE);
                    $this->session->set_userdata('admUserId', $checkLogin['AdmId']);
                    redirect('admin');
                } else {
                    $data['error_msg'] = "Wrong Username or password, please try again.";
                }
            }
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter 
        $this->load->view('admin/' . $page, $data);
    }

    /**
     * @info: Allows admin to logout
     */
    public function adminLogout() {

        $array_items = array('isAdminLoggedIn', 'admUserId');
        $this->session->unset_userdata($array_items);

        redirect('admin/login', 'refresh');
    }

    /**
     * 
     * @param type $action
     */
    public function components($action = 'list') {
        if ($this->session->userdata('isAdminLoggedIn') == TRUE) {

            $page = "component";
            $data['title'] = ucfirst($page); // Capitalize the first letter 

            if (!file_exists(APPPATH . 'views/admin/' . $page . '/list.php')) {
                // Whoops, we don't have a page for that!
                show_404();
            }
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('components');
            $crud->columns('cmpImage', 'cmpName', 'cmpCost', 'cmpDescription');
            //$crud->display_as('Image', 'Name', 'Cost', 'Date', 'Description');
            $data = $crud->render();
            if ($action == 'list') {

                $this->load->view('templates/admintemp/header', $data);
                $this->load->view('templates/admintemp/navigation', $data);
                $this->load->view('admin/' . $page . '/' . $action, $data);
                $this->load->view('templates/admintemp/footer', $data);
            } elseif ($action == 'add') {

                //$data = [];
                $compData = [];
                if ($this->input->post('componentSubmit')) {
                    $this->form_validation->set_rules('compname', 'Name', 'required');
                    $this->form_validation->set_rules('compcost', 'Cost', 'required');

                    $compData = array(
                        'cmpName' => strip_tags($this->input->post('compname')),
                        'cmpCost' => strip_tags($this->input->post('compcost')),
                        'cmpImage' => $this->input->post('compImg'),
                        'cmpDescription' => $this->input->post('cmpDescription'),
                    );

                    //print_r($compData);
                    //if ($this->form_validation->run() == TRUE) {

                    $insert = $this->common->InsertCommon('components', $compData);

                    if ($insert) {
                        $this->session->set_userdata('success_msg', 'Your registration was successfull. Please login to your account');
                    } else {
                        $data['error_msg'] = "Something went wrong!, please try again..";
                    }
                }

                $this->load->view('templates/admintemp/header', $data);
                $this->load->view('templates/admintemp/navigation', $data);
                $this->load->view('admin/' . $page . '/' . $action, $data);
                $this->load->view('templates/admintemp/footer', $data);
            } else {
                show_404();
            }
        } else {
            redirect('admin/login');
        }
    }

    /**
     * 
     * @param type $action
     * @info Allows package CRUD operation
     */
    public function Packages() {
        $this->checkIfAdminLoggedIn();
        $data['title'] = 'Packages';
        $crud = new grocery_CRUD();
        $this->load->config('grocery_crud');

        $this->config->set_item('grocery_crud_file_upload_allow_file_types', 'gif|jpeg|jpg|png');
        $crud->set_field_upload('pkgImg', 'assets/uploads/files');
        $crud->set_theme('datatables');
        $crud->set_table('packages');
        $crud->set_relation('CategoryId', 'tbl_packagecategory', 'Category_Name');
        $crud->columns('pkgName', 'CategoryId', 'pkgCost', 'pkgDescription');

        $crud->required_fields('pkgName', 'pkgCost', 'pkgImg', 'CategoryId');
        $crud->add_fields('pkgName', 'CategoryId', 'pkgCost', 'pkgImg', 'pkgDescription');
        $crud->edit_fields('pkgName', 'CategoryId', 'pkgCost', 'pkgImg', 'pkgDescription');
        $crud->display_as('CategoryId', 'Category')->display_as('pkgName', 'Package Name')->
                display_as('pkgCost', 'Cost')->display_as('pkgImg', 'Image')->display_as('pkgDescription', 'Description');

        $crud->unset_clone();
        $data = $crud->render();

        $this->load->view('templates/admintemp/header', $data);
        $this->load->view('templates/admintemp/navigation', $data);
        $this->load->view('admin/pages', $data);
        $this->load->view('templates/admintemp/footer', $data);
    }

    public function Shoppingcart($action = "list") {
        $this->checkIfAdminLoggedIn();
        $page = "shoppingcart";
        $data['title'] = ucfirst($page); // Capitalize the first letter 

        if (!file_exists(APPPATH . 'views/admin/' . $page . '/list.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $crud = new grocery_CRUD();
        $crud->set_theme('datatables');
        $crud->set_table('tbl_products');
        $crud->columns('product_Id', 'Category_Id', 'Product_Name', 'Product_Price', 'Product_Image');
        $crud->display_as('modDate', 'Last Access');
        $data = $crud->render();

        $this->load->view('templates/admintemp/header', $data);
        $this->load->view('templates/admintemp/navigation', $data);
        $this->load->view('admin/' . $page . '/' . $action, $data);
        $this->load->view('templates/admintemp/footer', $data);
    }

    /**
     * @info Allows product CRUD operations
     */
    public function Products() {
        $this->checkIfAdminLoggedIn();
        //$data['title'] = 'Products';
        $crud = new grocery_CRUD();
        $this->load->config('grocery_crud');

        $this->config->set_item('grocery_crud_file_upload_allow_file_types', 'gif|jpeg|jpg|png');
        $crud->set_field_upload('file_url', 'assets/uploads/files');

        $crud->set_theme('datatables');
        $crud->set_table('tbl_products');
        $crud->set_relation('Category_Id', 'tbl_category', 'Category_Name');
        //$crud->columns('Product_Name', 'Product_Price', 'CatId', 'Product_Image');
        $crud->columns('Product_Name', 'Product_Price', 'file_url', 'product_description');

        $crud->required_fields('Product_Name', 'Product_Price', 'file_url', 'Category_Id');
        $crud->add_fields('Product_Name', 'Category_Id', 'Product_Price', 'file_url', 'product_description');
        $crud->edit_fields('Product_Name', 'Category_Id', 'Product_Price', 'file_url', 'product_description');
        $crud->display_as('Product_Name', 'Name')->display_as('Product_Price', 'Price')->display_as('file_url', 'Image')
                ->display_as('product_description', 'Description');
        $crud->unset_clone();
        $data = $crud->render();

        $this->load->view('templates/admintemp/header', $data);
        $this->load->view('templates/admintemp/navigation', $data);
        $this->load->view('admin/pages', $data);
        $this->load->view('templates/admintemp/footer', $data);
    }

    /**
     * @info Allows Adoption CRUD operations
     */
    public function Adoption() {
        $this->checkIfAdminLoggedIn();
        //$data['title'] = 'Products';
        $crud = new grocery_CRUD();
        $this->load->config('grocery_crud');

        $this->config->set_item('grocery_crud_file_upload_allow_file_types', 'gif|jpeg|jpg|png');
        $crud->set_field_upload('PetImage', 'assets/uploads/files');

        $crud->set_theme('datatables');
        $crud->set_table('tbl_petsforadopt');
        //$crud->set_relation('Category_Id', 'tbl_category', 'Category_Name');        
        $crud->columns('PetName', 'PetBreed', 'PetAge', 'PetSex', 'PetSize', 'PetImage', 'PetColor');

        $crud->required_fields('PetName', 'PetBreed', 'PetAge', 'PetSex', 'PetSize', 'PetImage', 'PetColor');
        $crud->add_fields('PetName', 'PetBreed', 'PetAge', 'PetSex', 'PetSize', 'PetImage', 'PetColor', 'PetDescription');
        $crud->edit_fields('PetName', 'PetBreed', 'PetAge', 'PetSex', 'PetSize', 'PetImage', 'PetColor', 'PetDescription');
        $crud->display_as('PetName', 'Name')->display_as('PetBreed', 'Breed')->display_as('PetAge', 'Age')
                ->display_as('PetSex', 'Sex')->display_as('PetSize', 'Size')->display_as('PetImage', 'Image');
        $crud->unset_clone();
        $data = $crud->render();

        $this->load->view('templates/admintemp/header', $data);
        $this->load->view('templates/admintemp/navigation', $data);
        $this->load->view('admin/pages', $data);
        $this->load->view('templates/admintemp/footer', $data);
    }

    /**
     * @info Allows Adoption request view
     */
    public function Adoptionrequestview() {
        $this->checkIfAdminLoggedIn();
        $crud = new grocery_CRUD();
        $this->load->config('grocery_crud');

        $crud->set_theme('datatables');
        $crud->set_table('tbl_adoptionrequest');
        $crud->columns('AdoptersName', 'PetName', 'PetBreed', 'EmailId', 'PhoneNum');
        $crud->unset_edit();
        $crud->unset_add();
        $crud->unset_clone();
        $data = $crud->render();

        $this->load->view('templates/admintemp/header', $data);
        $this->load->view('templates/admintemp/navigation', $data);
        $this->load->view('admin/pages', $data);
        $this->load->view('templates/admintemp/footer', $data);
    }

    /**
     * @info Allows Package Category CRUD operations
     */
    public function PackageCatetory() {
        $this->checkIfAdminLoggedIn();
        $crud = new grocery_CRUD();
        $this->load->config('grocery_crud');

        $this->config->set_item('grocery_crud_file_upload_allow_file_types', 'gif|jpeg|jpg|png');
        $crud->set_field_upload('CatImage', 'assets/uploads/files');

        $crud->set_theme('datatables');
        $crud->set_table('tbl_packagecategory');
        $crud->set_relation('pkgType_Id', 'tbl_packagetype', 'pkgType_Name');
        $crud->columns('Category_Name', 'pkgType_Id', 'CatImage', 'CatDescription');

        $crud->required_fields('Category_Name', 'pkgType_Id', 'CatImage');
        $crud->add_fields('Category_Name', 'pkgType_Id', 'CatImage', 'CatDescription');
        $crud->edit_fields('Category_Name', 'pkgType_Id', 'CatImage', 'CatDescription');

        $crud->display_as('Category_Name', 'Name')->display_as('pkgType_Id', 'Type')
                ->display_as('CatImage', 'Image')->display_as('CatDescription', 'Description');

        $crud->unset_clone();
        $data = $crud->render();

        $this->load->view('templates/admintemp/header', $data);
        $this->load->view('templates/admintemp/navigation', $data);
        $this->load->view('admin/pages', $data);
        $this->load->view('templates/admintemp/footer', $data);
    }
    /**
     * @info Allows Offer Group View
     */
    public function OfferGroup() {
        $this->checkIfAdminLoggedIn();
        $crud = new grocery_CRUD();
        $this->load->config('grocery_crud');

        $crud->set_theme('datatables');
        $crud->set_table('tbl_offergroup');

        $crud->columns('offerName', 'offerValue');

        $crud->required_fields('offerName', 'offerValue');
        $crud->add_fields('offerName', 'offerValue');
        $crud->edit_fields('offerName', 'offerValue');

        $crud->display_as('offerName', 'Groupt Name')->display_as('offerValue', '1$ is equal to');

        $crud->unset_clone();
        $crud->unset_add();
        $crud->unset_edit();
        $crud->unset_delete();
        $data = $crud->render();

        $this->load->view('templates/admintemp/header', $data);
        $this->load->view('templates/admintemp/navigation', $data);
        $this->load->view('admin/pages', $data);
        $this->load->view('templates/admintemp/footer', $data);
    }

    /**
     * @info Allows assign offer to products
     */
    public function AssignOfferGroup() {
        $this->checkIfAdminLoggedIn();
        $crud = new grocery_CRUD();
        $this->load->config('grocery_crud');

        $crud->set_theme('datatables');
        $crud->set_table('tbl_prodrefoffers');

        $crud->set_relation('OfferId', 'tbl_offergroup', '{offerName} - {offerValue}');
        $crud->set_relation('product_Id', 'tbl_products', 'Product_Name', array('Category_Id' => '7'));
        $crud->columns('OfferId', 'product_Id');
        $crud->add_fields('OfferId', 'product_Id');
        $crud->edit_fields('OfferId', 'product_Id');

        $crud->display_as('OfferId', 'Offer group-$1 = Pints')->display_as('product_Id', 'Assigned Products');
        $crud->unset_clone();
        $data = $crud->render();

        $this->load->view('templates/admintemp/header', $data);
        $this->load->view('templates/admintemp/navigation', $data);
        $this->load->view('admin/pages', $data);
        $this->load->view('templates/admintemp/footer', $data);
    }
    /**
     * @info Allows to view promo code
     */
    public function PromoCods() {
        $this->checkIfAdminLoggedIn();
        $crud = new grocery_CRUD();
        $this->load->config('grocery_crud');

        $crud->set_theme('datatables');
        $crud->set_table('tbl_promocodes');

        $crud->columns('CodeName', 'CodeType', 'Code', 'CodeDiscount');
        $crud->add_fields('CodeName', 'CodeType', 'Code', 'CodeDiscount');
        $crud->edit_fields('CodeName', 'CodeType', 'Code', 'CodeDiscount');
        $crud->display_as('CodeName', 'Code Name')->display_as('CodeType', 'Code Type')
                ->display_as('CodeDiscount', 'Discount in %');

        $crud->unset_clone();
        $crud->unset_add();
        $crud->unset_edit();
        $crud->unset_delete();
        $data = $crud->render();

        $this->load->view('templates/admintemp/header', $data);
        $this->load->view('templates/admintemp/navigation', $data);
        $this->load->view('admin/pages', $data);
        $this->load->view('templates/admintemp/footer', $data);
    }

    /**
     * @info: This method allows ADMIN user to manipulate event details
     */
    public function PetEvents() {
        $this->checkIfAdminLoggedIn();
        $crud = new grocery_CRUD();
        $this->load->config('grocery_crud');

        $crud->set_theme('datatables');
        $crud->set_table('tbl_events');

        $this->config->set_item('grocery_crud_file_upload_allow_file_types', 'gif|jpeg|jpg|png');
        $crud->set_field_upload('EventImage', 'assets/uploads/files');

        $crud->set_relation('TypeId', 'tbl_eventtypes', 'TypeName');
        $crud->columns('EventName', 'TypeId', 'EventStartDate', 'EventEndDate', 'EventImage');
        $crud->add_fields('EventName', 'TypeId', 'EventStartDate', 'EventEndDate', 'EventLocation', 'EventDescription', 'EventImage');
        $crud->edit_fields('EventName', 'TypeId', 'EventStartDate', 'EventEndDate', 'EventLocation', 'EventDescription', 'EventImage');

        $crud->unset_clone();
        $data = $crud->render();

        $this->load->view('templates/admintemp/header', $data);
        $this->load->view('templates/admintemp/navigation', $data);
        $this->load->view('admin/pages', $data);
        $this->load->view('templates/admintemp/footer', $data);
    }

    /**
     * @Info This method allows ADMIN user to manipulate In-house experts details
     */
    public function InhouseExperts() {
        $this->checkIfAdminLoggedIn();
        $crud = new grocery_CRUD();
        $this->load->config('grocery_crud');

        $crud->set_theme('datatables');
        $crud->set_table('tbl_inhouseexperts');

        $this->config->set_item('grocery_crud_file_upload_allow_file_types', 'gif|jpeg|jpg|png');
        $crud->set_field_upload('ExpertImage', 'assets/uploads/files');

        $crud->columns('ExpertImage', 'ExpertName', 'ExpertQualification', 'ExpertDescription');
        $crud->add_fields('ExpertName', 'ExpertQualification', 'ExpertDescription', 'ExpertImage');
        $crud->edit_fields('ExpertName', 'ExpertQualification', 'ExpertDescription', 'ExpertImage');
        $crud->required_fields('ExpertImage', 'ExpertName', 'ExpertQualification', 'ExpertDescription');
        $crud->unset_clone();
        $data = $crud->render();

        $this->load->view('templates/admintemp/header', $data);
        $this->load->view('templates/admintemp/navigation', $data);
        $this->load->view('admin/pages', $data);
        $this->load->view('templates/admintemp/footer', $data);
    }

    /**
     * @Info This method allows ADMIN user to manipulate Expert advice details
     */
    public function ExpertAdvice() {
        $this->checkIfAdminLoggedIn();
        $crud = new grocery_CRUD();
        $this->load->config('grocery_crud');

        $crud->set_theme('datatables');
        $crud->set_table('tbl_expertadvice');
        $this->config->set_item('grocery_crud_file_upload_allow_file_types', 'gif|jpeg|jpg|png');
        $crud->set_field_upload('AdviceImage', 'assets/uploads/files');

        $crud->set_relation('ExpertId', 'tbl_inhouseexperts', 'ExpertName');
        $crud->columns('AdviceName', 'ExpertId', 'AdviceDescription', 'AdviceImage');
        $crud->add_fields('AdviceName', 'ExpertId', 'AdviceDescription', 'AdviceImage');
        $crud->edit_fields('AdviceName', 'ExpertId', 'AdviceDescription', 'AdviceImage');

        $crud->display_as('AdviceName', 'Advice Title')->display_as('ExpertId', 'Choose Adviser')
                ->display_as('AdviceDescription', 'Advice Description')->display_as('AdviceImage', 'Upload Image');
        $crud->required_fields('AdviceName', 'ExpertId', 'AdviceDescription');

        $crud->unset_clone();
        $data = $crud->render();

        $this->load->view('templates/admintemp/header', $data);
        $this->load->view('templates/admintemp/navigation', $data);
        $this->load->view('admin/pages', $data);
        $this->load->view('templates/admintemp/footer', $data);
    }

    /**
     * @info This method allows admin to create TipsAndVideos
     */
    public function TipsAndVideos() {
        $this->checkIfAdminLoggedIn();
        $crud = new grocery_CRUD();
        $this->load->config('grocery_crud');

        $crud->set_theme('datatables');
        $crud->set_table('tbl_tipsandvideos');
        $this->config->set_item('grocery_crud_file_upload_allow_file_types', 'gif|jpeg|jpg|png|flv|mp4');
        $this->config->set_item('grocery_crud_file_upload_max_file_size', '100MB');
        $crud->set_field_upload('TipsVideo', 'assets/uploads/videos');
        $crud->set_field_upload('TipsImage', 'assets/uploads/files');
        $crud->columns('TipsName', 'TipsDescription', 'TipsImage', 'TipsVideo');
        $crud->add_fields('TipsName', 'TipsDescription', 'TipsImage', 'TipsVideo');
        $crud->edit_fields('TipsName', 'TipsDescription', 'TipsImage', 'TipsVideo');
        
        $crud->display_as('TipsName', 'Post Title')->display_as('TipsDescription', 'Post Description')
                ->display_as('TipsImage', 'Post Image')->display_as('TipsVideo', 'Post Video');
        
        $crud->required_fields('TipsName', 'TipsDescription');
        $crud->unset_clone();
        $data = $crud->render();

        $this->load->view('templates/admintemp/header', $data);
        $this->load->view('templates/admintemp/navigation', $data);
        $this->load->view('admin/pages', $data);
        $this->load->view('templates/admintemp/footer', $data);
    }
    
    /**
     * @info: Show all orders.
     */
    public function showorders(){
        $this->checkIfAdminLoggedIn();
        $crud = new grocery_CRUD();
        $this->load->config('grocery_crud');

        $crud->set_theme('datatables');
        $crud->set_table('tbl_orders');
        
        $crud->set_relation_n_n('MyOrders', 'tbl_orderdetails', 'tbl_products', 'OrderId', 'ProdId', 'Product_Name');
        
        $crud->unset_clone();
        $crud->unset_add();
        $crud->unset_edit();
        $crud->unset_delete();
        $data = $crud->render();
        
        $this->load->view('templates/admintemp/header', $data);
        $this->load->view('templates/admintemp/navigation', $data);
        $this->load->view('admin/pages', $data);
        $this->load->view('templates/admintemp/footer', $data);
    }
    
    /**
     * @info Show all appointment requests
     */
    public function appointmentrequests(){
        $this->checkIfAdminLoggedIn();
        $crud = new grocery_CRUD();
        $this->load->config('grocery_crud');

        $crud->set_theme('datatables');
        $crud->set_table('tbl_bookappointment');
        $crud->set_relation_n_n('package', 'tbl_appointreferpackage', 'packages', 'ApointmentID', 'pkgId', 'pkgName');
        $crud->columns('OwnerName','BreedName', 'ContactNum', 'AppoDate');        
        
        $crud->unset_clone();
        $crud->unset_add();
        $crud->unset_edit();
        $crud->unset_delete();
        $data = $crud->render();
        
        $this->load->view('templates/admintemp/header', $data);
        $this->load->view('templates/admintemp/navigation', $data);
        $this->load->view('admin/pages', $data);
        $this->load->view('templates/admintemp/footer', $data);
    }
    
    public function dogrescuestories(){
        $this->checkIfAdminLoggedIn();
        $crud = new grocery_CRUD();
        $this->load->config('grocery_crud');
        $crud->set_theme('datatables');
        $crud->set_table('tbl_rescuestories');
        
        $this->config->set_item('grocery_crud_file_upload_allow_file_types', 'gif|jpeg|jpg|png');
        $this->config->set_item('grocery_crud_file_upload_max_file_size', '2MB');
        $crud->set_field_upload('RescueImage', 'assets/uploads/files');
        $crud->columns('RescueTitle','RescueDescription', 'RescueImage');
        
        $crud->add_fields('RescueTitle','RescueDescription', 'RescueImage');
        $crud->edit_fields('RescueTitle','RescueDescription', 'RescueImage');
        
        $crud->unset_clone();
        $data = $crud->render();
        
        $this->load->view('templates/admintemp/header', $data);
        $this->load->view('templates/admintemp/navigation', $data);
        $this->load->view('admin/pages', $data);
        $this->load->view('templates/admintemp/footer', $data);
    }

}
