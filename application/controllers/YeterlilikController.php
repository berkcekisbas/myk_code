<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class YeterlilikController extends CI_Controller {

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

    public function liste()
    {
        $this->load->view('admin_layout',array('view' => 'yeterlilik/liste','data' => array('baslik' => 'Yeterlilikler','yeterlilikler' => $this->yeterlilik_model->yeterlilikler())));
    }

    public function yeni()
    {
        if($this->input->post())
        {
            
            $this->form_validation->set_rules('kod', 'Yeterlilik Kodu', 'required',array('required' => '%s  Boş Olamaz'));
           /*
            $this->form_validation->set_rules('ad', 'Yeterlilik Adı', 'required',array('required' => '%s  Boş Olamaz'));
            $this->form_validation->set_rules('seviye', 'Seviye', 'required|is_natural',array('required' => '%s  Boş Olamaz','is_natural' => '%s  Sayısal Olmalıdır'));
            $this->form_validation->set_rules('sektor', 'Sektör', 'required',array('required' => '%s  Boş Olamaz'));
            $this->form_validation->set_rules('revizyon', 'Revizyon', 'required|is_natural',array('required' => '%s  Boş Olamaz','is_natural' => '%s  Sayısal Olmalıdır'));
            $this->form_validation->set_rules('onaytarihi', 'Onay Tarihi', 'required|callback_checkDateFormat',array('required' => '%s  Boş Olamaz','checkDateFormat' => 'Lütfen geçerli Bir %s Girin'));
            $this->form_validation->set_rules('onaysayisi', 'Onay Sayısı', 'required',array('required' => '%s  Boş Olamaz'));
            */

            if ($this->form_validation->run() == TRUE)
            {
                echo "asdf";
                $this->yeterlilik_model->yeterlilik_ekle($this->input->post());
                $this->session->set_flashdata('success', 'Başarıyla Kaydedildi');

                redirect('yeterlilik/yeterlilikler');
            }
        }

        $form = array(
            array('id' => 'kod','name' => 'kod','label' => 'Yeterlilik Kodu','value' => set_value('kod'),'placeholder' => 'Standart Kodu','type' => 'text','required' => 'false','class' => 'form-control'),
            array('id' => 'ad','name' => 'ad','label' => 'Yeterlilik Adı','value' => set_value('ad'),'placeholder' => 'Standart Adı','type' => 'text','required' => 'false','class' => 'form-control'),
            array('id' => 'seviye','name' => 'seviye','label' => 'Seviye','value' => set_value('seviye'),'placeholder' => 'Seviye','type' => 'text','required' => 'false','class' => 'form-control mask_number','helpblock' => 'Sadece rakam giriniz.'),
            array('id' => 'revizyon','name' => 'revizyon','label' => 'Revizyon','value' => set_value('revizyon'),'placeholder' => 'Revizyon','type' => 'text','required' => 'false','class' => 'form-control mask_number','helpblock' => 'Sadece rakam giriniz.'),
            array('id' => 'sektor','name' => 'sektor','label' => 'Sektör','value' => set_value('sektor'),'placeholder' => 'Sektör','type' => 'text','required' => 'false','class' => 'form-control'),
            array('id' => 'onaytarihi','name' => 'onaytarihi','label' => 'Onay Tarihi','value' => set_value('onaytarihi'),'placeholder' => 'Onay Tarihi','type' => 'text','required' => 'false','class' => 'form-control mask_date2'),
            array('id' => 'onaysayisi','name' => 'onaysayisi','label' => 'Onay Sayısı','value' => set_value('onaysayisi'),'placeholder' => 'Onay Sayısı','type' => 'text','required' => 'false','class' => 'form-control'),
            array('id' => 't1sorusayisi','name' => 't1sorusayisi','label' => 'T1 Soru Sayısı','value' => set_value('t1sorusayisi'),'placeholder' => 'T1 Soru Sayısı','type' => 'text','required' => 'false','class' => 'form-control'),
            array('id' => 't2sorusayisi','name' => 't2sorusayisi','label' => 'T2 Soru Sayısı','value' => set_value('t2sorusayisi'),'placeholder' => 'T2 Soru Sayısı','type' => 'text','required' => 'false','class' => 'form-control','helpblock' => 'T2 mevcut değil ise boş bırakınız.'),

            array('id' => 't1gecmepuani','name' => 't1gecmepuani','label' => 'T1 Geçme Puanı','value' => set_value('t1gecmepuani'),'placeholder' => 'T1 Geçme Puanı','type' => 'text','required' => 'false','class' => 'form-control'),
            array('id' => 't2gecmepuani','name' => 't2gecmepuani','label' => 'T2 Geçme Puanı','value' => set_value('t2gecmepuani'),'placeholder' => 'T2 Geçme Puanı','type' => 'text','required' => 'false','class' => 'form-control','helpblock' => 'T2 mevcut değil ise boş bırakınız.'),

            array('id' => 'belgegecerliliksuresi','name' => 'belgegecerliliksuresi','label' => 'Belge Geçerlilik Süresi','value' => set_value('belgegecerliliksuresi'),'placeholder' => 'Belge Geçerlilik Süresi','type' => 'select','required' => 'false','class' => 'form-control','option' => array( array('1','1 Yıl'),array('2','2 Yıl'),array('3','3 Yıl'),array('4','4 Yıl'),array('5','5 Yıl'))),

        );

        $this->load->view('admin_layout', array('view' => 'yeterlilik/yeni','data' => array('baslik' => 'baslik','form' => createForm($form))));
    }

    public function duzenle($id)
    {

        if($this->input->post())
        {
            $this->form_validation->set_rules('kod', 'Yeterlilik Kodu', 'required',array('required' => '%s  Boş Olamaz'));
            $this->form_validation->set_rules('ad', 'Yeterlilik Adı', 'required',array('required' => '%s  Boş Olamaz'));
            $this->form_validation->set_rules('seviye', 'Seviye', 'required|is_natural',array('required' => '%s  Boş Olamaz','is_natural' => '%s  Sayısal Olmalıdır'));
            $this->form_validation->set_rules('sektor', 'Sektör', 'required',array('required' => '%s  Boş Olamaz'));
            $this->form_validation->set_rules('revizyon', 'Revizyon', 'required|is_natural',array('required' => '%s  Boş Olamaz','is_natural' => '%s  Sayısal Olmalıdır'));
            $this->form_validation->set_rules('onaytarihi', 'Onay Tarihi', 'required|callback_checkDateFormat',array('required' => '%s  Boş Olamaz','checkDateFormat' => 'Lütfen geçerli Bir %s Girin'));
            $this->form_validation->set_rules('onaysayisi', 'Onay Sayısı', 'required',array('required' => '%s  Boş Olamaz'));

            if ($this->form_validation->run() == TRUE)
            {
                $this->yeterlilik_model->yeterlilik_duzenle($this->input->post(),$id);
                $this->session->set_flashdata('success', 'Başarıyla Kaydedildi');
                redirect('yeterlilik/yeterlilikler');
            }
        }

                  $this->db->where('id', $id);
        $result = $this->db->get('yeterlilikler')->row();


        $form = array(
            array('id' => 'kod','name' => 'kod','label' => 'Yeterlilik Kodu','value' => $result->kod,'placeholder' => 'Standart Kodu','type' => 'text','required' => 'false','class' => 'form-control'),
            array('id' => 'ad','name' => 'ad','label' => 'Yeterlilik Adı','value' => $result->ad,'placeholder' => 'Standart Adı','type' => 'text','required' => 'false','class' => 'form-control'),
            array('id' => 'seviye','name' => 'seviye','label' => 'Seviye','value' => $result->seviye,'placeholder' => 'Seviye','type' => 'text','required' => 'false','class' => 'form-control mask_number','helpblock' => 'Sadece rakam giriniz.'),
            array('id' => 'revizyon','name' => 'revizyon','label' => 'Revizyon','value' => $result->revizyon,'placeholder' => 'Revizyon','type' => 'text','required' => 'false','class' => 'form-control mask_number','helpblock' => 'Sadece rakam giriniz.'),
            array('id' => 'sektor','name' => 'sektor','label' => 'Sektör','value' => $result->sektor,'placeholder' => 'Sektör','type' => 'text','required' => 'false','class' => 'form-control'),
            array('id' => 'onaytarihi','name' => 'onaytarihi','label' => 'Onay Tarihi','value' => date("d-m-Y",strtotime($result->onaytarihi)),'placeholder' => 'Onay Tarihi','type' => 'text','required' => 'false','class' => 'form-control mask_date2'),
            array('id' => 'onaysayisi','name' => 'onaysayisi','label' => 'Onay Sayısı','value' => $result->onaysayisi,'placeholder' => 'Onay Sayısı','type' => 'text','required' => 'false','class' => 'form-control'),
            array('id' => 'belgegecerliliksuresi','name' => 'belgegecerliliksuresi','label' => 'Belge Geçerlilik Süresi','value' => $result->belgegecerliliksuresi,'placeholder' => 'Belge Geçerlilik Süresi','type' => 'select','required' => 'false','class' => 'form-control','option' => array( array('1','1 Yıl'),array('2','2 Yıl'),array('3','3 Yıl'),array('4','4 Yıl'),array('5','5 Yıl'))),

        );

        $this->load->view('admin_layout', array('view' => 'yeterlilik/duzenle','data' => array('baslik' => 'baslik','form' => createForm($form))));
    }

    public function sil($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('yeterlilikler');

        $this->session->set_flashdata('success', 'Başarıyla Silindi');
        redirect('yeterlilik/yeterlilikler');
    }

    public function durum($id,$durum)
    {
        $data = array(
            'aktif' => $durum
        );

        $this->db->where('id', $id);
        $this->db->update('yeterlilikler', $data);
        $this->session->set_flashdata('success', 'Durum Başarıyla Güncellendi');
        redirect('yeterlilik/yeterlilikler');

    }

    public function sorusablonu($id)
    {
        if($this->input->post())
        {
            $this->db->where('id', $id);
            $this->db->update('yeterlilikler', array('sorusablon' => json_encode($this->input->post()))); 
            $this->session->set_flashdata('success', 'Şablon Başarıyla Kaydedildi');
                redirect('yeterlilik/yeterlilikler');
        }

            $this->db->where('id', $id);
            $result = $this->db->get('yeterlilikler')->row();

            $this->db->where('yeterlilik', $id);
            $birimler = $this->db->get('birimler')->result();

            $this->load->view('admin_layout', array('view' => 'yeterlilik/sorusablonu','data' => array('baslik' => $result->kod." ".$result->ad." REV ".$result->revizyon.' / Soru Şablonu','birimler' => $birimler)));
    }

    public function basarimolcut_liste($yeterlilik,$birim,$tip)
    {
        $basarimolcutleri = $this->db->get_where('basarimolcutleri', array('yeterlilik_id' => $yeterlilik,'birim_id' => $birim,'tip' => $tip))->result();

        echo '<option selected value="">Seçiniz</option>';
        foreach ($basarimolcutleri as $basarimolcutu) {
             echo '<option value = "'.$basarimolcutu->id.'">'.$basarimolcutu->basarimolcutu.'</option>';
        }
    }

    public function basarimolcutleri($id)
    {
        $this->db->where('id', $id);
        $result = $this->db->get('yeterlilikler')->row();

        $this->db->where('yeterlilik_id', $id);
        $basarimolcutleri = $this->db->get('basarimolcutleri')->result();


        $this->load->view('admin_layout',array('view' => 'basarimolcut/liste','data' => array('baslik' => $result->ad.' / Başarım Ölçütleri','results' => $basarimolcutleri)));
    }

    public function yenibasarimolcutu($id)
    {
         if($this->input->post())
        {
            $data = array(
               'yeterlilik_id' => $id ,
               'birim_id' => $this->input->post('birim') ,
               'tip' => $this->input->post('tip') ,
               'basarimolcutu' => $this->input->post('basarimolcutu')
            );
            $this->db->insert('basarimolcutleri', $data); 
            $this->session->set_flashdata('success', 'Başarıyla Kaydedildi');
            redirect('yeterlilik/basarimolcutleri/'.$id);
        }

        $this->db->where('yeterlilik', $id);
        $birimler = $this->db->get('birimler')->result();

        $this->db->where('id', $id);
        $result = $this->db->get('yeterlilikler')->row();

        $this->load->view('admin_layout',array('view' => 'basarimolcut/yeni','data' => array('baslik' => $result->ad.' / Yeni Başarım Ölçütü','birimler' => $birimler)));
    }
}
