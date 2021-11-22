<?= $this->extend('pages\layout\dashboard\template') ?>

<?= $this->section('content') ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">DETAIL PELATIH</h4>
                            <hr/>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <div class="profile-wrapper">
                                    <a data-lightbox="example-set" data-title="<?= $pelatih['nama']; ?>" href="/assets/img/pelatih/<?= $pelatih['foto']; ?>">
                                        <img src="/assets/img/pelatih/<?= $pelatih['foto']; ?>" width="150" height="150" class="rounded-circle example-image"/>
                                    </a>
                                    <h4 class="font-weight-bold text-info" style="margin-top: 5px"><?= $pelatih['nama']; ?></h4>
                                    <h5 style="margin-top: -15px"><?= $pelatih['email']; ?></h5>
                                    <a class="btn btn-primary edit-button-rounded" href="/manage-pelatih/<?= $pelatih['id'] ?>/edit" role="button">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="row p-1" style="margin-top: 0px;margin: 5px 30px;">
                                <div class="col-12">
                                    <?php foreach($cabor as $data_cabor) : ?>
                                        <?php if($pelatih['id_cabor'] == $data_cabor['id']){ ?>
                                                <p class="text-detail"><span class="font-weight-bold">Cabor : </span><?= $data_cabor['nama_cabor']; ?></p>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                    <p class="text-detail"><span class="font-weight-bold">Jenis Kelamin : </span><?= $pelatih['jenis_kelamin']; ?></p>
                                    <p class="text-detail"><span class="font-weight-bold">Tempat Lahir : </span><?= $pelatih['tempat_lahir']; ?></p>
                                    <p class="text-detail"><span class="font-weight-bold">Tanggal Lahir : </span><?= $pelatih['tanggal_lahir']; ?></p>
                                    <p class="text-detail"><span class="font-weight-bold">Alamat</span> : <?= $pelatih['alamat']; ?></p>
                                </div>
                                <a href="/manage-pelatih" class="btn btn-link btn-simple">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <h4>Atlet Terkait</h4>
                    <?php if(!empty($atlet_terkait->getResult('array'))){ ?>
                    <div class="row">
                        <?php foreach($atlet_terkait->getResult('array') as $data) : ?>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">
                                            <a data-lightbox="example-set-atlet" data-title="<?= $data['nama']; ?>" href="/assets/img/atlet/<?= $data['foto']; ?>">
                                                <img src="/assets/img/atlet/<?= $data['foto']; ?>" width="50" height="50" class="rounded example-image"/>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <h5 class="font-weight-bold" style="margin-bottom: 0px"><?= $data['nama'] ?></h5>
                                            <p><?= $data['email'] ?></p>
                                        </div>
                                        <div class="col text-right">
                                            <a href="/manage-atlet/<?= $data['id']; ?>/detail">
                                                <i class="fa fa-arrow-circle-right text-right text-primary"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php } else { ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger" role="alert">
                                    Belum ada atlet.
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>