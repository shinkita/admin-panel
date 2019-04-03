<?php 
// print_r($events);
?>
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
            <!-- <li class="breadcrumb-item"><a href="<?=$user_profile_link?>">User Profile</a></li> -->
        </ul>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url() ?>users">Users</a></li>
            <!-- <li class="breadcrumb-item"><a href="<?= base_url() ?>users/profile/<?=$user_id?>">Profile</a></li> -->
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
                           <h3><?=$events['title']?></h3>
                        </div>
                           
                        <div class="card-body">                                               
                            <div class="row" style="margin-bottom: 20px;">
                                <?php if($events['img'] != '') :?>
                                    <div class="col-md-6 col-sm-12 col-lg-6 col-12 col-xs-12" style="display: flex;justify-content: center;">
                                        <img src="<?=$gallary_path.$events['img'];?>" style="max-height:250px;" class="photo-gallary m-1"/>
                                      </div>
                                <?php endif; ?>   
                                <?php if($events['video'] != '') :?>
                                    
                                    <div class="col-md-6 col-sm-12 col-lg-6 col-12 col-xs-12" style="max-height: 250px;display: flex;justify-content: center;">
                                        <div class="embed-responsive embed-responsive-16by9" style="max-height: 250px;">
                                            <video controls>
                                                <source src="<?= $gallary_path . $events['video']  ?>" type="video/mp4">                                        
                                            </video>
                                        </div>    
                            
                                    
                                     </div>  
                                <?php endif; ?>      
                                
                                     
                            </div>
                            <div class="project">
                            <div class="row">
                                <div class="col-12">
                                    <p  class="text-justify">
                                    <?=$events['description']?>
                                </p>
                                </div>
                            </div> 
                                <?php 
                                                    if($events['cancelled'] == 1)
                                                    { ?>
                                                        <div class="row has-shadow">
                               
                                    <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                    <div class="project-title d-flex align-items-center">                                                
                                        <div class="text">
                                                    <h3 class="h4 mt-2" style="color:red;">Cancelled</h3>
                                                    </div>
                                    </div>

                                    </div>
                                    
                                
                            

                               
                                <div class="right-col col-lg-6 d-flex align-items-center">                                     
                                    <div class="comments">
                                        Reason : <?= $events['reason'] ?>
                                    </div>
                                </div>
                            </div>
                                                    <?php
                                                    }
                                                    ?>
                              
                            <div class="row has-shadow">
                               
                                    <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                    <div class="project-title d-flex align-items-center">                                                
                                        <div class="text">
                                            <h6 class="h4">Start Time :</h6>
                                        </div>
                                    </div>

                                </div>
                                <div class="right-col col-lg-6 d-flex align-items-center">                                     
                                    <div class="comments">
                                       <?=date('m/d/Y h:i a',strtotime($events['event_start']))?>                                                          </div>                                            
                                </div>
                                    
                                
                            </div> 
                             
                            <div class="row has-shadow">
                                <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                    <div class="project-title d-flex align-items-center">                                                
                                        <div class="text">
                                            <h6 class="h4">End Time :</h6>
                                        </div>
                                    </div>

                                </div>
                                <div class="right-col col-lg-6 d-flex align-items-center">                                     
                                    <div class="comments">
                                       <?=date('m/d/Y  h:i a',strtotime($events['event_end']))?>                                                          </div>                                            
                                </div>
                                    
                                
                            </div>  
                             <div class="row has-shadow">
                                <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                    <div class="project-title d-flex align-items-center">                                                
                                        <div class="text">
                                            <h6 class="h4">Owner :</h6>
                                        </div>
                                    </div>

                                </div>
                                <div class="right-col col-lg-6 d-flex align-items-center">                                     
                                    <div class="comments">
                                       <?=$events['name']?>                                                          </div>                                            
                                </div>
                                   
                               
                            </div>  
                            <div class="row has-shadow">
                                 <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                    <div class="project-title d-flex align-items-center">                                                
                                        <div class="text">
                                            <h6 class="h4">No of gathring :</h6>
                                        </div>
                                    </div>

                                </div>
                                <div class="right-col col-lg-6 d-flex align-items-center">                                     
                                    <div class="comments">
                                       <?=$events['attanding_users']?>                                                          </div>                                            
                                </div>
                                
                            </div> 
                            <div class="row has-shadow">
                                 <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                    <div class="project-title d-flex align-items-center">                                                
                                        <div class="text">
                                            <h6 class="h4">Address : </h6>
                                        </div>
                                    </div>

                                </div>
                                <div class="right-col col-lg-6 d-flex align-items-center">                                     
                                    <div class="comments">
                                       <?=$events['address']?>                                                          </div>                                            
                                </div>
                                
                            </div>  
                            <div class="row has-shadow">
                                 <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                                    <div class="project-title d-flex align-items-center">                                                
                                        <div class="text">
                                            <h6 class="h4">Posted ON : </h6>
                                        </div>
                                    </div>

                                </div>
                                <div class="right-col col-lg-6 d-flex align-items-center">                                     
                                    <div class="comments">
                                       <?=date('m/d/Y',strtotime($events['date_time']))?>                                                          </div>                                            
                                </div>
                                
                            </div>  
                            </div>                           
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
