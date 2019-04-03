<div class="page login-page">
    <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
            <div class="row">
                <!-- Logo & Information Panel-->
                <div class="col-lg-6">
                    <div class="info d-flex align-items-center">
                        <div class="content">
                            <div class="logo">
                                <h1>Viaspot</h1>
                            </div>
                            <p>Admin panel : Please login to Continue</p>
                        </div>
                    </div>
                </div>
                <!-- Form Panel    -->
                <div class="col-lg-6 bg-white">
                    <div class="form d-flex align-items-center">
                        <div class="content">

                            <?php                            
                            $u_valid = '';
                            $u_active = '';
                            $p_valid = '';
                            $p_active = '';                            
                            if (form_error('username') != '') {
                                $u_valid = 'is-invalid';                                
                            }
                            if (form_error('password') != '') {
                                $p_valid = 'is-invalid';
                            }
                            ?>
                            <form id="login-form" method="post">
                                <div class="form-group">
                                    <input id="login-username" type="text" name="username" required="" class="input-material form-control <?= $u_valid ?>" value="<?php echo set_value('username'); ?>">
                                    <label for="login-username" class="label-material <?php echo $active =  (set_value('username') != '')? 'active':'';?>">User Name</label>
                                    <div class="invalid-feedback">Incorrect Username</div>
                                </div>
                                <div class="form-group">
                                    <input id="login-password" type="password" name="password" required="" class="input-material form-control <?= $p_valid ?>" value="<?php echo set_value('password'); ?>">
                                    <label for="login-password" class="label-material <?php echo $active =  (set_value('password') != '')? 'active':'';?>">Password</label>
                                    <div class="invalid-feedback">Incorrect Password</div>
                                </div>
                                <button type="submit" id="login" class="btn btn-primary">Login</button>
                                <br>
                                <a href="<?=base_url().'auth/forget_password'?>" class="float-right">Forgot Password</a>                                
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyrights text-center">
        <p>Copyright &copy; <a href="https://bootstrapious.com/admin-templates" class="external"><?= date('Y') ?></a></p>
        <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
    </div>
</div>