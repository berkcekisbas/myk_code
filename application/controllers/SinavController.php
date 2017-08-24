<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SinavController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library("Pdf");
        $this->load->helper('toolchain_helper');
        $this->load->library("sinavreport");
    }


    public function yazdir($sinav_id,$basvuru_id)
    {
      $this->sinavreport->aday_sorular();
    }

    public function yeni_sinav()
    {

        if($this->input->post())
        {

            //sınav oluştuktan sonra adayın durumunu değiştir.

             $this->form_validation->set_rules('yeterlilik', 'Yeterlilik', 'required',array('required' => '%s  Boş Olamaz'));
             $this->form_validation->set_rules('sinavid', 'Sınav ID', 'required',array('required' => '%s  Boş Olamaz'));

            if ($this->form_validation->run() == TRUE)
            {
      
                $data = array(
                    'tip' => $this->input->post('tip'),
                    'yeterlilik_id' => $this->input->post('yeterlilik'),
                    'sinavid' => $this->input->post('sinavid'),
                    'sinavtarihi' => date("Y-m-d",strtotime(str_replace("/","-",$this->input->post('sinavtarihi')))),
                    'sinavsaati' => $this->input->post('sinavsaati'),
                    'sinavyeri_id' => $this->input->post('sinavyeri'),
                    'gozetmen' => json_encode($this->input->post('gozetmen')),
                    'degerlendirici' => json_encode($this->input->post('degerlendirici')),
                    'basvuru' => json_encode($this->input->post('basvuru')),
                    'create_date' => date("Y-m-d H:i:s")
                );

                $this->db->insert('sinavlar', $data); 
                $sinavid = $this->db->insert_id();

                // adaylar sınava atandıktan sonra sinavatandi stununu 1 yaprak başvurunun bir sınava atandığını gösterir.
                // sinav_atama tablosuna başvurunun atandığı sınavlar girilecek ve başvuru nun durumları buradaki tablodan görülecek.

                foreach($this->input->post('basvuru') as $basvuru) {

            
                $this->db->insert('sinav_atama', array('basvuru_id' => $basvuru,'sinav_id' => $sinavid)); 

                $this->db->where('id', $basvuru);
                $this->db->update('basvuru', array('onay' => 2)); 

                }

                $this->session->set_flashdata('success', 'Başarıyla Kaydedildi');
                redirect('sinav/yeni');
            } else 
            {
                $this->session->set_flashdata('error', validation_errors('<i class="fa fa-ban"></i> ',''));
                redirect('sinav/yeni');
            }
            
        }

        $komisyonlar = $this->db->get('komisyonlar')->result();

        $sinavyerleri = $this->db->get('sinavyerleri')->result();

        $yeterlilikler = $this->db->get_where('yeterlilikler', array('aktif' => 1))->result();

        $this->load->view('admin_layout',array('view' => 'sinav/yeni','data' => array('baslik' => 'Yenİ Sınav','yeterlilikler' => $yeterlilikler,'sinavyerleri' => $sinavyerleri,'komisyonlar' => $komisyonlar)));
    }


    public function liste_teorik($aktif)
    {

       $this->db->select('*,
            yeterlilikler.kod AS yeterlilik_kod,
            yeterlilikler.seviye AS yeterlilik_seviye,
            ,yeterlilikler.revizyon AS yeterlilik_revizyon,
            yeterlilikler.ad AS yeterlilik_ad,
            sinavyerleri.ad AS sinavyeri_ad,
            sinavlar.id AS sinav_id
            ');
        $this->db->from('sinavlar');
        $this->db->join('yeterlilikler', 'sinavlar.yeterlilik_id = yeterlilikler.id');
        $this->db->join('sinavyerleri', 'sinavlar.sinavyeri_id = sinavyerleri.id');

        $this->db->where('tip', "T");
        $this->db->where('sinavlar.aktif', $aktif);
        $sinavlar = $this->db->get()->result();

        $this->load->view('admin_layout',array('view' => 'sinav/liste','data' => array('baslik' =>  'AKTİF TEORİK SINAVLAR','sinavlar' => $sinavlar)));
    }

    public function detay_teorik($id)
    {
        

        $this->db->select('*,sinavyerleri.ad AS sinavyeri_ad,sinavlar.id AS sinav_id');
        $this->db->from('sinavlar');
        $this->db->join('sinavyerleri', 'sinavlar.sinavyeri_id = sinavyerleri.id');

        $this->db->where('tip', "T");
        $this->db->where('sinavlar.id', $id);
        $sinav = $this->db->get()->row();

        $tarih = date("d-m-Y",strtotime($sinav->sinavtarihi));
        $degerlendirici = komisyonlar($sinav->degerlendirici);
        $gozetmen = komisyonlar($sinav->gozetmen);
       
        $i = 1;

        foreach (json_decode($sinav->basvuru) as $id) {

            $aday = $this->db->get_where('basvuru', array('id' => $id))->row();

            $adaylar[] = array('id' => $aday->id, 'adsoyad' => $aday->adsoyad, 'tckimlik' => $aday->tckimlik);
            
            $i++;
        }

        $data['baslik'] = "SINAV DETAYI";
        $data['sinav'] = $sinav;
        $data['tarih'] = $tarih;
        $data['gozetmen'] = $gozetmen;
        $data['degerlendirici'] = $degerlendirici;
        $data['adaylar'] = $adaylar;


        $this->load->view('admin_layout',array('view' => 'sinav/teorik_detay','data' => $data));
    }

    public function _sorucek($limit,$birim,$basvuru_id,$sinav_id,$sira)
    {


                     $this->db->limit($limit);
                     $this->db->order_by($limit,'RANDOM');
                     $this->db->where('birim', $birim);
                     $this->db->group_by("basarimolcutu");
            $query = $this->db->get('teoriksorular');
            $sorular = $query->result();

            
            foreach ($sorular as $soru) {

              $s1 = $this->db->order_by('id','RANDOM')->get_where('teoriksorular', array('birim' => $birim,'basarimolcutu' => $soru->basarimolcutu))->row();



              $this->db->insert('teorik_sinav_sorular', array('sira' => $sira,'birim' => $birim,'basvuru_id' => $basvuru_id,'sinav_id' => $sinav_id,'basarimolcut_id' => $s1->basarimolcutu,'soru_id' => $s1->id));

              $sira++;
            }

      return $query->num_rows();






    }

    public function _sorucek_kontrol($sinav_id,$basvuru_id)
    {
               $this->db->where('basvuru_id',$basvuru_id);
               $this->db->where('sinav_id', $sinav_id);
      $query = $this->db->get('teorik_sinav_sorular');
      $query->result();

      if($query->num_rows() > 0 )
      {
        return TRUE;
      } else { return FALSE;}
    }

    public function _teorik_soru_olustur($sinav_id,$basvuru_id)
    {
       /*
          Teorik soru için gerekli sql cümlesi.
          SELECT * FROM teoriksorular WHERE birim = 10 GROUP BY basarimolcutu ORDER BY RAND() LIMIT 3
        */

          /*
            1 - başvuru bigileri.
            2 - başvuru yapanın yeterlilik bilgileri
            3 - başvuru yapanın yeterliliğinin soru sayıları.
          */
          // önce başvuru sahibi bilgileri alınsın.

            // soruçek kontro lile kontrol et


          $basvuru    = $this->db->get_where('basvuru', array('id' => $basvuru_id))->row();
          $yeterlilik = $this->db->get_where('yeterlilikler', array('id' => $basvuru->yeterlilikid))->row();
          $sorusablon = json_decode($yeterlilik->sorusablon,true);


          //print_r($sorusablon);

          //echo $sorusablon['sorusayisi'][10][0];

          foreach (json_decode($basvuru->birimler,true) as $birim)
          {
            $sorusayisi = $sorusablon['sorusayisi'][$birim][0];

            $sorucek = $this->_sorucek($sorusayisi,$birim,$basvuru_id,$sinav_id,1);

                    

            if($sorucek < $sorusayisi)
            {
                $yenisayi = $sorusayisi - $sorucek;

                $this->_sorucek($yenisayi,$birim,$basvuru_id,$sinav_id,$sorucek + 1 );
            }
          }
    }

    public function teorik_soruhazirla($sinav_id,$basvuru_id)
    {

      if($this->_sorucek_kontrol($sinav_id,$basvuru_id) == FALSE)
      {
        $this->_teorik_soru_olustur($sinav_id,$basvuru_id);
      }

      /*
        Sınav bilgileri
        Toplam soru sayısı
        sınav süresi soru sayısı x 1.5 dakika olarka hespala.
        aday bilgileri.
      */
      

      $this->session->set_flashdata('success', 'Sorular Başarıyla Tanımlandı.');

      redirect('sinav/detay/teorik/'.$sinav_id);

    }

    public function teorik_adaylistesi($id)
    {

 
      $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
      $pdf->SetCreator(PDF_CREATOR);
      $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "SINAVA GİRECEK ADAYLAR LİSTESİ", "FR.21/20.01.2017/REV.00");
      $pdf->setHeaderFont(Array("dejavusans", '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
      if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
      require_once(dirname(__FILE__).'/lang/eng.php');
      $pdf->setLanguageArray($l);
      }

      // add a page
      $pdf->AddPage();

      $pdf->SetFont('dejavusans', '',10);


        $this->db->select('*,
            yeterlilikler.kod AS yeterlilik_kod,
            yeterlilikler.seviye AS yeterlilik_seviye,
            yeterlilikler.revizyon AS yeterlilik_revizyon,
            yeterlilikler.ad AS yeterlilik_ad,
            sinavyerleri.ad AS sinavyeri_ad,
            sinavlar.id AS sinav_id
            ');
        $this->db->from('sinavlar');
        $this->db->join('yeterlilikler', 'sinavlar.yeterlilik_id = yeterlilikler.id');
        $this->db->join('sinavyerleri', 'sinavlar.sinavyeri_id = sinavyerleri.id');

        $this->db->where('tip', "T");
        $this->db->where('sinavlar.id', $id);
        $sinavlar = $this->db->get()->row();

        $tarih = date("d-m-Y",strtotime($sinavlar->sinavtarihi));
        $degerlendirici = komisyonlar($sinavlar->degerlendirici);
        $gozetmen = komisyonlar($sinavlar->gozetmen);
        $adaylar = NULL;
        $i = 1;



        foreach (json_decode($sinavlar->basvuru) as $id) {

            $aday = $this->db->get_where('basvuru', array('id' => $id))->row();


            $adaylar .= '<tr align = "center">
                         <td> '.$i.' </td>
                         <td> '.$aday->adsoyad.' </td>
                         <td> '.$aday->id.' </td>
                         <td> '.$aday->tckimlik.' </td>
                         <td> </td>     
                         </tr>';
            $i++;
        }



    $tbl = <<<EOD
    <table width="100%" border="1" cellpadding="3" cellspacing="0" align="LEFT">
     <tr>
      <td width="25%"> <b>Sınav Yeterlilik Adı :</b> </td>
      <td width="75%"> $sinavlar->yeterlilik_kod / $sinavlar->yeterlilik_ad SEVİYE $sinavlar->yeterlilik_seviye REV : $sinavlar->yeterlilik_revizyon</td>
     </tr>
    <tr>
      <td width="25%"> <b>Sınav Tarihi / Saati :</b> </td>
      <td width="25%"> $tarih / $sinavlar->sinavsaati</td>
      <td width="25%"> <b>Sınav Merkezi :</b></td>
      <td width="25%"> $sinavlar->sinavyeri_ad</td>
    </tr>
    <tr>
      <td width="25%"> <b>Sınav ID :</b> </td>
      <td width="25%"> $sinavlar->sinavid</td>
      <td width="25%"> <b>Sınav Türü :</b></td>
      <td width="25%"> Yazılı / Teorik </td>
    </tr>
     <tr>
      <td width="25%"> <b>Değerlendirici :</b> </td>
      <td width="75%"> $degerlendirici</td>
     </tr>
      <tr>
      <td width="25%"> <b>Gözetmen :</b> </td>
      <td width="75%"> $gozetmen</td>
     </tr>
    </table>
EOD;

    $pdf->writeHTML($tbl, true, false, false, false, '');


    $tbl = <<<EOD
    <table width="100%" border="1" cellpadding="3" cellspacing="0" align="LEFT">
     <tr align = "center">
      <td width="%5"> <b>Sn</b> </td>
      <td width="30%"> <b>Aday Ad Soyad</b> </td>
      <td width="15%"> <b>Aday No</b> </td>
      <td width="20%"> <b>TC No</b> </td>
      <td  width="30%"> <b>İmza</b></td>     
     </tr>

     $adaylar

    </table>


    <p>
    Not : Aday, sınava katılmış ise “İmza” kısmına imzasını atacaktır. Katılmadı ise değerlendirici tarafından aday sınava katılmadı yazılıp paraflanacaktır..<br>
    </p>

EOD;

    $pdf->writeHTML($tbl, true, false, false, false, '');

   
    $pdf->Output($sinavlar->sinav_id.'.pdf', 'D'); 
    
    }



     public function yeni_pratik()
    {
        
    }

    public function adaylar($id)
    {

        $basvurular = $this->db->get_where('basvuru', array('yeterlilikid' => $id,'onay' => 1))->result();

                                                
        echo '<table class="table table-hover">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Ad Soyad </th>
                        </tr>
                    </thead>
                    <tbody>
                        ';

                        foreach ($basvurular as $basvuru) {
                           echo '<tr>
                                    <td><input type="checkbox" value="'.$basvuru->id.'" name="basvuru[]" /></td>
                                    <td>'.$basvuru->adsoyad.'</td>
                                </tr>';
                        }

                         

                    echo '</tbody></table>';
                                                
        
    }

}
