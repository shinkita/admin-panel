<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Contact History</h2>
        </div>
    </header>
    <!--Breadcrumb-->
    <div class="breadcrumb-holder container-fluid">
        <ul class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="<?=$user_contact_history?>">User Profile</a></li>
        </ul>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url() ?>users">Users</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url() ?>users/profile/<?=$user_id?>">Profile</a></li>
            <li class="breadcrumb-item active">Contact history</li>
        </ul>
    </div>
    <!-- Dashboard Counts Section-->
    <section class="tables">   
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-12">
                    <div class="card">
                        <div class="card-header">
                           <h3>Recent mails</h3>
                        </div>  
                        <div class="card-body">                                               
                            <div class="row">
                                        <?php 
                                        foreach($emails as $k => $v){
                                        ?>
                                        <!-- Project-->
										
                                            <div class="col-md-12 col-sm-12 col-lg-12 col-12 col-xs-12 "> 
												<div class="user-info">
                                                <div class="rounded has-shadow p-2 mb-3">
                                                    <div class="contact-msg">
                                                        <?php echo stripslashes($v['msg']); ?>
                                                    </div>
                                                    <div class="sent-status"> 
                                                        <strong>Sent Status : </strong>
                                                        <?php  echo $status = ($v['status'] === 'Successful')?'<span class="text-primary">'.$v['status'].'</span>':'<span class="text-danger">'.$v['status'].'</span>'; ?>
                                                    </div>
                                                    <div class="sent-date-time">
                                                        <?php echo $v['date_time']; ?>
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
