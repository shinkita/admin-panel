<nav class="side-navbar">
          <!-- Sidebar Header-->
		  <div class="left-container">
          <div class="sidebar-header d-flex align-items-center">
              <?php
              $profile_image = '';
              if(!(isset($profile_image)) || $profile_image == '')
              {
                  $profile_image = base_url().'assets/img/viaspot_admin.png';
              }
              ?>
            <div class="avatar"><img src="<?=$profile_image?>" alt="admin" class="img-fluid rounded-circle"></div>
            <div class="title">
              <h1 class="h4"><?=$admin_user['username']?></h1>
              <p>viaspot</p>
            </div>
          </div>
          <!-- Sidebar Navidation Menus-->
          <span class="heading">Main</span>
          <ul class="list-unstyled"> 
              <li id="Home" class="white-show"><a href="<?= base_url()?>"><i class="icon-home-house-streamline"></i>Home</a></li>
              <li id="Users"><a href="<?= base_url().'users'?>"><i class="icon-user"></i>Users</a></li>              
                            
              <li id="Profile_pages"><a href="#profile_drop" class="dropdown-toggle" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" role="button"><i class="icon-speech-streamline-talk-user"></i>Profile Pages</a></li>
              <ul id="profile_drop" class="dropdown open">
				
                <li><a href="<?=base_url()?>users/profile_events">Profile Events</a></li>
                <li><a href="<?=base_url()?>users/profile_photo">Profile Photos</a></li>
                <li><a href="<?=base_url()?>users/profile_video">Profile Videos</a></li>
              </ul>              
              <li id="Term"><a href="<?=base_url()?>users/term_condition"><i class="icon-design-pencil-rule-streamline"></i>Term & Conditions</a></li>              
              <li id="Faq"><a href="<?=base_url()?>users/faq"><i class="icon-monocle-mustache-streamline"></i>FAQ</a></li>                              
             <!-- <li id="Merchant_pages"><a href="#merchant_drop" aria-expanded="false" data-toggle="collapse"><i class="icon-shop"></i>Merchant Pages</a></li>
              <ul id="merchant_drop" class="collapse list-unstyled">
                <li><a href="#">Merchant Users</a></li>
                <li><a href="#">Merchant Terms</a></li>
                <li><a href="#">Merchant</a></li>
                <li><a href="#">Merchant Admin</a></li>
                <li><a href="#">Update Plan</a></li>                                 
              </ul>-->
              <li id="Setting">
                <a href="<?=base_url().'setting'?>"><i class="icon-settings"></i>Change Password</a>
              </li>
			  </div>
</nav>