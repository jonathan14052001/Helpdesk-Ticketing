<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    
    <title>Halaman Login</title>

    <!-- Custom fonts for this template-->
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
   
    <!-- Custom styles for this template-->
    <link href="/assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 col-lg-7 mx-auto shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                        <div class="text-center">
                            <img class="" src="/assets/img/profile/logo.png" width="50" height="35"></img>
                        </div>
                        </br>
                            <div class="text-center">
                                
                                <h1 class=" h4 text-gray-900 mb-4">Login Akun!</h1>
                            </div>

                                <?= view('Myth\Auth\Views\_message_block') ?>
								
								<form action="<?= route_to('login') ?>" method="post" class="user">
                                <?= csrf_field() ?>

								<?php if ($config->validFields === ['email']): ?>
									<div class="form-group">
										<input type="email" class="form-control <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>"
											name="login" placeholder="<?=lang('Auth.email')?>">
										<div class="invalid-feedback">
											<?= session('errors.login') ?>
										</div>
									</div>
								<?php else: ?>
									<div class="form-group">
										<input type="text" class="form-control form-control-user <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>"
											name="login" placeholder="<?=lang('Auth.emailOrUsername')?>">
										<div class="invalid-feedback">
											<?= session('errors.login') ?>
										</div>
									</div>
								<?php endif; ?>

									<div class="form-group">
										<input type="password" name="password" class="form-control form-control-user <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>">
										<div class="invalid-feedback">
											<?= session('errors.password') ?>
										</div>
									</div>

								<?php if ($config->allowRemembering): ?>
									<div class="form-check">
											<input type="checkbox" name="remember" class="form-check-input"  <?php if(old('remember')) : ?> checked <?php endif ?>>
											<?=lang('Auth.rememberMe')?>
										</label>
									</div>
								<?php endif; ?>

									<br>

									<button type="submit" class="btn btn-primary btn-block btn-user"><?=lang('Auth.loginAction')?></button>
								</form>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/assets/js/jquery-3.4.1.min.js"></script>
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/assets/js/sb-admin-2.min.js"></script>

</body>

</html>