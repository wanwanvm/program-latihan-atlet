<?= $this->extend('pages\layout\dashboard\template') ?>

<?= $this->section('content') ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7 mx-auto">
                    <div class="card">
                        <div class="card-header">
                                <h4 class="card-title d-inline">TAMBAH PROGRAM LATIHAN</h4>
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
                            <form action="/program-latihan/tanggal-program" method="post">
                                <?= csrf_field(); ?>
                                <h6 class="ml-2">Tanggal Program</h6>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <select class="form-control" id="id-atlet" name="id_atlet">
                                            <option value="">PILIH ATLET</option>
                                            <?php foreach($atlet->getResult('array') as $data_atlet) : ?>
                                                <option value="<?= $data_atlet['id_atlet'] ?>"><?= $data_atlet['nama_atlet'] ?> (<?= $data_atlet['nama_cabor'] ?>)</option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="date" class="form-control" id="tanggal_latihan" name="tanggal_latihan" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm" style="margin-top: -20px;margin-left: 11px;">Tambahkan</button>
                                <hr/>
                            </form>
                            <form action="/program-latihan/add" method="post">
                                <h6 class="ml-2">Program Latihan</h6>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <select class="form-control cari-program" id="cari-program" name="cari_program" style="width: 99.9%">
                                            <option value="">CARI PROGRAM</option>
                                            <?php foreach($cari_program->getResult('array') as $data_program) : ?>
                                                <option value="<?= $data_program['id'] ?>"><?= $data_program['nama_atlet'] ?> (<?= $data_program['tanggal_latihan'] ?>)</option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <h6 class="ml-2">Fisik</h6>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="number" class="form-control" id="berat_badan" name="berat_badan" placeholder="Berat Badan" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan" placeholder="Tinggi Badan" required>
                                    </div>
                                </div>
                                <div class="container-program">
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <input type="text" class="form-control" id="program_latihan" name="program_latihan[]" placeholder="..." required>
                                            <small id="emailHelp" class="form-text text-muted">Nama program</small>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input type="text" class="form-control" id="bobot" name="bobot[]" placeholder="..." required>
                                            <small id="emailHelp" class="form-text text-muted">Bobot</small>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input type="text" class="form-control" id="benchmarking" name="benchmarking[]" placeholder="..." required>
                                            <small id="emailHelp" class="form-text text-muted">Benchmarking</small>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input type="text" class="form-control" id="score_latihan" name="score_latihan[]" placeholder="..." required>
                                            <small id="emailHelp" class="form-text text-muted">Score</small>
                                        </div>
                                        <i class="fa fa-plus fa-lg text-success add_form_field mt-3" style="cursor: pointer"></i>
                                    </div>
                                </div>
                                <h6 class="ml-2">Jarak Lari (Tes Lari 40')</h6>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <input type="number" class="form-control" id="tes_lari" name="tes_lari" placeholder="..." required>
                                    </div>
                                </div>
                                <h6 class="ml-2">Kemanpuan maksimal daya tahan aerobik (VCr 100% dalam m/s)</h6>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <input type="text" class="form-control" id="vcr" name="vcr" placeholder="..." required>
                                    </div>
                                </div>
                                <h6 class="ml-2">Waktu 100% dalam  1 Putaran (400 meter dalam satuan detik)</h6>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <input type="text" class="form-control" id="putaran" name="putaran" placeholder="..." required>
                                    </div>
                                </div>
                                <h6 class="ml-2">Kesimpulan</h6>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <select class="form-control" id="kesimpulan" name="kesimpulan">
                                            <option value="">PILIH KESIMPULAN</option>
                                            <option value="baik">Baik</option>
                                            <option value="cukup">Cukup</option>
                                            <option value="kurang baik">Kurang Baik</option>
                                            <option value="buruk">Buruk</option>
                                        </select>
                                    </div>
                                </div>
                                <a href="/program-latihan" class="btn btn-link btn-simple">Kembali</a>
                                <button type="submit" class="btn btn-primary btn-simple">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>