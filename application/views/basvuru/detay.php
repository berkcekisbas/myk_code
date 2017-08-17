<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 4.5
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>USTA</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo base_url();?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?php echo base_url();?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />




    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo base_url();?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?php echo base_url();?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="<?php echo base_url();?>assets/layouts/layout3/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/layouts/layout3/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="<?php echo base_url();?>assets/layouts/layout3/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.css" />

    <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid page-boxed">
    <!-- BEGIN HEADER -->


<!-- END HEADER -->

<!-- BEGIN CONTAINER -->
<div class="page-container">

<!--
    Ideally these elements aren't created until it's confirmed that the 
    client supports video/camera, but for the sake of illustrating the 
    elements involved, they are created with markup (not JavaScript)
-->
<!--
<video id="video" width="640" height="480" autoplay></video>
<button id="snap">Snap Photo</button>
<canvas id="canvas" width="640" height="480"></canvas>
-->

<script type="text/javascript">
    // Grab elements, create settings, etc.
var video = document.getElementById('video');

// Get access to the camera!
if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    // Not adding `{ audio: true }` since we only want video now
    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
        video.src = window.URL.createObjectURL(stream);
        video.play();
    });
}

/* Legacy code below: getUserMedia 
else if(navigator.getUserMedia) { // Standard
    navigator.getUserMedia({ video: true }, function(stream) {
        video.src = stream;
        video.play();
    }, errBack);
} else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
    navigator.webkitGetUserMedia({ video: true }, function(stream){
        video.src = window.webkitURL.createObjectURL(stream);
        video.play();
    }, errBack);
} else if(navigator.mozGetUserMedia) { // Mozilla-prefixed
    navigator.mozGetUserMedia({ video: true }, function(stream){
        video.src = window.URL.createObjectURL(stream);
        video.play();
    }, errBack);
}
*/

// Elements for taking the snapshot
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var video = document.getElementById('video');

// Trigger photo take
document.getElementById("snap").addEventListener("click", function() {
    context.drawImage(video, 0, 0, 640, 480);
});
</script>

<div class="portlet light portlet-fit bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-settings font-dark"></i>
                                    <span class="caption-subject font-dark sbold uppercase">Başvuru Detayları</span>
                                </div>
                              
                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="user" class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <td style="width:15%"> Yeterlilik </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->kod;?> <?php echo $basvuru->adsoyad;?> SEVİYE <?php echo $basvuru->seviye;?>
                                                            (Rev <?php echo $basvuru->revizyon;?>)
                                                        </span>
                                                    </td>
                                               </tr>
                                               <tr>
                                                    <td style="width:15%"> Alternatif </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> 
                                                        <?php 
                                                        if($basvuru->alternatifid == 0)
                                                        {
                                                            echo "---";
                                                        } else {
                                                            echo $basvuru->alternatifad." . ALTERNATİF";
                                                        }
                                                        ?> </span>
                                                    </td>
                                               </tr>
                                               <tr>
                                                    <td style="width:15%"> Birimler </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->birimler;?> </span>
                                                    </td>
                                               </tr>
                                               <tr>
                                                    <td style="width:15%"> Uyruk </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->uyruk;?> </span>
                                                    </td>
                                               </tr>
                                               <tr>
                                                    <td style="width:15%"> T.C No </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->basvuruid;?> </span>
                                                    </td>
                                               </tr>
                                               <tr>
                                                    <td style="width:15%"> Aday İsim Soyisim </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->adayad." ".$basvuru->adaysoyad;?> </span>
                                                    </td>
                                               </tr><tr>
                                                    <td style="width:15%"> Aday Doğum Tarihi </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->dogumtarihi;?> </span>
                                                    </td>
                                               </tr><tr>
                                                    <td style="width:15%"> Cinsiyet </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->cinsiyet;?> </span>
                                                    </td>
                                               </tr><tr>
                                                    <td style="width:15%"> Yaşadığı Şehir </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->yasadigisehir;?> </span>
                                                    </td>
                                               </tr><tr>
                                                    <td style="width:15%"> Doğum Yeri </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->dogumyeri;?> </span>
                                                    </td>
                                               </tr><tr>
                                                    <td style="width:15%"> Ev Telefonu </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->evtelefonu;?> </span>
                                                    </td>
                                               </tr>
                                               <tr>
                                                    <td style="width:15%"> Cep Telefonu </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->ceptelefonu;?> </span>
                                                    </td>
                                               </tr><tr>
                                                    <td style="width:15%"> Eposta </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->eposta;?> </span>
                                                    </td>
                                               </tr><tr>
                                                    <td style="width:15%"> İrtibat Adresi </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->irtibatadresi;?> </span>
                                                    </td>
                                               </tr><tr>
                                                    <td style="width:15%"> Sınav Ücreti Ödemesi </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->ucretgeriodeme;?> </span>
                                                    </td>
                                               </tr><tr>
                                                    <td style="width:15%"> Çalışma Durumu </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->calismadurumu;?> </span>
                                                    </td>
                                               </tr><tr>
                                                    <td style="width:15%"> Çalıştığı İŞ Yeri / Kurum Adı </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->isyeriadi;?> </span>
                                                    </td>
                                               </tr><tr>
                                                    <td style="width:15%"> Çalıştığı Yerdeki Görevi </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->gorevi;?> </span>
                                                    </td>
                                               </tr><tr>
                                                    <td style="width:15%"> İşyeri Telefonu </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->isyeritelefonu;?> </span>
                                                    </td>
                                               </tr><tr>
                                                    <td style="width:15%"> Sektörde Çalışılan Toplam Süre </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->calisilantoplamsure;?> </span>
                                                    </td>
                                               </tr>
                                               <tr>
                                                    <td style="width:15%"> İş Deneyimleri </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->isdeneyimleri;?> </span>
                                                    </td>
                                               </tr>
                                               <tr>
                                                    <td style="width:15%"> Eğitim Durumu </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->egitimdurumu;?> </span>
                                                    </td>
                                               </tr>
                                               <tr>
                                                    <td style="width:15%"> Belge Bilgileri </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->belgebilgileri;?> </span>
                                                    </td>
                                               </tr>
                                               <tr>
                                                    <td style="width:15%"> Başvuru Tarihi </td>
            
                                                    <td style="width:35%">
                                                        <span class="text-muted"> <?php echo $basvuru->basvurutarihi;?> </span>
                                                    </td>
                                               </tr>

                                            </tbody>
                                        </table>
                                        <a href="<?php echo base_url('basvuru/form/'.$basvuru->basvuruid)?>" class="btn btn-info">Başvuru Formu Yazdır</a>
                                        <a href="#" class="btn btn-info">Sınav Giriş Belgesi Yazdır</a>   
                                    </div>
                                </div>
                             
                            </div>
                        </div>

</div>


<!-- END INNER FOOTER -->
<!-- END FOOTER -->
<!--[if lt IE 9]>
<script src="<?php echo base_url();?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url();?>assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.input-ip-address-control-1.0.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>


<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo base_url();?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/pages/scripts/form-input-mask.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/pages/scripts/table-datatables-managed.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
</script>
<!-- END PAGE LEVEL SCRIPTS -->


</body>

</html>