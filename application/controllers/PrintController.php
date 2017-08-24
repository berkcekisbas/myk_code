<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrintController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library("Pdf");
        $this->load->helper('toolchain_helper');
        $this->load->library("sinavreport");
    }

    public function _soru_cek($id)
    {
        $soru = $this->db->get_where('teoriksorular', array('id' => $id))->row();

        $data = NULL;

        $data .= $soru->soru."<br>";

        if($soru->soruresim != NULL) {$data .= '<img height="75" width="75" src="'.base_url()."/uploads/".$soru->soruresim.'">'; }
        $data .= "<br>";

        if($soru->A != "") {$data .= "<b>a)</b> ".$soru->A."<br>";}
        if($soru->Aresim != NULL) {$data .= '<img height="75" width="75" src="'.base_url()."/uploads/".$soru->Aresim.'">'; }
        if($soru->B != "") {$data .= "<b>b)</b> ".$soru->B."<br>";}
        if($soru->Bresim != NULL) {$data .= '<img height="75" width="75" src="'.base_url()."/uploads/".$soru->Bresim.'">'; }
        if($soru->C != "") {$data .= "<b>c)</b> ".$soru->C."<br>";}
        if($soru->Cresim != NULL) {$data .= '<img height="75" width="75" src="'.base_url()."/uploads/".$soru->Cresim.'">'; }
        if($soru->D != "") {$data .= "<b>d)</b> ".$soru->D."<br>";}
        if($soru->Dresim != NULL) {$data .= '<img height="75" width="75" src="'.base_url()."/uploads/".$soru->Dresim.'">'; }
        if($soru->E != "") {$data .= "<b>e)</b> ".$soru->E."<br>";}
        if($soru->Eresim != NULL) {$data .= '<img height="75" width="75" src="'.base_url()."/uploads/".$soru->Eresim.'">'; }

        return $data;
    }

    public function cevap_form_yazdir($sinav_id,$basvuru_id,$anahtar)
    {

      $basvuru = $this->db->get_where('basvuru', array('id' => $basvuru_id))->row();
      $yeterlilik = $this->db->get_where('yeterlilikler', array('id' => $basvuru->yeterlilikid))->row();

      $sorusablon = json_decode($yeterlilik->sorusablon,true);


      foreach (json_decode($basvuru->birimler) as $birim) {

        $birimx = $this->db->get_where('birimler', array('id' => $birim))->row();


        $data[] = array('kod' => $birimx->kod,'id' => $birimx->id,'sorusayisi' => $sorusablon['sorusayisi'][$birimx->id][0]);
      }

  
      $this->sinavreport->cevap_form($data,$anahtar);
    }




    public function soru_form_yazdir($sinav_id,$basvuru_id)
    {

      $sinav = $this->db->get_where('sinavlar', array('id' => $sinav_id))->row();
      $basvuru = $this->db->get_where('basvuru', array('id' => $basvuru_id))->row();
      $yeterlilik = $this->db->get_where('yeterlilikler', array('id' => $basvuru->yeterlilikid))->row();
      $sinavyeri = $this->db->get_where('sinavyerleri', array('id' => $sinav->sinavyeri_id))->row();

      $sorusablon = json_decode($yeterlilik->sorusablon,true);


      $sorusayisi = 0;


      foreach (json_decode($basvuru->birimler) as $birim) {

        $sorusayisi = $sorusablon['sorusayisi'][$birim][0] + $sorusayisi;

        $birim_bilgi = $this->db->get_where('birimler', array('id' => $birim))->row();

        $aday_sorular = $this->db->order_by('sira', 'ASC')->get_where('teorik_sinav_sorular', array('basvuru_id' => $basvuru_id,'birim' => $birim))->result();

        foreach ($aday_sorular as $aday_soru) {
          $sorular2[] = array('sira' => $aday_soru->sira,'soru' => $this->_soru_cek($aday_soru->soru_id));
        }
        
        $sorular[] = array('birim' => $birim_bilgi->kod,'sorusayisi' => $sorusablon['sorusayisi'][$birim][0],'sorular' => $sorular2);
        unset($sorular2);

        
        
      }
       
      $array = array(
            "yeterlilikad" => $yeterlilik->ad,
            "yeterlilikseviye" => $yeterlilik->seviye,
            "sinavid" => $sinav->sinavid,
            "sorusayisi" => $sorusayisi,
            "sure" => $sorusayisi * 1.5,
            "tarih" => date("d-m-Y",strtotime($sinav->sinavtarihi)),
            "saat" => $sinav->sinavsaati,
            "sinavyeri" => $sinavyeri->ad,
            "adsoyad" => $basvuru->adsoyad,
            "tc" => $basvuru->tckimlik,
            );
 
      $data = (object) $array;

 

      /** /
      foreach ($sorular as $key) {
        echo $key['birim'];
        # code...
      }
      /**/

      $this->sinavreport->aday_sorular($data,$sorular);
    }
}
