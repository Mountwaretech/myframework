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
                        <a class="" href="<?= $base_url?>/category">
                         <span class="mdi mdi-arrow-left"></span>
                        </a>
                        <span class=""><?= ucwords("Add category");?></span>  
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
                                    <form id="master_addFRM">
                                    <input type="hidden"
                                       <div class="form-group clearfix">
                                          <label for="userName">Operation<span class="text-danger">*</span></label>
                                          <div> 
                                          <input class="form-control" name="operation_data"> 
                                          </div>
                                       </div> 
                                    </form>
                                    <div class="text-right">
                                       <button class="btn btn-success waves-effect waves-light _master_adbtn">
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
                         $operation_uniqid=data_encode($_GET['data_uniqid'],"decode");
                         $get_result_data=$qisk_db->get_results("select * from  operation_data where operation_uniqid='".sql_quote_string($operation_uniqid)."' ");
                         if($get_result_data!=NULL)
                         { 
                       ?>
                  <div class="_panel_hdnx">
                     <a class="" href="<?= $base_url?>/operation-listing"> <span class="mdi mdi-arrow-left"></span>
                     </a>
                     <span class=""><?= ucwords("Update operation");?></span>  
                  </div>
                  <div class="wizard clearfix">
                  <div class="bx_rox123">
                     <section>
                        <div class="row">
                           <div class="col-3"> 
                           </div> 
                           <div class="col-6">
                              <div class="col-xs-12 col-sm-12">
                                 <form id="operation_frm1243_add">
                                 <input type="hidden" name="data_uniqid" value="<?= $_GET['data_uniqid'];?>"/>
                                     <div class="form-group clearfix">
                                          <label for="userName">Operation<span class="text-danger">*</span></label>
                                          <div> 
                                          <input class="form-control" name="operation_data" value="<?= $get_result_data[0]->operation; ?>"> 
                                          </div>
                                       </div> 
                                 </form>
                                 <div class="text-right">
                                    <button class="btn btn-success waves-effect waves-light _operation_add">
                                    <i class="fa fa-check"></i>
                                    Update</button>  
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
                        <span class=""><?= ucwords("operation Listing");?></span>
                        <a class="_lnk_bxbtn" href="<?= $base_url; ?>/operation-listing?type=add">Add</a> 
                     </div>
                  </div>
                  <table id="datatable" class="table table-striped">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Operation</th> 
                           <th>Edit</th>
                           <th>Remove</th>
                        </tr>
                     </thead>
                     <tbody> 
                        <?php
                           $get_result_data=$qisk_db->get_results("select * from operation_data"); 
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
                           <td><?= ucwords($data->operation);?></td> 
                            <td>
                              <a href="<?= $base_url;?>/operation-listing?type=edit&data_uniqid=<?= data_encode($data->operation_uniqid,"encode");?>"  class="_iconbx_edit"><i class="ion-edit"></i></a>
                           </td>
                           <td> <a data-val="<?= data_encode(json_encode(array("operation",$data->operation_uniqid)),"encode")?>" class="_iconbx_rem _actremvebtn"> <i class="ion-android-trash"></i></a></td>
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
