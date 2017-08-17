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
                                                    <a href="<?php echo base_url('yeterlilik/yeni')?>"> <button id="sample_editable_1_new" class="btn sbold green"> Yeni Yeterlilik
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

                                            <?php foreach ($this->meslek_model->fields() as $field){?>
                                            <th> <?php echo $field['label']?> </th>
                                            <?php }?>
                                            <th> Durum </th>

                                            <th> İşlemler </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($meslekler as $meslek){?>
                                        <tr class="odd gradeX">
                                            <td> <?php echo $meslek->id;?> </td>

                                            <td> <?php echo $meslek->kod;?> </td>
                                            <td>
                                                <?php echo $meslek->ad;?>
                                            </td>
                                            <td> <?php echo $meslek->seviye;?> </td>
                                            <td> <?php echo $meslek->sektor;?> </td>

                                            <td> <?php echo $meslek->revizyon;?> </td>
                                            <td> <?php echo date("d-m-Y", strtotime($meslek->onaytarihi));?> </td>
                                            <td> <?php echo $meslek->onaysayisi;?> </td>
                                            <td>
                                                <?php if($meslek->aktif == TRUE){?>
                                                <span class="label label-sm label-success"> Aktif </span>
                                                <?php } else if($meslek->aktif == FALSE){?>
                                                    <span class="label label-sm label-danger"> Pasif </span>
                                                <?php }?>
                                            </td>

                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> İşlemler
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-left" role="menu">
                                                        <li>
                                                            <a href="<?php echo base_url('meslek/duzenle/'.$meslek->id)?>">
                                                                <i class="fa fa-pencil"></i> Düzenle </a>
                                                        </li>
                                                        <li>
                                                            <?php if($meslek->aktif == TRUE){?>
                                                                <a href="<?php echo base_url('meslek/durum/'.$meslek->id."/0")?>">
                                                                    <i class="fa fa-close"></i> Pasif Yap </a>
                                                            <?php } else if($meslek->aktif == FALSE){?>
                                                                <a href="<?php echo base_url('meslek/durum/'.$meslek->id."/1")?>">
                                                                    <i class="fa fa-bolt"></i> Aktif Yap </a>
                                                            <?php }?>
                                                        </li>
                                                        <li>
                                                            <a onclick='return confirm("Kayıdı Silmek İstediğinizden Emin Misiniz ?")' href="<?php echo base_url('meslek/sil/'.$meslek->id)?>">
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