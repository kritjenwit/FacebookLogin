<?php

/**
 * Created by PhpStorm.
 * User: AI System
 * Date: 23-Jul-18
 * Time: 5:40 PM
 */
class FBUser_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_user($id = FALSE){
        if($id === FALSE){
            $query = $this->db->get('fb_users');
            return $query->result_array();
        }
        $query = $this->db->get_where('fb_users', array('id'=>$id));
        return $query->row_array();
    }

    public function insert_user($id,$name,$email,$link,$picture){
        $data = array(
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'link' => $link,
            'picture' => $picture
        );
        $this->db->insert('fb_users', $data);
    }
}