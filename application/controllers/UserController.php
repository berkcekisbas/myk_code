<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
      if($this->input->post())
      {

          /* 
          
          kullanıcılarda veri tabanında roller tanımlanacak. Symfony fosuer i baz al. 
          kullanıcı login olurken bu roller "roles" adı altında session a kaydedilecek.
          controller larda dolaşırken bu rollere bakılarak erişim yetkileri kontrol edilecek. 
                    

          */

        $query = $this->db->get_where('user', array('username' => $this->input->post('username'),'password' => md5(md5($this->input->post('password')))))->row();

        if(count($query) == 0)
        {
           $this->session->set_flashdata('error', 'Hatalı Kullanıcı Adı Yada Şifre');
           redirect('user/login');
        } 

          // Giriş Başarılı olursa yapılacak işlemler       


          $role = FALSE;
           foreach(json_decode($query->roles) as $item)
          {
              if($item == "ADMIN_ROLE")
              {
                  $role = TRUE;
              }
          }

          echo $role;

      


          redirect(base_url());
      }

      $this->load->view('user/login');
    }
   
}
