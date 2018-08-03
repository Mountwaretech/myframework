<?php
    /*global functions template
    20/07/2017 9:18PM
    */ 
    function init_profileBx($data_val)
    {
      global $base_url,$qisk_db;
      $data_val=data_encode($data_val,"decode");
      $get_admin_data=$qisk_db->get_results("select * from smart_admin where user_unique_id='".sql_quote_string($_SESSION['admin_unique_id'])."' "); 
      $logged_userData=get_user_data($_SESSION['admin_unique_id']);
  
      if($data_val=="profile_data")
      { 
         
        ?>
        <div class="_dvChr_b458 _fld_tb145">
          <div class="_sbhd_452">Account Details</div>
          <div class="_cnt_d_tbl7">
             <table>
                <tr> 
                   <td class="_cnt_dta">
                      First Name
                   </td>
                   <td class="_cnt_vl">
                      <?= ucwords($logged_userData->first_name);?>
                   </td>
                </tr>
                <tr>
                   <td class="_cnt_dta">
                      Last Name
                   </td>
                   <td class="_cnt_vl">
                      <?= ucwords($logged_userData->last_name);?>
                   </td>
                </tr>
                <tr>
                   <td class="_cnt_dta">
                      Email
                   </td>
                   <td class="_cnt_vl">
                      <?= strtolower($logged_userData->email_id);?>
                   </td>
                </tr>
                <tr>
                   <td class="_cnt_dta">
                      Phone
                   </td>
                   <td class="_cnt_vl">
                      <?= $logged_userData->phone;?>
                   </td>
                </tr> 
             </table>
          </div>
       </div>
        <?php
      }
      if($data_val=="password_reset")
      {
          ?>
           <div class="_dvChr_b458 _fld_tb145">
           <form id="pwd_reset_frm">
          <div class="_sbhd_452">Reset Password </div>
          <div class="_cnt_d_tbl7">
             <table>
           
                <tr>
                   <td class="_cnt_dta">
                      Old Password
                   </td>
                   <td class="_cnt_vl">
                   <input type="text" class="form-control pass_reset" name="old_pwd" >
                   </td>
                </tr>
                <tr>
                   <td class="_cnt_dta">
                      New Password
                   </td>
                   <td class="_cnt_vl">
                   <input type="password" class="form-control pass_reset" name="new_pwd">
                   </td>
                </tr> 
                <tr>
                   <td class="_cnt_dta">
                 Confirm Password
                   </td>
                   <td class="_cnt_vl">
                   <input type="password" class="form-control pass_reset" name="confirm_pwd">
                   </td>
                </tr>
             
                <tr>  
                   <td class="_cnt_dta">
                   </td>
                   <td class="_cnt_vl">
                      <div class="text_right">
                      <button class="btn btn-small btn-register waves-effect waves-light pass_resetbtn">Reset</button>
                      </div>
                   </td>
                </tr>
             </table>
          </div>
          </form>
       </div> 
          <?php
      }

      if($data_val=="company_info")
      {
        $get_company_data=$qisk_db->get_results("select * from company_profile");
        if($get_company_data!=NULL)
        { 
        ?>
        <div class="_dvChr_b458 _fld_tb145">
           <form id="comp_prof_frorm">
          <div class="_sbhd_452">Company Information </div>
          <div class="_cnt_d_tbl7">
             <form id="news_frm1243_add">
              <div class="form-group clearfix">
                <label for="userName">Email Address<span class="text-danger">*</span></label>
                <div> 
                <input class="form-control" name="email" type="text" value="<?= $get_company_data[0]->email_id; ?>">
                </div>
              </div>
              <div class="form-group clearfix">
                <label for="userName">Phone<span class="text-danger">*</span></label>
                <div> 
                    <input class="form-control" name="phone" type="text" value="<?= $get_company_data[0]->phone; ?>">
                </div>  
              </div>
              <div class="form-group clearfix">
                <label for="userName">FAX<span class="text-danger">*</span></label>
                <div> 
                    <input class="form-control" name="fax_number" type="text" value="<?= $get_company_data[0]->fax_number; ?>">
                </div>  
              </div>
              <div class="form-group clearfix">
                <label for="userName">Company Address<span class="text-danger">*</span></label>
                <div> 
                <textarea class="form-control" name="com_addred"><?= $get_company_data[0]->address ?></textarea>  
                </div>
              </div>
              <div class="form-group clearfix">
                <label for="userName">Company Description<span class="text-danger">*</span></label>
                <div> 
                 <textarea class="form-control" name="com_desc"><?= $get_company_data[0]->comp_info; ?></textarea>  
                </div>
              </div> 
              <div class="form-group clearfix">
                <label for="password">Company Logo Image</label>
                <div>
                    <div class="imgbx_btn" id="image_url">Image Upload</div>
                    <div class="_img_bx_disdata">
                      <input type="file" name="image_url" id="img_logo_file" class="btn btn-primary" style="display:none;" accept="image/*">
                      <div class="_imng_bx_dataset">
                          <div class="img_prod_bx-mn-lst">
                            <img src="<?= $get_company_data[0]->logo1 ?>" alt="News Image" class="_com_src_log">
                          </div>
                      </div>
                    </div>
                </div>
              </div> 
          </form> 
          <div class="text-right">
              <button class="btn btn-success waves-effect waves-light _com_btn">
              <i class="fa fa-check"></i>
              Save</button>  
          </div>
          </div>
          
       </div> 
        <?php
        }
      }
    }
    
    function get_individual_country($country_code)
    {
         global $base_url,$url,$qisk_db; 
        $get_country_data=get_countryDataset();  
        $country_data = sortbycase($get_country_data,array('US','IN'));
        if($country_data!=NULL)
        {
            foreach($country_data as $country_data_key=>$country_data_val)
            {
                if($country_data_key==$country_code)
                {
                      $individual_country=array("country_code"=>$country_data_key,"country_name"=>$country_data_val->country_name);
                }
            }  
        } 
           return $individual_country;
    }
 
function get_user_data($user_unique_id)
{
     global $base_url,$url,$qisk_db,$image_url;
     $user_data=NULL; 
       $get_user_data=$qisk_db->get_results("select * from " . USER_TBL_PREFIX . "_admin
 where user_unique_id='".sql_quote_string($user_unique_id)."' ");
 
     if($get_user_data!=NULL)
     {
        $user_data= $get_user_data[0]; 
        if(empty($user_data->image_url))
        {
           $user_data->image_data=$image_url->get_url("userImage");
        }
        if(!empty($user_data->user_info))
        {
           $user_info=json_decode($user_data->user_info); 
           $user_data->address1=$user_info->address1;
           $user_data->address2=$user_info->address2;
           $user_data->city=$user_info->city;
           $user_data->state=$user_info->state;
           $user_data->pincode=$user_info->pincode; 
           $user_data->country_code=$user_info->country;  
          
           if(!empty($user_info->country))
           {
               $country_data=get_country_data_single($user_info->country);
               $user_data->country_name=$country_data->country_name;
               $user_data->dialling_code=$country_data->dialling_code;  
           } 
        }
     } 
    return $user_data;
}
   
 


/*check admin as super admin*/
function check_super_admin()
{
    global $base_url,$url,$qisk_db;
     $get_admin_users=$qisk_db->get_results("select * from qisk_admin where user_status='1' and user_role='super_admin' and user_unique_id='".sql_quote_string($_SESSION['admin_unique_id'])."' ");
     if($get_admin_users!=NULL)
     {
         return TRUE;
     }
     else
     {
       return FALSE;   
     }
} 
function email_template($title_name,$uname,$message)
{
   
    global $base_url;

$email_data='<div style="padding: 20px 0px;    background-color: #f9f9f9;"><table class="ev-wrapper" cellpadding="0" cellspacing="0" border="0" width="100%" style="border-width:0;mso-table-lspace:0pt;mso-table-rspace:0pt;border-image-width:0;outline-color:0;border-image-slice:0;border-collapse:collapse;" >
  <tr>
    <td style="border-collapse:collapse;" >
    	
    	
      
      <table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-width:0;mso-table-lspace:0pt;mso-table-rspace:0pt;border-image-width:0;outline-color:0;border-image-slice:0;border-collapse:collapse;" >
        <tr>
          <td class="ev-desk-margin ev-mobile-hide" style="border-collapse:collapse;font-family:sans-serif;font-size:1px;" >&nbsp;</td>
          <td class="ev-content" style="border-collapse:collapse;width:600px;" >
            <table class="ev-header" cellpadding="0" cellspacing="0" border="0" width="100%" height="auto" style="border-width:0;mso-table-lspace:0pt;mso-table-rspace:0pt;border-image-width:0;outline-color:0;border-image-slice:0;border-collapse:collapse;background-repeat:no-repeat;background-position:center;" >
              <tr>
                <td valign="top" class="logo-menu" style="border-collapse:collapse;" >
                  
                  <table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-width:0;mso-table-lspace:0pt;mso-table-rspace:0pt;border-image-width:0;outline-color:0;border-image-slice:0;border-collapse:collapse;" >
                    <tr>
                      <td align="left" class="logo" style="border-collapse:collapse;padding-bottom:15px;" ><!-- [logo] --> 
                        <a href="'.$base_url.'" target="_blank" style="text-decoration:none;color:#1d1d1d;" ></a><img src="'.$base_url.'/assets/images/Lausanne_Business_Solutions_lgo.png" alt="lausannesolutions" height="80" editable label="lausannesolutions" style="border-width:0;border-image-width:0;outline-color:0;text-decoration:none;-ms-interpolation-mode:bicubic;display:inline-block;" /> 
                        <!-- /[logo] --></td>
                        <td align="right" class="menu" style="border-collapse:collapse;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
                        <table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-width:0;mso-table-lspace:0pt;mso-table-rspace:0pt;border-image-width:0;outline-color:0;border-image-slice:0;border-collapse:collapse;" >
                    <tr>
                      <td align="right" class="ev-p" width="32.6666666%" style="border-collapse:collapse;mso-line-height-rule:exactly;font-family:Lato, Helvetica, Arial, sans-serif;line-height:26.18px;font-size:14px;color:#1d1d1d;" ><!-- [menu-1] -->
                        

                        
                      </td>
                      
                    </tr>
                  </table> 
                       </td>
                    </tr>
                    
                  </table>
                  
              </tr>
              
            </table>
           
           </td>
          <td class="ev-desk-margin ev-mobile-hide" style="border-collapse:collapse;font-family:sans-serif;font-size:1px;" >&nbsp;</td>
        </tr>
      </table>
      

      
      <modules>
        
        <module label="content-coloum"> 

          <table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-width:0;mso-table-lspace:0pt;mso-table-rspace:0pt;border-image-width:0;outline-color:0;border-image-slice:0;border-collapse:collapse;" >
            <tr>
              <td class="ev-desk-margin ev-mobile-hide" style="border-collapse:collapse;font-family:sans-serif;font-size:1px;" >&nbsp;</td>
              <td class="ev-content" style="border-collapse:collapse;width:600px;" >
                
                <table class="mail-content" cellpadding="0" cellspacing="0" border="0" width="100%" style="border-width:0;mso-table-lspace:0pt;mso-table-rspace:0pt;border-image-width:0;outline-color:0;border-image-slice:0;border-collapse:collapse;" >
                  <tr>
                    <td class="wrapper" style="border-collapse:collapse;" >
                      
                      <table  cellpadding="0" cellspacing="0" border="0" align="right" style="border-width:0;mso-table-lspace:0pt;mso-table-rspace:0pt;border-image-width:0;outline-color:0;border-image-slice:0;border-collapse:collapse;" >
                        <tr>
                          <td class="border-box" align="center" style="border-collapse:collapse;height:auto;width:600px;border-width:1px;border-style:solid;border-color: #f4f4f4;
    padding-top: 20px;
    padding-bottom: 20px;
    padding-right: 40px;
    padding-left: 40px;
    background-color: white;" >
                            
                            <table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-width:0;mso-table-lspace:0pt;mso-table-rspace:0pt;border-image-width:0;outline-color:0;border-image-slice:0;border-collapse:collapse;" >
                              <tr>
                                <td class="title bold" align="center" style="border-collapse:collapse;mso-line-height-rule:exactly;font-family:Lato, Helvetica, Arial, sans-serif;color:#1d1d1d;font-size:19px;line-height:41.4px;font-weight:bold;padding-bottom:16px;" >
                                  
                                  <single label="Title Bold">'.$title_name.'</single>
                                  
								</td>
                              </tr>
                            </table>
                            
                            
                            <table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-width:0;mso-table-lspace:0pt;mso-table-rspace:0pt;border-image-width:0;outline-color:0;border-image-slice:0;border-collapse:collapse;" >
                              <tr>
                                <td class="h-line" style="border-collapse:collapse;mso-line-height-rule:exactly;line-height:0px;font-size:1px;background-color:#1d1d1d;height:1px;" >&nbsp;</td>
                              </tr>
                            </table>
                            
                            
                            <table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-width:0;mso-table-lspace:0pt;mso-table-rspace:0pt;border-image-width:0;outline-color:0;border-image-slice:0;border-collapse:collapse;" >
                              <tr>
                                <td class="ev-p" align="center" style="border-collapse:collapse;mso-line-height-rule:exactly;font-family:Lato, Helvetica, Arial, sans-serif;line-height:26.18px;font-size:14px;text-align:justify" >
                                  
                                <p style="margin-top:15px;margin-bottom:15px;margin-right:0;margin-left:0;    line-height: 18px;" >'.$message.'</p></td>
                              </tr>
                            </table>
                          
                            
                            <table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-width:0;mso-table-lspace:0pt;mso-table-rspace:0pt;border-image-width:0;outline-color:0;border-image-slice:0;border-collapse:collapse;" >
                              <tr>
                                <td class="button-wrapper" align="center" style="border-collapse:collapse;padding-top:20px;" ><table class="ev-button" cellpadding="0" cellspacing="0" border="0" style="border-width:0;mso-table-lspace:0pt;mso-table-rspace:0pt;border-image-width:0;outline-color:0;border-image-slice:0;border-collapse:collapse;background-color:#ffdc18;" >
                                   
                                  </table></td>
                              </tr>
                            </table>
                            
                         </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                
               </td>
              <td class="ev-desk-margin ev-mobile-hide" style="border-collapse:collapse;font-family:sans-serif;font-size:1px;" >&nbsp;</td>
            </tr>
          </table>
          
        </module>
        </modules>
      
      
     
      
</td>
  </tr>
</table>
<div class="m_7374848218864747563m_ftr_mn_bx" style="font-size:10px;color:#666666;line-height:18px;padding-bottom:10px;width:90%;margin:0 auto">
        <div style="direction:ltr;text-align:center">Copyright &copy;'.date("Y").'. Lausanne Business Solutions.</div><div class="yj6qo"></div><div class="adL">
        </div></div>
</div>';
return $email_data;  
} 
function arr_to_obj($arraySet)
{
      $arraySet=json_decode(json_encode($arraySet)); 
      return $arraySet;
}
 
/*get country data*/
function get_country_data()
{
    
  global $base_url;
   $get_url=$base_url."/assets/data/country_data.json";
        $header = array();         
      $ch = curl_init(); 
       curl_setopt_array($ch, array( 
          CURLOPT_URL => $get_url,     
          CURLOPT_HTTPHEADER => $header,
          CURLOPT_POST => FALSE,
          CURLOPT_RETURNTRANSFER => TRUE
      ));    
      $output = curl_exec($ch);
      curl_close($ch);

 $get_country_data=json_decode($output);
 return $get_country_data;
}

/*get country data single*/
function get_country_data_single($country_code)
{
  $get_country_data=get_country_data();
      foreach($get_country_data as $country_key=>$country_data)
      {
        if($country_key==$country_key)
        {
              return $country_data;
        } 
      }  
}

function save_into_notif($data_type,$data,$empl_uniq_id)
{
    global $qisk_db;
    $date= new Datetime();
    $ins_notif_tbl = $qisk_db->query("insert into _notif_tbl(re_empl_uniq_id,data,data_type,created_date) VALUES('".sql_quote_string($empl_uniq_id)."','".sql_quote_string($data)."','".sql_quote_string($data_type)."','".sql_quote_string($date->format("Y-m-d H:i:s"))."')");
    if(!empty($ins_notif_tbl))
    {
        return true;
    }
    else
    {
        return false;
    }
}