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
                                                    <a href="<?php echo base_url('soru/teorik/yeni')?>"> <button id="sample_editable_1_new" class="btn sbold green"> Yeni Teorik Soru
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
                                            <th> Yeterlilik </th>
                                            <th> Birim </th>
                                            <th> Soru </th>
                                            <th> Zorluk Derecesi </th>
                                            <th> Cevap şıkları </th>
                                            <th> Doğru Cevap </th>
                                            <th> İşlemler </th>
                                        </tr>

                                        </thead>
                                        <tbody>
                                        <?php foreach($teoriksorular as $teoriksoru){?>
                                        <tr class="odd gradeX">
                                            <td> <?php echo $teoriksoru->soruid;?> </td>

                                            <td>
                                                <?php echo $teoriksoru->yeterlilikad;?>
                                            </td>

                                            <td>
                                                <?php echo $teoriksoru->birimad;?>
                                            </td>

                                             <td>
                                                <?php echo $teoriksoru->soru;?>
                                            </td>
                                            <td><?php echo $teoriksoru->zorluk;?></td>
                                            <td>
                                            <ul>
                                                <?php if($teoriksoru->A != ""){?><li>A) <?php echo $teoriksoru->A;?></li><?php }?>
                                                <?php if($teoriksoru->B != ""){?><li>B) <?php echo $teoriksoru->B;?></li><?php }?>
                                                <?php if($teoriksoru->C != ""){?><li>C) <?php echo $teoriksoru->C;?></li><?php }?>
                                                <?php if($teoriksoru->D != ""){?><li>D) <?php echo $teoriksoru->D;?></li><?php }?>
                                                <?php if($teoriksoru->E != ""){?><li>E) <?php echo $teoriksoru->E;?></li><?php }?>
                                            </ul>
                                            <td><?php echo $teoriksoru->dogrucevap;?></td>

                                                
                                            </td>


                                            <td>

                                                <div class="btn-group">
                                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> İşlemler
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-left" role="menu">
                                                        <li>
                                                            <a href="#">
                                                                <i class="fa fa-pencil"></i> Detay </a>
                                                        </li>

                                                        <li>
                                                            <a onclick='return confirm("Kayıdı Silmek İstediğinizden Emin Misiniz ?")' href="#">
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