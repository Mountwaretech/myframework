<?php
/*
Created by Bala murugan  M
Email: inventorbala@gmail.com
contact: 9524435595
Date : 07/12/2017 08:30: PM
*/
@session_start();
global $qisk_db, $base_url,$qisk_mail,$branch_data; 
if (isset($_POST['action']))
	{
	$action = sql_quote_string($_POST['action']);
	$date_format = new DateTime();
	$current_date_time = $date_format->format("Y-m-d h:i:s");
    switch($action)
    {
        case "category_adfunc": 
        if ($action == "category_adfunc")
        {
            $response = array(
                "current_status" => "error",
                "msg" => "some error occurred.Please try again later"
            );
            if (empty($_POST['category_data']))
                {
                $response = array(
                    "current_status" => "error",
                    "msg" => "Please enter category name"
                );
                }
              else
                {
                    $category_name = strtolower($_POST['category_data']);
                    $data_url_name=change_url_para($category_name);
                if (isset($_POST['data_uniqid']))
                    {
                        $category_uniqid = data_encode($_POST['data_uniqid'], "decode");
                        $get_cateData = $qisk_db->get_results("select * from prod_category where category_uniqid='" . sql_quote_string($category_uniqid) . "' ");
                        if($get_cateData!=NULL)
                        {
                            if (!empty($_FILES['image_url']['name']))
                            {  
                                $image_data = qisk_full_image_upload($_FILES['image_url'], "images/category");
                                $image_url=$image_data['image_url'];
                                $image_data=$image_data['image_data'];
                                $image_success = TRUE; 
                            }
                            else
                            {
                                if(!empty($get_cateData[0]->image_url))
                                {
                                    $image_url=$get_cateData[0]->image_url;
                                    $image_data=$get_cateData[0]->image_data;
                                    $image_success = TRUE;
                                }
                                else
                                {
                                    $image_url=NULL;
                                    $image_data=NULL;
                                    $image_success = TRUE; 
                                }
                            }
                        
                  
                    $exc_query = "update prod_category  set image_url='" . sql_quote_string($image_url) . "',image_data='" . sql_quote_string($image_data) . "', category_name='" . sql_quote_string($category_name) . "',category_url_name='" . sql_quote_string($data_url_name) . "',modify_date='" . sql_quote_string($current_date_time) . "' where category_uniqid='" . sql_quote_string($category_uniqid) . "' ";
                    $ins_new_user = $qisk_db->query($exc_query);
                    if ($ins_new_user)
                        {
                        $response = array(
                            "current_status" => "success",
                            "msg" => "Category Data updated successfully.",
                            "url" => $base_url . "/product_category"
                        );
                        }
                    }
                    }
                  else
                    { 
                    $check_data = $qisk_db->get_results("select * from  prod_category where LOWER(category_name)='" . sql_quote_string($category_name) . "' ");
                    if ($check_data == NULL)
                        { 	

                            if (!empty($_FILES['image_url']['name']))
                            {  
                                $image_data = qisk_full_image_upload($_FILES['image_url'], "images/category");
                                $image_url=$image_data['image_url'];
                                $image_data=$image_data['image_data'];
                                $image_success = TRUE; 
                            }
                            else
                            {
                                $image_url=NULL;
                                $image_data=NULL;
                                $image_success = TRUE;  
                            }
                            if($image_success)
                            { 
                        $insert_data = $qisk_db->query("insert into prod_category(ref_admin_uniqid,ref_branch_uniqueid,category_name,category_url_name,created_date)values('" . sql_quote_string($_SESSION['admin_unique_id']) . "','" . sql_quote_string($branch_data->branch_uniqueid) . "','" . sql_quote_string($category_name) . "','" . sql_quote_string($data_url_name) . "','" . sql_quote_string($current_date_time) . "')");
                        if ($insert_data != "")
                            {
                            $lastinsertid = $insert_data;
                            $category_uniqid = randomstring_num() . $lastinsertid;
                            $update_uniqid = $qisk_db->query("update prod_category set `category_uniqid`= '" . $category_uniqid . "' where category_id='" . $lastinsertid . "' ");
                            if ($update_uniqid) 
                                {
                                $response = array(
                                    "current_status" => "success",
                                    "msg" => "successfully added",
                                    "url" => $base_url . "/product_category"
                                );
                                }
                            }
                        }
                        }
                      else
                        {
                        $response = array(
                            "current_status" => "error",
                            "msg" => "Category already taken"
                        );
                        } 
                    }
                }
            echo json_encode($response);
        } 
        break;
        case "prod_add_func" :
        if($action=="prod_add_func")
        {
                $response = array(
                    "current_status" => "error",
                    "msg" => "Hey something went wrong. Try again or refresh this page"
                );
          
           if (empty($_POST['category_data']))
			{
                $response = array(
                    "current_status" => "error",
                    "msg" => "please select the product category"
                );
			}
            elseif (empty($_POST['product_name']))
			{
                $response = array(
                    "current_status" => "error",
                    "msg" => "please enter the product name"
                );
            }
            elseif (empty($_POST['product_code']))
			{
                $response = array(
                    "current_status" => "error",
                    "msg" => "please enter the product code"
                );
            }
            elseif (empty($_POST['actual_price']))
			{
                $response = array(
                    "current_status" => "error",
                    "msg" => "please enter the product actual price"
                );
            } 

            elseif (!preg_match('/^[0-9]+(?:.[0-9]{0,2})?$/', $_POST['actual_price'])) 
			{
                    $response = array(
                    "current_status" => "error",
                    "msg" => "please enter the valid product actual price"
                );
            }  
		   elseif (empty($_POST['selling_price']))
			{
                $response = array(
                    "current_status" => "error",
                    "msg" => "please enter the product selling price"
                );
            } 
            elseif (!preg_match('/^[0-9]+(?:.[0-9]{0,2})?$/', $_POST['selling_price'])) 
			{
                    $response = array(
                    "current_status" => "error",
                    "msg" => "please enter the valid product selling price"
                );
			} 
            elseif (empty($_POST['product_desc']))
			{
                $response = array(
                    "current_status" => "error",
                    "msg" => "please enter the product description"
                );
            } 
            else
            {
                $ref_category_uniqid=data_encode($_POST['category_data'],"decode");
                $product_name = sql_quote_string($_POST['product_name']);
                $data_url_name=change_url_para($product_name);
                $item_code = rand(111111, 999999);
                $product_code = sql_quote_string($_POST['product_code']);
                $selling_price = sql_quote_string($_POST['selling_price']);
                $actual_price = sql_quote_string($_POST['actual_price']);
                $prod_description = sql_quote_string($_POST['product_desc']); 
                if(isset($_POST['product_uniqueid']))
                {
                   $product_uniqueid=data_encode($_POST['product_uniqueid'],"decode");
                   $check_prod_name = $qisk_db->get_results("select * from product_data where ref_category_uniqid='" . sql_quote_string($ref_category_uniqid) . "' and  product_name='" . sql_quote_string($product_name) . "' and product_uniqueid!='".sql_quote_string($product_uniqueid)."' ");
                   if ($check_prod_name == NULL)
                   {
                           $prod_data=get_prod_data($product_uniqueid);     
                            if (!empty($_FILES['image_url']['name']))
                            { 
                             
                                if(!empty($prod_data->image_url))
                                {
                                    image_remove($prod_data->image_url);
                                } 
                                $image_data = qisk_full_image_upload($_FILES['image_url'], "images/product");
                                $image_url=$image_data['image_url'];
                                $image_data=$image_data['image_data'];
                                $image_success = TRUE; 
                            }
                            else
                            {
                                if(!empty($prod_data->image_url))
                                {
                                    $image_url=$prod_data->image_url;
                                    $image_data=$prod_data->image_data;
                                    $image_success = TRUE;
                                }
                                else
                                {
                                    $image_url=NULL;
                                    $image_data=NULL;
                                    $image_success = TRUE; 
                                } 
                        } 

                        $update_data=$qisk_db->query("update product_data set ref_category_uniqid='" . sql_quote_string($ref_category_uniqid) . "',product_name='" . sql_quote_string($product_name) . "',product_url_name='" . sql_quote_string($data_url_name) . "',product_code='" . sql_quote_string($product_code) . "',selling_price='" . sql_quote_string($selling_price) . "',actual_price='" . sql_quote_string($actual_price) . "',prod_description='" . sql_quote_string($prod_description) . "',image_url='" . sql_quote_string($image_url) . "',image_data='" . sql_quote_string($image_data) . "' where product_uniqueid='".sql_quote_string($product_uniqueid)."' ");
                        if($update_data)
                        {
                            $response = array(
                                "current_status" => "success",
                                "msg" => "product updated successfully",
                                "url" => $base_url . "/product_listing"
                            ); 
                        }
                   }
                   else
                   {
                        $response = array(
                            "current_status" => "error",
                            "msg" => "Already exist product name"
                        );
                   }

                }
                else
                { 
                  if (empty($_FILES['image_url']['name']))
                    {
                        $response = array(
                            "current_status" => "error",
                            "msg" => "please upload the product image"
                        );
                    }
                    else
                    {
                        $image_data = qisk_full_image_upload($_FILES['image_url'], "images/product");
                 
                        if($image_data!=NULL)
                        {
                            $image_url = $image_data['image_url'];
                            $image_data = $image_data['image_data'];
                        }
                        else
                        {
                            $image_url = "";
                            $image_data = "";
                        }    
                        $check_prod_name = $qisk_db->get_results("select * from product_data where product_data.ref_category_uniqid='" . sql_quote_string($ref_category_uniqid) . "' and  product_data.product_name='" . sql_quote_string($product_name) . "' and product_data.ref_branch_uniqueid ='".sql_quote_string($branch_data->branch_uniqueid)."' ");
                        if ($check_prod_name == NULL)
                        {
                            $insert_data = $qisk_db->query("insert into product_data(ref_admin_uniqid,ref_branch_uniqueid,type,ref_category_uniqid,product_name,product_url_name,product_code,item_code,prod_description,selling_price,actual_price,created_date,image_url,image_data)values('" . sql_quote_string($_SESSION['admin_unique_id']) . "','" . sql_quote_string($branch_data->branch_uniqueid) . "','product','" . sql_quote_string($ref_category_uniqid) . "','" . sql_quote_string($product_name) . "','" . sql_quote_string($data_url_name) . "','" . sql_quote_string($product_code) . "','" . sql_quote_string($item_code) . "', '" . sql_quote_string($prod_description) . "','" . sql_quote_string($selling_price) . "','" . sql_quote_string($actual_price) . "','" . sql_quote_string($current_date_time) . "','" . sql_quote_string($image_url) . "','" . sql_quote_string($image_data) . "')");
                            if(!empty($insert_data))
                            {
                                $lastinsertid = $insert_data;
                                $product_uniqueid = randomstring_num() . $lastinsertid;
                                $update_uniqid = $qisk_db->query("update product_data set `product_uniqueid`= '" . $product_uniqueid . "' where product_id='" . $lastinsertid . "' ");
                                if($update_uniqid)
                                {
                                    $response = array(
                                        "current_status" => "success",
                                        "msg" => "product added successfully",
                                        "url" => $base_url . "/product_listing"
                                    );
                                }
                            }
                        }
                        else
                        {
                            $response = array(
                                "current_status" => "error",
                                "msg" => "Already exist product name"
                            );
                        }
                    }
                    
                } 
            } 
            echo json_encode($response);
        }
        break; 
        case "prod_list_filter":
        if($action=="prod_list_filter")
        {
            $search_keyword = "";
            $search_query = "";
            $search_query_wrd = NULL;
            $search_join = "";
            $sorting = "";
            $search_filter = NULL;
            $search_terms = NULL;
            $get_product_list = NULL;
            $type_query = "";
            $value_data = "";
            $vendor_data="";
            if (isset($_POST['search_term']))
                {
                if ($_POST['search_term'] != "")
                    {
                    if (strlen($_POST['search_term']) >= 0)
                        {
                        $search_keyword = sql_quote_string($_POST['search_term']);
                        $search_word_array = preg_split("/[\s,]+/", $search_keyword);
                        if ($search_word_array != NULL)
                            {
                            foreach($search_word_array as $srch_words)
                                {
                                if (strlen($srch_words) >= 3)
                                    {
                                    $search_query_wrd[] = $srch_words;
                                    }
                                }
                            }
    
                        if ($search_query_wrd != NULL)
                            {
                            $search_keyword = implode("|", $search_query_wrd);
                            }
                        }
                    }
                }
    
                $data_limit=10;
                if(isset($_POST['limit']))
                {
                    $limit=" LIMIT ".$_POST['limit'].",".$data_limit;
                    $limitData=$_POST['limit'];
                }
                  else
                {
                  $limit=" LIMIT ".$data_limit; 
                   $limitData=0; 
                }

            if (isset($_POST['category_data']))
                {
                if (!empty($_POST['category_data']))
                    {
                        $ref_category_uniqid = data_encode($_POST['category_data'], "decode");
                        $search_query.= "and product_data.ref_category_uniqid='" . sql_quote_string($ref_category_uniqid) . "' ";
                    }
                }

                if ($search_keyword != "")
                    {
                    $search_query.= "and (product_data.product_name REGEXP '^" . $search_keyword . "' || product_data.product_code REGEXP '^" . $search_keyword . "' || product_data.item_code REGEXP '^" . $search_keyword . "'  || prod_category.category_name REGEXP '^" . $search_keyword . "'   )  ";
                    }
               
             $count_query = "select  count(product_uniqueid) as count_uniqid from product_data inner join prod_category on product_data.ref_category_uniqid=prod_category.category_uniqid where product_data.product_status=1 and product_data.ref_branch_uniqueid='".sql_quote_string($branch_data->branch_uniqueid)."'    " . $search_query . " " . $search_terms . " group by  product_data.product_id " . $sorting . " ORDER BY product_data.product_id DESC,product_data.product_name ASC";
            $total_user_count = $qisk_db->get_results($count_query);

    
                 $result_query = "select product_data.*,prod_category.category_name from product_data inner join prod_category on product_data.ref_category_uniqid=prod_category.category_uniqid where product_data.product_status=1 and product_data.ref_branch_uniqueid='".sql_quote_string($branch_data->branch_uniqueid)."'   " . $search_query . " " . $search_terms . " group by  product_data.product_id " . $sorting . " ORDER BY product_data.product_id DESC,product_data.product_name ASC " . $limit . " ";
            $get_resultdata = $qisk_db->get_results($result_query);
    
            displyproductboxData($get_resultdata);
            if($total_user_count!=NULL)
            {
            $total_user_count = intval($total_user_count[0]->count_uniqid);
            if ($total_user_count > 0)
                {
                $new_curr_count = count($get_resultdata) + intval($limitData);
                if ($get_resultdata != NULL)
                    {
                        ?>
                    <script>
                         _loadprod_list.data = {};
                         _loadprod_list.data.total_count = <?php echo $total_user_count; ?>;
                         _loadprod_list.data.curr_count = <?php echo $new_curr_count; ?>;
                    </script>
                    <?php
                    }
                }
              else
                {
                  ?>
                <script>
                    _loadprod_list.data = {};
                    _loadprod_list.data.total_count = 0;
                    _loadprod_list.data.curr_count = 0;
                </script>
                <?php
                }
            }
            }
        
            break;
            case "prod_status_change":
		if ($action == "prod_status_change")
			{
			$response = array(
				"current_status" => "error",
				"msg" => ucwords("some errors occurred!.please try again later")
			);
			if ($_POST['product_uniqueid'] != "")
				{
                    $product_uniqueid=data_encode($_POST['product_uniqueid'],"decode");
                    $prod_data=get_prod_data($product_uniqueid); 
				if ($prod_data->product_active == 1)
					{
					$update_data = $qisk_db->query("update product_data set product_active='0' where product_uniqueid='" . sql_quote_string($product_uniqueid) . "' ");
					$status = 1;
					}
				  else
					{
					$update_data = $qisk_db->query("update product_data set product_active='1' where product_uniqueid='" . sql_quote_string($product_uniqueid) . "' ");
					$status = 0;
					}
	
				if ($status == 1)
					{
					$response = array(
						"current_status" => "deactive",
						"msg" => ucwords("Deactivated successfully")
					);
					}
				  else
					{
					$response = array(
						"current_status" => "active",
						"msg" => ucwords("activated successfully")
					);
					}
				}
	
			echo json_encode($response);
			} 
        break;  
    }
}