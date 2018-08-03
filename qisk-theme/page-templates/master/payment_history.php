<?php
   global $base_url,$qisk_db,$qisk;
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
                  <div class="_panel_hdnx">
                     <div class="_pnel_datavx"> 
                     <span class="span_titlebx">
                              <a href="<?= $base_url; ?>/card_setting"> <span class="zmdi zmdi-arrow-left _icn_ze"></span></a>
                              <?= ucwords("Payment History");?>
                              </span>   
                       
                     </div>
                  </div>
                  <table id="datatable" class="table table-striped">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Date & Time</th> 
                           <th>Amount</th>
                           <th>Debit</th> 
                           <th>Credit</th> 
                        </tr>
                     </thead>
                     <tbody> 
                        <?php
                         global $Ip_loc_data;
                         $time_zone=NULL;
                             if($Ip_loc_data!=NULL)
                             {
                                 if(isset($Ip_loc_data->loc_data))
                                 {
                                     if(isset($Ip_loc_data->loc_data->time_zone))
                                     {
                                     $time_zone=$Ip_loc_data->loc_data->time_zone;
                                     }
                                 }
                             } 
                           $student_unique_id=data_encode($_GET['student_unique_id'],"decode");
                           $get_result_data=$qisk_db->get_results("select * from payment_history where ref_student_uniqueid='".sql_quote_string($student_unique_id)."' "); 
                           if($get_result_data!=NULL)
                           {

                               $i=1;
                            foreach($get_result_data as $data)
                            { 

                                $start_date_time = get_date_time($data->added_date,$time_zone); 
                                $start_date = $start_date_time->format("M d,Y h:iA");
                              ?>  
                        <tr>
                           <td> <?= $i; ?> </td> 
                           <td> <?= $start_date; ?> </td> 
                           <td><?= $data->payment;?></td>  
                           <td>
                           <?php
                            if($data->type=="debit")
                            {
                                ?>
                                Debit
                                <?php
                            }
                            else
                            {
                                ?>
                               ---
                                <?php
                            }
                            ?>
                            </td>

                             <td>
                           <?php
                            if($data->type=="credit")
                            {
                                ?>
                                Credit
                                <?php
                            }
                            else
                            {
                                ?>
                                ---
                                <?php
                            }
                            ?>
                            </td> 
                        </tr>
                        <?php
                        $i++;
                           } 
                           }
                           ?> 
                     </tbody> 
                  </table> 
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
