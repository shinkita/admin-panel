    </div>
    </div> 
    <script>
    $(function(){
        <?php 
        if(isset($active_list))
        {
            ?>
                    var active_list = "<?=$active_list?>";
                    $('#'+active_list).addClass('active');
            <?php        
        }
        ?>
    });
    </script>