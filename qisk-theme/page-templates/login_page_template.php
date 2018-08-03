<?php
   if(!isset($_SESSION['admin_unique_id']))
   {
       global $base_url,$qisk_db;
        get_qisk_header("login"); 
   ?>
<div class="_loder_disbx">
   <div class="spinner">
      <div class="bounce1"></div>
      <div class="bounce2"></div>
      <div class="bounce3"></div>
   </div>
</div>
<div class="login_mainbx">
   <div id="lgn-msg_cnt-scs"></div>
   <div id="lgn-msg_cnt-err"></div>
   <div class="lg_accpge animated bounceIn">
      <div class="log_cntbx mb-0">
         <div class="text_center mg_setbx">
            <div  class="logo_txt">
               <!-- <img src="<?= $base_url; ?>/assets/img/logo.png" class="_img_srcbx" alt="Hydac Image" /> -->
               <span class="_lgo_bx">Smart Card</span>
            </div>
         </div>
         <?php
            if(isset($_GET['login_type']))
            {
                $type=trim($_GET['login_type']);
                if($type=="forget")
                {
                    ?>
         <div class="mg_top_10 ">
            <div class="row_bx">
               <div class="div_bx12 text_center">
                  <h6 class="_lgin_text">Forget</h6>
               </div>
            </div>
            <form class="m-t-20" id="logFRmData_set">
               <input type="hidden" name="type" value="<?= data_encode($_GET['login_type'],"encode"); ?>"/>
               <div class="div_bxcl row_bx">
                  <div class="div_bx12">
                     <lable class="_lble_124">Email Address</lable>
                     <input name="_lg_user" id="_lg_user" class="text_bx_disp" type="text"  placeholder="Email Address">
                  </div>
                  <span class="span_error span_lg_user"></span>
               </div>
            </form>
            <div class="div_bxcl text_center row_bx mg_top_10">
               <div class="div_bx12"> 
                  <button class="waves-effect waves-light _base_btnbx _logbtn">
                  Forget
                  </button>
               </div>
            </div>
            <div class="text_center">
                 Already have an account? <a href="<?= $base_url;?>/login">Sign in </a>
            </div>
         </div>
         <?php
            }
            if($type=="password_reset")
            {
                ?>
         <div class="mg_top_10 ">
            <div class="row_bx">
               <div class="div_bx12 text_center">
                  <h6 class="_lgin_text">Password reset</h6>
               </div>
            </div>
            <form class="m-t-20" id="logFRmData_set">
               <input type="hidden" name="type" value="<?= data_encode($_GET['login_type'],"encode"); ?>"/>
               <div class="div_bxcl row_bx">
                  <div class="div_bx12">
                     <lable class="_lble_124">Verify Code</lable>
                     <input name="verify_code" id="_verify_code" class="text_bx_disp _num_type" type="text"  placeholder="Verify Code" maxlength="6">
                  </div>
                  <span class="span_error span_lg_user"></span>
               </div>
               <div class="div_bxcl row_bx">
                  <div class="div_bx12">
                     <lable class="_lble_124">New Password</lable>
                     <input name="new_pwd" id="_new_pwd" class="text_bx_disp" type="password"  placeholder="New Password">
                  </div>
                  <span class="span_error span_lg_user"></span>
               </div>
               <div class="div_bxcl row_bx">
                  <div class="div_bx12">
                     <lable class="_lble_124">Confirm Password</lable>
                     <input name="confirm_pwd" id="confirm_pwd" class="text_bx_disp" type="password"  placeholder="Confirm Password">
                  </div>
                  <span class="span_error span_lg_user"></span>
               </div>
            </form>
            <div class="text_center row_bx mg_top_10">
               <div class="div_bx12"> 
                  <button class="waves-effect waves-light _base_btnbx _logbtn">
                  Continue
                  </button>
               </div>
            </div>
         </div>
         <?php
            } 
            }
            else
            {
            ?>
         <div class="mg_top_10 ">
            <div class="row_bx">
               <div class="div_bx12 text_center">
                  <h6 class="_lgin_text">Login</h6>
               </div>
            </div>
            <form class="m-t-20" id="logFRmData_set">
            <input type="hidden" name="type" value="<?= data_encode("login","encode"); ?>"/>
               <div class="div_bxcl row_bx">
                  <div class="div_bx12">
                     <lable class="_lble_124">Username</lable>
                     <input name="_lg_user" id="_lg_user" class="text_bx_disp" type="text"  placeholder="Username">
                  </div>
                  <span class="span_error span_lg_user"></span>
               </div>
               <div class="div_bxcl row_bx">
                  <div class="div_bx12">
                     <lable class="_lble_124">Password</lable>
                     <input name="_lg_pwd" id="_lg_pwd" class="text_bx_disp" type="password"  placeholder="Password">
                  </div>
                  <span class="span_error span_lg_pwd"></span>
               </div>
            </form>
            <div class="div_bxcl text_center row_bx mg_top_10">
               <div class="div_bx12">
                  <a href="<?= $base_url;?>/login?login_type=forget" class="fd_pwdhref">
                  <i class="fa fa-lock m-r-5"></i> Forgot your password?
                  </a>
                  <button class="waves-effect waves-light _base_btnbx _logbtn mg_top">
                  Login
                  </button>
               </div>
            </div>
         </div>
         <?php
            }
            ?>
      </div>
      <div class="clearfix"></div>
   </div>
</div>
</div>
<?php
get_qisk_footer("login");
}
else
{
header("Location:".$base_url."");
}