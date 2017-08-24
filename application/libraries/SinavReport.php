<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SinavReport {

	public function header($baslik,$formno)
	{
			  $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		      $pdf->SetCreator(PDF_CREATOR);
		      $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $baslik, $formno);
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

		      return $pdf;
	}

	public function _soru_grid($sorusayisi,$birimkod,$birim_id,$anahtar)
	{



	    $td = null;
	    for ($i=1; $i < $sorusayisi + 1; $i++) { 

			$ci=& get_instance();
    		$ci->load->database();

    		if($anahtar == 1)
    		{
    			$query = $ci->db->get_where('teorik_sinav_sorular', array('birim' => $birim_id,'sira' => $i,'basvuru_id' => $ci->uri->segment(4)))->row();

	    			$ci->db->select('id, dogrucevap');
	    			$ci->db->where('id', $query->soru_id);
			$soru = $ci->db->get('teoriksorular')->row();

			 if($soru->dogrucevap == "A") { $a =  '<td bgcolor="#000000" ></td>'; } else { $a =  '<td></td>'; } 
			 if($soru->dogrucevap == "B") { $b =  '<td bgcolor="#000000" ></td>'; } else { $b =  '<td></td>'; } 
			 if($soru->dogrucevap == "C") { $c =  '<td bgcolor="#000000" ></td>'; } else { $c =  '<td></td>'; } 
			 if($soru->dogrucevap == "D") { $d =  '<td bgcolor="#000000" ></td>'; } else { $d =  '<td></td>'; } 
			 if($soru->dogrucevap == "E") { $e =  '<td bgcolor="#000000" ></td>'; } else { $e =  '<td></td>'; } 

	    						$td .=  '
	    						<tr align = "center">
	    						<td>'.$i.'</td>
	    						'.$a.'
	    						'.$b.'
	    						'.$c.'
	    						'.$d.'
	    						'.$e.'
	    						</tr>
	    						';
	    					} else {
	    						$td .=  '
	    						<tr align = "center">
	    						<td>'.$i.'</td>
	    						<td></td>
	    						<td></td>
	    						<td></td>
	    						<td></td>
	    						<td></td>
	    						</tr>
	    						';
	    					}

	    		}
	    
	    $html = '<table border="1" cellspacing="0" cellpadding="0">
	    <tr align = "center">
				    		<td width = "90" height = "15"><b>'.$birimkod.' BİRİMİ</b></td>
				    	</tr>
				    	<tr align = "center">
				    		<td width = "15" height = "15"></td>
				    		<td width = "15" height = "15">A</td>
				    		<td width = "15" height = "15">B</td>
				    		<td width = "15" height = "15">C</td>
				    		<td width = "15" height = "15">D</td>
				    		<td width = "15" height = "15">E</td>
				    	</tr>
				    	'.$td.'
				    </table>';

				    return $html;
	}

	public function cevap_form($data,$anahtar)
	{
		if($anahtar == 1)
    		{
    			$pdf = $this->header("DEĞERLENDİRİCİ CEVAP ANAHTARI FORMU","FR.25/20.01.2017/REV.00");

    		} else {
				$pdf = $this->header("CEVAP ANAHTARI FORMU","FR.13/20.01.2017/REV.00");
    		}
		$pdf->AddPage();
	    $pdf->SetFont('dejavusans', '',8);

		$birimsayisi = count($data);



		$xdefault = 14;
		$altbosluk = 15;
		$x = 14;
		$y = 20;
		$satirsayisi = 6;
		$i = 1;
		$q = 0;

foreach ($data as $birim) {

	if($i > $satirsayisi)
	{
		$y = $y + 65;
		$x = $xdefault;
		$satirsayisi = $satirsayisi * 2;
	}
	
		$pdf->writeHTMLCell($w=10, $h=10, $x, $y, $this->_soru_grid($birim['sorusayisi'],$birim['kod'],$birim['id'],$anahtar), $border=0, $ln=1, $fill=0, $reseth=0, $align='', $autopadding=true);
		$x = $x + 27; 
		$i++;

		if($i > 16) {
			$pdf->AddPage(); 
			$xdefault = 14;
			$altbosluk = 15;
			$x = 14;
			$y = 20;
			$satirsayisi = 5;
			$i = 1;
			$q = 0;

		}
}

	$bosluk1 = null;
	$bosluk2 = null;

	foreach ($data as $birim)
	{
		$bosluk1 .= '<td width = "35" align="center">'.$birim['kod'].'</td>';
		$bosluk2 .= '<td></td>';
	}



	$pdf->Ln(5);
	$baslik = '
	<table border = "1" cellspacing="0" cellpadding="2">
	<tr>
	<td width = "95">Yeterlilik Birimi</td>
		
		'.$bosluk1.'
   		</tr>
		<tr>
		<td>Doğru Sayısı</td>
		'.$bosluk2.'
		</tr>

		<tr>
		<td>Yanlış Sayısı</td>
		'.$bosluk2.'
		</tr>




	</table>*Sadece ilgili yeterlilikteki alanlara doğru ve yanlış sayısı yazılmalıdır.<br><br><b>Değerlendirici Ad Soyadı / İmza :</b><br><br><br><b>Tarih : </b>';

	if($anahtar == 0)
    		{
	$pdf->writeHTMLCell('', '', 14, 235, $baslik, 0, 1, 0, 1, '', true);
}


//$pdf->writeHTMLCell($w=10, $h=10, $x='14', $y='20', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
//$pdf->writeHTMLCell($w=10, $h=10, $x='50', $y='20', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);



/*
$pdf->Ln(4);
$pdf->lastPage();
$pdf->writeHTMLCell($w=10, $h=10, $x='15', $y='85', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
$pdf->writeHTMLCell($w=10, $h=10, $x='50', $y='85', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
*/

	   





	$pdf->Output('cevap_kagidi'.'.pdf', 'I'); 

	}






        public function aday_sorular($data,$sorular)
        {


        	$pdf = $this->header("TEORİK SINAV SORU KİTAPÇIĞI","FR.48/20.01.2017/REV.01/31.07.2017");
			$pdf->AddPage();
	    	$pdf->SetFont('dejavusans', '',10);

		  
$html = <<<EOD

	<table width="100%" border="0" cellpadding="3" cellspacing="0">
    <tr>
    <td width="100%" align="center"><h5><b>İESOB USTA MESLEKİ YETERLİLİK SINAV MERKEZİ İKTİSADİ İŞLETMESİ</b></h5></td>
    </tr>
    <br><br>
    <tr>
    <td width="100%" align="center"><h3><b>TEORİK SINAV SORULARI</b></h3></td>
    </tr>
    
    <hr>
    <tr>
      <td width="40%"> <b>ULUSAL YETERLİLİĞİN ADI</b> </td>
      <td width="5%"> <b>:</b> </td>
      <td width="55%"> $data->yeterlilikad </td>
    </tr>
    <tr>
      <td width="40%"> <b>ULUSAL YETERLİLİĞİN SEVİYESİ</b> </td>
      <td width="5%"> <b>:</b> </td>
      <td width="55%"> $data->yeterlilikseviye </td>
    </tr>

    <tr>
      <td width="40%"> <b>SINAVIN ID NUMARASI</b> </td>
      <td width="5%"> <b>:</b> </td>
      <td width="55%"> $data->sinavid </td>
    </tr>

    <tr>
      <td width="40%"> <b>TOPLAM SORU SAYISI</b> </td>
      <td width="5%"> <b>:</b> </td>
      <td width="55%"> $data->sorusayisi </td>
    </tr>

    <tr>
      <td width="40%"> <b>SINAV SÜRESİ</b> </td>
      <td width="5%"> <b>:</b> </td>
      <td width="55%"> $data->sure </td>
    </tr>

    <tr>
      <td width="40%"> <b>SINAV TARİHİ</b> </td>
      <td width="5%"> <b>:</b> </td>
      <td width="55%"> $data->tarih </td>
    </tr>

    <tr>
      <td width="40%"> <b>SINAV SAATİ</b> </td>
      <td width="5%"> <b>:</b> </td>
      <td width="55%"> $data->saat </td>
    </tr>

    <tr>
      <td width="40%"> <b>SINAV YERİ</b> </td>
      <td width="5%"> <b>:</b> </td>
      <td width="55%"> $data->sinavyeri  </td>
    </tr>
      <hr>
    <tr>
    <td width="25%"><b>ADAYIN ADI SOYADI :</b></td>
    <td width="35%">$data->adsoyad </td>
    <td width="20%"><b>T.C KİMLİK NO :</b></td>
    <td width="15%">$data->tc</td>
    </tr>
    <tr>
    <td width="50%" align="LEFT"></td>
    </tr>
    <tr>
    <td width="50%" align="LEFT"><b>İMZA :</b></td>
    </tr>
    <tr>
    <td width="50%" align="LEFT"></td>
    </tr>
    <hr>
    <p></p>
    <tr>
    <td width="100%" align="center"><b>SINAV KURALLARI</b></td>
    </tr>
    <tr>
    <td width="100%" align="left">
    <ul>
    <li>Adaylar sınav esnasındaki tüm kurallara uymak zorundadırlar. Sınav süresi, başlangıç ve bitiş süreleri görevliler tarafından adaylara duyurulur</li>
    <li>Tüm işaretlemeler kurşun kalem ile yapılır.</li>
    <li>Adaylar birbirinden kalem, silgi vb. araçları isteyemez. Kendi aralarında konuşamazlar.</li>
    <li>Fotoğraflı nüfus cüzdanı veya ehliyet ile beraber gelmeyen adaylar sınava giremezler.</li>
    <li>Kimlik kontrolleri ve salona yerleştirme işlemlerinin zamanında yapılabilmesi için adayların sınavın başlamasından en az 15 dakika önce sınav yerinde hazır bulunmaları zorunludur.</li>
    <li>Cep telefonu, çağrı cihazı, telsiz, cep bilgisayarı, saat fonksiyonu dışında fonksiyonu bulunan saat, her türlü bilgisayar özelliği bulunan cihazlar, silah vb. teçhizatla; müsvedde kâğıdı, defter, kitap, sözlük, sözlük işlevi olan elektronik aygıt, hesap makinesi, hesap cetveli, pergel, açı ölçer, cetvel, hafıza kartı vb. özellikte hafıza aygıtları ile sınava girilmez. Sınav sırasında bu araçların kullandığı tespit edilen adayların sınavları geçersiz sayılır.</li>
    <li>Adaylar teorik sınavlarda görüntülerinin kayıt altına alınmasını kabul etmek durumundadır.</li>
    <li>Sınav salonundan her ne sebeple olursa olsun, görevli haricinde dışarıya çıkan bir aday tekrar içeriye alınmaz.</li>
    <li>Cevaplar sınav süresi bittiğinde cevapların cevap anahtarı formuna işaretlenmiş olması gerekir. Sadece soru kitapçığına işaretlenen cevaplar geçerli değildir.</li>
    <li>Çoktan seçmeli sorular için sadece doğru gördüğünüz bir seçeneği işaretleyiniz. İki veya daha fazla seçenek işaretlenen sorular yanlış kabul edilecektir.</li>
    <li>Yanlış cevap doğru cevabı etkilememektedir. Bu yüzden boş soru bırakılmaması önerilmektedir. </li>
    <li>Sınav değerlendiricisinin “sınav başlamıştır” ifadesi sonrası sınava başlanır. ‘Sınav bitmiştir’ ifadesi ile sınav sona erer.</li>
    <li>Adaylar sınav esnasındaki tüm kurallara uymak zorundadırlar. Sınav süresi, başlangıç ve bitiş süreleri görevliler tarafından adaylara duyurulur.</li>
    </ul>
    </td>
    </tr>

   
    </table>
    

EOD;

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


$pdf->SetFont('dejavusans', '',10);


$i = 0;

foreach ($sorular as $birimler) {

	$pdf->AddPage();

	$baslik = "<h3><b>".$birimler['birim']." BİRİMİ SORULARI : ".$birimler['sorusayisi']." SORU</b></h3><br>";
	$pdf->writeHTMLCell(0, 0, '', '', $baslik, 0, 1, 0, true, '', true);

	
	foreach ($birimler['sorular'] as $soru) {
		$icerik =  "<br><b>".$soru['sira'].")</b> ".$soru['soru']."<hr>";
		$pdf->writeHTMLCell(0, 0, '', '', $icerik, 0, 1, 0, 0, '', true);
	}
	
	


	
}



$pdf->Output('test'.'.pdf', 'I'); 
 		}
}