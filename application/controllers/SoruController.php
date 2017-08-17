<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SoruController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function liste()
    {                    $this->db->select('*,teoriksorular.id AS soruid,birimler.ad AS birimad,yeterlilikler.ad AS yeterlilikad');
                         $this->db->join('birimler', 'birimler.id = teoriksorular.birim');
                         $this->db->join('yeterlilikler', 'yeterlilikler.id = teoriksorular.yeterlilik');
        $teoriksorular = $this->db->get('teoriksorular')->result();

        $this->load->view('admin_layout',array('view' => 'soru/liste','data' => array('baslik' => 'Teorik Sorular','teoriksorular' => $teoriksorular)));
    }

    public function yeni()
    {

      

        if($this->input->post())
        {
            $upload = TRUE;
             $this->form_validation->set_rules('yeterlilik', 'Yeterlilik', 'required',array('required' => '%s  Boş Olamaz'));


            if ($this->form_validation->run() == TRUE)
            {

              $soruresim_name = NULL;
              $Aresim_name = NULL;
              $Bresim_name = NULL;
              $Cresim_name = NULL;
              $Dresim_name = NULL;
              $Eresim_name = NULL;


               $config['upload_path']='uploads/';
               $config['allowed_types']="jpg|jpeg|gif|png";
               $config['file_name']='picture_'.date('Y-m-d')."_".rand(1,10000);
               $config['overwrite']=FALSE;
               $config['max_width']=100000;
               $config['max_height']=100000;
               $config['max_size']=2000000 ;// lets you upload 2 mb file size.

                $this->load->library('upload',$config);


                if(!empty($_FILES['soruresim']['name']))
                {
                    $soruresim = $this->upload->do_upload('soruresim');
                    $up = $this->file_inf=$name=$this->upload->data();
                    $soruresim_name = $up['file_name'];
                    if(!$soruresim)
                    {
                      $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                      $upload = FALSE;
                    }
                }

                if(!empty($_FILES['Aresim']['name']))
                {
                    $Aresim = $this->upload->do_upload('Aresim');
                    $up = $this->file_inf=$name=$this->upload->data();
                    $Aresim_name = $up['file_name'];
                    if(!$Aresim)
                    {
                      $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                      $upload = FALSE;
                    }
                }

                if(!empty($_FILES['Bresim']['name']))
                {
                    $Bresim = $this->upload->do_upload('Bresim');
                    $up = $this->file_inf=$name=$this->upload->data();
                    $Bresim_name = $up['file_name'];
                    if(!$Bresim)
                    {
                      $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                      $upload = FALSE;
                    }
                }

                if(!empty($_FILES['Cresim']['name']))
                {
                    $Cresim = $this->upload->do_upload('Cresim');
                    $up = $this->file_inf=$name=$this->upload->data();
                    $Cresim_name = $up['file_name'];
                    if(!$Cresim)
                    {
                      $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                      $upload = FALSE;
                    }
                }

                if(!empty($_FILES['Dresim']['name']))
                {
                    $Dresim = $this->upload->do_upload('Dresim');
                    $up = $this->file_inf=$name=$this->upload->data();
                    $Dresim_name = $up['file_name'];
                    if(!$Dresim)
                    {
                      $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                      $upload = FALSE;
                    }
                }

                if(!empty($_FILES['Eresim']['name']))
                {
                    $Eresim = $this->upload->do_upload('Eresim');
                    $up = $this->file_inf=$name=$this->upload->data();
                    $Eresim_name = $up['file_name'];
                    if(!$Eresim)
                    {
                      $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                      $upload = FALSE;
                    }
                }
                

                
                if($upload == TRUE)
                {

                    $data = array(
                       'yeterlilik' => $this->input->post('yeterlilik'),
                       'basarimolcutu' => $this->input->post('basarimolcut'),
                       'birim' => $this->input->post('birim') ,
                       'zorluk' => $this->input->post('zorluk'),
                       'soruresim' => $soruresim_name,
                       'soru' => $this->input->post('soru'),
                       'A' => $this->input->post('a'),
                       'Aresim' => $Aresim_name,
                       'B' => $this->input->post('b'),
                       'Bresim' => $Bresim_name,
                       'C' => $this->input->post('c'),
                       'Cresim' => $Cresim_name,
                       'D' => $this->input->post('d'),
                       'Dresim' => $Dresim_name,
                       'E' => $this->input->post('e'),
                       'Eresim' => $Eresim_name,
                       'dogrucevap' => $this->input->post('dogrucevap'),
                       'eklemetarihi' => date('Y-m-d H:i:s'),
                       'ekleyen' => "user_id",
                    );

                    $this->db->insert('teoriksorular', $data); 
                    $this->session->set_flashdata('success', 'Başarıyla Kaydedildi');
                    redirect('soru/teorik/liste');
                }
                

                
                
                
            }

            
        }


        $yeterlilikler = $this->db->get_where('yeterlilikler', array('aktif' => 1))->result();

        $this->load->view('admin_layout',array('view' => 'soru/yeni','data' => array('baslik' => 'Yeni Soru','yeterlilikler' => $yeterlilikler)));
    }

    public function birim_liste($yeterlilik)
    {
        $birimler = $this->db->get_where('birimler', array('yeterlilik' => $yeterlilik))->result();

        echo '<option selected value="">Seçiniz</option>';
        foreach ($birimler as $birim) {
             echo '<option value = "'.$birim->id.'">'.$birim->kod.'-'.$birim->ad.'</option>';
        }
    }

    public function do_upload($name)
        {
               
               $config['upload_path']='uploads/';
               $config['allowed_types']="jpg|jpeg|gif|png";
               $config['file_name']='picture_'.date('Y-m-d')."_".rand(1,100);
               $config['overwrite']=FALSE;
               $config['max_width']=100000;
               $config['max_height']=100000;
               $config['max_size']=20 ;// lets you upload 2 mb file size.

                  $this->load->library('upload',$config);
                  $uploaded=$this->upload->do_upload('soruresim');
                  $this->file_inf=$name=$this->upload->data();

                  if($uploaded)
                  {
                    return true;
                          }
                          else
                            {
                                   echo $this->upload->display_errors();

                                   }
                                   

        }

}
