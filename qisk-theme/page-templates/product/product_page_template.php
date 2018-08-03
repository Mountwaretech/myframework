<?php
   global $qisk_db,$base_url,$image_url,$branch_data;
  
   if(isset($_SESSION['admin_unique_id'])) 
   {  
      
   get_qisk_header();
   $date_format = new DateTime();
   $date = $date_format->format("Y-m-d h:i:s"); 
   ?>
<script src="<?= $base_url; ?>/assets/js/prod_js12.js"></script>  
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
                     
                     if(trim($_GET['type']=="add-product"))
                     {
                      ?>
                  <div class="card-box">
                     <div class="_bx_cnval_124">
                        <div class="_panel_hdnx">
                           <div class="_pnel_datavx">  
                              <span class="span_titlebx">
                              <a href="<?= $base_url; ?>/product_listing">  <span class="zmdi zmdi-arrow-left _icn_ze"></span></a>
                              <?= ucwords("Add product");?>
                              </span>   
                           </div>
                        </div>
                        <form id="prod_frm1243" >
                           <div  class="wizard clearfix">
                              <div class="bx_rox123">
                                 <section>
                                    <div class="row">
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Category<span class="text-danger">*</span></label>
                                             <div>
                                                <select class="form-control" name="category_data">
                                                   <option value="">Select Category</option>
                                                   <?php
                                                      $get_result_data=$qisk_db->get_results("select * from prod_category "); 
                                                         if($get_result_data!=NULL)
                                                         {
                                                           foreach($get_result_data as $data)
                                                           {
                                                           
                                                               ?>
                                                   <option value="<?= data_encode($data->category_uniqid,"encode");?>"><?= ucwords($data->category_name); ?></option>
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
                                             <label for="userName">Product Name<span class="text-danger">*</span></label>
                                             <div>
                                                <input class="form-control"  name="product_name" type="text">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Product Code<span class="text-danger">*</span></label>
                                             <div>
                                                <input class="form-control"  name="product_code" type="text">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="password"> Actual Price<span class="text-danger">*</span></label>
                                             <div>
                                                <input  name="actual_price" type="text" class=" form-control">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="password">Selling Price<span class="text-danger">*</span></label>
                                             <div>
                                                <input  name="selling_price" type="text" class=" form-control">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Product Description<span class="text-danger">*</span></label>
                                             <div>
                                                <textarea  class="form-control _text_area" name="product_desc"></textarea>
                                             </div>
                                          </div>
                                       </div>
                                 </section>
                                 </div>
                              </div>
                              <div  class="wizard clearfix">
                                 <div class="bx_rox123">
                                    <section>
                                       <div class="row">
                                          <div class="col-xs-12 col-sm-6">
                                             <div class="form-group clearfix">
                                                <label for="password"> Product Image</label>
                                                <div>
                                                   <div class="imgbx_btn" id="image_url">Image Upload</div>
                                                   <div class="_img_bx_disdata">
                                                      <input type="file" name="image_url" id="img_logo_file" class="btn btn-primary" style="display:none;" accept="image/*">
                                                      <div class="_imng_bx_dataset">
                                                         <div class="img_prod_bx-mn-lst">
                                                            <img src="<?= $image_url->get_url("userImage"); ?>" alt="Product Image" class="_com_src_log">
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </section>
                                 </div>
                              </div>
                        </form>
                        <div class="text-right">
                        <button class="btn btn-success waves-effect waves-light prod_upbtn">
                        <i class="fa fa-check"></i>
                        Save and Continue</button>  
                        </div>
                        </div>
                     </div>
                  </div>
                  <?php
                     }
                     if(trim($_GET['type']=="edit-product"))
                     {
                        $product_uniqueid=data_encode($_GET['product_uniqueid'],"decode");
                        $prod_data=get_prod_data($product_uniqueid); 
                        ?>
                  <div class="card-box">
                     <div class="_bx_cnval_124">
                        <div class="_panel_hdnx">
                           <div class="_pnel_datavx">  
                              <span class="span_titlebx">
                              <a href="<?= $base_url; ?>/product_listing">  <span class="zmdi zmdi-arrow-left _icn_ze"></span></a>
                              <?= ucwords("Edit product");?>
                              </span>   
                           </div>
                        </div>
                        <form id="prod_frm1243" >
                           <input type="hidden" name="product_uniqueid" value="<?= $_GET['product_uniqueid'];?>">
                           <div  class="wizard clearfix">
                              <div class="bx_rox123">
                                 <section>
                                    <div class="row">
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Category<span class="text-danger">*</span></label>
                                             <div>
                                                <select class="form-control" name="category_data">
                                                   <option value="">Select Category</option>
                                                   <?php
                                                      $get_result_data=$qisk_db->get_results("select * from prod_category"); 
                                                         if($get_result_data!=NULL)
                                                         {
                                                           foreach($get_result_data as $data)
                                                           {
                                                               if($data->category_uniqid==trim($prod_data->ref_category_uniqid))
                                                               {
                                                                   $selected='selected="selected"';
                                                               }
                                                               else
                                                               {
                                                                   $selected='';
                                                               }
                                                           
                                                               ?>
                                                   <option <?= $selected; ?> value="<?= data_encode($data->category_uniqid,"encode");?>"><?= ucwords($data->category_name); ?></option>
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
                                             <label for="userName">Product Name<span class="text-danger">*</span></label>
                                             <div>
                                                <input class="form-control"  name="product_name" type="text" value="<?= $prod_data->product_name;?> ">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Product Code<span class="text-danger">*</span></label>
                                             <div>
                                                <input class="form-control"  name="product_code" type="text" value="<?= $prod_data->product_code;?> ">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="password"> Actual Price<span class="text-danger">*</span></label>
                                             <div>
                                                <input  name="actual_price" type="text" class=" form-control" value="<?= $prod_data->actual_price;?> ">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="password">Selling Price<span class="text-danger">*</span></label>
                                             <div>
                                                <input  name="selling_price" type="text" class=" form-control"  value="<?= $prod_data->selling_price;?> ">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-xs-12 col-sm-6">
                                          <div class="form-group clearfix">
                                             <label for="userName">Product Description<span class="text-danger">*</span></label>
                                             <div>
                                                <textarea  class="form-control _text_area" name="product_desc"> <?= $prod_data->prod_description;?></textarea>
                                             </div>
                                          </div>
                                       </div>
                                 </section>
                                 </div>
                              </div>
                              <div  class="wizard clearfix">
                                 <div class="bx_rox123">
                                    <section>
                                       <div class="row">
                                          <div class="col-xs-12 col-sm-6">
                                             <div class="form-group clearfix">
                                                <label for="password"> Product Image</label>
                                                <div>
                                                   <div class="imgbx_btn" id="image_url">Image Upload</div>
                                                   <div class="_img_bx_disdata">
                                                      <input type="file" name="image_url" id="img_logo_file" class="btn btn-primary" style="display:none;" accept="image/*">
                                                      <div class="_imng_bx_dataset">
                                                         <div class="img_prod_bx-mn-lst">
                                                            <img src="<?= $prod_data->image_data; ?>" alt="Product Image" class="_com_src_log">
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </section>
                                 </div>
                              </div>
                        </form>
                        <div class="text-right">
                        <button class="btn btn-success waves-effect waves-light prod_upbtn">
                        <i class="fa fa-check"></i>
                        Update and Continue</button>  
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
                      <div class="_pro_loder_bx" style="display: none;">
               <div class="progress">
                  <div class="indeterminate"></div>
               </div>
            </div>
                  <div class="card-box">
                     <form id="PRODFRm_cnt">
                        <div class="_panel_hdnx">
                           <div class="_pnel_datavx">
                              <span class="span_titlebx">Product Listing</span>  
                              <a class="href_124bx" href="<?= $base_url;?>/product_listing?type=add-product">Add Product</a>
                              <div class="_rep_filter_bx"> 
                                 <div class="_dt_pckr_dbrd _depart_bx_123">
                                   
                                 </div>
                                 <span class="span_filter_option"> Filter by Category</span>
                                 <div class="_dt_pckr_dbrd _depart_bx_123">
                                 <select class="form-control category_data" name="category_data">
                                 <option value="">Select Category</option>
                                 <?php
                                  $get_result_data=$qisk_db->get_results("select * from prod_category"); 
                                  if($get_result_data!=NULL)
                                    {  
                                        foreach($get_result_data as $data)
                                        { 
                                            ?>
                                            <option value="<?= data_encode($data->category_uniqid,"encode");?>"><?= ucwords($data->category_name);?></option> 
                                            <?php
                                        }
                                  }
                                  ?> 
                                    </select>
                                 </div>
                                 <div class="_dt_pckr_dbrd _depart_bx_123">
                                    <input type="text" name="search_term" class="search_bx_filter product_search" placeholder="Search Anything">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </form>
                     <script> 
                        $(document).ready(function () {
                            $(window).scroll(function () {
                                /* paginate_blg */
                                if ($(".prod_list-main-bx").hasClass("_actv")) {
                                    var $prod_lst_bx = parseFloat($(".lst_bx458").innerHeight()) - parseFloat(300);
                                    if ($prod_lst_bx < $(window).scrollTop()) {
                                     _loadprod_list.pagin();
                                    }
                                }
                            });
                        });
                     </script>
                     <div class="prod_list-main-bx">
                        <script>
                           $(document).ready(function() {
                            _loadprod_list.init();
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