    <div class="content-inner">
        <?php error_reporting(0); ?>
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
            <li class="breadcrumb-item"><a href="<?= base_url() ?>users">Users</a></li>
            <li class="breadcrumb-item active">Profile</li>
        </ul>
    </div>
    <!-- Dashboard Counts Section-->
    <section class="tables">        
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-lg-4">
                    <div class="client card">
                        <div class="card-close">
                            <div class="dropdown">
                                <?php
                                $user_pic = '';
                                switch (true) {
                                    case $profile_pic[0]['profile_pic'] != '': $user_pic = $gallary_path . $profile_pic[0]['profile_pic'];
                                        break;
                                    case $profile_pic[1]['profile_pic'] != '': $user_pic = $gallary_path . $profile_pic[1]['profile_pic'];
                                        break;
                                    case $profile_pic[2]['profile_pic'] != '': $user_pic = $gallary_path . $profile_pic[2]['profile_pic'];
                                        break;
                                    default:$user_pic = $gallary_path . 'user_pic.png';
                                }
                                ?>
                                <button type="button" id="closeCard2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                                <div aria-labelledby="closeCard2" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <div class="client-avatar">
                                <img src="<?= $user_pic ?>" alt="..." class="img-fluid rounded-circle" style="max-width: 200px;">                                
                            </div>
                            <div class="client-title">
                                <h3><?= $user_profile['name'] ?></h3><span><?= $user_profile['email'] ?></span>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <!--                                    <ul class="nav justify-content-center">
                                                                            <li class="nav-item">
                                                                                <a class="nav-link active" href="#">About</a>
                                                                            </li>
                                                                            <li class="nav-item">
                                                                                <a class="nav-link" href="#">Contact</a>
                                                                            </li>                                        
                                                                        </ul>-->
                                </div>
                            </div>
                            <div class="client-info">
                                
                                <div class="row">                                    
                                    <?php
                                    $user_friends = 0;
                                    $user_family = 0;
                                    $user_professnal = 0;
                                    foreach ($friend_list as $key => $val) {
                                        if ($val['profile_type'] == 1) {
                                            $user_friends = $val['COUNT(*)'];
                                        } elseif ($val['profile_type'] == 2) {
                                            $user_family = $val['COUNT(*)'];
                                        } elseif ($val['profile_type'] == 3) {
                                            $user_professnal = $val['COUNT(*)'];
                                        }
                                    }
                                    ?>
                                    <div class="col-4"><strong><?= $user_friends ?></strong><br><small>Friends</small></div>
                                    <div class="col-4"><strong><?= $user_family ?></strong><br><small>Family</small></div>
                                    <div class="col-4"><strong><?= $user_professnal ?></strong><br><small>Professional</small></div>
                                </div> 
                                <?/*
                                <div class="row">
                                    <div class="col-12">
                                        <a class="btn btn-primary btn-block" href="https://www.viaspot.com/Friends/Profile/Profile_friend.php?user_id=509" target="_blank"><b>Show Friend profile</b></a>
                                        <a class="btn btn-primary btn-block" href="https://www.viaspot.com/Friends/Profile/Profile_friend.php?user_id=509" target="_blank"><b>Show Family profile</b></a>
                                        <a class="btn btn-primary btn-block" href="https://www.viaspot.com/Friends/Profile/Profile_friend.php?user_id=509" target="_blank"><b>Show Professional profile</b></a>
                                    </div>
                                </div>
                                */?>
                            </div>
                            <div class="client-social d-flex justify-content-between">
                                <a href="<?= base_url() ?>users/photos/<?= $user_id ?>/0" target="_blank"><i class="icon-frame-picture-streamline fa-2x"></i><br>Photos</a>
                                <a href="<?= base_url() ?>users/friends/<?= $user_id ?>" target="_blank"><i class="icon-user fa-2x"></i><br> Friends</a>
                                <a href="<?= base_url() ?>users/group/<?= $user_id ?>" target="_blank"><i class="icon-hierarchy fa-2x"></i><br>Groups</a>
                                <a href="<?= base_url() ?>users/videos/<?= $user_id ?>" target="_blank"><i class="icon-camera-streamline-video fa-2x"></i><br>Videos</a>
                                <a href="<?= base_url() ?>users/events/<?= $user_id ?>" target="_blank"><i class="icon-calendar fa-2x"></i><br>Events</a>
                            </div>
                        </div>
						
						
                    </div> 

					<div class="client card">
					      <div class="project">
                                    <div class="row bg-white has-shadow">
                                        <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                            <div class="project-title d-flex align-items-center">                                                
                                                <div class="text">
                                                    <h3 class="h4">Last Active time(GMT)</h3>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="right-col col-lg-6 d-flex align-items-center">                                            
                                            <div class="comments">
                                                <?= date('m/d/Y g:ia',strtotime($user_profile['online_status'])) ?>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="project">
                                    <div class="row bg-white has-shadow">
                                        <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                            <div class="project-title d-flex align-items-center">                                                
                                                <div class="text">
                                                    <h3 class="h4">Last Login time(GMT)</h3>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="right-col col-lg-6 d-flex align-items-center">                                            
                                            <div class="comments">
                                                <?= date('m/d/Y g:ia',strtotime($user_profile['login_time'] ))?>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>                    
                                <div class="project">
                                    <div class="row bg-white has-shadow">
                                        <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                            <div class="project-title d-flex align-items-center">                                                
                                                <div class="text">
                                                    <h3 class="h4">Last logout Time(GMT)</h3>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="right-col col-lg-6 d-flex align-items-center">                                            
                                            <div class="comments">
                                                <?= date('m/d/Y g:ia ',strtotime($user_profile['log_out'])) ?>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
					
					</div>
					
                </div>   
                <div class="col-md-8 col-8">
                    <div class="client card">
                        <div class="card-close">
                            <div class="dropdown">
                                <button type="button" id="closeCard1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                                <div aria-labelledby="closeCard1" class="dropdown-menu dropdown-menu-right has-shadow">
                                    <a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a>
                                    <a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                            </div>
                        </div>
                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4">User Info</h3>
                        </div>
                        <section class="projects">
                            <div class="container-fluid">
                                <!-- Project-->
                                <div class="project">
                                    <div class="row bg-white has-shadow">
                                        <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                            <div class="project-title d-flex align-items-center">                                                
                                                <div class="text">
                                                    <h6 class="h4">Name</h3>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="right-col col-lg-6 d-flex align-items-center">                                            
                                            <div class="comments">
                                                <?= $user_profile['name'] ?>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="project">
                                    <div class="row bg-white has-shadow">
                                        <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                            <div class="project-title d-flex align-items-center">                                                
                                                <div class="text">
                                                    <h6 class="h4">Email</h3>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="right-col col-lg-6 d-flex align-items-center">                                            
                                            <div class="comments">
                                                <?= $user_profile['email'] ?>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
						 <div class="project">
                                    <div class="row bg-white has-shadow">
                                        <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                            <div class="project-title d-flex align-items-center">                                                
                                                <div class="text">
                                                    <h3 class="h4">Phone Number</h3>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="right-col col-lg-6 d-flex align-items-center">                                            
                                            <div class="comments">
                                               <?php echo "+"; ?> <?=$user_profile['country_code'] ?> <?php echo "-"; ?><?= $user_profile['mobile'] ?>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="project">
                                    <div class="row bg-white has-shadow">
                                        <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                            <div class="project-title d-flex align-items-center">                                                
                                                <div class="text">
                                                    <h3 class="h4">Horoscope</h3>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="right-col col-lg-6 d-flex align-items-center">                                            
                                            <div class="comments">
                                                <?php ?>
                                                <?= $horoscope; ?>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="project">
                                    <div class="row bg-white has-shadow">
                                        <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                            <div class="project-title d-flex align-items-center">                                                
                                                <div class="text">
                                                    <h3 class="h4">Date of birth</h3>
                                                </div>
                                             </div>

                                        </div>
                                        <div class="right-col col-lg-6 d-flex align-items-center">                                            
                                            <div class="comments">
                                                <?= date('m/d/Y',strtotime(str_replace(',',' ' ,$user_profile['dob']))) 
												
												?>
                                            </div>                                            
                                        </div> 
                                    </div>
                                </div>
                                <div class="project">
                                    <div class="row bg-white has-shadow">
                                        <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                            <div class="project-title d-flex align-items-center">                                                
                                                <div class="text">
                                                    <h3 class="h4">Gender</h3>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="right-col col-lg-6 d-flex align-items-center">                                            
                                            <div class="comments">
                                                <?= $user_profile['gender'] ?>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="project">
                                    <div class="row bg-white has-shadow">
                                        <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                            <div class="project-title d-flex align-items-center">                                                
                                                <div class="text">
                                                    <h3 class="h4">Date of Join</h3>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="right-col col-lg-6 d-flex align-items-center">                                            
                                            <div class="comments">
                                                <?= date('m/d/Y g:ia',strtotime($user_profile['date_time'])) ?>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
								<div class="project">
                                    <div class="row bg-white has-shadow">
                                        <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                            <div class="project-title d-flex align-items-center">                                                
                                                <div class="text">
                                                    <h3 class="h4">Interest Type</h3>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="right-col col-lg-6 d-flex align-items-center">            
<?php						
if($user_profile['interest']!='')
{
$CI =& get_instance();
										$CI->load->model('usersmodel');
										$interest_id=$user_profile['interest'];
										$interest_id= str_replace(",", "','", $interest_id); 
										
         $interest_type =  $CI->usersmodel->fetch_query("SELECT  * from  interest_category_tbl where id in ('$interest_id')");
         foreach($interest_type as $itype)
		 {
			$i[]=$itype['category_name'] ;
		 }
		 
		$user_interest_type=implode(',',$i);
}
?>		 
                                            <div class="comments">
                                                <?=  $user_interest_type ; ?>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                               <!-- <div class="project">
                                    <div class="row bg-white has-shadow">
                                        <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                            <div class="project-title d-flex align-items-center">                                                
                                                <div class="text">
                                                    <h3 class="h4">Last Active time</h3>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="right-col col-lg-6 d-flex align-items-center">                                            
                                            <div class="comments">
                                                <?= date('m/d/Y g:ia',strtotime($user_profile['online_status'])) ?>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="project">
                                    <div class="row bg-white has-shadow">
                                        <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                            <div class="project-title d-flex align-items-center">                                                
                                                <div class="text">
                                                    <h3 class="h4">Last Login time</h3>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="right-col col-lg-6 d-flex align-items-center">                                            
                                            <div class="comments">
                                                <?= date('m/d/Y g:ia',strtotime($user_profile['login_time'] ))?>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>                    
                                <div class="project">
                                    <div class="row bg-white has-shadow">
                                        <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                            <div class="project-title d-flex align-items-center">                                                
                                                <div class="text">
                                                    <h3 class="h4">Last logout Time</h3>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="right-col col-lg-6 d-flex align-items-center">                                            
                                            <div class="comments">
                                                <?= date('m/d/Y g:ia ',strtotime($user_profile['log_out'])) ?>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div> -->
                                <div class="project">
                                    <div class="row bg-white has-shadow">
                                        <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                            <div class="project-title d-flex align-items-center">                                                
                                                <div class="text">
                                                    <h3 class="h4">Last OS</h3>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="right-col col-lg-6 d-flex align-items-center">                                            
                                            <div class="comments">
                                                <?= $user_profile['device'] ?>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="project">
                                    <div class="row bg-white has-shadow">
                                        <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                            <div class="project-title d-flex align-items-center">                                                
                                                <div class="text">
                                                    <h3 class="h4">Last Ip Address</h3>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="right-col col-lg-6 d-flex align-items-center">                                            
                                            <div class="comments">
                                                <?= $user_profile['ip'] ?>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="project">
                                    <div class="row bg-white has-shadow">
                                        <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                            <div class="project-title d-flex align-items-center">                                                
                                                <div class="text">
                                                    <h3 class="h4">Login Count</h3>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="right-col col-lg-6 d-flex align-items-center">                                            
                                            <div class="comments">
                                                <?= $user_profile['login_count'] ?>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="project">
                                    <div class="row bg-white has-shadow">
                                        <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                            <div class="project-title d-flex align-items-center">                                                
                                                <div class="text">
                                                    <h3 class="h4">Member Since</h3>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="right-col col-lg-6 d-flex align-items-center">                                            
                                            <div class="comments">
                                                <?php
                                                $date1 = date_create(date('Y-m-d', strtotime($user_profile['login_time'])));
                                                $date2 = date_create(date('Y-m-d H:i:s'));
                                                $diff = date_diff($date1, $date2);
                                                echo $diff->y . ' Years ' . $diff->m . ' months ' .   $diff->d . ' days '.'<br>' 
												. $diff->h . ' hours ' . $diff->i . ' min ' . $diff->s . ' seconds';
                                                ?>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="btn btn-link btn-block"><a  data-toggle="collapse" href="#collapseContact" aria-expanded="false" aria-controls="collapseExample">
                                    Contact 
                                </a> 
								<a style="float:right"  href="<?= base_url().'users/contact_history/'.$user_id?>">
                                    Contact history
                                </a> 
								</div>
                                <div class="project">
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-lg-12">
                                            <div class="collapse" id="collapseContact">
                                                <div class="card card-block">
                                                    <form class="form-horizontal" method="post" id="contact-form">
                                                        <div class="form-group row" id="contact_msg">
                                                            <input type="hidden" name="viasp-vc" id="viasp-vc" value="<?=$user_id?>">
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 form-control-label">Name</label>
                                                            <div class="col-sm-9">
                                                                <input id="inputHorizontalname" type="text" placeholder="Name" name="name" class="form-control form-control-success" value="<?= $user_profile['name'] ?>" disabled="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 form-control-label">Email</label>
                                                            <div class="col-sm-9">
                                                                <input id="inputHorizontalemail" type="email" placeholder="Email" name="email" class="form-control form-control-warning" value="<?= $user_profile['email'] ?>" disabled="" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 form-control-label">Message</label>
                                                            <div class="col-sm-9">
                                                                <textarea id="inputHorizontalemessage" class="form-control" name="message"></textarea>

                                                            </div>
                                                        </div>
                                                        <div class="form-group row">       
                                                            <div class="col-sm-9 offset-sm-3">
                                                                <button type="submit" class="btn btn-primary">Send</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                </div>  
                                                                                             
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>   
    <script>
        $(function (e) {
            $('#contact-form').submit(function (e) {
                e.preventDefault();
                var data = $(this).serializeArray();                
                data.push({name:"name",value: $('#inputHorizontalname').val()});
                data.push({name:"email",value: $('#inputHorizontalemail').val()});
                data.push({name:"viasp-vc",value: $('#viasp-vc').val()});
                $.ajax({
                    url: "<?= base_url() . 'ajax/send_mail' ?>",
                    method: "POST",
                    data: $.param(data),
                    dataType: 'json',
                    success: function (res) {
                        //console.log(res);
                        var response ='';
                        if(res.status==true)
                        {
                            response = '<center><div class="p-3 mb-2 bg-success text-white">'+res.msg+'</div></center>';
                        }
                        else
                        {
                            response = '<center><div class="p-3 mb-2 bg-danger text-white">'+res.msg+'</div></center>';
                        }
                        $('#contact_msg').html(response); 
					 
						$('#inputHorizontalemessage').val(""); 
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });

            });
        });
    </script>
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