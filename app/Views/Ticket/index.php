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
            
            <div class="col-4">
              
            </div>
            <div class="col-md">
              <!-- <button onclick="window.print()" class="btn btn-outline-secondary shadow float-right ml-2">Print<i class="fa fa-print"></i></button> -->
              <a href="/ticket/excel" class="btn btn-outline-success shadow float-right">Excel <i class="fa fa-file-excel"></i> </a>
            </div>
          </div>
        </div>
        <div class="card-body">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <!-- <th>No.</th> -->
                        <th>No Ticket</th>
                        <th>Id User</th>
                        <th>Urgency</th>
                        <th>Name Company</th>
                        <th>Name PIC</th>
                        <th>Position PIC</th>
                        <th>Problem Company</th>
                        <th>Status Ticket</th>
                        <th>Gambar</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php if(!empty($ticket)) : ?>
                    <?php foreach($ticket as $row) :  ?>
                        <tr>
                            
                            
                            <td><?= $row['no_ticket']; ?></td>
                            <td><?= $row['user_id']; ?></td>
                            <td>
                              <span class="badge <?php if ($row['urgency'] == 'Medium') {
                                          echo 'badge-info';
                                        } elseif ($row['urgency'] == 'Low') {
                                          echo 'badge-danger';
                                        } else {
                                          echo 'badge-success';
                                        }
                                        ?>"><?= $row['urgency']; ?>
                              </span>
                            </td>
                            <td><?= $row['name_company']; ?></td>
                            <td><?= $row['name_pic']; ?></td>
                            <td><?= $row['position_pic']; ?></td>
                            <td><?= $row['problem_company']; ?></td>
                            <td>
                              <span class="badge <?php if ($row['status_ticket'] == 'Progress') {
                                        echo 'badge-info';
                                      } elseif ($row['status_ticket'] == 'Pending') {
                                        echo 'badge-danger';
                                      } else {
                                        echo 'badge-success';
                                      }
                                      ?>"><?= $row['status_ticket']; ?>
                              </span>
                            </td>
                            <td><?= $row['image_ticket']; ?></td>
                            <td>
                              <button type="button" data-toggle="modal" data-target="#modalUbah" id="btn-edit" class="btn btn-sm btn-warning" 
                              data-id="<?= $row['id']; ?>"
                              data-no_ticket="<?= $row['no_ticket']; ?>"
                              data-user_id="<?= $row['user_id']; ?>"
                              data-urgency="<?= $row['urgency']; ?>"
                              data-name_company="<?= $row['name_company']; ?>"
                              data-name_pic="<?= $row['name_pic']; ?>"
                              data-position="<?= $row['position_pic']; ?>"
                              data-problem_company="<?= $row['problem_company']; ?>"
                              data-problem_details="<?= $row['problem_details']; ?>"
                              data-status_ticket="<?= $row['status_ticket']; ?>"
                              data-image_ticket="<?= $row['image_ticket']; ?>"
                              ><i class="fa fa-edit"></i></button>
                              <a href="/ticket/download/<?= $row['image_ticket']; ?>" class="btn btn-sm btn-success btn-download"><i class="fa fa-download"></i></a>
                              <!--<button type="button" data-toggle="modal" data-target="#modalHapus" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button>-->
                              <a href="/ticket/hapus/<?= $row['id']; ?>" class="btn btn-sm btn-danger btn-hapus"><i class="fa fa-trash-alt"></i></a>
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

    

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


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
                <form action="<?= base_url('ticket/ubah'); ?>" method="post" enctype="multipart/form-data">
                <?php if(!empty($ticket)) : ?>
                <input type="hidden" name="id" id="id-ticket">
                  <div class="form-group mb-0">
                    <label for="no_ticket"></label>
                    <input type="text" name="no_ticket" id="no_ticket" class="form-control" placeholder="Masukkan Nomor Ticket" value="<?= $row ['no_ticket'] ?>">
                  </div>
                  <div class="form-group mb-0">
                    <label for="user_id"></label>
                    <input type="text" name="user_id" id="user_id" class="form-control" placeholder="Masukkan Id User" value="<?= $row ['user_id'] ?>">
                  </div>
                  <div class="form-group mb-0">
                    <label for="urgency"></label>
                    <select name="urgency" class="form-control">
                      <option value="High" <?= $row ['urgency'] == 'High' ? 'selected' : '' ?>>High</option>
                      <option value="Medium" <?= $row ['urgency'] == 'Medium' ? 'selected' : '' ?>>Medium</option>
                      <option value="Low" <?= $row ['urgency'] == 'Low' ? 'selected' : '' ?>>Low</option>
                    </select>
                  </div>
                  <div class="form-group mb-0">
                    <label for="name_company"></label>
                    <select name="name_company" id="name_company"  class="form-control">
                    <?php if(!empty($company)) : ?>
                      <?php foreach ($company as $raw) :?>
                      <option value="<?= $raw['name_company'] ?>" ><?= $raw['name_company'] ?></option>
                      <?php endforeach; ?>
                      <?php else: ?>
                      <td colspan="11">
                        <h1 class="text-gray-500 text-center">Data tidak ada!</h1>
                      </td>
                      <?php endif; ?>
                    </select>
                  </div>
                  <div class="form-group mb-0">
                    <label for="name_pic"></label>
                    <select name="name_pic" id="name_pic" class="form-control">
                    <?php if(!empty($pic)) : ?>
                      <?php foreach ($pic as $rew) :?>
                      <option value="<?= $rew['name_pic'] ?>" ><?= $rew['name_pic'] ?></option>
                      <?php endforeach;?>
                      <?php else: ?>
                      <td colspan="11">
                        <h1 class="text-gray-500 text-center">Data tidak ada!</h1>
                      </td>
                      <?php endif; ?>
                    </select>
                  </div>
                  <div class="form-group mb-0">
                    <label for="position_pic"></label>
                    <select name="position_pic" id="position_pic" class="form-control">
                    <?php if(!empty($pic)) : ?>
                      <?php foreach ($pic as $riw) :?>
                      <option value="<?= $riw['position_pic'] ?>" ><?= $riw['position_pic'] ?></option>
                      <?php endforeach;?>
                      <?php else: ?>
                      <td colspan="11">
                        <h1 class="text-gray-500 text-center">Data tidak ada!</h1>
                      </td>
                      <?php endif; ?>
                    </select>
                  </div>
                  <div class="form-group mb-0">
                    <label for="problem_company"></label>
                    <input type="text" name="problem_company" id="problem_company" class="form-control" placeholder="Masukkan Judul Masalah" value="<?= $row ['problem_company'] ?>" >
                  </div>
                  <div class="form-group mb-0">
                    <label for="problem_details"></label>
                    <textarea type="text" name="problem_details" id="problem_details" cols="30" rows="3" class="form-control" placeholder="Masukkan Detail Masalah"></textarea>
                  </div>
                  <div class="form-group mb-0">
                    <label for="status_ticket"></label>
                    <select name="status_ticket" class="form-control">
                    <option value="Success" <?= $row ['status_ticket'] == 'Success' ? 'selected' : '' ?>>Success</option>
                    <option value="Progress" <?= $row ['status_ticket'] == 'Progress' ? 'selected' : '' ?>>Progress</option>
                    <option value="Pending" <?= $row ['status_ticket'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                    </select>
                  </div>
                  <div class="form-group mb-0">
                    <label for="image_ticket"></label>
                    <input type="file" name="image_ticket" id="image_ticket" class="form-control" placeholder="Pilih Gambar" value="<?= $row ['image_ticket'] ?>" >
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="ubah" class="btn btn-primary">Ubah Data</button>
            </div>
            <?php else: ?>
              <td colspan="11">
                <h1 class="text-gray-500 text-center">Data tidak ada!</h1>
              </td>
            <?php endif; ?>
        </form>
    </div>
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
                <form action="<?= base_url('ticket/tambah'); ?>" method="post" enctype="multipart/form-data">
                  <div class="form-group mb-0">
                    <label for="no_ticket"></label>
                    <input type="text" name="no_ticket" id="no_ticket" class="form-control" placeholder="Masukkan Nomor Ticket">
                  </div>
                  <div class="form-group mb-0">
                    <label for="user_id"></label>
                    <input type="text" name="user_id" id="user_id" class="form-control" placeholder="Masukkan Id User">
                  </div>
                  <div class="form-group mb-0">
                    <label for="urgency"></label>
                    <select name="urgency" class="form-control">
                    <?php if(!empty($ticket)) : ?>
                    <option value="High" <?= $row ['urgency'] == 'High' ? 'selected' : '' ?>>High</option>
                    <option value="Medium" <?= $row ['urgency'] == 'Medium' ? 'selected' : '' ?>>Medium</option>
                    <option value="Low" <?= $row ['urgency'] == 'Low' ? 'selected' : '' ?>>Low</option>
                    <?php else: ?>
                      <td colspan="11">
                        <h1 class="text-gray-500 text-center">Data tidak ada!</h1>
                      </td>
                    <?php endif; ?>
                    </select>
                  </div>
                  <div class="form-group mb-0">
                    <label for="name_company"></label>
                    <select name="name_company" id="name_company" class="form-control">
                    <option value="">-- Pilih Company --</option>
                    <?php if(!empty($company)) : ?>
                      <?php foreach ($company as $raw) :?>
                      <option value="<?= $raw['name_company'] ?>" ><?= $raw['name_company'] ?></option>
                      <?php endforeach;?>
                      <?php else: ?>
                      <td colspan="11">
                        <h1 class="text-gray-500 text-center">Data tidak ada!</h1>
                      </td>
                      <?php endif; ?>
                    </select>
                  </div>
                  <div class="form-group mb-0">
                    <label for="name_pic"></label>
                    <select name="name_pic" id="name_pic" class="form-control">
                    <option value="">-- Pilih Penanggung Jawab --</option>
                    <?php if(!empty($pic)) : ?>
                      <?php foreach ($pic as $rew) :?>
                      <option value="<?= $rew['name_pic'] ?>" ><?= $rew['name_pic'] ?></option>
                      <?php endforeach;?>
                      <?php else: ?>
                      <td colspan="11">
                        <h1 class="text-gray-500 text-center">Data tidak ada!</h1>
                      </td>
                      <?php endif; ?>
                    </select>
                  </div>
                  <div class="form-group mb-0">
                    <label for="position_pic"></label>
                    <select name="position_pic" id="position_pic" class="form-control">
                    <option value="">-- Pilih Posisi Penanggung Jawab --</option>
                    <?php if(!empty($pic)) : ?>
                      <?php foreach ($pic as $riw) :?>
                      <option value="<?= $riw['position_pic'] ?>" ><?= $riw['position_pic'] ?></option>
                      <?php endforeach;?>
                      <?php else: ?>
                      <td colspan="11">
                        <h1 class="text-gray-500 text-center">Data tidak ada!</h1>
                      </td>
                      <?php endif; ?>
                    </select></div>
                  <div class="form-group mb-0">
                    <label for="problem_company"></label>
                    <input type="text" name="problem_company" id="problem_company" class="form-control" placeholder="Masukkan Judul Masalah">
                  </div>
                  <div class="form-group mb-4">
                    <label for="problem_details"></label>
                    <textarea type="text" name="problem_details" id="problem_details" cols="30" rows="3" class="form-control" placeholder="Masukkan Detail Masalah"></textarea>
                  </div>
                  <div class="form-group mb-0">
                    <label for="status_ticket"></label>
                    <select name="status_ticket" class="form-control">
                    <?php if(!empty($ticket)) : ?>
                    <option value="Success" <?= $row ['status_ticket'] == 'Succsess' ? 'selected' : '' ?>>Success</option>
                    <option value="Progress" <?= $row ['status_ticket'] == 'Progress' ? 'selected' : '' ?>>Progress</option>
                    <option value="Pending" <?= $row ['status_ticket'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <?php else: ?>
                      <td colspan="11">
                        <h1 class="text-gray-500 text-center">Data tidak ada!</h1>
                      </td>
                    <?php endif; ?>
                    </select>
                  </div>
                  <div class="form-group mb-4">
                    <label for="image_ticket"></label>
                    <input type="file" name="image_ticket" id="image_ticket" cols="30" rows="3" class="form-control" placeholder="Pilih Gambar"></input>
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
