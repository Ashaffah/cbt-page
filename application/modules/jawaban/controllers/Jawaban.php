<?php

Class Jawaban extends MX_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
		$data['data'] = $this->db->select('*')->from('peserta')->get()->result(); //Untuk mengambil data dari database webinar
		$this->template->load('template','jawaban/list',$data);	
    }
	
	function cetak() {
		$data['data'] = $this->db->select('*')->from('peserta')->get()->result(); //Untuk mengambil data dari database webinar
		$this->load->view('jawaban/cetak',$data);	
    }

}