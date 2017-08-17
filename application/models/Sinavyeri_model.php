<?php
class Sinavyeri_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function sinavyerleri()
    {
        $query = $this->db->get('sinavyerleri');
        return $query->result();
    }

    public function sinavyeri__ekle($data)
    {
        $data = array(
            'adsoyad' => $data['adsoyad']
        );
        $this->db->insert('komisyonlar', $data);
    }
}