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

                                <script type="text/javascript"></script>


                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Ad Soyad </th>
                                            <th> Başvuru Tarihi </th>
                                            <th> İşlemler </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($results as $result){?>
                                        <tr class="odd gradeX">
                                          <td> <?php echo $result->id;?>                                                     
                                                                                              

                                        </td>
                                           <td> <?php echo $result->adsoyad;?> </td>

                                            <td> <?php echo date('d-m-Y H:i:s',strtotime($result->basvurutarihi));?> </td>
                                            <td> 
                                            <div class="btn-group">


                                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> İşlemler
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-left" role="menu">

                                                        <!--<li>
                                                            <a data-fancybox data-type="iframe" data-src="<?php echo base_url('basvuru/detay/'.$result->id)?>" href="javascript:;">
                                                                <i class="fa fa-bars"></i> Detayları Göster </a>
                                                        </li> -->

                                                        <li>
                                                            <a href="<?php echo base_url('basvuru/form/'.$result->id)?>">
                                                                <i class="fa fa-file-word-o"></i> Başvuruyu Formu İndir </a>
                                                        </li>

                                                        <li>
                                                            <a href="<?php echo base_url('basvuru/onay/'.$result->id)?>">
                                                                <i class="fa fa-check"></i> Başvuruyu Onayla </a>
                                                        </li>
                                                        
                                                        <li>
                                                            <a onclick='return confirm("Kayıdı Silmek İstediğinizden Emin Misiniz ?")' href="
                                                            <?php echo base_url('basvuru/sil/'.$result->id)?>">
                                                                <i class="fa fa-trash-o"></i> Sil </a>
                                                        </li>

                                                    </ul>
                                                </div> </td>

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