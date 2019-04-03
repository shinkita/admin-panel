<!-- <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/text-editor.css">
<script type="text/javascript" src="<?=base_url()?>assets/js/wysiwyg.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/wysiwyg-editor.min.js"></script> -->
<script src="//cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Setting</h2>
        </div>
    </header>
    <!--Breadcrumb-->
    <div class="breadcrumb-holder container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active">Term & condition</li>
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
                      Term & condition
                    </div>                    
                    <div class="card-body">
                  			<?php 
                  			if(isset($response))
                  			{
                  				echo $response;
                  			}
                  			?>
                            <form method="post">                                
                                <div class="form-group">
                                    <textarea id="term" name="term">
                                    	<?=$term[0]['headerdesc1']?>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success float-right">Save</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
                
         <br>
         <br>
          
         <br>
           
         <br>
         <br>
           
       
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
<script>
  $(function() {
    CKEDITOR.replace( 'term' );
  });
</script>