<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Purchases extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Smsgateway');
	}
	//Count purchase
	public function count_purchase()
	{
		$this->db->select('a.*,b.manufacturer_name');
		$this->db->from('product_purchase a');
		$this->db->join('manufacturer_information b','b.manufacturer_id = a.manufacturer_id');
		$this->db->order_by('a.purchase_date','desc');
		$query = $this->db->get();
		
		$last_query =  $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->num_rows();	
		}
		return false;
	}

	  public function getPurchaseList($postData=null){
         $this->load->library('occational');
         $this->load->model('Web_settings');
         $currency_details = $this->Web_settings->retrieve_setting_editdata();
         $response = array();
         $fromdate = $this->input->post('fromdate',true);
         $todate   = $this->input->post('todate',true);
         if(!empty($fromdate)){
            $datbetween = "(a.purchase_date BETWEEN '$fromdate' AND '$todate')";
         }else{
            $datbetween = "";
         }
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
            $searchQuery = " (b.manufacturer_name like '%".$searchValue."%' or a.chalan_no like '%".$searchValue."%' or a.purchase_date like'%".$searchValue."%')";
         }

         ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from('product_purchase a');
        $this->db->join('manufacturer_information b', 'b.manufacturer_id = a.manufacturer_id','left');
          if(!empty($fromdate) && !empty($todate)){
             $this->db->where($datbetween);
         }
          if($searchValue != '')
          $this->db->where($searchQuery);
          
         $records = $this->db->get()->result();
         $totalRecords = $records[0]->allcount;

         ## Total number of record with filtering
         $this->db->select('count(*) as allcount');
        $this->db->from('product_purchase a');
        $this->db->join('manufacturer_information b', 'b.manufacturer_id = a.manufacturer_id','left');
         if(!empty($fromdate) && !empty($todate)){
             $this->db->where($datbetween);
         }
         if($searchValue != '')
            $this->db->where($searchQuery);
          
         $records = $this->db->get()->result();
         $totalRecordwithFilter = $records[0]->allcount;

         ## Fetch records
        $this->db->select('a.*,b.manufacturer_name');
        $this->db->from('product_purchase a');
        $this->db->join('manufacturer_information b', 'b.manufacturer_id = a.manufacturer_id','left');
          if(!empty($fromdate) && !empty($todate)){
             $this->db->where($datbetween);
         }
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

           $button .='  <a href="'.$base_url.'Cpurchase/invoice_html/'.$record->purchase_id.'" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="'.display('purchase_details').'"><i class="fa fa-window-restore" aria-hidden="true"></i></a>';
      if($this->permission1->method('manage_purchase','update')->access()){
         $button .=' <a href="'.$base_url.'Cpurchase/purchase_update_form/'.$record->purchase_id.'" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="'. display('update').'"><i class="fa fa-pencil" aria-hidden="true"></i></a> ';
     }

      
               
            $data[] = array( 
                'sl'               =>$sl,
                'chalan_no'        =>$record->chalan_no,
                'purchase_id'      =>$record->purchase_id,
                'manufacturer_name'=>$record->manufacturer_name,
                'purchase_id'      =>$record->purchase_id,
                'purchase_date'    =>$record->purchase_date,
                'total_amount'     =>$record->grand_total_amount,
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
	//purchase List
	public function purchase_list($per_page,$page)
	{
		$this->db->select('a.*,b.manufacturer_name');
		$this->db->from('product_purchase a');
		$this->db->join('manufacturer_information b','b.manufacturer_id = a.manufacturer_id');
		$this->db->order_by('a.purchase_date','desc');
		$this->db->order_by('purchase_id','desc');
		$this->db->limit($per_page,$page);
		$query = $this->db->get();
		
		$last_query =  $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
//purchase info by invoice id
 public function purchase_list_invoice_id($invoice_no)
	{
		$this->db->select('a.*,b.manufacturer_name');
		$this->db->from('product_purchase a');
		$this->db->join('manufacturer_information b','b.manufacturer_id = a.manufacturer_id');
		$this->db->where('a.chalan_no',$invoice_no);
		$this->db->order_by('a.purchase_date','desc');
		$this->db->order_by('purchase_id','desc');
		$query = $this->db->get();
		
		$last_query =  $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Select All manufacturer List
	public function select_all_manufacturer()
	{
		$query = $this->db->select('*')
					->from('manufacturer_information')
					->where('status','1')
					->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	//purchase Search  List
	public function purchase_by_search($manufacturer_id)
	{
		$this->db->select('a.*,b.manufacturer_name');
		$this->db->from('product_purchase a');
		$this->db->join('manufacturer_information b','b.manufacturer_id = a.manufacturer_id');
		$this->db->where('b.manufacturer_id',$manufacturer_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Count purchase
	public function purchase_entry()
	{
		$purchase_id = date('YmdHis');
		$p_id = $this->input->post('product_id',true);
		$chaln_no=$this->input->post('chalan_no',true);
		$manufacturer_id=$this->input->post('manufacturer_id',true);
		$manufacturer_info = $this->db->select('*')->from('manufacturer_information')->where('manufacturer_id',$manufacturer_id)->get()->row(); 
        $manuf_coa = $this->db->select('*')->from('acc_coa')->where('manufacturer_id',$manufacturer_id)->get()->row();
       $receive_by=$this->session->userdata('user_id');
        $receive_date=date('Y-m-d');
        $createdate=date('Y-m-d H:i:s');
     $bank_id = $this->input->post('bank_id',true);
        if(!empty($bank_id)){
       $bankname = $this->db->select('bank_name')->from('bank_add')->where('bank_id',$bank_id)->get()->row()->bank_name;
    
       $bankcoaid = $this->db->select('HeadCode')->from('acc_coa')->where('HeadName',$bankname)->get()->row()->HeadCode;
   }

    	$this->form_validation->set_rules('manufacturer_id', 'Manufacturer Name', 'required');
		$this->form_validation->set_rules('paytype', 'Pyament Type', 'required');
		$this->form_validation->set_rules('product_id[]', 'Medicine Name', 'required');
		$this->form_validation->set_rules('batch_id[]', 'Batch Id', 'required');
		$this->form_validation->set_rules('expeire_date[]', 'Expiry Date', 'required');
		$this->form_validation->set_rules('product_quantity[]', 'Quantity', 'required');
		
		if ($this->form_validation->run()) {

		$this->db->select('*');
		$this->db->from('product_purchase');
		$this->db->where('status',1);
		$this->db->where('chalan_no',$chaln_no);
		$this->db->where('manufacturer_id',$manufacturer_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			 $this->session->set_flashdata('error_message',display('Choose_another_invno'));
			  	redirect(base_url('Cpurchase'));
			  	exit();
		}

		//manufacturer & product id relation ship checker.
		for ($i=0, $n=count($p_id); $i < $n; $i++) {
			$product_id =$p_id[$i];
			$value=$this->product_manufacturer_check($product_id,$manufacturer_id);
			if($value==0){
			  	$this->session->set_userdata(array('error_message'=>"Medicine And Manufacturer Did Not Match"));
			  	redirect(base_url('Cpurchase'));
			  	exit();
			}
		}

	
		$data=array(
			'purchase_id'		=>	$purchase_id,
			'chalan_no'			=>	$this->input->post('chalan_no',true),
			'manufacturer_id'	=>	$this->input->post('manufacturer_id',true),
			'grand_total_amount'=>	$this->input->post('grand_total_price',true),
			'total_discount'	=>	$this->input->post('total_discount',true),
			'purchase_date'		=>	$this->input->post('purchase_date',true),
			'purchase_details'	=>	$this->input->post('purchase_details',true),
			'status'			=>	1,
			'bank_id'           =>  $this->input->post('bank_id',true),
			'payment_type'      =>  $this->input->post('paytype',true),
		);
		$this->db->insert('product_purchase',$data);
		//manufacturer credit
		     $purchasecoatran = array(
          'VNo'            =>  $purchase_id,
          'Vtype'          =>  'Purchase',
          'VDate'          =>  $this->input->post('purchase_date',true),
          'COAID'          =>  $manuf_coa->HeadCode,
          'Narration'      =>  'Purchase No.'.$purchase_id,
          'Debit'          =>  0,
          'Credit'         =>  $this->input->post('grand_total_price',true),
          'IsPosted'       =>  1,
          'CreateBy'       =>  $receive_by,
          'CreateDate'     =>  $receive_date,
          'IsAppove'       =>  1
        ); 
          ///Inventory Debit
       $coscr = array(
      'VNo'            => $purchase_id,
      'Vtype'          => 'Purchase',
      'VDate'          => $this->input->post('purchase_date',true),
      'COAID'          => 10107,
      'Narration'      => 'Inventory Debit For Purchase No'.$purchase_id,
      'Debit'          => $this->input->post('grand_total_price',true),
      'Credit'         => 0,//purchase price asbe
      'IsPosted'       => 1,
      'CreateBy'       => $receive_by,
      'CreateDate'     => $createdate,
      'IsAppove'       => 1
    ); 
       // Expense for company
         $expense = array(
      'VNo'            => $purchase_id,
      'Vtype'          => 'Purchase',
      'VDate'          => $this->input->post('purchase_date',true),
      'COAID'          => 402,
      'Narration'      => 'Company Credit For Purchase No'.$purchase_id,
      'Debit'          => $this->input->post('grand_total_price',true),
      'Credit'         => 0,//purchase price asbe
      'IsPosted'       => 1,
      'CreateBy'       => $receive_by,
      'CreateDate'     => $createdate,
      'IsAppove'       => 1
    ); 
             $cashinhand = array(
      'VNo'            =>  $purchase_id,
      'Vtype'          =>  'Purchase',
      'VDate'          =>  $this->input->post('purchase_date',true),
      'COAID'          =>  1020101,
      'Narration'      =>  'Cash in Hand For Purchase No'.$purchase_id,
      'Debit'          =>  0,
      'Credit'         =>  $this->input->post('grand_total_price',true),
      'IsPosted'       =>  1,
      'CreateBy'       =>  $receive_by,
      'CreateDate'     =>  $createdate,
      'IsAppove'       =>  1
    ); 

     $manufacurerdebit = array(
          'VNo'            =>  $purchase_id,
          'Vtype'          =>  'Purchase',
          'VDate'          =>  $this->input->post('purchase_date',true),
          'COAID'          =>  $manuf_coa->HeadCode,
          'Narration'      =>  'Purchase No.'.$purchase_id,
          'Debit'          =>  $this->input->post('grand_total_price',true),
          'Credit'         =>  0,
          'IsPosted'       =>  1,
          'CreateBy'       =>  $receive_by,
          'CreateDate'     =>  $receive_date,
          'IsAppove'       =>  1
        ); 
             
                  // bank ledger
 $bankc = array(
      'VNo'            =>  $purchase_id,
      'Vtype'          =>  'Purchase',
      'VDate'          =>  $this->input->post('purchase_date',true),
      'COAID'          =>  $bankcoaid,
      'Narration'      =>  'Paid amount for Purchase No '.$purchase_id,
      'Debit'          =>  0,
      'Credit'         =>  $this->input->post('grand_total_price',true),
      'IsPosted'       =>  1,
      'CreateBy'       =>  $receive_by,
      'CreateDate'     =>  $createdate,
      'IsAppove'       =>  1
    ); 

		

	
		$this->db->insert('acc_transaction',$coscr);
		$this->db->insert('acc_transaction',$purchasecoatran);	
		$this->db->insert('acc_transaction',$expense);
		if($this->input->post('paytype') == 2){
       	$this->db->insert('acc_transaction',$bankc);
       	$this->db->insert('acc_transaction',$manufacurerdebit);
		}
		if($this->input->post('paytype') == 1){
		$this->db->insert('acc_transaction',$cashinhand);
		$this->db->insert('acc_transaction',$manufacurerdebit);		
		}		
		$rate = $this->input->post('product_rate',true);
		$quantity = $this->input->post('product_quantity',true);
		$t_price = $this->input->post('total_price',true);
		$discount = $this->input->post('discount',true);
		$batch=$this->input->post('batch_id',true);
		$exp_date=$this->input->post('expeire_date',true);
		
		for ($i=0, $n=count($p_id); $i < $n; $i++) {
			$product_quantity = $quantity[$i];
			$product_rate = $rate[$i];
			$product_id = $p_id[$i];
			$total_price = $t_price[$i];
			$disc = $discount[$i];
			$batch_id=$batch[$i];
			$expre_date=$exp_date[$i];
			
			$data1 = array(
				'purchase_detail_id'=>	$this->generator(15),
				'purchase_id'		=>	$purchase_id,
				'product_id'		=>	$product_id,
				'quantity'			=>	$product_quantity,
				'rate'				=>	$product_rate,
				'total_amount'		=>	$total_price,
				'discount'			=>	$disc,
				'batch_id'          =>  $batch_id,
				'expeire_date'      =>  $expre_date,
				'status'			=>	1
			);

			if(!empty($quantity))
			{
				$this->db->insert('product_purchase_details',$data1);
			}
		}
	
		   $message = 'Mr/Mrs. '.$manufacturer_info->manufacturer_name.',
        '.'You have Sold '.$this->input->post('grand_total_price',true);
           $config_data = $this->db->select('*')->from('sms_settings')->get()->row();
        if($config_data->ispurchase == 1){
          $this->smsgateway->send([
            'apiProvider' => 'nexmo',
            'username'    => $config_data->api_key,
            'password'    => $config_data->api_secret,
            'from'        => $config_data->from,
            'to'          => $manufacturer_info->mobile,
            'message'     => $message
        ]);
      }
		return $purchase_id;
		 }else{
        $this->session->set_userdata(array('error_message' => validation_errors()));
         redirect($_SERVER['HTTP_REFERER']);
    }
	
	}

	//Retrieve purchase Edit Data
	public function retrieve_purchase_editdata($purchase_id)
	{
		$this->db->select('a.*,
						b.*,
						c.product_id,
						c.product_name,
						c.product_model,
						d.manufacturer_id,
						d.manufacturer_name'
						);
		$this->db->from('product_purchase a');
		$this->db->join('product_purchase_details b','b.purchase_id =a.purchase_id');
		$this->db->join('product_information c','c.product_id =b.product_id');
		$this->db->join('manufacturer_information d','d.manufacturer_id = a.manufacturer_id');
		$this->db->where('a.purchase_id',$purchase_id);
		$this->db->order_by('a.purchase_details','asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
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
	//Update Categories
public function update_purchase()
	{
	$purchase_id  = $this->input->post('purchase_id',true);
     $bank_id = $this->input->post('bank_id',true);
        if(!empty($bank_id)){
       $bankname = $this->db->select('bank_name')->from('bank_add')->where('bank_id',$bank_id)->get()->row()->bank_name;
    
       $bankcoaid = $this->db->select('HeadCode')->from('acc_coa')->where('HeadName',$bankname)->get()->row()->HeadCode;
   }
   $manufacturer_id=$this->input->post('manufacturer_id');
//manufacturer coa head
		$manufacturer_info = $this->db->select('*')->from('manufacturer_information')->where('manufacturer_id',$manufacturer_id)->get()->row(); 
        $manuf_coa = $this->db->select('*')->from('acc_coa')->where('manufacturer_id',$manufacturer_id)->get()->row();

        $receive_by=$this->session->userdata('user_id');
        $receive_date=date('Y-m-d');
        $createdate=date('Y-m-d H:i:s');
  
		$data=array(
			'purchase_id'       =>  $purchase_id,
			'chalan_no'			=>	$this->input->post('chalan_no',true),
			'manufacturer_id'	=>	$this->input->post('manufacturer_id',true),
			'grand_total_amount'=>	$this->input->post('grand_total_price',true),
			'total_discount'	=>	$this->input->post('total_discount',true),
			'purchase_date'		=>	$this->input->post('purchase_date',true),
			'purchase_details'	=>	$this->input->post('purchase_details',true),
			'bank_id'           =>  $this->input->post('bank_id',true),
			'payment_type'      =>  $this->input->post('paytype',true),
		);
           $cashinhand = array(
      'VNo'            =>  $purchase_id,
      'Vtype'          =>  'Purchase',
      'VDate'          =>  $this->input->post('purchase_date',true),
      'COAID'          =>  1020101,
      'Narration'      =>  'Cash in Hand For Purchase No'.$purchase_id,
      'Debit'          =>  0,
      'Credit'         =>  $this->input->post('grand_total_price',true),
      'IsPosted'       =>  1,
      'CreateBy'       =>  $receive_by,
      'CreateDate'     =>  $createdate,
      'IsAppove'       =>  1
    ); 
                  // bank ledger
 $bankc = array(
      'VNo'            =>  $purchase_id,
      'Vtype'          =>  'Purchase',
      'VDate'          =>  $this->input->post('purchase_date',true),
      'COAID'          =>  $bankcoaid,
      'Narration'      =>  'Paid amount for Purchase No '.$purchase_id,
      'Debit'          =>  0,
      'Credit'         =>  $this->input->post('grand_total_price',true),
      'IsPosted'       =>  1,
      'CreateBy'       =>  $receive_by,
      'CreateDate'     =>  $createdate,
      'IsAppove'       =>  1
    ); 


 		     $purchasecoatran = array(
          'VNo'            =>  $purchase_id,
          'Vtype'          =>  'Purchase',
          'VDate'          =>  $this->input->post('purchase_date',true),
          'COAID'          =>  $manuf_coa->HeadCode,
          'Narration'      =>  'Purchase No.'.$purchase_id,
          'Debit'          =>  0,
          'Credit'         =>  $this->input->post('grand_total_price',true),
          'IsPosted'       =>  1,
          'CreateBy'       =>  $receive_by,
          'CreateDate'     =>  $receive_date,
          'IsAppove'       =>  1
        ); 
 		     $manufacurerdebit = array(
          'VNo'            =>  $purchase_id,
          'Vtype'          =>  'Purchase',
          'VDate'          =>  $this->input->post('purchase_date',true),
          'COAID'          =>  $manuf_coa->HeadCode,
          'Narration'      =>  'Purchase No.'.$purchase_id,
          'Debit'          =>  $this->input->post('grand_total_price',true),
          'Credit'         =>  0,
          'IsPosted'       =>  1,
          'CreateBy'       =>  $receive_by,
          'CreateDate'     =>  $receive_date,
          'IsAppove'       =>  1
        ); 
          ///Inventory Debit
       $coscr = array(
      'VNo'            => $purchase_id,
      'Vtype'          => 'Purchase',
      'VDate'          => $this->input->post('purchase_date',true),
      'COAID'          => 10107,
      'Narration'      => 'Inventory Debit For Purchase No'.$purchase_id,
      'Debit'          => $this->input->post('grand_total_price',true),
      'Credit'         => 0,//purchase price asbe
      'IsPosted'       => 1,
      'CreateBy'       => $receive_by,
      'CreateDate'     => $createdate,
      'IsAppove'       => 1
    ); 
       // Expense for company
         $expense = array(
      'VNo'            => $purchase_id,
      'Vtype'          => 'Purchase',
      'VDate'          => $this->input->post('purchase_date',true),
      'COAID'          => 402,
      'Narration'      => 'Company Credit For Purchase No'.$purchase_id,
      'Debit'          => $this->input->post('grand_total_price',true),
      'Credit'         => 0,//purchase price asbe
      'IsPosted'       => 1,
      'CreateBy'       => $receive_by,
      'CreateDate'     => $createdate,
      'IsAppove'       => 1
    ); 

		if($purchase_id!='')
		{
			$this->db->where('purchase_id',$purchase_id);
			$this->db->update('product_purchase',$data); 
		    $this->db->where('purchase_id',$purchase_id);
			$this->db->delete('product_purchase_details');
			$this->db->where('VNo',$purchase_id);
			$this->db->delete('acc_transaction');
			$this->db->insert('acc_transaction',$coscr);
		    $this->db->insert('acc_transaction',$purchasecoatran);	
		    $this->db->insert('acc_transaction',$expense);
		    //bank summary
        
			if($this->input->post('paytype',true) == 2){
       	$this->db->insert('acc_transaction',$bankc);
       	$this->db->insert('acc_transaction',$manufacurerdebit);	
		}
		if($this->input->post('paytype',true) == 1){
		$this->db->insert('acc_transaction',$cashinhand);
		$this->db->insert('acc_transaction',$manufacurerdebit);			
		}		
		}
		
		$rate     = $this->input->post('product_rate',true);
		$p_id     = $this->input->post('product_id',true);
		$quantity = $this->input->post('product_quantity',true);
		$t_price  = $this->input->post('total_price',true);
		$discount = $this->input->post('discount',true);
        $batch    = $this->input->post('batch_id',true);
		$exp_date = $this->input->post('expeire_date',true);
		for ($i=0, $n=count($p_id); $i < $n; $i++) {
			$product_quantity = $quantity[$i];
			$product_rate = $rate[$i];
			$product_id   = $p_id[$i];
			$total_price  = $t_price[$i];
			$batch_id     = $batch[$i];
			$expre_date   = $exp_date[$i];
			$disc = $discount[$i];
			
			$data1 = array(
				'purchase_detail_id'=> $this->generator(15),
				'purchase_id'       =>  $purchase_id,
				'product_id'		=>	$product_id,
				'quantity'			=>	$product_quantity,
				'rate'				=>	$product_rate,
				'batch_id'          =>  $batch_id,
				'expeire_date'      =>  $expre_date,
				'total_amount'		=>	$total_price,
				'discount'			=>	$disc,
			);

			
			if(($quantity))
			{
				
				$this->db->insert('product_purchase_details',$data1); 
			}
		}
		return $purchase_id;
	}
	// Delete purchase Item
	
	public function purchase_search_list($cat_id,$company_id)
	{
		$this->db->select('a.*,b.sub_category_name,c.category_name');
		$this->db->from('purchases a');
		$this->db->join('purchase_sub_category b','b.sub_category_id = a.sub_category_id');
		$this->db->join('purchase_category c','c.category_id = b.category_id');
		$this->db->where('a.sister_company_id',$company_id);
		$this->db->where('c.category_id',$cat_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Retrieve purchase_details_data
	public function purchase_details_data($purchase_id)
	{
	$this->db->select('a.*,b.*,c.*,e.purchase_details,d.product_id,d.product_name,d.strength,d.product_model');
		$this->db->from('product_purchase a');
		$this->db->join('manufacturer_information b','b.manufacturer_id = a.manufacturer_id');
		$this->db->join('product_purchase_details c','c.purchase_id = a.purchase_id');
		$this->db->join('product_information d','d.product_id = c.product_id');
		$this->db->join('product_purchase e','e.purchase_id = c.purchase_id');
		$this->db->where('a.purchase_id',$purchase_id);
		$this->db->group_by('d.product_id');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	//This function will check the product & manufacturer relationship.
	public function product_manufacturer_check($product_id,$manufacturer_id)
	{
	 $this->db->select('*');
	  $this->db->from('product_information');
	  $this->db->where('product_id',$product_id);
	  $this->db->where('manufacturer_id',$manufacturer_id);	
	  $query = $this->db->get();
		if ($query->num_rows() > 0) {
			return true;	
		}
		return 0;
	}
	//This function is used to Generate Key
	public function generator($lenth)
	{
		$number=array("A","B","C","D","E","F","G","H","I","J","K","L","N","M","O","P","Q","R","S","U","V","T","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","1","2","3","4","5","6","7","8","9","0");
	
		for($i=0; $i<$lenth; $i++)
		{
			$rand_value=rand(0,61);
			$rand_number=$number["$rand_value"];
		
			if(empty($con))
			{ 
			$con=$rand_number;
			}
			else
			{
			$con="$con"."$rand_number";}
		}
		return $con;
	}

	public function purchase_delete($purchase_id = null)
	{
			//Delete product_purchase table
		$this->db->where('purchase_id',$purchase_id);
		$this->db->delete('product_purchase'); 
		//Delete product_purchase_details table
		$this->db->where('purchase_id',$purchase_id);
		$this->db->delete('product_purchase_details');
		return true;
		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
}
//purchase list date to date
	public function purchase_list_date_to_date($start,$end)
	{
		$this->db->select('a.*,b.manufacturer_name');
		$this->db->from('product_purchase a');
		$this->db->join('manufacturer_information b','b.manufacturer_id = a.manufacturer_id');
		$this->db->order_by('a.purchase_date','desc');
     	$this->db->where('a.purchase_date >=', $start);
        $this->db->where('a.purchase_date <=', $end);
		$query = $this->db->get();
		
		$last_query =  $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	
	public function purchasedatabyid($purchase_id){
        $this->db->select('a.*,b.manufacturer_name');
		$this->db->from('product_purchase a');
		$this->db->join('manufacturer_information b','b.manufacturer_id = a.manufacturer_id','left');
		$this->db->where('a.purchase_id',$purchase_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//purchase details by id
	public function purchase_detailsbyid($purchase_id){
		$this->db->select('a.*,b.*');
		$this->db->from('product_purchase_details a');//
		$this->db->join('product_information b','b.product_id = a.product_id','left');
		$this->db->where('a.purchase_id',$purchase_id);
		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	
	}

	// manufacturer info
	public function manufacturer_info($id){
        $this->db->select('*');
		$this->db->from('manufacturer_information');
		$this->db->where('manufacturer_id',$id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
}