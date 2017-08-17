<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index()
    {
    	$this->db->where('onay', FALSE); 
    	$basvuru = $this->db->get('basvuru');
		$bekleyenbasvuru = $basvuru->num_rows();


        $this->load->view('admin_layout',array('view' => 'blank','data' => array('baslik' => 'baslik','bekleyenbasvuru' => $bekleyenbasvuru)));
    }

}
