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
            <li class="breadcrumb-item active">Photos</li>
        </ul>
        
    </div>
    <!-- Dashboard Counts Section-->
    <section class="tables">   
        <div class="container-fluid right-box">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-12">
                    <div class="card">
                        <div class="card-header">
                           <h3>Photo</h3>
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
                                foreach ($photos as $k => $v) {                                                                        
                                    $images = json_decode($v['images']);                                   
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
                                    echo '';
                                    $trash = (count($images)>1)?true:false;
                                    foreach ($images as $imk=> $img_sr) { 
											
                                        echo '<div class="col-md-2 col-sm-6 col-lg-2 col-12 col-xs-12 ">';
                                        ?>
                                        <div class="">
                                            <img src="<?= $gallary_path . $img_sr ?>" class="m-1 has-shadow photo-gallary" alt="Cinque Terre" style="width:7em; height: 7em;">
                                        
                                        <?php
										 echo '<div class ="user-info">'; 
										 $ownership = ($v['method']=='Shared')?'Shared':'Own';
                                        echo '<div><strong>Profile : </strong>'.$profile.'</div>';
                                        echo '<div><strong>Ownership : </strong>'.$ownership.'</div>';                                        
                                        echo '<div><strong>Posted On : </strong>'.date('m/d/Y - g:ia',strtotime($v['date_time'])).'</div>';
                                        $st = ($v['deleted']==1)?'<a href="'.base_url().'users/active_post/'.$v['id'].'" class="btn fg-white btn-danger activebtn_index.$img_sr(">Inactive</a>':'<a href="'.base_url().'users/deactive_post/'.$v['id'].'" class="btn btn-success fg-white">Active</a>';                                        
                                        echo '<div class="mb-3 rounded">'.$st.'</div>';
                                        if($trash == true)
                                        {
                                        echo '<div class="mb-3 rounded"><a href="'.base_url().'users/deactive_images/'.$v['id'].'/'.$imk.'" class="link text-danger"><i class="fa fa-trash"></i> Trash </a></div>';
                                        }
                                        echo '</div></div> </div>';
                                    }
                                     
                                                                        
                                    $start++;
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
                    <p>Design by <a href="www.viaspot.com" class="external">Viaspot</a></p>
                   
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
