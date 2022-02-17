<?php

Class Ujian extends MX_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
		$data['data'] = $this->db->select('*')->from('ujian')->get()->result(); //Untuk mengambil data dari database webinar
		$this->template->load('template','ujian/list',$data);	
    }

function add() {
    $isi = array(
            'ujian'     => $this->input->post('data1')
        );
        $this->db->insert('ujian',$isi);
        redirect('ujian');
    }

	    
function edit(){
	if(isset($_POST['submit'])){
            $data = array(
            'ujian'     => $this->input->post('data1')
        );
        $id   = $this->input->post('id');
        $this->db->where('id',$id);
        $this->db->update('ujian',$data);
        redirect('ujian');
        }else{
            $id           = $this->uri->segment(3);
            $data['data'] = $this->db->get_where('ujian',array('id'=>$id))->row_array();
            $this->template->load('template', 'ujian/edit',$data);
        }
    }

function soal(){
            $id           = $this->uri->segment(3);
			$this->session->set_userdata('id_ujian', $id);
            redirect('soal');
    }

 function hapus(){
        $id = $this->uri->segment(3);
        if(!empty($id)){
            // proses delete data
            $this->db->where('id',$id);
            $this->db->delete('ujian');
        }
        redirect('ujian');
    }

}