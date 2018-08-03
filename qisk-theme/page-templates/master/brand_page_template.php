<?php
   global $base_url,$qisk_db;
   if(isset($_SESSION['admin_unique_id'])) 
   {
   get_qisk_header();   
   ?> 
<div class="main_cntbx">
<div class="content-page">
<!-- Start content --> 
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="card-box">
               <div class="_bx_cnval_124">
                  <?php
                     if(isset($_GET['type']))
                     {   
                         if(trim($_GET['type'])=="add")
                         {
                           ?>
                  <div class="_panel_hdnx">
                     <div class="_pnel_datavx"> 
                        <a class="" href="<?= $base_url?>/stall-listing"> <span class="mdi mdi-arrow-left"></span>
                        </a>
                        <span class=""><?= ucwords("Add stall");?></span>  
                     </div>
                  </div>
                  <div class="wizard clearfix">
                     <div class="bx_rox123">
                        <section>
                           <div class="row">
                              <div class="col-3"> 
                              </div> 
                              <div class="col-6">
                                 <div class="col-xs-12 col-sm-12">
                                    <form id="stall_frm1243_add">
                                    <div class="form-group clearfix">
                                             <label for="userName">Branch Name<span class="text-danger">*</span></label>
                                             <div>
                                                <select class="form-control branch_name_code" name="branch_name">
                                                   <option value="">Select Branch Name</option>
                                                   <?php 
                                                      $get_result_data=$qisk_db->get_results("select * from branch_listing");
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
                                       <div class="form-group clearfix">
                                          <label for="userName">Stall Name<span class="text-danger"></span></label>
                                          <div> 
                                          <input class="form-control" name="stall_name"> 
                                          </div>
                                       </div> 

                                        <div class="form-group clearfix">
                                          <label for="userName">Stall Code<span class="text-danger"></span></label>
                                          <div> 
                                          <input class="form-control" name="stall_code"> 
                                          </div>
                                       </div> 

                                    </form>
                                    <div class="text-right">
                                       <button class="btn btn-success waves-effect waves-light _stall_add">
                                       <i class="fa fa-check"></i>
                                       Save</button>  
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </section>
                     </div>
                  </div>
                  <?php
                     }
                     if(trim($_GET['type'])=="edit")
                     {
                         $stall_uniqueid=data_encode($_GET['data_uniqid'],"decode");
                         $get_result_data=$qisk_db->get_results("select * from  stall_list_data where stall_uniqueid='".sql_quote_string($stall_uniqueid)."' ");
                         if($get_result_data!=NULL)
                         { 
                       ?>
                  <div class="_panel_hdnx">
                     <a class="" href="<?= $base_url?>/stall-listing"> <span class="mdi mdi-arrow-left"></span>
                     </a>
                     <span class=""><?= ucwords("Edit stall");?></span>  
                  </div>
                  <div class="wizard clearfix">
                  <div class="bx_rox123">
                     <section>
                        <div class="row">
                           <div class="col-3"> 
                           </div> 
                           <div class="col-6">
                              <div class="col-xs-12 col-sm-12">
                              <form id="stall_frm1243_add">
                              <input type="hidden" name="data_uniqid" value="<?= $_GET['data_uniqid'];?>"/>
                                    <div class="form-group clearfix">
                                             <label for="userName">Branch Name<span class="text-danger">*</span></label>
                                             <div>
                                                <select class="form-control branch_name_code" name="branch_name">
                                                   <option value="">Select Branch Name</option>
                                                   <?php 
                                                      $get_result_data=$qisk_db->get_results("select * from branch_listing");
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
                                       <div class="form-group clearfix">
                                          <label for="userName">Stall Name<span class="text-danger"></span></label>
                                          <div> 
                                          <input class="form-control" name="stall_name"> 
                                          </div>
                                       </div> 

                                        <div class="form-group clearfix">
                                          <label for="userName">Stall Code<span class="text-danger"></span></label>
                                          <div> 
                                          <input class="form-control" name="stall_code"> 
                                          </div>
                                       </div>  
                                    </form> 
                                 <div class="text-right">
                                    <button class="btn btn-success waves-effect waves-light _stall_add">
                                    <i class="fa fa-check"></i>
                                    Update & Continue</button>  
                                 </div>
                              </div>
                           </div>
                        </div>
                     </section>
                  </div>
               </div> 
                  <?php
                     }
                    } 
                     }
                     else
                     { 
                     ?>
                  <div class="_panel_hdnx">
                     <div class="_pnel_datavx"> 
                        <span class=""><?= ucwords("Stall Listing");?></span>
                        <a class="_lnk_bxbtn" href="<?= $base_url; ?>/stall-listing?type=add">Add</a> 
                     </div>
                  </div>
                  <table id="datatable" class="table table-striped">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Branch Name</th> 
                           <th>Stall  Name</th> 
                           <th>Stall Code</th> 
                           <th>Edit</th>
                           <th>Remove</th>
                        </tr>
                     </thead>
                     <tbody> 
                        <?php
                           $get_result_data=$qisk_db->get_results("select * from stall_list_data ORDER BY `stall_list_data`.`stall_id` DESC"); 
                           if($get_result_data!=NULL)
                           {
                               $i=1;
                            foreach($get_result_data as $data)
                            { 
                              ?>  
                        <tr>
                           <td> 
                           <?= $i; ?> 
                            </td> 
                           <td><?= ucwords($data->stall);?></td> 
                           <td><?= ucwords($data->stall);?></td> 
                           <td><?= ucwords($data->stall);?></td> 
                            <td>
                              <a href="<?= $base_url;?>/stall-listing?type=edit&data_uniqid=<?= data_encode($data->stall_uniqid,"encode");?>"  class="_iconbx_edit"><i class="ion-edit"></i></a>
                           </td>
                           <td> <a data-val="<?= data_encode(json_encode(array("stall",$data->stall_uniqid)),"encode")?>" class="_iconbx_rem _actremvebtn"> <i class="ion-android-trash"></i></a></td>
                        </tr>
                        <?php
                        $i++;
                           } 
                           }
                           ?> 
                     </tbody> 
                  </table>
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
<?php 
get_qisk_footer();
}
else
{
   header("Location:".$base_url."/login");  
}
