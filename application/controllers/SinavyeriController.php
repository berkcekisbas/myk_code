<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SinavyeriController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function liste()
    {
        $this->load->view('admin_layout',array('view' => 'sinavyeri/liste','data' => array('baslik' => 'SINAV YERLERİ','sinavyerleri' => $this->sinavyeri_model->sinavyerleri())));
    }

    public function yeni()
    {

        if($this->input->post())
        {
            $this->form_validation->set_rules('ad', 'Ad', 'required',array('required' => '%s  Boş Olamaz'));

            if ($this->form_validation->run() == TRUE)
            {
                   $data = array(
                            'ad' => $this->input->post('ad')
                        );
                        $this->db->insert('sinavyerleri', $data);

                        $this->session->set_flashdata('success', 'Başarıyla Kaydedildi');

                redirect('sinavyeri/liste');
            }
        }

        $this->load->view('admin_layout', array('view' => 'sinavyeri/yeni','data' => array('baslik' => 'Yeni Sınav Yeri')));
    }

}
