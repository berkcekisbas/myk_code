<!-- BEGIN MEGA MENU -->
<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
<div class="hor-menu  ">
    <ul class="nav navbar-nav">
    <!--
        <li class="menu-dropdown classic-menu-dropdown">
            <a href="javascript:;"> İtiraz - Şikayet Yönetimi </a>
            <ul class="dropdown-menu pull-left">
                <li class=" ">
                    <a href="#" class="nav-link  "> #### </a>
                </li>
            </ul>
        </li>
        <li class="menu-dropdown classic-menu-dropdown">
            <a href="javascript:;"> Belgelendirme </a>
            <ul class="dropdown-menu pull-left">
                <li class=" ">
                    <a href="#" class="nav-link  "> #### </a>
                </li>
            </ul>
        </li>-->
         <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
            <a href="javascript:;"> Aday İşlemleri </a>
            <ul class="dropdown-menu pull-left">
                <li aria-haspopup="true" class="dropdown-submenu ">
                    <a href="javascript:;" class="nav-link nav-toggle ">
                        Başvuru
                        
                    </a>
                    <ul class="dropdown-menu">
                        <li aria-haspopup="true" class=" ">
                            <a href="<?php echo base_url('basvuru/liste/0')?>" class="nav-link  "> Onaylanmayan Başvurular </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                            <a href="<?php echo base_url('basvuru/liste/1')?>" class="nav-link  "> Onaylanan Başvurular </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                            <a href="<?php echo base_url('basvuru/liste/2')?>" class="nav-link  "> Sınava Atanmış Başvurular </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                            <a href="<?php echo base_url('basvuru/liste/3')?>" class="nav-link  "> Belge Almaya Hak Kazanmış Başvurular </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                            <a href="<?php echo base_url('basvuru/liste/4')?>" class="nav-link  "> Belgelendirilmiş / Tamamlanmış Başvurular </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                            <a href="<?php echo base_url('basvuru/liste/5')?>" class="nav-link  "> İptal Edilmiş Başvurular </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                            <a href="<?php echo base_url('basvuru/liste/6')?>" class="nav-link  "> Tekrar Teorik Sınava Girecek Başvurular </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                            <a href="<?php echo base_url('basvuru/liste/7')?>" class="nav-link  "> Tekrar Pratik Sınava Girecek Başvurular </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
                                              


        <li class="menu-dropdown classic-menu-dropdown">
            <a href="javascript:;"> Soru Yönetimi </a>
            <ul class="dropdown-menu pull-left">
                <li class=" ">
                    <a href="<?php echo base_url('soru/teorik/liste')?>" class="nav-link  "> Teorik Sorular </a>
                </li>
                <li class=" ">
                    <a href="<?php echo base_url('soru/teorik/yeni')?>" class="nav-link  "> Yeni Teorik Soru Ekle </a>
                </li>
            </ul>
        </li>

        <li class="menu-dropdown classic-menu-dropdown">
            <a href="javascript:;"> Sınav Yönetimi </a>
            <ul class="dropdown-menu pull-left">
                <li class=" ">
                    <a href="<?php echo base_url('sinav/yeni');?>" class="nav-link  "> Yeni Sınav Oluştur </a>
                </li>
                 <li aria-haspopup="true" class="dropdown-submenu ">
                    <a href="javascript:;" class="nav-link nav-toggle ">
                        Aktif Sınavlar
                    </a>
                    <ul class="dropdown-menu">
                        <li aria-haspopup="true" class=" ">
                            <a href="<?php echo base_url('sinav/liste/teorik/1')?>" class="nav-link  "> Teorik </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                            <a href="<?php echo base_url('sinav/liste/pratik/1')?>" class="nav-link  "> Pratik </a>
                        </li>
                    </ul>
                </li>
                <li aria-haspopup="true" class="dropdown-submenu ">
                    <a href="javascript:;" class="nav-link nav-toggle ">
                        Tamamlanmış Sınavlar
                    </a>
                    <ul class="dropdown-menu">
                        <li aria-haspopup="true" class=" ">
                            <a href="<?php echo base_url('sinav/liste/teorik/0')?>" class="nav-link  "> Teorik </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                            <a href="<?php echo base_url('sinav/liste/pratik/0')?>" class="nav-link  "> Pratik </a>
                        </li>
                    </ul>
                </li>   
            </ul>
        </li>

        <li class="menu-dropdown classic-menu-dropdown">
            <a href="javascript:;"> Tanımlamalar </a>
            <ul class="dropdown-menu pull-left">
                <li class=" ">
                    <!-- <a href="<?php echo base_url('meslek/meslekler')?>" class="nav-link  "> Meslek Tanımlamaları </a>-->
                </li>
                <li class=" ">
                    <a href="<?php echo base_url('yeterlilik/yeterlilikler')?>" class="nav-link  "> Yeterlilik Tanımlamaları </a>
                </li>
                <li class=" ">
                    <a href="<?php echo base_url('sinavyeri/liste')?>" class="nav-link  active"> Sınav Yeri Tanımlamaları </a>
                </li>
                <li class=" ">
                    <a href="<?php echo base_url('komisyon/liste')?>" class="nav-link  active"> Sınav Komisyonu Tanımlamaları</a>
                </li>
            </ul>
        </li>

          <li class="menu-dropdown classic-menu-dropdown">
            <a href="<?php echo base_url('dokuman/editor');?>"> Dökümanlar </a>
          
        </li>
<!--
        <li class="menu-dropdown classic-menu-dropdown active">
            <a href="javascript:;"> Raporlar </a>
            <ul class="dropdown-menu pull-left">
                <li class=" ">
                    <a href="#" class="nav-link  "> #### </a>
                </li>
            </ul>
        </li>
-->

    </ul>
</div>
<!-- END MEGA MENU -->