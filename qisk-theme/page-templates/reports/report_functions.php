<?php
global $qisk_mail,$base_url, $qisk_db,$branch_data;
@session_start();
/*product cart to databasr;*/

if (isset($_POST['action']))
	{
	$action = $_POST['action'];
	switch ($action)
		{ 
            case "report_filter_machine":
            if($action=="report_filter_machine")
            {
               $data_val=data_encode($_POST['data_val'],"decode");
               $get_result_data=$qisk_db->get_results("select * from terminal_data where ref_branch_uniqueid='".sql_quote_string($data_val)."'  "); 
               if($get_result_data!=NULL)
                 {  
                     ?>
                       <option value="">Select Machine Code</option>
                     <?php
                     foreach($get_result_data as $data)
                     { 
                         ?>
            <option value="<?= data_encode($data->terminal_uniqueid,"encode");?>"><?= $data->terminal_code;?></option>
            <?php
               }
               }
               else
               {
                   ?>
                   <option value="">Machine No data found</option>
                   <?php
               }
            }
            
            break;
            case "filterBrch_Cashier":
            if($action=="filterBrch_Cashier")
            {
               $data_val=data_encode($_POST['data_val'],"decode");
               $get_result_data=$qisk_db->get_results("select * from smart_admin where ref_branch_uniqueid='".sql_quote_string($data_val)."' and user_role='cashier' "); 
               if($get_result_data!=NULL)
                 {  
                    ?>
                    <option value="">Select Cashier Name</option>
                  <?php
                     foreach($get_result_data as $data)
                     { 
                         ?>
            <option value="<?= data_encode($data->user_unique_id,"encode");?>"><?= ucwords($data->first_name. " -".$data->last_name);?></option>
            <?php
               }
               }
               else
               {
                   ?>
                   <option value="">Cashier No data found</option>
                   <?php
               }
            }

            break;
            case "_load_report_func":
            if ($action == "_load_report_func")
			{

                $search_join="";
                $search_query="";
                $search_keyword = ""; 
                $search_query_wrd = NULL; 
                $sorting = "";
                $search_filter = NULL;
                $search_terms = NULL;
                $data_type=data_encode($_POST['data_type'],"decode");
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
            

                if($data_type=="student_payment")
                {
                    $from_date=new DateTime($_POST['from_date']);
                    $to_date=new DateTime($_POST['to_date']);

                    if(isset($_POST['branch_data']))
                    {
                        if(!empty($_POST['branch_data']))
                        {
                            $branch_uniqueid=data_encode($_POST['branch_data'],"decode");
                            $search_query.="and payment_history.branch_unique_id='".sql_quote_string($branch_uniqueid)."' ";
                        }
                    }  

                     $set_query="select payment_history.* from payment_history
                    ".$search_join."  
                        where (DATE(payment_history.added_date)>='".sql_quote_string($from_date->format("Y-m-d"))."' and DATE(payment_history.added_date)<='".sql_quote_string($to_date->format("Y-m-d"))."')  ".$search_query." GROUP by payment_history.payment_id  order by payment_history.added_date ASC ";
                    $get_result_data=$qisk_db->get_results($set_query);
                    _payment_dataset($get_result_data,$qisk_db);
 
                } 

                if($data_type=="sales_payments")
                {
                   
                        if(isset($_POST['branch_data']))
                        {
                            if(!empty($_POST['branch_data']))
                            {
                                $branch_uniqueid=data_encode($_POST['branch_data'],"decode");
                                $search_query.="and sales_history.branch_unique_id='".sql_quote_string($branch_uniqueid)."' ";
                            }
                        } 
                        
                        if(isset($_POST['cashier_data']))
                        {
                            if(!empty($_POST['cashier_data']))
                            {
                                $ref_user_uniqueid=data_encode($_POST['cashier_data'],"decode");
                                $search_query.="and sales_history.ref_user_uniqueid='".sql_quote_string($ref_user_uniqueid)."' ";
                            }
                        }  
                        $from_date=new DateTime($_POST['from_date']);
                        $to_date=new DateTime($_POST['to_date']);
    
                        $search_join.="inner join smart_student_data on sales_history.student_uniqueid=smart_student_data.student_unique_id";

                         $set_query="select sales_history.* from sales_history
                        ".$search_join."  
                            where (DATE(sales_history.sales_date)>='".sql_quote_string($from_date->format("Y-m-d"))."' and DATE(sales_history.sales_date)<='".sql_quote_string($to_date->format("Y-m-d"))."')  ".$search_query." GROUP by sales_history.sales_id  order by sales_history.sales_date ASC ";
                        $get_result_data=$qisk_db->get_results($set_query);
                        _sales_dataset($get_result_data,$qisk_db);
 
                } 

                if($data_type=="sales_cash")
                { 
                        if(isset($_POST['user_data']))
                        {
                            if(!empty($_POST['user_data']))
                            {
                                $ref_user_uniqueid=data_encode($_POST['user_data'],"decode");
                                $search_query.="and sales_cashdata.ref_user_uniqueid='".sql_quote_string($ref_user_uniqueid)."' ";
                            }
                        }  
                        $from_date=new DateTime($_POST['from_date']);
                        $to_date=new DateTime($_POST['to_date']);
    
                       
                         $set_query="select sales_cashdata.* from sales_cashdata
                        ".$search_join."  
                            where (DATE(sales_cashdata.sales_date)>='".sql_quote_string($from_date->format("Y-m-d"))."' and DATE(sales_cashdata.sales_date)<='".sql_quote_string($to_date->format("Y-m-d"))."')  ".$search_query." GROUP by sales_cashdata.sales_id  order by sales_cashdata.sales_date ASC ";
                        $get_result_data=$qisk_db->get_results($set_query);
                        _sales_cash_dataset($get_result_data,$qisk_db);
 
                } 
                
            }
            break;
            case "sales_prod_data":
            if($action=="sales_prod_data")
            {
             
               $sales_uniqueid=data_encode($_POST['sales_uniqueid'],"decode"); 
               $get_result_data=$qisk_db->get_results("select * from sales_history where sales_uniqueid='".sql_quote_string($sales_uniqueid)."' "); 
               sales_productdata($get_result_data[0],$qisk_db);
 
            }

            break; 
            case "sales_cash_prod_data":
            if($action=="sales_cash_prod_data")
            {
             
               $sales_uniqueid=data_encode($_POST['sales_uniqueid'],"decode"); 
               $get_result_data=$qisk_db->get_results("select * from sales_cashdata where sales_uniqueid='".sql_quote_string($sales_uniqueid)."' "); 
               sales_cas_productdata($get_result_data[0],$qisk_db); 
            }
            break;
            
        }
    }