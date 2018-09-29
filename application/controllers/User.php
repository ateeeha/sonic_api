<?php

require APPPATH . 'libraries/REST_Controller.php';

class User extends REST_Controller{

  // construct
  public function __construct(){
    parent::__construct();
    $this->load->model('user_model');
  }

  // method index untuk menampilkan semua data person menggunakan method get
  public function index_get(){
    $response = $this->user_model->all_user();
    $this->response($response);
  }

  public function login_post(){

    $email    = $this->post('email');
    $password = $this->post('password');

    $cek = $this->user_model->get_where('t_user', array('email' => $email));

    if ($cek->num_rows() > 0) 
    {
        $data = $cek->row();

        if (password_verify($password, $data->password)) 
        {
          $response['status']=200;
          $response['error']=false;
          $response['message']='Selamat Anda Berhasil Login!';
          $this->response($response);

        } else {
          $response['status']=200;
          $response['error']=false;
          $response['message']='Password Yang Anda Masukkan Salah!';
          $this->response($response);
        } 

    } else {
        $response['status']=200;
        $response['error']=false;
        $response['message']='Email Tidak Terdaftar!';
        $this->response($response);
    }
   
  }

  // untuk menambah person menaggunakan method post
  public function tambah_post(){
    $response = $this->user_model->add_person(
        $this->post('name'),
        $this->post('address'),
        $this->post('phone')
      );
    $this->response($response);
  }

  // update data person menggunakan method put
  public function update_put(){
    $response = $this->user_model->update_person(
        $this->put('id'),
        $this->put('name'),
        $this->put('address'),
        $this->put('phone')
      );
    $this->response($response);
  }

  // hapus data person menggunakan method delete
  public function delete_delete(){
    $response = $this->user_model->delete_person(
        $this->delete('id')
      );
    $this->response($response);
  }

}
