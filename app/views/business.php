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
                      <a href="<?=base_url()?>business/new_account" class="btn btn-primary">Add Feed</a>
                    </div>                    
                    <div class="card-body">
                        <?php if(count($faq)>0) { ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Advertiser Name</th>
                                      <th scope="col">Category</th>
                                      <th scope="col">Date</th>
									  <th scope="col">Paid/Not Paid</th>
									  <th scope="col">Status</th>
                                      <th scope="col">Delete</th>
                                      <th scope="col">Edit</th>
                                    </tr>
                                  </thead>
                                <tbody>  
                            <?php 
                            if(isset($response))
                            {
                                echo $response;
                            }
                            $sr = $sno;
							
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
                                        <a href="<?=$profile_link?>"><?=$v['account_name']?></a>
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
                                        <?=($v['status']==1)?'<a href="'.base_url().'business/deactive_account/'.$v['id'].'" class="btn btn-small btn-success"><i class="icon-bulb"></i></a>':'<a href="'.base_url().'business/deactive_account/'.$v['id'].'" class="btn btn-small btn-danger"><i class="icon-bulb"></i></a>'?>
                                        
                                    </td>
                                    <td>
                                        <a href="<?=base_url()?>business/delete_account/<?=$v['id']?>" onclick="return confirm('You are about to delete account, countinue ?')" class="btn btn-small btn-danger"><i class="fa fa-trash-o"></i></a>
                                    </td>    
                                    <td>
                                        <a href="<?=base_url()?>business/edit_account/<?=$v['id']?>" class="btn btn-warning"><i class="icon-pencil"></i></a>
                                    </td>
                                </tr>

                                <?php
                                $sr++;
                            }
                            ?>
                            </tbody>
                            </table>
                            <?php }  else {  echo 'No Feed In your Account.' ;?>
					
					
					<?php } ?> 
                            <div class="paging"><?php echo $paging; ?></div>                                
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