<?php  if(!defined('BASEPATH'))exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author Mamatha Kamath
 */
class Adminlogin extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->adminTbl = 'adminlogin';
    }
    
    public function getRows($params = []){
        $this->db->select('*');
        $this->db->from($this->adminTbl);
        
        // Fetch data by conditions
        if(array_key_exists("conditions", $params)){
            foreach ($params['conditions'] as $key => $value){
                $this->db->where($key, $value);
            }
        }
        
        if(array_key_exists("id", $params)){
            $this->db->where('AdmId', $params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            if(array_key_exists("start", $params) && array_key_exists("limit", $params)){
                $this->db->limit($params['limit'], $params['start']);
            }
            elseif(!array_key_exists("start", $params) && array_key_exists("limit", $params)){
                $this->db->limit($params['limit']);
            }
            $query = $this->db->get();
            
            if(array_key_exists("returnType", $params)&& $params['returnType'] == 'count'){
                $result = $query->num_rows();
            }
            elseif(array_key_exists("returnType", $params) && $params["returnType"] == 'single'){
                $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
            }
            else
            {
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        return $result;
        
    }
}
