<?php
   function get_qisk_front_files($type,$title)
   {
    global $base_url,$qisk;
    $get_query_vars=$qisk->query_vars();
    $page_type=$get_query_vars['page_type'];
    $JS_CSS_UNIQ_ID = JS_CSS_UNIQ_ID();
   ?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="global softwares development in coimbatore">
<?php
   if(get_device_tm()=="mobile")
   {
   ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
   }  
   ?>
<title><?= $title; ?></title>
<link rel="stylesheet" href="//cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="<?= $base_url;?>/assets/css/bootstrap.min.css?_cache=true" rel="stylesheet" type="text/css" />
<link href="<?= $base_url;?>/assets/css/style.css?_cache=true" rel="stylesheet" type="text/css" />
<link href="<?= $base_url;?>/assets/css/editor.css?_cache=true" rel="stylesheet" type="text/css" />
<link href="<?= $base_url;?>/assets/css/animate.css?_cache=true" rel="stylesheet" type="text/css" />
<link href="<?= $base_url;?>/assets/css/bootstrap-material-datetimepicker.css?_cache=true" rel="stylesheet" type="text/css" />
<link href="<?= $base_url;?>/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $base_url;?>/assets/css//buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $base_url;?>/assets/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
<?php
   if($page_type=="login_page")
   {
   ?>
<link href="<?= $base_url;?>/assets/css/_login_bx.css" rel="stylesheet" type="text/css" />
<?php
   } 
   ?>
<link href="<?= $base_url;?>/assets/css/_true_bx.css?_cache=true" rel="stylesheet" type="text/css" />
<?php
   if(get_device_tm()=="mobile")
   {
   ?>
<link href="<?= $base_url;?>/assets/css/mbl_stl51.css?_cache=true" rel="stylesheet" />
<?php
   } 
   ?>
<script src="<?= $base_url;?>/assets/js/jquery.min.js"></script>
<script src="<?= $base_url;?>/assets/js/bootstrap.min.js"></script>
<script src="<?= $base_url;?>/assets/js/jquery.dataTables.min.js"></script> 
<script src="<?= $base_url;?>/assets/js/waves.js"></script>
<script src="<?= $base_url;?>/assets/js/_234Js_min.js?_cache=true"></script>
<script src="<?= $base_url;?>/assets/js/_us_324js.js?_cache=true"></script>
<script src="<?= $base_url;?>/assets/js/editor.js?_cache=true"></script> 
<script src="<?= $base_url;?>/assets/js/report_124.js?_cache=true"></script>
<script src="<?= $base_url;?>/assets/js/setting_124.js?_cache=true"></script> 
<script src="<?= $base_url;?>/assets/js/moment-with-locales.min.js?_cache=true"></script>  
<script src="<?= $base_url;?>/assets/js/bootstrap-material-datetimepicker.js?_cache=true"></script>  
<?php
   }
   
   function _top_header()
   {
       global $base_url; 
       $username="smart Canteen ";
       $image_url=$base_url."/assets/img/user_default.jpg";
       if(isset($_SESSION['admin_unique_id']))
       {
           $user_data=get_user_data($_SESSION['admin_unique_id']);  
           $image_url=$user_data->image_data;
          $username=$user_data->first_name. " ".$user_data->last_name;
       } 
       ?>
<div class="bx-msg-data"></div>
<div class="_loder_disbx">
   <div class="spinner">
      <div class="bounce1"></div>
      <div class="bounce2"></div>
      <div class="bounce3"></div>
   </div>
</div>
<div class="topbar">
   <!-- LOGO -->
   <?= logo_func();?>
   <nav class="navbar-custom">
      <ul class="list-inline float-right mb-0">
         
          <li class="list-inline-item ">
            <a class="nav-link waves-effect waves-light" href="javascript:void(0);">
                <?= $username;?>
            </a>
        </li>

           <li class="list-inline-item dropdown notification-list">
            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
            <img src="<?= $image_url; ?>" alt="user" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown sett_mnubx" aria-labelledby="Preview">
               <div class="dropdown-item noti-title">
                  <h5 class="text-overflow"><small>Welcome ! <?= $username; ?></small> </h5>
               </div>
               <a href="<?= $base_url;?>/profile" class="dropdown-item notify-item">
               <i class="zmdi zmdi-account-circle"></i> <span>Profile</span>
               </a>
               <a  class="dropdown-item notify-item _log_out_fn">
               <i class="zmdi zmdi-power"></i> <span>Logout</span>
               </a> 
            </div>
         </li>
      </ul>
      <ul class="list-inline menu-left mb-0">
         <li class="float-left">
            <button class="button-menu-mobile open-left waves-light waves-effect">
            <i class="zmdi zmdi-menu"></i>
            </button>
         </li>
      </ul>
   </nav>
</div>
<?php
   }
   
   function logo_func()
   { 
       global $qisk_db,$base_url;
       ?>
<div class="topbar-left">
   <a href="" class="logo">
      <!-- <img src="<?= $base_url;?>/assets/img/logo.png" alt="Qatar Factory Image" class="_qtr_lmgvx"/> -->
      <span>smart Canteen</span>
</div>
<?php
   }
   
   function menu_dataset()
   {
       global $qisk_db,$base_url;
      
       ?>
<div class="sidebar-inner slimscrollleft">
<!--- Sidemenu -->
<div id="sidebar-menu">
<ul>
<li class="text-muted menu-title"></li>
<li class="has_sub">
<a href="<?= $base_url; ?>" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i><span> Dashboard </span> </a>
</li> 
<?php
if($_SESSION['login_type']=="super_admin")
{
    ?> 
<li class="has_sub">
<a href="javascript:void(0);" class="waves-effect"><i class="fa fa-database"></i> <span> Master Management</span> <span class="menu-arrow"></span></a>
<ul class="list-unstyled" style="display: none;">
<li>
<a href="<?= $base_url;?>/master/class">Class listing</a>
</li> 
<li>
<a href="<?= $base_url;?>/master/section">Section Listing</a>
</li> 

<li>
<a href="<?= $base_url;?>/master/department">Department Listing</a>
</li>  
</ul>
</li>  

<li class="has_sub">
<a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-format-underlined"></i> <span> Branch Management</span> <span class="menu-arrow"></span></a>
<ul class="list-unstyled" style="display: none;"> 
<li>
<a href="<?= $base_url;?>/branch-listing">Branch Listing</a>
</li>  
</ul>
</li>


<li class="has_sub">
<a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-format-underlined"></i> <span> Stall Management</span> <span class="menu-arrow"></span></a>
<ul class="list-unstyled" style="display: none;"> 
<li>
<a href="<?= $base_url;?>/stall-listing">Stall Listing</a>
</li>  
</ul>
</li>

<li class="has_sub">
<a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-format-underlined"></i> <span> User Management</span> <span class="menu-arrow"></span></a>
<ul class="list-unstyled" style="display: none;">
<li>
<a href="<?= $base_url;?>/user-listing?type=add-user">Add User</a>
</li> 
<li>
<a href="<?= $base_url;?>/user-listing">User Listing</a>
</li>  
</ul>
</li>


<li class="has_sub">
<a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user"></i> <span> Student Management</span> <span class="menu-arrow"></span></a>
<ul class="list-unstyled" style="display: none;">
<li>
<a href="<?= $base_url;?>/student_listing">Student listing</a>
</li>  
</ul>
</li> 



<li class="has_sub">
<a href="javascript:void(0);" class="waves-effect"><i class="fa fa-credit-card"></i> <span>RFID Card Management</span> <span class="menu-arrow"></span></a>
<ul class="list-unstyled" style="display: none;">
<li>
<a href="<?= $base_url;?>/card_setting">Card Setting</a>
</li>  
</ul>
</li> 

<li class="has_sub">
<a href="javascript:void(0);" class="waves-effect"><i class="fa fa-credit-card"></i> <span>Ads Setting</span> <span class="menu-arrow"></span></a>
<ul class="list-unstyled" style="display: none;">
<li>
<a href="<?= $base_url;?>/ads-listing">Ads Listing</a>
</li>  
</ul>
</li> 


<li class="has_sub">
<a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user"></i> <span> Reports Management</span> <span class="menu-arrow"></span></a>
<ul class="list-unstyled" style="display: none;">
<li>
<a href="<?= $base_url;?>/reports_management?data_type=student_payment">Student Payment Reports</a>
</li>  
<li>    
<a href="<?= $base_url;?>/reports_management?data_type=sales_payments">Sales card Reports</a>
</li>  

<li>    
<a href="<?= $base_url;?>/reports_management?data_type=sales_cash">Sales cash Reports</a>
</li>  
</ul>
</li> 
<?php
}
else
{
    ?>

<li class="has_sub">
<a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user"></i> <span> Terminal Management</span> <span class="menu-arrow"></span></a>
<ul class="list-unstyled" style="display: none;">
<li>
<a href="<?= $base_url;?>/terminal-listing">Terminal listing</a>
</li>   
</ul>
</li> 

    <li class="has_sub">
<a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user"></i> <span> Product Management</span> <span class="menu-arrow"></span></a>
<ul class="list-unstyled" style="display: none;">
<li>
<a href="<?= $base_url;?>/product_category">Category listing</a>
</li>  
<li>
<a href="<?= $base_url;?>/product_listing">Product listing</a>
</li> 
</ul>
</li> 

<li class="has_sub">
<a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user"></i> <span> Reports Management</span> <span class="menu-arrow"></span></a>
<ul class="list-unstyled" style="display: none;">
<li>
<a href="<?= $base_url;?>/reports_management?data_type=student_payment">Student Payment Reports</a>
</li>  
<li>    
<a href="<?= $base_url;?>/reports_management?data_type=sales_payments">Sales Card Reports</a>
</li>  

<li>    
<a href="<?= $base_url;?>/reports_management?data_type=sales_cash">Sales cash Reports</a>
</li>  
</ul>
</li> 

    <?php
}
?>
<div class="clearfix"></div>
</div>
</div>
<?php
}