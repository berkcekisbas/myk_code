<?php
defined('BASEPATH') OR exit('No direct script access allowed');

############################### ADMIN ###############################
/*-------------------------------------------------------------------*/

/****************************** MESLEK ************************************/
$route['meslek/meslekler']['get']     = '/MeslekController/liste';
$route['meslek/yeni']                 = '/MeslekController/yeni';
$route['meslek/duzenle/(:num)']  = '/MeslekController/duzenle/$1';
$route['meslek/sil/(:num)']['get']      = '/MeslekController/sil/$1';
$route['meslek/durum/(:num)/(:num)']['get']      = '/MeslekController/durum/$1/$2';

/****************************** YETERLİLİK ************************************/
$route['yeterlilik/yeterlilikler']['get']     = '/YeterlilikController/liste';
$route['yeterlilik/yeni']                 = '/YeterlilikController/yeni';
$route['yeterlilik/duzenle/(:num)']  = '/YeterlilikController/duzenle/$1';
$route['yeterlilik/sil/(:num)']['get']      = '/YeterlilikController/sil/$1';
$route['yeterlilik/durum/(:num)/(:num)']['get']      = '/YeterlilikController/durum/$1/$2';
$route['yeterlilik/sorusablonu/(:num)']  = '/YeterlilikController/sorusablonu/$1';

/****************************** Başarım Ölçütleri ************************************/
$route['yeterlilik/basarimolcutleri/(:num)']['get']     = '/YeterlilikController/basarimolcutleri/$1';
$route['yeterlilik/yenibasarimolcutu/(:num)']     = '/YeterlilikController/yenibasarimolcutu/$1';

$route['yeterlilik/basarimolcut/liste/(:num)/(:num)/(:any)'] = '/YeterlilikController/basarimolcut_liste/$1/$2/$3';



/****************************** ALTERNATİF ************************************/

$route['yeterlilik/birim/birimler/alternatif/(:num)']['get']     = '/AlternatifController/liste/$1';
$route['yeterlilik/birim/yeni/alternatif/(:num)']                 = '/AlternatifController/yeni/$1';


/****************************** Birim ************************************/
$route['yeterlilik/birim/birimler/([a-z]+)/(:num)']['get']     = '/BirimController/liste/$1/$2';
$route['yeterlilik/birim/yeni/([a-z]+)/(:num)']                 = '/BirimController/yeni/$1/$2';
$route['yeterlilik/birim/sil/(:num)/([a-z]+)/(:num)']                 = '/BirimController/sil/$1/$2/$3';

/****************************** Sınav Yeri ************************************/
$route['sinavyeri/liste']['get']     = '/SinavyeriController/liste';
$route['sinavyeri/yeni']   = '/SinavyeriController/yeni';


/****************************** Komisyon ************************************/
$route['komisyon/liste']['get']     = '/KomisyonController/liste';
$route['komisyon/yeni']     = '/KomisyonController/yeni';

/****************************** Sorular ************************************/
$route['soru/teorik/liste']['get'] = '/SoruController/liste';
$route['soru/teorik/yeni']         = '/SoruController/yeni';
$route['soru/teorik/yeni/birimler/(:num)'] = '/SoruController/birim_liste/$1';

/****************************** Başvuru ************************************/
$route['basvuru/liste/(:num)']['get'] = '/BasvuruController/liste/$1';
$route['basvuru/detay/(:num)']['get'] = '/BasvuruController/detay/$1';
$route['basvuru/form/(:num)']['get'] = '/BasvuruController/form/$1';
$route['basvuru/onay/(:num)']['get'] = '/BasvuruController/onay/$1';
$route['basvuru/sil/(:num)']['get'] = '/BasvuruController/sil/$1';


/****************************** Sınav ************************************/
$route['sinav/yeni'] = '/SinavController/yeni_sinav';
$route['sinav/yeni/teorik/adaylar/(:num)'] = '/SinavController/adaylar/$1';
$route['sinav/teorik/adaylistesi/(:num)']['get'] = '/SinavController/teorik_adaylistesi/$1';
$route['sinav/liste/teorik/(:num)'] = '/SinavController/liste_teorik/$1';
$route['sinav/detay/teorik/(:num)'] = '/SinavController/detay_teorik/$1';
$route['sinav/detay/teorik/soruhazirla/(:num)/(:num)'] = '/SinavController/teorik_soruhazirla/$1/$2';


/****************************** Döküman ************************************/
$route['dokuman/editor']['get'] = '/DokumanController/editor';

/****************************** User ************************************/
$route['user/login'] = '/UserController/login';


/****************************** Print ************************************/
$route['sinav/soruform/(:num)/(:num)'] = '/PrintController/soru_form_yazdir/$1/$2';
$route['sinav/cevapform/(:num)/(:num)/(:num)'] = '/PrintController/cevap_form_yazdir/$1/$2/$3';


$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
