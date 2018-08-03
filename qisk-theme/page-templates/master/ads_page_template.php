<?php
   global $base_url,$qisk_db,$image_url;
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
                     <a class="" href="<?= $base_url?>/ads-listing"> <span class="mdi mdi-arrow-left"></span>
                     </a>
                     <span class=""><?= ucwords("Add Ads");?></span>  
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
                                 <form id="ads_frm1243_add">
                                    <div class="form-group clearfix">
                                       <label for="userName">Ads Title<span class="text-danger"></span></label>
                                       <div> 
                                          <input class="form-control" name="title"> 
                                       </div>
                                    </div>
                                    <div class="form-group clearfix">
                                       <label for="userName">Ads Description<span class="text-danger"></span></label>
                                       <div> 
                                          <textarea  class="form-control _text_area" name="descr_data"></textarea> 
                                       </div>
                                       <div class="form-group clearfix">
                                          <label for="userName">Offer Date<span class="text-danger"></span></label>
                                          <div> 
                                             <input class="form-control datePicker offer_date" name="offer_date">  
                                          </div>
                                       </div>
                                      <div class="form-group clearfix">
                                          <div class="imgbx_btn" id="image_url">Image Upload</div>
                                          <div class="_img_bx_disdata">
                                             <input type="file" name="image_url" id="img_logo_file" class="btn btn-primary" style="display:none;" accept="image/*">
                                             <div class="_imng_bx_dataset">
                                                <div class="img_prod_bx-mn-lst">
                                                   <img src="<?= $image_url->get_url("userImage"); ?>" alt="Image" class="_com_src_log">
                                                </div>
                                             </div>
                                          </div>
                                       </div> 
                                 </form>
                                 <div class="text-right">
                                 <button class="btn btn-success waves-effect waves-light ads_addbtn">
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
                         $ads_uniqueid=data_encode($_GET['data_uniqid'],"decode");
                         $get_result_data=$qisk_db->get_results("select * from  ads_listData where ads_uniqueid='".sql_quote_string($ads_uniqueid)."' ");
                         if($get_result_data!=NULL)
                         {
                           $data=$get_result_data[0];
                          if(!empty($data->image_data))
                          {
                            $image_data=$data->image_data;
                          }
                          else
                          {
                            $image_data=$image_url->get_url("NoImage");
                          }

                       ?>
                        <div class="_pnel_datavx"> 
                      <a class="" href="<?= $base_url?>/ads-listing"> <span class="mdi mdi-arrow-left"></span>
                      </a>
                      <span class=""><?= ucwords("Update ads");?></span>  
                     </div> 
                  <div class="wizard clearfix">
                     <div class="bx_rox123">
                     <section>
                        <div class="row">
                           <div class="col-3"> 
                           </div>
                           <div class="col-6">
                              <div class="col-xs-12 col-sm-12">
                                 <form id="ads_frm1243_add">
                                 <input type="hidden" name="data_uniqid" value="<?= $_GET['data_uniqid'];?>"/>
                                    <div class="form-group clearfix">
                                       <label for="userName">Ads Title<span class="text-danger"></span></label>
                                       <div> 
                                          <input class="form-control" name="title" value="<?= $get_result_data[0]->title; ?>"> 
                                       </div>
                                    </div>
                                    <div class="form-group clearfix">
                                       <label for="userName">Ads Description<span class="text-danger"></span></label>
                                       <div> 
                                          <textarea  class="form-control _text_area" name="descr_data"><?= $get_result_data[0]->desciption; ?></textarea> 
                                       </div>
                                       <div class="form-group clearfix">
                                          <label for="userName">Offer Date<span class="text-danger"></span></label>
                                          <div> 
                                             <input class="form-control datePicker offer_date" name="offer_date" value="<?= $get_result_data[0]->offer_date; ?>">   
                                          </div>
                                       </div> 
                                          <div class="form-group clearfix">
                                          <div class="imgbx_btn" id="image_url">Image Upload</div>
                                          <div class="_img_bx_disdata">
                                             <input type="file" name="image_url" id="img_logo_file" class="btn btn-primary" style="display:none;" accept="image/*">
                                             <div class="_imng_bx_dataset">
                                                <div class="img_prod_bx-mn-lst">
                                                   <img src="<?= $image_data; ?>" alt="Image" class="_com_src_log">
                                                </div>
                                             </div>
                                          </div>
                                       </div> 
                                 </form>
                                 <div class="text-right">
                                 <button class="btn btn-success waves-effect waves-light ads_addbtn">
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
                        <span class=""><?= ucwords("ads Listing");?></span>
                        <a class="_lnk_bxbtn" href="<?= $base_url; ?>/ads-listing?type=add">Add</a> 
                     </div>
                  </div>
                  <table id="datatable" class="table table-striped">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Image</th>
                           <th>Offer Date</th>
                           <th>Title</th>
                           <th>Description</th>
                           <th>Edit</th>
                           <th>Remove</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $get_result_data=$qisk_db->get_results("select * from ads_listData"); 
                           if($get_result_data!=NULL)
                           {
                               $i=1;
                            foreach($get_result_data as $data)
                            { 
                              if(!empty($data->image_data))
                              {
                                $image_data=$data->image_data;
                              }
                              else
                              {
                                $image_data=$image_url->get_url("NoImage");
                              }
                              ?>  
                        <tr>
                           <td> 
                              <?= $i; ?> 
                           </td>
                           <td>
                           <div class="imagesrcBx12">
                               <img src="<?= $image_data; ?>" class="image_adsbx">
                           </div>
                           </td>
                           <td><?= $data->offer_date?></td>
                           <td><?= $data->title?></td>
                           <td><?= $data->desciption?></td>
                           <td>
                              <a href="<?= $base_url;?>/ads-listing?type=edit&data_uniqid=<?= data_encode($data->ads_uniqueid,"encode");?>"  class="_iconbx_edit"><i class="ion-edit"></i></a>
                           </td>
                           <td> <a data-val="<?= data_encode(json_encode(array("ads",$data->ads_uniqueid)),"encode")?>" class="_iconbx_rem remove_bx"> <i class="ion-android-trash"></i></a></td>
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