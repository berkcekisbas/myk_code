
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->

        <!-- BEGIN PAGE CONTENT BODY -->
        <div class="page-content">
            <div class="container-fluid">
                <!-- BEGIN PAGE BREADCRUMBS -->
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Layouts</span>
                    </li>
                </ul>
                <!-- END PAGE BREADCRUMBS -->
                <!-- BEGIN PAGE CONTENT INNER -->
                <div class="page-content-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-plus-circle font-dark"></i>
                                        <span class="caption-subject font-dark bold uppercase"><?php echo $baslik?></span>
                                    </div>
                                </div>
                                <?php
                                if(validation_errors())
                                {
                                    echo '<div class="alert alert-danger">';
                                    echo validation_errors('<b>','</b><br>');
                                    echo '</div>';
                                }

                                if($this->session->flashdata('error'))
                                {
                                    echo '<div class="alert alert-danger">'.$this->session->flashdata('error').'</div>';
                                }

                                if($this->session->flashdata('success'))
                                {
                                    echo '<div class="alert alert-success">
                                          <i class="fa fa-check-circle"></i> '.$this->session->flashdata('success').'</div>';
                                }

                                $attributes = array('class' => 'form-horizontal', 'role' => 'form');
                                echo form_open_multipart('sinav/yeni', $attributes);
                                ?>
                                <div class="form-body">


                                <div class="form-group">
                                    <label class="col-md-2 control-label"> Sınav Türü </label>
                                    <div class="col-md-4">
                                        <select class="form-control" id = "tip" name = "tip" required="">
                                        <option value="T">TEORİK</option>
                                        <option value="P ">PRATİK</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> Yeterlilik </label>
                                    <div class="col-md-4">
                                        <select class="form-control" id = "yeterlilik_sinav" name = "yeterlilik" required="">
                                        <option value="">Seçiniz</option>

                                        <?php foreach($yeterlilikler as $yeterlilik){?>
                                        <option value="<?php echo $yeterlilik->id;?>"><?php echo $yeterlilik->kod." ".$yeterlilik->ad." (Rev".$yeterlilik->revizyon.")";?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-2 control-label"> Sınav ID </label>
                                    <div class="col-md-4">
                                        <input id = "sinavid" name = "sinavid" type="text"   class="form-control"  placeholder="Sınav ID">
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-2 control-label"> Sınav Tarihi </label>
                                    <div class="col-md-4">
                                      <input class="form-control" id="mask_date" name="sinavtarihi" type="text" placeholder="Sınav Tarihi" required="" />
                                       <span class="help-block"> Gün/Ay/Yıl </span>
                                    </div>
                                </div>

                                  <div class="form-group">
                                    <label class="col-md-2 control-label"> Sınav Saati </label>
                                    <div class="col-md-4">
                                      <input class="form-control" class="time" id="sinavsaati" name="sinavsaati" type="text" placeholder="Sınav Saati" required="" />
                                       <span class="help-block"> ÖR : 13:30 </span>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> Sınav Yeri </label>
                                    <div class="col-md-4">
                                        <select class="form-control" id = "sinavyeri" name = "sinavyeri" required="">
                                        <option value="">Seçiniz</option>

                                        <?php foreach($sinavyerleri as $sinavyeri){?>
                                        <option value="<?php echo $sinavyeri->id;?>"><?php echo $sinavyeri->ad;?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-2 control-label"> Gözetmen </label>
                                    <div class="col-md-4">
                                        <select class="form-control select2-multiple" multiple="" id = "gozetmen" name = "gozetmen[]">
                                        <option value="">Seçiniz</option>

                                        <?php foreach($komisyonlar as $komisyon){?>
                                        <option value="<?php echo $komisyon->id;?>"><?php echo $komisyon->adsoyad;?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-2 control-label"> Değerlendirici </label>
                                    <div class="col-md-4">
                                        <select class="form-control select2-multiple" multiple="" id = "degerlendirici" name = "degerlendirici[]">
                                        <option value="">Seçiniz</option>

                                        <?php foreach($komisyonlar as $komisyon){?>
                                        <option value="<?php echo $komisyon->id;?>"><?php echo $komisyon->adsoyad;?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                </div>



                                  <div class="form-group">
                                    <label class="col-md-2 control-label"> Sınava Girecek Adaylar </label>
                                    <div class="col-md-4">
                                      <div id="teorik_aday_listesi">Yeterlilik Seçiniz</div>



                                    </div>
                                </div>



                           


                            







                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-10">
                                        <button type="submit" class="btn blue">Kaydet</button>
                                    </div>
                                </div>
                                <?php echo form_close();?>
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