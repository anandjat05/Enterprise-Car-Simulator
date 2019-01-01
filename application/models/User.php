<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *Id: 700 67 3474
 * @author Anand Jat
 */
class User extends CI_Model {

    
    function __construct() {
        parent::__construct();
        $this->userTbl = 'users';
        $this->tblAppoint = 'tbl_carappointment';
        $this->tblCommn = "";
    }

    public function getRows($params = []) {
        $this->db->select('*');
        $this->db->from($this->userTbl);

        // Fetch data by conditions
        if (array_key_exists("conditions", $params)) {
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        if (array_key_exists("id", $params)) {
            $this->db->where('id', $params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        } else {
            if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                $this->db->limit($params['limit'], $params['start']);
            } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                $this->db->limit($params['limit']);
            }
            $query = $this->db->get();

            if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
                $result = $query->num_rows();
            } elseif (array_key_exists("returnType", $params) && $params["returnType"] == 'single') {
                $result = ($query->num_rows() > 0) ? $query->row_array() : FALSE;
            } else {
                $result = ($query->num_rows() > 0) ? $query->result_array() : FALSE;
            }
        }
        return $result;
    }

    /**
     * Insert/Register User Informations
     */
    public function Insert($data = []) {

        /**
         * Add Created date if not included
         */
        if (!array_key_exists("usr_crDate", $data)) {
            $data['usr_crDate'] = date("Y-m-d H:i:s");
        }
        if (!array_key_exists("usr_ModDate", $data)) {
            $data['usr_ModDate'] = date("Y-m-d H:i:s");
        }

        $insert = $this->db->insert($this->userTbl, $data);
        if ($insert) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    /**
     * Common Insert Method
     */
    public function InsertCommon($data = [], $table) {
        $this->tblCommn = $table;

        if ($this->db->table_exists($this->tblCommn)) {
            echo "Yes, Table exists";
        }
        if (!array_key_exists("usr_crDate", $data)) {
            $data['usr_crDate'] = date("Y-m-d H:i:s");
        }
        if (!array_key_exists("usr_ModDate", $data)) {
            $data['usr_ModDate'] = date("Y-m-d H:i:s");
        }
    }

    public function fetch_year(){
        $this->db->order_by('years', 'ASC');
        $query = $this->db->get('year');
        return $query->result();

    }
    public function fetch_model($make_Id){
        $this->db->where('make_Id', $make_Id);
        $this->db->order_by('model', 'ASC');
        $query = $this->db->get('model');
       $output = '<option value = "">Select Model</option>';
       foreach ($query->result() as $row) {
           # code...it will fetch the car make
        $output .= '<option value = "'.$row->model_Id.'">'.$row->model.'</option>';
        
       }
       return $output; 
    }

    public function fetch_make(){
        $this->db->order_by('make', 'ASC');
        $query = $this->db->get('make');
        return $query->result();

    }
    



    public function bookAppointment($data){
        //  $insert = $this->db->insert($this->tblAppoint, $datas);
        // if ($insert) {
        //     return $this->db->insert_id();
        // } else {
        //     return FALSE;
        // }
       

        $insert = $this->db->insert($this->tblAppoint, $data);
        if ($insert) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    



    }//end book appointment function


public function fetch_date_query($carType, $from, $to){
        //$this->db->order_by('tbl_orders', 'ASC');
        
        $this->db->where("CarType = '".$carType."' and ((pickupDate BETWEEN '".$from."' and '".$to."' ) "
            ."or ( returnDate BETWEEN '".$from."' and '".$to."'  ) "
            ." or (pickupDate < '".$from."' and returnDate > '".$to."' ))",null, false);

        $query = $this->db->get('tbl_orders');

        return $query;

    }

//fetching date and time for test drive schedule
public function fetch_date_time_query($carType, $appoTime, $appoDate){

        $this->db->where("CarType = '".$carType."' and AppoDate = '".$appoDate."' and AppoTime = '".$appoTime."'", null, false);

        $query = $this->db->get('tbl_bookappointment');

        return $query;

    }
public function DeleteOredrId($table, $oredrid, $pickupDate) {
        $this->tblCommn = $table;
        if ($this->db->table_exists($this->tblCommn)) {
            $this->db->where("OrderId = '".$oredrid."'&& pickupDate >= '".$pickupDate."'");
            $result = $this->db->delete($this->tblCommn);
            return $result;
        } else {
            log_message('error', 'Cant delete, Name: ' . $this->tblCommn);
            return FALSE;
        }
}

public function SelectUserEmail($userId){
        if ($this->db->table_exists('users')){
            $this->db->select("users.email");
            $this->db->from('users');
            $this->db->where('users.id', $userId);
            $query = $this->db->get();
            return $query;
        }
    }

// public function SelectCheckStatus($vehicle){
//         if ($this->db->table_exists('tbl_sold')){
//             $this->db->select("tbl_sold.status");
//             $this->db->from('tbl_sold');
//             $this->db->where('tbl_sold.vehicle', $vehicle);
//             $query = $this->db->get();
//             return $query->result();
//         }
//     }
public function SelectCheckStatus($vehicle){
        //$this->db->order_by('tbl_orders', 'ASC');
        
        $this->db->where("vehicle = '".$vehicle."'",null, false);

        $query = $this->db->get('tbl_sold');

        return $query;

    }
// public function selsectSellId($vehicle){
//         //$this->db->order_by('tbl_orders', 'ASC');
        
//         $this->db->where("vehicle = '".$vehicle."'",null, false);

//         $query = $this->db->get('tbl_sold');

//         return $query;

//     }





// public function fetch_orderId($userId){
//         if ($this->db->table_exists('tbl_orders')){
//             $this->db->select("tbl_orders.OrderId");
//             $this->db->from('tbl_orders');
//             $this->db->where('tbl_orders.UserId', $userId);
//             $query = $this->db->get();
//             return $query->result();

//     }
// }

}


