<?php  
function top_10_products()
{
    global $base_url,$url,$qisk_db,$image_url; 
    $check_data="";
    if($_SESSION['login_type']!="super_admin")
    { 
        $check_data="and ref_user_uniqueid='".sql_quote_string($_SESSION['admin_unique_id'])."'";
    } 
    $get_student_data=$qisk_db->get_results("select sales_history.sales_data as productData from sales_history where status=1 ".$check_data." GROUP by sales_history.sales_uniqueid ");
    if($get_student_data!=NULL)
    {
        foreach($get_student_data as $product)
        {
            $productdataset=json_decode($product->productData);
             foreach($productdataset as $currentProd)
             {
                $product_ids[]=$currentProd->product_uniqueid;
                $produc_data[$currentProd->product_uniqueid]=$currentProd;
             }
        }
    }
    if($produc_data!=NULL)
    {
        foreach($produc_data as $prodHeys=>$producData)
        {
            if(in_array($prodHeys,$product_ids))
            {
                if(isset($new_prodarray[$prodHeys]))
                {
                    $new_prodarray[$prodHeys]['selling_price'] = $new_prodarray[$prodHeys]['selling_price'] + $producData->selling_price;
                    $new_prodarray[$prodHeys]['quantity'] = $new_prodarray[$prodHeys]['quantity'] + $producData->quantity;
                }
                else
                {
                    $new_prodarray[$prodHeys] = array(
                        "quantity"=>$producData->quantity,
                        "selling_price"=>$producData->selling_price,
                        "product_name"=>$producData->product_name
                    );
                }
               
            }
            
        } 

        if($new_prodarray!=NULL)
        {
            foreach($new_prodarray as $newData)
            {
              $new_array[]=$newData;
            }
        }
    }
    return $new_array;
}


function array_orderby()
{
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
            $args[$n] = $tmp;
            }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}


function get_prod_data($product_uniqueid)
{
     global $base_url,$url,$qisk_db,$image_url;
     $produc_data=NULL; 
       $get_data_results=$qisk_db->get_results("select * from product_data
 where product_uniqueid='".sql_quote_string($product_uniqueid)."' ");
     if($get_data_results!=NULL)
     {
        $produc_data= $get_data_results[0]; 
        if(empty($produc_data->image_url))
        {
           $produc_data->image_data=$image_url->get_url("userImage");
        } 
     } 
    return $produc_data;
}


function displyproductboxData($get_resultdata)
{
    global $qisk_db,$base_url,$image_url;
    if($get_resultdata!=NULL)
    { 
        $i=1;
        foreach ($get_resultdata as $row) 
        {
            if(empty($row->image_data))
            {
                $image_urls=$image_url->get_url("userImage"); 
            }
            else
            {
                $image_urls=$row->image_data;
            }
    ?>
 <div class="adv-table<?php echo data_encode($row->user_unique_id, "encode"); ?> lst_bx458" >
       <div class="_user_img_bx">
          <div class="img_bx_dipy">
             <img src="<?php echo $image_urls; ?>" alt="img" class="user_img_src" style="<?= pic_size_css($image_url);?>"> 
          </div>
       </div> 
          <div class="_user_det_bx">
                 <div class="_name_bx _padbx_123"> 
                     <?php echo ucwords($row->product_name); ?> 
                     <span class="empltype_bx"><?php echo ucwords($row->product_code); ?></span> 
                 </div> 
                 <div class="_name_bx _padbx_123"> 
                    Category : <span><?= ucwords($row->category_name);?></span>
                   
                 </div>  
                 <div class="price_bx"> 			
                    <span class="price-new">   <?php echo $row->selling_price; ?></span> 
                    <span class="price-old">    <?php echo $row->actual_price; ?></span> 
                    </div>
             <div class="_act_bx_visble _padbx_123"> 
                <a class="cust_href_link" href="<?php echo $base_url; ?>/product_listing?type=edit-product&product_uniqueid=<?php echo data_encode($row->product_uniqueid, "encode"); ?>">Edit info</a>  
                <a class="cust_href_link remove_bx" data-val="<?= data_encode(json_encode(array("product",$row->product_uniqueid)),"encode"); ?>" >Remove</a> 
                <?php 
            if ($row->product_active == 1)
                {
                    $status_label = "Activated";
                    $stats_cls = "act";
                }
            else
                {
                    $status_label = "Deactivated";
                    $stats_cls = "red";
                } 
              ?>
          <a class="cust_href_link prod_stuschge <?php echo $stats_cls; ?>" data-val="<?php echo data_encode($row->product_uniqueid, "encode"); ?>"><?php echo $status_label; ?></a>
             </div>
             </div>
          </div> 
 </div>
 </div>
 <?php
$i++;
} 
}
else
{
?>
<div class="prod_assign_itm_bx">
<div class="empt-prod-lbl">
  No Data Found 
</div>
</div>
<?php
}
}