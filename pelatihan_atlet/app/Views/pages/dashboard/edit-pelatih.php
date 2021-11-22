<?= $this->extend('pages\layout\dashboard\template') ?>

<?= $this->section('content') ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header">
                                <h4 class="card-title d-inline">EDIT PELATIH</h4>
                            <hr/>
                        </div>
                        <div class="card-body">
                            <form action="/manage-pelatih/<?= $pelatih['id']; ?>/process_edit" enctype='multipart/form-data' method="post">
                                <?= csrf_field(); ?>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <select class="form-control" id="select-cabor" name="select_cabor">
                                            <option value="">PILIH CABANG OLAHRAGA</option>
                                            <?php foreach($cabor as $data_cabor) : ?>
                                                <option value="<?= $data_cabor['id']; ?>" <?= $data_cabor['id'] == $pelatih['id_cabor'] ? 'selected' : null ?>><?= $data_cabor['nama_cabor'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" value="<?= $pelatih['nama']; ?>" id="nama_pelatih" name="nama_pelatih" placeholder="Nama Pelatih" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="email" class="form-control" value="<?= $pelatih['email']; ?>" id="email_pelatih" name="email_pelatih" placeholder="Email Pelatih" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" value="<?= $pelatih['tempat_lahir']; ?>" id="tempat_lahir" name="tempat_lahir" placeholder="Kota Lahir" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="date" class="form-control" value="<?= $pelatih['tanggal_lahir']; ?>" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <select class="form-control" id="select-jk" name="select_jk">
                                            <option value="Laki-Laki" <?= $pelatih['jenis_kelamin'] == 'Laki-Laki' ? 'selected' : null ?>>Laki-Laki</option>
                                            <option value="Perempuan" <?= $pelatih['jenis_kelamin'] == 'Perempuan' ? 'selected' : null ?>>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control" id="alamat-pelatih" name="alamat_pelatih" rows="3" placeholder="Alamat Pelatih" style="height: 100px"><?= $pelatih['alamat']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <img src="/assets/img/pelatih/<?= $pelatih['foto']; ?>" width="100" class="rounded img-fluid"/>
                                        <input type="file" class="form-control-file mt-1" value="<?= $pelatih['foto']; ?>" id="foto-pelatih" name="file_upload">
                                    </div>
                                    <div class="form-group col-md-6 align-self-center">
                                        <input type="text" class="form-control" id="password_pelatih" name="password_pelatih" placeholder="Password Pelatih">
                                        <small class="form-text text-muted">Isi password jika ingin diubah.</small>
                                    </div>
                                </div>
                                <a href="/manage-pelatih/<?= $pelatih['id']; ?>/detail" class="btn btn-link btn-simple">Kembali</a>
                                <button type="submit" class="btn btn-primary btn-simple">Ubah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>