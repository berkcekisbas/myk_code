<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MeslekController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    function checkDateFormat($date) {
        if (preg_match('/^\d{2}-\d{2}-\d{4}$/', $date)) {
            if(checkdate(substr($date, 3, 2), substr($date, 0, 2), substr($date, 6, 4)))
                return true;
            else
                return false;
        } else {
            return false;
        }
    }

    public function index()
    {
        $this->load->view('admin_layout',array('view' => 'blank','data' => array('baslik' => 'baslik')));
    }

    public function liste()
    {
        $this->load->view('admin_layout',array('view' => 'meslek/liste','data' => array('baslik' => 'Meslekler','meslekler' => $this->meslek_model->meslekler())));
    }


    public function yeni()
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('kod', 'Standart Kodu', 'required',array('required' => '%s  Boş Olamaz'));
            $this->form_validation->set_rules('ad', 'Standart Adı', 'required',array('required' => '%s  Boş Olamaz'));
            $this->form_validation->set_rules('seviye', 'Seviye', 'required|is_natural',array('required' => '%s  Boş Olamaz','is_natural' => '%s  Sayısal Olmalıdır'));
            $this->form_validation->set_rules('sektor', 'Sektör', 'required',array('required' => '%s  Boş Olamaz'));
            $this->form_validation->set_rules('revizyon', 'Revizyon', 'required|is_natural',array('required' => '%s  Boş Olamaz','is_natural' => '%s  Sayısal Olmalıdır'));
            $this->form_validation->set_rules('onaytarihi', 'Onay Tarihi', 'required|callback_checkDateFormat',array('required' => '%s  Boş Olamaz','checkDateFormat' => 'Lütfen geçerli Bir %s Girin'));
            $this->form_validation->set_rules('onaysayisi', 'Onay Sayısı', 'required',array('required' => '%s  Boş Olamaz'));

            if ($this->form_validation->run() == TRUE)
            {
                $this->meslek_model->meslek_ekle($this->input->post());
                $this->session->set_flashdata('success', 'Başarıyla Kaydedildi');

                redirect('meslek/meslekler');
            }
        }

        $form = array(
            array('id' => 'kod','name' => 'kod','label' => 'Standart Kodu','value' => set_value('kod'),'placeholder' => 'Standart Kodu','type' => 'text','required' => 'false','class' => 'form-control'),
            array('id' => 'ad','name' => 'ad','label' => 'Standart Adı','value' => set_value('ad'),'placeholder' => 'Standart Adı','type' => 'text','required' => 'false','class' => 'form-control'),
            array('id' => 'seviye','name' => 'seviye','label' => 'Seviye','value' => set_value('seviye'),'placeholder' => 'Seviye','type' => 'text','required' => 'false','class' => 'form-control mask_number','helpblock' => 'Sadece rakam giriniz.'),
            array('id' => 'revizyon','name' => 'revizyon','label' => 'Revizyon','value' => set_value('revizyon'),'placeholder' => 'Revizyon','type' => 'text','required' => 'false','class' => 'form-control mask_number','helpblock' => 'Sadece rakam giriniz.'),
            array('id' => 'sektor','name' => 'sektor','label' => 'Sektör','value' => set_value('sektor'),'placeholder' => 'Sektör','type' => 'text','required' => 'false','class' => 'form-control'),
            array('id' => 'onaytarihi','name' => 'onaytarihi','label' => 'Onay Tarihi','value' => set_value('onaytarihi'),'placeholder' => 'Onay Tarihi','type' => 'text','required' => 'false','class' => 'form-control mask_date2'),
            array('id' => 'onaysayisi','name' => 'onaysayisi','label' => 'Onay Sayısı','value' => set_value('onaysayisi'),'placeholder' => 'Onay Sayısı','type' => 'text','required' => 'false','class' => 'form-control'),

        );

        $this->load->view('admin_layout', array('view' => 'meslek/yeni','data' => array('baslik' => 'baslik','form' => createForm($form))));
    }

    public function duzenle($id)
    {

        if($this->input->post())
        {
            $this->form_validation->set_rules('kod', 'Standart Kodu', 'required',array('required' => '%s  Boş Olamaz'));
            $this->form_validation->set_rules('ad', 'Standart Adı', 'required',array('required' => '%s  Boş Olamaz'));
            $this->form_validation->set_rules('seviye', 'Seviye', 'required|is_natural',array('required' => '%s  Boş Olamaz','is_natural' => '%s  Sayısal Olmalıdır'));

            if ($this->form_validation->run() == TRUE)
            {
                $this->meslek_model->meslek_duzenle($this->input->post(),$id);
                $this->session->set_flashdata('success', 'Başarıyla Kaydedildi');
                redirect('meslek/meslekler');
            }
        }

                  $this->db->where('id', $id);
        $result = $this->db->get('meslekler')->row();

        $form = array(
            array('id' => 'kod','name' => 'kod','label' => 'Standart Kodu','value' => $result->kod,'placeholder' => 'Standart Kodu','type' => 'text','required' => 'false','class' => 'form-control'),
            array('id' => 'ad','name' => 'ad','label' => 'Standart Adı','value' => $result->ad,'placeholder' => 'Standart Adı','type' => 'text','required' => 'false','class' => 'form-control'),
            array('id' => 'seviye','name' => 'seviye','label' => 'Seviye','value' => $result->seviye,'placeholder' => 'Seviye','type' => 'text','required' => 'false','class' => 'form-control mask_number','helpblock' => 'Sadece rakam giriniz.'),
            array('id' => 'sektor','name' => 'sektor','label' => 'Sektör','value' => $result->sektor,'placeholder' => 'Sektör','type' => 'text','required' => 'false','class' => 'form-control'),
            array('id' => 'revizyon','name' => 'revizyon','label' => 'Revizyon','value' => $result->revizyon,'placeholder' => 'Revizyon','type' => 'text','required' => 'false','class' => 'form-control mask_number','helpblock' => 'Sadece rakam giriniz.'),
            array('id' => 'onaytarihi','name' => 'onaytarihi','label' => 'Onay Tarihi','value' => date("d-m-Y",strtotime($result->onaytarihi)),'placeholder' => 'Onay Tarihi','type' => 'text','required' => 'false','class' => 'form-control mask_date2'),
            array('id' => 'onaysayisi','name' => 'onaysayisi','label' => 'Onay Sayısı','value' => $result->onaysayisi,'placeholder' => 'Onay Sayısı','type' => 'text','required' => 'false','class' => 'form-control'),
        );

        $this->load->view('admin_layout', array('view' => 'meslek/duzenle','data' => array('baslik' => 'baslik','form' => createForm($form))));
    }

    public function sil($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('meslekler');

        $this->session->set_flashdata('success', 'Başarıyla Silindi');
        redirect('meslek/meslekler');
    }

    public function durum($id,$durum)
    {

        $data = array(
            'aktif' => $durum
        );
        $this->db->where('id', $id);
        $this->db->update('meslekler', $data);
        $this->session->set_flashdata('success', 'Durum Başarıyla Güncellendi');
        redirect('meslek/meslekler');

    }
}
