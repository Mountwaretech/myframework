<?php  
function get_stall_data($stall_uniqueid)
{
    global $base_url,$qisk_db;
    $get_userData=$qisk_db->get_results("select * from stall_listData where stall_uniqueid='".sql_quote_string($stall_uniqueid)."' ");
    if($get_userData!=NULL)
    {
        $returndata=$get_userData[0];
      
    }   
    return $returndata;
}
function get_user_position($role_uniqueid)
{
    global $base_url,$qisk_db;
    $get_userData=$qisk_db->get_results("select * from user_rollData where role_uniqueid='".sql_quote_string($role_uniqueid)."' ");
    if($get_userData!=NULL)
    {
        $returndata=$get_userData[0]; 
    }   
    return $returndata;

}
function payment_amount($student_unique_id)
{
     global $base_url,$qisk_db;
     $get_payment_data=$qisk_db->get_results("select * from payment_history where ref_student_uniqueid='".sql_quote_string($student_unique_id)."' ");
     if($get_payment_data!=NULL)
     {
         $debit=0;
         $credit=0;
         foreach($get_payment_data as $data)
         {
             if($data->type=="debit")
             {
                 $debit+=$data->payment;
             }

             if($data->type=="credit")
             {
                 $credit+=$data->payment;
             }
         }  
         $total_payment= intval($debit-$credit);

     } 
     return $total_payment;
}

function get_master_data($data_uniqueid)
{
    global $base_url,$qisk_db;
    $master_data=NULL;
    $get_mater_data=$qisk_db->get_results("select * from master_data where data_uniqueid='".sql_quote_string($data_uniqueid)."' ");
    if($get_mater_data!=NULL)
    {
        $master_data=$get_mater_data[0];
    } 
    return $master_data;
}
 
function get_student_data($student_unique_id)
{
     global $base_url,$url,$qisk_db,$image_url;
     $user_data=NULL; 
       $get_user_data=$qisk_db->get_results("select * from smart_student_data
 where student_unique_id='".sql_quote_string($student_unique_id)."' ");
 
     if($get_user_data!=NULL)
     {
        $user_data= $get_user_data[0]; 
        if(empty($user_data->image_url))
        {
           $user_data->image_data=$image_url->get_url("userImage");
        }
        if(!empty($user_data->stud_info))
        {
           $user_info=json_decode($user_data->stud_info); 
           $user_data->address1=$user_info->address1;
           $user_data->address2=$user_info->address2;
           $user_data->city=$user_info->city;
           $user_data->state=$user_info->state;
           $user_data->pincode=$user_info->pincode;  
        }

        if(!empty($user_data->parent_details))
        {
           $parent_info=json_decode($user_data->parent_details); 
           $user_data->father_name=$parent_info->father_name;
           $user_data->parent_emailid=$parent_info->parent_emailid;
           $user_data->parent_phone=$parent_info->parent_phone; 
        }

     } 
    return $user_data;
}

function get_branch_data($branch_uniqueid)
{
     global $base_url,$url,$qisk_db,$image_url;
     $branch_data=NULL; 
       $get_user_data=$qisk_db->get_results("select * from branch_listData
 where branch_uniqueid='".sql_quote_string($branch_uniqueid)."' ");
 
     if($get_user_data!=NULL)
     {
        $branch_data= $get_user_data[0];  
     } 
    return $branch_data;
}

function _disp_userbx_data($get_resultdata)
{
    global $qisk_db,$base_url,$image_url;
    if($get_resultdata!=NULL)
    { 
    $i=1;
    foreach ($get_resultdata as $row) 
    {
          $branch_data=get_branch_data($row->ref_branch_uniqueid); 
          $stall_data=get_stall_data($row->ref_stall_uniqueid);
         if(empty($row->image_data))
         {
             $image_urls=$image_url->get_url("userImage"); 
         }
         else
         {
             $image_urls=$row->image_data;
         }
      
    ?>
 <div class="adv-table<?php echo data_encode($row->user_unique_id, "encode"); ?> lst_bx458" >
       <div class="_user_img_bx">
          <div class="img_bx_dipy">
             <img src="<?php echo $image_urls; ?>" alt="img" class="user_img_src" style="<?= pic_size_css($image_url);?>"> 
          </div>
       </div> 
          <div class="_user_det_bx">
                 <div class="_name_bx _padbx_123"> 
                     <?php echo ucwords($row->first_name. " " .$row->last_name); ?> 
                     <span class="empltype_bx"><?= $row->user_role; ?></span> 
                 </div> 
             
               <?php
               if(!empty($row->ref_branch_uniqueid))
               {
                   ?>
                     <div class="_span_bx _padbx_123">
                     <span class="_spab_clr">  Branch</span> : <span><?php echo $branch_data->branch_name; ?>  </span>
                       </div>
                   <?php
               }
               if(!empty($row->ref_stall_uniqueid))
               {
                   ?> 
              
                <div class="_span_bx _padbx_123">
                <span class="_spab_clr"> Stall :</span> 
                    <?php echo $stall_data->stall_name; ?>
             </div>
             <?php
               }
               ?>
             <div class="_act_bx_visble _padbx_123">
             <?php
            if($_SESSION['login_type']=="super_admin")
            {
                ?> 
                <a class="cust_href_link" href="<?php echo $base_url; ?>/user-listing?type=edit-user&user_unique_id=<?php echo data_encode($row->user_unique_id, "encode"); ?>">Edit info</a> 
                <a class="cust_href_link" href="<?php echo $base_url; ?>/user-listing?type=view-user&user_unique_id=<?php echo data_encode($row->user_unique_id, "encode"); ?>">View Profile</a>
                <a class="cust_href_link password_reset" data-val="<?= data_encode($row->user_unique_id,"encode"); ?>">Password reset</a>
                <?php
            } 
             ?> 
             <a class="cust_href_link remove_bx" data-val="<?= data_encode(json_encode(array("user",$row->user_unique_id)),"encode"); ?>" >Remove</a>
             </div>
          </div>
    <div class="_user_act_bx">
          <?php 
            if ($row->active_status == 1)
                {
                    $status_label = "Activated";
                    $stats_cls = "act";
                }
            else
                {
                    $status_label = "Deactivated";
                    $stats_cls = "red";
                } 
              ?>
          <a class="user_link_btn user_stuschge <?php echo $stats_cls; ?>" data-val="<?php echo data_encode($row->user_unique_id, "encode"); ?>"><?php echo $status_label; ?></a>
    </div>
 </div>
 </div>
 <?php
$i++;
} 
}
else
{
?>
<div class="prod_assign_itm_bx">
<div class="empt-prod-lbl">
  No Data Found 
</div>
</div>
<?php
}
}



function dis_branch_data($get_resultdata)
{
    global $qisk_db,$base_url,$image_url;
    if($get_resultdata!=NULL)
    { 
    $i=1;
    foreach ($get_resultdata as $row) 
    {
         if(empty($row->image_data))
         {
             $image_urls=$image_url->get_url("userImage"); 
         }
         else
         {
             $image_urls=$row->image_data;
         }
    ?>
 <div class="adv-table<?php echo data_encode($row->user_unique_id, "encode"); ?> lst_bx458" >
       <div class="_user_img_bx">
          <div class="img_bx_dipy">
             <img src="<?php echo $image_urls; ?>" alt="img" class="user_img_src" style="<?= pic_size_css($image_url);?>"> 
          </div>
       </div> 
          <div class="_user_det_bx">
                 <div class="_name_bx _padbx_123"> 
                     <?php echo ucwords($row->branch_name); ?>
                     <?php 
                        if(!empty($row->branch_location))
                        {
                      ?>
                     <span class="empltype_bx"><?php echo ucwords($row->branch_location); ?></span>
                     <?php
                     }
                     ?>
                 </div> 
               <div class="_span_bx _padbx_123">
                   <i class="fa fa-envelope-o"></i> <?php echo $row->email_id; ?>
               </span>
                <div class="_span_bx _padbx_123">
                <i class="fa fa-phone"></i> <?php echo $row->phone; ?>
                </span>
             </div>
             <div class="_act_bx_visble _padbx_123"> 
                <a class="cust_href_link" href="<?php echo $base_url; ?>/branch_listing?type=edit-branch&branch_uniqueid=<?php echo data_encode($row->branch_uniqueid, "encode"); ?>">Edit info</a> 
                <a class="cust_href_link" href="<?php echo $base_url; ?>/branch_listing?type=view-branch&branch_uniqueid=<?php echo data_encode($row->branch_uniqueid, "encode"); ?>">View Profile</a>  
             <a class="cust_href_link remove_bx" data-val="<?= data_encode(json_encode(array("branch",$row->branch_uniqueid)),"encode"); ?>" >Remove</a>
             </div>
          </div> 
 </div>
 </div>
 <?php
$i++;
} 
}
else
{
?>
<div class="prod_assign_itm_bx">
<div class="empt-prod-lbl">
  No Data Found 
</div>
</div>
<?php
}
}


function dis_student_data($get_resultdata)
{
    global $qisk_db,$base_url,$image_url;
    if($get_resultdata!=NULL)
    { 
    $i=1;
    foreach ($get_resultdata as $row) 
    {
         if(empty($row->image_data))
         {
             $image_urls=$image_url->get_url("userImage"); 
         }
         else
         {
             $image_urls=$row->image_data;
         }
    ?>
 <div class="adv-table<?php echo data_encode($row->student_unique_id, "encode"); ?> lst_bx458" >
       <div class="_user_img_bx">
          <div class="img_bx_dipy">
             <img src="<?php echo $image_urls; ?>" alt="img" class="user_img_src" style="<?= pic_size_css($image_url);?>"> 
          </div>
       </div> 
          <div class="_user_det_bx">
                 <div class="_name_bx _padbx_123"> 
                     <?php echo ucwords($row->stud_name); ?>
                     <?php 
                        if(!empty($row->student_register_id))
                        {
                      ?>
                     <span class="empltype_bx"><?php echo ucwords($row->student_register_id); ?></span>
                     <?php
                     }
                     ?>
                 </div> 
               <div class="_span_bx _padbx_123">
                   <i class="fa fa-envelope-o"></i> <?php echo $row->stud_email; ?>
               </span>
                <div class="_span_bx _padbx_123">
                <i class="fa fa-phone"></i> <?php echo $row->stud_phone; ?>
                </span>
             </div>
             <div class="_act_bx_visble _padbx_123"> 
                <a class="cust_href_link _add_card_12"  data-val="<?= data_encode($row->student_unique_id,"encode"); ?>">Card Details</a>  
                <a class="cust_href_link" href="<?php echo $base_url; ?>/student_listing?type=edit-student&student_unique_id=<?php echo data_encode($row->student_unique_id, "encode"); ?>">Edit info</a> 
                <a class="cust_href_link" href="<?php echo $base_url; ?>/student_listing?type=view-student&student_unique_id=<?php echo data_encode($row->student_unique_id, "encode"); ?>">View Profile</a>  
             <a class="cust_href_link remove_bx" data-val="<?= data_encode(json_encode(array("student",$row->student_unique_id)),"encode"); ?>" >Remove</a>
             <?php
             if($row->card_active==0)
             {
                ?>
              <a class="cust_href_link red" >Card is Blocked</a> 
                 <?php
             }
             ?>
             </div>
          </div> 
 </div>
 </div>
 <?php
$i++;
} 
}
else
{
?>
<div class="prod_assign_itm_bx">
<div class="empt-prod-lbl">
  No Data Found 
</div>
</div>
<?php
}
}


function dis_payment_data($get_resultdata)
{
    global $qisk_db,$base_url,$image_url;
    if($get_resultdata!=NULL)
    { 
    $i=1;
    foreach ($get_resultdata as $row) 
    {
       
         if(empty($row->image_data))
         {
             $image_urls=$image_url->get_url("userImage"); 
         }
         else
         {
             $image_urls=$row->image_data;
         }

       $total_amount=payment_amount($row->student_unique_id);
    ?>
 <div class="adv-table<?php echo data_encode($row->student_unique_id, "encode"); ?> lst_bx458" >
       <div class="_user_img_bx">
          <div class="img_bx_dipy">
             <img src="<?php echo $image_urls; ?>" alt="img" class="user_img_src" style="<?= pic_size_css($image_url);?>"> 
          </div>
       </div> 
          <div class="_user_det_bx">
                 <div class="_name_bx _padbx_123"> 
                     <?php echo ucwords($row->stud_name); ?>
                     <?php 
                        if(!empty($row->student_register_id))
                        {
                      ?>
                     <span class="empltype_bx"><?php echo ucwords($row->student_register_id); ?></span>
                     <?php
                     }
                     ?>
                 </div> 
               <div class="_span_bx _padbx_123">
                   <i class="fa fa-envelope-o"></i> <?php echo $row->stud_email; ?>
               </span>
                <div class="_span_bx _padbx_123">
                <i class="fa fa-phone"></i> <?php echo $row->stud_phone; ?>
                </span>
             </div>
             <div class="_act_bx_visble _padbx_123"> 
             <?php
             if($row->card_active==1)
             {
                ?>
                  <a class="cust_href_link add_payment" data-val="<?php echo data_encode($row->student_unique_id, "encode"); ?>">Add  topup</a>  
                  <a class="cust_href_link transfer_payment" data-val="<?php echo data_encode($row->student_unique_id, "encode"); ?>">Transfer Request</a> 
                  <a class="cust_href_link card_blck_req" data-val="<?php echo data_encode($row->student_unique_id, "encode"); ?>">Card Block Request</a> 
                <a class="cust_href_link" href="<?php echo $base_url; ?>/payment_history?student_unique_id=<?php echo data_encode($row->student_unique_id, "encode"); ?>">Payment History</a>  
                <?php
             } 
              ?>
             </div>
          </div>   
          <?php
             if($row->card_active==1)
             {
                ?> 
             <div class="total_amountbx total_amnt<?php echo data_encode($row->student_unique_id, "encode"); ?>"> 
             <div class="_total_amount">
              <span class="total_lable">Total Amount</span> : 
              <span class="total_cmnt"><?= $row->amount; ?></span>
             </div> 
             </div>
             <?php
             }
             else
             {
                 ?>
                 <div>
                 <span class="card_block_cnt">Card is Blocked</span>
                 </div>
                 <?php
             }
             ?>
         
 </div>
 </div>
 <?php
$i++;
} 
}
else
{
?>
<div class="prod_assign_itm_bx">
<div class="empt-prod-lbl">
  No Data Found 
</div>
</div>
<?php
}
} 



