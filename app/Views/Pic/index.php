<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

 <!--   <?php if(session()->get('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          Data pic Berhasil<strong><?=session()->getFlashdata('message'); ?></strong> 
        </div>
    <?php endif; ?> -->

  <div class="swal" data-swal="<?= session()->get('message'); ?>"></div>

  <!-- Sweet Alert -->
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
<!-- End Sweet Alet -->

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
            
          </div>
        </div>
        <div class="card-body">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <!-- <th>No.</th> -->
                        <th>Id PIC</th>
                        <th>Name PIC</th>
                        <th>Email</th>
                        <th>Posisi PIC</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php if(!empty($pic)) : ?>
                    <?php foreach($pic as $row) :  ?>
                        <tr>
                            
                            <td><?= $row['id_user']; ?></td>
                            <td><?= $row['name_pic']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td><?= $row['position_pic']; ?></td>
                            <td>
                              <button type="button" data-toggle="modal" data-target="#modalUbah" id="btn-ubahh" class="btn btn-sm btn-warning" 
                              data-id_user="<?= $row['id_user']; ?>"
                              data-name_pic="<?= $row['name_pic']; ?>"
                              data-email="<?= $row['email']; ?>"
                              data-position="<?= $row['position_pic']; ?>"
                              ><i class="fa fa-edit"></i></button>
                              <!--<button type="button" data-toggle="modal" data-target="#modalHapus" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button>-->
                              <a href="/pic/hapus/<?= $row['id_user']; ?>" class="btn btn-sm btn-danger btn-hapus"><i class="fa fa-trash-alt"></i></a>
                            </td>

                          <!-- Modal box edit Data -->
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
                                          <form action="<?= base_url('pic/ubah'); ?>" method="post">
                                          <input type="hidden" name="id_user" id="idpic">
                                            <div class="form-group mb-0">
                                              <label for="name_pic"></label>
                                              <input type="text" name="name_pic" id="name_pic" class="form-control" placeholder="Masukkan nama pic" value="<?= $row ['name_pic'] ?>">
                                            </div>
                                            <div class="form-group mb-0">
                                              <label for="email"></label>
                                              <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email pic" value="<?= $row ['email'] ?>">
                                            </div>
                                            <div class="form-group mb-0">
                                              <label for="position"></label>
                                              <input type="text" name="position_pic" id="position_pic" class="form-control" placeholder="Masukkan posisi pic" value="<?= $row ['position_pic'] ?>">
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
                <form action="<?= base_url('pic/tambah'); ?>" method="post" enctype="multipart/form-data">
                  <div class="form-group mb-0">
                    <label for="name_pic"></label>
                    <input type="text" name="name_pic" id="name_pic" class="form-control" placeholder="Masukkan Name pic">
                  </div>
                  <div class="form-group mb-0">
                    <label for="email"></label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email pic">
                  </div>
                  <div class="form-group mb-0">
                    <label for="position_pic"></label>
                    <input type="text" name="position_pic" id="position_pic" class="form-control" placeholder="Masukkan posisi pic">
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



<!-- Modal Hapus data pic -->
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
