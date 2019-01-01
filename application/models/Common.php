<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Common
 * Id: 700 67 3474
 * Anand Jat
 * @role Work as a global class to communicate with DB
 */
class Common extends CI_Model {

    public function __construct() {
        parent::__construct();
        /**
         * Public table variable
         */
        $this->tblCommn = NULL;
    }

    /**
     * 
     * @param type $table
     * @param type $data
     * @return boolean
     * @info Insert into table with array of values
     */
    public function InsertCommon($table, $data = []) {
        $this->tblCommn = $table;

        if ($this->db->table_exists($this->tblCommn)) {
            if (!array_key_exists("crDate", $data)) {
                $data['crDate'] = date("Y-m-d H:i:s");
            }
            if (!array_key_exists("modDate", $data)) {
                $data['modDate'] = date("Y-m-d H:i:s");
            }

            $insert = $this->db->insert($this->tblCommn, $data);
            if ($insert) {
                return $this->db->insert_id();
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    /**
     * 
     * @param type $table
     * @param type $data
     * @return boolean
     * @info This method insert values into parameter table with array of table values: With out date fields
     */
    public function InsertInTo($table, $data = []) {
        $this->tblCommn = $table;

        if ($this->db->table_exists($this->tblCommn)) {
            $insert = $this->db->insert($this->tblCommn, $data);
            if ($insert) {
                return $this->db->insert_id();
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    /**
     * 
     * @param type $table
     * @return boolean
     * @info Select all DB values
     */
    public function SelectAll($table) {
        $this->tblCommn = $table;
        if ($this->db->table_exists($this->tblCommn)) {
            $query = $this->db->get($this->tblCommn);
            return $query->result();
        } else {
            return FALSE;
        }
    }

    /**
     * 
     *Select all from database
     */
    public function SelectById($table, $key, $value) {
        $this->tblCommn = $table;
        if ($this->db->table_exists($this->tblCommn)) {
            $this->db->where($key, $value);
            $query = $this->db->get($this->tblCommn);
            return $query->result();
        } else {
            return FALSE;
        }
    }

    /**
     * 
     * @param type $table
     * @param type $keyvalues
     * @return boolean
     * @description: Select from a table using multiple key values
     */
    public function SelectByMultipleKeyValues($table, $keyvalues = []) {
        $this->tblCommn = $table;
        if ($this->db->table_exists($this->tblCommn)) {
            $this->db->where($keyvalues);
            $query = $this->db->get($this->tblCommn);
            return $query->result();
        } else {
            return FALSE;
        }
    }

    /**
     * 
     * @param type $table
     * @param type $keyvalues
     * @return boolean
     * @description: Delete from a table using key values
     */
    public function DeleteById($table, $keyvalues = []) {
        $this->tblCommn = $table;
        if ($this->db->table_exists($this->tblCommn)) {
            $this->db->where($keyvalues);
            $result = $this->db->delete($this->tblCommn);
            return $result;
        } else {
            log_message('error', 'Cant delete, Name: ' . $this->tblCommn);
            return FALSE;
        }
    }

    /**
     * 
     * @param type $table
     * @param type $keys
     * @param type $values
     * @return boolean
     * @info Update table with multiple Key Values
     */
    public function UpdateByMultipleKeyValues($table, $keys = [], $values = []) {
        $this->tblCommn = $table;
        if ($this->db->table_exists($this->tblCommn)) {
            $this->db->where($keys);
            $result = $this->db->update($this->tblCommn, $values);
            return $result;
        } else {
            log_message('error', 'Cant find table, Name: ' . $this->tblCommn);
            return FALSE;
        }
    }

    /**
     * 
     * @param type $baseTable
     * @param type $joinTable
     * @param string $key
     * @param type $value
     * @return boolean
     */
    public function SelectByJoin($baseTable, $joinTable, $keyBase, $keyJoin) {
        $this->tblCommn = $baseTable;
        if ($this->db->table_exists($this->tblCommn)) {
            $this->db->select('*');
            $this->db->from($baseTable);
            $this->db->join($joinTable, "'" . $joinTable . "." . $keyBase . " = " . $baseTable . "." . $keyJoin . "'");
            $query = $this->db->get();
            return $query->result();
        } else {
            return FALSE;
        }
    }    

    /**
     * 
     * @return Array of Values
     * @description this function selects featured products from tbl_offergroup
     */
    public function SelectFeaturedPoints() {
        if ($this->db->table_exists('packages')) {
            $this->db->select("tbl_prodrefoffers.RefId, tbl_products.product_Id, "
                    . "tbl_products.Product_Name, tbl_products.Product_Price, "
                    . "tbl_offergroup.OfferId, tbl_offergroup.offerName, "
                    . "tbl_offergroup.offerValue");
            $this->db->from('tbl_prodrefoffers');
            $this->db->join('tbl_products', 'tbl_products.product_Id = tbl_prodrefoffers.product_Id');
            $this->db->join('tbl_offergroup', 'tbl_offergroup.OfferId = tbl_prodrefoffers.OfferId');
            $query = $this->db->get();
            return $query->result();
        } else {
            return FALSE;
        }
    }

    /**
     * 
     * @return boolean
     * @description Select packages
     */
    public function SelectCustomPackages() {
        if ($this->db->table_exists('packages')) {
            $this->db->select("packages.pkgId, packages.CategoryId, packages.pkgName, packages.pkgCost, packages.pkgDescription, packages.pkgImg, "
                    . "tbl_packagecategory.Category_Name, tbl_packagecategory.CatDescription, tbl_packagecategory.CatImage");
            $this->db->from('packages');
            $this->db->join('tbl_packagecategory', 'tbl_packagecategory.CategoryId = packages.CategoryId');
            $query = $this->db->get();
            return $query->result();
        } else {
            return FALSE;
        }
    }

    /**
     * 
     * @return boolean
     * @info This method selects Expert advise with doctors details. 
     */
    public function SelectInhouseExpertAdvice() {
        if ($this->db->table_exists('tbl_inhouseexperts')) {
            $this->db->select("tbl_inhouseexperts.ExpertId, tbl_inhouseexperts.ExpertName, "
                    . "tbl_inhouseexperts.ExpertQualification, tbl_inhouseexperts.ExpertDescription, "
                    . "tbl_inhouseexperts.ExpertImage, tbl_expertadvice.AdviceId, tbl_expertadvice.AdviceName, "
                    . "tbl_expertadvice.AdviceDescription, tbl_expertadvice.AdviceImage");
            $this->db->from('tbl_inhouseexperts');
            $this->db->join('tbl_expertadvice', 'tbl_expertadvice.ExpertId = tbl_inhouseexperts.ExpertId');
            $query = $this->db->get();
            return $query->result();
        } else {
            return FALSE;
        }
    }

    /**
     * 
     * @param type $exptId
     * @return boolean
     */
    public function SelectInhouseExpertAdviceById($exptId) {
        if ($this->db->table_exists('tbl_inhouseexperts')) {
            $this->db->select("tbl_inhouseexperts.ExpertId, tbl_inhouseexperts.ExpertName, "
                    . "tbl_inhouseexperts.ExpertQualification, tbl_inhouseexperts.ExpertDescription, "
                    . "tbl_inhouseexperts.ExpertImage, tbl_expertadvice.AdviceId, tbl_expertadvice.AdviceName, "
                    . "tbl_expertadvice.AdviceDescription, tbl_expertadvice.AdviceImage");
            $this->db->from('tbl_inhouseexperts');
            $this->db->join('tbl_expertadvice', 'tbl_expertadvice.ExpertId = tbl_inhouseexperts.ExpertId');
            $this->db->where('tbl_expertadvice.ExpertId', $exptId);
            $query = $this->db->get();
            return $query->result();
        } else {
            return FALSE;
        }
    }
    
    /**
     * 
     * @param type $userId
     * @return type
     */
    public function SelectUserProfile($userId){
        if ($this->db->table_exists('users')){
            $this->db->select("users.id, users.name, users.email, users.gender, "
                    . "users.phone, useraddress.addrId, useraddress.addrType, "
                    . "useraddress.streetAddr, useraddress.addrLine2, useraddress.state, "
                    . "useraddress.country, useraddress.zipCode");
            $this->db->from('users');
            $this->db->join('useraddress', 'users.id = useraddress.userId');
            $this->db->where('users.id', $userId);
            $query = $this->db->get();
            return $query->result();
        }
    }
    /**
     * 
     *Select specific data from database
     */
    public function SelectSpecific($table, $userid, $pickupDate) {
        $this->tblCommn = $table;
        if ($this->db->table_exists($this->tblCommn)) {
            $this->db->where("UserId = '".$userid."'&& pickupDate >= '".$pickupDate."'");
            $query = $this->db->get($this->tblCommn);
            return $query->result();
        } else {
            return FALSE;
        }
    }

}
