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
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>

                                        <span class="caption-subject bold uppercase"> <?php echo $baslik;?></span>
                                    </div>
                                </div>
                                <?php
                                if($this->session->flashdata('success'))
                                {
                                    echo '<div class="alert alert-success">
                                          <i class="fa fa-check-circle"></i> '.$this->session->flashdata('success').'</div>';
                                }
                                ?>
                                <div class="portlet-body">
                                    <div class="table-toolbar">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="btn-group">
                                                    <a href="<?php echo base_url('yeterlilik/birim/yeni/'.$this->uri->segment(4)."/".$this->uri->segment(5))?>"> <button id="sample_editable_1_new" class="btn sbold green"> Yeni Alternatif
                                                        <i class="fa fa-plus"></i>
                                                    </button></a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                        <tr>

                                            <th> # </th>

                                            <?php foreach ($this->alternatif_model->fields() as $field){?>
                                            <th> <?php echo $field['label']?> </th>
                                            <?php }?>
                                            <th> İşlemler </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($results as $result){?>
                                        <tr class="odd gradeX">
                                            <td> <?php echo $result->id;?> </td>

                                            <td> <?php echo $this->yeterlilik_model->yeterlilik_ad($result->yeterlilik);?> </td>
                                            <td>
                                                <?php echo $result->ad;?>
                                            </td>

                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> İşlemler
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-left" role="menu">
                                                        <li>
                                                            <a href="<?php echo base_url('yeterlilik/duzenle/'.$result->id)?>">
                                                                <i class="fa fa-pencil"></i> Düzenle </a>
                                                        </li>

                                                        <li>
                                                            <a onclick='return confirm("Kayıdı Silmek İstediğinizden Emin Misiniz ?")' href="<?php echo base_url('yeterlilik/birim/sil/'.$result->id."/".$this->uri->segment(4)."/".$this->uri->segment(5))?>">
                                                                <i class="fa fa-trash-o"></i> Sil </a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </td>



                                        </tr>
                                        <?php }?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
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