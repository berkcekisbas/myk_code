<?php
class Alternatif_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function fields()
    {
       return array(
            array('column' => 'yeterlilik'     ,'label' => 'Yeterlilik'),
            array('column' => 'ad'      ,'label' => 'Ad'),
       );
    }

    public function alternatifler($yeterlilikid)
    {
        $this->db->where('yeterlilik', $yeterlilikid);
        $query = $this->db->get('alternatifler');
        return $query->result();
    }

    public function alternatif_ekle($yeterlilikid,$data,$birimler)
    {
        $data = array(
            'ad' => $data['ad'],
            'yeterlilik' => $yeterlilikid
        );
        $this->db->insert('alternatifler', $data);
        $insert_id = $this->db->insert_id();

        foreach ($birimler as $birim)
        {
            $this->db->insert('alternatif_birim', array('alternatif_id' => $insert_id,'birim_id' => $birim));
        }

    }

}