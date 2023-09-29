<!-- Begin Page Content -->

<div class="container-fluid">
<?= view('Myth\Auth\Views\_message_block') ?>
<h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
<!-- Page Heading -->
<style type="text/css">
div {
  text-align: justify;
  text-justify: inter-word;
}
    .satu {
   font-size: 12px;
   }
   .dua {
   font-size: 18px;
   }
   .tiga {
   font-size: 10px;
   }
   .empat {
   font-size: 11px;
   }
</style>

    <!-- Content Row -->
    <div class="row">

    <!-- All Tickets -->
    <!-- <a href=""> -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="/ticket" class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                All Tickets</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <h1>
                                    <?php 
                                        require 'dbconfig.php';
    
                                        $query = "SELECT id FROM ticket ORDER BY id";
                                        $query_run = mysqli_query($connection, $query); 
                                        
                                        $row = mysqli_num_rows($query_run);
    
                                        echo '<h1>'.$row.'</h1>';
    
                                    ?>
                                </h1>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-address-card fa-2x text-primary-300"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <!-- </a> -->

    <!-- Ticket Success -->
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="/ticket/index/Success" class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2-success">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Ticket Success</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <h1>
                                <?php 
                                    require 'dbconfig.php';

                                    $query = "SELECT id FROM ticket WHERE status_ticket = 'Success'";
                                    $query_run = mysqli_query($connection, $query); 
                                    
                                    $row = mysqli_num_rows($query_run);

                                    echo '<h1>'.$row.'</h1>';

                                ?>
                            </h1>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-address-card fa-2x text-green-300"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="/ticket/index/Progress" class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Ticket Progress
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <h1>
                                    <?php 
                                        require 'dbconfig.php';

                                        $query = "SELECT id FROM ticket WHERE status_ticket = 'Progress'";
                                        $query_run = mysqli_query($connection, $query); 
                                        
                                        $row = mysqli_num_rows($query_run);

                                        echo '<h1>'.$row.'</h1>';

                                    ?>
                                </h1>
                            </div>
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-address-card fa-2x text-yellow-300"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="/ticket/index/Pending" class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Ticket Pending
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <h1>
                                    <?php 
                                        require 'dbconfig.php';

                                        $query = "SELECT id FROM ticket WHERE status_ticket = 'Pending'";
                                        $query_run = mysqli_query($connection, $query); 
                                        
                                        $row = mysqli_num_rows($query_run);

                                        echo '<h1>'.$row.'</h1>';

                                    ?>
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-address-card fa-2x text-red-300"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-1">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary dua">PT Lima Pilar Cakrawala</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="/assets/img/profile/logo.png" width="37.2 px" height="23.8 px">
                                        </a>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <body>
                                            <i class="fa fa-map-marker" style="font-size:20px"></i>
                                            <span style="color:#000080"; class="m-0 font-weight text-primary koran"> Alamat</span>
                                            <span class="enter"><br>Grand Galaxy City
                                                Blok RRG 3 No.75
                                                Jakasetia 
                                                Kota Bekasi
                                                Jawa Barat 17147
                                            </span> 
                                            <br>
                                            
                                            <br>
                                            <i class="fa fa-phone" style="font-size:20px"></i>
                                            <span style="color:#000080"; class="m-0 font-weight text-primary koran"> Telepon</span>
                                            <span class="enter"><br>(021) 8275 3368 | 0813 8742 0872 - Imansyah | 0812 1854 5088 - Aris
                                            </span>
                                            <br>

                                            <br>
                                            <i class="fa fa-envelope" style="font-size:20px"></i>
                                            <span style="color:#000080"; class="m-0 font-weight text-primary koran"> Email</span>
                                            <span class="enter"><br>sales@lpc.co.id | info@lpc.co.id
                                            </span>
                                            <br>

                                            <br>
                                            <i class='fas fa-clock' style='font-size:20px'></i>
                                            <span style="color:#000080"; class="m-0 font-weight text-primary koran"> Jam Kerja</span>
                                            <span class="enter"><br>Senin - Jum'at
                                                    <br> 08:00 - 17:00
                                            </span>
                                        </body>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Layanan</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        </a>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-0 pb-2">
                                    <h6 class="m-0 font-weight text-primary fas fa-circle"> IT Infrastructure</h6>
                                    <p class="empat" class="m-0 text-dark">
                                        Membangun sumber daya fisik dan virtual yang terdesentralisasi dan 
                                        dapat dikendalikan untuk mendukung arus, 
                                        penyimpanan, pengolahan dan analisis data.
                                    </p>

                                    <h6 class="m-0 font-weight text-success fas fa-circle"> Managed Service</h6>
                                    <p class="empat" class="m-0 text-dark">
                                        Mengelola dan memelihara dengan profesional prasarana IT sebagai 
                                        solusi layanan meningkatkan stabilitas dan efisiensi sistem.
                                    </p>
                                    <h6 class="m-0 font-weight text-info fas fa-circle"> Cloud Computing Services</h6>
                                    <p class="empat" class="m-0 text-dark">
                                        Memelihara dan mengembangkan layanan teknologi 
                                        dan infrastruktur cloud. Layanan konsultasi tentang 
                                        teknologi informasi, pemulihan, keamanan siber.
                                    </p>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="tiga">
                                            <i class="fas fa-circle text-primary "></i> IT Infrastructure
                                        </span>
                                        <span class="tiga">
                                            <i class="fas fa-circle text-success "></i> Managed Service
                                        </span>
                                        <span class="tiga">
                                            <i class="fas fa-circle text-info "></i> Cloud Computing
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Product</h6>
                                </div>
                                <div class="card-body">
                                    <img src="/assets/img/profile/microsoft.png" width="75.0 px" height="15.6 px">
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <img src="/assets/img/profile/kaspersky.png" width="75.0 px" height="15.6 px">
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 100%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <img src="/assets/img/profile/hillstone.png" width="75.0 px" height="18 px">
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 100%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <img src="/assets/img/profile/acronis.png" width="60.0 px" height="13.2 px">
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 100%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <img src="/assets/img/profile/zwcad.png" width="75.0 px" height="13.8 px">
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <img src="/assets/img/profile/adobe.png" width="44.4 px" height="18.3 px">
                                    <div class="progress">
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



