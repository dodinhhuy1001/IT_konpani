<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Linvoice {
	
	//Retrieve  Invoice List
 public function invoice_list() {

        $CI = & get_instance();
        $CI->load->model('Invoices');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $company_info = $CI->Invoices->retrieve_company();
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title'         => display('manage_invoice'),
            'total_invoice' => $CI->Invoices->count_invoice(),
            'currency'      => $currency_details[0]['currency'],
            'company_info'  => $company_info,
        );
        $invoiceList = $CI->parser->parse('invoice/invoice', $data, true);
        return $invoiceList;
    }
	
	//inovie_manage search by invoice id
public function invoice_list_invoice_no($invoice_no)
	{

		$CI =& get_instance();
		$CI->load->model('Invoices');
		$CI->load->model('Web_settings');
		$CI->load->library('occational');
		
		$invoices_list = $CI->Invoices->invoice_list_invoice_id($invoice_no);
		if(!empty($invoices_list)){
			foreach($invoices_list as $k=>$v){
				$invoices_list[$k]['final_date'] = $CI->occational->dateConvert($invoices_list[$k]['date']);
				$invoices_list[$k]['payment_type'] = ($invoices_list[$k]['payment_type'] == 1?'Cash Payment':'Bank Payment');
			}
			$i=0;
			if(!empty($invoices_list)){		
				foreach($invoices_list as $k=>$v){
					$i++;
				   	$invoices_list[$k]['sl']=$i+$CI->uri->segment(3);
				}
			}
		}
		$currency_details = $CI->Web_settings->retrieve_setting_editdata();
		$data = array(
				'title'         => display('manage_invoice'),
				'invoices_list' => $invoices_list,
				'links'	        =>'',
				'currency'      => $currency_details[0]['currency'],
				'position'      => $currency_details[0]['currency_position'],
			);
		$invoiceList = $CI->parser->parse('invoice/invoice',$data,true);
		return $invoiceList;
	}
	// date to date invoice list 
	public function invoice_list_date_to_date($from_date,$to_date,$links,$perpage,$page)
	{

		$CI =& get_instance();
		$CI->load->model('Invoices');
		$CI->load->model('Web_settings');
		$CI->load->library('occational');
		
		$invoices_list = $CI->Invoices->invoice_list_date_to_date($from_date,$to_date,$perpage,$page);
		if(!empty($invoices_list)){
			foreach($invoices_list as $k=>$v){
				$invoices_list[$k]['final_date'] = $CI->occational->dateConvert($invoices_list[$k]['date']);
				$invoices_list[$k]['payment_type'] = ($invoices_list[$k]['payment_type'] == 1?'Cash Payment':'Bank Payment');
			}
			$i=0;
			if(!empty($invoices_list)){		
				foreach($invoices_list as $k=>$v){
					$i++;
				   	$invoices_list[$k]['sl']=$i+$CI->uri->segment(3);
				}
			}
		}
		$currency_details = $CI->Web_settings->retrieve_setting_editdata();
		$data = array(
				'title'         => display('manage_invoice'),
				'invoices_list' => $invoices_list,
				'links'	        => $links,
				'currency'      => $currency_details[0]['currency'],
				'position'      => $currency_details[0]['currency_position'],
			);
		$invoiceList = $CI->parser->parse('invoice/invoice',$data,true);
		return $invoiceList;
	}


	//Pos invoice add form
	public function pos_invoice_add_form()
	{
		$CI =& get_instance();
		$CI->load->model('Invoices');
		$CI->load->model('Web_settings');
		$customer_details = $CI->Invoices->pos_customer_setup();
		$currency_details = $CI->Web_settings->retrieve_setting_editdata();
		$bank_list        = $CI->Web_settings->bank_list();
	 $taxfield = $CI->db->select('tax_name,default_value')
                ->from('tax_settings')
                ->get()
                ->result_array();
                $tablecolumn = $CI->db->list_fields('tax_collection');
                $num_column = count($tablecolumn)-4;
		$data = array(
				'title' 		=> display('add_new_pos_invoice'),
				'customer_name' => $customer_details[0]['customer_name'],
				'customer_id' 	=> $customer_details[0]['customer_id'],
				'discount_type' => $currency_details[0]['discount_type'],
				'taxes'         => $taxfield,
				'bank_list'     => $bank_list,
                'taxnumber'     => $num_column,
			);
		$invoiceForm = $CI->parser->parse('invoice/add_pos_invoice_form',$data,true);
		return $invoiceForm;
	}

	//Retrieve  Invoice List
	public function search_inovoice_item($customer_id)
	{
		$CI =& get_instance();
		$CI->load->model('Invoices');
		$CI->load->library('occational');
		$invoices_list = $CI->Invoices->search_inovoice_item($customer_id);
		if(!empty($invoices_list)){
			foreach($invoices_list as $k=>$v){
				$invoices_list[$k]['final_date'] = $CI->occational->dateConvert($invoices_list[$k]['date']);
			}
			$i=0;
			if(!empty($invoices_list)){		
				foreach($invoices_list as $k=>$v){
					$i++;
				   	$invoices_list[$k]['sl']=$i+$CI->uri->segment(3);
				}
			}
		}
		$data = array(
				'title' 		=> display('manage_invoice'),
				'invoices_list' => $invoices_list
			);
		$invoiceList = $CI->parser->parse('invoice/invoice',$data,true);
		return $invoiceList;
	}

	//Invoice add form
	public function invoice_add_form()
	{
		$CI =& get_instance();
		$CI->load->model('Invoices');
		$CI->load->model('Web_settings');
		$currency_details = $CI->Web_settings->retrieve_setting_editdata();
		$customer_details = $CI->Invoices->pos_customer_setup();
		$bank_list        = $CI->Web_settings->bank_list();
		 $taxfield = $CI->db->select('tax_name,default_value')
                ->from('tax_settings')
                ->get()
                ->result_array();
		$data = array(
				'title'         => display('add_new_invoice'),
				'customer_name' => $customer_details[0]['customer_name'],
				'customer_id' 	=> $customer_details[0]['customer_id'],
				'discount_type' => $currency_details[0]['discount_type'],
				'taxes'         => $taxfield,
				'bank_list'     => $bank_list
			);
		$invoiceForm = $CI->parser->parse('invoice/add_invoice_form',$data,true);
		return $invoiceForm;
	}
	//Insert invoice
	public function insert_invoice($data)
	{
		$CI =& get_instance();
		$CI->load->model('Invoices');
        $CI->Invoices->invoice_entry($data);
		return true;
	}

	//Invoice Edit Data
public function invoice_edit_data($invoice_id)
	{
		$CI =& get_instance();
		$CI->load->model('Invoices');
		$CI->load->model('Web_settings');
		$invoice_detail = $CI->Invoices->retrieve_invoice_editdata($invoice_id);
		$bank_list      = $CI->Web_settings->bank_list();
		$taxinfo        = $CI->Invoices->service_invoice_taxinfo($invoice_id);
        $taxfield       = $CI->db->select('tax_name,default_value')
                ->from('tax_settings')
                ->get()
                ->result_array();
		$i=0;
		if(!empty($invoice_detail)){		
			foreach($invoice_detail as $k=>$v){
				$i++;
			   	$invoice_detail[$k]['sl']=$i;
			}
		}
   
		$currency_details = $CI->Web_settings->retrieve_setting_editdata();
		$data=array(
			'title'				=>	display('invoice_edit'),
			'invoice_id'		=>	$invoice_detail[0]['invoice_id'],
			'customer_id'		=>	$invoice_detail[0]['customer_id'],
			'customer_name'		=>	$invoice_detail[0]['customer_name'],
			'date'				=>	$invoice_detail[0]['date'],
			'invoice_details'   =>   $invoice_detail[0]['invoice_details'],
			'total_amount'		=>	$invoice_detail[0]['total_amount'],
			'paid_amount'		=>	$invoice_detail[0]['paid_amount'],
			'due_amount'		=>	$invoice_detail[0]['due_amount'],
			'total_discount'	=>	$invoice_detail[0]['total_discount'], 
			'unit'              =>  $invoice_detail[0]['unit'],
			'total_tax'			=>	$invoice_detail[0]['total_tax'],
			'taxes'             =>  $taxfield,
			'prev_due'          =>  $invoice_detail[0]['prevous_due'],
            'net_total'         =>  $invoice_detail[0]['prevous_due'] + $invoice_detail[0]['total_amount'], 
			'invoice_all_data'	=>	$invoice_detail,
			'taxvalu'           =>  $taxinfo,
			'invoice_discount'  =>  $invoice_detail[0]['invoice_discount'],
			'discount_type'  	=>	$currency_details[0]['discount_type'],
			'bank_id'           =>  $invoice_detail[0]['bank_id'],
			'paytype'           =>  $invoice_detail[0]['payment_type'],
			'bank_list'         =>  $bank_list
			);
		$chapterList = $CI->parser->parse('invoice/edit_invoice_form',$data,true);
		return $chapterList;
	}

	//Invoice html Data
	public function invoice_html_data($invoice_id)
	{
		$CI =& get_instance();
		$CI->load->model('Invoices');
		$CI->load->model('Web_settings');
		$CI->load->library('occational');
		$invoice_detail = $CI->Invoices->retrieve_invoice_html_data($invoice_id);
        $taxfield = $CI->db->select('*')
                ->from('tax_settings')
                ->where('is_show',1)
                ->get()
                ->result_array();
        $txregname ='';
        foreach($taxfield as $txrgname){
        $regname = $txrgname['tax_name'].' Reg No  - '.$txrgname['reg_no'].', ';
        $txregname .= $regname;
        }       
	
		$subTotal_quantity = 0;
		$subTotal_cartoon = 0;
		$subTotal_discount = 0;
		$subTotal_ammount = 0;
		if(!empty($invoice_detail)){
			foreach($invoice_detail as $k=>$v){
				$invoice_detail[$k]['final_date'] = $CI->occational->dateConvert($invoice_detail[$k]['date']);
				$subTotal_quantity = $subTotal_quantity+$invoice_detail[$k]['quantity'];
				$subTotal_ammount = $subTotal_ammount+$invoice_detail[$k]['total_price'];
			}

			$i=0;
			foreach($invoice_detail as $k=>$v){$i++;
			   $invoice_detail[$k]['sl']=$i;
			}
		}

		$currency_details = $CI->Web_settings->retrieve_setting_editdata();
		$company_info = $CI->Invoices->retrieve_company();
		$data=array(
			'title'				=>	display('invoice_details'),
			'invoice_id'		=>	$invoice_detail[0]['invoice_id'],
			'invoice_no'		=>	$invoice_detail[0]['invoice'],
			'invoice_discount'	=>	number_format($invoice_detail[0]['invoice_discount'], 2, '.', ','),
			'customer_name'		=>	$invoice_detail[0]['customer_name'],
			'customer_address'	=>	$invoice_detail[0]['customer_address'],
			'customer_mobile'	=>	$invoice_detail[0]['customer_mobile'],
			'customer_email'	=>	$invoice_detail[0]['customer_email'],
			'final_date'		=>	$invoice_detail[0]['final_date'],
			'invoice_details'  =>   $invoice_detail[0]['invoice_details'],
			'total_amount'		=>	$invoice_detail[0]['total_amount'],
			'subTotal_quantity'	=>	$subTotal_quantity,
			'total_discount'	=>	number_format($invoice_detail[0]['total_discount'], 2, '.', ','),
			'total_tax'			=>	number_format($invoice_detail[0]['total_tax'], 2, '.', ','),
			'subTotal_ammount'	=>	number_format($subTotal_ammount, 2, '.', ','),
			'paid_amount'		=>	$invoice_detail[0]['paid_amount'],
			'due_amount'		=>	$invoice_detail[0]['due_amount'],
			 'previous'         =>  number_format($invoice_detail[0]['prevous_due'], 2, '.', ','),
			'invoice_all_data'	=>	$invoice_detail,
			'company_info'		=>	$company_info,
			'currency' 			=> 	$currency_details[0]['currency'],
			'position' 			=> 	$currency_details[0]['currency_position'],
			'discount_type'  	=>  $currency_details[0]['discount_type'],
			'tax_regno'         =>  $txregname,
		);

		$chapterList = $CI->parser->parse('invoice/invoice_html',$data,true);
		return $chapterList;
	}

	 public function invoice_html_data_manual($invoice_id) {
		$CI =& get_instance();
		$CI->load->model('Invoices');
		$CI->load->model('Web_settings');
		$CI->load->library('occational');
		$invoice_detail = $CI->Invoices->retrieve_invoice_html_data($invoice_id);
        $taxfield = $CI->db->select('*')
                ->from('tax_settings')
                ->where('is_show',1)
                ->get()
                ->result_array();
        $txregname ='';
        foreach($taxfield as $txrgname){
        $regname = $txrgname['tax_name'].' Reg No  - '.$txrgname['reg_no'].', ';
        $txregname .= $regname;
        }       
	
		$subTotal_quantity = 0;
		$subTotal_cartoon = 0;
		$subTotal_discount = 0;
		$subTotal_ammount = 0;
		if(!empty($invoice_detail)){
			foreach($invoice_detail as $k=>$v){
				$invoice_detail[$k]['final_date'] = $CI->occational->dateConvert($invoice_detail[$k]['date']);
				$subTotal_quantity = $subTotal_quantity+$invoice_detail[$k]['quantity'];
				$subTotal_ammount = $subTotal_ammount+$invoice_detail[$k]['total_price'];
			}

			$i=0;
			foreach($invoice_detail as $k=>$v){$i++;
			   $invoice_detail[$k]['sl']=$i;
			}
		}

		$currency_details = $CI->Web_settings->retrieve_setting_editdata();
		$company_info = $CI->Invoices->retrieve_company();
		$data=array(
			'title'				=>	display('invoice_details'),
			'invoice_id'		=>	$invoice_detail[0]['invoice_id'],
			'invoice_no'		=>	$invoice_detail[0]['invoice'],
			'invoice_discount'	=>	number_format($invoice_detail[0]['invoice_discount'], 2, '.', ','),
			'customer_name'		=>	$invoice_detail[0]['customer_name'],
			'customer_address'	=>	$invoice_detail[0]['customer_address'],
			'customer_mobile'	=>	$invoice_detail[0]['customer_mobile'],
			'customer_email'	=>	$invoice_detail[0]['customer_email'],
			'final_date'		=>	$invoice_detail[0]['final_date'],
			'invoice_details'  =>   $invoice_detail[0]['invoice_details'],
			'total_amount'		=>	number_format($invoice_detail[0]['total_amount'], 2, '.', ','),
			'subTotal_quantity'	=>	$subTotal_quantity,
			'total_discount'	=>	number_format($invoice_detail[0]['total_discount'], 2, '.', ','),
			'total_tax'			=>	number_format($invoice_detail[0]['total_tax'], 2, '.', ','),
			'subTotal_ammount'	=>	number_format($subTotal_ammount, 2, '.', ','),
			'paid_amount'		=>	number_format($invoice_detail[0]['paid_amount'], 2, '.', ','),
			'due_amount'		=>	number_format($invoice_detail[0]['due_amount'], 2, '.', ','),
			 'previous'         => number_format($invoice_detail[0]['prevous_due'], 2, '.', ','),
			'invoice_all_data'	=>	$invoice_detail,
			'company_info'		=>	$company_info,
			'currency' 			=> 	$currency_details[0]['currency'],
			'position' 			=> 	$currency_details[0]['currency_position'],
			'discount_type'  	=> $currency_details[0]['discount_type'],
			'tax_regno'         => $txregname,
		);

		$chapterList = $CI->parser->parse('invoice/invoice_html_manual',$data,true);
		return $chapterList;
	 }

	//POS invoice html Data
	public function pos_invoice_html_data($invoice_id)
	{
		$CI =& get_instance();
		$CI->load->model('Invoices');
		$CI->load->model('Web_settings');
		$CI->load->library('occational');
		$invoice_detail = $CI->Invoices->retrieve_invoice_html_data($invoice_id);
	
		$subTotal_quantity = 0;
		$subTotal_cartoon = 0;
		$subTotal_discount = 0;
		$subTotal_ammount = 0;
		if(!empty($invoice_detail)){
			foreach($invoice_detail as $k=>$v){
				$invoice_detail[$k]['final_date'] = $CI->occational->dateConvert($invoice_detail[$k]['date']);
				$subTotal_quantity = $subTotal_quantity+$invoice_detail[$k]['quantity'];
				$subTotal_ammount = $subTotal_ammount+$invoice_detail[$k]['total_price'];
			}

			$i=0;
			foreach($invoice_detail as $k=>$v){$i++;
			   $invoice_detail[$k]['sl']=$i;
			}
		}

		$currency_details = $CI->Web_settings->retrieve_setting_editdata();
		$company_info = $CI->Invoices->retrieve_company();
		$data=array(
			'ttile'				=>	display('invoice_details'),
			'invoice_id'		=>	$invoice_detail[0]['invoice_id'],
			'invoice_no'		=>	$invoice_detail[0]['invoice'],
			'invoice_discount'	=>	number_format($invoice_detail[0]['invoice_discount'], 2, '.', ','),

			'customer_name'		=>	$invoice_detail[0]['customer_name'],
			'customer_address'	=>	$invoice_detail[0]['customer_address'],
			'customer_mobile'	=>	$invoice_detail[0]['customer_mobile'],
			'customer_email'	=>	$invoice_detail[0]['customer_email'],
			'final_date'		=>	$invoice_detail[0]['final_date'],
			'invoice_details'   =>   $invoice_detail[0]['invoice_details'],

			'total_amount'		=>	$invoice_detail[0]['total_amount'],
			'subTotal_cartoon'	=>	$subTotal_cartoon,
			'subTotal_quantity'	=>	$subTotal_quantity,
			'total_discount'	=>	number_format($invoice_detail[0]['total_discount'], 2, '.', ','),
			'total_tax'			=>	number_format($invoice_detail[0]['total_tax'], 2, '.', ','),
			'subTotal_ammount'	=>	number_format($subTotal_ammount, 2, '.', ','),
			'paid_amount'		=>	$invoice_detail[0]['paid_amount'],
			'due_amount'		=>	number_format($invoice_detail[0]['due_amount'], 2, '.', ','),
			'invoice_all_data'	=>	$invoice_detail,
			'company_info'		=>	$company_info,
			'currency' 			=> $currency_details[0]['currency'],
			'position' 			=> $currency_details[0]['currency_position'],
			'discount_type'  	=>  $currency_details[0]['discount_type'],
			);

		$chapterList = $CI->parser->parse('invoice/pos_invoice_html',$data,true);
		return $chapterList;
	}


	public function pos_invoice_html_data_manual($invoice_id) {

			$CI =& get_instance();
		$CI->load->model('Invoices');
		$CI->load->model('Web_settings');
		$CI->load->library('occational');
		$invoice_detail = $CI->Invoices->retrieve_invoice_html_data($invoice_id);
	
		$subTotal_quantity = 0;
		$subTotal_cartoon = 0;
		$subTotal_discount = 0;
		$subTotal_ammount = 0;
		if(!empty($invoice_detail)){
			foreach($invoice_detail as $k=>$v){
				$invoice_detail[$k]['final_date'] = $CI->occational->dateConvert($invoice_detail[$k]['date']);
				$subTotal_quantity = $subTotal_quantity+$invoice_detail[$k]['quantity'];
				$subTotal_ammount = $subTotal_ammount+$invoice_detail[$k]['total_price'];
			}

			$i=0;
			foreach($invoice_detail as $k=>$v){$i++;
			   $invoice_detail[$k]['sl']=$i;
			}
		}

		$currency_details = $CI->Web_settings->retrieve_setting_editdata();
		$company_info = $CI->Invoices->retrieve_company();
		$data=array(
			'ttile'				=>	display('invoice_details'),
			'invoice_id'		=>	$invoice_detail[0]['invoice_id'],
			'invoice_no'		=>	$invoice_detail[0]['invoice'],
			'invoice_discount'	=>	number_format($invoice_detail[0]['invoice_discount'], 2, '.', ','),

			'customer_name'		=>	$invoice_detail[0]['customer_name'],
			'customer_address'	=>	$invoice_detail[0]['customer_address'],
			'customer_mobile'	=>	$invoice_detail[0]['customer_mobile'],
			'customer_email'	=>	$invoice_detail[0]['customer_email'],
			'final_date'		=>	$invoice_detail[0]['final_date'],
			'invoice_details'   =>  $invoice_detail[0]['invoice_details'],
			'total_amount'		=>	$invoice_detail[0]['total_amount'],
			'subTotal_cartoon'	=>	$subTotal_cartoon,
			'subTotal_quantity'	=>	$subTotal_quantity,
			'total_discount'	=>	number_format($invoice_detail[0]['total_discount'], 2, '.', ','),
			'total_tax'			=>	number_format($invoice_detail[0]['total_tax'], 2, '.', ','),
			'subTotal_ammount'	=>	number_format($subTotal_ammount, 2, '.', ','),
			'paid_amount'		=>	$invoice_detail[0]['paid_amount'],
			'due_amount'		=>	number_format($invoice_detail[0]['due_amount'], 2, '.', ','),
			'invoice_all_data'	=>	$invoice_detail,
			'company_info'		=>	$company_info,
			'currency' 			=>  $currency_details[0]['currency'],
			'position' 			=>  $currency_details[0]['currency_position'],
			'discount_type'  	=>  $currency_details[0]['discount_type'],
			);

		$chapterList = $CI->parser->parse('invoice/pos_invoice_html_direct',$data,true);
		return $chapterList;

	}
}
?>