<?= $this->extend('pages\layout\dashboard\template') ?>

<?= $this->section('content') ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?= $title ?></h4>
                        </div>
                        <div class="card-body">
                            <form action="/profil/<?= $user['id']; ?>/process_edit" method="post">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-5 pr-1">
                                        <div class="form-group">
                                            <label>Cabang Olahraga</label>
                                            <?php foreach($cabor as $data_cabor) : ?>
                                                <?php if($user['id_cabor'] == $data_cabor['id']){ ?>
                                                        <input type="text" class="form-control" placeholder="Cabang Olahraga" value="<?= $data_cabor['nama_cabor'] ?>" disabled>
                                                <?php } ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3 px-1">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" placeholder="Nama" value="<?= $user['nama'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4 pl-1">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" placeholder="Email" value="<?= $user['email'] ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>Tempat Lahir</label>
                                            <input type="text" class="form-control" placeholder="Tempat Lahir" value="<?= $user['tempat_lahir'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-1">
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" class="form-control" placeholder="Tanggal Lahir" value="<?= $user['tanggal_lahir'] ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea class="form-control" rows="3" placeholder="Alamat atlet" style="height: 70px" disabled><?= $user['alamat']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <input type="text" class="form-control" placeholder="Jenis Kelamin" value="<?= $user['jenis_kelamin'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                                            <small id="emailHelp" class="form-text text-muted">Isi password jika ingin ubah.</small>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-user">
                        <div class="card-image">
                            <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="...">
                        </div>
                        <div class="card-body">
                            <div class="author">
                                <a href="#">
                                    <?php if(session()->get('role') == 2){ ?>
                                    <a data-lightbox="example-set-profile" data-title="<?= $user['nama']; ?>" href="/assets/img/pelatih/<?= $user['foto']; ?>">
                                        <img src="/assets/img/pelatih/<?= $user['foto']; ?>" class="avatar border-gray" />
                                    </a>
                                    <?php } else { ?>
                                        <a data-lightbox="example-set-profile" data-title="<?= $user['nama']; ?>" href="/assets/img/pelatih/<?= $user['foto']; ?>">
                                            <img src="/assets/img/atlet/<?= $user['foto']; ?>" class="avatar border-gray" />
                                        </a>
                                    <?php } ?>
                                    <h5 class="title font-weight-bold"><?= $user['nama'] ?></h5>
                                </a>
                                <p class="description">
                                    <?= $user['email'] ?>
                                </p>
                            </div>
                        </div>
                        <hr style="margin-top: -70px" />
                        <div class="button-container mr-auto ml-auto">
                            <button href="#" class="btn btn-simple btn-link btn-icon">
                                <i class="fa fa-circle text-success"></i> ACTIVE
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>