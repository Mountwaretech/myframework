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
                       if(trim($_GET['type']=="add-stall"))
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
                                    <form id="stall_frm1243">
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
                                                <option value="<?= data_encode($data->branch_uniqueid,"encode");?>">
                                                     <?= ucwords($data->branch_name); ?>
                                                </option>
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
                                             <input class="form-control"  name="stall_name" type="text">
                                          </div>
                                       </div>
                                       <div class="form-group clearfix">
                                          <label for="userName">Stall Code<span class="text-danger"></span></span></label>
                                          <div>
                                             <input class="form-control"  name="stall_code" type="text">
                                          </div>
                                       </div>
                                    </form>
                                    <div class="text-right">
                                       <button class="btn btn-success waves-effect waves-light stall_adbtn">
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
                     if(trim($_GET['type'])=="edit-stall")
                     {
                         $stall_uniqueid=data_encode($_GET['data_uniqid'],"decode");
                         
                         $get_result_data=$qisk_db->get_results("select * from  stall_listData where stall_uniqueid='".sql_quote_string($stall_uniqueid)."' ");
                         if($get_result_data!=NULL)
                         { 
                            $stallData=$get_result_data[0];
                          
                       ?>
                  <div class="_pnel_datavx"> 
                     <a class="" href="<?= $base_url?>/stall-listing"> <span class="mdi mdi-arrow-left"></span>
                     </a>
                     <span class=""><?= ucwords("Update stall");?></span>  
                  </div>
                  <div class="wizard clearfix">
                     <div class="bx_rox123">
                        <section>
                           <div class="row">
                              <div class="col-3"> 
                              </div>
                              <div class="col-6">
                                 <div class="col-xs-12 col-sm-12">
                                    <form id="stall_frm1243">
                                       <input type="hidden" name="stall_uniqueid" value="<?= $_GET['data_uniqid'];?>"/>
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
                                                            if($data->branch_uniqueid==$stallData->branch_uniqueid)
                                                            {
                                                                $selected='selected="selected"';
                                                            }
                                                            else
                                                            {
                                                                $selected='';
                                                            }
                                                        
                                                            ?>
                                                <option <?= $selected; ?> value="<?= data_encode($data->branch_uniqueid,"encode");?>">
                                                     <?= ucwords($data->branch_name); ?>
                                                </option>
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
                                             <input class="form-control" name="stall_name" value="<?= $stallData->stall_name; ?>"> 
                                          </div>
                                       </div>
                                       <div class="form-group clearfix">
                                          <label for="userName">Stall Code<span class="text-danger"></span></label>
                                          <div> 
                                             <input class="form-control" name="stall_code" value="<?= $stallData->stall_code; ?>"> 
                                          </div>
                                       </div>
                                    </form>
                                    <div class="text-right">
                                       <button class="btn btn-success waves-effect waves-light stall_adbtn">
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
                     } 
                     }
                     else
                     { 
                     ?>
                  <div class="_panel_hdnx">
                     <div class="_pnel_datavx"> 
                        <span class=""><?= ucwords("stall Listing");?></span>
                        <a class="_lnk_bxbtn" href="<?= $base_url; ?>/stall-listing?type=add-stall">Add</a> 
                     </div>
                  </div>
                  <table id="datatable" class="table table-striped">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Branch Name</th>
                           <th>stall Name</th>
                           <th>stall Code</th>
                           <th>Edit</th>
                           <th>Remove</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $get_result_data=$qisk_db->get_results("select stall_listData.*,branch_listData.branch_name from stall_listData inner join branch_listData on stall_listData.branch_uniqueid=branch_listData.branch_uniqueid ORDER BY `stall_listData`.`stall_name` ASC"); 
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
                           <td><?= $data->branch_name?></td>
                           <td><?= $data->stall_name?></td>
                           <td><?= $data->stall_code?></td>
                           <td>
                              <a href="<?= $base_url;?>/stall-listing?type=edit-stall&data_uniqid=<?= data_encode($data->stall_uniqueid,"encode");?>"  class="_iconbx_edit"><i class="ion-edit"></i></a>
                           </td>
                           <td> <a data-val="<?= data_encode(json_encode(array("stall",$data->stall_uniqueid)),"encode")?>" class="_iconbx_rem remove_bx"> <i class="ion-android-trash"></i></a></td>
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