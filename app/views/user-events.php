<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Users</h2>
        </div>
    </header>
    <!--Breadcrumb-->
    <div class="breadcrumb-holder container-fluid">
        <ul class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="<?=$user_profile_link?>">User Profile</a></li>
        </ul>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url() ?>users">Users</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url() ?>users/profile/<?=$user_id?>">Profile</a></li>
            <li class="breadcrumb-item active">Events</li>
        </ul>
    </div>
    <!-- Dashboard Counts Section-->
    <section class="tables">   
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-12">
                    <div class="card">
                        <div class="card-header">
                           <h3>Posted Events</h3>
                        </div>
                        
                        <div class="card-body">                                               
                            <div class="row">
                                       <?php
foreach ($events as $k => $v) {
    // print_r($v);  
?>
                                   <!-- Project-->
                                    
                                    <div class="col-md-4 col-sm-6 col-lg-3 col-12 col-xs-12"> 
                                        <div class="user-info">
                                            <div class="rounded has-shadow p-2 mb-3">
                                                
                                                <?php
    $expired = ((time() - (60 * 60 * 24)) > strtotime($v['event_start'])) ? true : false;
?>
                                               
                                                <span class="p-2" style="width:100%;background:<?php
    echo ($expired != true) ? '#33b35a;' : 'red;';
?> color: #fff;">  
                                                    <span style= "color:#fff;">
                                                        <?php
    echo ($expired != true) ? date('m/d/y - g:ia', strtotime($v['event_start'])) : 'Expired';
?></span>
                                                    </span>                                          
                                                    <?php 
                                                    if($v['cancelled'] == 1)
                                                    { ?>
                                                    <h3 class="h4 mt-2" style="color:red;">Cancelled</h3>
                                                    <div><strong>Reson : </strong><?= $v['reason'] ?></div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <h3 class="h4 mt-2"><?= $v['title'] ?></h3>
                                                    <p style="text-align: justify;" class="event_box"><?= $v['description'] ?></p>
                                                    <div><strong>Name : </strong><?= $v['name'] ?></div>
                                                        <?php
    /*
    <div><strong>Profile : </strong><?=$profile?></div>
    
    <div><strong>Ownership : </strong><?=$ownership?></div>*/
?>
                                                       <div><strong>No of gathering : </strong><a href="#attanding_<?php
    echo $v['id'];
?>"><?= $v['attanding_users'] ?></a></div>
<div><strong>Address : </strong><?= $v['address'] ?></div> 
                                                        <div><strong>Posted On : </strong><?= date('m/d/Y - g:ia', strtotime($v['date_time'])) ?></div>                                                         
                                                        <?php
    $st = ($v['cancelled'] == 1) ? '<a href="' . base_url() . 'users/deactive_event/' . $v['id'] . '" class="btn fg-white btn-danger">In active</a>' : '<a href="' . base_url() . 'users/deactive_event/' . $v['id'] . '" class="btn btn-success fg-white">Active</a>';
?>             
                                                                                                      
                                                        <div class="mb-3 rounded"><?= $st ?> <a href="<?=base_url()?>users/view_event/<?=$v['id']?>" class="btn btn-info fg-white"> Preview</a>   </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div id="attanding_<?php
    echo $v['id'];
?>" class="attanding_modal_window">
                                                <div>
                                                    <a href="#attanding_close_<?php
    echo $v['id'];
?>" title="close" class="attanding_modal_close"><i class="fa fa-close"></i></a>
                                                    <div class="content">
                                                        <h3>No of peoples</h3> 
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="d-flex flex-wrap">
                                                                    <?php
    foreach ($v['user_detail'] as $key => $value) {
?>
                                                                       
                                                                        <div class="col-md-3 col-sm-6 col-lg-2 col-12 col-xs-12">
                                                                            <div class="has-shadow text-center align-middle rounded" style="height: 8em; background: #191919;">
                                                                                <a href="<?= base_url() ?>users/profile/<?= $value['user_id'] ?>" target="_blank">
                                                                                    <img src="https://www.viaspot.com/vsdeveloper/api/viaspot_users/<?php
        echo $profile = $value['profile_pic'] != '' ? $value['profile_pic'] : 'user_pic.png';
?>" alt="Cinque Terre" style="max-width:100%; max-height: 8em; margin-top: auto;">

                                                                                </a>

                                                                            </div>
                                                                            
                                                                            <center><h5><?= $value['name'] ?></h5></center>
                                                                        </div>
                                                                        
                                                                        <?php
    }
?>
                                                               </div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>                                        
                                            <?php
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
			
    }
		
		
    });
</script>
<script>
var txt = $(".Event_color").text();
console.log("The original string: " + txt);
	if (txt  == "Event Expired") {

        $(this).css("color", "#de280a");
    }
else
{
	console.log("Nothing gonna be change here");
}	
</script>
