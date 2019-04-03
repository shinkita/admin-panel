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
                      Faq
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
                    $position_value = (set_value('position') != '') ? set_value('position'): $faq['position_no'];
                    $question_value = (set_value('question') != '') ? set_value('question'):$faq['faq_question'];
                    $answer_value = (set_value('answer') != '') ? set_value('answer'):$faq['faq_answer'];
                    $status_value = (set_value('status') != '') ? set_value('status'):$faq['status'];
                    // $deleted_value = (set_value('is_deleted') != '') ? set_value('is_deleted'):$faq['is_deleted'];
                    ?>
                    <form method="post">
                      <div class="form-row">
                        <div class="col">
                          <input type="text" class="form-control <?= $position ?>" name="position" placeholder="Position" value="<?php echo $position_value; ?>" required>
                        </div>
                        <div class="col">
                              <input type="text" class="form-control <?= $question ?>" name="question" placeholder="Question" value="<?php echo $question_value; ?>" required>
                        </div>
                        </div>
                        <div class="form-row">
                            <div class="col mt-3">  
                                <label>Answer</label>
                            <textarea name="answer" id="answer" class="form-control <?= $answer ?>" required><?php echo $answer_value; ?></textarea>
                        </div>
                        
                        </div> 
                        <div class="form-row">
                            <div class="col">
                                <br>
                                <label>Status</label>
                                <select class="form-control materi" id="exampleFormControlSelect2" name="status">
                                  <option value="1" <?php echo ($status_value === '1')?'selected':'';?>>Active</option>
                                  <option value="0" <?php echo ($status_value === '0')?'selected':'';?>>Inactive</option>                            
                                </select>                                
                            </div>
                            <div class="col">
                                
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
    CKEDITOR.replace( 'answer' );
});
</script>