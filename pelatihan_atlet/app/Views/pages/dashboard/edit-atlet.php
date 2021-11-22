<?= $this->extend('pages\layout\dashboard\template') ?>

<?= $this->section('content') ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header">
                                <h4 class="card-title d-inline">EDIT ATLET</h4>
                            <hr/>
                        </div>
                        <div class="card-body">
                            <form action="/manage-atlet/<?= $atlet['id']; ?>/process_edit" enctype='multipart/form-data' method="post">
                                <?= csrf_field(); ?>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <select class="form-control" id="select-cabor" name="select_cabor">
                                            <option value="">PILIH CABANG OLAHRAGA</option>
                                            <?php foreach($cabor as $data_cabor) : ?>
                                                <option value="<?= $data_cabor['id']; ?>" <?= $data_cabor['id'] == $atlet['id_cabor'] ? 'selected' : null ?>><?= $data_cabor['nama_cabor'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" value="<?= $atlet['nama']; ?>" id="nama_atlet" name="nama_atlet" placeholder="Nama Atlet" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="email" class="form-control" value="<?= $atlet['email']; ?>" id="email_atlet" name="email_atlet" placeholder="Email Atlet" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" value="<?= $atlet['tempat_lahir']; ?>" id="tempat_lahir" name="tempat_lahir" placeholder="Kota Lahir" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="date" class="form-control" value="<?= $atlet['tanggal_lahir']; ?>" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <select class="form-control" id="select-kelas" name="select_kelas">
                                            <option value="">Pilih Kelas</option>
                                            <?php foreach($kelas as $data_kelas) : ?>
                                                <option value="<?= $data_kelas['id']; ?>"  <?= $data_kelas['id'] == $atlet['id_kelas'] ? 'selected' : null ?>>Kelas - <?= $data_kelas['nama_kelas'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <select class="form-control" id="select-jk" name="select_jk">
                                            <option value="Laki-Laki" <?= $atlet['jenis_kelamin'] == 'Laki-Laki' ? 'selected' : null ?>>Laki-Laki</option>
                                            <option value="Perempuan" <?= $atlet['jenis_kelamin'] == 'Perempuan' ? 'selected' : null ?>>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control" id="alamat-atlet" name="alamat_atlet" rows="3" placeholder="Alamat atlet" style="height: 100px"><?= $atlet['alamat']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <img src="/assets/img/atlet/<?= $atlet['foto']; ?>" width="100" class="rounded img-fluid"/>
                                        <input type="file" class="form-control-file mt-1" value="<?= $atlet['foto']; ?>" id="foto-atlet" name="file_upload">
                                    </div>
                                    <div class="form-group col-md-6 align-self-center">
                                        <input type="text" class="form-control" id="password_atlet" name="password_atlet" placeholder="Password Atlet">
                                        <small class="form-text text-muted">Isi password jika ingin diubah.</small>
                                    </div>
                                </div>
                                <a href="/manage-atlet/<?= $atlet['id']; ?>/detail" class="btn btn-link btn-simple">Kembali</a>
                                <button type="submit" class="btn btn-primary btn-simple">Ubah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>