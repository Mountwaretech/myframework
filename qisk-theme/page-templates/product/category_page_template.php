<?php
   global $base_url,$qisk_db;
   if(isset($_SESSION['admin_unique_id'])) 
   {
    get_qisk_header();   
   ?> 
<script src="<?= $base_url; ?>/assets/js/prod_js12.js"></script>  
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
                        <a class="" href="<?= $base_url?>/product_category"> <span class="mdi mdi-arrow-left"></span>
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
                                    <form id="category_frm1243_add">
                                       <div class="form-group clearfix">
                                          <label for="userName">Category<span class="text-danger">*</span></label>
                                          <div> 
                                          <input class="form-control" name="category_data"> 
                                          </div>
                                       </div> 
                                       <div class="form-group clearfix">
                                                <label for="password"> Category Image</label>
                                                <div>
                                                   <div class="imgbx_btn" id="image_url">Image Upload</div>
                                                   <div class="_img_bx_disdata">
                                                      <input type="file" name="image_url" id="img_logo_file" class="btn btn-primary" style="display:none;" accept="image/*">
                                                      <div class="_imng_bx_dataset">
                                                         <div class="img_prod_bx-mn-lst">
                                                            <img src="<?= $image_url->get_url("productImage"); ?>" alt="Category Image" class="_com_src_log">
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                    </form>
                                    <div class="text-right">
                                       <button class="btn btn-success waves-effect waves-light _category_add">
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
                         $category_uniqid=data_encode($_GET['data_uniqid'],"decode");
                         $get_result_data=$qisk_db->get_results("select * from prod_category where category_uniqid='".sql_quote_string($category_uniqid)."' ");
                         if($get_result_data!=NULL)
                         { 
                           if(empty($get_result_data[0]->image_url))
                           {
                            $image_url_data=$image_url->get_url("productImage");
                           }
                           else
                           {
                            $image_url_data=$get_result_data[0]->image_url;
                           }
                       ?> 
                    <div class="_panel_hdnx">
                     <div class="_pnel_datavx"> 
                        <a class="" href="<?= $base_url?>/product_category"> <span class="mdi mdi-arrow-left"></span>
                        </a>
                        <span class=""><?= ucwords("Update category");?></span>  
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
                                 <form id="category_frm1243_add">
                                 <input type="hidden" name="data_uniqid" value="<?= $_GET['data_uniqid'];?>"/>
                                     <div class="form-group clearfix">
                                          <label for="userName">Category<span class="text-danger">*</span></label>
                                          <div> 
                                          <input class="form-control" name="category_data" value="<?= $get_result_data[0]->category_name; ?>"> 
                                          </div>
                                       </div> 

                                           <div class="form-group clearfix">
                                                <label for="password"> Category Image</label>
                                                <div>
                                                   <div class="imgbx_btn" id="image_url">Image Upload</div>
                                                   <div class="_img_bx_disdata">
                                                      <input type="file" name="image_url" id="img_logo_file" class="btn btn-primary" style="display:none;" accept="image/*">
                                                      <div class="_imng_bx_dataset">
                                                         <div class="img_prod_bx-mn-lst">
                                                            <img src="<?= $image_url_data;?>" alt="Category Image" class="_com_src_log">
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>

                                 </form>
                                 <div class="text-right">
                                    <button class="btn btn-success waves-effect waves-light _category_add">
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
                        <span class=""><?= ucwords("Category Listing");?></span>
                        <a class="_lnk_bxbtn" href="<?= $base_url; ?>/product_category?type=add">Add</a> 
                     </div>
                  </div>
                  <table id="datatable" class="table table-striped">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Image</th>
                           <th>Category</th> 
                           <th>Edit</th>
                           <th>Remove</th>
                        </tr>
                     </thead>
                     <tbody> 
                        <?php
                           $get_result_data=$qisk_db->get_results("select * from prod_category"); 
                           if($get_result_data!=NULL)
                           {
                               $i=1;
                            foreach($get_result_data as $data)
                            { 

                              if(empty($data->image_data))
                              {
                                  $image_urls=$image_url->get_url("productImage"); 
                              }
                              else
                              {
                                  $image_urls=$data->image_data;
                              }
                              ?>  
                        <tr>
                           <td> 
                           <?= $i; ?> 
                            </td> 
                            <td>
                            <div class="_user_img_bx">
                              <div class="img_bx_dipy">
                                <img src="<?php echo $image_urls; ?>" alt="img" class="user_img_src" style="<?= pic_size_css($image_url);?>"> 
                              </div>
                          </div> 
                            </td>
                           <td><?= ucwords($data->category_name);?></td> 
                            <td>
                              <a href="<?= $base_url;?>/product_category?type=edit&data_uniqid=<?= data_encode($data->category_uniqid,"encode");?>"  class="_iconbx_edit"><i class="ion-edit"></i></a>
                           </td>
                           <td> 
                           <?php
                           $check_delete_data=$qisk_db->get_results("select * from product_data where ref_category_uniqid='".sql_quote_string($data->category_uniqid)."' ");
                           if($check_delete_data==NULL)
                           { 
                             ?> 
                           <a data-val="<?= data_encode(json_encode(array("prod_category",$data->category_uniqid)),"encode")?>" class="_iconbx_rem remove_bx"> <i class="ion-android-trash"></i></a>
                           <?php 
                           }
                           else
                           {
                             ?>
                             <div>This category already assigned in some product.So can't delete the category</div>
                             <?php
                           }
                           ?> 
                           </td>
                        </tr>
                        <?php
                        $i++;
                           } 
                           }
                           else
                           {
                               ?>
                               <tr>
                                <td colspan="5">
                                 <div class="noDatafound">
                                    No data Found
                                 </div>
                                </td>
                               </tr>
                               <?php
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
<script>
$(document).ready(function (){
    $('#datatable').DataTable({});
});
</script>
<?php 
get_qisk_footer();
}
else
{
   header("Location:".$base_url."/login");  
}
