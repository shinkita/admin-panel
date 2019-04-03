 <script src="//cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
 
<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Feeds</h2>
        </div>
    </header>
    <!--Breadcrumb-->
    <div class="breadcrumb-holder container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active">Feeds</li>
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
                      Add Feed Created By   <?php //echo  $_SESSION['via-spot_admin']['id'];
echo  $_SESSION['via-spot_admin']['username'];  ?>
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
                    ?>
					
                    <form method="post" enctype="multipart/form-data">
                      <div class="form-row">
                          <input type="hidden" class="form-control <?= $position ?>" name="user_id"   value="<?php echo  $_SESSION['via-spot_admin']['id']; ?>"  >
                        <div class="col">
                          <input type="text" class="form-control <?= $position ?>" name="accountname" placeholder="Feed Name" value="" required>
                        </div>
						<div class="col mt-3">
                          Non-Paid<input type="checkbox" class="form-control status" name="paid_status"  value="0" >
						   Paid<input type="checkbox" class="form-control status" name="paid_status" value="1" >
                        
                        </div>
                         
                        </div>
						<div class="form-row">
                        <div class="col">
						
                          Category<select name="category" class="form-control" >
						  <option value=''>Please Select category</option>
						  <?php foreach ( $category as $cat) {?>
						  <option value='<?php echo $cat['id'];?>'><?php echo $cat['category_name'];?></option>
						 
						  <?php } ?>
						  </select>
                        </div>
						<div class="col mt-3">
                          Friends<input type="checkbox" class="form-control account_checkbox" name="account_status[]"  value="1" >
						  Family<input type="checkbox" class="form-control account_checkbox" name="account_status[]" value="2" >
                          Professional<input type="checkbox" class="form-control account_checkbox" name="account_status[]" value="3" >
                        
                        </div>
      <script type="text/javascript">
    // $('.account_checkbox').on('change', function() {
        // $('.account_checkbox').not(this).prop('checked', false);  
    // });
	 $('.status').on('change', function() {
         $('.status').not(this).prop('checked', false);  
     });
  </script>
                        </div>
                        <div class="form-row">
                            <div class="col mt-3"> 
                                <label>Advertisment Description</label>
                            <textarea name="description" id="description" class="form-control <?= $answer ?>" ><?php echo set_value('description'); ?></textarea>
                        </div>
                        </div> 
						<div class="form-row">
                        <div class="col">
						<label>Image Upload</label>
                          <input type="file" class="form-control" name="image_upload"   multiple accept='image/*' >
                        </div>
						</div>
						<div class="form-row">
                        <div class="col">
						<label>Video Upload</label>
                          <input type="file" class="form-control" name="video_upload"   multiple accept='video/*'  >
                        </div>
						</div>
						 	<div class="form-row">
                        <div class="col">
						<label>youtube link (Paste here)</label>
                          <input type="text" class="form-control" name="youtube"    >
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