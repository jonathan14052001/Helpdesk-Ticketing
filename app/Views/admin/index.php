<!-- Begin Page Content -->

<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>

 <!--   <?php if(session()->get('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          Data Ticket Berhasil<strong><?=session()->getFlashdata('message'); ?></strong> 
        </div>
        <?php endif; ?> -->

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

<div class="card">
  <div class="card-header">
        <div class="row">
          <div class="col-6">
            <form action="" method="post" enctype="multipart/form-data">
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
  <div class="card-body">
    <table class="table table-striped text-center">
        <div class="row">
            <div class="col-lg-8">
            <table class="table table-striped text-center">
          <thead class="thead-gray">
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Username</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
              <?php $i = 1; ?>
              <?php if(!empty($users)) : ?>
              <?php foreach($users as $user) : ?>
            <tr>
              <th scope="row"><?= $i++; ?></th>
              <td><?= $user->username; ?></td>
              <td>
              <a href="/admin/hapus/<?= $user->userid; ?>" class="btn btn-sm btn-danger btn-hapus"><i class="fa fa-trash-alt"></i></a>
                <a href="<?= base_url('admin/'. $user->userid)?>" class="btn btn-info">Detail</a>

              </td>
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
  </table>
  </div>
</div>


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
            <form action="<?= route_to('register') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
              <div class="form-group mb-0">
                  <label for="email"></label>
                  <input type="email" class="form-control <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>"
                          name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>" value="<?= old('email') ?>">
              </div>

              <div class="form-group mb-0">
                  <label for="username"></label>
                  <input type="text" class="form-control <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?=lang('Auth.username')?>" value="<?= old('username') ?>">
              </div>

              <div class="form-group mb-0">
                  <label for="password"></label>
                  <input type="password" name="password" class="form-control <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>" autocomplete="off">
              </div>

              <div class="form-group mb-0">
                  <label for="pass_confirm"></label>
                  <input type="password" name="pass_confirm" class="form-control <?php if(session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.repeatPassword')?>" autocomplete="off">
              </div>     
              <!-- <div class="form-group mb-0">
                    <label for="name"></label>
                    <select name="name" id="name"  class="form-control">

                    </select>
              </div> -->
              <br>
              <button type="submit" class="btn btn-primary btn-block">Tambah</button>
          </form>
        </div>
    </div>
</div>




<!-- Modal Hapus data Ticket -->
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

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

