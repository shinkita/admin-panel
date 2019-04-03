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
                            <p>Admin panel : Reset your password</p>
                        </div>
                    </div>
                </div>
                <!-- Form Panel    -->
                <div class="col-lg-6 bg-white">
                    <div class="form d-flex align-items-center">
                        <div class="content">

                            <?php                                                 
                            if (form_error('newpassword') != '') {
                                $n_valid = 'is-invalid';                                                                
                            }
                            if (form_error('verifypassword') != '') {
                                $v_valid = 'is-invalid';                                                                
                            }
                            if(isset($response) && $response != ''){
                                echo $response;
                            }
                            ?>
                            <form id="login-form" method="post">
                                <div class="form-group">
                                    <input id="newpassword" type="password" name="newpassword" required="" class="input-material form-control <?=@$n_valid ?>" value="<?php echo set_value('newpassword'); ?>" required>
                                    <label for="newpassword" class="label-material <?php echo $active =  (set_value('newpassword') != '')? 'active':'';?>">New password</label>
                                    <div class="invalid-feedback">Please enter a new password</div>
                                </div>
								<div class="form-group">
                                    <input id="vpassword" type="password" name="verifypassword" required="" class="input-material form-control <?=@$v_valid ?>" value="<?php echo set_value('verifypassword'); ?>" required>
                                    <label for="vpassword" class="label-material <?php echo $active =  (set_value('verifypassword') != '')? 'active':'';?>">Verify password</label>
                                    <div class="invalid-feedback">Please enter same password</div>
                                </div>
                                <button type="submit" id="login" class="btn btn-primary">Submit</button>
                                <br>
                                <a href="<?=base_url().'auth/login'?>" class="float-right">Login</a>                                
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyrights text-center">
        <p>Copyright &copy; <a href="#" class="external"><?= date('Y') ?></a></p>
        <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
    </div>
</div>