
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
                                    echo '<div class="alert alert-danger">
                                          <i class="fa fa-check-circle"></i> '.$this->session->flashdata('error').'</div>';
                                }

                                if($this->session->flashdata('success'))
                                {
                                    echo '<div class="alert alert-success">
                                          <i class="fa fa-check-circle"></i> '.$this->session->flashdata('success').'</div>';
                                }

                                $attributes = array('class' => 'form-horizontal', 'role' => 'form');
                                echo form_open_multipart('soru/teorik/yeni', $attributes);
                                ?>
                                <div class="form-body">


                                <div class="form-group">
                                    <label class="col-md-2 control-label"> Yeterlilik </label>
                                    <div class="col-md-4">
                                        <select class="form-control" id = "yeterlilik" name = "yeterlilik" required>
                                        <option value="">Seçiniz</option>

                                        <?php foreach($yeterlilikler as $yeterlilik){?>
                                        <option value="<?php echo $yeterlilik->id;?>"><?php echo $yeterlilik->kod." ".$yeterlilik->ad." (Rev".$yeterlilik->revizyon.")";?></option>
                                        <?php }?>
                                        </select>
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <label class="col-md-2 control-label"> Birim </label>
                                    <div class="col-md-4">
                                        <select  class="form-control" id = "birim" name = "birim" required="">
                                            <option value="Seçiniz">Yeterlilik Seçiniz</option>
                                        </select>
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-2 control-label"> Başarım Ölçütü </label>
                                    <div class="col-md-6">
                                        <select  class="form-control" id = "basarimolcut_teorik" name = "basarimolcut" required="">
                                            <option value="Seçiniz">Başarım Ölçütü Seçiniz</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> Zorluk </label>
                                    <div class="col-md-4">
                                        <select class="form-control" id = "zorluk" name = "zorluk" required="">
                                            <option value="">Seçiniz</option>
                                            <option value="1">Seviye 1</option>
                                            <option value="2">Seviye 2</option>
                                            <option value="3">Seviye 3</option>

                                        </select>
                                    </div>
                                </div>


                                    <div class="form-group">
                                        <label class="control-label col-md-2"> Soru Resmi </label>
                                        <div class="col-md-3">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="input-group input-large">
                                                    <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                        <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                        <span class="fileinput-filename"> </span>
                                                    </div>
                                                    <span class="input-group-addon btn default btn-file">
                                                                                    <span class="fileinput-new"> Select file </span>
                                                                                    <span class="fileinput-exists"> Change </span>
                                                                                    <input type="file" name="soruresim" id="soruresim"> </span>
                                                    <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Soru </label>
                                        <div class="col-md-4">
                      
                                        <textarea required="" id="soru" name="soru"  class="form-control"><?php echo set_value('soru')?></textarea>
                                            <span class="help-block">Soru durumuna göre 4 şıklı yada 5 şıklı soru için şıklar boş bırakılabilir</span>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> A </label>
                                        <div class="col-md-4">
                                            <input id = "a" name = "a" type="text"   class="form-control"  placeholder="A Şıkkı" value="<?php echo set_value('a')?>">
                                        </div>
                                          <div class="col-md-3">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="input-group input-large">
                                                    <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                        <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                        <span class="fileinput-filename"> </span>
                                                    </div>
                                                    <span class="input-group-addon btn default btn-file">
                                                                                    <span class="fileinput-new"> Select file </span>
                                                                                    <span class="fileinput-exists"> Change </span>
                                                                                    <input type="file" name="Aresim" , id="Aresim"> </span>
                                                    <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> B </label>
                                        <div class="col-md-4">
                                            <input id = "b" name = "b" type="text"   class="form-control"  placeholder="B Şıkkı" value="<?php echo set_value('b')?>">
                                        </div>
                                          <div class="col-md-3">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="input-group input-large">
                                                    <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                        <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                        <span class="fileinput-filename"> </span>
                                                    </div>
                                                    <span class="input-group-addon btn default btn-file">
                                                                                    <span class="fileinput-new"> Select file </span>
                                                                                    <span class="fileinput-exists"> Change </span>
                                                                                    <input type="file" name="Bresim" id="Bresim"> </span>
                                                    <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> C </label>
                                        <div class="col-md-4">
                                            <input id = "c" name = "c" type="text"   class="form-control"  placeholder="C Şıkkı" value="<?php echo set_value('c')?>">
                                        </div>
                                          <div class="col-md-3">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="input-group input-large">
                                                    <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                        <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                        <span class="fileinput-filename"> </span>
                                                    </div>
                                                    <span class="input-group-addon btn default btn-file">
                                                                                    <span class="fileinput-new"> Select file </span>
                                                                                    <span class="fileinput-exists"> Change </span>
                                                                                    <input type="file" name="Cresim" id="Cresim"> </span>
                                                    <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> D </label>
                                        <div class="col-md-4">
                                            <input id = "d" name = "d" type="text"   class="form-control"  placeholder="D Şıkkı" value="<?php echo set_value('d')?>">
                                        </div>
                                          <div class="col-md-3">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="input-group input-large">
                                                    <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                        <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                        <span class="fileinput-filename"> </span>
                                                    </div>
                                                    <span class="input-group-addon btn default btn-file">
                                                                                    <span class="fileinput-new"> Select file </span>
                                                                                    <span class="fileinput-exists"> Change </span>
                                                                                    <input type="file" name="Dresim" id="Dresim"> </span>
                                                    <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> E </label>
                                        <div class="col-md-4">
                                            <input id = "e" name = "e" type="text" class="form-control"  placeholder="E Şıkkı" value="<?php echo set_value('e')?>">
                                        </div>
                                          <div class="col-md-3">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="input-group input-large">
                                                    <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                        <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                        <span class="fileinput-filename"> </span>
                                                    </div>
                                                    <span class="input-group-addon btn default btn-file">
                                                                                    <span class="fileinput-new"> Select file </span>
                                                                                    <span class="fileinput-exists"> Change </span>
                                                                                    <input type="file" name="Eresim" id="Eresim"> </span>
                                                    <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                 <div class="form-group">
                                    <label class="col-md-2 control-label"> Doğru Cevap Şıkkı </label>
                                    <div class="col-md-4">
                                        <select class="form-control" id = "dogrucevap" name = "dogrucevap" required="">
                                        <option value="">Seçiniz</option>
                                        <option value="A">A</option>
                                        <option value="B ">B</option>
                                        <option value="C ">C</option>
                                        <option value="D ">D</option>
                                        <option value="E ">E</option>
                                        </select>
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