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

                                            <?php foreach ($this->yeterlilik_model->fields() as $field){?>
                                            <th> <?php echo $field['label']?> </th>
                                            <?php }?>
                                            <th> Durum </th>
                                            <th> İşlemler </th>

                                            <th> İşlemler </th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($yeterlilikler as $yeterlilik){?>
                                        <tr class="odd gradeX">
                                            <td> <?php echo $yeterlilik->id;?> </td>

                                            <td> <?php echo $yeterlilik->kod;?> </td>
                                            <td>
                                                <?php echo $yeterlilik->ad;?>
                                            </td>
                                            <td> <?php echo $yeterlilik->seviye;?> </td>
                                            <td> <?php echo $yeterlilik->sektor;?> </td>

                                            <td> <?php echo $yeterlilik->revizyon;?> </td>
                                            <td> <?php echo date("d-m-Y", strtotime($yeterlilik->onaytarihi));?> </td>
                                            <td> <?php echo $yeterlilik->onaysayisi;?> </td>
                                            <td> <?php echo $yeterlilik->belgegecerliliksuresi;?> Yıl</td>

                                            <td>
                                                <?php if($yeterlilik->aktif == TRUE){?>
                                                <span class="label label-sm label-success"> Aktif </span>
                                                <?php } else if($yeterlilik->aktif == FALSE){?>
                                                    <span class="label label-sm label-danger"> Pasif </span>
                                                <?php }?>
                                            </td>

                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-xs btn-warning dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> İşlemler
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-left" role="menu">
                                                        <li>
                                                            <a href="<?php echo base_url('yeterlilik/birim/birimler/zorunlu/'.$yeterlilik->id);?>">
                                                                <i class="fa fa-circle"></i> Zorunlu Birimler </a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php echo base_url('yeterlilik/birim/birimler/secmeli/'.$yeterlilik->id);?>">
                                                                <i class="fa fa-circle"></i> Seçmeli Birimler </a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php echo base_url('yeterlilik/birim/birimler/alternatif/'.$yeterlilik->id);?>">
                                                                <i class="fa fa-circle"></i> Alternatifler </a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php echo base_url('yeterlilik/basarimolcutleri/'.$yeterlilik->id);?>">
                                                                <i class="fa fa-circle"></i> Başarım Ölçütleri </a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </td>


                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> İşlemler
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-left" role="menu">
                                                    <li>
                                                            <a href="<?php echo base_url('yeterlilik/sorusablonu/'.$yeterlilik->id)?>">
                                                                <i class="fa fa-building"></i> Soru Şablonu </a>
                                                        </li>

                                                        <li>
                                                            <a href="<?php echo base_url('yeterlilik/duzenle/'.$yeterlilik->id)?>">
                                                                <i class="fa fa-pencil"></i> Düzenle </a>
                                                        </li>
                                                        <li>
                                                            <?php if($yeterlilik->aktif == TRUE){?>
                                                                <a href="<?php echo base_url('yeterlilik/durum/'.$yeterlilik->id."/0")?>">
                                                                    <i class="fa fa-close"></i> Pasif Yap </a>
                                                            <?php } else if($yeterlilik->aktif == FALSE){?>
                                                                <a href="<?php echo base_url('yeterlilik/durum/'.$yeterlilik->id."/1")?>">
                                                                    <i class="fa fa-bolt"></i> Aktif Yap </a>
                                                            <?php }?>
                                                        </li>
                                                        <li>
                                                            <a onclick='return confirm("Kayıdı Silmek İstediğinizden Emin Misiniz ?")' href="<?php echo base_url('yeterlilik/sil/'.$yeterlilik->id)?>">
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