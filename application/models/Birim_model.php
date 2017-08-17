<?php
class Birim_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function fields()
    {
       return array(
            array('column' => 'kod'     ,'label' => 'Kod'),
            array('column' => 'ad'      ,'label' => 'Ad'),
           array('column' => 'fiyat'      ,'label' => 'Fiyat'),

       );
    }

    public function birimler($tip,$yeterlilikid)
    {
        $this->db->where('tip', $tip);

        $this->db->where('yeterlilik', $yeterlilikid);
        $query = $this->db->get('birimler');
        return $query->result();
    }

    public function birim_ekle($tip,$yeterlilikid,$data)
    {
        $data = array(
            'kod' => $data['kod'],
            'ad' => $data['ad'],
            'fiyat' => $data['fiyat'],
            'tip' => $tip,
            'yeterlilik' => $yeterlilikid
        );
        $this->db->insert('birimler', $data);
    }


}