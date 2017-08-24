<?php

function komisyonlar($data)
{
    $ci=& get_instance();
    $ci->load->database(); 



    $data = json_decode($data);
    $count = count($data);
    $result = NULL;
    $i = 1;
    
    foreach ($data as $key) {

        $query = $ci->db->get_where('komisyonlar', array('id' => $key))->row();

        $result .= $query->adsoyad;
        if($count > $i)
        {
            $result .= ",";
        }

        $i++;
    }

    return $result;
}

function yeterlilik($id)
{
    $ci=& get_instance();  

    $query = $ci->db->get_where('yeterlilikler', array('id' => $id))->row();

    return $query->kod." ".$query->ad." SEVİYE ".$query->seviye." REV ".$query->revizyon;


}
