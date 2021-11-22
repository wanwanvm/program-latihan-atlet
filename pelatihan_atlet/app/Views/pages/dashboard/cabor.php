<?= $this->extend('pages\layout\dashboard\template') ?>

<?= $this->section('content') ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                                <h4 class="card-title d-inline"><?= $title; ?></h4>
                                <a href="javascript:" data-toggle="modal" data-target="#modalAddCabor" class="btn btn-info btn-fill pull-right">
                                    TAMBAH CABOR
                                    <i class="fa fa-plus"></i>
                                </a>
                            <hr/>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="table_cabor" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th style="width: 20px">No</th>
                                                    <th>Nama Cabang Olahraga</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php foreach($cabor as $data) : ?>
                                                <tr>
                                                    <td class="text-center"><?= $i++; ?></td>
                                                    <td><?= $data['nama_cabor']; ?></td>
                                                    <td class="td-actions">
                                                        <a href="javascript:" data-toggle="modal" data-target="#modalEditCabor<?= $data['id']; ?>" rel="tooltip" title="Edit" class="btn btn-info btn-simple btn-link">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="javascript:" data-toggle="modal" data-target="#modalDeleteCabor<?= $data['id']; ?>" rel="tooltip" title="Delete" class="btn btn-danger btn-simple btn-link">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="modalEditCabor<?= $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Cabang Olahraga</h5>
                                                                <a href="javascript:" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </a>
                                                            </div>
                                                            <form action="/cabang-olahraga/<?= $data['id']; ?>/edit" method="post">
                                                            <?= csrf_field(); ?>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="nama_cabor" value="<?= $data['nama_cabor']; ?>" name="nama_cabor" placeholder="Nama Cabang Olahraga" required>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer pull-right">
                                                                    <button type="button" class="btn btn-link btn-simple" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary btn-simple">Ubah</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--  End Edit Modal -->
                                                <!-- Delete Modal -->
                                                <div class="modal fade modal-mini modal-primary" id="modalDeleteCabor<?= $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body text-center">
                                                                <p class="font-weight-bold">Hapus data <?= $data['nama_cabor']; ?>?</p>
                                                            </div>
                                                            <div class="modal-footer pull-right">
                                                                <button type="button" class="btn btn-link btn-simple" data-dismiss="modal">Close</button>
                                                                <a href="/cabang-olahraga/<?= $data['id']; ?>/delete" class="btn btn-danger btn-simple">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--  End Delete Modal -->
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="myChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ADD CABOR -->
    <div class="modal fade" id="modalAddCabor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Cabang Olahraga</h5>
                    <a href="javascript:" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <form action="/cabang-olahraga/add" method="post">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="nama_cabor" name="nama_cabor" placeholder="Nama Cabang Olahraga" required>
                        </div>
                    </div>
                    <div class="modal-footer pull-right">
                        <button type="button" class="btn btn-link btn-simple" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-simple">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  End Modal Cabor -->

    <!-- GRAFIK CABOR -->
    <script >
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    <?php
                        foreach ($cabor_atlet->getResult('array') as $data) {
                            echo "'" .$data['nama_cabor'] ."',";
                        }
                    ?>
                ],
                datasets: [{
                    label: 'Jumlah Atlet Berdasarkan Cabang Olahraga',
                    data: [
                        <?php
                            foreach ($cabor_count->getResult('array') as $count) {
                                echo "'" .$count['jumlah'] ."',";
                            }
                        ?>
                    ],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        }
    </script>
<?= $this->endSection() ?>