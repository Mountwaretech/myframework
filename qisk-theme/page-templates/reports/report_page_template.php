<?php
   global $base_url,$qisk_db,$branch_data; 
   if(isset($_SESSION['admin_unique_id'])) 
   {
       if(isset($_GET['data_type']))
       { 
           $data_type=trim($_GET['data_type']);
           $current_datetime=new DateTime();
            get_qisk_header();   
   ?> 

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script> 
<script src="http://kendo.cdn.telerik.com/2016.3.914/js/kendo.all.min.js"></script>  
<div class="main_cntbx">
<div class="content-page">
<!-- Start content --> 
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="card-box" style="min-height:600px;"> 
               <?php
                  if($data_type==trim("student_payment"))
                  {
                     include "dom_action/payment_reports.php";
                  }
                  if($data_type==trim("sales_payments"))
                  {
                      include "dom_action/sales_payment_reports.php";
                  } 
                  if($data_type==trim("sales_cash"))
                  {
                     include "dom_action/sales_cash_reports.php";
                  }
                   ?> 
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
header("Location:".$base_url."");  
}
}
else
{
header("Location:".$base_url."/login");  
}