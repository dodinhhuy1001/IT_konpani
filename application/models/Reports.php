<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class reports extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //Count report
    public function count_stock_report()
    {
        $this->db->select("a.product_name,a.product_id,a.cartoon_quantity,a.price,a.product_model,sum(b.quantity) as 'totalSalesQnty',(select sum(product_purchase_details.quantity) from product_purchase_details where product_id= `a`.`product_id`) as 'totalBuyQnty'");
        $this->db->from('product_information a');
        $this->db->join('invoice_details b','b.product_id = a.product_id');
        $this->db->where(array('a.status'=>1,'b.status'=>1));
        $this->db->group_by('a.product_id');
        $query = $this->db->get();      
        return $query->num_rows();

    }
        //Out of stock
    public function out_of_stock(){

      $this->db->select("a.unit,a.product_name,a.product_id,a.price,a.product_model,(select sum(quantity) from invoice_details where product_id= `a`.`product_id`) as 'totalSalesQnty',(select sum(quantity) from product_purchase_details where product_id= `a`.`product_id`) as 'totalBuyQnty'");
        $this->db->from('product_information a');
        $this->db->where(array('a.status' => 1));
        $this->db->group_by('a.product_id');
        $query = $this->db->get();
         $result = $query->result_array();
         $stock = [];
         $i = 0;
         foreach ($result as $stockproduct) {
            $stokqty = $stockproduct['totalBuyQnty']-$stockproduct['totalSalesQnty'];
            if($stokqty < 10){

             $stock[$i]['stock']         = $stockproduct['totalBuyQnty']-$stockproduct['totalSalesQnty'];
             $stock[$i]['product_id']    = $stockproduct['product_id'];
             $stock[$i]['product_name']  = $stockproduct['product_name'];
             $stock[$i]['product_model'] = $stockproduct['product_model'];
             $stock[$i]['unit']          = $stockproduct['unit'];
         }
             $i++;
         }
        return $stock;
    }


    public function getStockOutList($postData=null){
         $response = array();
         ## Read value
         $draw = $postData['draw'];
         $start = $postData['start'];
         $rowperpage = $postData['length']; // Rows display per page
         $columnIndex = $postData['order'][0]['column']; // Column index
         $columnName = $postData['columns'][$columnIndex]['data']; // Column name
         $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
         $searchValue = $postData['search']['value']; // Search value

         ## Search 
         $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (a.product_name like '%".$searchValue."%' or b.manufacturer_name like '%".$searchValue."%') ";
         }

         ## Total number of records without filtering
         $this->db->select("count(*) as allcount,((select ifnull(sum(quantity),0) from product_purchase_details where product_id= `a`.`product_id`)-(select ifnull(sum(quantity),0) from invoice_details where product_id= `a`.`product_id`)) as 'stock'");
         $this->db->from('product_information a');
         $this->db->join('manufacturer_information b','b.manufacturer_id=a.manufacturer_id','left');
          if($searchValue != ''){
         $this->db->where($searchQuery);
     }
         $this->db->having('stock < 10');
         $this->db->group_by('a.product_id');
         $totalRecords = $this->db->get()->num_rows();

         ## Total number of record with filtering
         $this->db->select("count(*) as allcount,((select ifnull(sum(quantity),0) from product_purchase_details where product_id= `a`.`product_id`)-(select ifnull(sum(quantity),0) from invoice_details where product_id= `a`.`product_id`)) as 'stock'");
         $this->db->from('product_information a');
          $this->db->join('manufacturer_information b','b.manufacturer_id=a.manufacturer_id','left');
         if($searchValue != ''){
         $this->db->where($searchQuery);
     }
         $this->db->having('stock < 10');
         $this->db->group_by('a.product_id');
         $totalRecordwithFilter = $this->db->get()->num_rows();

         ## Fetch records
         $this->db->select("b.manufacturer_name,a.product_name,a.generic_name,a.strength,((select ifnull(sum(quantity),0) from product_purchase_details where product_id= `a`.`product_id`)-(select ifnull(sum(quantity),0) from invoice_details where product_id= `a`.`product_id`)) as 'stock'");
         $this->db->from('product_information a');
          $this->db->join('manufacturer_information b','b.manufacturer_id=a.manufacturer_id','left');
         if($searchValue != ''){
         $this->db->where($searchQuery);
     }
         $this->db->having('stock < 10');
         $this->db->group_by('a.product_id');
         $this->db->order_by($columnName, $columnSortOrder);
         $this->db->limit($rowperpage, $start);
         $records = $this->db->get()->result();
         $data = array();
         $sl =1;
         foreach($records as $record ){
            $data[] = array( 
                'sl'               =>  $sl,
                'product_name'     =>  $record->product_name.'('.$record->strength.')',
                'manufacturer_name'=>  $record->manufacturer_name,
                'generic_name'     =>  $record->generic_name,
                'stock'            =>  $record->stock,
            ); 
            $sl++;
         }

         ## Response
         $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecordwithFilter,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
         );

         return $response; 
    }

        public function stock_csv_file()
    {
        $this->db->select("a.product_id,
                a.product_name,
                a.product_model,
                 a.price,
                a.manufacturer_price
                ");
        $this->db->from('product_information a');
        $query = $this->db->get();
        $stok_report = $query->result_array();
        
         $i = 1;
        foreach($stok_report as $k=>$v){$i++;
                $stockin = $this->db->select('sum(quantity) as totalSalesQnty')->from('invoice_details')->where('product_id',$stok_report[$k]['product_id'])->get()->row();
                $stockout = $this->db->select('sum(quantity) as totalPurchaseQnty')->from('product_purchase_details')->where('product_id',$stok_report[$k]['product_id'])->get()->row();
                
             $stok_report[$k]['totalPurchaseQnty'] = $stockout->totalPurchaseQnty;  
              $stok_report[$k]['totalSalesQnty'] = $stockin->totalSalesQnty;
             $stok_report[$k]['stok_quantity_cartoon'] = ($stockout->totalPurchaseQnty-$stockin->totalSalesQnty);
              $stok_report[$k]['purchase_total']=$stok_report[$k]['stok_quantity_cartoon']*$stok_report[$k]['manufacturer_price'];
               
                  $stok_report[$k]['total_sale_price']=$stok_report[$k]['stok_quantity_cartoon']*$stok_report[$k]['price'];
                
             


            }
            return $stok_report;
        
    }   

        public function count_stock_report_bydate()
    {   
        $this->db->select("a.*,
                a.product_name,
                a.product_id,
                a.product_model,
                a.manufacturer_price
                ");
        $this->db->from('product_information a');
    
        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
    }




        public function getExpireList($postData=null){
         $date=date('Y-m-d');
         $response = array();
         
         ## Read value
         $draw = $postData['draw'];
         $start = $postData['start'];
         $rowperpage = $postData['length']; // Rows display per page
         $columnIndex = $postData['order'][0]['column']; // Column index
         $columnName = $postData['columns'][$columnIndex]['data']; // Column name
         $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
         $searchValue = $postData['search']['value']; // Search value

         ## Search 
         $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (a.product_name like '%".$searchValue."%' or b.batch_id like '%".$searchValue."%' or b.expeire_date like'%".$searchValue."%') ";
         }

         ## Total number of records without filtering
         $this->db->select("count(*) as allcount,((select ifnull(sum(quantity),0) from product_purchase_details where product_id= `a`.`product_id`)-(select ifnull(sum(quantity),0) from invoice_details where product_id= `a`.`product_id`)) as 'stock'");
         $this->db->from('product_information a');
         $this->db->join('product_purchase_details b','b.product_id=a.product_id','left');
          if($searchValue != ''){
         $this->db->where($searchQuery);
     }
         $this->db->where('b.expeire_date <=', $date);
         $this->db->having('stock > 0');
         $this->db->group_by('b.batch_id');
         $this->db->group_by('a.product_id');
         $totalRecords = $this->db->get()->num_rows();

         ## Total number of record with filtering
         $this->db->select("count(*) as allcount,((select ifnull(sum(quantity),0) from product_purchase_details where product_id= `a`.`product_id`)-(select ifnull(sum(quantity),0) from invoice_details where product_id= `a`.`product_id`)) as 'stock'");
         $this->db->from('product_information a');
          $this->db->join('product_purchase_details b','b.product_id=a.product_id','left');
         if($searchValue != ''){
         $this->db->where($searchQuery);
     }
         $this->db->where('b.expeire_date <=', $date);
         $this->db->having('stock > 0');
         $this->db->group_by('b.batch_id');
         $this->db->group_by('a.product_id');
         $totalRecordwithFilter = $this->db->get()->num_rows();

         ## Fetch records
         $this->db->select("b.*,a.product_name,a.strength,((select ifnull(sum(quantity),0) from product_purchase_details where product_id= `a`.`product_id`)-(select ifnull(sum(quantity),0) from invoice_details where product_id= `a`.`product_id`)) as 'stock'");
         $this->db->from('product_information a');
         $this->db->join('product_purchase_details b','b.product_id=a.product_id','left');
         if($searchValue != ''){
         $this->db->where($searchQuery);
     }
         $this->db->where('b.expeire_date <=', $date);
         $this->db->having('stock > 0');
         $this->db->group_by('b.batch_id');
         $this->db->group_by('a.product_id');
         $this->db->order_by($columnName, $columnSortOrder);
         $this->db->limit($rowperpage, $start);
         $records = $this->db->get()->result();
         $data = array();
         $sl =1;
        $base_url = base_url();
         foreach($records as $record ){
            $medicine_name = '<a href="'.$base_url.'Cproduct/product_details/'.$record->product_id.'" class="" data-toggle="tooltip" data-placement="left" >'.$record->product_name.'('.$record->strength.')'.'</a>';
            $data[] = array( 
                'sl'               =>  $sl,
                'product_id'       =>  $medicine_name,
                'batch_id'         =>  $record->batch_id,
                'expeire_date'     =>  $record->expeire_date,
                'stock'            =>  $record->stock,
            ); 
            $sl++;
         }

         ## Response
         $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecordwithFilter,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
         );

         return $response; 
    }


    //Out of stock count
    public function out_of_stock_count(){

    
  $this->db->select("b.manufacturer_name,a.product_name,a.generic_name,a.strength,((select ifnull(sum(quantity),0) from product_purchase_details where product_id= `a`.`product_id`)-(select ifnull(sum(quantity),0) from invoice_details where product_id= `a`.`product_id`)) as 'stock'");
       $this->db->from('product_information a');
       $this->db->join('manufacturer_information b','b.manufacturer_id=a.manufacturer_id','left');
         $this->db->having('stock < 10');
         $this->db->group_by('a.product_id');
         return $records = $this->db->get()->num_rows();


    }
    // out of date count
    public function out_of_date_count(){

          $date=date('Y-m-d');
         $this->db->select("b.*,a.product_name,a.strength,((select ifnull(sum(quantity),0) from product_purchase_details where product_id= `a`.`product_id`)-(select ifnull(sum(quantity),0) from invoice_details where product_id= `a`.`product_id`)) as 'stock'");
         $this->db->from('product_information a');
         $this->db->join('product_purchase_details b','b.product_id=a.product_id','left');
         $this->db->where('b.expeire_date <=', $date);
         $this->db->having('stock > 0');
         $this->db->group_by('b.batch_id');
         $this->db->group_by('a.product_id');
        return $records = $this->db->get()->num_rows();


    }
    //Retrieve Single Item Stock Stock Report
    public function stock_report($limit,$page)
    {
    
        $this->db->select("a.product_name,a.product_id,a.cartoon_quantity,a.price,a.product_model,sum(b.quantity) as 'totalSalesQnty',(select sum(product_purchase_details.quantity) from product_purchase_details where product_id= `a`.`product_id`) as 'totalBuyQnty'");
        $this->db->from('product_information a');
        $this->db->join('invoice_details b','b.product_id = a.product_id');
        $this->db->where(array('a.status'=>1,'b.status'=>1));
        $this->db->group_by('a.product_id');
        $this->db->order_by('a.product_id','desc');
        $this->db->limit($limit, $page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }
    //Retrieve Single Item Stock Stock Report
    public function stock_report_single_item($product_id){
        $this->db->select("a.product_name,a.cartoon_quantity,a.price,a.product_model,sum(b.quantity) as 'totalSalesQnty',sum(c.quantity) as 'totalBuyQnty'");
        $this->db->from('product_information a');
        $this->db->join('invoice_details b','b.product_id = a.product_id');
        $this->db->join('product_purchase_details c','c.product_id = a.product_id');
        $this->db->where(array('a.product_id'=>$product_id,'a.status'=>1,'b.status'=>1));
        $this->db->group_by('a.product_id');
        $this->db->order_by('a.product_id','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }

    //Stock Report by date
public function stock_report_bydate($product_id,$date,$limit,$page)
    {   
        $this->db->select("a.*,
                a.product_name,
                a.product_id,
                a.product_model,
                a.manufacturer_price
                ");
        $this->db->from('product_information a');
    
        if(empty($product_id))
        {
            $this->db->where(array('a.status'=>1));
        }
        else
        {
            //Single product information 
            $this->db->where(array('a.status'=>1,'a.product_id'=>$product_id)); 
        }
        

        $this->db->limit($limit, $page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }
    public function totalnumberof_product(){

        $this->db->select("a.*,
                a.product_name,
                a.product_id,
                a.product_model,
                a.manufacturer_price
                ");
        $this->db->from('product_information a');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;

    }


    public function getCheckList($postData=null){

         $response = array();

         ## Read value
         $draw = $postData['draw'];
         $start = $postData['start'];
         $rowperpage = $postData['length']; // Rows display per page
         $columnIndex = $postData['order'][0]['column']; // Column index
         $columnName = $postData['columns'][$columnIndex]['data']; // Column name
         $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
         $searchValue = $postData['search']['value']; // Search value

         ## Search 
         $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (a.product_name like '%".$searchValue."%' or a.product_model like '%".$searchValue."%' or a.price like'%".$searchValue."%' or a.manufacturer_price like'%".$searchValue."%' or m.manufacturer_name like'%".$searchValue."%') ";
         }

         ## Total number of records without filtering
         $this->db->select('count(*) as allcount');
         $this->db->from('product_information a');
         $this->db->join('manufacturer_information m','m.manufacturer_id = a.manufacturer_id','left');
          if($searchValue != '')
         $this->db->where($searchQuery);
         $records = $this->db->get()->result();
         $totalRecords = $records[0]->allcount;

         ## Total number of record with filtering
         $this->db->select('count(*) as allcount');
         $this->db->from('product_information a');
         $this->db->join('manufacturer_information m','m.manufacturer_id = a.manufacturer_id','left');
         if($searchValue != '')
            $this->db->where($searchQuery);
         $records = $this->db->get()->result();
         $totalRecordwithFilter = $records[0]->allcount;

         ## Fetch records
         $this->db->select("a.*,
                a.product_name,
                a.product_id,
                a.product_model,
                a.manufacturer_price,
                m.manufacturer_name
                ");
         $this->db->from('product_information a');
         $this->db->join('manufacturer_information m','m.manufacturer_id = a.manufacturer_id','left');
         if($searchValue != '')
         $this->db->where($searchQuery);
         $this->db->order_by($columnName, $columnSortOrder);
         $this->db->limit($rowperpage, $start);
         $records = $this->db->get()->result();
         $data = array();
         $sl =1;
         $base_url = base_url();
         foreach($records as $record ){
          $stockin = $this->db->select('sum(quantity) as totalSalesQnty')->from('invoice_details')->where('product_id',$record->product_id)->get()->row();
         $stockout = $this->db->select('sum(quantity) as totalPurchaseQnty')->from('product_purchase_details')->where('product_id',$record->product_id)->get()->row();
             $medicine_name = '<a href="'.$base_url.'Cproduct/product_details/'.$record->product_id.'" class="" data-toggle="tooltip" data-placement="left" >'.$record->product_name.'('.$record->strength.')'.'</a>';
               
            $data[] = array( 
                'sl'            =>   $sl,
                'product_name'  =>  $medicine_name,
                'manufacturer_name'=> $record->manufacturer_name,
                'product_model' =>  $record->product_model,
                'sales_price'   =>  $record->price,
                'purchase_p'    =>  $record->manufacturer_price,
                'totalPurchaseQnty'=>$stockout->totalPurchaseQnty,
                'totalSalesQnty'=>  $stockin->totalSalesQnty,
                'stok_quantity' =>  $stockout->totalPurchaseQnty-$stockin->totalSalesQnty,
                'total_sale_price'=> ($stockout->totalPurchaseQnty-$stockin->totalSalesQnty)*$record->price,
                'purchase_total' =>  ($stockout->totalPurchaseQnty-$stockin->totalSalesQnty)*$record->manufacturer_price,
            ); 
            $sl++;
         }

         ## Response
         $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecordwithFilter,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
         );

         return $response; 
    }
    //Stock report manufacturer by date
    public function stock_report_manufacturer_bydate($product_id=null,$manufacturer_id=null,$date=null,$perpage=null,$page=null){

        $this->db->select("*");
        $this->db->from('product_information ');
        $this->db->limit($perpage,$page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }
// manufacturer stock report id wise
    public function stock_report_manufacturer_byid($manufacturer_id=null,$date=null,$perpage=null,$page=null){

        $this->db->select("*");
        $this->db->from('product_information');
        $this->db->where('manufacturer_id',$manufacturer_id);
        
        $this->db->limit($perpage,$page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }
    //Counter of unique product histor which has been affected
    public function product_counter_by_manufacturer($manufacturer_id)
    {       
        $this->db->select('DISTINCT(a.product_id)');  
        $this->db->from('product_information a');
            if(!empty($manufacturer_id))
            {$this->db->where('a.manufacturer_id =',$manufacturer_id);  }
        $query=$this->db->get(); 
        return $query->num_rows();
    }



    //Counter of unique product histor which has been affected
    public function product_counter($product_id)
    {       
        $this->db->select('DISTINCT(product_id)');  
        $this->db->from('product_information');
            if(!empty($product_id))
            {$this->db->where('product_id =',$product_id);  }
        $query=$this->db->get(); 
        return $query->num_rows();
    }

    //Retrieve todays_total_sales_report
    public function todays_total_sales_report()
    {
        $today = date('Y-m-d');
        $this->db->select('sum(total_amount) as total_sale');
        $this->db->from('invoice');
        $this->db->where('date',$today);
        $this->db->group_by('date');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;


    }
    // total purchase info
        public function todays_total_purchase()
    {
        $today = date('Y-m-d');
        $this->db->select('sum(grand_total_amount) as total_purchase');
        $this->db->from('product_purchase');
        $this->db->where('purchase_date',$today);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }       

    // todays sales product
    public function todays_sale_product(){
        $today = date('Y-m-d');
        $this->db->select("c.product_name,c.price");
        $this->db->from('invoice a');
        $this->db->join('invoice_details b','b.invoice_id = a.invoice_id');
        $this->db->join('product_information c','c.product_id = b.product_id');
        $this->db->order_by('a.date','desc');
        $this->db->where('a.date',$today);
        $this->db->limit('3');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }
    
    //Retrieve todays_sales_report
    public function todays_sales_report($per_page,$page)
    {
        $today = date('Y-m-d');
        $this->db->select("a.*,b.customer_id,b.customer_name");
        $this->db->from('invoice a');
        $this->db->join('customer_information b','b.customer_id = a.customer_id');
        $this->db->where('a.date',$today);
        $this->db->limit($per_page,$page);
        $this->db->order_by('a.invoice_id','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }   

    //Retrieve todays_sales_report_count
    public function todays_sales_report_count()
    {
        $today = date('Y-m-d');
        $this->db->select("a.*,b.customer_id,b.customer_name");
        $this->db->from('invoice a');
        $this->db->join('customer_information b','b.customer_id = a.customer_id');
        $this->db->where('a.date',$today);
        $this->db->order_by('a.invoice_id','desc');
        $query = $this->db->get();  
        return $query->num_rows();
    }   

    //Retrieve todays_purchase_report
    public function todays_purchase_report($per_page=null,$page=null)
    {
        $today = date('Y-m-d');
        $this->db->select("a.*,b.manufacturer_id,b.manufacturer_name");
        $this->db->from('product_purchase a');
        $this->db->join('manufacturer_information b','b.manufacturer_id = a.manufacturer_id');
        $this->db->where('a.purchase_date',$today);
        $this->db->order_by('a.purchase_id','desc');
        $this->db->limit($per_page,$page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }

    //Retrieve todays_purchase_report count
    public function todays_purchase_report_count()
    {
        $today = date('Y-m-d');
        $this->db->select("a.*,b.manufacturer_id,b.manufacturer_name");
        $this->db->from('product_purchase a');
        $this->db->join('manufacturer_information b','b.manufacturer_id = a.manufacturer_id');
        $this->db->where('a.purchase_date',$today);
        $this->db->order_by('a.purchase_id','desc');
        $this->db->limit('500');
        $query = $this->db->get();  
        return $query->num_rows();
    }

    //Total profit report
    public function total_profit_report($perpage,$page){

        $this->db->select("a.date,a.invoice,b.invoice_id,
            CAST(sum(total_price) AS DECIMAL(16,2)) as total_sale");
        $this->db->select('CAST(sum(`quantity`*`manufacturer_rate`) AS DECIMAL(16,2)) as total_manufacturer_rate', FALSE);
        $this->db->select("CAST(SUM(total_price) - SUM(`quantity`*`manufacturer_rate`) AS DECIMAL(16,2)) AS total_profit");
        $this->db->from('invoice a');
        $this->db->join('invoice_details b','b.invoice_id = a.invoice_id');
        $this->db->group_by('b.invoice_id');
        $this->db->order_by('a.invoice','desc');
        $this->db->limit($perpage,$page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }
    //Total profit report
    public function total_profit_report_count(){

        $this->db->select("a.date,a.invoice,b.invoice_id,sum(total_price) as total_sale");
        $this->db->select('sum(`quantity`*`manufacturer_rate`) as total_manufacturer_rate', FALSE);
        $this->db->select("(SUM(total_price) - SUM(`quantity`*`manufacturer_rate`)) AS total_profit");
        $this->db->from('invoice a');
        $this->db->join('invoice_details b','b.invoice_id = a.invoice_id');
        $this->db->group_by('b.invoice_id');
        $this->db->order_by('a.invoice','desc');
        $query = $this->db->get();
        return $query->num_rows();
    }




    //Retrieve all Report
    public function retrieve_dateWise_SalesReports($start_date,$end_date)
    {
        $dateRange = "a.date BETWEEN '$start_date%' AND '$end_date%'";
        
        $this->db->select("a.*,b.customer_id,b.customer_name");
        $this->db->from('invoice a');
        $this->db->join('customer_information b','b.customer_id = a.customer_id');
        $this->db->where($dateRange, NULL, FALSE);  
        $this->db->order_by('a.date','desc');
        $this->db->limit('500');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }
    //Retrieve all Report
    public function retrieve_dateWise_PurchaseReports($start_date,$end_date)
    {
        $dateRange = "a.purchase_date BETWEEN '$start_date%' AND '$end_date%'";
        
        $this->db->select("a.*,b.manufacturer_id,b.manufacturer_name");
        $this->db->from('product_purchase a');
        $this->db->join('manufacturer_information b','b.manufacturer_id = a.manufacturer_id');
        $this->db->where($dateRange, NULL, FALSE);  
        $this->db->order_by('a.purchase_date','desc');
        $this->db->limit('500');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }
    //Retrieve date wise profit report
    public function retrieve_dateWise_profit_report($start_date,$end_date,$per_page,$page)
    {
        $this->db->select("a.date,a.invoice,b.invoice_id,
            CAST(sum(total_price) AS DECIMAL(16,2)) as total_sale");
        $this->db->select('CAST(sum(`quantity`*`manufacturer_rate`) AS DECIMAL(16,2)) as total_manufacturer_rate', FALSE);
        $this->db->select("CAST(SUM(total_price) - SUM(`quantity`*`manufacturer_rate`) AS DECIMAL(16,2)) AS total_profit");

        $this->db->from('invoice a');
        $this->db->join('invoice_details b','b.invoice_id = a.invoice_id');
        $this->db->where('a.date >=', $start_date); 
        $this->db->where('a.date <=', $end_date); 

        $this->db->group_by('b.invoice_id');
        $this->db->order_by('a.invoice','desc');
        $this->db->limit($per_page,$page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }   
    //Retrieve date wise profit report
    public function retrieve_dateWise_profit_report_count($start_date,$end_date)
    {
        
        $this->db->select("a.date,a.invoice,b.invoice_id,sum(total_price) as total_sale");
        $this->db->select('sum(`quantity`*`manufacturer_rate`) as total_manufacturer_rate', FALSE);
        $this->db->select("(SUM(total_price) - SUM(`quantity`*`manufacturer_rate`)) AS total_profit");

        $this->db->from('invoice a');
        $this->db->join('invoice_details b','b.invoice_id = a.invoice_id');
        $this->db->where('a.date >=', $start_date); 
        $this->db->where('a.date <=', $end_date); 

        $this->db->group_by('b.invoice_id');
        $this->db->order_by('a.invoice','desc');
        $query = $this->db->get();
        return $query->num_rows();
    }
    //Product wise sales report
    public function product_wise_report()
    {
        $today = date('Y-m-d');
        $this->db->select("a.*,b.customer_id,b.customer_name");
        $this->db->from('invoice a');
        $this->db->join('customer_information b','b.customer_id = a.customer_id');
        $this->db->where('a.date',$today);
        $this->db->order_by('a.invoice_id','desc');
        $this->db->limit('500');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }
    //RETRIEVE DATE WISE SINGE PRODUCT REPORT
    public function retrieve_product_sales_report($perpage,$page)
    {
        $this->db->select("a.*,b.product_name,b.product_model,c.date,c.total_amount,d.customer_name");
        $this->db->from('invoice_details a');
        $this->db->join('product_information b','b.product_id = a.product_id');
        $this->db->join('invoice c','c.invoice_id = a.invoice_id');
        $this->db->join('customer_information d','d.customer_id = c.customer_id');
        $this->db->order_by('c.date','desc');
        $this->db->limit($perpage,$page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }   
    //RETRIEVE DATE WISE SINGE PRODUCT REPORT
    public function retrieve_product_sales_report_count()
    {
        $this->db->select("a.*,b.product_name,b.product_model,c.date,c.total_amount,d.customer_name");
        $this->db->from('invoice_details a');
        $this->db->join('product_information b','b.product_id = a.product_id');
        $this->db->join('invoice c','c.invoice_id = a.invoice_id');
        $this->db->join('customer_information d','d.customer_id = c.customer_id');
        $this->db->order_by('c.date','desc');
        $query = $this->db->get();  
        return $query->num_rows();
    }
    //RETRIEVE DATE WISE SEARCH SINGLE PRODUCT REPORT
    public function retrieve_product_search_sales_report( $start_date,$end_date )
    {
        $dateRange = "c.date BETWEEN '$start_date%' AND '$end_date%'";
        $this->db->select("a.*,b.product_name,b.product_model,c.date,d.customer_name");
        $this->db->from('invoice_details a');
        $this->db->join('product_information b','b.product_id = a.product_id');
        $this->db->join('invoice c','c.invoice_id = a.invoice_id');
        $this->db->join('customer_information d','d.customer_id = c.customer_id');
        $this->db->where($dateRange, NULL, FALSE); 
        $this->db->order_by('c.date','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }   
    //RETRIEVE DATE WISE SEARCH SINGLE PRODUCT REPORT
    public function retrieve_product_search_sales_report_count( $start_date,$end_date )
    {
        $dateRange = "c.date BETWEEN '$start_date%' AND '$end_date%'";
        $this->db->select("a.*,b.product_name,b.product_model,c.date,d.customer_name");
        $this->db->from('invoice_details a');
        $this->db->join('product_information b','b.product_id = a.product_id');
        $this->db->join('invoice c','c.invoice_id = a.invoice_id');
        $this->db->join('customer_information d','d.customer_id = c.customer_id');
        $this->db->where($dateRange, NULL, FALSE); 
        $this->db->order_by('c.date','desc');
        $query = $this->db->get();  
        return $query->num_rows();
    }

    //Retrieve company Edit Data
    public function retrieve_company()
    {
        $this->db->select('*');
        $this->db->from('company_information');
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }
    //

    // stock report batch wise 

public function stock_report_batch_bydate($perpage,$page){

        
        $this->db->select("b.*,
                sum(b.sell) as 'totalSalesQnty',
                sum(b.Purchase) as 'totalPurchaseQnty',
                b.batch_id
                ");
        $this->db->from('view_k_stock_batch_qty b');
        $this->db->group_by('b.batch_id');
        $this->db->group_by('b.product_id');
        $this->db->limit($perpage,$page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }


    public function getCheckBatchStock($postData=null){

         $response = array();

         ## Read value
         $draw = $postData['draw'];
         $start = $postData['start'];
         $rowperpage = $postData['length']; // Rows display per page
         $columnIndex = $postData['order'][0]['column']; // Column index
         $columnName = $postData['columns'][$columnIndex]['data']; // Column name
         $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
         $searchValue = $postData['search']['value']; // Search value

         ## Search 
         $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (m.product_name like '%".$searchValue."%' or a.batch_id like '%".$searchValue."%' or a.expeire_date like'%".$searchValue."%') ";
         }

         ## Total number of records without filtering
         $this->db->select('count(*) as allcount');
         $this->db->from('product_purchase_details a');
         $this->db->join('product_information m','m.product_id = a.product_id','left');
          if($searchValue != '')
         $this->db->where($searchQuery);
         $this->db->group_by('a.batch_id');
         $this->db->group_by('a.product_id');
         $totalRecords = $this->db->get()->num_rows();

         ## Total number of record with filtering
         $this->db->select('count(*) as allcount');
         $this->db->from('product_purchase_details a');
         $this->db->join('product_information m','m.product_id = a.product_id','left');
         if($searchValue != '')
         $this->db->where($searchQuery);
         $this->db->group_by('a.batch_id');
         $this->db->group_by('a.product_id');
         $totalRecordwithFilter = $this->db->get()->num_rows();

         ## Fetch records
         $this->db->select("a.*,
                m.product_name,
                m.strength,
                ");
         $this->db->from('product_purchase_details a');
         $this->db->join('product_information m','m.product_id = a.product_id','left');
         if($searchValue != '')
         $this->db->where($searchQuery);
         $this->db->group_by('a.batch_id');
         $this->db->group_by('a.product_id');
         $this->db->order_by($columnName, $columnSortOrder);
         $this->db->limit($rowperpage, $start);
         $records = $this->db->get()->result();
         $data = array();
         $sl =1;
         $base_url = base_url();
         foreach($records as $record ){
          $stockout = $this->db->select('sum(quantity) as totalSalesQnty')->from('invoice_details')->where('product_id',$record->product_id)->where('batch_id',$record->batch_id)->get()->row();
         $stockin = $this->db->select('sum(quantity) as totalPurchaseQnty')->from('product_purchase_details')->where('product_id',$record->product_id)->where('batch_id',$record->batch_id)->get()->row();
          $medicine_name = '<a href="'.$base_url.'Cproduct/product_details/'.$record->product_id.'" class="" data-toggle="tooltip" data-placement="left" >'.$record->product_name.'('.$record->strength.')'.'</a>';
            
               
            $data[] = array( 
                'sl'               =>   $sl,
                'product_name'     =>  $medicine_name,
                'strength'         =>  $record->strength,
                'batch_id'         =>  $record->batch_id,
                'expeire_date'     =>  $record->expeire_date,
                'inqty'            =>  (!empty($stockin->totalPurchaseQnty)?$stockin->totalPurchaseQnty:0),
                'outqty'           =>  (!empty($stockout->totalSalesQnty)?$stockout->totalSalesQnty:0),
                'stock'            =>  (!empty($stockin->totalPurchaseQnty)?$stockin->totalPurchaseQnty:0)-(!empty($stockout->totalSalesQnty)?$stockout->totalSalesQnty:0),
                
            ); 
            $sl++;
         }

         ## Response
         $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecordwithFilter,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
         );

         return $response; 
    }

    // count batch stock
     public function stock_report_batch_count(){

        $this->db->select("b.*,
                sum(b.sell) as 'totalSalesQnty',
                sum(b.Purchase) as 'totalPurchaseQnty',
                b.batch_id
                ");
        $this->db->from('view_k_stock_batch_qty b');
        $this->db->group_by('b.batch_id');
         $query = $this->db->get();     
        return $query->num_rows();
     }

    
    //profit report manufacturer wise purchse
     public function profit_report_manufacturer($manufacturer_id,$from_date,$to_date){
        $this->db->select("
                AVG(a.rate) as avg_r,
                sum(a.quantity) as quantity
                ");
        $this->db->from('product_purchase_details a');
        $this->db->join('product_information b','b.product_id = a.product_id');
        $this->db->join('product_purchase c','c.purchase_id = a.purchase_id');
        $this->db->where('b.manufacturer_id',$manufacturer_id);
        $this->db->where('c.purchase_date >=', $from_date); 
        $this->db->where('c.purchase_date <=', $to_date); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }

    //profit report manufacturer wise purchse
     public function profit_report_manufacturer_sale($manufacturer_id,$from_date,$to_date){
        $this->db->select("
                AVG(a.rate) as avg_r,
                sum(a.quantity) as quantity
                ");
        $this->db->from('invoice_details a');
        $this->db->join('product_information b','b.product_id = a.product_id');
        $this->db->join('invoice c','c.invoice_id = a.invoice_id');
        $this->db->where('b.manufacturer_id',$manufacturer_id);
        $this->db->where('c.date >=', $from_date); 
        $this->db->where('c.date <=', $to_date); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }

    //profit report manufacturer wise purchse
     public function profit_report_productwise($product_id,$from_date,$to_date){
        $this->db->select("
                AVG(a.rate) as avg_r,
                sum(a.quantity) as quantity
                ");
        $this->db->from('product_purchase_details a');
        $this->db->join('product_purchase c','c.purchase_id = a.purchase_id');
        $this->db->where('a.product_id',$product_id);
        $this->db->where('c.purchase_date >=', $from_date); 
        $this->db->where('c.purchase_date <=', $to_date); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }

    //profit report product wise purchse
     public function profit_report_product_salesss($product_id,$from_date,$to_date){
        $this->db->select("
                AVG(a.rate) as avg_r,
                sum(a.quantity) as quantity
                ");
        $this->db->from('invoice_details a');
        $this->db->join('invoice c','a.invoice_id = c.invoice_id');
        $this->db->where('a.product_id',$product_id);
        $this->db->where('c.date >=', $from_date); 
        $this->db->where('c.date <=', $to_date); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
    }
        // chart information invoice data
public function inv_jan(){
  $month=1;
  $year=date('Y');
  $this->db->select('SUM(total_amount) as invoice_amount');
  $this->db->from('invoice');
  $this->db->where(array('MONTH(date)='=>$month,'YEAR(date)='=>$year));
 $query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->invoice_amount;  
        }
        return 0;

    }
    public function inv_feb(){
  $month=2;
  $year=date('Y');
  $this->db->select('SUM(total_amount) as invoice_amount');
  $this->db->from('invoice');
  $this->db->where(array('MONTH(date)='=>$month,'YEAR(date)='=>$year));
 $query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->invoice_amount;  
        }
        return 0;

    }
    public function inv_mar(){
  $month=3;
  $year=date('Y');
  $this->db->select('SUM(total_amount) as invoice_amount');
  $this->db->from('invoice');
  $this->db->where(array('MONTH(date)='=>$month,'YEAR(date)='=>$year));
  $query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->invoice_amount;  
        }
        return 0;

    }
 public function inv_apr(){
  $month=4;
  $year=date('Y');
  $this->db->select('SUM(total_amount) as invoice_amount');
  $this->db->from('invoice');
  $this->db->where(array('MONTH(date)='=>$month,'YEAR(date)='=>$year));
$query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->invoice_amount;  
        }
        return 0;

    }
 public function inv_may(){
  $month=5;
  $year=date('Y');
  $this->db->select('SUM(total_amount) as invoice_amount');
  $this->db->from('invoice');
  $this->db->where(array('MONTH(date)='=>$month,'YEAR(date)='=>$year));
  $query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->invoice_amount;  
        }
        return 0;

    }
     public function inv_jun(){
  $month=6;
  $year=date('Y');
  $this->db->select('SUM(total_amount) as invoice_amount');
  $this->db->from('invoice');
  $this->db->where(array('MONTH(date)='=>$month,'YEAR(date)='=>$year));
$query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->invoice_amount;  
        }
        return 0;

    }
     public function inv_jul(){
  $month=7;
  $year=date('Y');
  $this->db->select('SUM(total_amount) as invoice_amount');
  $this->db->from('invoice');
  $this->db->where(array('MONTH(date)='=>$month,'YEAR(date)='=>$year));
$query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->invoice_amount;  
        }
        return 0;

    }
     public function inv_aug(){
  $month=8;
  $year=date('Y');
  $this->db->select('SUM(total_amount) as invoice_amount');
  $this->db->from('invoice');
  $this->db->where(array('MONTH(date)='=>$month,'YEAR(date)='=>$year));
  $query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->invoice_amount;  
        }
        return 0;

    }
     public function inv_sep(){
  $month=9;
  $year=date('Y');
  $this->db->select('SUM(total_amount) as invoice_amount');
  $this->db->from('invoice');
  $this->db->where(array('MONTH(date)='=>$month,'YEAR(date)='=>$year));
 $query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->invoice_amount;  
        }
        return 0;

    }
     public function inv_oct(){
  $month=10;
  $year=date('Y');
  $this->db->select('SUM(total_amount) as invoice_amount');
  $this->db->from('invoice');
  $this->db->where(array('MONTH(date)='=>$month,'YEAR(date)='=>$year));
  $query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->invoice_amount;  
        }
        return 0;

    }
     public function inv_nov(){
  $month=11;
  $year=date('Y');
  $this->db->select('SUM(total_amount) as invoice_amount');
  $this->db->from('invoice');
  $this->db->where(array('MONTH(date)='=>$month,'YEAR(date)='=>$year));
  $query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->invoice_amount;  
        }
        return 0;

    }
     public function inv_dec(){
  $month=12;
  $year=date('Y');
  $this->db->select('SUM(total_amount) as invoice_amount');
  $this->db->from('invoice');
  $this->db->where(array('MONTH(date)='=>$month,'YEAR(date)='=>$year));
  $query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->invoice_amount;  
        }
        return 0;

    }
//purchase chart data
    public function pur_jan(){
  $month=1;
  $year=date('Y');
  $this->db->select('SUM(grand_total_amount) as purchase_amount');
  $this->db->from('product_purchase');
  $this->db->where(array('MONTH(purchase_date)='=>$month,'YEAR(purchase_date)='=>$year));
    $query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->purchase_amount;  
        }
        return 0;

    }
    public function pur_feb(){
  $month=2;
  $year=date('Y');
  $this->db->select('SUM(grand_total_amount) as purchase_amount');
  $this->db->from('product_purchase');
  $this->db->where(array('MONTH(purchase_date)='=>$month,'YEAR(purchase_date)='=>$year));
 $query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->purchase_amount;  
        }
        return 0;

    }
    public function pur_mar(){
  $month=3;
  $year=date('Y');
  $this->db->select('SUM(grand_total_amount) as purchase_amount');
  $this->db->from('product_purchase');
  $this->db->where(array('MONTH(purchase_date)='=>$month,'YEAR(purchase_date)='=>$year));
 $query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->purchase_amount;  
        }
        return 0;

    }
 public function pur_apr(){
  $month=4;
  $year=date('Y');
  $this->db->select('SUM(grand_total_amount) as purchase_amount');
  $this->db->from('product_purchase');
  $this->db->where(array('MONTH(purchase_date)='=>$month,'YEAR(purchase_date)='=>$year));
 $query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->purchase_amount;  
        }
        return 0;

    }
 public function pur_may(){
  $month=5;
  $year=date('Y');
  $this->db->select('SUM(grand_total_amount) as purchase_amount');
  $this->db->from('product_purchase');
  $this->db->where(array('MONTH(purchase_date)='=>$month,'YEAR(purchase_date)='=>$year));
  $query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->purchase_amount;  
        }
        return 0;

    }
     public function pur_jun(){
  $month=6;
  $year=date('Y');
  $this->db->select('SUM(grand_total_amount) as purchase_amount');
  $this->db->from('product_purchase');
  $this->db->where(array('MONTH(purchase_date)='=>$month,'YEAR(purchase_date)='=>$year));
  $query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->purchase_amount;  
        }
        return 0;

    }
     public function pur_jul(){
  $month=7;
  $year=date('Y');
  $this->db->select('SUM(grand_total_amount) as purchase_amount');
  $this->db->from('product_purchase');
  $this->db->where(array('MONTH(purchase_date)='=>$month,'YEAR(purchase_date)='=>$year));
  $query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->purchase_amount;  
        }
        return 0;

    }
     public function pur_aug(){
  $month=8;
  $year=date('Y');
  $this->db->select('SUM(grand_total_amount) as purchase_amount');
  $this->db->from('product_purchase');
  $this->db->where(array('MONTH(purchase_date)='=>$month,'YEAR(purchase_date)='=>$year));
   $query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->purchase_amount;  
        }
        return 0;

    }
     public function pur_sep(){
  $month=9;
  $year=date('Y');
  $this->db->select('SUM(grand_total_amount) as purchase_amount');
  $this->db->from('product_purchase');
  $this->db->where(array('MONTH(purchase_date)='=>$month,'YEAR(purchase_date)='=>$year));
  $query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->purchase_amount;  
        }
        return 0;

    }
     public function pur_oct(){
  $month=10;
  $year=date('Y');
  $this->db->select('SUM(grand_total_amount) as purchase_amount');
  $this->db->from('product_purchase');
  $this->db->where(array('MONTH(purchase_date)='=>$month,'YEAR(purchase_date)='=>$year));
   $query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->purchase_amount;  
        }
        return 0;
    }
     public function pur_nov(){
  $month=11;
  $year=date('Y');
  $this->db->select('SUM(grand_total_amount) as purchase_amount');
  $this->db->from('product_purchase');
  $this->db->where(array('MONTH(purchase_date)='=>$month,'YEAR(purchase_date)='=>$year));
   $query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->purchase_amount;  
        }
        return 0;

    }
     public function pur_dec(){
  $month=12;
  $year=date('Y');
  $this->db->select('SUM(grand_total_amount) as purchase_amount');
  $this->db->from('product_purchase');
  $this->db->where(array('MONTH(purchase_date)='=>$month,'YEAR(purchase_date)='=>$year));
   $query = $this->db->get();
        if ($query->num_rows() > 0) {
             $result = $query->row();
             return $result->purchase_amount;  
        }
        return 0;

    }
    
    
    public function profitloss_days($from,$to){
        $from_date =  $from;
        $to_date  = $to;
        $date = date('Y-m-d');
        $this->db->select("*");
        $this->db->from('invoice');
        $this->db->where('date >=', $from_date); 
        $this->db->where('date <=', $to_date); 
        $this->db->group_by('invoice_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return [];
    }
    
    public function datewisesale($date){
        
        $this->db->select("sum(total_amount) as total_sale");
        $this->db->from('invoice');
        $this->db->where('date', $date); 
        $query = $this->db->get();

        $amount =  $query->row()->total_sale;
        return (!empty($amount)?$amount:0);
    
}


    public function datewisepurchase($date){
        
        $this->db->select("sum(grand_total_amount) as total_purchase");
        $this->db->from('product_purchase');
        $this->db->where('purchase_date', $date); 
        $query = $this->db->get();
            $amount =  $query->row()->total_purchase;   
        return (!empty($amount)?$amount:0);
}


public function todaysprofit(){
        $date = date('Y-m-d');
        $this->db->select("invoice_id,total_amount");
        $this->db->from('invoice');
        $this->db->where('date', $date); 
        $this->db->group_by('invoice_id');
        $query = $this->db->get();
        $sale =  $query->result_array();
        
         $invoice_ids = [];
         $total_invoiceamount = 0;
         if($sale){
        foreach($sale as $sales){
            $invoice_ids[] = $sales['invoice_id'];
             $total_invoiceamount += $sales['total_amount'];
        }
         }
         $medicines =[];
         if($invoice_ids){
        $medicines = $this->db->select('a.product_id,a.quantity,b.manufacturer_price')
                               ->from('invoice_details a')
                               ->join('product_information b','b.product_id=a.product_id')
                               ->where_in('a.invoice_id',$invoice_ids)
                               ->get()
                               ->result_array();
                           }
                              


          $total_manufacturer_price = 0;
          if($medicines){
          foreach($medicines as $manufinfo){
              $total_manufacturer_price += $manufinfo['quantity']*$manufinfo['manufacturer_price'];
          }
          }
          
          $data = array(
              'sale_amount'        => $total_invoiceamount,
              'manufacture_amount' => $total_manufacturer_price,
              'profit'             => $total_invoiceamount - $total_manufacturer_price,
              );
return $data;
    
        
}

public function weekly(){
        $from_date =  date('Y-m-d',strtotime('last saturday'));
        $to_date  = date('Y-m-d');
        $date = date('Y-m-d');
        $this->db->select("invoice_id,total_amount");
        $this->db->from('invoice');
        $this->db->where('date >=', $from_date); 
        $this->db->where('date <=', $to_date); 
        $this->db->group_by('invoice_id');
        $query = $this->db->get();
        $sale =  $query->result_array();

         $invoice_ids = [''];
         $total_invoiceamount = 0;
         if($sale){
        foreach($sale as $sales){
            $invoice_ids[] = $sales['invoice_id'];
             $total_invoiceamount += $sales['total_amount'];
        }
         }
         $medicines = [];
         if($invoice_ids){
        $this->db->select('a.product_id,a.quantity,b.manufacturer_price');
                               $this->db->from('invoice_details a');
                               $this->db->join('product_information b','b.product_id=a.product_id');
                               $this->db->where_in('a.invoice_id',$invoice_ids);
                               $rslt = $this->db->get();
                               $medicines = $rslt->result_array();
                    }          


          $total_manufacturer_price = 0;
          if($medicines){
          foreach($medicines as $manufinfo){
              $total_manufacturer_price += $manufinfo['quantity']*$manufinfo['manufacturer_price'];
          }
          }
          
          $data = array(
              'sale_amount'        => $total_invoiceamount,
              'manufacture_amount' => $total_manufacturer_price,
              'profit'             => $total_invoiceamount - $total_manufacturer_price,
              );
              return $data;
}

public function monthly(){
        $from_date =  date('Y-m-01');
        $to_date  = date('Y-m-d');
        $date = date('Y-m-d');
        $this->db->select("invoice_id,total_amount");
        $this->db->from('invoice');
        $this->db->where('date >=', $from_date); 
        $this->db->where('date <=', $to_date); 
        $this->db->group_by('invoice_id');
        $query = $this->db->get();
        $sale =  $query->result_array();
         $invoice_ids = [];
         $total_invoiceamount = 0;
         if($sale){
        foreach($sale as $sales){
            $invoice_ids[] = $sales['invoice_id'];
             $total_invoiceamount += $sales['total_amount'];
        }
         }
         $medicines= [];
         if($invoice_ids){
        $medicines = $this->db->select('a.product_id,a.quantity,b.manufacturer_price')
                               ->from('invoice_details a')
                               ->join('product_information b','b.product_id=a.product_id')
                               ->where_in('a.invoice_id',$invoice_ids)
                               ->get()
                               ->result_array();
                              

}
          $total_manufacturer_price = 0;
          if($medicines){
          foreach($medicines as $manufinfo){
              $total_manufacturer_price += $manufinfo['quantity']*$manufinfo['manufacturer_price'];
          }
          }
          
          $data = array(
              'sale_amount'        => $total_invoiceamount,
              'manufacture_amount' => $total_manufacturer_price,
              'profit'             => $total_invoiceamount - $total_manufacturer_price,
              );
              return $data;
}

  public function invoice_manufacturerprice($invoice_id){
        $medicines = $this->db->select('a.product_id,a.quantity,b.manufacturer_price')
                               ->from('invoice_details a')
                               ->join('product_information b','b.product_id=a.product_id')
                               ->where('a.invoice_id',$invoice_id)
                               ->get()
                               ->result_array();
                               
                                 $total_manufacturer_price = 0;
                    if($medicines){
                   foreach($medicines as $manufinfo){
              $total_manufacturer_price += $manufinfo['quantity']*$manufinfo['manufacturer_price'];
          }
          }
          
          return $total_manufacturer_price;
  }

  public function medicine_list(){
        $this->db->select("*");
        $this->db->from('product_information');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();  
        }
        return false;
  }

      public function daily_closing_entry($data) {
        $this->db->insert('daily_closing', $data);
    }

    // This function will find out all closing information of daily closing.
    public function accounts_closing_data() {
        $last_closing_amount = $this->get_last_closing_amount();
        $cash_in = $this->cash_data_receipt();
        $cash_out = $this->cash_data();
        if ($last_closing_amount != null) {
            $last_closing_amount = $last_closing_amount[0]['amount'];
            $cash_in_hand = ($last_closing_amount+$cash_in) - $cash_out;
        } else {
            $last_closing_amount = 0;
            $cash_in_hand = $cash_in - $cash_out;
        }

        $company_info = $this->Reports->retrieve_company();
        return array(
            "last_day_closing" => number_format($last_closing_amount, 2, '.', ','),
            "cash_in"          => number_format($cash_in, 2, '.', ','),
            "cash_out"         => number_format($cash_out, 2, '.', ','),
            "company_info"     => $company_info,
            "cash_in_hand"     => number_format($cash_in_hand, 2, '.', ',')
        );
    }
        public function get_last_closing_amount() {
        $sql = "SELECT amount FROM daily_closing WHERE date = (SELECT MAX(date) FROM daily_closing)";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        if ($result) {
            return $result;
        } else {
            return FALSE;
        }
    }
    
        public function cash_data_receipt() {
        //-----------
        $cash = 0;
        $datse = date('Y-m-d');
        $this->db->select('sum(Debit) as amount');
        $this->db->from('acc_transaction');
        $this->db->where('COAID', 1020101);
        $this->db->where('VDate', $datse);
        $result_amount = $this->db->get();
        $amount = $result_amount->result_array();
        $cash += $amount[0]['amount'];
        return $cash;
    }
        public function cash_data() {
        //-----------
        $cash = 0;
        $datse = date('Y-m-d');
        $this->db->select('sum(Credit) as amount');
        $this->db->from('acc_transaction');
        $this->db->where('COAID', 1020101);
        $this->db->where('VDate', $datse);
        $result_amount = $this->db->get();
        $amount = $result_amount->result_array();
        $cash += $amount[0]['amount'];
        return $cash;
    }


    public function total_sales_amount(){
       $this->db->select('b.product_id, b.product_name, sum(a.quantity) as quantity,sum(a.total_price) as sales_amount,c.date');
        $this->db->from('invoice_details a');
        $this->db->join('invoice c', 'c.invoice_id = a.invoice_id');
        $this->db->join('product_information b', 'b.product_id = a.product_id');
        $this->db->where('MONTH(c.date)',date('m'));
        $query = $this->db->get();
         $total =  $query->row()->quantity;   
        return (!empty($total)?$total:0);
    }

    public function monthlyprogress_label($year,$month){
        $mlabel = '';
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $month, $d, $year);          
            if (date('m', $time)==$month)       
                
             $mlabel .= date('Y-m-d', $time). ', ';
        } 
        return  $mlabel;
    }

    public function monthlyprogress_saledata($year,$month){
        $salesdata = '';
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $month, $d, $year);          
            if (date('m', $time)==$month)       
                
             $saledate = date('Y-m-d', $time);
             $salesdata .= $this->progress_saledata($saledate). ', ';
        } 
        return  $salesdata;
    }

    public function monthlyprogress_purchasedata($year,$month){
        $purchasedata = '';
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $month, $d, $year);          
            if (date('m', $time)==$month)       
                
             $purchasedate = date('Y-m-d', $time);
             $purchasedata .= $this->progress_purchasedata($purchasedate). ', ';
        } 
        return  $purchasedata;
    }

    public function progress_saledata($date){
        $this->db->select("sum(total_amount) as total");
        $this->db->from('invoice');
        $this->db->where('date',$date); 
        $query = $this->db->get();
            $amount =  $query->row()->total;   
        return (!empty($amount)?$amount:0);
    }

    public function pie_total_saleamount(){
        $month = date('m');
        $year  = date('Y');
        $this->db->select("sum(total_amount) as total");
        $this->db->from('invoice');
        $this->db->where('YEAR(date)',$year);
        $this->db->where('MONTH(date)',$month); 
        $query = $this->db->get();
            $amount =  $query->row()->total;   
        return (!empty($amount)?$amount:0);
    }

    public function pie_total_purchaseamount(){
        $month = date('m');
        $year  = date('Y');
        $this->db->select("sum(grand_total_amount) as total");
        $this->db->from('product_purchase');
        $this->db->where('YEAR(purchase_date)',$year);
        $this->db->where('MONTH(purchase_date)',$month);  
        $query = $this->db->get();
            $amount =  $query->row()->total;   
        return (!empty($amount)?$amount:0);
    }

    public function pie_total_serviceamount(){
        $month = date('m');
        $year  = date('Y');
        $this->db->select("sum(total_amount) as total");
        $this->db->from('service_invoice');
        $this->db->where('YEAR(date)',$year);
        $this->db->where('MONTH(date)',$month);  
        $query = $this->db->get();
            $amount =  $query->row()->total;   
        return (!empty($amount)?$amount:1);
    }

    public function pie_total_salaryamount(){
        $month = date('m');
        $year  = date('Y');
        $this->db->select("sum(total_salary) as total");
        $this->db->from('employee_salary_payment');
        $this->db->where('YEAR(payment_date)',$year);
        $this->db->where('MONTH(payment_date)',$month);
        $this->db->where('paid_by !=',NULL);  
        $query = $this->db->get();
            $amount =  $query->row()->total;   
        return (!empty($amount)?$amount:0);
    }
   
   public function pie_total_expenseamount(){
        $expense_amount = 0;
        $month = date('m');
        $year  = date('Y');
        $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('PHeadName', 'Expence');
        $query = $this->db->get();
        $result = $query->result_array();
        if($result){
            foreach($result as $data){
        $this->db->select('sum(Debit) as amount');
        $this->db->from('acc_transaction');
        $this->db->where('COAID', $data['HeadCode']);
        $this->db->where('YEAR(VDate)',$year);
        $this->db->where('MONTH(VDate)',$month); 
        $this->db->where('IsAppove', 1);
        $result_amount = $this->db->get();
        $amount = $result_amount->result_array();
        $expense_amount += $amount[0]['amount'];
    }
        }
        return $expense_amount;

   }
    public function progress_purchasedata($date){
         $this->db->select("sum(grand_total_amount) as total");
        $this->db->from('product_purchase');
        $this->db->where('purchase_date',$date); 
        $query = $this->db->get();
            $amount =  $query->row()->total;   
        return (!empty($amount)?$amount:0);
    }

    public function total_cash_receive(){
        $cash = 0;
        $datse = date('Y-m-d');
        $this->db->select('sum(Debit) as amount');
        $this->db->from('acc_transaction');
        $this->db->where('COAID', 1020101);
        $this->db->where('VDate', $datse);
        $this->db->where('IsAppove', 1);
        $result_amount = $this->db->get();
        $amount = $result_amount->result_array();
        $cash = $amount[0]['amount'];
        return $cash;
    }

    public function total_bank_receive(){
        $bank_amount = 0;
        $datse = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('PHeadName', 'Cash At Bank');
        $query = $this->db->get();
        $result = $query->result_array();
        if($result){
            foreach($result as $data){
        $this->db->select('sum(Debit) as amount');
        $this->db->from('acc_transaction');
        $this->db->where('COAID', $data['HeadCode']);
        $this->db->where('VDate', $datse);
        $this->db->where('IsAppove', 1);
        $result_amount = $this->db->get();
        $amount = $result_amount->result_array();
        $bank_amount += $amount[0]['amount'];
    }
        }
        return $bank_amount;

    }

        public function total_due_amount(){
        $date = date('Y-m-d');
        $this->db->select("sum(a.due_amount) as total,b.date");
        $this->db->from('invoice_details a');
        $this->db->join('invoice b','b.invoice_id = a.invoice_id');
        $this->db->where('b.date',$date);
        $this->db->group_by('a.invoice_id'); 
        $query = $this->db->get();
        $result = $query->result_array();
        $total_due = 0;
        foreach($result as $data){
           $total_due += $data['total'];
            
    }

       return $total_due;
        }


        public function total_service_amount(){
        $date = date('Y-m-d');
        $this->db->select("sum(total_amount) as total");
        $this->db->from('service_invoice');
        $this->db->where('date',$date); 
        $query = $this->db->get();
            $amount =  $query->row()->total;   
        return (!empty($amount)?$amount:0);
    }
}