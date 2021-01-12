<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manufacturers extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //Count manufacturer
    public function count_manufacturer() {
        return $this->db->count_all("manufacturer_information");
    }

    //manufacturer List
    public function manufacturer_list_pag($per_page, $page) {
        $this->db->select('*');
        $this->db->from('manufacturer_information');
        $this->db->limit($per_page, $page);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }


    public function getmanufacturerList($postData=null){

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
            $searchQuery = " (a.manufacturer_name like '%".$searchValue."%' or a.mobile like '%".$searchValue."%' or a.country like '%".$searchValue."%' or a.state like '%".$searchValue."%' or a.zip like '%".$searchValue."%' or a.city like '%".$searchValue."%') ";
         }

         ## Total number of records without filtering
         $this->db->select('count(*) as allcount');
         $this->db->from('manufacturer_information a');
         $this->db->join('acc_coa b','a.manufacturer_id = b.manufacturer_id','left');
         $this->db->group_by('a.manufacturer_id');
          if($searchValue != '')
         $this->db->where($searchQuery);
         $records = $this->db->get()->num_rows();
         $totalRecords = $records;

         ## Total number of record with filtering
         $this->db->select('count(*) as allcount');
         $this->db->from('manufacturer_information a');
         $this->db->join('acc_coa b','a.manufacturer_id = b.manufacturer_id','left');
         $this->db->group_by('a.manufacturer_id');
         if($searchValue != '')
            $this->db->where($searchQuery);
         $records = $this->db->get()->num_rows();
         $totalRecordwithFilter = $records;

         ## Fetch records
         $this->db->select("a.*,b.HeadCode,((select ifnull(sum(Debit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)-(select ifnull(sum(Credit),0) from acc_transaction where COAID= `b`.`HeadCode` AND IsAppove = 1)) as balance");
         $this->db->from('manufacturer_information a');
         $this->db->join('acc_coa b','a.manufacturer_id = b.manufacturer_id','left');
         $this->db->group_by('a.manufacturer_id');
         if($searchValue != '')
         $this->db->where($searchQuery);
         $this->db->order_by($columnName, $columnSortOrder);
         $this->db->limit($rowperpage, $start);
         $records = $this->db->get()->result();
         $data = array();
         $sl =1;
  
         foreach($records as $record ){
          $button = '';
          $base_url = base_url();
          $jsaction = "return confirm('Are You Sure ?')";

       
        $balance = $record->balance;

        
   if($this->permission1->method('manage_manufacturer','update')->access()){
    $button .='<a href="'.$base_url.'Cmanufacturer/manufacturer_update_form/'.$record->manufacturer_id.'" class="btn btn-info btn-xs"  data-placement="left" title="'. display('update').'"><i class="fa fa-edit"></i></a> ';
}
   if($this->permission1->method('manage_manufacturer','delete')->access()){
     $button .='<a href="'.$base_url.'Cmanufacturer/manufacturer_delete/'.$record->manufacturer_id.'" class="btn btn-danger btn-xs" onclick="'.$jsaction.'"><i class="fa fa-trash"></i></a>';
 }

               
            $data[] = array( 
                'sl'               =>$sl,
                'manufacturer_name'=>html_escape($record->manufacturer_name),
                'address'          =>html_escape($record->address),
                'address2'         =>html_escape($record->address2),
                'mobile'           =>html_escape($record->mobile),
                'emailnumber'      =>html_escape($record->emailnumber),
                'email_address'    =>html_escape($record->email_address),
                'contact'          =>html_escape($record->contact),
                'phone'            =>html_escape($record->phone),
                'fax'              =>html_escape($record->fax),
                'city'             =>html_escape($record->city),
                'state'            =>html_escape($record->state),
                'zip'              =>html_escape($record->zip),
                'country'          =>html_escape($record->country),
                'details'          =>html_escape($record->details),
                'balance'          =>(!empty($balance)?$balance:0),
                'button'           =>$button,
                
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

    // manufacturer search
    public function manufacturer_search($manufacturer_id) {
        $this->db->select('*');
        $this->db->from('manufacturer_information');
        $this->db->where('manufacturer_id', $manufacturer_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //manufacturer list
    public function manufacturer_list() {
        $this->db->select('*');
        $this->db->from('manufacturer_information');
        $this->db->order_by('manufacturer_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //manufacturer List For Report
    public function manufacturer_list_report() {
        $this->db->select('*');
        $this->db->from('manufacturer_information');
        $this->db->order_by('manufacturer_id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //manufacturer List
    public function manufacturer_list_count() {
        $this->db->select('*');
        $this->db->from('manufacturer_information');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    //Retrieve company Edit Data
    public function retrieve_company() {
        $this->db->select('*');
        $this->db->from('company_information');
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //manufacturer Search List
    public function manufacturer_search_item($manufacturer_id) {
        $this->db->select('*');
        $this->db->from('manufacturer_information');
        $this->db->where('manufacturer_id', $manufacturer_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Selected manufacturer List
    public function selected_product($product_id) {
        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->where('product_id', $product_id);
        return $query = $this->db->get()->row();
    }

    //Product search item
  public function product_search_item($manufacturer_id,$product_name){
    $query=$this->db->select('*')
        ->from('product_information')
        ->where('manufacturer_id',$manufacturer_id)
        ->like('product_name', $product_name, 'both')
        ->group_by('product_id')
        ->order_by('product_name','asc')
        ->limit(15)
        ->get();
    if ($query->num_rows() > 0) {
      return $query->result_array();  
    }
    return false;
  }

    //manufacturer product
    public function manufacturer_product($manufacturer_id) {
        $this->db->select('*');
        $this->db->from('product_information');
        $this->db->where('manufacturer_id', $manufacturer_id);
        return $query = $this->db->get()->result();
    }

    //Count manufacturer
    public function manufacturer_entry($data) {

        $this->db->select('*');
        $this->db->from('manufacturer_information');
        $this->db->where('manufacturer_name', $data['manufacturer_name']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {

            $this->db->insert('manufacturer_information', $data);
            //Data is sending for syncronizing

            $this->db->select('*');
            $this->db->from('manufacturer_information');
            $this->db->where('status', 1);
            $query = $this->db->get();
            foreach ($query->result() as $row) {
                $json_product[] = array('label' => $row->manufacturer_name, 'value' => $row->manufacturer_id);
            }
            $cache_file = './my-assets/js/admin_js/json/manufacturer.json';
            $productList = json_encode($json_product);
            file_put_contents($cache_file, $productList);
            return TRUE;
        }
    }

    //manufacturer Previous balance adjustment
   public function previous_balance_add($balance, $manufacturer_id,$c_acc,$manufacturer_name) {
        $this->load->library('auth');
        $transaction_id = $this->auth->generator(10);
    $coainfo = $this->db->select('*')->from('acc_coa')->where('manufacturer_id',$manufacturer_id)->get()->row();
    $manufacturer_headcode = $coainfo->HeadCode;
       
             $cosdr = array(
      'VNo'            =>  $transaction_id,
      'Vtype'          =>  'PR Balance',
      'VDate'          =>  date("Y-m-d"),
      'COAID'          =>  $manufacturer_headcode,
      'Narration'      =>  'manufacturer debit For '.$manufacturer_name,
      'Debit'          =>  0,
      'Credit'         =>  $balance,
      'IsPosted'       => 1,
      'CreateBy'       => $this->session->userdata('user_id'),
      'CreateDate'     => date('Y-m-d H:i:s'),
      'IsAppove'       => 1
    );
       $inventory = array(
      'VNo'            =>  $transaction_id,
      'Vtype'          =>  'PR Balance',
      'VDate'          =>  date("Y-m-d"),
      'COAID'          =>  10107,
      'Narration'      =>  'Inventory credit For  '.$manufacturer_name,
      'Debit'          =>  $balance,
      'Credit'         =>  0,//purchase price asbe
      'IsPosted'       => 1,
      'CreateBy'       => $this->session->userdata('user_id'),
      'CreateDate'     => date('Y-m-d H:i:s'),
      'IsAppove'       => 1
    ); 

        if(!empty($balance)){
           $this->db->insert('acc_transaction', $cosdr); 
           $this->db->insert('acc_transaction', $inventory); 
        }
    }


    //Retrieve manufacturer Edit Data
    public function retrieve_manufacturer_editdata($manufacturer_id) {
        $this->db->select('*');
        $this->db->from('manufacturer_information');
        $this->db->where('manufacturer_id', $manufacturer_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Update Categories
    public function update_manufacturer($data, $manufacturer_id) {
        $this->db->where('manufacturer_id', $manufacturer_id);
        $this->db->update('manufacturer_information', $data);
        $this->db->select('*');
        $this->db->from('manufacturer_information');
        $this->db->where('status', 1);
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $json_product[] = array('label' => $row->manufacturer_name, 'value' => $row->manufacturer_id);
        }
        $cache_file = './my-assets/js/admin_js/json/manufacturer.json';
        $productList = json_encode($json_product);
        file_put_contents($cache_file, $productList);
        return true;
    }




    // Delete manufacturer from transection 
    // Delete manufacturer Item
    public function delete_manufacturer($manufacturer_id) {
        $manufacturer_info = $this->db->select('*')->from('acc_coa')->where('manufacturer_id',$manufacturer_id)->get()->row();
        
        $this->db->where('manufacturer_id', $manufacturer_id);
        $this->db->delete('acc_coa');
        
        $this->db->where('manufacturer_id', $manufacturer_id);
        $this->db->delete('manufacturer_information');

        $this->db->select('*');
        $this->db->from('manufacturer_information');
        $this->db->where('status', 1);
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $json_product[] = array('label' => $row->manufacturer_name, 'value' => $row->manufacturer_id);
        }
        $cache_file = './my-assets/js/admin_js/json/manufacturer.json';
        $productList = json_encode($json_product);
        file_put_contents($cache_file, $productList);
        return true;
    }

    //Retrieve manufacturer Personal Data 
    public function manufacturer_personal_data($manufacturer_id) {
        $this->db->select('*');
        $this->db->from('manufacturer_information');
        $this->db->where('manufacturer_id', $manufacturer_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    /// manufacturer person data all
    public function manufacturer_personal_data_all() {
        $this->db->select('*');
        $this->db->from('manufacturer_information');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // second
    public function manufacturer_personal_data1() {
        $this->db->select('*');
        $this->db->from('manufacturer_information');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrieve manufacturer Purchase Data 
    public function manufacturer_purchase_data($manufacturer_id) {
        $this->db->select('*');
        $this->db->from('product_purchase');
        $this->db->where(array('manufacturer_id' => $manufacturer_id, 'status' => 1));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //manufacturer Search Data
    public function manufacturer_search_list($cat_id, $company_id) {
        $this->db->select('a.*,b.sub_category_name,c.category_name');
        $this->db->from('manufacturers a');
        $this->db->join('manufacturer_sub_category b', 'b.sub_category_id = a.sub_category_id');
        $this->db->join('manufacturer_category c', 'c.category_id = b.category_id');
        $this->db->where('a.sister_company_id', $company_id);
        $this->db->where('c.category_id', $cat_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Supplioer product information
    public function manufacturer_product_sale($manufacturer_id) {
        $query = $this->db->select('
                a.product_name,
                a.manufacturer_price,
                b.quantity,
                CAST(sum(b.quantity * b.manufacturer_rate) AS DECIMAL(16,2)) as total_taka,
                c.date
                ')
                ->from('product_information a')
                ->join('invoice_details b', 'a.product_id = b.product_id', 'left')
                ->join('invoice c', 'c.invoice_id = b.invoice_id', 'left')
                ->where('a.manufacturer_id', $manufacturer_id)
                ->group_by('c.date')
                ->order_by('c.date')
                ->get();



        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    // Second 
    public function manufacturer_product_sale1($per_page, $page) {
        $this->db->select('a.*,b.HeadName');
        $this->db->from('acc_transaction a');
        $this->db->join('acc_coa b','a.COAID=b.HeadCode');
        $this->db->where('b.PHeadName','Account Payable');
        $this->db->where('a.IsAppove',1);
        $this->db->order_by('a.VDate','desc');
        $this->db->limit($per_page, $page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // count ledger info
    public function count_manufacturer_product_info() {
        $this->db->select('a.*,b.HeadName');
        $this->db->from('acc_transaction a');
        $this->db->join('acc_coa b','a.COAID=b.HeadCode');
        $this->db->where('b.PHeadName','Account Payable');
        $this->db->where('a.IsAppove',1);
        $this->db->order_by('a.VDate','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    //To get certain manufacturer's chalan info by which this company got products day by day
    public function manufacturers_ledger($manufacturer_id, $start, $end) {
        $this->db->select('a.*,b.HeadName');
        $this->db->from('acc_transaction a');
        $this->db->join('acc_coa b','a.COAID=b.HeadCode');
        $this->db->where('b.manufacturer_id', $manufacturer_id);
        $this->db->where(array('VDate >=' => $start, 'VDate <=' => $end));
        $this->db->where('a.IsAppove',1);
        $this->db->order_by('a.VDate','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }




    //Findings a certain manufacturer products sales information
    public function manufacturer_sales_details() {
        $manufacturer_id = $this->uri->segment(3);
        $start = $this->uri->segment(4);
        $end = $this->uri->segment(5);

        $this->db->select('
          date,
          product_name,
          product_model,
          product_id,
          quantity,
          manufacturer_rate,
          CAST(quantity*manufacturer_rate AS DECIMAL(16,2) ) as total
        ');
        $this->db->from('sales_report');
        $this->db->where('manufacturer_id', $manufacturer_id);
        $this->db->where(array('date >=' => $start, 'date <=' => $end));
        $this->db->order_by('date', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    ################################################################################################ manufacturer sales details all menu################

    public function manufacturer_sales_details_all($per_page, $page) {
        $this->db->select('
            b.date,
            b.invoice,
            b.invoice_id,
            e.product_name,
            e.product_model,
            e.product_id,
            d.manufacturer_name,
            a.quantity,
            c.manufacturer_price as manufacturer_rate,
            CAST(a.quantity*c.manufacturer_price AS DECIMAL(16,2) ) as total
          ');
        $this->db->from('invoice_details a');
        $this->db->join('product_information e','e.product_id = a.product_id','left');
        $this->db->join('invoice b','b.invoice_id = a.invoice_id','left');
        $this->db->join('manufacturer_product c','c.product_id = a.product_id','left');
        $this->db->join('manufacturer_information d','d.manufacturer_id = c.manufacturer_id','left');
        $this->db->order_by('b.date', 'desc');
        $this->db->limit($per_page, $page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }


    public function manufacturer_sales_details_datewise($per_page, $page,$fromdate,$todate) {
        $this->db->select('
            b.date,
            b.invoice,
            b.invoice_id,
            e.product_name,
            e.product_model,
            e.product_id,
            d.manufacturer_name,
            a.quantity,
            c.manufacturer_price as manufacturer_rate,
            CAST(a.quantity*c.manufacturer_price AS DECIMAL(16,2) ) as total
          ');
        $this->db->from('invoice_details a');
        $this->db->join('product_information e','e.product_id = a.product_id','left');
        $this->db->join('invoice b','b.invoice_id = a.invoice_id','left');
        $this->db->join('manufacturer_product c','c.product_id = a.product_id','left');
        $this->db->join('manufacturer_information d','d.manufacturer_id = c.manufacturer_id','left');
        $this->db->where(array('b.date >=' => $fromdate, 'b.date <=' => $todate));
        $this->db->order_by('b.date', 'desc');
        $this->db->limit($per_page, $page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }


     public function manufacturer_sales_details_datewise_count($fromdate,$todate) {
        $this->db->select('
            b.date,
            b.invoice,
            b.invoice_id,
            e.product_name,
            e.product_model,
            e.product_id,
            d.manufacturer_name,
            a.quantity,
            c.manufacturer_price as manufacturer_rate,
            CAST(a.quantity*c.manufacturer_price AS DECIMAL(16,2) ) as total
          ');
        $this->db->from('invoice_details a');
        $this->db->join('product_information e','e.product_id = a.product_id','left');
        $this->db->join('invoice b','b.invoice_id = a.invoice_id','left');
        $this->db->join('manufacturer_product c','c.product_id = a.product_id','left');
        $this->db->join('manufacturer_information d','d.manufacturer_id = c.manufacturer_id','left');
        $this->db->where(array('b.date >=' => $fromdate, 'b.date <=' => $todate));
        $this->db->order_by('b.date', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    //Findings a certain manufacturer products sales information
    public function manufacturer_sales_details_count($manufacturer_id) {
        $from_date = $this->input->post('from_date',true);
        $to_date = $this->input->post('to_date',true);

        $this->db->select('date,product_name,product_model,product_id,quantity,manufacturer_rate,(quantity*manufacturer_rate) as total');
        $this->db->from('sales_report');
        $this->db->where('manufacturer_id', $manufacturer_id);
        if ($from_date != null AND $to_date != null) {
            $this->db->where('date >', $from_date);
            $this->db->where('date <', $to_date);
        }
        $this->db->order_by('date', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    // manufacturer sales details count menu all
    public function manufacturer_sales_details_count_all() {

        $this->db->select('
            b.date,
            e.product_name,
            e.product_model,
            e.product_id,
            a.quantity,
            c.manufacturer_price as manufacturer_rate,
            CAST(a.quantity*c.manufacturer_price AS DECIMAL(16,2) ) as total
          ');
        $this->db->from('invoice_details a');
        $this->db->join('product_information e','e.product_id = a.product_id','left');
        $this->db->join('invoice b','b.invoice_id = a.invoice_id','left');
        $this->db->join('manufacturer_product c','c.product_id = a.product_id','left');
        $this->db->join('manufacturer_information d','d.manufacturer_id = c.manufacturer_id','left');
        $this->db->order_by('b.date', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    public function manufacturer_sales_summary($per_page, $page) {
        $date = $this->input->post('date',true);
        $manufacturer_id = $this->uri->segment(3);
        $start = $this->uri->segment(4);
        $end = $this->uri->segment(5);

        $this->db->select('
            date,
            quantity,
            product_name,product_model,
            product_id, 
            sum(quantity) as quantity ,
            manufacturer_rate,
            CAST(sum(quantity*manufacturer_rate) AS DECIMAL(16,2)) as total,
          ');

        $this->db->from('sales_report');
        $this->db->where('manufacturer_id', $manufacturer_id);
        $this->db->where(array('date >=' => $start, 'date <=' => $end));
        $this->db->group_by('invoice_id');
        $this->db->limit($per_page, $page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function manufacturer_sales_summary_count($manufacturer_id) {
        $date = $this->input->post('date',true);


        $this->db->select('
            date,
            quantity,
            product_name,product_model,
            product_id,
            sum(quantity) as quantity ,
            manufacturer_rate,
            sum(quantity*manufacturer_rate) as total,
          ');

        $this->db->from('sales_report');
        $this->db->where('manufacturer_id', $manufacturer_id);
        if ($date != null) {
            $this->db->where('date =', $date);
        }
        $this->db->group_by('product_id,date,manufacturer_rate');
        $this->db->order_by('date', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }




    public function manufacturer_product_sale_info($manufacturer_id) {
        $this->db->select('a.*,b.HeadName');
        $this->db->from('acc_transaction a');
        $this->db->join('acc_coa b','a.COAID=b.HeadCode');
        $this->db->where('b.manufacturer_id',$manufacturer_id);
        $this->db->where('a.IsAppove',1);
        $this->db->order_by('a.VDate','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

         public function headcode(){

        $query=$this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='3' And HeadCode LIKE '50200%'");
        return $query->row();

    }


      // manufacturer list
    public function manufacturer_list_advance(){
        $this->db->select('*');
        $this->db->from('manufacturer_information');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function advance_details($receiptid,$manufacturer_id){
        $headcode = $this->db->select('HeadCode')->from('acc_coa')->where('manufacturer_id',$manufacturer_id)->get()->row();
        return $this->db->select('*')
                        ->from('acc_transaction')
                        ->where('VNo',$receiptid)
                        ->where('COAID',$headcode->HeadCode)
                        ->get()
                        ->result_array();


    }

}
