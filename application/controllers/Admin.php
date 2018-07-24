<?php

/**
 * Created by PhpStorm.
 * User: AI System
 * Date: 23-Jul-18
 * Time: 6:05 PM
 */
class Admin extends CI_Controller
{
    public function index(){

        $data['title'] = 'Home page';
        $this->load->view('templates/header', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer', $data);
    }
    public function profile(){
        if(!$this->session->userdata('logged')){
            redirect('/login');
        }
        $data['title'] = 'Profile';
        $this->load->view('templates/header', $data);
        $this->load->view('admin/profile', $data);
        $this->load->view('templates/footer', $data);
    }

    public function update(){
        if(!$this->session->userdata('logged')){
            redirect('login');
        }
        $id = $this->input->post('id');
        $this->user_model->update_user($id);
        redirect('profile');
    }
}