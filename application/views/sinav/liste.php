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
                          
                                   <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Yeterlilik </th>
                                            <th> Sınav ID </th>
                                            <th> Sınav Tarih / Saat </th>
                                            <th> Sınav Yeri </th>
                                            <th> İşlemler </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($sinavlar as $sinav){?>
                                        <tr class="odd gradeX">
                                            <td> <?php echo $sinav->sinav_id;?> </td>
                                            <td> <?php echo $sinav->yeterlilik_kod." / ". $sinav->yeterlilik_ad." SEVİYE ". $sinav->yeterlilik_seviye ." (REV-".$sinav->yeterlilik_revizyon.")";?> </td>
                                            <td> <?php echo $sinav->sinavid;?> </td>
                                            <td> <?php echo date("d-m-Y",strtotime($sinav->sinavtarihi));?> - <?php echo $sinav->sinavsaati;?> </td>
                                            <td> <?php echo $sinav->sinavyeri_ad;?> </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> İşlemler
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-left" role="menu">
                                                        <li>
                                                            <a href="<?php echo base_url('sinav/detay/teorik/').$sinav->sinav_id;?>">
                                                                <i class="fa fa-search-plus"></i> Detaylı Görünüm </a>
                                                        </li>

                                                        <li>
                                                            <a href="<?php echo base_url('sinav/teorik/adaylistesi/').$sinav->sinav_id;?>">
                                                                <i class="fa fa-file"></i> Aday Listesi </a>
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