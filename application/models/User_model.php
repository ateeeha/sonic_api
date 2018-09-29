<?php

// extends class Model
class User_model extends CI_Model{

  // response jika field ada yang kosong
  public function empty_response(){
    $response['status']=502;
    $response['error']=true;
    $response['message']='Field tidak boleh kosong';
    return $response;
  }

  // function untuk insert data ke tabel t_user
  public function add_person($name,$address,$phone){

    if(empty($name) || empty($address) || empty($phone)){
      return $this->empty_response();
    }else{
      $data = array(
        "name"=>$name,
        "address"=>$address,
        "phone"=>$phone
      );

      $insert = $this->db->insert("t_user", $data);

      if($insert){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data person ditambahkan.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data person gagal ditambahkan.';
        return $response;
      }
    }

  }

  // mengambil semua data person
  public function all_user(){
    // $nama = array('name' => 'Dono' );

    // $this->db->where($nama);
    $all = $this->db->get("t_user")->result();
    $response['status']=200;
    $response['error']=false;
    $response['person']=$all;
    return $response;

  }

  public function get_where($table = null, $where = null)
  {
    $this->db->from($table);
    $this->db->where($where);

    return $this->db->get();
  }

  function get_all($table)
  {
    $this->db->from($table);

    return $this->db->get();
  }


  // hapus data person
  public function delete_person($id){

    if($id == ''){
      return $this->empty_response();
    }else{
      $where = array(
        "id"=>$id
      );

      $this->db->where($where);
      $delete = $this->db->delete("t_user");
      if($delete){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data person dihapus.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data person gagal dihapus.';
        return $response;
      }
    }

  }

  // update person
  public function update_person($id,$name,$address,$phone){

    if($id == '' || empty($name) || empty($address) || empty($phone)){
      return $this->empty_response();
    }else{
      $where = array(
        "id"=>$id
      );

      $set = array(
        "name"=>$name,
        "address"=>$address,
        "phone"=>$phone
      );

      $this->db->where($where);
      $update = $this->db->update("t_user",$set);
      if($update){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data person diubah.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data person gagal diubah.';
        return $response;
      }
    }

  }

}

?>
