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
                  
                    <div class="card-header d-flex align-items-center">                        
                    <?php echo  $faq[0]['account_name'];?>
                    </div>                    
                    <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Account Name</th>
                                      <th scope="col">Category</th>
                                      <th scope="col">Date</th>
									  <th scope="col">Paid/Not Paid</th>
									  <th scope="col">Account Status</th>
                                      <th scope="col">Video</th>
                                      <th scope="col">Images</th>
                                    </tr>
                                  </thead>
                                <tbody>  
                            <?php 
                            
                            $sr = 1;
							
                            foreach ($faq as $key => $v) {
								
								$CI =& get_instance();
										$CI->load->model('usersmodel');
										$cat_id=$v['category'];
										$profile_link = base_url() . 'business/feed/' . $v['id'];
										
		$category =  $CI->usersmodel->fetch_query("SELECT  category_name from  interest_category_tbl where id='$cat_id'");
 $category_name = $category[0]['category_name'];
	   
                                ?>
                                <tr>
                                    <th scope="row">
                                        <?=$sr?>
                                    </th>
                                    <td>
                                      <?=$v['account_name']?> 
                                    </td>
                                    <td>
                                        <?=$category_name?>
                                    </td>
 <td>
                                      <?=date('m/d/Y - g:ia',strtotime($v['date']))?>
                                    </td>
                                    <td>
                                       <?=($v['payment_status']==1)?'Paid':'Non-Paid'?>
                                        
                                    </td>
                                   <td > 
                                   <?php 
                                   $v['account_status']=explode(',',$v['account_status']);
                                   if(in_array(1,$v['account_status']))
									   echo 'Friends';
if(in_array(2,$v['account_status']))
	echo ', Family';
if(in_array(3,$v['account_status']))
	echo ', Professional';
	?>
                                        
                                    </td>
                                    <td>
									<?php
									if( $v['video']!='')
                            {
									$gallary_video_path="https://www.viaspot.com/new_admin/viaspot_users/"; ?>
                                      <div class="row">
							<div class="embed-responsive embed-responsive-16by9" style="width:7em; height: 7em;">
                                        <video controls>
                                            <source src="<?= $gallary_video_path . $v['video'] ?>" type="video/mp4">                                        
                                        </video> 
                                    </div> 
									</div> 
									<?php } else { echo 'Not Available'; } ?> 
                                    </td>    
                                    <td>
									<?php
												if( $v['image']!='')
                            {
									
									$gallary_img_path="https://www.viaspot.com/new_admin/viaspot_users/images/"; ?>
                                      <div class="">
                                            <img src="<?= $gallary_img_path . $v['image'] ?>" class="m-1 has-shadow photo-gallary" alt="Cinque Terre"  style="width:7em; height: 7em;">
                                        </div>
                                        	<?php } else { echo 'Not Available'; } ?> 
                                    </td>
                                </tr>

                                <?php
                                $sr++;
                            }
                            ?>
						
                            </tbody>
                            </table>
						 
                          	      
  									
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