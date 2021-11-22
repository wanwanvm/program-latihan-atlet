<?= $this->extend('pages\layout\dashboard\template') ?>

<?= $this->section('content') ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header">
                                <?php foreach ($grafik_day as $data) { ?>
                                        <h6 class="card-title">STATISTIK BOBOT PERKEMBANGAN LATIHAN (<?= $data['nama'] ?>)</h6>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="card-body">
                            <div style="width:100%">
                                <canvas id="canvas-2" style="max-height: 350px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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


        var ctx = document.getElementById("canvas-2").getContext("2d");
        window.myLine = new Chart(ctx, config);

    </script>
<?= $this->endSection() ?>