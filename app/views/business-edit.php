 
<script src="//cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
 
<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Business</h2>
        </div>
    </header>
    <!--Breadcrumb-->
    <div class="breadcrumb-holder container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active">Business</li>
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
                      Account
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
					 
					 $account_value = (set_value('account_name') != '') ? set_value('account_name'): $account['account_name'];
					 $payment_value = (set_value('paid_status') != '') ? set_value('paid_status'): $account['payment_status'];
					 $accountstatus_value = (set_value('account_status') != '') ? set_value('account_status'): $account['account_status'];
					 $accountstatus_value=explode(',',$accountstatus_value);
					  
					 
					 $category_value = (set_value('category') != '') ? set_value('category'): $account['category'];
					 $description_value = (set_value('description') != '') ? set_value('description'): $account['description'];
         
                    ?>
					
                   <form method="post" enctype="multipart/form-data">
                      <div class="form-row">
                          <input type="hidden" class="form-control <?= $position ?>" name="user_id"   value="<?php echo  $_SESSION['via-spot_admin']['id']; ?>"  >
                        <div class="col">
                          <input type="text" class="form-control <?= $position ?>" name="account_name" placeholder="Account Name" value="<?php echo $account_value; ?>" required>
                        </div>
						<div class="col mt-3">
                          Non-Paid<input type="checkbox" class="form-control" name="paid_status"  <?php
if($payment_value==0) echo 'checked'; ?>						  value="0"  >
						   Paid<input type="checkbox" class="form-control" name="paid_status" <?php
if($payment_value==1) echo 'checked'; ?>	 value="1"  >
                        
                        </div>
                         
                        </div>
						<div class="form-row">
                        <div class="col">
						
                          Category<select name="category" class="form-control" >
						  <option value=''>Please Select category</option>
						  <?php foreach ( $category as $cat) {?>
						  <?php if($category_value==$cat['id'])
						  { ?>
						  <option value='<?php echo $cat['id'];?>' selected><?php echo $cat['category_name'];?>
						  <?php } else { ?>
						  
						  <option value='<?php echo $cat['id'];?>'><?php echo $cat['category_name'];?>
						  <?php } ?>
						  </option>
						 
						  <?php } ?>
						  </select>
                        </div>
						<div class="col mt-3">
                          Friends<input type="checkbox" class="form-control" name="account_status[]"   value="1" 
<?php  if(in_array(1,$accountstatus_value)) echo 'checked'; ?>
						  >
						  Family<input type="checkbox" class="form-control" name="account_status[]" value="2" 
						  <?php if(in_array(2,$accountstatus_value)) echo 'checked'; ?>
						   >
                          Professional<input type="checkbox" class="form-control"  name="account_status[]" value="3"
<?php
      if(in_array(3,$accountstatus_value)) echo 'checked'; ?>
						   >
                         </div>
                         
                        </div>
                        <div class="form-row">
                            <div class="col mt-3"> 
                                <label>Advertisment Description</label>
                            <textarea name="description" id="description" class="form-control "     required> <?php echo $description_value; ?>   </textarea>
                        </div>
                        </div> 
						<div class="form-row">
                        <div class="col">
						<label>Image Upload</label>
                          <input type="file" class="form-control" name="image_upload_updates"   >
                        </div>
                         <div class="col">
                        		<?php
									if( $account['image']!='')
                            {
								$gallary_img_path="https://www.viaspot.com/new_admin/viaspot_users/images/"; ?>
                                      
                                            <img src="<?= $gallary_img_path . $account['image'] ?>" class="m-1 has-shadow photo-gallary" alt="Cinque Terre"  style="width:7em; height: 7em;">
                                        
                                        	<?php } else { echo 'Not Available'; } ?> 
                                        </div> 
						</div>
						
						<div class="form-row">
                        <div class="col">
						<label>Video Upload</label>
                          <input type="file" class="form-control" name="video_upload_updates">
                        </div>
                        
                        <div class="col">
                        		<?php
									if( $account['video']!='')
                            {
									$gallary_video_path="https://www.viaspot.com/new_admin/viaspot_users/"; ?>
                                       
							<div class="embed-responsive embed-responsive-16by9" style="width:7em; height: 7em;">
                                        <video controls>
                                            <source src="<?= $gallary_video_path . $account['video'] ?>" type="video/mp4">                                        
                                        </video> 
                                   
									<?php } else { echo 'Not Available'; } ?> 
							     </div> 
                                    </div> 
									</div> 		
						</div>
					 
						<div class="form-row">
                        <div class="col">
						<label>youtube link (Paste here)</label>
                          <input type="text" class="form-control" name="youtube"   id="youtube" value="<?php echo $account['url'] ; ?>"  >
                        </div>
						</div>
                        <br>                         
               <input type="submit" class="btn btn-success float-right"> 
                    </form>
        </div>
    </div>
</div>
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
    CKEDITOR.replace( 'description' );
});
</script>