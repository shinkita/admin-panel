<!-- <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/text-editor.css">
<script type="text/javascript" src="<?=base_url()?>assets/js/wysiwyg.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/wysiwyg-editor.min.js"></script> -->
<script src="//cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Faq</h2>
        </div>
    </header>
    <!--Breadcrumb-->
    <div class="breadcrumb-holder container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active">Faq</li>
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
                      FAQ
                  </div>                    
                  <div class="card-body">
                    <?php 
                    $position = $question = $answer = '';
                    if(validation_errors() !='')
                    {
                        ?>
                        <div class="text-danger">
                            <?php echo validation_errors(); ?>       
                        </div>
                        <?php
                    }                    
                    if(form_error('position') != '')
                    {
                        $position = 'is-invalid';
                    }
                    if(form_error('question') != '')
                    {
                        $question = 'is-invalid';
                    }
                    if(form_error('answer') != '')
                    {
                        $answer = 'is-invalid';
                    }
                    ?>
                    <form method="post">
                      <div class="form-row">
                        <div class="col">
                          <input type="text" class="form-control <?= $position ?>" name="position" placeholder="Position" value="<?php echo set_value('position'); ?>" required>
                        </div>
                        <div class="col">
                              <input type="text" class="form-control <?= $question ?>" name="question" placeholder="Question" value="<?php echo set_value('question'); ?>" required>
                        </div>
                        </div>
                        <div class="form-row">
                            <div class="col mt-3"> 
                                <label>Answer</label>
                            <textarea name="answer" id="answer" class="form-control <?= $answer ?>" required><?php echo set_value('answer'); ?></textarea>
                        </div>
                        </div> 
                        <br>                         
                        <button type="submit" class="btn btn-success float-right">Save</button>
                    </form>
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
                <p>Viaspot © 2018</p>
            </div>
            <div class="col-sm-6 text-right">
                <p>Design by <a href="www.viaspot.com" class="external">Viaspot</a></p>
               
            </div>
        </div>
    </div>
</footer>
</div>
<script>
  $(function() {
    CKEDITOR.replace( 'answer' );
});
</script>