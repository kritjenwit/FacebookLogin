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
        $query = $this->db->get_where('users', array('email'=>$email));
        return $query->row_array();
    }

    public function create_user($profile_image){
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $data = array(
            'name' => $name,
            'email' => $email,
            'password' => md5($password),
            'picture' => $profile_image,
        );
        $this->db->insert('users', $data);
    }

    public function check_email_exists($email){
        $query = $this->db->get_where('users',array('email' => $email));
        if(empty($query->row_array())){
            return true;
        }else{
            return false;
        }
    }

    public function login($email, $password){
        // Validate
        $this->db->where('email',$email);
        $this->db->where('password', $password);
        $result = $this->db->get('users');
        if($result->num_rows() == 1){
            return $result->row(0)->id;
        }else{
            return false;
        }
    }

    public function update_user($id){
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
        );
        $this->db->set('updated_at', 'NOW()', FALSE);
        $this->db->where('id', $id);
        if($this->db->update('users', $data)){

            $user_data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'picture' => $this->session->userdata('picture'),
            );
        }

        $this->session->set_userdata($user_data);

        redirect('profile');
    }
}