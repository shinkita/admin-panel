<?php 
// print_r($count_dashboard);
?>
<div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <div class="pull-right mx-2"><a href="<?=base_url().'setting'?>"><i class="icon-settings"></i></a></div>
              <div class="pull-right">Last login : <?=date('m/d/Y - g:ia',strtotime($count_dashboard[0]['lgin_time']))?></div>
              

                <h2 class="no-margin-bottom">Dashboard</h2>
              
            </div>
          </header>
          <!-- Dashboard Counts Section-->
		  
		  <?php  if($_SESSION['via-spot_admin']['type']!='business') { ?>
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="col-xl-3 col-sm-6"> 
					<div class="item d-flex align-items-center statistic">
                    <div class="icon bg-violet"><i class="icon-user"></i></div>
                    <div class="text"><strong><?=$count_dashboard[0]['COUNT(*)']?></strong><br><a href="<?=base_url()?>users"> <small> Active Users</small></a></div>
                  </div>
				
                </div>
				<div class="col-xl-3 col-sm-6"> 
					<div class="item d-flex align-items-center statistic">
                    <div class="icon bg-violet"><i class="icon-user"></i></div>
                    <div class="text"><strong><?=$count_dashboard[0]['inactive_users']?></strong><br><a href="<?=base_url()?>users"> <small> Inactive Users</small></a></div>
                  </div>
				
                </div>
                <div class="col-xl-3 col-sm-6"> 
          <div class="item d-flex align-items-center statistic">
                    <div class="icon bg-violet"><i class="icon-user"></i></div>
                    <div class="text"><strong><?=$count_dashboard[0]['deleted_users']?></strong><br><a href="<?=base_url()?>deleted_users"> <small> Deleted Users</small></a></div>
                  </div>
        
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center statistic">
                    <div class="icon bg-red"><i class="icon-frame-picture-streamline"></i></div>
                    <div class="text"><strong><?=$count_dashboard[0]['t_post']?></strong> <br><a href="#"><small>Posts</small></a></div>
                  </div>
				  </div>
                
                <!-- Item -->
                
                </div>
                <!-- Item -->
<!--                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-orange"><i class="icon-check"></i></div>
                    <div class="title"><span>Last<br>Login</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="{#val.value}" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?=$count_dashboard[0]['lgin_time']?></strong></div>
                  </div>
                </div>-->
              </div>
           
          </section>
          <!-- Dashboard Header Section    -->
          <section class="dashboard-header">
            <div class="container-fluid">
              <div class="row">
                <!-- Statistics -->
                <div class="statistics  col-lg-3 col-md-3">
                  <div class="statistic  d-flex  bg-white align-items-center has-shadow col-md-12">
                    <div class="icon bg-red"><i class="icon-photo"></i></div>
                    <div class="text"><strong><?=$count_dashboard[0]['t_images']?></strong><br><a href="<?=base_url()?>users/profile_photo/"><small>Images</small></a></div>
                  </div>
				  </div>
				  <div class="statistics  col-lg-3 col-md-3">
                  <div class="statistic d-flex   bg-white has-shadow  align-items-center col-md-12">
                    <div class="icon bg-green"><i class="fa fa-calendar-o"></i></div>
                    <div class="text"><strong><?=$count_dashboard[0]['t_events']?></strong><br><a href="<?=base_url()?>users/profile_events/"><small>Events</small></a></div>
                  </div>
				  </div>
				  <div class="statistics  col-lg-3 col-md-3">
                  <div class="statistic   d-flex bg-white has-shadow align-items-center  col-md-12">
                    <div class="icon bg-orange"><i class="icon-camera-streamline-video"></i></div>
                    <div class="text"><strong><?=$count_dashboard[0]['t_video']?></strong><br><a href="<?=base_url()?>users/profile_video/"><small>Videos</small></a></div>
                  </div>
				  </div>
          <div class="statistics  col-lg-3 col-md-3">
                  <div class="statistic   d-flex bg-white has-shadow align-items-center  col-md-12">
                    <div class="icon bg-green"><i class="icon-speech-streamline-talk-user"></i></div>
                                                           
                    <div class="text"><strong><?=$count_dashboard[0]['t_groups']?></strong><br> <a href="#"><small>Groups</small></a></div>
                  </div>
          </div>
                </div>
                <!-- Line Chart            -->
                <!-- <div class="chart col-lg-6 col-12">
                  <div class="line-chart bg-white d-flex align-items-center justify-content-center has-shadow"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
                    <canvas id="lineCahrt" style="display: block; width: 550px; height: 275px;" width="550" height="275"></canvas>
                  </div>
                </div> -->
                <!--<div class="chart col-lg-3 col-12">
                   Bar Chart   
                  <div class="bar-chart has-shadow bg-white"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
                    <div class="title"><strong class="text-violet">95%</strong><br><small>Current Server Uptime</small></div>
                    <canvas id="barChartHome" style="display: block;" width="260" height="130"></canvas>
                  </div>-->
                  <!-- Numbers--
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-green"><i class="fa fa-line-chart"></i></div>
                    <div class="text"><strong>99.9%</strong><br><small>Success Rate</small></div>
                  </div> 
                </div>-->
              </div>
         
          </section>
		  
		  <?php } else { ?>
		  
		  <?php } ?>
          <!-- Projects Section-->
          <!-- Client Section-->
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