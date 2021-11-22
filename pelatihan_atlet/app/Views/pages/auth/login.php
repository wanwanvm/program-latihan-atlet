<?= $this->extend('pages\layout\login\template') ?>

<?= $this->section('content') ?>
    <div class="login d-flex align-items-center py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-lg-8 mx-auto">
                    <?php if (!empty(session()->getFlashdata('error'))) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <h3 class="mb-5 text-center font-weight-bold">Sistem Pelatihan Atlet</h3>
                    <h3 class="login-heading mb-2">Login</h3>

                    <!-- Sign In Form -->
                    <form method="post" action="<?= base_url(); ?>/login/submit">
                        <?= csrf_field(); ?>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required autofocus autocomplete="off">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="showPassword">
                            <label class="form-check-label" for="showPassword">
                                Show Password
                            </label>
                        </div>

                        <div class="d-grid mt-3">
                            <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" type="submit">Sign in</button>
                            <div class="text-center">
                                <a class="small" href="#">Created by Galuh @2021</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>