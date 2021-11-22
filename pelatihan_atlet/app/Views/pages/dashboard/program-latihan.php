<?= $this->extend('pages\layout\dashboard\template') ?>

<?= $this->section('content') ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                                <?php if(session()->get('role') == 2 || session()->get('role') == 3){ ?>
                                    <h4 class="card-title d-inline text-uppercase"><?= $title; ?> - <?= $cabor['nama_cabor'] ?></h4>
                                <?php } else { ?>
                                    <h4 class="card-title d-inline text-uppercase"><?= $title; ?></h4>
                                <?php } ?>
                                <?php if(session()->get('role') == 2){ ?>
                                <a href="/program-latihan/create" class="btn btn-info btn-fill pull-right">
                                    TAMBAH PROGRAM LATIHAN
                                    <i class="fa fa-plus"></i>
                                </a>
                                <?php } ?>
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
                                                    <th>Nama Atlet</th>
                                                    <th>Tanggal Latihan</th>
                                                    <th>Kesimpulan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php foreach($program->getResult('array') as $data) : ?>
                                                    <tr>
                                                        <td class="text-center"><?= $i++; ?></td>
                                                        <td><?= $data['nama'] ?></td>
                                                        <td><?= $data['tanggal_latihan'] ?></td>
                                                        <td>
                                                            <span class="badge badge-<?= ($data['kesimpulan'] === 'baik') ? 'success' : (($data['kesimpulan'] === 'cukup') ? 'info' : (($data['kesimpulan'] === 'kurang baik') ? 'warning' : 'danger')) ?>">
                                                                <?= $data['kesimpulan'] == null ? 'Belum dinilai' : $data['kesimpulan'] ?>
                                                            </span>
                                                        </td>
                                                        <td class="td-actions">
                                                            <?php if(session()->get('role') == 2){ ?>
                                                            <a href="/program-latihan/<?= $data['id']; ?>/detail" rel="tooltip" title="Detail" class="btn btn-info btn-simple btn-link">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            <a href="/program-latihan/<?= $data['id_atlet']; ?>/grafik" rel="tooltip" title="Grafik" class="btn btn-success btn-simple btn-link">
                                                                <i class="fa fa-signal"></i>
                                                            </a>
                                                            <a href="javascript:" data-toggle="modal" data-target="#modalDeleteProgram<?= $data['id']; ?>" rel="tooltip" title="Delete" class="btn btn-danger btn-simple btn-link">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                            <?php } else { ?>
                                                                <a href="/program-latihan/<?= $data['id']; ?>/detail" class='btn btn-sm btn-success'>Lihat Detail</a>
                                                                <a href="/program-latihan/<?= $data['id_atlet']; ?>/grafik" class='btn btn-sm btn-primary'>Grafik</a>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <!-- Delete Modal -->
                                                    <div class="modal fade modal-mini modal-primary" id="modalDeleteProgram<?= $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-body text-center">
                                                                    <p class="font-weight-bold">Hapus data <?= $data['nama']; ?> tanggal <?= $data['tanggal_latihan'] ?>?</p>
                                                                </div>
                                                                <div class="modal-footer pull-right">
                                                                    <button type="button" class="btn btn-link btn-simple" data-dismiss="modal">Close</button>
                                                                    <a href="/program-latihan/<?= $data['id']; ?>/delete" class="btn btn-danger btn-simple">Delete</a>
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
            </div>
        </div>
    </div>
<?= $this->endSection() ?>