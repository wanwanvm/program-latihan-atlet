<?= $this->extend('pages\layout\dashboard\template') ?>

<?= $this->section('content') ?>
    <div class="content">
        <div class="container-fluid">
            <!-- ADMIN -->
            <?php if(session()->get('role') == 1){ ?>
                <div class="row">
                    <div class="col-md-4">
                        <a href="/cabang-olahraga">
                            <div class="card ">
                                <div class="card-header text-center">
                                    <h4 class="card-title">JUMLAH CABOR</h4>
                                </div>
                                <div class="card-body text-center">
                                    <div class="text-center">
                                        <i class="fa fa-plus icon-size"></i>
                                        <h1 class="font-weight-bold"><?= $count_cabor_asdep ?></h1>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/manage-pelatih">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h4 class="card-title">JUMLAH PELATIH</h4>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="fa fa-users icon-size"></i>
                                        <h1 class="font-weight-bold"><?= $count_pelatih_asdep ?></h1>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/manage-atlet">
                            <div class="card ">
                                <div class="card-header text-center">
                                    <h4 class="card-title">JUMLAH ATLET</h4>
                                </div>
                                <div class="card-body text-center">
                                    <div class="text-center">
                                        <i class="fa fa-users icon-size"></i>
                                        <h1 class="font-weight-bold"><?= $count_atlet_asdep ?></h1>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php } ?>
            <!-- PELATIH -->
            <?php if(session()->get('role') == 2){ ?>
                <div class="row">
                    <div class="col-md-6">
                        <a href="/program-latihan">
                            <div class="card ">
                                <div class="card-header text-center">
                                    <h4 class="card-title">TOTAL PROGRAM LATIHAN</h4>
                                </div>
                                <div class="card-body text-center">
                                    <div class="text-center">
                                        <i class="fa fa-plus icon-size"></i>
                                        <h1 class="font-weight-bold"><?= $count_program_pelatih; ?></h1>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="/program-latihan">            
                            <div class="card">
                                <div class="card-header text-center">
                                    <h4 class="card-title">JUMLAH ATLET</h4>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="fa fa-users icon-size"></i>
                                        <h1 class="font-weight-bold"><?= $count_atlet_pelatih; ?></h1>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php } ?>

            <!-- ATLET -->
            <?php if(session()->get('role') == 3){ ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-header">
                                    <h6 class="card-title">STATISTIK BOBOT PERKEMBANGAN LATIHAN</h6>
                                </div>
                            </div>

                            <div class="card-body">
                                <div style="width:100%">
                                    <canvas id="canvas" style="max-height: 350px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- GRAFIK ATLET -->
    <script>
        var chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(231,233,237)'
        };

        var randomScalingFactor = function() {
            return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
        }

        var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var config = {
        type: 'line',
        data: {
            labels: [
                <?php
                    foreach ($grafik_day as $data) {
                        echo "'" .date("d M Y", strtotime($data['tanggal_latihan'])) ."',";
                    }
                ?>
            ],
            datasets: [{
            label: "Nilai Pelatihan",
            backgroundColor: chartColors.red,
            borderColor: chartColors.red,
            data: [
                <?php
                    foreach ($grafik_day as $data) {
                        echo "'" .$data['bobot'] ."',";
                    }
                ?>
            ],
            fill: false,
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Chart.js Line Chart'
            },
            tooltips: {
                mode: 'label',
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                display: true,
                labelString: 'Month'
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                display: true,
                labelString: 'Value'
                }
            }]
            }
        }
        };


        var ctx = document.getElementById("canvas").getContext("2d");
        window.myLine = new Chart(ctx, config);

    </script>
<?= $this->endSection() ?>