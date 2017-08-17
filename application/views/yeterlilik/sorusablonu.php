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
                                        <span class="caption-subject font-dark bold uppercase"><?php echo $data['baslik'];?></span>
                                    </div>
                                </div>
                                <?php
                                if(validation_errors())
                                {
                                    echo '<div class="alert alert-danger">';
                                    echo validation_errors('<b>','</b><br>');
                                    echo '</div>';
                                }

                                $attributes = array('class' => 'form-horizontal', 'role' => 'form');
                                echo form_open('yeterlilik/sorusablonu/'.$this->uri->segment(3), $attributes);
                                ?>

                                <div class="form-body">
                                 <?php foreach($birimler as $birim){?>
                                                <h3 class="form-section"><?php echo $birim->kod;?> / <?php echo $birim->ad;?></h3>
                                               <div class="form-group">
                                                    <label class="control-label col-md-3">Soru Sayısı
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-2">
                                                    <input required="" name="sorusayisi[<?php echo $birim->id;?>][]" type="text" class="form-control" />
                                                    </div>
                                     
                                                </div>

                                                <?php }?>
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