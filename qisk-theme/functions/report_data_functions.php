<?php
function _date_rangepicker()
{
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
 $label_data=data_encode($labeldata,"decode");
 $date = get_date_time(NULL,$time_zone);
 $current_date = $date->format("Y-m-d");
 $date->createFromFormat('Y-m-d', $current_date);

 /* Dateset in fucntion */
 $date = get_date_time(NULL,$time_zone);
 $date->sub(new DateInterval('P1D'));
 $yesterday_date = $date->format('Y-m-d');

 /* Last & days Date */
 $date = get_date_time(NULL,$time_zone);
 $date->sub(new DateInterval('P6D'));
 $last7days_date = $date->format('Y-m-d');

 /* Last 30 Days Date */
 $date = get_date_time(NULL,$time_zone);
 $date->sub(new DateInterval('P29D'));
 $last30days_date = $date->format('Y-m-d');

 /* last month start date and end date */
 $lastmnt_start = get_date_time('first day of last month',$time_zone);
 $lastmonth_start = $lastmnt_start->format("Y-m-d");
 $lastmnt_end = get_date_time('last day of last month',$time_zone);
 $lastmonth_end = $lastmnt_end->format("Y-m-d");

 /* Current month startDate to EndDate */
 $thismnt_start =get_date_time('first day of this month' ,$time_zone);
 $thismonth_start = $thismnt_start->format("Y-m-d");
 $thismnt_end = get_date_time('last day of this month' ,$time_zone);
 $thismonth_end = $thismnt_end->format("Y-m-d");

 $daterange[]=array("label"=>"Today","from_date"=>$current_date,"to_date"=>$current_date);
 $daterange[]=array("label"=>"Yesterday","from_date"=>$yesterday_date,"to_date"=>$yesterday_date);
 $daterange[]=array("label"=>"Last 7 Days","from_date"=>$last7days_date,"to_date"=>$current_date);
 $daterange[]=array("label"=>"Last 30 Days","from_date"=>$last30days_date,"to_date"=>$current_date);
 $daterange[]=array("label"=>"This Month","from_date"=>$thismonth_start,"to_date"=>$thismonth_end);
 $daterange[]=array("label"=>"Last Month","from_date"=>$lastmonth_start,"to_date"=>$lastmonth_end);
 return $daterange; 
}


function job_card_data($ref_job_uniqid,$qisk_db)
{
    $jobcarddata=NULL; 
    $get_result_data=$qisk_db->get_results("select * from job_card_data where job_uniqid='".sql_quote_string($ref_job_uniqid)."' ");
    if($get_result_data!=NULL)
    {
        $jobcarddata=$get_result_data[0];
    }
    return $jobcarddata;
}

function _payment_dataset($get_results_data,$qisk_db)
{
    global $Ip_loc_data,$base_url,$qisk_db;
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
    ?>
        <table id="example" class="display dataTable no-footer" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>No</th> 
            <th>Date & Time</th>
            <th>Student Name</th>
            <th>Student register id</th>
            <th>Amount</th>
            <th>Payment Type</th>  
        </tr>
        </thead>
        <tbody>
        <?php
            if($get_results_data!=NULL)
            {
                $i=1;
                foreach($get_results_data as $dataset)
                { 
                    $created_date_time = get_date_time($dataset->added_date,$time_zone);
                    $created_date = $created_date_time->format("j-m-Y g:i A"); 
                    $student_data=get_student_data($dataset->ref_student_uniqueid)
                    ?>
        <tr>
            <td><?= $i; ?></td>
            <td> 
            <?= $created_date; ?>   
            </td>  
            <td><?= $student_data->stud_name; ?></td>
            <td><?= $student_data->student_register_id; ?></td>
            <td><?= $dataset->payment; ?></td>
            <td>
               <?= ucwords($dataset->type); ?>           
            </td> 
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



function _sales_dataset($get_results_data,$qisk_db)
{
    global $Ip_loc_data,$base_url,$qisk_db;
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
    ?>
        <table id="example" class="display dataTable no-footer" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>No</th> 
            <th>Date & Time</th>
            <th>Branch</th>
            <th>Student Name</th>
            <th>Student register id</th>
            <th>Amount</th> 
        </tr>
        </thead>
        <tbody>
        <?php
            if($get_results_data!=NULL)
            {
                $i=1;
                foreach($get_results_data as $dataset)
                { 
                    $created_date_time = get_date_time($dataset->added_date,$time_zone);
                    $created_date = $created_date_time->format("j-m-Y g:i A"); 
                    $student_data=get_student_data($dataset->student_uniqueid);
                    $branch_data=get_branch_data($dataset->branch_unique_id)
                    ?>
        <tr class="_page_ur_link" data-href="<?= $base_url;?>/reports_management?data_type=sales_payments&sales_uniqueid=<?= data_encode($dataset->sales_uniqueid,"encode") ?>"> 
            <td><?= $i; ?></td>
            <td> 
            <?= $created_date; ?>   
            </td>  
            <td><?= $branch_data->branch_name." - ".$branch_data->branch_code; ?></td>
            <td><?= $student_data->stud_name; ?></td>
            <td><?= $student_data->student_register_id; ?></td>
            <td><?= $dataset->sales_amount; ?></td> 
             
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


function _sales_cash_dataset($get_results_data,$qisk_db)
{
    global $Ip_loc_data,$base_url,$qisk_db;
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
    ?>
        <table id="example" class="display dataTable no-footer" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>No</th> 
            <th>Date & Time</th> 
            <th>Amount</th> 
        </tr>
        </thead>
        <tbody>
        <?php
            if($get_results_data!=NULL)
            {
                $i=1;
                foreach($get_results_data as $dataset)
                { 
                    $created_date_time = get_date_time($dataset->sales_date,$time_zone);
                    $created_date = $created_date_time->format("j-m-Y g:i A");  
                    ?>
        <tr class="_page_ur_link" data-href="<?= $base_url;?>/reports_management?data_type=sales_cash&sales_uniqueid=<?= data_encode($dataset->sales_uniqueid,"encode") ?>"> 
            <td><?= $i; ?></td>
            <td> 
            <?= $created_date; ?>   
            </td>   
            <td><?= $dataset->total_amount; ?></td> 
             
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



function sales_productdata($get_results_data,$qisk_db)
{
    global $Ip_loc_data,$base_url,$qisk_db;
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
        $product_data=json_decode($get_results_data->sales_data); 
    ?>
        <table id="example" class="display dataTable no-footer" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>No</th> 
            <th>Product Name</th>
            <th>Selling Price</th>
            <th>Quantity</th> 
        </tr>
        </thead>
        <tbody>
        <?php
            if($product_data!=NULL)
            {
                $i=1;
                foreach($product_data as $dataset)
                { 
                  
                    ?>
              <tr> 
            <td><?= $i; ?></td>  
            <td><?= $dataset->product_name; ?></td>
            <td><?= $dataset->selling_price; ?></td>
            <td><?= $dataset->quantity; ?></td> 
             
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


function sales_cas_productdata($get_results_data,$qisk_db)
{
    global $base_url,$qisk_db; 
    $product_data=json_decode($get_results_data->product_data); 
    ?>
        <table id="example" class="display dataTable no-footer" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>No</th> 
            <th>Product Name</th>
            <th>Selling Price</th>
            <th>Quantity</th> 
        </tr>
        </thead>
        <tbody>
        <?php
            if($product_data!=NULL)
            {
                $i=1;
                foreach($product_data as $dataset)
                { 
                  
                    ?>
              <tr> 
            <td><?= $i; ?></td>  
            <td><?= $dataset->product_name; ?></td>
            <td><?= $dataset->selling_price; ?></td>
            <td><?= $dataset->quantity; ?></td> 
             
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


