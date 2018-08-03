<?php
/*
Created by Bala murugan  M
Email: inventorbala@gmail.com
contact: 9524435595
Date : 28/04/2018 08:30: PM
*/
@session_start();
global $qisk_db, $base_url,$qisk_mail,$branch_data;

if (isset($_POST['action']))
	{  
 $action = sql_quote_string($_POST['action']);
	$date_format = new DateTime();
	$date = $date_format->format("Y-m-d h:i:s");

	switch($action)
    {
		case "stall_saveData":
		if($action=="stall_saveData")
		{

			$response = array(
				"current_status" => "error",
				"msg" => "some error occurred.Please try again later"
			);
			if(empty($_POST['branch_name']))
			{
				$response = array(
					"current_status" => "error",
					"msg" => "Please select the branch name"
				);
			}	
			elseif(empty($_POST['stall_name']))
			{
				$response = array(
					"current_status" => "error",
					"msg" => "Please  enter the stall name"
				);
			}
			elseif(empty($_POST['stall_code']))
			{
				$response = array(
					"current_status" => "error",
					"msg" => "Please  enter the stall code"
				);
			} 
			else
			{ 
				$branch_name=data_encode($_POST['branch_name'],"decode"); 
				$stall_name=sql_quote_string($_POST['stall_name']); 
				$stall_code=sql_quote_string($_POST['stall_code']); 
				$check_already_stall_name=$qisk_db->get_results("select * from stall_listData where stall_name='".sql_quote_string($stall_name)."' ");
				$check_already_stall_code=$qisk_db->get_results("select * from stall_listData where stall_code='".sql_quote_string($stall_code)."' ");
				if($check_already_stall_name!=NULL)
				{
					$response = array(
						"current_status" => "error",
						"msg" => "Already exists stall name"
					);
				}
				elseif($check_already_stall_code!=NULL)
				{
					$response = array(
						"current_status" => "error",
						"msg" => "Already exists stall code"
					);
				}
				else
				{
					if (isset($_POST['stall_uniqueid']))
					{
						$stall_uniqueid=data_encode($_POST['stall_uniqueid'],"decode");
					 $update=$qisk_db->query("update stall_listData set branch_uniqueid='".sql_quote_string($branch_name)."', stall_code='".sql_quote_string($stall_code) ."',stall_name='".sql_quote_string($stall_name)."' where stall_uniqueid='".sql_quote_string($stall_uniqueid)."' ");
						if($update)
						{
							$response = array(
								"current_status" => "success",
								"msg" => "Stall successfully updated",
								"url" => $base_url . "/stall-listing"
							);
						}
						else
						{
							$response = array(
								"current_status" => "error",
								"msg" => "some error occurred.Please try again later"
							);	
						}
					}
					else
					{
	
					
						
							$insert_data = $qisk_db->query("insert into stall_listData(branch_uniqueid,stall_name,stall_code)values('".$branch_name."','" . sql_quote_string($stall_name) . "','" . sql_quote_string($stall_code) . "')");
							if ($insert_data != "")
								{
								$lastinsertid = $insert_data;
								$stall_uniqueid = randomstring_num() . $lastinsertid;
								$update_uniqid = $qisk_db->query("update stall_listData set `stall_uniqueid`= '" . $stall_uniqueid . "' where stall_id='" . $lastinsertid . "' ");
								if ($update_uniqid) 
									{ 
										$response = array(
											"current_status" => "success",
											"msg" => "Stall successfully added",
											"url" => $base_url . "/stall-listing"
										);
									}
								}
						
					}
				}
				
			} 
			echo json_encode($response); 
		}
		break;
		case "terminal_saveData":
		if($action=="terminal_saveData")
		{
			$response = array(
				"current_status" => "error",
				"msg" => "some error occurred.Please try again later"
			);	
			if(empty($_POST['terminal_name']))
			{
				$response = array(
					"current_status" => "error",
					"msg" => "Please  enter the terminal name"
				);
			}
			elseif(empty($_POST['terminal_code']))
			{
				$response = array(
					"current_status" => "error",
					"msg" => "Please  enter the terminal code"
				);
			} 
			else
			{ 
				$terminal_code=sql_quote_string($_POST['terminal_code']); 
				$terminal_name=sql_quote_string($_POST['terminal_name']); 
				if (isset($_POST['data_uniqid']))
				{
					$data_uniqueid=data_encode($_POST['data_uniqid'],"decode");
				 $update=$qisk_db->query("update terminal_data set terminal_name='".sql_quote_string($terminal_name) ."',terminal_code='".sql_quote_string($terminal_code)."' where terminal_uniqueid='".sql_quote_string($data_uniqueid)."' ");
					if($update)
					{
						$response = array(
							"current_status" => "success",
							"msg" => "Terminal successfully updated",
							"url" => $base_url . "/terminal-listing"
						);
					}
					else
					{
						$response = array(
							"current_status" => "error",
							"msg" => "some error occurred.Please try again later"
						);	
					}
				}
				else
				{
					$check_machine_code=$qisk_db->get_results("select * from terminal_data  where terminal_code='".sql_quote_string($terminal_code)."' ");
					if($check_machine_code==NULL)
					{
						$insert_data = $qisk_db->query("insert into terminal_data(ref_branch_uniqueid,ref_user_uniqueid,terminal_name,terminal_code)values('" . sql_quote_string($branch_data->branch_uniqueid) . "','".$_SESSION['admin_unique_id']."','" . sql_quote_string($terminal_name) . "','" . sql_quote_string($terminal_code) . "')");
						if ($insert_data != "")
							{
							$lastinsertid = $insert_data;
							$terminal_uniqueid = randomstring_num() . $lastinsertid;
							$update_uniqid = $qisk_db->query("update terminal_data set `terminal_uniqueid`= '" . $terminal_uniqueid . "' where terminal_id='" . $lastinsertid . "' ");
							if ($update_uniqid) 
								{ 
									$response = array(
										"current_status" => "success",
										"msg" => "terminal successfully added",
										"url" => $base_url . "/terminal-listing"
									);
								}
							}
					}
					else
					{
						$response = array(
							"current_status" => "error",
							"msg" => "Already added machine code"  
							
						);
					}
					
					
				}
			} 
			echo json_encode($response); 
		}
		break;
		case "ads_saveData":
		if($action=="ads_saveData")
		{
			$response = array(
				"current_status" => "error",
				"msg" => "some error occurred.Please try again later"
			);	
			if(empty($_POST['title']))
			{
				$response = array(
					"current_status" => "error",
					"msg" => "Please  enter the title"
				);
			}
			elseif(empty($_POST['offer_date']))
			{
				$response = array(
					"current_status" => "error",
					"msg" => "Please  select the date"
				);
			} 
			else
			{
				$title=sql_quote_string($_POST['title']); 
				if (isset($_POST['data_uniqid']))
				{
					$ads_uniqueid=data_encode($_POST['data_uniqid'],"decode"); 
					$already_exists_data=$qisk_db->get_results("select * from ads_listData where  ads_uniqueid='".sql_quote_string($ads_uniqueid)."' ");
					if($already_exists_data!=NULL)
					{
						if (!empty($_FILES['image_url']['name']))
						{ 
							image_remove($already_exists_data[0]->image_url);
							$image_data = qisk_full_image_upload($_FILES['image_url'], "images/ads");
							$image_url=$image_data['image_url'];
							$image_data=$image_data['image_data'];
							$image_success = TRUE; 
						}
						else
						{
							if(!empty($already_exists_data[0]->image_url))
							{
								$image_url=$already_exists_data[0]->image_url;
								$image_data=$already_exists_data[0]->image_data;
								$image_success = TRUE;
							}
							else
							{
								$image_url=NULL;
								$image_data=NULL;
								$image_success = TRUE; 
							}
						} 
					 $update=$qisk_db->query("update ads_listData set image_url='".sql_quote_string($image_url)."' , image_data='".sql_quote_string($image_data)."' , title='".sql_quote_string($title) ."',desciption='".sql_quote_string($_POST['descr_data'])."',offer_date='".sql_quote_string($_POST['offer_date']) ."' where ads_uniqueid='".sql_quote_string($ads_uniqueid)."' ");
						if($update)
						{
							$response = array(
								"current_status" => "success",
								"msg" => "ads successfully updated",
								"url" => $base_url . "/ads-listing"
							);
						}
						else
						{
							$response = array(
								"current_status" => "error",
								"msg" => "some error occurred.Please try again later"
							);	
						}
					} 
				}
				else
				{
					if (!empty($_FILES['image_url']['name']))
						{
						$image_type = $_FILES['image_url']['type'];
						if (($image_type == "image/gif") || ($image_type == "image/jpeg") || ($image_type == "image/jpg") || ($image_type == "image/png"))
							{
							$image_data = qisk_full_image_upload($_FILES['image_url'], "images/ads");
							$image_url = $image_data['image_url'];
							$image_data = $image_data['image_data'];
							$image_success = TRUE;
							}
						  else
							{
							$response = array(
								"current_status" => "error",
								"msg" => "Please upload the image file."
							);
							$image_success = FALSE;
							}
						}
					  else
						{
						$image_url = NULL;
						$image_data = NULL;
						$image_success = TRUE;
						}
					 if($image_success)
					 {
					$insert_data = $qisk_db->query("insert into ads_listData(title,desciption,offer_date,image_url,image_data)values('" . sql_quote_string($title) . "','" . sql_quote_string($_POST['descr_data']) . "','" . sql_quote_string($_POST['offer_date']) . "','" . sql_quote_string($image_url) . "','" . sql_quote_string($image_data) . "')");
					if ($insert_data != "")
						{
						$lastinsertid = $insert_data;
						$ads_uniqueid = randomstring_num() . $lastinsertid;
						$update_uniqid = $qisk_db->query("update ads_listData set `ads_uniqueid`= '" . $ads_uniqueid . "' where ads_id='" . $lastinsertid . "' ");
						if ($update_uniqid) 
							{
							$response = array(
								"current_status" => "success",
								"msg" => "ads successfully added",
								"url" => $base_url . "/ads-listing"
							);
							}
						}
					}
					
				}
			} 
	      echo json_encode($response);
		}
		break;
		case "transfer_revie_confirm":
		if($action=="transfer_revie_confirm")
		{
			$refdataSet=json_decode(data_encode($_POST['refData'],"decode"));
			if($refdataSet!=NULL)
			{
				$amount=$refdataSet->amount;
			   $sender_uniqueid=$refdataSet->sender_uniqueid;
			   $sender_data= get_student_data($sender_uniqueid);
			   if($sender_data!=NULL)
			   {
				
				     $sender_amount=intval($sender_data->amount-$amount);
			   }

			  
			   $receicer_uniqueid=$refdataSet->receicer_uniqueid;
			   $receiver_data= get_student_data($receicer_uniqueid);
			   if($receiver_data!=NULL)
			   {
				  $receiver_amount=intval($receiver_data->amount+$amount);
			   } 

			 
			   $update=$qisk_db->query("update smart_student_data set amount='".$sender_amount."'  where student_unique_id='".sql_quote_string($sender_uniqueid)."' ");

			   $update=$qisk_db->query("update smart_student_data set amount='".$receiver_amount."'  where student_unique_id='".sql_quote_string($receicer_uniqueid)."' ");
			  
			   if($update)
			   {

			

				$qisk_db->query("insert into  payment_history(branch_unique_id,ref_student_uniqueid,payment,type,added_date)values('".sql_quote_string($sender_data->branch_unique_id)."','".sql_quote_string($sender_uniqueid)."','".$amount."' ,'transfer','".$date."') ");

				$qisk_db->query("insert into  payment_history(branch_unique_id,ref_student_uniqueid,payment,type,added_date)values('".sql_quote_string($receiver_data->branch_unique_id)."','".sql_quote_string($receicer_uniqueid)."','".$amount."' ,'debit','".$date."') ");

                $response = array(
					"current_status" => "success",
					"msg" => "Payment successfully transferd."
				);

			   }

			} 
			echo json_encode($response);
		}
		break;

	   case "transfer_stud_review":
	   if($action=="transfer_stud_review")
	   {
			
			$refdataSet=json_decode(data_encode($_POST['dataSet'],"decode"));
			if($refdataSet!=NULL)
			{
				
				?>
				 <div id="pop-innr-bx">
			<div id="ldr-fsn-mn2" style="display: none;">
			</div>
			<div id="popup-blk" class="actv">
				<div class="lwa">
					<div class="lwa-modal _blk_pop74">
						<div id="div-forms">
						<div>
							<span class="login_sty_css">
							<span class="mdi mdi-arrow-left _cls_p_icn8 _icn_bck3"></span>
					       Receiver Student Confirmation</span>
						</div>
						<div class="row sign-row Ppopbx_div">
							<div class="sign-title">
							</div>
							<form id="transfer_revie_FRMata" class="form_bx"> 
								<input type="hidden" name="refData" value="<?= $_POST['dataSet'];?>">
								<?php 
								 $receicer_uniqueid=sql_quote_string($refdataSet->receicer_uniqueid);
								 $get_student_data=$qisk_db->get_results("select * from smart_student_data where student_unique_id='".sql_quote_string($receicer_uniqueid)."' ");
								 if($get_student_data!=NULL)
								 {
									 $studentData=$get_student_data[0]; 
									 if(empty($studentData->image_data))
									 {
										 $image_urls=$image_url->get_url("userImage"); 
									 }
									 else
									 {
										 $image_urls=$studentData->image_data;
									 }
									 ?>
									
									 <div class="stud_bxData"> 
                                        <div class="_user_img_bx">
										  <div class="img_bx_dipy">
											<img src="<?php echo $image_urls; ?>" alt="img" class="user_img_src" style="<?= pic_size_css($image_url);?>"> 
										</div>
										</div>
										
										<div class="_user_det_bx">
											<div class="_name_bx _padbx_123"> 
											<?php echo ucwords($studentData->stud_name); ?> 
										   </div>
										
											<div class="_name_bx _padbx_123"> 
												<i class="fa fa-envelope-o"></i>
												<?php echo $studentData->stud_email; ?> 
										    </div>
                                     
											<div class="_name_bx _padbx_123"> 
												<i class="fa fa-phone"></i>
												<?php echo $studentData->stud_phone; ?> 
										   </div> 
										</div>
									 </div>
									 <?php
								 }
								?>
							</form>  
						</div> 
						<div class="_text_right"> 
							<button class="btn btn-success waves-effect waves-light transfer_paybtn">Confirm</button>
						</div>
						</div>
					</div>
				</div>
			</div>
			</div>
				<?php

			} 
	   }
	  break;
	  
		case "transfer_frmdata":
		if($action=="transfer_frmdata")
		{
			
			if(empty($_POST['rfid_number']))
			{ 
				$response = array(
					"current_status" => "error",
					"msg" => "Please enter the Student ID"
				);
			}
			elseif(empty($_POST['amount']))
			{
				$response = array(
					"current_status" => "error",
					"msg" => "Please enter the amount"
				);
			}
			elseif (!preg_match('/^[0-9]+(?:.[0-9]{0,2})?$/', $_POST['amount'])) 
			{
				$response = array(
					"current_status" => "error",
					"msg" => "Please enter the valid amount"
				);
			} 
			elseif($_POST['amount']<0)
			{
				$response = array(
					"current_status" => "error",
					"msg" => "Negative numbers not accepted.Please valid amount"
				);
			}
			else
			{

               $student_uniqueid=data_encode($_POST['student_uniqueid'],"decode");
				$get_student_data=$qisk_db->get_results("select * from smart_student_data where student_unique_id='".sql_quote_string($student_uniqueid)."' and card_active=1");
				if($get_student_data!=NULL)
				{
					$total_amount=$get_student_data[0]->amount;
					$amount=sql_quote_string($_POST['amount']);
					if($total_amount>$amount)
					{ 
						$card_id=sql_quote_string($_POST['rfid_number']);
						$check_receicer_data=$qisk_db->get_results("select * from smart_student_data where student_register_id='".sql_quote_string($card_id)."' and card_active=1");
						if($check_receicer_data!=NULL)
						{
							$transfer_dataset['sender_uniqueid']=$student_uniqueid;
							$transfer_dataset['amount']=$amount;
							$transfer_dataset['receicer_uniqueid']=$check_receicer_data[0]->student_unique_id;
							$transfer_data=data_encode(json_encode($transfer_dataset),"encode");
							$response = array(
								"current_status" => "success",
								"msg" => "success",
								"data"=>$transfer_data
							);
						}
						else
						{
							$response = array(
								"current_status" => "error",
								"msg" => "Receiver Student Card is Blocked."
							);
						} 
					}
					else
					{
						$response = array(
							"current_status" => "error",
							"msg" => "Sorry! Your Available Amount ".$total_amount
						);  
					}

				}
				else
				{
					$response = array(
						"current_status" => "error",
						"msg" => "Your Card is Blocked."
					);	
				}
			}
			echo json_encode($response);
		}
		case "transfer_payment_bx":
		if($action=="transfer_payment_bx")
		{
			?>
           <div id="pop-innr-bx">
			<div id="ldr-fsn-mn2" style="display: none;">
			</div>
			<div id="popup-blk" class="actv">
				<div class="lwa">
					<div class="lwa-modal _blk_pop74">
						<div id="div-forms">
						<div>
							<span class="login_sty_css">
							<span class="mdi mdi-arrow-left _cls_p_icn8 _icn_bck3"></span>
					      	Transfer Request</span>
						</div>
						<div class="row sign-row Ppopbx_div">
							<div class="sign-title">
							</div>
							<form id="transfer_frmdata" class="form_bx">
								<input type="hidden" name="student_uniqueid" value="<?= $_POST['data_val'];?>">  

								<div class="form-group">
									<label>Receiver Student Register ID</label>
									<input type="text" class="form-control" name="rfid_number">
								</div>

								<div class="form-group">
									<label>Amount</label>
									<input type="text" class="form-control" name="amount">
								</div>
							</form>
						</div>
						<div class="_text_right"> 
							<button class="btn btn-success waves-effect waves-light transfer_pay">Send Money</button>
						</div>
						</div> 
						</div>
					</div>
				</div>
			</div>
			</div>
			<?php 
		}
		break;
		case "card_block_data":
		if($action=="card_block_data")
		{
			$student_uniqueid=data_encode($_POST['student_uniqueid'],"decode");
			$get_student_data=$qisk_db->get_results("select * from smart_student_data where student_unique_id='".sql_quote_string($student_uniqueid)."' ");
			if($get_student_data!=NULL)
			{
				$row=$get_student_data[0];
				$update=$qisk_db->query("update smart_student_data set card_active=0  where student_unique_id='".sql_quote_string($student_uniqueid)."' ");
				if($update)
				{
					$response = array(
						"current_status" => "success",
						"msg" => "your card is successfully blocked",
						"student_uniqueid"=>$_POST['student_uniqueid'] 
					);
				}
				else
				{
					$response = array(
						"current_status" => "error",
						"msg" => "some error occurred.Please try again later"
					);	
				}
			}
			else 
			{
				$response = array(
					"current_status" => "error",
					"msg" => "some error occurred.Please try again later"
				);
			}
			echo json_encode($response); 
		}
		break;
		case "card_block_quest":
		if($action=="card_block_quest")
		{
			?>
               <div class="lwa">
            <div class="lwa-modal _blk_pop74">
                <div id="div-forms">
                  <div><span class="login_sty_css">
                      <span class="mdi mdi-arrow-left _cls_p_icn8 _icn_bck3">
                      </span>Are you sure you want to block this card ?</span>
                  </div>
                  <div class="_data_bx_pop">
                      <form id="_card_blk_FRm"> 
                        <input type="hidden" name="student_uniqueid" value="<?= $_POST['data_val'];?>">
                      </form>
                  </div>
                  <div class="pop_subm_bx">
                      <button class="act_btn _card_blk_btn">Approve</button>
                  </div>
                </div>
            </div>
        </div>
			<?php 
		}
		break;

        case "_log_out_func": 
	if ($action == "_log_out_func")
		{
		unset($_SESSION['admin_unique_id'], $_SESSION['login_type'], $_SESSION["admin_token"]);
		$response = array(
			"current_status" => "success",
			"msg" => "Logged out successfully",
			"url" => $base_url
		);
		echo json_encode($response);
		}
		break;
		case "remove_bx":
		if($action=="remove_bx")
		{
			?>
			  <div class="lwa">
            <div class="lwa-modal _blk_pop74">
                <div id="div-forms">
                  <div><span class="login_sty_css">
                      <span class="mdi mdi-arrow-left _cls_p_icn8 _icn_bck3">
                      </span>Are you sure you want to delete?</span>
                  </div>
                  <div class="_data_bx_pop">
                      <form id="remove_FRM321"> 
                        <input type="hidden" name="ref_data" value="<?= $_POST['data_val'];?>">
                      </form>
                  </div>
                  <div class="pop_subm_bx">
                      <button class="act_btn _2124_js_14">Delete</button>
                  </div>
                </div>
            </div>
        </div>

			<?php
		} 
		case "_login_func":
		if ($action == "_login_func")
		{
		
		 $type = data_encode($_POST['type'],"decode");
		if (trim($type) == trim("login"))
			{
			if (empty($_POST['_lg_user']))
				{
				$response = array(
					"current_status" => "error",
					"msg" => "Enter the username",
					"field_id" => "_lg_user"
				);
				}
			elseif (empty($_POST['_lg_pwd']))
				{
				$response = array(
					"current_status" => "error",
					"msg" => "Enter the password",
					"field_id" => "_lg_pwd"
				);
				}
			  else
				{
				$check_valid_user = $qisk_db->get_results("select * from " . USER_TBL_PREFIX . "_admin where (email_id='" . sql_quote_string($_POST['_lg_user']) . "' or username='" . sql_quote_string($_POST['_lg_user']) . "' or phone='" . sql_quote_string($_POST['_lg_user']) . "' )  and password='" . md5($_POST['_lg_pwd']) . "'  and user_role!='cashier'  ");
				if ($check_valid_user != NULL)
					{

				    	if ($check_valid_user[0]->active_status == 1)
						{
						$user_unique_code = $check_valid_user[0]->user_unique_id;
						$user_email_id = $check_valid_user[0]->email_id;
				
							$_SESSION['admin_unique_id'] = $user_unique_code;
							$_SESSION['login_type'] = $check_valid_user[0]->user_role;
							$_SESSION["admin_token"] = md5(uniqid(mt_rand() , true));
							$response = array(
								"current_status" => "success",
								"msg" => "Logged in successfully",
								"url" => $base_url
							);
							
						}
					  else
						{
						$response = array(
							"current_status" => "error_resp",
							"msg" => ucfirst("Sorry,you can't access this account. Please contact your administrator for request access")
						);
						}
					}
				  else
					{
					$response = array(
						"current_status" => "error_resp",
						"msg" => "Invalid username or password"
					);
					}
				}
			}

		if (trim($type) == trim("forget"))
			{
			if (empty($_POST['_lg_user']))
				{
				$response = array(
					"current_status" => "error",
					"msg" => "Please enter email address",
					"field_id" => "_lg_user"
				);
				}
			elseif (!is_validemail($_POST['_lg_user']))
				{
				$response = array(
					"current_status" => "error",
					"msg" => "Please enter valid email address",
					"field_id" => "_lg_user"
				);
				}
			  else
				{
				$check_valid_user = $qisk_db->get_results("select * from " . USER_TBL_PREFIX . "_admin where email_id='" . sql_quote_string($_POST['_lg_user']) . "' ");
				if ($check_valid_user != NULL)
					{
					$user_verify_code = rand(111111, 999999);
					$update_userData = $qisk_db->query("UPDATE " . USER_TBL_PREFIX . "_admin SET verification_code='" . sql_quote_string($user_verify_code) . "' where email_id='" . sql_quote_string($_POST['_lg_user']) . "' ");
					if ($update_userData != "")
						{
						$userData = $check_valid_user[0];
						$forget_name = sql_quote_string($_POST['_lg_user']);
						$username = $userData->firts_name . " " . $userData->last_name;
						$mail = "<div>Hi  " . $username . "</div>";
						$mail.= "<div>Greetings!</div>";
						$mail.= "<div>You are just a step away from accessing your Smart Card  account </div>";
						$mail.= "<div>We are sharing a verification code to access your account. The code is valid for 10 minutes and usable only once.</div>";
						$mail.= "<div>Once you have verified the code, you'll be prompted to set a new password immediately. This is to ensure that only you have access to your account.</div>";
						$mail.= "<div>Your OTP:<b>" . $user_verify_code . "</b></div>";
						$mail.= "<div>This verification code valid for 20 minutes</div>";
						$email_msg = email_template("Forget your password", $username, $mail);
						echo $send_mail = $qisk_mail->sent_qiskmail(array(
							$forget_name,
							$forget_name
						) , " Forget Password Verify code in Smart Card ", "", $email_msg, "Smart Card  Account Team");
					
								$response = array(
									"current_status" => "success",
									"msg" => "If there is an account associated with ". $userData->email_id." you will receive an email with a link to reset your password."
								);  
							$response = array(
								"current_status" => "success",
								"msg" => "verify code send in your email address",
								"url"=>$base_url."/login?login_type=password_reset"
							);
						}
					}
				  else
					{
					$response = array(
						"current_status" => "error",
						"msg" => "Your email address is not registered!.Please Contact Your Administrator"
					);
					}
				}
			}

		if (trim($type) == trim("password_reset"))
			{
				$opt_code=sql_quote_string($_POST['verify_code']);
				$new_pwd=sql_quote_string($_POST['new_pwd']);
				$confirm_pwd=sql_quote_string($_POST['confirm_pwd']);
				if (empty($opt_code))
				{
				$response = array(
					"current_status" => "error",
					"msg" => "Enter the OTP code",
					"field_id" => "_verify_code"
				);
				}
			elseif (empty($new_pwd))
				{
				$response = array(
					"current_status" => "error",
					"msg" => "Enter the password",
					"field_id" => "_new_pwd"
				);
				}
				elseif (empty($confirm_pwd))
				{
				$response = array(
					"current_status" => "error",
					"msg" => "Enter the confirm password",
					"field_id" => "confirm_pwd"
				);
				}
				elseif ($confirm_pwd!=$new_pwd)
				{
				$response = array(
					"current_status" => "error_resp",
					"msg" => "Password does not match the confirm password",
					"field_id" => "confirm_pwd"
				);
				}
				else
				{
					$check_valid_user = $qisk_db->get_results("select * from " . USER_TBL_PREFIX . "_admin where verification_code='" .$opt_code. "' ");
					if ($check_valid_user != NULL)
						{

							$current_password=md5($confirm_pwd);
							$update=$qisk_db->query("update " . USER_TBL_PREFIX . "_admin set password='".$current_password."' ,show_password='".$confirm_pwd."' where user_unique_id='".$check_valid_user[0]->user_unique_id."' ");
							if($update)
							{
									$email_address=$check_valid_user[0]->email_id;
									$username=$email_address=$check_valid_user[0]->firts_name." " .$check_valid_user[0]->last_name;
								    $mail = "<div>Hi  " . $username . "</div>";
									$mail.= "<div>Password Reset successfully in your account!</div>"; 
									$email_msg = email_template("Password Reset in Smart Card  Account", $username, $mail);
									$send_mail = $qisk_mail->sent_qiskmail(array(
										$email_address,
										$email_address
									) , " Password reset in Smart Card ", "", $email_msg, "Smart Card  Account Team");
									if ($send_mail)
										{
											$response = array(
												"current_status" => "success",
												"msg" => "Password Reset in successfully"
											); 
							        } 
								$_SESSION['admin_unique_id'] =$check_valid_user[0]->user_unique_id;
								$_SESSION['login_type'] = $check_valid_user[0]->user_role;
								$_SESSION["admin_token"] = md5(uniqid(mt_rand() , true));
								$response = array(
									"current_status" => "success",
									"msg" => "Password Reset in successfully",
									"url" => $base_url
								);

							}
						} 
						else
						{
							$response = array(
								"current_status" => "error_resp",
								"msg" => "invalid OTP code.Please check your OTP code",
								"field_id" => "_verify_code"
							);

						}
				} 
			} 
		echo json_encode($response);
		}

		break;
		case "user_save_func":
	/* User add and edit function */
	if ($action == "user_save_func")
		{
		$response = array(
			"current_status" => "error",
			"msg" => "some error occurred.Please try again later"
		);
		if (empty($_POST['user_position']))
			{
			$response = array(
				"current_status" => "error",
				"msg" => "Please enter employee role"
			);
			}
		elseif (empty($_POST['first_name']))
			{
			$response = array(
				"current_status" => "error",
				"msg" => "Please enter firts name"
			);
			}
	
		elseif (empty($_POST['email_id']))
			{
			$response = array(
				"current_status" => "error",
				"msg" => "Please enter email address"
			);
			}
		elseif (!is_validemail($_POST['email_id']))
			{
			$response = array(
				"current_status" => "error",
				"msg" => "Please enter valid email address"
			);
			}
		elseif (empty($_POST['username']))
			{
			$response = array(
				"current_status" => "error",
				"msg" => "Please enter the username"
			);
			}
		elseif (strlen($_POST['username']) < 4)
			{
			$response = array(
				"current_status" => "error",
				"msg" => "minimum 4 characters required"
			);
			}
		elseif (empty($_POST['phone_number']))
			{
			$response = array(
				"current_status" => "error",
				"msg" => "Please enter mobile number"
			);
			}
		elseif (!is_numeric($_POST['phone_number']))
			{
			$response = array(
				"current_status" => "error",
				"msg" => "Please enter valid mobile number"
			);
			}
		elseif (strlen($_POST['phone_number']) < 7 || strlen($_POST['phone_number']) > 11)
			{
			$response = array(
				"current_status" => "error",
				"msg" => "Invalid phone number. length must be 7 to 11 numbers"
			);
			}  
		  else
			{
				$user_position=data_encode($_POST['user_position'],"decode");
				$user_infoset['address1']=$_POST['address1'];
				$user_infoset['address2']=$_POST['address2'];
				$user_infoset['city']=$_POST['city'];
				$user_infoset['state']=$_POST['state'];
				$user_infoset['pincode']=$_POST['pincode'];
				$user_infoset['country']=data_encode($_POST['country'],"decode");
				$user_info=json_encode($user_infoset);
				
			if (isset($_POST['user_unique_id']))
				{
					$user_unique_id=data_encode($_POST['user_unique_id'],"decode");
					$get_userdata = $qisk_db->get_results("select * from " . USER_TBL_PREFIX . "_admin where user_unique_id='" . sql_quote_string($user_unique_id) . "' ");
					if($get_userdata!=NULL)
					{
						if (!empty($_FILES['image_url']['name']))
						{ 
							$image_data = qisk_full_image_upload($_FILES['image_url'], "images/user");
							$image_url=$image_data['image_url'];
							$image_data=$image_data['image_data'];
							$image_success = TRUE; 
						}
						else
						{
							if(!empty($get_userdata[0]->image_url))
							{
								$image_url=$get_userdata[0]->image_url;
								$image_data=$get_userdata[0]->image_data;
								$image_success = TRUE;
							}
							else
							{
								$image_url=NULL;
								$image_data=NULL;
								$image_success = TRUE; 
							}
						}
						 $setquery="update  " . USER_TBL_PREFIX . "_admin set  user_info='" . sql_quote_string($user_info) . "', user_position='" . sql_quote_string($user_position) . "',  first_name='" . sql_quote_string($_POST['first_name']) . "',last_name='" . sql_quote_string($_POST['last_name']) . "',  email_id='" . sql_quote_string($_POST['email_id']) . "',  phone='" . sql_quote_string($_POST['phone_number']) . "', username='" . sql_quote_string($_POST['username']) . "',image_url='" . sql_quote_string($image_url) . "',image_data='" . sql_quote_string($image_data) . "' where user_unique_id='".sql_quote_string($user_unique_id)."'  ";
						$ups_user_Data=$qisk_db->query( $setquery);
							if ($ups_user_Data)
								{  
									$response = array(
										"current_status" => "success",
										"msg" => "Employee Data updated successfully.","url"=>$base_url."/employee-listing"
									);
								}

					}
				}
			  else
				{
					if (empty($_POST['_new_pwd']))
					{
					$response = array(
						"current_status" => "error",
						"msg" => "Please enter password"
					);
					}
					elseif(empty($_POST['_oper_data']))
					{
						$response = array(
							"current_status" => "error",
							"msg" => "select the operation "
						);
					}
					else
					{ 
				$orginal_uniqusername = preg_replace("/[~!@#$%^&*\(\)_+\}\{:\"\|?\\';><`\-=\[\],.\/\s]/", "", $_POST['username']);
				$check_uniq_name_exist = $qisk_db->get_results("select * from " . USER_TBL_PREFIX . "_admin where username='" . sql_quote_string($_POST['username']) . "' ");
				$check_email_id_exist = $qisk_db->get_results("select * from " . USER_TBL_PREFIX . "_admin where email_id='" . sql_quote_string($_POST['email_id']) . "' ");
				$check_phone_number_exist = $qisk_db->get_results("select * from " . USER_TBL_PREFIX . "_admin where phone='" . sql_quote_string($_POST['phone_number']) . "' ");
				if ($check_uniq_name_exist != NULL)
					{
					$response = array(
						"current_status" => "error",
						"msg" => "This username not available. Try again with another username"
					);
					}
				elseif ($check_email_id_exist != NULL)
					{
					$response = array(
						"current_status" => "error",
						"msg" => "The email address you have entered is already registered"
					);
					}
				elseif ($check_phone_number_exist != NULL)
					{
					$response = array(
						"current_status" => "error",
						"msg" => "The Phone number you have entered is already registered"
					);
					}
				  else
					{
					if (!empty($_FILES['image_url']['name']))
						{
						$image_type = $_FILES['image_url']['type'];
						if (($image_type == "image/gif") || ($image_type == "image/jpeg") || ($image_type == "image/jpg") || ($image_type == "image/png"))
							{
							$image_data = qisk_full_image_upload($_FILES['image_url'], "images/user");
							$image_url = $image_data['image_url'];
							$image_data = $image_data['image_data'];
							$image_success = TRUE;
							}
						  else
							{
							$response = array(
								"current_status" => "error",
								"msg" => "Please upload the image file."
							);
							$image_success = FALSE;
							}
						}
					  else
						{
						$image_url = NULL;
						$image_data = NULL;
						$image_success = TRUE;
						}

					if ($image_success == TRUE)
						{
						$user_pwd_new = md5($_POST['_new_pwd']); 
						 $exc_query = "insert into " . USER_TBL_PREFIX . "_admin (ref_admin_uniqid,first_name,last_name,username,email_id,phone,password,show_password,image_url,image_data,date_of_add,user_role,user_info)values('" . sql_quote_string($_SESSION['admin_unique_id']) . "','" . sql_quote_string($_POST['first_name']) . "','" . sql_quote_string($_POST['last_name']) . "','" . sql_quote_string($orginal_uniqusername) . "','" . sql_quote_string($_POST['email_id']) . "','" . sql_quote_string($_POST['phone_number']) . "','" . sql_quote_string($user_pwd_new) . "', '" . sql_quote_string($_POST['_new_pwd']) . "','" . sql_quote_string($image_url) . "' ,'" . sql_quote_string($image_data) . "' ,'" . sql_quote_string($date) . "','employee','".$user_position."','".$user_info."') ";
						$ins_new_user = $qisk_db->query($exc_query);
						if ($ins_new_user != "")
							{
							$user_unique_id = create_user_unique_id($ins_new_user);
							$lastinsertid = $ins_new_user;
							$update_uniqid = $qisk_db->query("update  " . USER_TBL_PREFIX . "_admin set `user_unique_id`= '" . $user_unique_id . "' where id='" . $lastinsertid . "' ");
							if ($update_uniqid != "")
								{

									for ($i = 0; $i < count($_POST['_oper_data']); $i++)
									{
										 $data_uniqid = data_encode($_POST['_oper_data'][$i], "decode");
										 $ins_savedata = $qisk_db->query("insert into user_operation_data(ref_user_uniqid,ref_operation_id)VALUES('" . $user_unique_id . "','" . $data_uniqid . "')");
										 if ($ins_savedata)
										 {
											$ins_status[] = 1;
										 }
										  else
										 {
											$ins_status[] = 0;
										 }
								 } 
								} 
								if (in_array(1, $ins_status) !== 0)
								{
									$username= $_POST['first_name']." ".$_POST['last_name']; 
									$site_name = $base_url;
									$mail = "<div>Thank you for register as a user in Smart Card  </div>"; 
									$mail.= "<div>UserID :<b>" . $_POST['email_id'] . "</b><div>";
									$mail.= "<div>Password :<b>" .$_POST['_new_pwd']. "</b><div>";
									$email_msg = email_template("Smart Card App", $username, $mail);
									$send_login_mail = $qisk_mail->sent_qiskmail(array(
									$_POST['email_id'],
									$_POST['email_id']
									) , "Smart Card  User Account created", "", $email_msg, "Smart Card  Account Team");

									$response = array(
										"current_status" => "success",
										"msg" => "employee Data added successfully.",
										"url" => $base_url . "/Employee-listing"
									);

								}
							}
						}
					  }
					}
				}
			}

		echo json_encode($response);
		} 
		break;
		case "admin_adfunc":
	/* User add and edit function */
	if ($action == "admin_adfunc")
		{ 
			$response = array(
				"current_status" => "error",
				"msg" => "some error occurred.Please try again later"
			);
			if (empty($_POST['branch_name']))
			{
			$response = array(
				"current_status" => "error",
				"msg" => "Please select the branch name"
			);
			}
			elseif (empty($_POST['stall_name']))
			{
			$response = array(
				"current_status" => "error",
				"msg" => "Please select the stall name"
			);
			} 
			else if (empty($_POST['user_role']))
			{
			$response = array(
				"current_status" => "error",
				"msg" => "Please select the user role"
			);
			}
			else if (empty($_POST['first_name']))
			{
			$response = array(
				"current_status" => "error",
				"msg" => "Please enter the first name"
			);
			}
			elseif (!preg_match("/^[a-zA-Z'-]+$/", $_POST['first_name']))
			{
			$response = array(
				"current_status" => "error",
				"msg" => "Please enter the valid first name"
			);
			}  
		elseif (empty($_POST['username']))
			{
			$response = array(
				"current_status" => "error",
				"msg" => "Please enter the username"
			);
			}
		elseif (strlen($_POST['username']) < 4)
			{
			$response = array(
				"current_status" => "error",
				"msg" => "minimum 4 characters required"
			);
			} 
		  else
			{
				        $user_infoset['address1']=$_POST['address1'];
						$user_infoset['address2']=$_POST['address2'];
						$user_infoset['city']=$_POST['city'];
						$user_infoset['state']=$_POST['state'];
						$user_infoset['pincode']=$_POST['pincode'];
						$user_infoset['country']=data_encode($_POST['country'],"decode");
						$user_info=json_encode($user_infoset); 
						$user_role=data_encode($_POST['user_role'],"decode");  
						$branch_name=data_encode($_POST['branch_name'],"decode");  
						$stall_name=data_encode($_POST['stall_name'],"decode"); 
			if (isset($_POST['user_unique_id']))
				{
					$user_unique_id=data_encode($_POST['user_unique_id'],"decode");
					$get_userdata = $qisk_db->get_results("select * from " . USER_TBL_PREFIX . "_admin where user_unique_id='" . sql_quote_string($user_unique_id) . "' ");
					if($get_userdata!=NULL)
					{
						if (!empty($_FILES['image_url']['name']))
						{ 
							$image_data = qisk_full_image_upload($_FILES['image_url'], "images/user");
							$image_url=$image_data['image_url'];
							$image_data=$image_data['image_data'];
							$image_success = TRUE; 
						}
						else
						{
							if(!empty($get_userdata[0]->image_url))
							{
								$image_url=$get_userdata[0]->image_url;
								$image_data=$get_userdata[0]->image_data;
								$image_success = TRUE;
							}
							else
							{
								$image_url=NULL;
								$image_data=NULL;
								$image_success = TRUE; 
							}
						}
						 $setquery="update  " . USER_TBL_PREFIX . "_admin set  ref_branch_uniqueid='" . sql_quote_string($branch_name) . "',ref_stall_uniqueid='" . sql_quote_string($stall_name) . "',  user_role='" . sql_quote_string($user_role) . "',  phone='" . sql_quote_string($_POST['phone_number']) . "',  first_name='" . sql_quote_string($_POST['first_name']) . "',last_name='" . sql_quote_string($_POST['last_name']) . "',  email_id='" . sql_quote_string($_POST['email_id']) . "',  phone='" . sql_quote_string($_POST['phone_number']) . "', username='" . sql_quote_string($_POST['username']) . "',image_url='" . sql_quote_string($image_url) . "',image_data='" . sql_quote_string($image_data) . "',user_info='" . sql_quote_string($user_info) . "' where user_unique_id='".sql_quote_string($user_unique_id)."'  ";
						$ups_user_Data=$qisk_db->query( $setquery);
							if ($ups_user_Data)
								{ 
									if(isset($_POST['type']))
									{
										$response = array(
											"current_status" => "success",
											"msg" => " Profile updated successfully.","url"=>$base_url."/profile"
										); 
									}
									else
									{
										$response = array(
											"current_status" => "success",
											"msg" => " user Data updated successfully.","url"=>$base_url."/user-listing"
										); 
									}
									
								} 
					}
				}
			  else
				{
					if (empty($_POST['_new_pwd']))
					{
					$response = array(
						"current_status" => "error",
						"msg" => "Please enter password"
					);
					}
					else
					{ 
						$user_pwd_new = md5($_POST['_new_pwd']);
				$orginal_uniqusername = preg_replace("/[~!@#$%^&*\(\)_+\}\{:\"\|?\\';><`\-=\[\],.\/\s]/", "", $_POST['username']);
				$check_uniq_name_exist = $qisk_db->get_results("select * from " . USER_TBL_PREFIX . "_admin where username='" . sql_quote_string($_POST['username']) . "' ");
			
				if ($check_uniq_name_exist != NULL)
					{
					$response = array(
						"current_status" => "error",
						"msg" => "This username not available. Try again with another username"
					);
					} 
				  else
					{
					if (!empty($_FILES['image_url']['name']))
						{
						$image_type = $_FILES['image_url']['type'];
						if (($image_type == "image/gif") || ($image_type == "image/jpeg") || ($image_type == "image/jpg") || ($image_type == "image/png"))
							{
							$image_data = qisk_full_image_upload($_FILES['image_url'], "images/user");
							$image_url = $image_data['image_url'];
							$image_data = $image_data['image_data'];
							$image_success = TRUE;
							}
						  else
							{
							$response = array(
								"current_status" => "error",
								"msg" => "Please upload the image file."
							);
							$image_success = FALSE;
							}
						}
					  else
						{
						$image_url = NULL;
						$image_data = NULL;
						$image_success = TRUE;
						}

					if ($image_success == TRUE)
						{ 
						 $exc_query = "insert into " . USER_TBL_PREFIX . "_admin (ref_admin_uniqid,ref_branch_uniqueid,ref_stall_uniqueid,first_name,last_name,username,email_id,phone,password,show_password,image_url,image_data,date_of_add,user_role,user_info)values('" . sql_quote_string($_SESSION['admin_unique_id']) . "','" . sql_quote_string($branch_name) . "','" . sql_quote_string($stall_name) . "','" . sql_quote_string($_POST['first_name']) . "','" . sql_quote_string($_POST['last_name']) . "','" . sql_quote_string($orginal_uniqusername) . "','" . sql_quote_string($_POST['email_id']) . "','" . sql_quote_string($_POST['phone_number']) . "','" . sql_quote_string($user_pwd_new) . "', '" . sql_quote_string($_POST['_new_pwd']) . "','" . sql_quote_string($image_url) . "' ,'" . sql_quote_string($image_data) . "' ,'" . sql_quote_string($date) . "','".sql_quote_string($user_role)."','".$user_info."' ) ";
						$ins_new_user = $qisk_db->query($exc_query);
						if ($ins_new_user != "")
							{
							$user_unique_id = create_user_unique_id($ins_new_user,"smart_card_tm_");
							$lastinsertid = $ins_new_user;
							$update_uniqid = $qisk_db->query("update  " . USER_TBL_PREFIX . "_admin set `user_unique_id`= '" . $user_unique_id . "' where id='" . $lastinsertid . "' ");
							if ($update_uniqid != "")
								{
									$response = array(
										"current_status" => "success",
										"msg" => " User added successfully.",
										"url" => $base_url . "/user-listing"
									);  
								}
							}
						}
					  }
					}
				}
			}

		echo json_encode($response);
		} 

      	break;
		case "user_list-filter":
	if ($action == "user_list-filter")
		{
		
		/* filter user listing */ 
		$search_keyword = "";
		$search_query = "";
		$search_query_wrd = NULL;
		$search_join = "";
		$sorting = "";
		$search_filter = NULL;
		$search_terms = NULL;
		$get_user_list = NULL;
		$empl_type="";$type_where="";
		$where_join="";
		if (isset($_POST['search_term']))
			{
			if ($_POST['search_term'] != "")
				{
				if (strlen($_POST['search_term']) >= 0)
					{
					$search_keyword = sql_quote_string($_POST['search_term']);
					$search_word_array = preg_split("/[\s,]+/", $search_keyword);
					if ($search_word_array != NULL)
						{
						foreach($search_word_array as $srch_words)
							{
							if (strlen($srch_words) >= 3)
								{
								$search_query_wrd[] = $srch_words;
								}
							}
						}
	
					if ($search_query_wrd != NULL)
						{
						$search_keyword = implode("|", $search_query_wrd);
						}
					}
				}
			} 
		$data_limit=10;
		if(isset($_POST['limit']))
		{
			$limit=" LIMIT ".$_POST['limit'].",".$data_limit;
			$limitData=$_POST['limit'];
		}
		  else
		{
		  $limit=" LIMIT ".$data_limit; 
		   $limitData=0; 
		}

		if(!empty($_POST['branch_data']))
		{
			$ref_branch_uniqueid=data_encode($_POST['branch_data'],"decode");
			$where_join.="and smart_admin.ref_branch_uniqueid='".sql_quote_string($ref_branch_uniqueid)."' ";
		} 

		if(!empty($_POST['sortby']))
		{
			$sortby=data_encode($_POST['sortby'],"decode"); 
		}  

		if(!empty($_POST['stall_data']))
		{
			$ref_stall_uniqueid=data_encode($_POST['stall_data'],"decode");
			$where_join.="and smart_admin.ref_stall_uniqueid='".sql_quote_string($ref_stall_uniqueid)."' ";
		}

		if ($search_keyword != "")
		{ 
		  $search_query.= "and ( " . USER_TBL_PREFIX . "_admin.first_name REGEXP '^" . $search_keyword . "' || " . USER_TBL_PREFIX . "_admin.last_name REGEXP '^" . $search_keyword . "' || " . USER_TBL_PREFIX . "_admin.username REGEXP '^" . $search_keyword . "' || " . USER_TBL_PREFIX . "_admin.email_id REGEXP '^" . 
		  $search_keyword . "' || " . USER_TBL_PREFIX . "_admin.phone REGEXP '^" . 
		  $search_keyword . "')  "; 
		}
	  $total_user_count=$qisk_db->get_results("select  count(user_unique_id) as count_uniqid from " . USER_TBL_PREFIX . "_admin " . $search_join . " where  " . USER_TBL_PREFIX . "_admin.user_role!='super_admin' ".$where_join." " . $search_query . " " . $search_terms . "   ");
	
	  $set_query="select " . USER_TBL_PREFIX . "_admin.*  from " . USER_TBL_PREFIX . "_admin
	" . $search_join . " where  " . USER_TBL_PREFIX . "_admin.user_role!='super_admin' ".$where_join."  " . $search_query . " " . $search_terms . " group by  " . USER_TBL_PREFIX . "_admin.id   ORDER BY smart_admin.id ".$sortby." " . $limit . " ";
		$get_resultdata=$qisk_db->get_results($set_query); 
		 _disp_userbx_data($get_resultdata); 
		  $total_user_count=intval($total_user_count[0]->count_uniqid);
		  if($total_user_count>0)
		  {   
			  $new_curr_count=count($get_resultdata)+intval($limitData);
				 if($get_resultdata!=NULL)
				  {
		      ?>
				<script>
				_loaduser_list.data={};
					_loaduser_list.data.total_count=<?php echo $total_user_count; ?>;
					_loaduser_list.data.curr_count=<?php echo $new_curr_count; ?>;
				</script>
			  <?php
			 }
			}
			else
			{ 
				  ?>
					<script>
					_loaduser_list.data={};
					_loaduser_list.data.total_count=0;
					_loaduser_list.data.curr_count=0;
					</script>
				<?php
			} 
		} 
		break;
		case "status_change_func":
		if ($action == "status_change_func")
			{
			$response = array(
				"current_status" => "error",
				"msg" => ucwords("some errors occurred!.please try again later")
			);
			if ($_POST['data_val'] != "")
				{
				$user_unique_id = data_encode($_POST['data_val'], "decode");
				$user_data = get_user_data($user_unique_id);
				if ($user_data->active_status == 1)
					{
					$update_data = $qisk_db->query("update " . USER_TBL_PREFIX . "_admin set active_status='0' where user_unique_id='" . sql_quote_string($user_data->user_unique_id) . "' ");
					$status = 1;
					}
				  else
					{
					$update_data = $qisk_db->query("update " . USER_TBL_PREFIX . "_admin set active_status='1' where user_unique_id='" . sql_quote_string($user_data->user_unique_id) . "' ");
					$status = 0;
					}
	
				if ($status == 1)
					{
					$response = array(
						"current_status" => "deactive",
						"msg" => ucwords("Deactivated successfully")
					);
					}
				  else
					{
					$response = array(
						"current_status" => "active",
						"msg" => ucwords("activated successfully")
					);
					}
				}
	
			echo json_encode($response);
			} 
		break; 
		 
        case "master_add_data":
		if ($action == "master_add_data")
			{
				$response = array(
					"current_status" => "error",
					"msg" => "some error occurred.Please try again later"
				);
				$type=data_encode($_POST['type'],"decode");
				if (empty($_POST['name_data']))
					{
					$response = array(
						"current_status" => "error",
						"msg" => "Please enter the ".$type." field"
					);
					}
				  else
					{
					if (isset($_POST['data_uniqid']))
						{
						$data_uniqueid = data_encode($_POST['data_uniqid'], "decode");
						$exc_query = "update master_data  set name='" . sql_quote_string($_POST['name_data']) . "' where data_uniqueid='" . sql_quote_string($data_uniqueid) . "' ";
						$ins_new_user = $qisk_db->query($exc_query);
						if ($ins_new_user)
							{
							$response = array(
								"current_status" => "success",
								"msg" => " ".ucwords($type)." Data updated successfully.",
								"url" => $base_url . "/master/$type"
							);
							}
						}
					  else
						{
						$name_data = strtolower($_POST['name_data']);
						$check_data = $qisk_db->get_results("select * from  master_data where LOWER(name)='" . sql_quote_string($name_data) . "' and type='" . sql_quote_string($type) . "'");
						if ($check_data == NULL)
							{ 	

							$insert_data = $qisk_db->query("insert into master_data(name,type)values('" . sql_quote_string($name_data) . "','" . sql_quote_string($type) . "')");
							if ($insert_data != "")
								{
								$lastinsertid = $insert_data;
								$data_uniqueid = randomstring_num() . $lastinsertid;
								$update_uniqid = $qisk_db->query("update master_data set `data_uniqueid`= '" . $data_uniqueid . "' where id='" . $lastinsertid . "' ");
								if ($update_uniqid) 
									{
									$response = array(
										"current_status" => "success",
										"msg" => "".ucwords($type)." successfully added",
										"url" => $base_url . "/master/$type"
									);
									}
								}
							}
						  else
							{
							$response = array(
								"current_status" => "error",
								"msg" => " ".$type." already taken"
							);
							} 
						}
					}
				echo json_encode($response);
			} 


			break;  
			case "remove_data":
			if ($action == "remove_data")
			{
                $delete_status = FALSE;
				$response = array(
					"current_status" => "error",
					"msg" => "Some errors occurred.Please try again later"
				);
				$ref_data = json_decode(data_encode($_POST['ref_data'], "decode")); 
				if ($ref_data != NULL)
					{
						 $type_data = $ref_data[0];
					     $data_unique_id = $ref_data[1]; 

						if(trim($type_data)==trim("user"))
						{ 
							
							 $delete_data=$qisk_db->query("delete from smart_admin where user_unique_id='".sql_quote_string($data_unique_id)."' ");
							   if($delete_data)
							   {
								   $delete_status=TRUE;
							   }
						   
						}
						
						if ($type_data == "stall")
						{
						$delete_data = $qisk_db->query("delete from stall_listData  where stall_uniqueid='" . sql_quote_string($data_unique_id) . "' ");
						if ($delete_data)
							{
							$delete_status = TRUE;
							}
						else
							{
							$delete_status = FALSE;
							}
						} 
						if ($type_data == "master")
						{
						$delete_data = $qisk_db->query("delete from master_data  where data_uniqueid='" . sql_quote_string($data_unique_id) . "' ");
						if ($delete_data)
							{
							$delete_status = TRUE;
							}
						else
							{
							$delete_status = FALSE;
							}
						} 

						if ($type_data == "ads")
						{
						$delete_data = $qisk_db->query("delete from ads_listData  where ads_uniqueid='" . sql_quote_string($data_unique_id) . "' ");
						if ($delete_data)
							{
							$delete_status = TRUE;
							}
						else
							{
							$delete_status = FALSE;
							}
						} 

						if ($type_data == "terminal")
						{
						$delete_data = $qisk_db->query("delete from terminal_data  where terminal_uniqueid='" . sql_quote_string($data_unique_id) . "' ");
						if ($delete_data)
							{
							$delete_status = TRUE;
							}
						else
							{
							$delete_status = FALSE;
							}
						} 

						

						if ($type_data == "branch")
						{
						
						$delete_data = $qisk_db->query("delete from branch_listData  where branch_uniqueid='" . sql_quote_string($data_unique_id) . "' ");
						if ($delete_data)
							{
							$delete_status = TRUE;
							}
						else
							{
							$delete_status = FALSE;
							}
						} 

						if ($type_data == "prod_category")
						{
						
						$delete_data = $qisk_db->query("delete from prod_category  where category_uniqid='" . sql_quote_string($data_unique_id) . "' ");
						if ($delete_data)
							{
							$delete_status = TRUE;
							}
						else
							{
							$delete_status = FALSE;
							}
						}  

						if ($type_data == "product")
						{
						
						$delete_data = $qisk_db->query("delete from product_data  where product_uniqueid='" . sql_quote_string($data_unique_id) . "' ");
						if ($delete_data)
							{
							$delete_status = TRUE;
							}
						else
							{
							$delete_status = FALSE;
							}
						}  

						if ($type_data == "student")
						{
						
						$delete_data = $qisk_db->query("delete from smart_student_data  where student_unique_id='" . sql_quote_string($data_unique_id) . "' ");
						if ($delete_data)
							{
							$delete_status = TRUE;
							}
						else
							{
							$delete_status = FALSE;
							}
						}  

						
						if ($delete_status)
						{
						$response = array(
							"current_status" => "success",
							"msg" => "Successfully deleted"
						);
						} 
				} 
				echo json_encode($response);
			}

			break;  
			case "branchr_add_data":
			if ($action == "branchr_add_data")
			{
					$response = array(
						"current_status" => "error",
						"msg" => "some error occurred.Please try again later"
					);
			   if (empty($_POST['branch_name']))
				{
				$response = array(
					"current_status" => "error",
					"msg" => "Please enter branch name"
				);
				} 
				elseif (empty($_POST['branch_code']))
				{
				$response = array(
					"current_status" => "error",
					"msg" => "Please enter branch code"
				);
				} 
				 
			  else
				{ 	
					
					$check_already_branch_name=$qisk_db->get_results("select * from branch_listData where branch_name='".sql_quote_string($_POST['branch_name'])."' ");
					$check_already_branch_code=$qisk_db->get_results("select * from branch_listData where branch_code='".sql_quote_string($_POST['branch_code'])."' ");
					if($check_already_branch_name!=NULL)
					{
						$response = array(
							"current_status" => "error",
							"msg" => "Already exists Branch name", 
						);
					}
					elseif($check_already_branch_code!=NULL)
					{
						$response = array(
							"current_status" => "error",
							"msg" => "Already exists Branch code", 
						);
					}
					else
					{
						if (isset($_POST['branch_uniqueid']))
						{
							$branch_uniqueid =data_encode($_POST['branch_uniqueid'],"decode");
							$get_branch_data = $qisk_db->get_results("select * from branch_listData where branch_uniqueid='" . sql_quote_string($branch_uniqueid) . "' ");
							if($get_branch_data!=NULL)
							{ 
								 $setquery="update  branch_listData set  branch_code='" . sql_quote_string($_POST['branch_code']) . "',  branch_name='" . sql_quote_string($_POST['branch_name']) . "' where branch_uniqueid='".sql_quote_string($branch_uniqueid)."'  ";
								$ups_user_Data=$qisk_db->query( $setquery);
									if ($ups_user_Data)
										{ 
											$response = array(
												"current_status" => "success",
												"msg" => " Branch Data updated successfully.","url"=>$base_url."/branch-listing"
											); 
										} 
							}
						}
					  else 
						{
						
	
								$exc_query = "insert into branch_listData (branch_code,branch_name,date_of_add)values('" . sql_quote_string($_POST['branch_code']) . "','" . sql_quote_string($_POST['branch_name']) . "','" . sql_quote_string($date) . "') ";
								$ins_new_user = $qisk_db->query($exc_query);
								if ($ins_new_user != "")
									{
										$lastinsertid = $ins_new_user;
									$branch_uniqueid = randomstring_num() . $lastinsertid; 
									$update_uniqid = $qisk_db->query("update  branch_listData set `branch_uniqueid`= '" . $branch_uniqueid . "' where branch_id='" . $lastinsertid . "' ");
									if ($update_uniqid != "")
										{  
												$response = array(
													"current_status" => "success",
													"msg" => " Branch added successfully.",
													"url" => $base_url . "/branch-listing"
												); 
										}
									} 
						} 
					} 
				} 
			echo json_encode($response);
			} 
			break;  
            case "user_pwd_pop":
			if($action=="user_pwd_pop")
			{
				userPasswordSetting_funct();  
			}
			break;  
            case "profile_databx":
			if($action=="profile_databx")
			{
			   init_profileBx($_POST['data_val']);
			}
			break;  
            case "password_reset_fun":
			 if($action=="password_reset_fun")
			 {
						   if (empty($_POST['old_pwd']))
						   {
						   $response = array(
							   "current_status" => "error",
							   "msg" => "Please enter old password"
						   );
						   } 
						   elseif (empty($_POST['new_pwd']))
						   {
						   $response = array(
							   "current_status" => "error",
							   "msg" => "Please enter new password"
						   );
						   } 
					   elseif (empty($_POST['confirm_pwd']))
						   {
						   $response = array(
							   "current_status" => "error",
							   "msg" => "Please enter confirm password"
						   );
						   }
						   elseif($_POST['confirm_pwd']!=$_POST['new_pwd'])
						   {
							   $response = array(
								   "current_status" => "error",
								   "msg" => "Password does not match the confirm password"
							   );
						   }
						   else
						   {
   
					   
							   $userData=get_user_data($_SESSION['admin_unique_id']); 
							   if($userData!=NULL)
							   {
								   $show_password=sql_quote_string($_POST['confirm_pwd']);
								   $set_password=md5($_POST['confirm_pwd']);
								   $reset_pwd=$qisk_db->query("update smart_admin set password='".sql_quote_string($set_password)."',show_password ='".sql_quote_string($show_password)."' where user_unique_id='".sql_quote_string($_SESSION['admin_unique_id'])."'  ");
								   if($reset_pwd) 
								   {
									   $username= $userData->first_name." ".$userData->last_name;
										   $username = NULL;
										   $site_name = $base_url;
									      $mail = "<div> Reset Your Smart Card  Account Password <a href='".$site_name."' >Click</a></div>";
										   $mail.= "<div>UserID :<b>" . $userData->email_id . "</b><div>";
										   $mail.= "<div>Password :<b>" .$show_password. "</b><div>";
										   $email_msg = email_template("Password Reset", $username, $mail);
										   $send_login_mail = $qisk_mail->sent_qiskmail(array(
											   $userData->email_id,
											   $userData->email_id
										   ) , "Password Reset with Smart Card App", "", $email_msg, "Smart Card  Account Team");
										   $response = array(
											   "current_status" => "success",
											   "msg" => "Password Reset Successfully."
										   );
									   }
								   
							   } 
							   else
							   {
								   $response = array(
									   "current_status" => "error",
									   "msg" => "Invalid User Data"
								   );
							   }
						   }
	  echo json_encode($response);
			 }

			 break; 
		case "student_ID_generate":  
		if($action=="student_ID_generate") 
		{ 
			$branch_uniqueid=data_encode($_POST['data_val'],"decode");
			$get_branch_data=$qisk_db->get_results("select * from branch_listData where branch_uniqueid='".sql_quote_string($branch_uniqueid)."' ");
			if($get_branch_data!=NULL)
			{
			    $stud_id=$get_branch_data[0]->branch_code."-".mt_rand();
				$response = array(
					"current_status" => "success",
				    "stud_id"=>$stud_id
				);
			}
			else
			{
				$response = array(
					"current_status" => "error",
					"msg" => "some error occurred.Please try again later"
				);
			}

			echo json_encode($response);
		}
		break;
		case "stud_add_func":
		if($action=="stud_add_func")
		{
		
			$response = array(
				"current_status" => "error",
				"msg" => "some error occurred.Please try again later"
			);
			if (empty($_POST['branch_name']))
			{
				$response = array(
					"current_status" => "error",
					"msg" => "Please select the branch name"
				);
			} 
			elseif (empty($_POST['class_name']))
			{
				$response = array(
					"current_status" => "error",
					"msg" => "Please select the class name"
				);
			}
			elseif (empty($_POST['section_name']))
			{
				$response = array(
					"current_status" => "error",
					"msg" => "Please select the section name"
				);
			} 
			elseif (empty($_POST['stud_name']))
			{
				$response = array(
					"current_status" => "error",
					"msg" => "Please enter the student name"
				);
			}
			elseif (empty($_POST['stud_id']))
			{
				$response = array(
					"current_status" => "error",
					"msg" => "Please enter the student ID"
				);
			} 
		// 	elseif (empty($_POST['credit_limit']))
		// 	{
		// 		$response = array(
		// 			"current_status" => "error",
		// 			"msg" => "Please enter the student credit limit"
		// 		);
		// 	}
			
	    // 	elseif (empty($_POST['stud_emailid']))
		// 	{
		// 		$response = array(
		// 			"current_status" => "error",
		// 			"msg" => "Please enter student email address"
		// 		);
		// 	}
		//    elseif (!is_validemail($_POST['stud_emailid']))
		// 	{
		// 		$response = array(
		// 			"current_status" => "error",
		// 			"msg" => "Please enter student valid email address"
		// 		);
		// 	} 
	    // 	elseif (empty($_POST['stud_phone']))
		// 	{
		// 		$response = array(
		// 			"current_status" => "error",
		// 			"msg" => "Please enter student mobile number"
		// 		);
		// 	}
		//    elseif (!is_numeric($_POST['stud_phone']))
		// 	{
		// 		$response = array(
		// 			"current_status" => "error",
		// 			"msg" => "Please enter student valid mobile number"
		// 		);
		// 	}
		//    elseif (strlen($_POST['stud_phone']) < 7 || strlen($_POST['stud_phone']) > 11)
		// 	{
		// 		$response = array(
		// 			"current_status" => "error",
		// 			"msg" => "Invalid student phone number. length must be 7 to 11 numbers"
		// 		);
		// 	} 
		// 	elseif (empty($_POST['stud_date_birth']))
		// 	{
		// 		$response = array(
		// 			"current_status" => "error",
		// 			"msg" => "Please enter student date of birth"
		// 		);
		// 	}
		// 	elseif (empty($_POST['stud_sex']))
		// 	{
		// 		$response = array(
		// 			"current_status" => "error",
		// 			"msg" => "Please enter student sex"
		// 		);
		// 	}
		// 	elseif (empty($_POST['father_name']))
		// 	{
		// 		$response = array(
		// 			"current_status" => "error",
		// 			"msg" => "Please enter parent name"
		// 		);
		// 	}

		// 	elseif (empty($_POST['father_name']))
		// 	{
		// 		$response = array(
		// 			"current_status" => "error",
		// 			"msg" => "Please enter parent name"
		// 		);
		// 	}
		// 	elseif (empty($_POST['parent_emailid']))
		// 	{
		// 		$response = array(
		// 			"current_status" => "error",
		// 			"msg" => "Please enter parent email address"
		// 		);
		// 	}
		//    elseif (!is_validemail($_POST['parent_emailid']))
		// 	{
		// 		$response = array(
		// 			"current_status" => "error",
		// 			"msg" => "Please enter parent valid email address"
		// 		);
		// 	} 
	    // 	elseif (empty($_POST['parent_phone']))
		// 	{
		// 		$response = array(
		// 			"current_status" => "error",
		// 			"msg" => "Please enter parent mobile number"
		// 		);
		// 	}
		//    elseif (!is_numeric($_POST['parent_phone']))
		// 	{
		// 		$response = array(
		// 			"current_status" => "error",
		// 			"msg" => "Please enter the parent valid mobile number"
		// 		);
		// 	}
		//    elseif (strlen($_POST['parent_phone']) < 7 || strlen($_POST['parent_phone']) > 11)
		// 	{
		// 		$response = array(
		// 			"current_status" => "error",
		// 			"msg" => "Invalid parent phone number. length must be 7 to 11 numbers"
		// 		);
		// 	}  
		// 	elseif (empty($_POST['address1']))
		// 	{
		// 		$response = array(
		// 			"current_status" => "error",
		// 			"msg" => "Please enter the address"
		// 		);
		// 	}
		// 	elseif (empty($_POST['city']))
		// 	{
		// 		$response = array(
		// 			"current_status" => "error",
		// 			"msg" => "Please enter city"
		// 		);
		// 	}
		// 	elseif (empty($_POST['state']))
		// 	{
		// 		$response = array(
		// 			"current_status" => "error",
		// 			"msg" => "Please enter the state"
		// 		);
		// 	}
		// 	elseif (empty($_POST['pincode']))
		// 	{
		// 		$response = array(
		// 			"current_status" => "error",
		// 			"msg" => "Please enter the pincode"
		// 		);
		// 	}
		// 	elseif (!is_numeric($_POST['pincode']))
		// 	{
		// 		$response = array(
		// 			"current_status" => "error",
		// 			"msg" => "Please enter the valid pincode"
		// 		);
		// 	}
			else
			{
				$student_register_id=sql_quote_string($_POST['stud_id']);
				$branch_name=data_encode($_POST['branch_name'],"decode");
				$class_name=data_encode($_POST['class_name'],"decode");
				$section_name=data_encode($_POST['section_name'],"decode"); 
				$stud_name=sql_quote_string($_POST['stud_name']);
				$credit_limit=sql_quote_string($_POST['credit_limit']); 
				$stud_emailid=sql_quote_string($_POST['stud_emailid']); 
				$stud_phone=sql_quote_string($_POST['stud_phone']);
				$stud_date_birth=sql_quote_string($_POST['stud_date_birth']);
				$stud_sex=data_encode($_POST['stud_sex'],"decode");
				$show_password=random_password();
                $password=md5($show_password);
				/* Parent  info */
				$parent_infoset['father_name']=sql_quote_string($_POST['father_name']);
				$parent_infoset['parent_emailid']=sql_quote_string($_POST['parent_emailid']);
				$parent_infoset['parent_phone']=sql_quote_string($_POST['parent_phone']); 
				$parent_info=json_encode($parent_infoset);
				
				/* student  info */
				$stud_infoset['address1']=sql_quote_string($_POST['address1']);
				$stud_infoset['address2']=sql_quote_string($_POST['address2']);
				$stud_infoset['city']=sql_quote_string($_POST['city']);
				$stud_infoset['state']=sql_quote_string($_POST['state']);
				$stud_infoset['pincode']=sql_quote_string($_POST['pincode']); 
				$stud_info=json_encode($stud_infoset); 
				if(isset($_POST['student_unique_id']))
				{
					$student_unique_id=data_encode($_POST['student_unique_id'],"decode");
					$get_student_data = $qisk_db->get_results("select * from smart_student_data where student_unique_id='" . sql_quote_string($student_unique_id) . "' ");
					if($get_student_data!=NULL)
					{
						if (!empty($_FILES['image_url']['name']))
						{ 
							$image_data = qisk_full_image_upload($_FILES['image_url'], "images/student");
							$image_url=$image_data['image_url'];
							$image_data=$image_data['image_data'];
							$image_success = TRUE; 
						}
						else
						{
							if(!empty($get_student_data[0]->image_url))
							{
								$image_url=$get_student_data[0]->image_url;
								$image_data=$get_student_data[0]->image_data;
								$image_success = TRUE;
							}
							else
							{
								$image_url=NULL;
								$image_data=NULL;
								$image_success = TRUE; 
							}
						}
 
						 $setquery="update  smart_student_data set
						   branch_unique_id='" . sql_quote_string($branch_name) . "',
						   class_unique_id='" . sql_quote_string($class_name) . "',  section_unique_id='" . sql_quote_string($section_name) . "',  student_register_id='" . sql_quote_string($student_register_id) . "',  stud_name='" . sql_quote_string($stud_name) . "', credit_limit='" . sql_quote_string($credit_limit) . "',stud_email='" . sql_quote_string($stud_emailid) . "',stud_phone='" . sql_quote_string($stud_phone) . "',stud_datebirth='" . sql_quote_string($stud_date_birth) . "',stud_sex='" . sql_quote_string($stud_sex) . "',parent_details='" . sql_quote_string($parent_info) . "',stud_info='" . sql_quote_string($stud_info) . "' ,image_url='" . sql_quote_string($image_url) . "',image_data='" . sql_quote_string($image_data) . "' where student_unique_id='".sql_quote_string($student_unique_id)."'  ";
						$ups_user_Data=$qisk_db->query( $setquery);
							if ($ups_user_Data)
								{  
									$response = array(
										"current_status" => "success",
										"msg" => "Student Data updated successfully.","url"=>$base_url."/student_listing"
									);
								} 
					}
 
				}
				else
				{
					
					 $check_duplicate_data=$qisk_db->get_results("select * from smart_student_data where student_register_id='".$student_register_id."' ");
					 if($check_duplicate_data==NULL)
					 {
						if (!empty($_FILES['image_url']['name']))
						{
						$image_type = $_FILES['image_url']['type'];
						if (($image_type == "image/gif") || ($image_type == "image/jpeg") || ($image_type == "image/jpg") || ($image_type == "image/png"))
							{
							$image_data = qisk_full_image_upload($_FILES['image_url'], "images/student");
							$image_url = $image_data['image_url'];
							$image_data = $image_data['image_data'];
							$image_success = TRUE;
							}
						  else
							{
							$response = array(
								"current_status" => "error",
								"msg" => "Please upload the image file."
							);
							$image_success = FALSE;
							}
						}
					  else
						{
						$image_url = NULL;
						$image_data = NULL;
						$image_success = TRUE;
						}

						if($image_success)
						{ 
						$insert_data=$qisk_db->query("insert into smart_student_data(branch_unique_id,class_unique_id,section_unique_id,student_register_id,stud_name,credit_limit,stud_email,stud_phone,stud_datebirth,stud_sex,password,show_password,parent_details,stud_info,date_of_add,image_url,image_data,amount)values('".$branch_name."','".$class_name."','".$section_name."','".$student_register_id."','".$stud_name."','".$credit_limit."','".$stud_emailid."','".$stud_phone."','".$stud_date_birth."','".$stud_sex."','".$password."','".$show_password."','".$parent_info."','".$stud_info."','".$date."','".$image_url."','".$image_data."','".$credit_limit."')");
						if(!empty($insert_data))
						{
							$lastinsertid = $insert_data;
							$student_unique_id = randomstring_num() . $lastinsertid;
							$update_uniqid = $qisk_db->query("update smart_student_data set `student_unique_id`= '" . $student_unique_id . "' where student_id='" . $lastinsertid . "' ");
							if ($update_uniqid) 
							{
								
								$insert_credit_data=$qisk_db->query("insert into payment_history(ref_student_uniqueid,payment,type,added_date)values('".sql_quote_string($student_unique_id)."','".sql_quote_string($credit_limit)."','debit','".sql_quote_string($date)."')");
								if(!empty($insert_credit_data))
								{

										$username= $stud_name; 
										$site_name = $base_url;
										$mail = "<div>Thank you for register as a student in Smart Card </div>"; 
										$mail.= "<div>UserID :<b>" . $student_register_id . "</b><div>";
										$mail.= "<div>Password :<b>" .$show_password. "</b><div>";
										$email_msg = email_template("Smart Card Applications", $username, $mail);
										$send_login_mail = $qisk_mail->sent_qiskmail(array(
										$stud_emailid,
										$stud_emailid
										) , "Smart Card Student Account created", "", $email_msg, "Smart Card Account Team"); 
									$response = array(
										"current_status" => "success",
										"msg" => "Student data added successfully",
										"url"=>$base_url."/student_listing"
									); 
							  }
							}
						} 
					}
					 }
					 else
					 {
						$response = array(
							"current_status" => "error",
							"msg" => "Already exists Student ID"
						);
					 }
				}
			} 
			echo json_encode($response);
		}
		break;
		case "stud_list-filter":
	if ($action == "stud_list-filter")
		{ 
		   
		/* filter user listing */ 
		$search_keyword = "";
		$search_query = "";
		$search_query_wrd = NULL;
		$search_join = "";
		$sorting = "";
		$search_filter = NULL;
		$search_terms = NULL;
		$get_user_list = NULL;  
		$where_join="";
		if (isset($_POST['search_term']))
			{
			if ($_POST['search_term'] != "")
				{
				if (strlen($_POST['search_term']) >= 0)
					{
					$search_keyword = sql_quote_string($_POST['search_term']);
					$search_word_array = preg_split("/[\s,]+/", $search_keyword);
					if ($search_word_array != NULL)
						{
						foreach($search_word_array as $srch_words)
							{
							if (strlen($srch_words) >= 3)
								{
								$search_query_wrd[] = $srch_words;
								}
							}
						}
	
					if ($search_query_wrd != NULL)
						{
						$search_keyword = implode("|", $search_query_wrd);
						}
					}
				}
			} 

			$display_type=data_encode($_POST['display_type'],"decode");
		$data_limit=10;
		if(isset($_POST['limit']))
		{
			$limit=" LIMIT ".$_POST['limit'].",".$data_limit;
			$limitData=$_POST['limit'];
		}
		  else
		{
		  $limit=" LIMIT ".$data_limit; 
		   $limitData=0; 
		} 
		if(!empty($_POST['sortby']))
		{
			$sortby=data_encode($_POST['sortby'],"decode");
		}
		if(!empty($_POST['branch_name']))
		{
			$branch_name=data_encode($_POST['branch_name'],"decode");
			$where_join.="and smart_student_data.branch_unique_id='".sql_quote_string($branch_name)."' ";
		}
		if(!empty($_POST['class_name']))
		{
			$class_name=data_encode($_POST['class_name'],"decode");
			$where_join.="and smart_student_data.class_unique_id='".sql_quote_string($class_name)."' ";
		}
		if(!empty($_POST['section_name']))
		{
			$section_name=data_encode($_POST['section_name'],"decode");
			$where_join.="and smart_student_data.section_unique_id='".sql_quote_string($section_name)."' ";
		}
		
		if ($search_keyword != "")
		{ 
		  $search_query.= "and (smart_student_data.stud_email REGEXP '^" . $search_keyword . "' || smart_student_data.card_info REGEXP '^" . $search_keyword . "' || smart_student_data.stud_name REGEXP '^" . $search_keyword . "' || smart_student_data.student_register_id REGEXP '^" . $search_keyword . "' || smart_student_data.stud_phone REGEXP '^" .$search_keyword . "' )  "; 
		}
		if(isset($_POST['barcode']))
		{
			if(!empty($_POST['barcode']))
			{
				$search_query.= " and smart_student_data.card_info = '".sql_quote_string($_POST['barcode'])."' ";
			} 
		}
	  $total_user_count=$qisk_db->get_results("select  count(student_unique_id) as count_uniqid from  smart_student_data " . $search_join . " where  smart_student_data.student_id!='' " . $search_query . " ".$where_join." " . $search_terms . "   ");
	
	  $set_query="select  smart_student_data.*  from smart_student_data
	  " . $search_join . " where  smart_student_data.student_id!='' " . $search_query . " ".$where_join." " . $search_terms . " group by  smart_student_data.student_id " . $sorting . " ORDER BY smart_student_data.student_id ".$sortby." " . $limit . " ";
		 $get_resultdata=$qisk_db->get_results($set_query);  
	
		if(trim($display_type)==trim("student"))
		{
			dis_student_data($get_resultdata); 
		}
		if(trim($display_type)==trim("payment")) 
		{
			dis_payment_data($get_resultdata); 
		}
	
		  $total_user_count=intval($total_user_count[0]->count_uniqid);
		  if($total_user_count>0)
		  {   
			  $new_curr_count=count($get_resultdata)+intval($limitData);
				 if($get_resultdata!=NULL)
				  {
		      ?>
				<script>
				_loadstudent_list.data={};
					_loadstudent_list.data.total_count=<?php echo $total_user_count; ?>;
					_loadstudent_list.data.curr_count=<?php echo $new_curr_count; ?>;
				</script>
			  <?php
			 }
			}
			else
			{ 
				  ?>
					<script>
					_loadstudent_list.data={};
						_loadstudent_list.data.total_count=0;
						_loadstudent_list.data.curr_count=0;
					</script>
				<?php
			} 
		} 
		break; 

		case "add_payment_bx":
		if($action=="add_payment_bx")
		{
		   ?>
		   <div id="pop-innr-bx">
			<div id="ldr-fsn-mn2" style="display: none;">
			</div>
			<div id="popup-blk" class="actv">
				<div class="lwa">
					<div class="lwa-modal _blk_pop74">
						<div id="div-forms">
						<div>
							<span class="login_sty_css">
							<span class="mdi mdi-arrow-left _cls_p_icn8 _icn_bck3"></span>
					      	Add Amount</span>
						</div>
						<div class="row sign-row Ppopbx_div">
							<div class="sign-title">
							</div>
							<form id="amount_frmdata">
								<input type="hidden" name="student_uniqueid" value="<?= $_POST['data_val'];?>">  
								<div class="form-group">
									<label>Amount</label>
									<input type="text" class="form-control _num_type" name="amount">
								</div>
							</form>
						</div>
						<div class="_text_right"> 
							<button class="btn btn-success waves-effect waves-light amount_pay">Add Amount</button>
						</div>
						</div> 
						</div>
					</div>
				</div>
			</div>
			</div>
		   <?php
		}
		break;
		case "add_card_bx" :
		if($action=="add_card_bx")
		{
			$student_uniqueid=data_encode($_POST['data_val'],"decode");
				$get_student_data=$qisk_db->get_results("select * from smart_student_data where student_unique_id='".sql_quote_string($student_uniqueid)."' ");
				if($get_student_data!=NULL)
				{ 
			?>
			  <div id="pop-innr-bx">
			<div id="ldr-fsn-mn2" style="display: none;">
			</div>
			<div id="popup-blk" class="actv">
				<div class="lwa">
					<div class="lwa-modal _blk_pop74">
						<div id="div-forms">
						<div>
							<span class="login_sty_css">
							<span class="mdi mdi-arrow-left _cls_p_icn8 _icn_bck3"></span>
					      	Add/Edit Card Details</span>
						</div>
						<div class="row sign-row Ppopbx_div">
							<div class="sign-title">
							</div>
							<form id="card_frmdata">
								<input type="hidden" name="student_uniqueid" value="<?= $_POST['data_val'];?>">  
								<div class="form-group">
									<label>Card Identification Number</label>
									<input type="text" class="form-control" name="card_id" value="<?= $get_student_data[0]->card_info;?>">
								</div>  
							</form>
						</div>
						<div class="_text_right"> 
							<button class="btn btn-success waves-effect waves-light add_cardbtn">continue</button>
						</div>
						</div> 
						</div>
					</div>
				</div>
			</div>
			</div>
			<?php
				}
		}
		/* case loop end */
		break;
		case "add_payment":
		if($action=="add_payment")
		{
			if($_POST['amount']=="")
			{
				$response = array(
					"current_status" => "error",
					"msg" => "Please enter the amount"
				);
			}
			elseif (!preg_match('/^[0-9]+(?:.[0-9]{0,2})?$/', $_POST['amount'])) 
			{
				$response = array(
					"current_status" => "error",
					"msg" => "Please enter the valid amount"
				);
			}
			elseif($_POST['amount']<0)
			{
				$response = array(
					"current_status" => "error",
					"msg" => "Negative numbers not accepted.Please valid amount"
				);
			}
			else
			{
				$student_uniqueid=data_encode($_POST['student_uniqueid'],"decode");
				$get_student_data=$qisk_db->get_results("select * from smart_student_data where student_unique_id='".sql_quote_string($student_uniqueid)."' ");
				if($get_student_data!=NULL)
				{
					$insert_data=$qisk_db->query("insert into payment_history(branch_unique_id,ref_student_uniqueid,payment,type,added_date)values('".sql_quote_string($get_student_data[0]->branch_unique_id)."','".sql_quote_string($student_uniqueid)."','".sql_quote_string($_POST['amount'])."','debit','".sql_quote_string($date)."')");
					if(!empty($insert_data))
					{
					
						$current_amount=intval($get_student_data[0]->amount + $_POST['amount']);
						$update=$qisk_db->query("update smart_student_data set amount='".sql_quote_string($current_amount)."' where student_unique_id='".sql_quote_string($student_uniqueid)."' ");
						if($update)
						{
							$response = array(
								"current_status" => "success",
								"msg" => "Payment added successfully",
								"student_uniqueid"=>$_POST['student_uniqueid']

							);
						}
						else
						{
							$response = array(
								"current_status" => "error",
								"msg" => "Some error occurred.Please try again later"
							);
						} 
					}
					else
					{
						$response = array(
							"current_status" => "error",
							"msg" => "Some error occurred.Please try again later"
						);
					} 
				}
				else
				{
					$response = array(
						"current_status" => "error",
						"msg" => "Invalid student data.Please try again later"
					);
				} 
			}  
			echo json_encode($response); 
		}
		break;
		case "add_card_func":
		if($action=="add_card_func")
		{
			
			if(empty($_POST['card_id']))
			{
				$response = array(
					"current_status" => "error",
					"msg" => "Please enter the card number"
				);
			} 
			else
			{
				$student_uniqueid=data_encode($_POST['student_uniqueid'],"decode");
				$get_student_data=$qisk_db->get_results("select * from smart_student_data where student_unique_id='".sql_quote_string($student_uniqueid)."' ");
				if($get_student_data!=NULL)
				{
					$card_id=sql_quote_string($_POST['card_id']);
				
					$insert_data=$qisk_db->query("update  smart_student_data set card_info='".sql_quote_string($card_id)."' ,card_active=1 where student_unique_id='".sql_quote_string($student_uniqueid)."' ");
					if($insert_data)
					{ 
						$stud_data=$get_student_data[0];
						if(!empty($stud_data->stud_email))
						{
							$stud_emailid=$stud_data->stud_email;
							$username= $stud_data->stud_name; 
							$site_name = $base_url;
							$mail = "<div>Smart Card Information</div>"; 
							$mail.= "<div>Cart No :<b>" . $_POST['card_id'] . "</b><div>"; 
							$email_msg = email_template("Smart Card Applications", $username, $mail);
							$send_login_mail = $qisk_mail->sent_qiskmail(array(
							$stud_emailid,
							$stud_emailid
							) , "Smart Card Information created", "", $email_msg, "Smart Card Account Team");  
						}  
							$response = array(
								"current_status" => "success",
								"msg" => "Card Identification added successfully",
								"url"=>$base_url."/student_listing"
							);  
					}
					else
					{
						$response = array(
							"current_status" => "error",
							"msg" => "Some error occurred.Please try again later"
						);
					} 
				}
				else
				{
					$response = array(
						"current_status" => "error",
						"msg" => "Invalid student data.Please try again later"
					);
				} 
			}  
			echo json_encode($response);  
		}
		break;
		case "load_stud_paybx":
		if($action=="load_stud_paybx")
		{
			   $student_uniqueid=data_encode($_POST['student_uniqueid'],"decode");
				$get_student_data=$qisk_db->get_results("select * from smart_student_data where student_unique_id='".sql_quote_string($student_uniqueid)."' ");
				if($get_student_data!=NULL)
				{
					$row=$get_student_data[0];
					?>
					   <div class="_total_amount">
						<span class="total_lable">Total Amount</span> : 
						<span class="total_cmnt"><?= $row->amount; ?></span>
						</div>
						<div class="credit_amount">
						<span class="">Credit Amount</span> : 
						<span class=""><?= $row->credit_limit; ?></span>
						</div>
					<?php
				}
		}

		break;  
       case "password_reset_popup":
		if($action=="password_reset_popup")
		{ 
	 ?>
  <div id="ldr-fsn-mn2" style="display: none;"> 
		 </div> 
		 <div id="popup-blk" class="actv"> 
				<div class="lwa">
		 <div class="lwa-modal _blk_pop74">
			 <div id="div-forms">
				 <div>
					 <span class="login_sty_css">
						 <span class="mdi mdi-arrow-left _cls_p_icn8 _icn_bck3"></span>
					 Password reset</span>
				 </div>
				 <div class="row sign-row Ppopbx_div">
					 <div class="sign-title">
					 </div>
					 <form id="_password_frm"> 
					 <input type="hidden" name="user_uniqueid" value="<?= $_POST['data_val'];?>"> 
						 <div class="form-group">
							 <label>New Password</label>
							 <input type="password" class="form-control" name="new_pwd" >
						 </div>
						 <div class="form-group">
							 <label>Confirm Password ID</label>
							 <input type="password" class="form-control" name="cnfirm_pwd" >
						 </div>
					 </form>
				 </div>  
						 <div class="btn_text_right">
							 <button class="btn btn-small initbtn_crl confirm_reset">Password Reset</button>
						 </div> 
				 </div>
			 </div>
		 </div>
	 </div>
	 </div>
		
	 </div>
	 <?php
 }  
 break;
case "password_reste_func":
 if($action=="password_reste_func")
 {
	 $response=array("current_status"=>"error","msg"=>"Some errors occurred!.please try again later");
		if (empty($_POST['new_pwd']))
		 {
			 $response = array(
				 "current_status" => "error",
				 "msg" => "Please enter new password"
			 );
		 } 
		 elseif (strlen($_POST['new_pwd'])<4)
		 {
			 $response = array(
				 "current_status" => "error",
				 "msg" => "New password minimum 4 characters required"
			 );
		 }
		 elseif (empty($_POST['cnfirm_pwd']))
		 {
			 $response = array(
				 "current_status" => "error",
				 "msg" => "Please enter confirm password"
			 );
		 }
		 elseif (strlen($_POST['cnfirm_pwd'])<4)
		 {
			 $response = array(
				 "current_status" => "error",
				 "msg" => "confirm password minimum 4 characters required"
			 );
		 }
		 elseif (trim($_POST['cnfirm_pwd'])!=trim($_POST['new_pwd']))
		 {
			 $response = array(
				 "current_status" => "error",
				 "msg" => "Password does not match the confirm password"
			 );
		 }
		 else
		 {
			 $user_unique_id=data_encode($_POST['user_uniqueid'],"decode");
			 $get_result_data=$qisk_db->get_results("select * from smart_admin where user_unique_id='".sql_quote_string($user_unique_id)."' ");
			 if($get_result_data!=NULL)
			 {
				  
				       $cnfirm_pwd=sql_quote_string($_POST['cnfirm_pwd']); 
					   $new_password=md5($cnfirm_pwd);
					   $update_data=$qisk_db->query("update smart_admin set password='".sql_quote_string($new_password)."',show_password='".sql_quote_string($cnfirm_pwd)."' where user_unique_id='".sql_quote_string($user_unique_id)."' ");
					   if($update_data)
					   {
						 $response = array(
							 "current_status" => "success",
							 "msg" => "Your password has been reset successfully!"
						 ); 
					   }  
			 }
			 else
			 {
				$response = array(
					"current_status" => "error",
					"msg" => "Invalid User Id!"
				); 
			 } 
		 }
		 echo json_encode($response); 
 }
 break;

case "user_img_remove":
 if($action=="user_img_remove")
 {
	 $user_unique_id=data_encode($_POST['data_val'],"decode");
	 $get_results=$qisk_db->get_results("select * from smart_admin where user_unique_id='".sql_quote_string($user_unique_id)."' ");
	 if($get_results!=NULL)
	 {
		 $vendor_data=$get_results[0];
		 if(!empty($vendor_data->image_url))
		 {
			$remove_status=image_remove($vendor_data->image_url);
			if($remove_status)
			{
				$update=$qisk_db->query("update smart_admin set image_url=''  where user_unique_id='".sql_quote_string($user_unique_id)."' ");
				if($update)
				{
				 $response = array(
					 "current_status" => "success",
					 "msg" => "Image removed successfully."
				 ); 
				}
			}
			else
			{
			 $response = array(
				 "current_status" => "error",
				 "msg" => "some error occurred.Please try again later"
			 );
			}
		 }
		 else
		 {
			 $response = array(
				 "current_status" => "error",
				 "msg" => "some error occurred.Please try again later"
			 );
		 }
	 }
	 else
	 {
		 $response = array(
			 "current_status" => "error",
			 "msg" => "some error occurred.Please try again later"
		 );
	 }
	 echo json_encode($response);
 }
 break;
 case "filterstall_data":
 if($action=="filterstall_data")
 {
		$branch_uniqueid=data_encode($_POST['data_val'],"decode");
	$get_stallData=$qisk_db->get_results("SELECT * FROM stall_listData where branch_uniqueid='".sql_quote_string($branch_uniqueid)."' ");
	if($get_stallData!=NULL)
	{
		?>
     	<option value="">
			    Select the Stall
			</option>
		<?php
		foreach($get_stallData as $data)
		{
			?>
			<option value="<?= data_encode($data->stall_uniqueid,"encode"); ?>">
			     <?= ucwords($data->stall_name)." (". $data->stall_code.")"; ?>
			</option>
			<?php
		}

	}
	else
	{
		?>
		<option value="">
			<?= ucwords("No data Found"); ?></option>
	  <?php
	}
 }
 break;
    } 
}