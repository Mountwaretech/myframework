<?php
   global $base_url,$qisk_db; 
   if(isset($_SESSION['admin_unique_id'])) 
   {
       if(isset($_GET['data_type']))
       { 
           $data_type=trim($_GET['data_type']);
           $current_datetime=new DateTime();
            get_qisk_header();   
   ?> 
<style>
._panel_hdnx {display: none;}
.div_tlbx { display: block !important;}
.print_footer{display: block !important;}
</style>
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
                  if($data_type==trim("sir_entry"))
                  {
                     include "dom_action/sir_entry_reports.php";
                  }
                  if($data_type==trim("job_card"))
                  {
                      include "dom_action/job_card_reports.php";
                  }
                  if($data_type==trim("work_list"))
                  {
                      include "dom_action/worklist_reports.php";
                  }
                  if($data_type==trim("inspection"))
                  {
                      include "dom_action/inspection_reports.php";
                  }
                  if($data_type==trim("quality_audit"))
                  {
                      include "dom_action/quality_audit_reports.php";
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
<script> 
    window.onload=function (){
        generatePDF();
    }
</script>
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