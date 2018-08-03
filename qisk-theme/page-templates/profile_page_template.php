<?php
   global $qisk_db,$base_url,$image_url;
   if(isset($_SESSION['admin_unique_id'])) 
   {   
    get_qisk_header();
    $date_format = new DateTime();
    $date = $date_format->format("Y-m-d h:i:s"); 
   ?>
<div class="main_cntbx">
   <div class="content-page">
      <!-- Start content -->
      <div class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-12">
                  <?php 
                  if(isset($_GET['type']))
                  {
                        if(trim($_GET['type']=="edit"))
                        {
                            $user_unique_id=$_SESSION['admin_unique_id'];
                            $user_data=get_user_data($user_unique_id); 
                        ?>
                          <div class="card-box">
                     <div class="_bx_cnval_124">

                      <div class="_panel_hdnx">
                           <div class="_pnel_datavx">  
                              <span class="span_titlebx">
                              <a href="<?= $base_url; ?>/profile">  <span class="zmdi zmdi-arrow-left _icn_ze"></span></a>
                              <?= ucwords("Edit profile");?>
                              </span>   
                           </div>
                        </div> 
                        <form id="admin_frm123" >
                           <input type="hidden" name="user_unique_id" value="<?= data_encode($_SESSION['admin_unique_id'],"encode"); ?>" />
                           <input type="hidden" name="type" value="<?= data_encode("profile","encode");?>" />
                            <div  class="wizard clearfix">
                                 <div class="bx_rox123">
                                 <h5><?= ucwords("Account Information"); ?></h5>
                                 <section>
                                    <div class="row">
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Firts Name<span class="text-danger">*</span></label>
                                             <div>
                                                <input class="form-control"  name="first_name" type="text" value="<?= $user_data->first_name;?>">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Last Name<span class="text-danger">*</span></label>
                                             <div>
                                                <input class="form-control"  name="last_name" type="text" value="<?= $user_data->last_name;?>">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="password"> Email address	<span class="text-danger">*</span></label>
                                             <div>
                                                <input  name="email_id" type="text" class=" form-control" value="<?= $user_data->email_id;?>">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="password"> User Name	<span class="text-danger">*</span></label>
                                             <div>
                                                <input  name="username" type="text" class=" form-control" value="<?= $user_data->username;?>">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Phone Number<span class="text-danger">*</span></label>
                                             <div>
                                                <input  name="phone_number" type="text" class=" form-control" value="<?= $user_data->phone;?>">
                                             </div>
                                          </div>
                                       </div>
                                      
                                       </div>
                                 </section>
                                 </div>
                              </div>
                              <div  class="wizard clearfix">
                                 <div class="bx_rox123">
                                    <h5>Profile Information</h5>
                                    <section>
                                       <div class="row">
                                          <div class="col-xs-12 col-sm-6">
                                             <div class="form-group clearfix">
                                                <label for="userName">Address1<span class="text-danger">*</span></label>
                                                <div>
                                                   <textarea  class="form-control _text_area" name="address1"><?= $user_data->address1;?></textarea> 
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xs-12 col-sm-6">
                                             <div class="form-group clearfix">
                                                <label for="userName">Address1<span class="text-danger">*</span></label>
                                                <div>
                                                   <textarea  class="form-control _text_area" name="address2"><?= $user_data->address2;?></textarea>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xs-12 col-sm-6">
                                             <div class="form-group clearfix">
                                                <label for="password"> City	<span class="text-danger">*</span></label>
                                                <div>
                                                   <input  name="city" type="text" class=" form-control" value="<?= $user_data->city;?>">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xs-12 col-sm-6">
                                             <div class="form-group clearfix">
                                                <label for="password"> State	<span class="text-danger">*</span></label>
                                                <div>
                                                   <input  name="state" type="text" class=" form-control" value="<?= $user_data->state;?>">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xs-12 col-sm-6">
                                             <div class="form-group clearfix">
                                                <label for="userName">Pincode<span class="text-danger">*</span></label>
                                                <div>
                                                   <input  name="pincode" type="text" class=" form-control _num_type" value="<?= $user_data->pincode;?>">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xs-12 col-sm-6">
                                             <div class="form-group clearfix">
                                                <label for="userName">Country<span class="text-danger">*</span></label>
                                                <div>
                                                   <select class="form-control" name="country">
                                                      <?php
                                                         $get_country_data=get_country_data();
                                                         if($get_country_data!=NULL)
                                                         {
                                                            
                                                             foreach($get_country_data as $country_key=>$country_data)
                                                             {
                                                                 
                                                                 if(trim($user_data->country_code) == trim($country_key))
                                                                 {
                                                                    $selected='selected="selected"';
                                                                 }
                                                                 else
                                                                 {
                                                                     $selected='';
                                                                 }
                                                                 ?>
                                                      <option <?= $selected;?> value="<?= data_encode($country_key,"encode");?>">
                                                         <?= $country_data->country_name; ?>
                                                      </option>
                                                      <?php 
                                                         }
                                                         }
                                                         ?>
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </section>
                                 </div>
                              </div> 
                              <div  class="wizard clearfix">
                                 <div class="bx_rox123">
                                    <section>
                                       <div class="row">
                                          <div class="col-xs-12 col-sm-6">
                                             <div class="form-group clearfix">
                                                <label for="password"> User Profile</label>
                                                <div>
                                                   <div class="imgbx_btn" id="image_url">Image Upload</div>
                                                   <div class="_img_bx_disdata">
                                                      <input type="file" name="image_url" id="img_logo_file" class="btn btn-primary" style="display:none;" accept="image/*">
                                                      <div class="_imng_bx_dataset">
                                                         <div class="img_prod_bx-mn-lst">
                                                            <img src="<?= $user_data->image_data; ?>" alt="Profile Image" class="_com_src_log">
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </section>
                                 </div>
                              </div>

                        </form>
                        <div class="text-right">
                           <button class="btn btn-success waves-effect waves-light admim_adbtn">
                           <i class="fa fa-check"></i>
                           Update</button>  
                        </div>
                     </div>
                  </div>
                    <?php
                        }
                    }
                  else
                  {

                    $get_results=$qisk_db->get_results("select * from smart_admin where user_unique_id='".sql_quote_string($_SESSION['admin_unique_id'])."' ");
                           if($get_results!=NULL)
                           {
                               $user_data=$get_results[0];
                              
                               $info_data=json_decode($user_data->user_info);   
                               $get_country_data=get_individual_country($info_data->country);
                               if(!empty($user_data->image_url))
                               {
                                   $userimage=$user_data->image_url;
                               }
                               else
                               {
                                  $userimage= CLIENT_DOMAIN."/assets/img/default-profile.png";
                               }
                  ?> 
               <div class="card-box">
                  <div class="_bx_cnval_124">
                     <div class="_panel_hdnx">
                        <div class="_pnel_datavx">  
                           <span class="span_titlebx">
                           <a href="<?= $base_url; ?>/profile">  <span class="zmdi zmdi-arrow-left _icn_ze"></span></a>
                           <?= ucwords("Profile Details");?>
                           </span>   
                        </div>
                     </div>

                       <div class="panel-wrapper">
                              <div class="panel-body">
                                 <div class="_prof_bx78">
                                    <?php
                                       if($user_data->user_active==1)
                                       {
                                           ?>
                                    <span class="mdi mdi-check-circle _actv475u"></span>
                                    <?php
                                       }
                                       ?>
                                    <div class="_prof_img45">
                                        <?php
                                        if(!empty($user_data->image_url))
                                        {
                                            ?>
                                        <span class="mdi mdi-close-circle-outline user_imgrmve" data-val="<?= data_encode($_SESSION['admin_unique_id'],"encode"); ?>">
                                        <?php
                                        }
                                        ?>
                                        </span>
                                       <img src="<?= $userimage;?>"/>
                                    </div>
                                    <div class="_nme_tbl4">
                                       <?= ucwords($user_data->first_name." " .$user_data->last_name);?>
                                    </div>
                                    <div class="_pwed_nx12">
                                       <?php
                                       if($_SESSION['login_type']!="super_admin")
                                       {
                                           ?>
                                            <a class="hrefdiv_bx" href="<?= $base_url;?>/profile?type=edit">Edit</a>
                                           <?php
                                       }
                                       ?>
                                        <a class="hrefdiv_bx password_reset" data-val="<?= data_encode($user_data->user_unique_id,"encode"); ?>">Password Reset</a>
                                    </div>
                                 </div>
                                 <div>
                                    <div class="_dvChr_b458 _fld_tb145">
                                       <div class="_sbhd_452">Account Information</div>
                                       <div class="_cnt_d_tbl7">
                                          <table>
                                           
                                             <tr>
                                                <td class="_cnt_dta">
                                                   First Name
                                                </td>
                                                <td class="_cnt_vl">
                                                   <?= ucwords($user_data->first_name);?>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td class="_cnt_dta">
                                                   Last Name
                                                </td>
                                                <td class="_cnt_vl">
                                                   <?= ucwords($user_data->last_name);?>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td class="_cnt_dta">
                                                   User Name
                                                </td>
                                                <td class="_cnt_vl">
                                                   <?= strtolower($user_data->username);?>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td class="_cnt_dta">
                                                   Email
                                                </td>
                                                <td class="_cnt_vl">
                                                   <?= strtolower($user_data->email_id);?>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td class="_cnt_dta">
                                                   Phone
                                                </td>
                                                <td class="_cnt_vl">
                                                   <?= $user_data->phone;?>
                                                </td>
                                             </tr>
                                            
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="_dvChr_b458 _fld_tb145">
                                    <div class="_sbhd_452">Personal Information</div>
                                    <div class="_cnt_d_tbl7">
                                       <table>
                                          <tr>
                                             <td class="_cnt_dta">
                                                Address
                                             </td>
                                             <td class="_cnt_vl">
                                                <div> <?= ucwords($info_data->address1);?></div>
                                                <div> <?= ucwords($info_data->address2);?></div>
                                             </td>
                                          <tr>
                                             <td class="_cnt_dta">
                                                Country
                                             </td>
                                             <td class="_cnt_vl">
                                                <?= strtolower($get_country_data['country_name']);?>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="_cnt_dta">
                                                City
                                             </td>
                                             <td class="_cnt_vl">
                                                <?= $info_data->city;?>
                                             </td>
                                          </tr>
                                      
                                          <tr>
                                             <td class="_cnt_dta">
                                                State
                                             </td>
                                             <td class="_cnt_vl">
                                                <?= $info_data->state;?>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="_cnt_dta">
                                                Postal code
                                             </td>
                                             <td class="_cnt_vl">
                                                <?= $info_data->pincode;?>
                                             </td>
                                          </tr>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                  </div>
               </div>
               <?php
                           }
                  }
                  ?>
            </div>
         </div>
      </div>
      <!-- end col-->
   </div>
   <!-- end row -->
</div>
<!-- container -->
</div>
<!-- content -->
</div>
</div>
<?php
get_qisk_footer();
}
else
{
header("Location:".$base_url."/login");  
}