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
                     <a class="" href="<?= $base_url?>/terminal-listing"> <span class="mdi mdi-arrow-left"></span>
                     </a>
                     <span class=""><?= ucwords("Add terminal");?></span>  
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
                                 <form id="terminal_frm1243_add">
                                    <div class="form-group clearfix">
                                       <label for="userName">Terminal Name<span class="text-danger"></span></label>
                                       <div> 
                                          <input class="form-control" name="terminal_name"> 
                                       </div>
                                    </div>
                                    <div class="form-group clearfix">
                                       <label for="userName">Terminal Code<span class="text-danger"></span></label>
                                       <div> 
                                          <input class="form-control" name="terminal_code"> 
                                       </div>
                                    </div>
                                 </form>
                                 <div class="text-right">
                                 <button class="btn btn-success waves-effect waves-light terminal_addbtn">
                                 <i class="fa fa-check"></i>
                                 Save</button>  
                                 </div>
                                 </div>
                              </div>
                           </div>
                     </section>
                     </div>
                  </div>
                  <script>
                     $(document).ready(function (){
                       $('.offer_date').bootstrapMaterialDatePicker({
                         format: "dddd DD MMMM YYYY ",
                          weekStart: 0,
                           time: false 
                           })
                           .on('change', function(e, date) 
                           {
                           $('.offer_date').val(date.format("YYYY-MM-DD"));
                       });
                     });
                     
                  </script>
                  <?php
                     }
                     if(trim($_GET['type'])=="edit")
                     {
                         $terminal_uniqueid=data_encode($_GET['data_uniqid'],"decode");
                         $get_result_data=$qisk_db->get_results("select * from  terminal_data where terminal_uniqueid='".sql_quote_string($terminal_uniqueid)."' ");
                         if($get_result_data!=NULL)
                         { 
                       ?>
                        <div class="_pnel_datavx"> 
                      <a class="" href="<?= $base_url?>/terminal-listing"> <span class="mdi mdi-arrow-left"></span>
                      </a>
                      <span class=""><?= ucwords("Update terminal");?></span>  
                     </div> 
                  <div class="wizard clearfix">
                     <div class="bx_rox123">
                     <section>
                        <div class="row">
                           <div class="col-3"> 
                           </div>
                           <div class="col-6">
                              <div class="col-xs-12 col-sm-12">
                                 <form id="terminal_frm1243_add">
                                 <input type="hidden" name="data_uniqid" value="<?= $_GET['data_uniqid'];?>"/>
                                 <div class="form-group clearfix">
                                       <label for="userName">Terminal Name<span class="text-danger"></span></label>
                                       <div> 
                                          <input class="form-control" name="terminal_name" value="<?= $get_result_data[0]->terminal_name;?>"> 
                                       </div>
                                    </div>
                                    <div class="form-group clearfix">
                                       <label for="userName">Terminal Code<span class="text-danger"></span></label>
                                       <div> 
                                          <input class="form-control" name="terminal_code" value="<?= $get_result_data[0]->terminal_code;?>"> 
                                       </div>
                                    </div>
                                 </form>
                                 <div class="text-right">
                                 <button class="btn btn-success waves-effect waves-light terminal_addbtn">
                                 <i class="fa fa-check"></i>
                                 Save</button>  
                                 </div>
                                 </div>
                              </div>
                           </div>
                     </section>
                     </div>
                  </div>
                  <script>
                     $(document).ready(function (){
                       $('.offer_date').bootstrapMaterialDatePicker({
                         format: "dddd DD MMMM YYYY ",
                          weekStart: 0,
                           time: false 
                           })
                           .on('change', function(e, date) 
                           {
                           $('.offer_date').val(date.format("YYYY-MM-DD"));
                       });
                     });
                     
                  </script>
                  <?php
                     }
                     } 
                     }
                     else
                     { 
                     ?>
                  <div class="_panel_hdnx">
                     <div class="_pnel_datavx"> 
                        <span class=""><?= ucwords("terminal Listing");?></span>
                        <a class="_lnk_bxbtn" href="<?= $base_url; ?>/terminal-listing?type=add">Add</a> 
                     </div>
                  </div>
                  <table id="datatable" class="table table-striped">
                     <thead>
                        <tr>
                           <th>No</th> 
                           <th>Terminal Name</th>
                           <th>Terminal Code</th>
                           <th>Edit</th>
                           <th>Remove</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $get_result_data=$qisk_db->get_results("select * from terminal_data"); 
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
                           <td><?= $data->terminal_name?></td>
                           <td><?= $data->terminal_code?></td>
                           <td>
                              <a href="<?= $base_url;?>/terminal-listing?type=edit&data_uniqid=<?= data_encode($data->terminal_uniqueid,"encode");?>"  class="_iconbx_edit"><i class="ion-edit"></i></a>
                           </td>
                           <td> <a data-val="<?= data_encode(json_encode(array("terminal",$data->terminal_uniqueid)),"encode")?>" class="_iconbx_rem remove_bx"> <i class="ion-android-trash"></i></a></td>
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