<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

    <div class="swal" data-swal="<?= session()->get('message'); ?>"></div>

<div class="row">
  <div class="col-md-6">
    <?php
      if (session()->get('err')){
          echo "<div class='alert alert-danger' role='alert'>". session()->get('err') ."</div>";
          session()->remove('err');
      }
    ?>
  </div>
</div>

    <div class="card">
    <div class="card-header">
          <div class="row">
            <div class="col-6">
              <form action="" method="post">
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Masukkan Keyword Pencarian.." name="keyword">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit" name="submit">Cari</button>
                </div>
              </div>
              </form>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                <i class="fa fa-plus"> Tambah Data</i>
              </button>
            </div>
            <div class="col-md">
              <!-- <button onclick="window.print()" class="btn btn-outline-secondary shadow float-right ml-2">Print <i class="fa fa-print"></i></button> -->
              <a href="/progress/excel" class="btn btn-outline-success shadow float-right">Excel <i class="fa fa-file-excel"></i> </a>
            </div>
          </div>
        </div>
        <div class="card-body">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Id Ticket</th>
                        <th>Persen Progress</th>
                        <th>Solusi</th>
                        <th>Status Ticket</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php if(!empty($progress)) : ?>
                    <?php foreach($progress as $row) :  ?>
                        <tr>
                            <td scope="row"><?= $i++; ?></td>
                            <td><?= $row['id_ticket']; ?></td>
                            <td><?= $row['persen_progress']; ?></td>
                            <td><?= $row['solution']; ?></td>
                            
                            <td>
                              <span class="badge <?php if ($row['status_ticket'] == '0') {
                                          echo 'badge-danger';
                                        }
                                        else {
                                          echo 'badge-success';
                                        }
                                        ?>"><?= $row['status_ticket']; ?>
                              </span>
                            </td>
                            <td>
                              <button type="button" data-toggle="modal" data-target="#modalUbah" id="btn-editt" class="btn btn-sm btn-warning" 
                              data-id="<?= $row['id']; ?>"
                              data-id_ticket="<?= $row['id_ticket']; ?>"
                              data-persen_progress="<?= $row['persen_progress']; ?>"
                              data-solution="<?= $row['solution']; ?>"
                              data-status_ticket="<?= $row['status_ticket']; ?>"
                              ><i class="fa fa-edit"></i></button>
                              <!--<button type="button" data-toggle="modal" data-target="#modalHapus" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button>-->
                              <a href="/progress/hapus/<?= $row['id']; ?>" class="btn btn-sm btn-danger btn-hapus"><i class="fa fa-trash-alt"></i></a>
                            </td>
                  <!-- Modal box edit Data Progress-->
                  <div class="modal fade" id="modalUbah">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title">Ubah <?=$judul; ?></h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                    </button>
                              </div>
                              <div class="modal-body">
                                  <form action="<?= base_url('progress/ubah'); ?>" method="post">
                                  <input type="hidden" name="id" id="idticket">
                                    <div class="form-group mb-0">
                                    <label for="id_ticket"></label>
                                      <input type="text" name="id_ticket" id="id_ticket" class="form-control" placeholder="Masukkan Id Ticket" value="<?= $row ['id_ticket'] ?>">
                                    </div>
                                    <div class="form-group mb-0">
                                      <label for="persen_progress"></label>
                                      <input type="text" name="persen_progress" id="persen_progress" class="form-control" placeholder="Masukkan Progress Penyelesaian" value="<?= $row ['persen_progress'] ?>">
                                    </div>
                                    <div class="form-group mb-0">
                                      <label for="solution"></label>
                                      <textarea type="text" name="solution" id="solution" cols="30" rows="3" class="form-control" placeholder="Masukkan Solusi Masalah"></textarea>
                                    </div>
                                    <div class="form-group mb-0">
                                      <label for="status_ticket"></label>
                                      <select name="status_ticket" class="form-control">
                                        <option value="0" <?= $row ['status_ticket'] == '0' ? 'selected' : '' ?>>0</option>
                                        <option value="1" <?= $row ['status_ticket'] == '1' ? 'selected' : '' ?>>1</option>
                                      </select>
                                     </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" name="ubah" class="btn btn-primary">Ubah Data</button>
                              </div>
                              </form>
                          </div>
                      </div>
                  </div>
                        </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                      <td colspan="11">
                        <h1 class="text-gray-500 text-center">Data tidak ada!</h1>
                      </td>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



<!-- Modal Tambah Data -->
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?=$judul; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                   </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('progress/tambah'); ?>" method="post">
                  <div class="form-group mb-0">
                    <label for="id_ticket"></label>
                    <input type="text" name="id_ticket" id="id_ticket" class="form-control" placeholder="Masukkan Id Ticket">
                  </div>
                  <div class="form-group mb-0">
                    <label for="persen_progress"></label>
                    <input type="text" name="persen_progress" id="persen_progress" class="form-control" placeholder="Masukkan Progress Penyelesaian">
                  </div>
                  <div class="form-group mb-0">
                    <label for="solution"></label>
                    <textarea type="text" name="solution" id="solution" cols="30" rows="3" class="form-control" placeholder="Masukkan Solusi Masalah"></textarea>
                  </div>
                  <div class="form-group mb-0">
                    <label for="status_ticket"></label>
                    <select name="status_ticket" class="form-control">
                      <option value="0" <?= $row ['status_ticket'] == '0' ? 'selected' : '' ?>>0</option>
                      <option value="1" <?= $row ['status_ticket'] == '1' ? 'selected' : '' ?>>1</option>
                    </select>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah Data</button>
            </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal Hapus data Progress -->
<div class="modal fade" id="modalHapus">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        Apakah anda yakin ingin menghapus data ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>