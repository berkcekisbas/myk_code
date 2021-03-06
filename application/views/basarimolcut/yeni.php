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
                                        <span class="caption-subject font-dark bold uppercase"><?php echo $baslik;?></span>
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
                                echo form_open('yeterlilik/yenibasarimolcutu/'.$this->uri->segment(3), $attributes);
                                ?>

                                 <div class="form-group">
                                    <label class="col-md-2 control-label"> Yeterlilik </label>
                                    <div class="col-md-4">
                                        <select class="form-control" id = "tip" name = "tip" required="">
                                        <option value="T">TEORİK</option>
                                        <option value="P ">PRATİK</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"> Birimler </label>
                                    <div class="col-md-4">
                                        <select class="form-control" id = "birim" name = "birim" required="">
                                        <?php foreach ($birimler as $birim) {
                                            echo '<option value="'.$birim->id.'">'.$birim->kod.' - '.$birim->ad.'</option>';
                                        }?>
                                        
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Başarım Ölçütü</label>
                                    <div class="col-md-4">
                                        <input id = "ad" name = "basarimolcutu" type="text" required  class="form-control"  placeholder="Başarım Ölçütü" required="">
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