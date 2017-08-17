<?php
class Yeterlilik_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function fields()
    {
       return array(
            array('column' => 'kod'     ,'label' => 'Kod'),
            array('column' => 'ad'      ,'label' => 'Ad'),
            array('column' => 'seviye'  ,'label' => 'Seviye'),
            array('column' => 'sektor'  ,'label' => 'Sektör'),
            array('column' => 'revizyon'  ,'label' => 'Revizyon'),
            array('column' => 'onaytarihi'  ,'label' => 'Onay Tarihi'),
            array('column' => 'onaysayisi'  ,'label' => 'Onay Sayısı'),
            array('column' => 'belgegecerliliksuresi'  ,'label' => 'Belge Geçerlilik Süresi'),

       );
    }

    public function yeterlilik_ad($id)
    {
        $query = $this->db->get('yeterlilikler');
        $ret = $query->row();
        return $ret->ad;
    }

    public function yeterlilik_ekle($data)
    {
        $data = array(
            'kod' => $data['kod'],
            'ad' => $data['ad'],
            'seviye' => $data['seviye'],
            'sektor' => $data['sektor'],
            'revizyon' => $data['revizyon'],
            'onaytarihi' => date("Y-m-d", strtotime($data['onaytarihi'])),
            'onaysayisi' => $data['onaysayisi'],
            't1sorusayisi' => $data['t1sorusayisi'],
            't2sorusayisi' => $data['t2sorusayisi'],
            't1gecmepuani' => $data['t1gecmepuani'],
            't2gecmepuani' => $data['t2gecmepuani'],
            'belgegecerliliksuresi' => $data['belgegecerliliksuresi']

        ,
        );
        $this->db->insert('yeterlilikler', $data);
    }

    public function yeterlilik_duzenle($data,$id)
    {
        $data = array(
            'kod' => $data['kod'],
            'ad' => $data['ad'],
            'seviye' => $data['seviye'],
            'sektor' => $data['sektor'],
            'revizyon' => $data['revizyon'],
            'onaytarihi' => date("Y-m-d", strtotime($data['onaytarihi'])),
            'onaysayisi' => $data['onaysayisi'],
            'belgegecerliliksuresi' => $data['belgegecerliliksuresi']
        );
        $this->db->where('id', $id);

        $this->db->update('yeterlilikler', $data);
    }

    public function yeterlilikler()
    {
        $query = $this->db->get('yeterlilikler');
        return $query->result();
    }

}