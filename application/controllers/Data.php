<?php

require APPPATH . 'libraries/REST_Controller.php';

class Data extends REST_Controller{

  // construct
  public function __construct(){
    parent::__construct();
    $this->load->model('user_model');
  }

  // method index untuk menampilkan semua data person menggunakan method get
  public function provinsi_get(){
    $prov = $this->user_model->get_all('t_provinsi')->result();
    $response['status']=200;
    $response['error']=false;
    $response['provinsi']=$prov;
    $this->response($response);
  }

  public function kabupaten_post(){

    $id_provinsi = $this->post('id_provinsi');

    $kab = $this->user_model->get_where('t_kota',['id_provinsi'=>$id_provinsi])->result();
    $response['status']=200;
    $response['error']=false;
    $response['kabupaten']=$kab;
    $this->response($response);
  }

  public function kecamatan_post(){

    $id_kota = $this->post('id_kota');

    $cek = $this->user_model->get_where('t_kecamatan',['id_kota'=>$id_kota]);

    if ($cek->num_rows() > 0) 
    {
        $kec = $cek->result();

        $response['status']=200;
        $response['error']=false;
        $response['kecamatan']=$kec;
        $this->response($response);

    }else{
        $response['status']=200;
        $response['error']=true;
        $response['message']='Data Belum Tersedia';
        $this->response($response);
    }
    
  }

}
