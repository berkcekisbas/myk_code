<?php
class Meslek_model extends CI_Model {

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
            array('column' => 'onaysayisi'  ,'label' => 'Onay Sayısı')

        );
    }

    public function meslek_ekle($data)
    {
        $data = array(
            'kod' => $data['kod'],
            'ad' => $data['ad'],
            'seviye' => $data['seviye'],
            'sektor' => $data['sektor'],
            'revizyon' => $data['revizyon'],
            'onaytarihi' => date("Y-m-d", strtotime($data['onaytarihi'])),
            'onaysayisi' => $data['onaysayisi']


        ,
        );
        $this->db->insert('meslekler', $data);
    }

    public function meslek_ad($data,$id)
    {
        $data = array(
            'kod' => $data['kod'],
            'ad' => $data['ad'],
            'seviye' => $data['seviye']
        );
        $this->db->where('id', $id);

        $this->db->update('meslekler', $data);
    }

    public function meslek_duzenle($data,$id)
    {
        $data = array(
            'kod' => $data['kod'],
            'ad' => $data['ad'],
            'seviye' => $data['seviye']
        );
        $this->db->where('id', $id);

        $this->db->update('meslekler', $data);
    }

    public function meslekler()
    {
        $query = $this->db->get('meslekler');
        return $query->result();
    }

}