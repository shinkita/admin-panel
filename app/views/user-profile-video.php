<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Users</h2>
        </div>
    </header>
    <!--Breadcrumb-->
    <div class="breadcrumb-holder container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item">Profile Video</a></li>            
        </ul>
    </div>
    <!-- Dashboard Counts Section-->
    <section class="tables">   
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-12">
                    <div class="card">
                        <div class="card-header">
                           <h3>Video</h3>
                        </div>
                        <div class="card-close d-flex align-items-center" style="top: 5px;">   
                            <form method="post" action="<?=base_url()?>users/filture">                     
                            <div class="input-group">
                              <select class="input-custom-select custom-select" name="profile_type" id="inputGroupSelect04">
                                <option selected value="0" <?php echo $selected=($profile_type==0)?'selected':'';?>>All Profile</option>
                                <option value="1" <?php echo $selected=($profile_type==1)?'selected':'';?>>Friends</option>
                                <option value="2" <?php echo $selected=($profile_type==2)?'selected':'';?>>Family</option>
                                <option value="3" <?php echo $selected=($profile_type==3)?'selected':'';?>>Professional</option>
                              </select>
                              <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Select</button>
                              </div>
                            </div>
                        </div>      
                        <div class="card-body">                                          
                            <div class="row">
                                <?php
                                $start = 1;
                                foreach ($videos as $k => $v) {
									
										$CI =& get_instance();
										$CI->load->model('usersmodel');
										$uid=$v['user_id'];
										if($v['name']=='' && $uid=='')
								 {
								 	$CI1 =& get_instance();
										$CI1->load->model('usersmodel');
										$post_id=$v['id'];
										 $post_user_id =  $CI->usersmodel->fetch_query("SELECT  user_id from  post where id='$post_id'");
								 	$uid=$post_user_id[0]['user_id'];
									 
										
         $user =  $CI->usersmodel->fetch_query("SELECT  name from  b_user_detail where user_id='$uid'");
           $name = $user[0]['name'];
                                    }
                                    else
                                    {
                                      $name=$v['name'];  
                                    }
										
										
         $count_user =  $CI->usersmodel->fetch_query("SELECT  count(1) as COUNT from  b_users where user_id='$uid'");
         $count_user = $count_user[0]['COUNT'];
		 
                                    $profile = $v['profile_type'];
                                    if($profile == '1')
                                    {
                                        $profile = '<strong style="color:teal;">Friends</strong>';
                                    }
                                    elseif($profile == '2')
                                    {   
                                        $profile = '<strong style="color:purple;">Family</strong>';
                                    }
                                    else
                                    {
                                        $profile = '<strong style="color:blue;">Professional</strong>';
                                    }
                                    echo '<div class="col-lg-2 col-md-2 col-xs-12 col-sm-6">';
                                    ?>
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <video controls>
                                            <source src="<?= $gallary_path . $v['video'] ?>" type="video/mp4">                                        
                                        </video> 
                                    </div>                                    
                                    <?php 
									echo '<div class ="user-info">';
                                    $ownership = ($v['method']=='Shared')?'Shared':'Own';
                                    echo '<div><strong>Name : </strong>'.$name.'</div>';
                                        echo '<div><strong>Profile : </strong>'.$profile.'</div>';
                                        echo '<div><strong>Ownership : </strong>'.$ownership.'</div>';
											if( $count_user==1)
										{
                                        echo '<div><strong>User Status : </strong>Deleted</div>'; 
										} 
                                else
										{
                                        echo '<div><strong>User Status : </strong>Active</div>'; 
										}
                                        echo '<div><strong>Posted On : </strong>'.date('m/d/Y - g:ia',strtotime($v['date_time'])).'</div>'; 
                                         $st = ($v['deleted']==1)?'<a href="'.base_url().'users/active_post/'.$v['id'].'" class="btn fg-white btn-danger">Inactive</a>':'<a href="'.base_url().'users/deactive_post/'.$v['id'].'" class="btn btn-success fg-white">Active</a>';                                        
                                        echo '<div class="mb-3 rounded">'.$st.'</div>';
                                    echo '</div> </div>';
                                }
                                ?>
                            </div>
                            <div class="paging"><?php echo $paging; ?></div>
                        </div>                                                                                     
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
<div class="modal fade" id="potosModal" tabindex="-1" role="dialog" aria-labelledby="photosModal" aria-hidden="true">
    <div class="modal-dialog" role="">                 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>            
        <img src="" id="img-model" style="width: 100%;height: auto;">      

    </div>
</div>
<script>
    $(function () {
        $('.m-1').click(function () {
            $('#potosModal').modal('show');
            var source = $(this).attr('src');
            $('#img-model').attr('src', source);
        });
    });
</script>
