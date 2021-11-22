<?= $this->extend('pages\layout\dashboard\template') ?>

<?= $this->section('content') ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header">
                                <h4 class="card-title d-inline">TAMBAH ATLET</h4>
                            <hr/>
                        </div>
                        <div class="card-body">
                            <?php 
                                $errors = $validation->getErrors();
                                if(!empty($errors))
                                { ?>
                                    <span class="text-danger">
                                        <?= $validation->listErrors(); ?>
                                    </span> 
                                <?php } ?>
                            <form action="/manage-atlet/add" enctype='multipart/form-data' method="post">
                                <?= csrf_field(); ?>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <select class="form-control" id="select-cabor" name="select_cabor">
                                            <option value="">PILIH CABANG OLAHRAGA</option>
                                            <?php foreach($cabor as $data_cabor) : ?>
                                                <option value="<?= $data_cabor['id']; ?>"><?= $data_cabor['nama_cabor'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="nama_atlet" name="nama_atlet" placeholder="Nama Atlet" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="email" class="form-control" id="email_atlet" name="email_atlet" placeholder="Email Atlet" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Kota Lahir" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <select class="form-control" id="select-kelas" name="select_kelas">
                                            <option value="">Pilih Kelas</option>
                                            <?php foreach($kelas as $data_kelas) : ?>
                                                <option value="<?= $data_kelas['id']; ?>">Kelas - <?= $data_kelas['nama_kelas'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <select class="form-control" id="select-jk" name="select_jk">
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control" id="alamat-atlet" name="alamat_atlet" rows="3" placeholder="Alamat Atlet" style="height: 100px"></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="foto-atlet">Foto</label>
                                        <input type="file" class="form-control-file" id="foto-atlet" name="file_upload">
                                    </div>
                                    <div class="form-group col-md-6 align-self-center">
                                        <input type="text" class="form-control" id="password_atlet" name="password_atlet" placeholder="Password Atlet" required>
                                    </div>
                                </div>
                                <a href="/manage-atlet" class="btn btn-link btn-simple">Kembali</a>
                                <button type="submit" class="btn btn-primary btn-simple">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>