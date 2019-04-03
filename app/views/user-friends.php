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
            <li class="breadcrumb-item active">Friends</li>
        </ul>
    </div>
    <!-- Dashboard Counts Section-->
    <section class="tables">   
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-12">
                    <div class="card">                        
                        <div class="card-body">
                            <h3>Friends list</h3><small></small>                      
                            <div class="d-flex flex-wrap">
                                <?php
                                $start = 1;
                                foreach ($friends as $k => $v) {
                                    $img_sr = $v['user_pic'];                                    
                                        echo '<div class="col-md-3 col-sm-6 col-lg-2 col-12 col-xs-12">';
                                        ?>
                                        <div class="has-shadow text-center align-middle rounded" style="height: 8em; background: #191919;">
                                        <img src="<?= $gallary_path . $img_sr ?>" class="m-1" alt="Cinque Terre" style="max-width:100%; max-height: 8em; margin-top: auto;">
                                        </div>
									
                                        <?php       
                                        $is_friend =     $v['isFriend']==1?' <strong style="color:teal;"> Friend </strong> ':'';   
                                        $is_faimily = $v['isFamily']==1?' <strong style="color:purple;">Family  </strong> ':'';
                                        $is_Professional = $v['isProfessional']==1?' <strong style="color:blue;">Professional</strong>  ':'';                          
                                        echo '<div>'.$v['name']. '<br>'. $is_friend.$is_faimily.$is_Professional.'</div>';
                                        // echo '<div>'.$v['isFriend']==1?'Friend':''.'</div>';
                                        // echo '<div>'.$v['isFamily']==1?'Family':''.'</div>';
                                        // echo '<div>'.$v['isProfessional']==1?'Professional':''.'</div>';
                                        echo '<div class="mb-3"><a href="'.base_url().'users/profile/'.$v['id'].'">View</a></div>';
                                        echo '</div>';                                    
                                }
                                ?>
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
    $(function(){
        $('.m-1').click(function(){                        
            $('#potosModal').modal('show');            
            var source = $(this).attr('src');
            $('#img-model').attr('src',source);
        });
    });
</script>
