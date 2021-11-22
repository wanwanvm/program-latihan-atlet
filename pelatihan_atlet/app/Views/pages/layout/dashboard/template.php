<!-- 
=========================================================
 Light Bootstrap Dashboard - v2.0.1
=========================================================

 Product Page: https://www.creative-tim.com/product/light-bootstrap-dashboard
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 Licensed under MIT (https://github.com/creativetimofficial/light-bootstrap-dashboard/blob/master/LICENSE)

 Coded by Creative Tim

=========================================================

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.  -->
 <!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Pelatihan Atlet | Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="shortcut icon" href="/assets/img/logo/logo.jpeg" type="image/x-icon">
    <!-- CSS Files -->
    <link href="/assets/css/dashboard/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/css/dashboard/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="/assets/css/dashboard/demo.css" rel="stylesheet" />
    <link href="/assets/css/dashboard/style.css" rel="stylesheet" />
    <!-- TOASTR -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- DataTable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
    <!-- PhotoBox -->
    <link href="/assets/plugin/photobox/lightbox.css" rel="stylesheet" />
    <!-- SELECT 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="wrapper">
        <!-- SIDEBAR -->
            <?= $this->include('pages/layout/dashboard/sidebar') ?>
        <!-- END SIDEBAR -->
        
        <div class="main-panel">
            <!-- Navbar -->
                <?= $this->include('pages/layout/dashboard/navbar') ?>
            <!-- End Navbar -->

            <!-- CONTENT -->
                <?= $this->renderSection('content') ?>
            <!-- END CONTENT -->

            <!-- FOOTER -->
                <?= $this->include('pages/layout/dashboard/footer') ?>
            <!-- END FOOTER -->
        </div>
    </div>
</body>

<!--   Core JS Files   -->
<script src="/assets/js/dashboard/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="/assets/js/dashboard/core/popper.min.js" type="text/javascript"></script>
<script src="/assets/js/dashboard/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="/assets/js/dashboard/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="/assets/js/dashboard/plugins/chartist.min.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="/assets/js/dashboard/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="/assets/js/dashboard/demo.js"></script>
<!-- DataTable -->
<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<!-- Photobox -->
<script src="/assets/plugin/photobox/lightbox.js"></script>
<!-- SELECT2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        demo.showNotification();

    });
</script>

<!-- TOASTR -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript">
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    <?php if(session()->get('success')){ ?>
        toastr.success("<?= session()->get('success'); ?>");
    <?php }else if(session()->get('error')){  ?>
        toastr.error("<?= session()->get('error'); ?>");
    <?php }else if(session()->get('warning')){  ?>
        toastr.warning("<?= session()->get('warning'); ?>");
    <?php }else if(session()->get('info')){  ?>
        toastr.info("<?= session()->get('info'); ?>");
    <?php } ?>
</script>

<!-- DATA TABLE CABOR -->
<script>
    $(document).ready(function() {
        $('#table_cabor').DataTable();
    } );
</script>

<!-- SELECT 2 CARI PROGRAM -->
<script>
    $(document).ready(function() {
        $('.cari-program').select2();
    });
</script>

<!-- ARRAY VALUE INPUT LATIHAN -->
<script>
    $(document).ready(function() {
        var max_fields = 10;
        var wrapper = $(".container-program");
        var add_button = $(".add_form_field");

        var x = 1;
        $(add_button).click(function(e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append(`
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" id="program_latihan" name="program_latihan[]" placeholder="..." required>
                        <small id="emailHelp" class="form-text text-muted">Nama program latihan</small>
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text" class="form-control" id="bobot" name="bobot[]" placeholder="..." required>
                        <small id="emailHelp" class="form-text text-muted">Bobot</small>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" id="benchmarking" name="benchmarking[]" placeholder="..." required>
                        <small id="emailHelp" class="form-text text-muted">Benchmarking</small>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" id="score_latihan" name="score_latihan[]" placeholder="..." required>
                        <small id="emailHelp" class="form-text text-muted">Score</small>
                    </div>
                    <i class="fa fa-trash fa-lg text-danger delete mt-3" style="cursor: pointer"></i>
                </div>
                `);
            } else {
                alert('Maksimal field 10.')
            }
        });

        $(wrapper).on("click", ".delete", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
</script>
</html>
