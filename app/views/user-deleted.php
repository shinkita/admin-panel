<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Users</h2>
        </div>
    </header>
    <!--Breadcrumb-->
    <div class="breadcrumb-holder container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ul>
    </div>
    <!-- Dashboard Counts Section-->
    <section class="tables">
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-close">
                        <div class="dropdown">
                            <!--<button type="button" id="closeCard3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                            <div aria-labelledby="closeCard3" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                        -->
						
						</div>
                    </div>
                    <div class="card-header d-flex align-items-center">                        
                        <div class="">
                            <div class="input-group"><span class="input-group-btn">
                                    <button type="button" class="btn btn-primary"><i class="icon-search"></i></button></span>
                                <input id="search_input" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="all_del_users">
                        
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
    $(function () {
        load_user();
        $('#search_input').keyup(function(){
            load_user();
        });
    });
    function load_user(start = 0) {
        var s_input = $('#search_input').val();        
        $.ajax({
            url:"<?=base_url().'ajax/load_data'?>",
            method:"POST",
            data:{where:s_input,start_page:start},           
            success:function(data){
                //console.log(data);
                $('#all_del_users').html(data); 
            },
            error:function(e){
                console.log(e);
            }
        })
    }
    function active(id,thiss)
    {
        // console.log(element);        
        $.ajax({
            url:"<?=base_url().'ajax/active'?>",
            method:"POST",
            data:{id:id}, 
            dataType:'json',          
            success:function(data){                
                if(data.status==true)
                {
                    thiss.innerHTML = data.icon;
                }
                else
                {
                    thiss.innerHTML = data.icon;
                }
                // $('#all_users').html(data); 
            },
            error:function(e){
                console.log(e);
            }
        })
    }
</script>