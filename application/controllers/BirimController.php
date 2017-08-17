<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BirimController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function liste($tip,$yeterlilikid)
    {
        $baslik = NULL;

        $this->db->where('id', $yeterlilikid);
        $result = $this->db->get('yeterlilikler')->row();

        switch ($tip)
        {
            case "zorunlu":
                $baslik = $result->kod." / ".$result->ad." ZORUNLU YETERLİLİK BİRİMLERİ"; break;
            case "secmeli":
                $baslik = $result->kod." / ".$result->ad." SEÇMELİ YETERLİLİK BİRİMLERİ"; break;

        }

        $this->load->view('admin_layout',array('view' => 'birim/liste','data' => array('baslik' => $baslik,'results' => $this->birim_model->birimler($tip,$yeterlilikid))));
    }

    public function yeni($tip,$yeterlilikid)
    {
        $baslik = NULL;

        if($this->input->post())
        {
            $this->form_validation->set_rules('kod', 'Birim Kodu', 'required',array('required' => '%s  Boş Olamaz'));
            $this->form_validation->set_rules('ad', 'Birim Adı', 'required',array('required' => '%s  Boş Olamaz'));
            $this->form_validation->set_rules('fiyat', 'Fiyat', 'required|numeric',array('required' => '%s  Boş Olamaz','numeric' => '%s  Sayısal Olmalıdır'));


            if ($this->form_validation->run() == TRUE)
            {
                $this->birim_model->birim_ekle($tip,$yeterlilikid,$this->input->post());
                $this->session->set_flashdata('success', 'Başarıyla Kaydedildi');

                redirect('yeterlilik/birim/birimler/'.$tip."/".$yeterlilikid);
            }
        }

        $this->db->where('id', $yeterlilikid);
        $result = $this->db->get('yeterlilikler')->row();

        switch ($tip)
        {
            case "zorunlu": $baslik = $result->kod." / ".$result->ad." YENİ ZORUNLU BİRİM"; break;
            case "secmeli": $baslik = $result->kod." / ".$result->ad." YENİ SEÇMELİ BİRİM"; break;
        }
        $form = array(
            array('id' => 'kod','name' => 'kod','label' => 'Birim Kodu','value' => set_value('kod'),'placeholder' => 'Birim Kodu','type' => 'text','required' => 'false','class' => 'form-control'),
            array('id' => 'ad','name' => 'ad','label' => 'Birim Adı','value' => set_value('ad'),'placeholder' => 'Birim Adı','type' => 'text','required' => 'false','class' => 'form-control'),
            array('id' => 'fiyat','name' => 'fiyat','label' => 'Fiyat','value' => set_value('fiyat'),'placeholder' => 'Fiyat','type' => 'text','required' => 'false','class' => 'form-control'),

        );
        $this->load->view('admin_layout', array('view' => 'birim/yeni','data' => array('baslik' => $baslik,'form' => createForm($form))));
    }

    public function sil($id,$tip,$yeterlilikid)
    {
        $this->db->where('yeterlilik', $yeterlilikid);
        $this->db->where('tip', $tip);
        $this->db->where('id', $id);
        $this->db->delete('birimler');
        $this->session->set_flashdata('success', 'Başarıyla Silindi');
        redirect('yeterlilik/birim/birimler/'.$tip.'/'.$yeterlilikid);
    }



}
