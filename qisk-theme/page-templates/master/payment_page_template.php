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
               <div class="card-box">
               <div class="_pro_loder_bx" style="display: none;"> <div class="progress"> <div class="indeterminate"></div> </div> </div>
                  <div class="_bx_cnval_124">
                  <form id="stud_FRm_data">
                     <div class="_panel_hdnx"> 
                           <div class="_pnel_datavx">
                              <span class="span_titlebx">
                                  <input type="hidden" name="display_type" value="<?= data_encode("payment","encode");?>" />
                              <?= ucwords("Student Card Setting");?> 
                              </span>    
                              <div class="filter_text_bx"> 
                                 <div class="_dt_pckr_dbrd _depart_bx_123 _select_drop">
                                    <input type="text" name="barcode" class="search_bx_filter barcode_search" placeholder="Scan barcode">
                                 </div>
                                 <div class="_dt_pckr_dbrd _depart_bx_123 _select_drop">
                                    <input type="text" name="search_term" class="search_bx_filter student_search" placeholder=" Searching Registration ID">
                                 </div>
                              </div>
                           </div>  
                     </div> 
                     <div class="main_bx1234">
                           <div class="disbx2 selctdropbx">
                              <select class="form-control" name="sortby">
                                 <?php
                                    $soryby=array("asc","desc");
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