<?php
   global $qisk_db,$base_url,$url;
   if(isset($_SESSION['admin_unique_id']))
   {
      get_qisk_header(); 
      global $Ip_loc_data,$qisk_db;
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
      /* today sales amount */
     
      $date = get_date_time(NULL,$time_zone);
      $current_date = $date->format("Y-m-d"); 
      $date->createFromFormat('Y-m-d', $current_date); 
   if($_SESSION['login_type']=="super_admin")
   {
        $total_branch=0; 
        $total_stall=0;
        $total_user=0; 
        $total_student=0; 
        $get_branch_count=$qisk_db->get_results("select * from branch_listData ");
        if($get_branch_count!=NULL)
        { 
              $total_branch=count($get_branch_count); 
        }
        $get_stall_count=$qisk_db->get_results("select * from stall_listData ");
        if($get_stall_count!=NULL)
        { 
              $total_stall=count($get_stall_count); 
        }
        $get_user_count=$qisk_db->get_results("select * from smart_admin where user_role!='super_admin' ");
        if($get_user_count!=NULL)
        { 
              $total_user=count($get_user_count); 
        } 
        $get_student_count=$qisk_db->get_results("select * from smart_student_data ");
        if($get_student_count!=NULL)
        { 
              $total_student=count($get_student_count); 
        } 
    ?>
<div class="content-page">
   <!-- Start content -->
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-xl-12">
               <div class="page-title-box">
                  <h4 class="page-title float-left">Dashboard</h4>
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
         <!-- end row -->
         <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
               <div class="card-box tilebox-one">
                  <i class="icon-layers float-right text-muted"></i>
                  <h6 class="text-muted text-uppercase m-b-20">Total Branch</h6>
                  <h2 class="m-b-20" data-plugin="counterup"><?= $total_branch; ?></h2>
               </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
               <div class="card-box tilebox-one">
                  <i class="icon-paypal float-right text-muted"></i>
                  <h6 class="text-muted text-uppercase m-b-20">Total Stall</h6>
                  <h2 class="m-b-20"><span data-plugin="counterup"><?= $total_stall; ?></span></h2>
               </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
               <div class="card-box tilebox-one">
                  <i class="icon-chart float-right text-muted"></i>
                  <h6 class="text-muted text-uppercase m-b-20">Total User</h6>
                  <h2 class="m-b-20"><span data-plugin="counterup"><?= $total_user; ?></span></h2>
               </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
               <div class="card-box tilebox-one">
                  <i class="icon-chart float-right text-muted"></i>
                  <h6 class="text-muted text-uppercase m-b-20">Total Student</h6>
                  <h2 class="m-b-20"><span data-plugin="counterup"><?= $total_student; ?></span></h2>
               </div>
            </div>
         </div> 
         <div class="row">
            <div class="col-xs-12 col-lg-12 col-xl-12">
               <div class="card-box">
                  <h4 class="header-title m-t-0 m-b-30">Top 10 Student</h4>
                  <div class="table-responsive">
                     <table class="table table-bordered mb-0">
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>Branch Name</th>
                              <th>Student Name</th>
                              <th>Amount</th>
                              <th>Status</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              $check_data="";
                              if($_SESSION['login_type']!="super_admin")
                              { 
                                $check_data="and ref_user_uniqueid='".sql_quote_string($_SESSION['admin_unique_id'])."'";
                              } 
                              $get_student_data=$qisk_db->get_results("select sum(sales_amount) as sales_amount,sales_history.student_uniqueid,sales_history.branch_unique_id from sales_history where status=1 ".$check_data." GROUP by sales_history.student_uniqueid ");
                              if($get_student_data!=NULL)
                              {   
                                $i=1;
                                foreach($get_student_data as $student)
                                { 
                                    $student_data= get_student_data($student->student_uniqueid);
                                    $branch_data= get_branch_data($student->branch_unique_id);
                                    if($student_data->active_status==1)
                                    {
                                        $student_active="Active";
                                    }
                                    else
                                    {
                                        $student_active="Deactive";
                                    }
                              ?>
                           <tr>
                              <th class="text-muted"><?= $i;?> </th>
                              <td><?= $branch_data->branch_name." - ".$branch_data->branch_code;?></td>
                              <td><?= $student_data->stud_name." - ".$student_data->student_register_id;?></td>
                              <td><?= $student->sales_amount;?></td>
                              <td><span class="label label-success"><?= $student_active ;?></span></td>
                           </tr>
                           <?php
                              $i++;
                               }
                               }
                               else
                               {
                                   ?>
                           <tr>
                              <td colspan="5" class="_text_tbleemty">No Data Found</td>
                           </tr>
                           <?php 
                              }
                              ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-12 col-lg-12 col-xl-12">
               <div class="card-box">
                  <h4 class="header-title m-t-0 m-b-30">Top 10 Product</h4>
                  <div class="table-responsive">
                     <table class="table table-bordered mb-0">
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>Product Name</th>
                              <th>Quantity</th>
                              <th>Total Amount</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              $get_productdata=top_10_products(); 
                              if($get_productdata!=NULL)
                              {
                                  $i=1; 
                                  $sorted = array_orderby($get_productdata, 'selling_price', SORT_DESC, 'product_name', SORT_ASC);
                                  $new_array_prod = array_slice($sorted, 0, 10); 
                                  foreach($new_array_prod as $productdata)
                                  { 
                                     
                              ?>
                           <tr>
                              <th class="text-muted"><?= $i;?> </th>
                              <td><?= ucwords($productdata['product_name']);?></td>
                              <td><?= $productdata['quantity'];?></td>
                              <td><?= $productdata['selling_price'];?></td>
                           </tr>
                           <?php
                              $i++;
                               }
                               }
                               else
                               {
                                   ?>
                           <tr>
                              <td colspan="5" class="_text_tbleemty">No Data Found</td>
                           </tr>
                           <?php 
                              }
                              ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <!-- end col-->
         </div>
      </div>
      <!-- container -->
   </div>
   <!-- content -->
</div>
<?php
   }
   else
   {
      $card_amount=0; 
      $cash_amount=0;
      $machine_count=0;
      $cashier_count=0;$total_machine_count=0;$total_user_count=0;
      $get_today_amount=$qisk_db->get_results("select sum(sales_amount) as sales_amount from sales_history where status=1 ".$check_data." and DATE(sales_date)='".sql_quote_string($current_date)."' ");
      if($get_today_amount!=NULL)
      {
        if(!empty($get_today_amount[0]->sales_amount))
        {
            $card_amount=$get_today_amount[0]->sales_amount;
        }
      }
   
      $get_today_amount=$qisk_db->get_results("select sum(total_amount) as sales_amount from sales_cashdata where status=1 ".$check_data." and DATE(sales_date)='".sql_quote_string($current_date)."' ");
      if($get_today_amount!=NULL)
      {
        if(!empty($get_today_amount[0]->sales_amount))
        {
            $cash_amount=$get_today_amount[0]->sales_amount;
        }
      } 
       ?>
<div class="content-page">
   <!-- Start content -->
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-xl-12">
               <div class="page-title-box">
                  <h4 class="page-title float-left">Dashboard -Today Activities</h4>
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
               <div class="card-box tilebox-one">
                  <i class="icon-layers float-right text-muted"></i>
                  <h6 class="text-muted text-uppercase m-b-20">Card Amount</h6>
                  <h2 class="m-b-20" data-plugin="counterup"><?= $card_amount; ?></h2>
                  <span class="text-muted"></span>
               </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
               <div class="card-box tilebox-one">
                  <i class="icon-paypal float-right text-muted"></i>
                  <h6 class="text-muted text-uppercase m-b-20">Cash Amount</h6>
                  <h2 class="m-b-20"><span data-plugin="counterup"><?= $cash_amount; ?></span></h2>
                  <span class="text-muted"></span>
               </div>
            </div> 
         </div>
         <!-- end row -->
         <div class="row">
            <div class="col-xs-12 col-lg-12 col-xl-12">
               <div class="card-box">
                  <h4 class="header-title m-t-0 m-b-30">Top 10 Student</h4>
                  <div class="table-responsive">
                     <table class="table table-bordered mb-0">
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>Branch Name</th>
                              <th>Student Name</th>
                              <th>Amount</th>
                              <th>Status</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              $check_data="";
                              if($_SESSION['login_type']!="super_admin")
                              { 
                                $check_data="and ref_user_uniqueid='".sql_quote_string($_SESSION['admin_unique_id'])."'";
                              } 
                              $get_student_data=$qisk_db->get_results("select sum(sales_amount) as sales_amount,sales_history.student_uniqueid,sales_history.branch_unique_id from sales_history where status=1 ".$check_data." GROUP by sales_history.student_uniqueid ");
                              if($get_student_data!=NULL)
                              {   
                                $i=1;
                                foreach($get_student_data as $student)
                                { 
                                    $student_data= get_student_data($student->student_uniqueid);
                                    $branch_data= get_branch_data($student->branch_unique_id);
                                    if($student_data->active_status==1)
                                    {
                                        $student_active="Active";
                                    }
                                    else
                                    {
                                        $student_active="Deactive";
                                    }
                              ?>
                           <tr>
                              <th class="text-muted"><?= $i;?> </th>
                              <td><?= $branch_data->branch_name." - ".$branch_data->branch_code;?></td>
                              <td><?= $student_data->stud_name." - ".$student_data->student_register_id;?></td>
                              <td><?= $student->sales_amount;?></td>
                              <td><span class="label label-success"><?= $student_active ;?></span></td>
                           </tr>
                           <?php
                              $i++;
                               }
                               }
                               else
                               {
                                   ?>
                           <tr>
                              <td colspan="5" class="_text_tbleemty">No Data Found</td>
                           </tr>
                           <?php 
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
         <div class="row">
            <div class="col-xs-12 col-lg-12 col-xl-12">
               <div class="card-box">
                  <h4 class="header-title m-t-0 m-b-30">Top 10 Product</h4>
                  <div class="table-responsive">
                     <table class="table table-bordered mb-0">
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>Product Name</th>
                              <th>Quantity</th>
                              <th>Total Amount</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              $get_productdata=top_10_products(); 
                              if($get_productdata!=NULL)
                              {
                                  $i=1; 
                                  $sorted = array_orderby($get_productdata, 'selling_price', SORT_DESC, 'product_name', SORT_ASC);
                                  $new_array_prod = array_slice($sorted, 0, 10); 
                                  foreach($new_array_prod as $productdata)
                                  { 
                                     
                              ?>
                           <tr>
                              <th class="text-muted"><?= $i;?> </th>
                              <td><?= ucwords($productdata['product_name']);?></td>
                              <td><?= $productdata['quantity'];?></td>
                              <td><?= $productdata['selling_price'];?></td>
                           </tr>
                           <?php
                              $i++;
                               }
                               }
                               else
                               {
                                   ?>
                           <tr>
                              <td colspan="5" class="_text_tbleemty">No Data Found</td>
                           </tr>
                           <?php 
                              }
                              ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <!-- end col-->
         </div>
      </div>
      <!-- container -->
   </div>
   <!-- content -->
</div>
<?php
}   
get_qisk_footer();
}
else
{
header("Location:".$base_url."/login");
}