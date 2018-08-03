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
                    if(trim($_GET['type']=="add-branch"))
                    {
                        ?>
               <div class="_panel_hdnx">
                  <div class="_pnel_datavx"> 
                     <a class="" href="<?= $base_url?>/branch-listing"> <span class="mdi mdi-arrow-left"></span>
                     </a>
                     <span class=""><?= ucwords("Add branch");?></span>  
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
                                 <form id="branch_frm1243">
                                 <div class="form-group clearfix">
                                        <label for="userName">Branch Name<span class="text-danger"></span></label>
                                        <div>
                                        <input class="form-control"  name="branch_name" type="text">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group clearfix">
                                             <label for="userName">Branch Code<span class="text-danger"></span></span></label>
                                             <div>
                                                <input class="form-control"  name="branch_code" type="text">
                                             </div>
                                          </div> 
                                 </form>
                                 <div class="text-right">
                                 <button class="btn btn-success waves-effect waves-light branch_adbtn">
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
                     if(trim($_GET['type'])=="edit-branch")
                     {
                         $branch_uniqueid=data_encode($_GET['data_uniqid'],"decode");
                         $get_result_data=$qisk_db->get_results("select * from  branch_listData where branch_uniqueid='".sql_quote_string($branch_uniqueid)."' ");
                         if($get_result_data!=NULL)
                         { 
                       ?>
                        <div class="_pnel_datavx"> 
                      <a class="" href="<?= $base_url?>/branch-listing"> <span class="mdi mdi-arrow-left"></span>
                      </a>
                      <span class=""><?= ucwords("Update branch");?></span>  
                     </div> 
                  <div class="wizard clearfix">
                     <div class="bx_rox123">
                     <section>
                        <div class="row">
                           <div class="col-3"> 
                           </div>
                           <div class="col-6">
                              <div class="col-xs-12 col-sm-12">
                                 <form id="branch_frm1243">
                                 <input type="hidden" name="branch_uniqueid" value="<?= $_GET['data_uniqid'];?>"/>
                                    <div class="form-group clearfix">
                                       <label for="userName">Branch Name<span class="text-danger"></span></label>
                                       <div> 
                                          <input class="form-control" name="branch_name" value="<?= $get_result_data[0]->branch_name; ?>"> 
                                       </div>
                                    </div>
                                    <div class="form-group clearfix">
                                       <label for="userName">Branch Code<span class="text-danger"></span></label>
                                       <div> 
                                          <input class="form-control" name="branch_code" value="<?= $get_result_data[0]->branch_code; ?>"> 
                                       </div>
                                    </div>
                                 </form>
                                 <div class="text-right">
                                 <button class="btn btn-success waves-effect waves-light branch_adbtn">
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
                        <span class=""><?= ucwords("Branch Listing");?></span>
                        <a class="_lnk_bxbtn" href="<?= $base_url; ?>/branch-listing?type=add-branch">Add</a> 
                     </div>
                  </div>
                  <table id="datatable" class="table table-striped">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Branch Name</th>
                           <th>Branch Code</th> 
                           <th>Edit</th>
                           <th>Remove</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $get_result_data=$qisk_db->get_results("select * from branch_listData  ORDER BY `branch_listData`.`branch_id` DESC"); 
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
                           <td><?= $data->branch_code?></td>
                           <td>
                              <a href="<?= $base_url;?>/branch-listing?type=edit-branch&data_uniqid=<?= data_encode($data->branch_uniqueid,"encode");?>"  class="_iconbx_edit"><i class="ion-edit"></i></a>
                           </td>
                           <td> <a data-val="<?= data_encode(json_encode(array("branch",$data->branch_uniqueid)),"encode")?>" class="_iconbx_rem remove_bx"> <i class="ion-android-trash"></i></a></td>
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