<?= $this->extend('pages\layout\dashboard\template') ?>

<?= $this->section('content') ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                                <h4 class="card-title d-inline"><?= $title; ?></h4>
                                <a href="/manage-pelatih/create" class="btn btn-info btn-fill pull-right">
                                    TAMBAH PELATIH
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
                                                    <th>Nama Pelatih</th>
                                                    <th>Cabor Terkait</th>
                                                    <th>Email</th>
                                                    <th>Foto</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php foreach($pelatih->getResult('array') as $data) : ?>
                                                <tr>
                                                    <td class="text-center"><?= $i++; ?></td>
                                                    <td><?= $data['nama']; ?></td>
                                                    <td><?= $data['nama_cabor']; ?></td>
                                                    <td><?= $data['email']; ?></td>
                                                    <td>
                                                        <img src="/assets/img/pelatih/<?= $data['foto']; ?>" width="50" height="50" class="rounded-circle" />    
                                                    </td>
                                                    <td class="td-actions">
                                                        <a href="/manage-pelatih/<?= $data['id_user']; ?>/detail" rel="tooltip" title="Detail" class="btn btn-success btn-simple btn-link">
                                                            <i class="fa fa-list"></i>
                                                        </a>
                                                        <a href="javascript:" data-toggle="modal" data-target="#modalDeletePelatih<?= $data['id_user']; ?>" rel="tooltip" title="Delete" class="btn btn-danger btn-simple btn-link">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <!-- Delete Modal -->
                                                <div class="modal fade modal-mini modal-primary" id="modalDeletePelatih<?= $data['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body text-center">
                                                                <p class="font-weight-bold">Hapus data <?= $data['nama']; ?>?</p>
                                                            </div>
                                                            <div class="modal-footer pull-right">
                                                                <button type="button" class="btn btn-link btn-simple" data-dismiss="modal">Close</button>
                                                                <a href="/manage-pelatih/<?= $data['id_user']; ?>/delete" class="btn btn-danger btn-simple">Delete</a>
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