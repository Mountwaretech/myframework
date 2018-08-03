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
                     
                     if(trim($_GET['type']=="add-student"))
                     {
                             ?>
                  <form id="stud_frm1243">
                     <div class="card-box">
                        <div class="_bx_cnval_124">
                           <div class="_panel_hdnx">
                              <div class="_pnel_datavx">  
                                 <span class="span_titlebx">
                                 <a href="<?= $base_url; ?>/student_listing">  <span class="zmdi zmdi-arrow-left _icn_ze"></span></a>
                                 <?= ucwords("Add student");?>
                                 </span>   
                              </div>
                           </div>
                           <div  class="wizard clearfix">
                              <div class="bx_rox123">
                                 <h5><?= ucwords("academic Information"); ?></h5>
                                 <section>
                                    <div class="row">
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Branch Name<span class="text-danger"></span></label>
                                             <div>
                                                <select class="form-control branch_name_code" name="branch_name">
                                                   <option value="">Select Branch Name</option>
                                                   <?php 
                                                      $get_result_data=$qisk_db->get_results("select * from branch_listData");
                                                         if($get_result_data!=NULL)
                                                         {
                                                           foreach($get_result_data as $data)
                                                           {
                                                           
                                                               ?>
                                                   <option value="<?= data_encode($data->branch_uniqueid,"encode");?>"><?= ucwords($data->branch_name); ?></option>
                                                   <?php
                                                      }
                                                      }
                                                      ?>
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Class Name<span class="text-danger"></span></label>
                                             <div>
                                                <select class="form-control" name="class_name">
                                                   <option value="">Select Class Name</option>
                                                   <?php 
                                                      $get_result_data=$qisk_db->get_results("select * from master_data where type='class'");
                                                         if($get_result_data!=NULL)
                                                         {
                                                           foreach($get_result_data as $data)
                                                           {
                                                           
                                                               ?>
                                                   <option value="<?= data_encode($data->data_uniqueid,"encode");?>"><?= ucwords($data->name); ?></option>
                                                   <?php
                                                      }
                                                      }
                                                      ?>
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Section Name<span class="text-danger"></span></label>
                                             <div>
                                                <select class="form-control" name="section_name">
                                                   <option value="">Select Section Name</option>
                                                   <?php 
                                                      $get_result_data=$qisk_db->get_results("select * from master_data where type='section'");
                                                         if($get_result_data!=NULL)
                                                         {
                                                           foreach($get_result_data as $data)
                                                           {
                                                           
                                                               ?>
                                                   <option value="<?= data_encode($data->data_uniqueid,"encode");?>"><?= ucwords($data->name); ?></option>
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
                                 <h5>Account Information</h5>
                                 <section>
                                    <div class="row">
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Student Name<span class="text-danger"></span></label>
                                             <div>
                                                <input class="form-control"  name="stud_name" type="text" >
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Student ID<span class="text-danger"></span></label>
                                             <div>
                                                <input class="form-control stud_id"  name="stud_id" type="hidden" >
                                                <input class="form-control stud_regid"  name="stud_id" type="text" readonly="readonly" disabled="disabled">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Credit Limit<span class="text-danger"></span></label>
                                             <div>
                                                <input class="form-control"  name="credit_limit" type="text" >
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="password"> Student Email address	<span class="text-danger"></span></label>
                                             <div>
                                                <input  name="stud_emailid" type="text" class=" form-control">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Student Phone Number<span class="text-danger"></span></label>
                                             <div>
                                                <input  name="stud_phone" type="text" class="form-control _num_type">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Date of Birth<span class="text-danger"></span></label>
                                             <div>
                                                <input  name="stud_date_birth" type="text" class=" form-control date_of_birth">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Sex<span class="text-danger"></span></label>
                                             <div>
                                                <select class="form-control" name="stud_sex">
                                                   <option value="">Select sex</option>
                                                   <?php 
                                                      $sex_data=array("male","female","other");
                                                        if($sex_data!=NULL)
                                                        {
                                                          foreach($sex_data as $data)
                                                          {
                                                          
                                                              ?>
                                                   <option value="<?= data_encode($data,"encode");?>"><?= ucwords($data); ?></option>
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
                                 <h5><?= ucwords("Parent Information"); ?></h5>
                                 <section>
                                    <div class="row">
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Father Name / Mother Name<span class="text-danger"></span></label>
                                             <div>
                                                <input class="form-control"  name="father_name" type="text">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="password"> Email address	<span class="text-danger"></span></label>
                                             <div>
                                                <input  name="parent_emailid" type="text" class=" form-control">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Phone Number<span class="text-danger"></span></label>
                                             <div>
                                                <input  name="parent_phone" type="text" class=" form-control _num_type">
                                             </div>
                                          </div>
                                       </div>
                                 </section>
                                 </div>
                              </div>
                           </div>
                           <div  class="wizard clearfix">
                              <div class="bx_rox123">
                                 <h5>Profile Information</h5>
                                 <section>
                                    <div class="row">
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Address1<span class="text-danger"></span></label>
                                             <div>
                                                <textarea  class="form-control _text_area" name="address1"></textarea> 
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Address1<span class="text-danger"></span></label>
                                             <div>
                                                <textarea  class="form-control _text_area" name="address2"></textarea>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="password"> City	<span class="text-danger"></span></label>
                                             <div>
                                                <input  name="city" type="text" class=" form-control">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="password"> State	<span class="text-danger"></span></label>
                                             <div>
                                                <input  name="state" type="text" class=" form-control">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Pincode<span class="text-danger"></span></label>
                                             <div>
                                                <input  name="pincode" type="text" class=" form-control _num_type">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <div class="imgbx_btn" id="image_url">Student Profile Upload</div>
                                             <div class="_img_bx_disdata">
                                                <input type="file" name="image_url" id="img_logo_file" class="btn btn-primary" style="display:none;" accept="image/*">
                                                <div class="_imng_bx_dataset">
                                                   <div class="img_prod_bx-mn-lst">
                                                      <img src="<?= $image_url->get_url("userImage"); ?>" alt="Student Image" class="_com_src_log">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </section>
                              </div>
                           </div>
                           <div class="text-right">
                              <button class="btn btn-success waves-effect waves-light stud_btnad">
                              <i class="fa fa-check"></i>
                              Save and Continue</button>  
                           </div>
                        </div>
                     </div>
                  </form>
                  <script>
                     $(document).ready(function (){
                         $('.date_of_birth').bootstrapMaterialDatePicker({ 
                           format: "dddd DD MMMM YYYY ",
                           weekStart: 0, 
                           time: false
                         }).
                         on('change', function(e, date) 
                         {
                           $('.date_of_birth').val(date.format("YYYY-MM-DD"));
                       });
                     })
                  </script> 
                  <?php
                     }
                     
                     if(trim($_GET['type']=="edit-student"))
                     {
                        $student_unique_id=data_encode($_GET['student_unique_id'],"decode");
                        $student_data=get_student_data($student_unique_id); 
                     ?>
                  <form id="stud_frm1243">
                     <input type="hidden" name="student_unique_id" value="<?= $_GET['student_unique_id'];?>">
                     <div class="card-box">
                        <div class="_bx_cnval_124">
                           <div class="_panel_hdnx">
                              <div class="_pnel_datavx">  
                                 <span class="span_titlebx">
                                 <a href="<?= $base_url; ?>/student_listing">  <span class="zmdi zmdi-arrow-left _icn_ze"></span></a>
                                 <?= ucwords("Edit student");?>
                                 </span>   
                              </div>
                           </div>
                           <div  class="wizard clearfix">
                              <div class="bx_rox123">
                                 <h5><?= ucwords("academic Information"); ?></h5>
                                 <section>
                                    <div class="row">
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Branch Name<span class="text-danger"></span></label>
                                             <div>
                                                <select class="form-control branch_name_code" name="branch_name">
                                                   <option value="">Select Branch Name</option>
                                                   <?php 
                                                      $get_result_data=$qisk_db->get_results("select * from branch_listData");
                                                         if($get_result_data!=NULL)
                                                         {
                                                           foreach($get_result_data as $data)
                                                           {
                                                               if($data->branch_unique_id=$student_data->branch_unique_id)
                                                                {
                                                                      $selected='selected="selected"';
                                                                }
                                                                else
                                                                {
                                                                    $selected='';
                                                                }
                                                               ?>
                                                   <option <?= $selected;?> value="<?= data_encode($data->branch_uniqueid,"encode");?>"><?= ucwords($data->branch_name); ?></option>
                                                   <?php
                                                      }
                                                      }
                                                      ?>
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Class Name<span class="text-danger"></span></label>
                                             <div>
                                                <select class="form-control" name="class_name">
                                                   <option value="">Select Class Name</option>
                                                   <?php 
                                                      $get_result_data=$qisk_db->get_results("select * from master_data where type='class'");
                                                         if($get_result_data!=NULL)
                                                         {
                                                           foreach($get_result_data as $data)
                                                           {
                                                            if($data->data_uniqueid=$student_data->class_unique_id)
                                                            {
                                                                  $selected='selected="selected"';
                                                            }
                                                            else
                                                            {
                                                                $selected='';
                                                            }
                                                           
                                                               ?>
                                                   <option <?= $selected;?> value="<?= data_encode($data->data_uniqueid,"encode");?>"><?= ucwords($data->name); ?></option>
                                                   <?php
                                                      }
                                                      }
                                                      ?>
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Section Name<span class="text-danger"></span></label>
                                             <div>
                                                <select class="form-control" name="section_name">
                                                   <option value="">Select Section Name</option>
                                                   <?php 
                                                      $get_result_data=$qisk_db->get_results("select * from master_data where type='section'");
                                                         if($get_result_data!=NULL)
                                                         {
                                                           foreach($get_result_data as $data)
                                                           {
                                                            if($data->data_uniqueid=$student_data->section_unique_id)
                                                            {
                                                                  $selected='selected="selected"';
                                                            }
                                                            else
                                                            {
                                                                $selected='';
                                                            }
                                                           
                                                               ?>
                                                   <option <?= $selected;?> value="<?= data_encode($data->data_uniqueid,"encode");?>"><?= ucwords($data->name); ?></option>
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
                                 <h5>Account Information</h5>
                                 <section>
                                    <div class="row">
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Student Name<span class="text-danger"></span></label>
                                             <div>
                                                <input class="form-control"  name="stud_name" type="text"  value="<?= $student_data->stud_name;?>">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Student ID<span class="text-danger"></span></label>
                                             <div>
                                                <input class="form-control stud_id"  type="text" value="<?= $student_data->student_register_id;?>" readonly="readonly" disabled='disabled'>
                                                <input   name="stud_id" type="hidden" value="<?= $student_data->student_register_id;?>">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Credit Limit<span class="text-danger"></span></label>
                                             <div>
                                                <input class="form-control"  name="credit_limit" type="text" value="<?= $student_data->credit_limit;?>">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="password"> Student Email address	<span class="text-danger"></span></label>
                                             <div>
                                                <input  name="stud_emailid" type="text" class=" form-control" value="<?= $student_data->stud_email;?>">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Student Phone Number<span class="text-danger"></span></label>
                                             <div>
                                                <input  name="stud_phone" type="text" class="form-control _num_type" value="<?= $student_data->stud_phone;?>">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Date of Birth<span class="text-danger"></span></label>
                                             <div>
                                                <input  name="stud_date_birth" type="text" class=" form-control date_of_birth" value="<?= $student_data->stud_datebirth;?>">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Sex<span class="text-danger"></span></label>
                                             <div>
                                                <select class="form-control" name="stud_sex">
                                                   <option value="">Select sex</option>
                                                   <?php 
                                                      $sex_data=array("male","female","other");
                                                        if($sex_data!=NULL)
                                                        {
                                                          foreach($sex_data as $data)
                                                          {
                                                             if($data=$student_data->stud_sex)
                                                             {
                                                                   $selected='selected="selected"';
                                                             }
                                                             else
                                                             {
                                                                 $selected='';
                                                             }
                                                          
                                                              ?>
                                                   <option <?= $selected;?> value="<?= data_encode($data,"encode");?>"><?= ucwords($data); ?></option>
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
                                 <h5><?= ucwords("Parent Information"); ?></h5>
                                 <section>
                                    <div class="row">
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Father Name / Mother Name<span class="text-danger"></span></label>
                                             <div>
                                                <input class="form-control"  name="father_name" type="text" value="<?= $student_data->father_name;?>">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="password"> Email address	<span class="text-danger"></span></label>
                                             <div>
                                                <input  name="parent_emailid" type="text" class=" form-control" value="<?= $student_data->parent_emailid;?>">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Phone Number<span class="text-danger"></span></label>
                                             <div>
                                                <input  name="parent_phone" type="text" class=" form-control _num_type" value="<?= $student_data->parent_phone;?>">
                                             </div>
                                          </div>
                                       </div>
                                 </section>
                                 </div>
                              </div>
                           </div>
                           <div  class="wizard clearfix">
                              <div class="bx_rox123">
                                 <h5>Profile Information</h5>
                                 <section>
                                    <div class="row">
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Address1<span class="text-danger"></span></label>
                                             <div>
                                                <textarea  class="form-control _text_area" name="address1"><?= $student_data->address1;?></textarea> 
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Address1<span class="text-danger"></span></label>
                                             <div>
                                                <textarea  class="form-control _text_area" name="address2"><?= $student_data->address2;?></textarea>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="password"> City	<span class="text-danger"></span></label>
                                             <div>
                                                <input  name="city" type="text" class=" form-control" value="<?= $student_data->city;?>">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="password"> State	<span class="text-danger"></span></label>
                                             <div>
                                                <input  name="state" type="text" class=" form-control" value="<?= $student_data->state;?>">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Pincode<span class="text-danger"></span></label>
                                             <div>
                                                <input  name="pincode" type="text" class=" form-control _num_type" value="<?= $student_data->pincode;?>">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <div class="imgbx_btn" id="image_url">Student Profile Upload</div>
                                             <div class="_img_bx_disdata">
                                                <input type="file" name="image_url" id="img_logo_file" class="btn btn-primary" style="display:none;" accept="image/*">
                                                <div class="_imng_bx_dataset">
                                                   <div class="img_prod_bx-mn-lst">
                                                      <img src="<?= $student_data->image_url;?>" alt="Student Image" class="_com_src_log">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </section>
                              </div>
                           </div>
                           <div class="text-right">
                              <button class="btn btn-success waves-effect waves-light stud_btnad">
                              <i class="fa fa-check"></i>
                              Update and Continue</button>  
                           </div>
                        </div>
                     </div>
                  </form>
                  <script>
                     $(document).ready(function (){
                         $('.date_of_birth').bootstrapMaterialDatePicker({ 
                           format: "dddd DD MMMM YYYY ",
                           weekStart: 0, 
                           time: false
                         }).
                         on('change', function(e, date) 
                         {
                           $('.date_of_birth').val(date.format("YYYY-MM-DD"));
                       });
                     })
                  </script> 
                  <?php
                     }
                     if(trim($_GET['type']=="view-student"))
                     { 
                        $student_uniqueid=data_encode($_GET['student_unique_id'],"decode");
                        $student_data=get_student_data($student_uniqueid);  
                     
                        $branch_data= get_branch_data($student_data->branch_unique_id);
                        $section_data=get_master_data($student_data->class_unique_id);
                        $class_data=get_master_data($student_data->section_unique_id);
                        $department_data=get_master_data($student_data->department_unique_id);
                          ?> 
                  <div class="card-box">
                     <div class="_bx_cnval_124">
                        <div class="_panel_hdnx">
                           <div class="_pnel_datavx">  
                              <span class="span_titlebx">
                              <a href="<?= $base_url; ?>/student_listing">  <span class="zmdi zmdi-arrow-left _icn_ze"></span></a>
                              <?= ucwords("student Details");?>
                              </span>   
                           </div>
                        </div>
                        <div  class="wizard clearfix">
                           <div class="bx_rox123">
                              <div class="_prof_bx78">
                                 <?php
                                    if($student_data->active_status==1)
                                    {
                                        ?>
                                 <span class="mdi mdi-check-circle _actv475u"></span>
                                 <?php
                                    }
                                    ?>
                                 <div class="_prof_img45">
                                    <img src="<?= $student_data->image_url;?>"/>
                                 </div>
                                 <div class="_nme_tbl4">
                                    <?= ucwords($student_data->stud_name);?>
                                 </div>
                              </div>
                              <div class="_dvChr_b458 _fld_tb145">
                                 <div class="_sbhd_452">academic Information</div>
                                 <div class="_cnt_d_tbl7">
                                    <table>
                                       <tr>
                                          <td class="_cnt_dta">
                                             Branch Name
                                          </td>
                                          <td class="_cnt_vl">
                                             <?= ucwords($branch_data->branch_name);?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="_cnt_dta">
                                             Class Name
                                          </td>
                                          <td class="_cnt_vl">
                                             <?= ucwords($class_data->name);?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="_cnt_dta">
                                             Section Name
                                          </td>
                                          <td class="_cnt_vl">
                                             <?= $section_data->name;?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="_cnt_dta">
                                             Department Name
                                          </td>
                                          <td class="_cnt_vl">
                                             <?= $department_data->name;?>
                                          </td>
                                       </tr>
                                    </table>
                                 </div>
                              </div>
                              <div class="_dvChr_b458 _fld_tb145">
                                 <div class="_sbhd_452">Student Information</div>
                                 <div class="_cnt_d_tbl7">
                                    <table>
                                       <tr>
                                          <td class="_cnt_dta">
                                             Student Name
                                          </td>
                                          <td class="_cnt_vl">
                                             <?= ucwords($student_data->stud_name);?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="_cnt_dta">
                                             Student ID
                                          </td>
                                          <td class="_cnt_vl">
                                             <?= ucwords($student_data->student_register_id);?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="_cnt_dta">
                                             Credit Limit
                                          </td>
                                          <td class="_cnt_vl">
                                             <?= $student_data->credit_limit;?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="_cnt_dta">
                                             Email address
                                          </td>
                                          <td class="_cnt_vl">
                                             <?= $student_data->stud_email;?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="_cnt_dta">
                                             Phone Number
                                          </td>
                                          <td class="_cnt_vl">
                                             <?= $student_data->stud_phone;?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="_cnt_dta">
                                             Date of Birth
                                          </td>
                                          <td class="_cnt_vl">
                                             <?= $student_data->stud_datebirth;?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="_cnt_dta">
                                             Sex
                                          </td>
                                          <td class="_cnt_vl">
                                             <?= $student_data->stud_sex;?>
                                          </td>
                                       </tr>
                                    </table>
                                 </div>
                              </div>
                              <div class="_dvChr_b458 _fld_tb145">
                                 <div class="_sbhd_452">Parent Information</div>
                                 <div class="_cnt_d_tbl7">
                                    <table>
                                       <tr>
                                          <td class="_cnt_dta">
                                             Father Name / Mother Name
                                          </td>
                                          <td class="_cnt_vl">
                                             <?= ucwords($student_data->father_name);?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="_cnt_dta">
                                             Email address
                                          </td>
                                          <td class="_cnt_vl">
                                             <?= $student_data->parent_emailid;?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="_cnt_dta">
                                             Phone Number
                                          </td>
                                          <td class="_cnt_vl">
                                             <?= $student_data->parent_phone;?>
                                          </td>
                                       </tr>
                                    </table>
                                 </div>
                              </div>
                              <div class="_dvChr_b458 _fld_tb145">
                                 <div class="_sbhd_452">Profile Information</div>
                                 <div class="_cnt_d_tbl7">
                                    <table>
                                       <tr>
                                          <td class="_cnt_dta">
                                             Address
                                          </td>
                                          <td class="_cnt_vl">
                                             <div> <?= ucwords($student_data->address1);?></div>
                                             <div> <?= ucwords($student_data->address2);?></div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td class="_cnt_dta">
                                             City
                                          </td>
                                          <td class="_cnt_vl">
                                             <?= ucwords($student_data->city);?>
                                          </td>
                                       </tr>
                                       <tr>
                                          <?php
                                             if(!empty($student_data->state))
                                               {
                                                   ?>
                                       <tr>
                                          <td class="_cnt_dta">
                                             State
                                          </td>
                                          <td class="_cnt_vl">
                                             <?= ucwords($student_data->state);?>
                                          </td>
                                       </tr>
                                       <?php
                                          }
                                          ?> 
                                       <tr>
                                       <tr>
                                          <td class="_cnt_dta">
                                             Postal code
                                          </td>
                                          <td class="_cnt_vl">
                                             <?= $student_data->pincode;?>
                                          </td>
                                       </tr>
                                    </table>
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
                     else
                     {
                     ?>
               <div class="card-box">
                  <div class="_pro_loder_bx" style="display: none;">
                     <div class="progress">
                        <div class="indeterminate"></div>
                     </div>
                  </div>
                  <div class="_bx_cnval_124">
                     <form id="stud_FRm_data">
                        <div class="_panel_hdnx">
                           <div class="_pnel_datavx">
                              <input type="hidden" name="display_type" value="<?= data_encode("student","encode");?>" />
                              <span class="span_titlebx">
                              <?= ucwords("student Listing");?>
                              <a class="href_124bx" href="<?= $base_url;?>/student_listing?type=add-student">Add student</a>
                              </span>   
                              <div class="filter_text_bx">
                               <div class="_dt_pckr_dbrd _depart_bx_123 _select_drop">
                                    <input type="text" name="search_term" class="search_bx_filter student_search" placeholder="Any Searching">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="main_bx1234">
                           <div class="disbx2 selctdropbx">
                              <select class="form-control" name="sortby">
                                 <?php
                                 $soryby=array("DESC","ASC");
                                    foreach($soryby as $soryby_data)
                                    { 
                                     ?>
                                 <option value="<?= data_encode($soryby_data,"encode");?>">Sory By <?= ucwords($soryby_data);?></option>
                                 <?php
                                    }
                                    ?> 
                              </select>
                           </div>
                           <div class="disbx2 selctdropbx">
                              <select class="form-control" name="branch_name">
                                 <option value="">Select Branch Name</option>
                                 <?php 
                                    $get_result_data=$qisk_db->get_results("select * from branch_listData");
                                       if($get_result_data!=NULL)
                                       {
                                         foreach($get_result_data as $data)
                                         {
                                         
                                             ?>
                                 <option value="<?= data_encode($data->branch_uniqueid,"encode");?>"><?= ucwords($data->branch_name); ?></option>
                                 <?php
                                    }
                                    }
                                    ?>
                              </select>
                           </div>
                           <div class="disbx2 selctdropbx">
                              <select class="form-control" name="class_name">
                                 <option value="">Select Class Name</option>
                                 <?php 
                                    $get_result_data=$qisk_db->get_results("select * from master_data where type='class'");
                                       if($get_result_data!=NULL)
                                       {
                                         foreach($get_result_data as $data)
                                         {
                                         
                                             ?>
                                 <option value="<?= data_encode($data->data_uniqueid,"encode");?>"><?= ucwords($data->name); ?></option>
                                 <?php
                                    }
                                    }
                                    ?>
                              </select>
                           </div>
                           <div class="disbx2 selctdropbx">
                              <select class="form-control" name="section_name">
                                 <option value="">Select Section Name</option>
                                 <?php 
                                    $get_result_data=$qisk_db->get_results("select * from master_data where type='section'");
                                       if($get_result_data!=NULL)
                                       {
                                         foreach($get_result_data as $data)
                                         {
                                         
                                             ?>
                                 <option value="<?= data_encode($data->data_uniqueid,"encode");?>"><?= ucwords($data->name); ?></option>
                                 <?php
                                    }
                                    }
                                    ?>
                              </select>
                           </div>
                           <div class="disbx2 selctdropbx">
                              <button type="button" class="btn btn-success waves-effect waves-light fiterbystudent">Submit</button>
                           </div>
                        </div>
                     </form>
                     <script> 
                        $(document).ready(function () {
                            $(window).scroll(function () {
                                /* paginate_blg */
                                if ($(".student_list-main-bx").hasClass("_actv")) {
                                    var $user_lst_bx = parseFloat($(".lst_bx458").innerHeight()) - parseFloat(300);
                                    if ($user_lst_bx < $(window).scrollTop()) {
                                      _loadstudent_list.pagin();
                                    }
                                }
                            });
                        });
                     </script>
                     <div class="student_list-main-bx">
                        <script>
                           $(document).ready(function() {
                               _loadstudent_list.init();
                           });
                        </script>
                     </div>
                  </div>
               </div>
               <?php
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