<?= $this->extend('pages\layout\dashboard\template') ?>

<?= $this->section('content') ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">DETAIL ATLET</h4>
                            <hr/>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <div class="profile-wrapper">
                                    <a data-lightbox="example-set" data-title="<?= $atlet['nama']; ?>" href="/assets/img/atlet/<?= $atlet['foto']; ?>">
                                        <img src="/assets/img/atlet/<?= $atlet['foto']; ?>" width="150" height="150" class="rounded-circle example-image"/>
                                    </a>

                                    <h4 class="font-weight-bold" style="margin-top: 5px"><?= $atlet['nama']; ?></h4>
                                    <h5 style="margin-top: -15px"><?= $atlet['email']; ?></h5>
                                    <a class="btn btn-primary edit-button-rounded" href="/manage-atlet/<?= $atlet['id'] ?>/edit" role="button">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="row p-1" style="margin-top: 0px;margin: 5px 30px;">
                                <div class="col-12">
                                    <?php foreach($cabor as $data_cabor) : ?>
                                        <?php if($atlet['id_cabor'] == $data_cabor['id']){ ?>
                                                <p class="text-detail"><span class="font-weight-bold">Cabor : </span><?= $data_cabor['nama_cabor']; ?></p>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                    <?php foreach($kelas as $data_kelas) : ?>
                                        <?php if($atlet['id_kelas'] == $data_kelas['id']){ ?>
                                                <p class="text-detail"><span class="font-weight-bold">Kelas : </span><?= $data_kelas['nama_kelas']; ?></p>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                    <p class="text-detail"><span class="font-weight-bold">Jenis Kelamin : </span><?= $atlet['jenis_kelamin']; ?></p>
                                    <p class="text-detail"><span class="font-weight-bold">Tempat Lahir : </span><?= $atlet['tempat_lahir']; ?></p>
                                    <p class="text-detail"><span class="font-weight-bold">Tanggal Lahir : </span><?= $atlet['tanggal_lahir']; ?></p>
                                    <p class="text-detail"><span class="font-weight-bold">Alamat</span> : <?= $atlet['alamat']; ?></p>
                                </div>
                                <a href="javascript:" onclick="return window.history.back()" class="btn btn-link btn-simple">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <h4>Statistik</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title">Fisik</h6>
                                    <hr/>
                                </div>
                                <div class="card-body table-responsive" style="margin-top: -20px">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Tinggi Badan</th>
                                                <th>Berat Badan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?= isset($fisik['tinggi_badan']) == null ? '-' : $fisik['tinggi_badan'] ?> Cm</td>
                                                <td><?= isset($fisik['berat_badan']) == null ? '-' : $fisik['berat_badan'] ?> Kg</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title">Latihan</h6>
                                    <hr/>
                                </div>
                                <div class="card-body table-responsive" style="margin-top: -20px">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama Pelatih</th>
                                                <th>Nama Latihan</th>
                                                <th>Nilai</th>
                                                <th>Tanggal Latihan</th>
                                                <th>Kesimpulan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(count($latihan->getResult('array')) !== 0){ ?>
                                                <?php foreach($latihan->getResult('array') as $data_latihan) : ?>
                                                <tr>
                                                    <td><?= $data_latihan['nama_pelatih'] ?></td>
                                                    <td><?= $data_latihan['nama_latihan'] ?></td>
                                                    <td><?= $data_latihan['nilai'] ?></td>
                                                    <td><?= $data_latihan['tanggal_latihan'] ?></td>
                                                    <td>
                                                        <span class="badge badge-<?= ($data_latihan['kesimpulan'] === 'baik') ? 'success' : (($data_latihan['kesimpulan'] === 'cukup') ? 'info' : (($data_latihan['kesimpulan'] === 'kurang baik') ? 'warning' : 'danger')) ?>">
                                                            <?= $data_latihan['kesimpulan'] ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                    <?php if(count($latihan->getResult('array')) == 0){ ?>
                                        <h5 class='text-center pt-3'>DATA KOSONG</h5>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>