<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->

        <!-- BEGIN PAGE CONTENT BODY -->
 <div class="page-content">
            <div class="container-fluid">
                <!-- BEGIN PAGE CONTENT INNER -->
                <div class="page-content-inner">
                    <div class="row">
                       <?php
                                if($this->session->flashdata('success'))
                                {
                                    echo '<div class="alert alert-success">
                                          <i class="fa fa-check-circle"></i> '.$this->session->flashdata('success').'</div>';
                                }
                                ?>
                        <div class="col-md-5">

                             <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3>Teorik Sınav Bilgileri</h3>
                                                    <p><b>Sınav Türü :</b> TEORİK</p>
                                                    <p><b>Yeterlilik :</b> <?php echo yeterlilik($sinav->yeterlilik_id);?></p>
                                                    <p><b>Sınav ID :</b> <?php echo $sinav->sinavid;?></p>
                                                    <p><b>Sınav Tarihi :</b> <?php echo $tarih;?></p>
                                                    <p><b>Sınav Saati :</b> <?php echo $sinav->sinavsaati;?></p>
                                                    <p><b>Sınav Yeri :</b> <?php echo $sinav->sinavyeri_ad;?></p>
                                                    <p><b>Gözetmen :</b> <?php echo $gozetmen;?></p>
                                                    <p><b>Değerlendirici :</b> <?php echo $degerlendirici;?></p>
                                                
                                                </div>
                                            </div>
                            </div>
                                
                            </div>

                                              <div class="col-md-5">
                            
                             <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                     <div class="form-group">
                                    <div class="col-md-offset-2 col-md-10">
                                    <p>
                                    <a href="<?php echo base_url('sinav/teorik/adaylistesi/').$sinav->sinav_id;?>" type="button" class="btn btn-success">Aday Listesi Formu</a>
                                    </p>
                                        <p><button type="submit" class="btn red">SINAV TAMAMLANDI !</button></p>
                                    </div>
                                </div>

                                                
                                                </div>
                                            </div>
                            </div>
                            </div>


                              <div class="col-md-12">
                            
                             <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3>Teorik Sınav Katılımcıları</h3>
                                                      <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th> # </th>
                                                        <th> T.C kimlik </th>
                                                        <th> Ad Soyad </th>
                                                        <th> Sınav Soruları </th>
                                                        <th> Sınav Çıktıları </th>
                                                  
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php 

                                                
                                                foreach($adaylar as $aday){?>
                                                    <tr>
                                                        <td> <?php echo $aday['id'];?> </td>
                                                        <td> <?php echo $aday['tckimlik'];?> </td>
                                                        <td> <?php echo $aday['adsoyad'];?> </td>
                                                        <td>

                                                        <?php

                                                        $CI =& get_instance();
                                                        $kontrol = $CI->_sorucek_kontrol($sinav->sinav_id,$aday['id']);

                                                        if($kontrol == TRUE){
                                                        ?>
                                                        <button type="button" class="btn btn-xs red" disabled>Sorular Oluşturulmuştur.</button>
                                                        </a>
                                                        <?php } else {?>
                                                        <a href="<?php echo base_url('sinav/detay/teorik/soruhazirla/'.$sinav->sinav_id."/".$aday['id']); ?>" type="submit" class="btn btn-xs green">Soruları Oluştur
                                                        </a>
                                                        <?php }?>
                                                        </td>
                                                        <td>
                                                        <?php if($kontrol == TRUE){?>
                                                        <a href="<?php echo base_url('sinav/soruform/'.$sinav->sinav_id."/".$aday['id']);?>" type="button" class="btn btn-xs green">Sorular</a>
                                                        <a href="<?php echo base_url('sinav/cevapform/'.$sinav->sinav_id."/".$aday['id']);?>/0" type="button" class="btn btn-xs green">Cevap Anahtarı</a>
                                                        <a href="<?php echo base_url('sinav/cevapform/'.$sinav->sinav_id."/".$aday['id']);?>/1" type="button" class="btn btn-xs green">Değerlendirici Cevap Anahtarı</a>
                                                        <a href="#" type="button" class="btn btn-xs green">Sınav Giriş Formu</a>
                                                        <?php } else {?> 
                                                        <button type="submit" class="btn btn-xs red" disabled>Soruları Oluşturun</button>
                                                        <?php }?>
                                                       
                                                        </td>
                                                        

                                                    </tr>
                                                <?php }?>
                                              </tbody>
                                            </table>
                                                
                                                </div>
                                            </div>
                            </div>
                            </div>

                    




                              

                        </div>
                    </div>
                </div>
                <!-- END PAGE CONTENT INNER -->
            </div>
        </div>
        <!-- END PAGE CONTENT BODY -->
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->