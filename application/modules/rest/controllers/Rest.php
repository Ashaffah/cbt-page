<?php

Class Rest extends MX_Controller {

    function __construct() {
        parent::__construct();
       
    }

   // fungsi untuk CREATE
    public function addStaff()
    {
          // deklarasi variable
          $name = $this->input->post('name');
          $hp = $this->input->post('hp');
        $alamat = $this->input->post('alamat');
          // isikan variabel dengan nama file
          $data['nama'] = $name;
        $data['hp'] = $hp;
          $data['nim'] = $alamat;
          $q = $this->db->insert('aplikasi', $data);
          // check insert berhasil apa nggak
          if ($q) {
            $response['pesan'] = 'insert berhasil';
            $response['status'] = 200;
          } else {
            $response['pesan'] = 'insert error';
            $response['status'] = 404;
          }
          echo json_encode($response);
    }
	// fungsi untuk Jawab Soal
    public function jawabSoal()
    {
          // deklarasi variable
          $jawab = $this->input->post('jawab');
          $nimkey = $this->input->post('nimkey');
        $ujian = $this->input->post('ujian');
		$soal = $this->input->post('soal');
          // isikan variabel dengan nama file
          $data['nim'] = $nimkey;
        $data['id_soal'] = $soal;
          $data['id_ujian'] = $ujian;
		$data['jawaban'] = $jawab;
          $q = $this->db->insert('jawaban', $data);
          // check insert berhasil apa nggak
          if ($q) {
            $response['pesan'] = 'insert berhasil';
            $response['status'] = 200;
          } else {
            $response['pesan'] = 'insert error';
            $response['status'] = 404;
          }
          echo json_encode($response);
    }
      // fungsi untuk READ
    public function getData()
    {
          $q = $this->db->get('ujian');
          if ($q -> num_rows() > 0) {
            $response['pesan'] = 'data ada';
            $response['status'] = 200;
            // 1 row
            $response['staff'] = $q->row();
            $response['staff'] = $q->result();
          } else {
            $response['pesan'] = 'data tidak ada';
            $response['status'] = 404;
          }
          echo json_encode($response);
    }

	 public function getSoal()
    {
		$id = $this->input->post('id');
		$this->db->where('id_ujian', $id);
          $q = $this->db->get('soal');
          if ($q -> num_rows() > 0) {
            $response['pesan'] = 'data ada';
            $response['status'] = 200;
            // 1 row
            $response['staff'] = $q->row();
            $response['staff'] = $q->result();
          } else {
            $response['pesan'] = 'data tidak ada';
            $response['status'] = 404;
          }
          echo json_encode($response);
    }
      // fungsi untuk DELETE
    public function deleteStaff()
    {
          $id = $this->input->post('id');
          $this->db->where('id', $id);
          $status = $this->db->delete('aplikasi');
          if ($status == true) {
            $response['pesan'] = 'hapus berhasil';
            $response['status'] = 200;
          } else {
            $response['pesan'] = 'hapus error';
            $response['status'] = 404;
          }
          echo json_encode($response);
    }
      // fungsi untuk UPDATE
    public function updateStaff()
    {
          // deklarasi variable
          $id = $this->input->post('id');
          $name = $this->input->post('name');
          $hp = $this->input->post('hp');
          $alamat = $this->input->post('alamat');
          $this->db->where('id', $id);
          // isikan variabel dengan nama file
          $data['nama'] = $name;
          $data['hp'] = $hp;
          $data['nim'] = $alamat;
          $q = $this->db->update('aplikasi', $data);
          // check insert berhasil apa nggak
          if ($q) {
            $response['pesan'] = 'update berhasil';
            $response['status'] = 200;
          } else {
            $response['pesan'] = 'update error';
            $response['status'] = 404;
          }
          echo json_encode($response);
    }

public function arduino(){
$isi = array(
            
            'data1'     => $_GET['data1'],
			'data2'     => $_GET['data2'],
			'data3'     => $_GET['data3']
		
        );
$this->db->insert('data',$isi);
}

public function payload(){
$data = $this->db->select('*')->from('data')->limit(1)->order_by('id','desc')->get()->result();
foreach ($data as $d) {
echo $d->data1;
}

}

//Fungsi Staff
   function loginStaff(){
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    
    $this->db->where('nim',$email);
    $this->db->where('password',$password);

    $q = $this->db->get('peserta');

    if($q -> num_rows() > 0){
        $data['message'] = 'Login Success';
        $data['status'] = 200;
        $data['staff'] = $q -> row();
    } else {
        $data['message'] = 'Username atau Password Salah';
        $data['status'] = 404;
    }
    echo json_encode($data);
  }

	
}