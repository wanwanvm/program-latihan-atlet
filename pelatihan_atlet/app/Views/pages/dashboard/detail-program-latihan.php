<?= $this->extend('pages\layout\dashboard\template') ?>

<?= $this->section('content') ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php 
                    $loop = "";
                    $i = 1;
                    $j = 0;
                    foreach($jenis as $data) :
                        $bobot_2 = (($data['bobot'] / 100) / 5 * $grade[$j]) * 100;
                        $loop .= 
                        "
                        <tr>
                            <td class='text-center'>".$i++."</td>
                            <td>$data[nama]</td>
                            <td>$data[bobot]%</td>
                            <td>$data[benchmarking]</td>
                            <td>$data[nilai]</td>
                            <td>$kategori[$j]</td>
                            <td>$grade[$j]</td>
                            <td>5</td>
                            <td>$data[nama]</td>
                            <td>$bobot_2</td>
                        </tr>
                        ";
                        $j++;
                    endforeach;
                    ?>

                    <?php $content = "
                    <div class='wrapper-a4' id='printable-area'>
                        <div class='card'>
                            <div class='card-header'>
                                <h5 class='card-title text-center text-uppercase' style='font-weight: bold !important'>
                                    CABANG OLAHRAGA $program[nama_cabor]
                                </h5>
                                <hr/>
                            </div>
                            <div class='card-body'>
                                <div class='row' style='margin-top: -20px'>
                                    <div class='col-md-2'>
                                        <p>Nama : $program[nama]</p>
                                        <p style='margin-top: -10px'>Kelas : $program[nama_kelas]</p>
                                    </div>
                                    <div class='col-md-3'>
                                        <p>Tinggi Badan : $tinggi_badan M</p>
                                        <p style='margin-top: -10px'>Berat Badan : $program[berat_badan] Kg</p>
                                    </div>
                                    <div class='col-md-4'>
                                        <p>IMT : $imt</p>
                                        <p style='margin-top: -10px'>($hasil_imt)</p>
                                    </div>
                                </div>

                                <div class='row'>
                                    <div class='col-md-10'>
                                        <table class='table-atlet' border='1'>
                                            <thead>
                                                <tr id='background-print-1' style='background-color: #4287f5;color:#fff;'>
                                                    <th scope='col' class='text-center'>no</th>
                                                    <th scope='col'>komponen tes</th>
                                                    <th scope='col'>bobot</th>
                                                    <th scope='col'>benchmarking</th>
                                                    <th scope='col'>hasil</th>
                                                    <th scope='col'>kategori</th>
                                                    <th scope='col'>grade</th>
                                                    <th scope='col'>target</th>
                                                    <th scope='col'>komponen tes</th>
                                                    <th scope='col'>bobot %</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                $loop
                                                <tr>
                                                    <td colspan=2 class='font-weight-bold text-center'>TOTAL %</td>
                                                    <td class='font-weight-bold'>$bobot1 %</td>
                                                    <td colspan=5></td>
                                                    <td class='font-weight-bold text-center'>TOTAL %</td>
                                                    <td class='font-weight-bold'>$bobot2</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class='col-md-2'>
                                        <table class='table-atlet' border='1'>
                                            <thead>
                                                <tr id='background-print-2' style='background-color: #fcff47;'>
                                                    <th scope='col' class='text-center'>status fisik</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class='text-center'>
                                                        <span class='display-4'>$status_fisik</span>
                                                        <span class='d-block display-6' style='font-style: italic'>($keterangan_status)</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class='row mt-4'>
                                    <div class='col-md-4 text-center'>
                                        <img src='/assets/img/atlet/$program[foto]' class='rounded img-fluid' width='150' />
                                        <table class='table-atlet-other' border='1'>
                                            <thead>
                                                <tr>
                                                    <th class='background-print-other' style='background-color: whitesmoke;'>Jarak Lari (Tes Lari 40')</th>
                                                    <th>$program[tes_lari]</th>
                                                </tr>
                                                <tr>
                                                    <th class='background-print-other' style='background-color: whitesmoke;'>Kemanpuan maksimal daya tahan aerobik (VCr 100% dalam m/s)</th>
                                                    <th>$program[vcr]</th>
                                                </tr>
                                                <tr>
                                                    <th class='background-print-other' style='background-color: whitesmoke;'>Waktu 100% dalam  1 Putaran (400 meter dalam satuan detik)</th>
                                                    <th>$program[putaran]</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class='col-md-5'>
                                        <canvas id='marksChart' width='100' height='100'></canvas>
                                    </div>
                                    <div class='col-md-3 align-self-end text-right'>
                                        <button class='btn btn-primary' id='printPageButton' onclick='window.print()'>Download <i class='fa fa-print'></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ";

                    echo $content;
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- GRAFIK STATISTIK -->
    <script>
        var marksCanvas = document.getElementById("marksChart");

        var marksData = {
        labels: [
            <?php
                foreach ($jenis as $data) {
                    echo "'" .$data['nama'] ."',";
                }
            ?>
        ],
        datasets: [{
            label: "Target",
            borderColor: "rgba(200,0,0,0.2)",
            data: [
                <?php
                    foreach ($jenis as $data) {
                        echo "5,";
                    }
                ?>
            ]
        }, {
            label: "Grade",
            borderColor: "rgba(0,0,200,0.2)",
            data: [
                <?php
                    $i = 0;
                    foreach ($jenis as $data) {
                        echo "'" .$grade[$i] ."',";
                        $i++;
                    }
                ?>
            ]
        }]
        };

        var radarChart = new Chart(marksCanvas, {
            type: 'radar',
            data: marksData
        });
    </script>
<?= $this->endSection() ?>