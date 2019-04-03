 
<script src="//cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
 
<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Advertiser</h2>
        </div>
    </header>
    <!--Breadcrumb-->
    <div class="breadcrumb-holder container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active">Advertiser</li>
        </ul>
    </div>
    <!-- Dashboard Counts Section-->
    <section class="tables">
        <div class="container-fluid">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-close">
                        <div class="dropdown">
                            <button type="button" id="closeCard3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                            <div aria-labelledby="closeCard3" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                        </div>
                    </div>
                    <div class="card-header d-flex align-items-center">                        
                      Advertiser Account
                  </div>                    
                  <div class="card-body">
                    <?php 
                    $position = $question = $answer = '';
                    if(validation_errors() !='')
                    {
                        ?>
                        <div class="text-danger">
                            <?php echo validation_errors(); ?>       
                        </div>
                        <?php
                    }                    
                    if(form_error('account_status') != '')
                    {
                        $position = 'is-invalid';
                    }
                    if(form_error('question') != '')
                    {
                        $question = 'is-invalid';
                    }
                    if(form_error('answer') != '')
                    {
                        $answer = 'is-invalid';
                    }
					 
					 $username = (set_value('account_name') != '') ? set_value('account_name'): $account['username'];
					 $email = (set_value('account_name') != '') ? set_value('account_name'): $account['email'];
					 $mobile = (set_value('account_name') != '') ? set_value('account_name'): $account['mobile'];
					 $type = (set_value('account_name') != '') ? set_value('account_name'): $account['type'];
					 $status = (set_value('account_name') != '') ? set_value('account_name'): $account['status'];
					 $profile_image = (set_value('account_name') != '') ? set_value('account_name'): $account['profile_image'];
					 
					 
					  
					 
					 
                    ?>
					
                   <form method="post" enctype="multipart/form-data">
                       <div class="form-row">
					    <div class="col">
                          <input type="text" class="form-control <?= $position ?>" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control <?= $position ?>" name="email" placeholder="Email" value="<?php echo $email ; ?>" required>
                        </div>
						 
                         
                        </div>
						<div class="form-row">
                        <div class="col">
						
                          Mobile No<input type="text" class="form-control <?= $position ?>" name="mobile_no" placeholder="Mobile No" value="<?php echo $mobile; ?>" >
                        </div>
						<div class="col ">
                         
                         Source<select name="source" class="form-control" >
						  <option value='business'>Business</option>
						  
						  </select>
                        
                        </div>
						
						
  
                        </div>
						
								<div class="form-row">
                        <div class="col">
						
                          User Status<select name="userstaus" class="form-control" >
						  <option value='1' <?php if($status==1) echo 'selected' ; ?>>Activated</option>
						    <option value='0' <?php if($status==0) echo 'selected' ; ?>>Deactivated</option>
						  
						  </select>
                        </div>
						<div class="col ">
                         
                         Profile Image  
						  <input type="file" class="form-control" name="userimage_upload"   >
                        </div>
						<?php 
						if($profile_image!='')
						{
						$gallary_img_path="http://viaspot.com/new_admin/viaspot_users/user_images/"; ?>
						   <div class="">
                                            <img src="<?= $gallary_img_path . $profile_image ?>" class="m-1 has-shadow photo-gallary" alt="Cinque Terre"  style="width:7em; height: 7em;">
                                        </div>
						 
                        
                        </div>
						
						<?php }
						else {
						?>
						<div class="">
						    </div>
						<?php } ?>
  
                         
                      
                      
						
                       	<div class="col ">                      
                        <input type="submit" class="btn btn-success float-right"> 
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
<br>
<br>
</div>
</section>          
<!-- Page Footer-->
<footer class="main-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <p>Viaspot © 2018</p>
            </div>
            <div class="col-sm-6 text-right">
                <p>Design by <a href="www.viaspot.com" class="external">Viaspot</a></p>
               
            </div>
        </div>
    </div>
</footer>
</div>
<script>
  $(function() {
    CKEDITOR.replace( 'answer' );
});
</script>