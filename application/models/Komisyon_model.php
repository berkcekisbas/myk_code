<?php
class komisyon_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function komisyonlar()
    {
        $query = $this->db->get('komisyonlar');
        return $query->result();
    }

    public function komisyon_ekle($data)
    {
        $data = array(
            'adsoyad' => $data['adsoyad']
        );
        $this->db->insert('komisyonlar', $data);
    }
}