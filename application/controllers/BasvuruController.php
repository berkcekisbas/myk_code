<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BasvuruController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library("Pdf");
    }

    public function liste($onay)
    {

        switch ($onay) {
          
          case 0: $baslik = "ONAY BEKLEYEN BAŞVURULAR"; break;
          case 1: $baslik = "ONAYLANMIŞ BAŞVURULAR"; break;
          case 2: $baslik = "SINAVA ATANMIŞ BAŞVURULAR"; break;
          case 3: $baslik = "BELGE ALMAYA HAK KAZANMIŞ BAŞVURULAR"; break;
          case 4: $baslik = "BELGELENDİRİLMİŞ / TAMAMLANMIŞ BAŞVURULAR"; break;
          case 5: $baslik = "İPTAL EDİLMİŞ BAŞVURULAR"; break;
          case 6: $baslik = "TEKRAR TEORİK SINAVA GİRECEK BAŞVURULAR"; break;
          case 7: $baslik = "TEKRAR PRATİK SINAVA GİRECEK BAŞVURULAR"; break;
          case 8: $baslik = "BAŞARISIZ OLAN BAŞVURULAR"; break;

        }
     

        $this->db->where('onay', $onay);

        $query = $this->db->get('basvuru');

        $result = $query->result();

        $this->load->view('admin_layout',array('view' => 'basvuru/liste','data' => array('baslik' => $baslik,'results' => $result )));
    }

    public function onay($id)
    {
      $data = array(
               'onay' => 1,
            );

        $this->db->where('id', $id);
        $this->db->update('basvuru', $data); 

      redirect($this->agent->referrer());
    }

    public function sil($id)
    {
      
     $this->db->delete('basvuru', array('id' => $id)); 
      redirect($this->agent->referrer());
    }

    public function detay($id)
    {
                   $this->db->select('*,alternatifler.ad AS alternatifad,basvuru.adsoyad AS adsoyad,basvuru.id AS basvuruid');
                   $this->db->join('alternatifler', 'basvuru.alternatifid = alternatifler.id');
                   $this->db->join('yeterlilikler', 'basvuru.yeterlilikid = yeterlilikler.id');
        $basvuru = $this->db->get_where('basvuru', array('basvuru.id' => $id))->row();


        $this->load->view('basvuru/detay',array('basvuru' => $basvuru));
    }

    public function form($id)
    {


      $this->db->where('basvuru.id',$id);
      $this->db->select('*,alternatifler.ad AS alternatifad,yeterlilikler.ad AS yeterlilikad,basvuru.adsoyad AS adayad,basvuru.id AS basvuruid');
                         $this->db->join('yeterlilikler', 'yeterlilikler.id = basvuru.yeterlilikid');
                         $this->db->join('alternatifler', 'alternatifler.id = basvuru.alternatifid');
        $query = $this->db->get('basvuru')->result_array();

        $this->basvurupdf($query[0]);
   
    }


     public function basvurupdf($basvuru)
    {
      // create new PDF document
      $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      // set document information
      $pdf->SetCreator(PDF_CREATOR);
     
      // set default header data
      $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "USTA Mesleki Yeterlilik Merkezi Sınav Başvuru Formu", "FR.01.03/20.01.2017/REV.01/20.06.2017");

      // set header and footer fonts
      $pdf->setHeaderFont(Array("dejavusans", '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

      // set default monospaced font
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

      // set margins
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

      // set auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

      // set image scale factor
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

      // set some language-dependent strings (optional)
      if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
      require_once(dirname(__FILE__).'/lang/eng.php');
      $pdf->setLanguageArray($l);
      }

      // ---------------------------------------------------------

      // add a page
      $pdf->AddPage();

      $pdf->SetFont('dejavusans', '',10);

      $id = $basvuru['id'];
      $adsoyad = $basvuru['adsoyad'];
      $uyruk = $basvuru['uyruk'];
      $tckimlik = $basvuru['tckimlik'];
      $pasaportno = $basvuru['pasaportno'];
      $babaadi = $basvuru['babaadi'];
      $dogumyeri = $basvuru['dogumyeri'];
      $anaadi = $basvuru['anaadi'];
      $dogumtarihi = date('d-m-Y',strtotime($basvuru['dogumtarihi']));
      $cinsiyet = $basvuru['cinsiyet'];
      $nufusil = $basvuru['nufusil'];
      $nufusilce = $basvuru['nufusilce'];

      $irtibatadresi = $basvuru['irtibatadresi'];
      $ceptelefonu = $basvuru['ceptelefonu'];
      $eposta = $basvuru['eposta'];
      $calismadurumu = $basvuru['calismadurumu'];
      $calisilantoplamsure = $basvuru['calisilantoplamsure'];
      $ucretgeriodeme = $basvuru['ucretgeriodeme'];
      $iban = $basvuru['iban'];
      $isyeriadi = $basvuru['isyeriadi'];
      $isyeritelefonu = $basvuru['isyeritelefonu'];
      $basvurunedeni = $basvuru['basvurunedeni'];
      $yeterlilikkodu = $basvuru['kod'];
      $yeterlilikadi = $basvuru['yeterlilikad'];
      $yeterlilikseviye = $basvuru['seviye'];
      $birimler = NULL;

      foreach (json_decode($basvuru['birimler']) as $row)
      {
          $query = $this->db->get_where('birimler', array('id' => $row))->result_array();
          $birimler .=  "<br>".$query[0]['kod']." - ".$query[0]['ad'];
      }

      $alternatif = $basvuru['alternatifad'];
      $engeldurum = $basvuru['engeldurum'];
      $engeldurumuaciklama = $basvuru['engeldurumuaciklama'];
      $ozeldurum = $basvuru['ozeldurum'];
      $ozeldurumaciklama = $basvuru['ozeldurumaciklama'];
      $cevirmen = $basvuru['cevirmen'];



// Table with rowspans and THEAD
$tbl = <<<EOD
<table width="100%" border="1" cellpadding="3" cellspacing="0" align="LEFT">
    <tr>
        <td colspan="4" bgcolor="#CCCCCC"><strong>ADAYIN KİŞİSEL BİLGİLERİ</strong></td>
    </tr>
    <tr>
      <td width="20%"> Uyruğu : </td>
      <td width="30%">$uyruk</td>
      <td width="20%"> TC Kimlik No : </td>
      <td width="30%">&nbsp;$tckimlik</td>
    </tr>
    <tr>
      <td> Adı Soyadı : </td>
      <td>&nbsp;$adsoyad</td>
      <td> Pasaport No :</td>
      <td>&nbsp;$pasaportno</td>
    </tr>
    <tr>
      <td> Baba Adı : </td>
      <td>&nbsp;$babaadi</td>
      <td> Doğum Yeri : </td>
      <td>&nbsp;$dogumyeri</td>
    </tr>
       <tr>
      <td> Anne Adı : </td>
      <td>&nbsp;$anaadi</td>
      <td> Doğum Tarihi : </td>
      <td>&nbsp;$dogumtarihi</td>
    </tr>
       <tr>
      <td> Cinsiyeti : </td>
      <td>&nbsp;$cinsiyet</td>
      <td> Nüfus İl/İlçe : </td>
      <td>&nbsp;$nufusil / $nufusilce</td>
    </tr>
    <tr>
      <td> İrtibat Adresi : </td>
      <td colspan="4">&nbsp;$irtibatadresi</td>
    </tr>
    <tr>
      <td> Cep Telefonu : </td>
      <td>&nbsp;$ceptelefonu</td>
      <td> E-Posta : </td>
      <td>&nbsp;$eposta</td>
    </tr>
       <tr>
      <td> Çalışma Durumu : </td>
      <td>&nbsp;$calismadurumu</td>
      <td> İş Tecrübesi : </td>
      <td>&nbsp;$calisilantoplamsure</td>
    </tr>
    <tr>
      <td colspan="4">Mesleki Yeterlilik Belgesi Almaya hak kazanmanız halinde sınav ücretinin  4447 sayılı İşsizlik Sigortası Kanunu kapsamında geri ödenmesini istiyor musunuz?<br>
      </td>
    </tr>
     <tr>
      <td>Ödeme Durumu :</td>
      <td colspan="3">$ucretgeriodeme</td>
    </tr>
     <tr>
      <td>IBAN NO :</td>
      <td colspan="3">$iban</td>
    </tr>
</table>
EOD;

    $pdf->writeHTML($tbl, true, false, false, false, '');

    // Table with rowspans and THEAD
$tbl = <<<EOD
<table width="100%" border="1" cellpadding="3" cellspacing="0" align="LEFT">
    <tr>
        <td colspan="4" bgcolor="#CCCCCC"><strong>FİRMA BİLGİLERİ</strong></td>
    </tr>
    <tr>
      <td width="25%"> Firma Adı / Ünvanı : </td>
      <td colspan="2" width="75%">$isyeriadi</td>
    </tr>
     <tr>
      <td width="25%"> Firma Adresi : </td>
      <td colspan="2">X</td>
    </tr>
     <tr>
      <td width="25%"> Firma Telefon : </td>
      <td width="25%">$isyeritelefonu</td>
      <td width="25%"> Firma Faks : </td>
      <td width="25%">x</td>
    </tr>
       <tr>
      <td width="25%"> Firma Web Adresi : </td>
      <td width="25%">x</td>
      <td width="25%"> Firma E-Posta : </td>
      <td width="25%">x</td>
    </tr>
</table>
EOD;

    $pdf->writeHTML($tbl, true, false, false, false, '');

        // Table with rowspans and THEAD
$tbl = <<<EOD
<table width="100%" border="1" cellpadding="3" cellspacing="0" align="LEFT">
    <tr>
        <td colspan="4" bgcolor="#CCCCCC"><strong>BAŞVURU NEDENİ</strong></td>
    </tr>
    <tr>
      <td width="25%"> Başvuru Nedeni : </td>
      <td colspan="2" width="75%">$basvurunedeni</td>
    </tr>
</table>
EOD;

    $pdf->writeHTML($tbl, true, false, false, false, '');

            // Table with rowspans and THEAD
$tbl = <<<EOD
<table width="100%" border="1" cellpadding="3" cellspacing="0" align="LEFT">
    <tr>
        <td colspan="4" bgcolor="#CCCCCC"><strong>YETERLİLİK BİRİMİ SEÇİMİ BAŞVURU BİLGİLERİ</strong></td>
    </tr>
    <tr>
      <td width="25%"> Ulusal Yeterlilik Kodu : </td>
      <td colspan="2" width="75%">$yeterlilikkodu</td>
    </tr>
       <tr>
      <td width="25%"> Ulusal Yeterlilik Adı : </td>
      <td colspan="2" width="75%">$yeterlilikadi - SEVİYE $yeterlilikseviye</td>
    </tr>

           <tr>
      <td width="25%"> Meslek Birimleri : </td>
      <td colspan="2" width="75%">$birimler</td>
    </tr>
               <tr>
      <td width="25%"> Sınav Alternatifi : </td>
      <td colspan="2" width="75%">$alternatif.ALTERNATİF</td>
    </tr>
</table>
EOD;



    $pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->AddPage();


                // Table with rowspans and THEAD
$tbl = <<<EOD
<table width="100%" border="1" cellpadding="3" cellspacing="0" align="LEFT">
    <tr>
        <td colspan="4" bgcolor="#CCCCCC"><strong>SINAV GİRİŞ ŞARTLARI</strong></td>
    </tr>
    <tr>
      <td colspan="4"> - </td>
    </tr>
</table>
EOD;

    $pdf->writeHTML($tbl, true, false, false, false, '');


                // Table with rowspans and THEAD
$tbl = <<<EOD
<table width="100%" border="1" cellpadding="3" cellspacing="0" align="LEFT">
    <tr>
      <td width="85%"> Belgeli personel düzeyine uygun olarak işi yapmanıza engel (Sağlık problemi ,vb.) bir probleminiz var mı? Varsa belirtiniz: <b>$engeldurumuaciklama</b></td>
      <td width="15%"> $engeldurum </td>
    </tr>
    <tr>
      <td width="85%"> Sınav süresince makul sınırlar içerisinde kalmak şartı ile karşılanmasını istediğiniz özel durumunuz ( okuma yazma yetersizliği, dil yetersizliği vb.) var mı? Evet ise açıklayınız: <b>$ozeldurumaciklama</b></td>
      <td width="15%"> $ozeldurum </td>
    </tr>
    <tr>
      <td width="85%"> Çevirmen talebiniz var mı? Not: Çevirmen talep etmeniz halinde size bir çevirmen atanacak ve ücret tarafınıza yansıtılacaktır.
    </td>
      <td width="15%"> $cevirmen </td>
    </tr>
</table>
EOD;

    $pdf->writeHTML($tbl, true, false, false, false, '');


                    // Table with rowspans and THEAD
$tbl = <<<EOD
<table width="100%" border="1" cellpadding="3" cellspacing="0" align="LEFT">
<tr>
        <td colspan="4" bgcolor="#CCCCCC"><strong>BAŞVURUDA İSTENECEK BELGELER</strong></td>
    </tr>
    <tr>
      <td width="100%"> 1.Nüfus Cüzdanı fotokopisi ve 1 adet fotoğraf</td>
    </tr>
    <tr>
      <td width="100%"> 2.Eksiksiz doldurulmuş ıslak imzalı başvuru formu</td>
    </tr>
    <tr>
      <td width="100%"> 3.USTA tarafından hazırlanan ve aday tarafından imzalanmış Belge Kullanım Sözleşmesi</td>
    </tr>
    <tr>
      <td width="100%"> 4. Banka dekontu</td>
    </tr>
</table>
EOD;

    $pdf->writeHTML($tbl, true, false, false, false, '');

                        // Table with rowspans and THEAD
$tbl = <<<EOD
<table width="100%" border="1" cellpadding="3" cellspacing="0" align="LEFT">
<tr>
        <td colspan="4" bgcolor="#CCCCCC"><strong>BELGELENDİRME TAAHHÜDÜ</strong></td>
    </tr>
    <tr>
      <td width="100%">
      <ul>
      <li>Başvuru sahibi olarak, bu formda vermiş olduğum bilgilerin doğruluğunu beyan ederim. </li>
      <li>Başvurudan itibaren belge alıncaya veya belgem yenileninceye kadar sınav ve belgelendirme sürecine dair tahakkuk ettirilecek tüm ücretleri ve yıllık belge kullanım ücretlerini ödeyeceğimi ve ödediğim ücretleri, sınavlardaki başarısızlık sebebi dâhil, her ne sebeple olursa olsun,USTA' dan geri talep etmeyeceğimi taahhüt ederim</li>
      <li>Girdiğim sınavlarda hileli sınav uygulamalarına katılmayacağımı taahhüt ederim.</li>
      <li>İşbu başvurumun, ilgili tüm başvuru dokümanlarını USTA' ya ulaştırdığım takdirde işleme konulacağını veya başvurmuş sayılacağımı ve ayrıca belge almaya hak kazansam bile ilgili ücretleri ödemediğim takdirde belgemin iptal edileceğini biliyor ve kabul ediyorum.</li>
      <li>Gizliliği olan sınav materyallerini yasal zorunluluklar hariç hiçbir şekilde üçüncü şahıslarla paylaşmayacağımı, hileli sınav teşebbüslerine katılmayacağımı,<b>Kişisel verilerimin Mesleki Yeterlilik Kurumu’na aktarılacağını onayladığımı,</b> </li>
      <li><b>•  Belge almaya hak kazanmış olsam bile bir şüphe durumunda yeterliliğimin ve belgemin bağımsız bir kurul tarafından değerlendirilip gerekirse belgemin iptal edilebileceğini, yazılı ve uygulamalı sınavlarda görüntülü, sözlü sınavlar görüntülü ve sesli kayıt alınmasını onayladığımı,</b></li>
      <li>USTA' ya ait belgelendirme prosedür ve talimatlarının gereklerine uyacağımı, belgelendirme ile ilgili tüm itirazlarımda tarafından oluşturulan Şikayet Ve İtiraz Komitesinin nihai karar merci olduğunu,</li>
      <li>Alacağım belgenin mülkiyet haklarının USTA' ya ait olduğunu, gerekli görülmesi halinde ve/veya verdiğim bilgilerin doğru olmadığı takdirde belgemi iptal edebileceklerini, 
USTA' dan aldığım/alacağım belgemin 17024 Standardına aykırı düşen durumlarda, USTA tarafından askıya alınması veya iptal edilmesi durumunda USTA' dan maddi veya manevi hiçbir talepte bulunmayacağımı, kabul, beyan ve taahhüt ederim.
</li>
      </ul>
      </td>
    </tr>
    <tr>
      <td width="25%"> Aday Ad Soyad : </td>
      <td width="75%"> </td>
    </tr>
    <tr>
      <td width="25%"> Tarih : </td>
      <td width="25%"> </td>
      <td width="25%"> İmza : </td>
      <td width="25%"> </td>
    </tr>
</table>
EOD;

    $pdf->writeHTML($tbl, true, false, false, false, '');

       $pdf->AddPage();

                    // Table with rowspans and THEAD
$tbl = <<<EOD
<table width="100%" border="1" cellpadding="3" cellspacing="0" align="LEFT">
<tr>
        <td colspan="4" bgcolor="#CCCCCC"><strong>EKLENMESİ GEREKLİ BELGELER</strong></td>
    </tr>
    <tr>
      <td width="75%"> 1.Nüfus Cüzdanı fotokopisi ve 1 adet fotoğraf</td>
      <td width="25%"> Evet <input type="checkbox" name="evet" value="evet"> Hayır <input type="checkbox" name="hayir" value="hayir"></td>
    </tr>
      <tr>
      <td width="75%"> 2.Banka dekontu</td>
      <td width="25%"> Evet <input type="checkbox" name="evet" value="evet"> Hayır <input type="checkbox" name="hayir" value="hayir"></td>
    </tr>
      <tr>
      <td width="75%"> 3. Eksiksiz doldurulmuş ıslak imzalı başvuru formu</td>
      <td width="25%"> Evet <input type="checkbox" name="evet" value="evet"> Hayır <input type="checkbox" name="hayir" value="hayir"></td>
    </tr>
      <tr>
      <td width="75%"> 4.Belge Kullanım Sözleşmesi</td>
      <td width="25%"> Evet <input type="checkbox" name="evet" value="evet"> Hayır <input type="checkbox" name="hayir" value="hayir"></td>
    </tr>

</table>
EOD;

    $pdf->writeHTML($tbl, true, false, false, false, '');

    $tbl = <<<EOD

    *Sınav Başvurusunun gözden geçirilmesi esnasında eklenmesi gereken belgeler kısmını Başvuruyu Alan Sınav Hizmetleri Sorumlusu tarafından doldurulacaktır.
    <br/>
    <br/>
    <table width="100%" border="0" cellpadding="3" cellspacing="0" align="LEFT">
    <tr>
        <td colspan="4" bgcolor="#CCCCCC"><strong>BAŞVURUNUN DEĞERLENDİRİLMESİ VE ONAYLANMASI</strong></td>
    </tr>
     <tr>
      <td width="100%"> Sınav Hizmetleri Sorumlusu :</td>
    </tr>
    <tr>
      <td width="25%"> Tarih :</td>
      <td width="25%"> </td>
      <td width="25%"> İmza :</td>
      <td width="25%"> </td>
    </tr>
    
     <tr>
      <td width="50%"> Adayın Başvurusu Uygun Bulunmuştur <input type="checkbox" name="x" value="x"></td>
      <td width="50%"> Adayın Başvurusu Uygun Değildir <input type="checkbox" name="x" value="x"></td>
    </tr>
     
</table>
EOD;

    $pdf->writeHTML($tbl, true, false, false, false, '');
    $pdf->Output($basvuru['id']."_".$basvuru['tckimlik']."_".date('d-m-Y',strtotime($basvuru['basvurutarihi'])).'.pdf', 'D');    
  }
}
