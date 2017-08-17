<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DokumanController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

   public function editor()
   {
        $this->load->view('admin_layout', array('view' => 'dokuman/editor','data' => array('baslik' => 'Yeni Sınav Yeri')));
   }
}
