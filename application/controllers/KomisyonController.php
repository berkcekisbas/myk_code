<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KomisyonController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function liste()
    {
        $this->load->view('admin_layout',array('view' => 'komisyon/liste','data' => array('baslik' => 'SINAV KOMİSYONU VE SINAV GÖREVLİLERİ','komisyonlar' => $this->komisyon_model->komisyonlar())));
    }

    public function yeni()
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('adsoyad', 'İsim Soyisim', 'required',array('required' => '%s  Boş Olamaz'));

            if ($this->form_validation->run() == TRUE)
            {
                $this->komisyon_model->komisyon_ekle($this->input->post());
                $this->session->set_flashdata('success', 'Başarıyla Kaydedildi');

                redirect('komisyon/liste');
            }
        }

        $this->load->view('admin_layout', array('view' => 'komisyon/yeni','data' => array('baslik' => 'baslik')));
    }

}
