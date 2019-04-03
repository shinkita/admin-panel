<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Setting</h2>
        </div>
    </header>
    <!--Breadcrumb-->
    <div class="breadcrumb-holder container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active">Setting</li>
        </ul>
    </div>
    <!-- Dashboard Counts Section-->
    <section class="tables">
        <div class="container-fluid">
            <div class="col-lg-6 offset-lg-3">
                <div class="card">
                    <div class="card-close">
                        <div class="dropdown">
                            <button type="button" id="closeCard3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                            <div aria-labelledby="closeCard3" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                        </div>
                    </div>
                    <div class="card-header d-flex align-items-center">                        
                      Change password
                    </div>
                    <?php                            
                            $cp_valid = '';
                            $np_valid = '';
                            $vp_valid = '';                            
                            if (form_error('currentpassword') != '') {
                                $cp_valid = 'is-invalid';                                
                            }
                            if (form_error('newpassword') != '') {
                                $np_valid = 'is-invalid';
                            }
                            if (form_error('verifypassword') != '') {
                                $vp_valid = 'is-invalid';
                            }
                            ?>
                    <div class="card-body">
                  
                            <form method="post">
                                <div class="form-group">
                                    <label for="inputPasswordOld">Current Password</label>
                                    <input type="password" name="currentpassword" class="form-control <?=$cp_valid?>" id="inputPasswordOld" required="" value="<?php echo set_value('currentpassword'); ?>">
                                     <div class="invalid-feedback" >
                                            Incorrect current password
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPasswordNew">New Password</label>
                                    <input type="password" name="newpassword" class="form-control <?=$np_valid?>" id="inputPasswordNew" required="" value="<?php echo set_value('newpassword'); ?>">
                                    <div class="invalid-feedback" >
                                            The password must be 6-20 characters, and must <em>not</em> contain spaces.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPasswordNewVerify">Retype Password</label>
                                    <input type="password" name="verifypassword" class="form-control <?=$vp_valid?>" id="inputPasswordNewVerify" required="" value="<?php echo set_value('verifypassword'); ?>">
                                    <div class="invalid-feedback">
                                            To confirm, type the new password again.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success float-right">Save</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
              <br>
            <br>
     
           <br>
            <br>
             <br>
           
         <br>
         <br>
         <br>
        </div>
    </section>          
    <!-- Page Footer-->
    <footer class="main-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <p>Viaspot © 2017</p>
                </div>
                <div class="col-sm-6 text-right">
                    <p>Design by <a href="https://bootstrapious.com/admin-templates" class="external">Viaspot</a></p>
                    <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                </div>
            </div>
        </div>
    </footer>
</div>