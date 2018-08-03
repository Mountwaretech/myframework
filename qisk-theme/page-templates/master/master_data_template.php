<?php
   global $base_url,$qisk_db,$qisk;
   if(isset($_SESSION['admin_unique_id'])) 
   { 
        $data_type=$get_query_vars['data_type'];
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
                        <a class="" href="<?= $base_url?>/master/<?= $data_type;?>">
                         <span class="mdi mdi-arrow-left"></span>
                        </a>
                        <span class="">Add <?= ucwords($data_type);?></span>  
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
                                    <input type="hidden" name="type" value="<?= data_encode($data_type,"encode");?>"/> 
                                       <div class="form-group clearfix">
                                          <label for="userName"><?= ucwords($data_type);?> Name<span class="text-danger">*</span></label>
                                          <div> 
                                          <input class="form-control" name="name_data"> 
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
                         $data_uniqueid=data_encode($_GET['data_uniqid'],"decode");
                         $get_result_data=$qisk_db->get_results("select * from  master_data where data_uniqueid='".sql_quote_string($data_uniqueid)."' ");
                         if($get_result_data!=NULL)
                         { 
                       ?>
                  <div class="_panel_hdnx">
                     <a class="" href="<?= $base_url?>/master/<?= $data_type ?>"> <span class="mdi mdi-arrow-left"></span>
                     </a>
                     <span class="">Update<?= ucwords($data_type);?></span>  
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
                                 <input type="hidden" name="data_uniqid" value="<?= $_GET['data_uniqid'];?>"/>
                                 <input type="hidden" name="type" value="<?= data_encode($data_type,"encode");?>"/>
                                     <div class="form-group clearfix">
                                     <label for="userName"><?= ucwords($data_type);?> Name<span class="text-danger">*</span></label>
                                          <div> 
                                          <input class="form-control" name="name_data" value="<?= $get_result_data[0]->name; ?>"> 
                                          </div>
                                       </div> 
                                 </form>
                                 <div class="text-right">
                                    <button class="btn btn-success waves-effect waves-light _master_adbtn">
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
                        <span class=""><?= ucwords($data_type);?> Listing</span>
                        <a class="_lnk_bxbtn" href="<?= $base_url; ?>/master/<?= $data_type;?>?type=add">Add</a> 
                     </div>
                  </div>
                  <table id="datatable" class="table table-striped">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th><?= $data_type;?></th> 
                           <th>Edit</th>
                           <th>Remove</th>
                        </tr>
                     </thead>
                     <tbody> 
                        <?php
                           $get_result_data=$qisk_db->get_results("select * from master_data where type='".sql_quote_string($data_type)."'  ORDER BY `master_data`.`id` DESC"); 
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
                           <td><?= ucwords($data->name);?></td> 
                            <td>
                              <a href="<?= $base_url;?>/master/<?= $data_type;?>?type=edit&data_uniqid=<?= data_encode($data->data_uniqueid,"encode");?>"  class="_iconbx_edit"><i class="ion-edit"></i></a>
                           </td>
                           <td> <a data-val="<?= data_encode(json_encode(array("master",$data->data_uniqueid)),"encode")?>" class="_iconbx_rem remove_bx"> <i class="ion-android-trash"></i></a></td>
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
