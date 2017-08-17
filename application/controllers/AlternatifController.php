<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AlternatifController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function liste($yeterlilikid)
    {
        $baslik = NULL;

        $this->db->where('id', $yeterlilikid);
        $result = $this->db->get('yeterlilikler')->row();

        $baslik = $result->kod." / ".$result->ad." YETERLİLİK BİRİM ALTERNATİFLERİ";
        $this->load->view('admin_layout',array('view' => 'birim/alternatifler','data' => array('baslik' => $baslik,'results' => $this->alternatif_model->alternatifler($yeterlilikid))));
    }

    public function yeni($yeterlilikid)
    {
        $baslik = NULL;

        if($this->input->post())
        {
            $this->form_validation->set_rules('ad', 'Birim Adı', 'required',array('required' => '%s  Boş Olamaz'));
            $this->form_validation->set_rules('birimler[]', 'Birimler', 'required',array('required' => '%s  Boş Olamaz'));


            if ($this->form_validation->run() == TRUE)
            {
                // bu kısımda çoktan seçmeli input da seçilen birimler döndürülüp farklı tabloya kaydettirilecek. bu işlem model de yapılacak

                $this->alternatif_model->alternatif_ekle($yeterlilikid,$this->input->post(),$this->input->post('birimler'));

                $this->session->set_flashdata('success', 'Başarıyla Kaydedildi');

                redirect('yeterlilik/birim/birimler/alternatif/'.$yeterlilikid);

            }
        }

        $this->db->where('yeterlilik', $yeterlilikid);
        $birimler = $this->db->get('birimler')->result_array();



        $this->db->where('id', $yeterlilikid);
        $result = $this->db->get('yeterlilikler')->row();
        $baslik = $result->kod." / ".$result->ad." YENİ BİRİM ALTERNATİF";


        $form = array(
            array('id' => 'ad','name' => 'ad','label' => 'Alternatif Adı','value' => set_value('ad'),'placeholder' => 'Alternatif Adı','type' => 'text','required' => 'false','class' => 'form-control'),
            array('id' => 'birimler','name' => 'birimler[]','label' => 'Birimler','value' => set_value('ad'),'placeholder' => 'Birimler','type' => 'multiselect','required' => 'false','class' => 'form-control select2-multiple','option' => $birimler),

        );
        $this->load->view('admin_layout', array('view' => 'alternatif/yeni','data' => array('baslik' => $baslik,'form' => createForm($form))));
    }





}
