<?php

/**
 * Created by PhpStorm.
 * User: AI System
 * Date: 23-Jul-18
 * Time: 5:40 PM
 */
class User_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    public function get_user($email = FALSE){
        if($email === FALSE){
            $query = $this->db->get('users');
            return $query->result_array();
        }
        $query = $this->db->get_where('users', array('id'=>$email));
        return $query->row_array();
    }
}