<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_dashboard extends CI_Controller {
	
	function __construct() {
      	parent::__construct();
	  	$this->template->current_menu = 'home';
	  	$this->load->model('Web_settings');
    }

    public function index(){
    	$CI =& get_instance();
		$CI->load->library('lreport');
		$CI->load->library('occational');
		if (!$this->auth->is_logged())
		{
		$this->output->set_header("Location: ".base_url().'Admin_dashboard/login', TRUE, 302);
		}
		$this->auth->check_admin_auth();

	  	$CI->load->model('Customers');
	    $CI->load->model('Products');
	    $CI->load->model('Manufacturers');
	    $CI->load->model('Invoices');
	    $CI->load->model('Purchases');
	    $CI->load->model('Reports');
	    $CI->load->model('Web_settings');
	    $total_customer      = $CI->Customers->count_customer();
	    $total_product       = $CI->Products->count_product();
	    $total_manufacturers = $CI->Manufacturers->count_manufacturer();
	    $total_sales         = $CI->Invoices->count_invoice();
	    $total_purchase      = $CI->Reports->todays_total_purchase();
	    $out_of_stock        = $CI->Reports->out_of_stock_count();
	    $out_of_date         = $CI->Reports->out_of_date_count();
      	$monthly_sales_report= 0;
	    $sales_report        = $CI->Reports->todays_total_sales_report();	
		$currency_details    = $CI->Web_settings->retrieve_setting_editdata();
		$best_sales_product  = $CI->Invoices->best_sales_products();
		$total_sales_amount  = $CI->Reports->total_sales_amount();
		$total_cash_receive  = $CI->Reports->total_cash_receive();
		$total_bank_receive  = $CI->Reports->total_bank_receive();
		$total_due_amount    = $CI->Reports->total_due_amount();
		$total_service_amount= $CI->Reports->total_service_amount();
		$pie_total_sale      = $CI->Reports->pie_total_saleamount();
		$pie_total_purchase  = $CI->Reports->pie_total_purchaseamount();
		$pie_total_service   = $CI->Reports->pie_total_serviceamount();
		$pie_total_expense   = $CI->Reports->pie_total_expenseamount();
		$pie_total_salary    = $CI->Reports->pie_total_salaryamount();
        $chart_label = $chart_data = '';
		if (!empty($best_sales_product))
		    for ($i = 0; $i < 50; $i++) {
		        $chart_label .= (!empty($best_sales_product[$i]) ?  $best_sales_product[$i]->product_name . ', ' : null);
		        $chart_data .= (!empty($best_sales_product[$i]) ? $best_sales_product[$i]->quantity . ', ' : null);
		    }
	    $data = array(
	    	'title' 			=> display('dashboard'), 
	    	'total_customer' 	=> $total_customer,
	    	'total_product' 	=> $total_product,
	    	'total_manufacturers'=> $total_manufacturers,
	    	'total_sales' 		=> $total_sales,
	    	'total_purchase' 	=> $total_purchase,
	    	'stockout'          => (!empty($out_of_stock)?$out_of_stock:0),
	    	'expired'           => (!empty($out_of_date)?$out_of_date:0),
	    	'purchase_amount' 	=> (!empty($total_purchase[0]['total_purchase'])?number_format($total_purchase[0]['total_purchase'], 2, '.', ','):0),
	    	'sales_amount' 		=> (!empty($sales_report[0]['total_sale'])?number_format($sales_report[0]['total_sale'], 2, '.', ','):0),
	    	'currency' 			=> $currency_details[0]['currency'],
			'position' 			=> $currency_details[0]['currency_position'],
			'chart_label'       => $chart_label,
            'chart_data'        => $chart_data,
            'total_sales_amount'=> $total_sales_amount,
            'total_cash_receive'=> (!empty($total_cash_receive)?number_format($total_cash_receive, 2, '.', ','):0),
             'total_bank_receive'=> (!empty($total_bank_receive)?number_format($total_bank_receive, 2, '.', ','):0),
             'total_due_amount' => (!empty($total_due_amount)?number_format($total_due_amount, 2, '.', ','):0),
             'total_service_amount'=> (!empty($total_service_amount)?number_format($total_service_amount, 2, '.', ','):0),
             'pie_total_sale'     => $pie_total_sale,
             'pie_total_purchase' => $pie_total_purchase,
             'pie_total_service'  => $pie_total_service,
             'pie_total_expense'  => $pie_total_expense,
             'pie_total_salary'   => $pie_total_salary,
	    	);

		$content = $CI->parser->parse('include/admin_home',$data,true);
		$this->template->full_admin_html_view($content);
		
    }
    //Today All Report
	public function all_report()
	{
		$CI =& get_instance();
		$CI->load->library('lreport');
		$content = $CI->lreport->retrieve_all_reports();
		$this->template->full_admin_html_view($content);
	}
	#==============Todays_sales_report============#
	public function todays_sales_report()
	{
		$CI =& get_instance();
		$CI->load->library('lreport');
		$this->auth->check_admin_auth();
		$content = $CI->lreport->todays_sales_report();
		$this->template->full_admin_html_view($content);
	}
	#================todays_purchase_report========#
	public function todays_purchase_report()
	{
		$CI =& get_instance();
		$CI->load->library('lreport');
		$this->auth->check_admin_auth();
		$content = $CI->lreport->todays_purchase_report();
		$this->template->full_admin_html_view($content);
	}
	#=============Total profit report===================#
	public function total_profit_report(){
		if ($this->session->userdata('user_type') == '2') {
            $this->session->set_userdata(array('error_message'=>display('you_are_not_access_this_part')));
            redirect('Admin_dashboard');
        }
		$CI =& get_instance();
		$CI->load->library('lreport');
		$CI->load->model('Reports');
		$this->auth->check_admin_auth();
		#
        #pagination starts
        #
        $config["base_url"] = base_url('Admin_dashboard/total_profit_report/');
        $config["total_rows"] = $this->Reports->total_profit_report_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config["num_links"] = 5; 
        /* This Application Must Be Used With BootStrap 3 * */
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $links = $this->pagination->create_links();
        #
        #pagination ends
        #  
        $content =$this->lreport->total_profit_report($links,$config["per_page"],$page);

		$this->template->full_admin_html_view($content);
	}
	#==============Date wise profit report=============#
	public function retrieve_dateWise_profit_report()
	{
		if ($this->session->userdata('user_type') == '2') {
            $this->session->set_userdata(array('error_message'=>display('you_are_not_access_this_part')));
            redirect('Admin_dashboard');
        }
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->library('lreport');
		$start_date = $this->input->post('from_date',true);		
		$end_date   = $this->input->post('to_date',true);	
        $content    = $CI->lreport->retrieve_dateWise_profit_report($start_date,$end_date);
		$this->template->full_admin_html_view($content);
	}
	#============Date wise sales report==============#
	public function retrieve_dateWise_SalesReports()
	{
		if ($this->session->userdata('user_type') == '2') {
            $this->session->set_userdata(array('error_message'=>display('you_are_not_access_this_part')));
            redirect('Admin_dashboard');
        }
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->library('lreport');
		$from_date = $this->input->post('from_date',true);		
		$to_date   = $this->input->post('to_date',true);	
        $content   = $CI->lreport->retrieve_dateWise_SalesReports($from_date,$to_date);
		$this->template->full_admin_html_view($content);
	}	
	#==============Date wise purchase report=============#
	public function retrieve_dateWise_PurchaseReports()
	{
		if ($this->session->userdata('user_type') == '2') {
            $this->session->set_userdata(array('error_message'=>display('you_are_not_access_this_part')));
            redirect('Admin_dashboard');
        }
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->library('lreport');
		$start_date = $this->input->post('from_date',true);		
		$end_date   = $this->input->post('to_date',true);	
        $content    = $CI->lreport->retrieve_dateWise_PurchaseReports($start_date,$end_date);
		$this->template->full_admin_html_view($content);
	}
	#==============Product sales report date wise===========#
	public function product_sales_reports_date_wise()
	{
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->library('lreport');	
		$CI->load->model('Reports');
		#
        #pagination starts
        #
        $config["base_url"] = base_url('Admin_dashboard/product_sales_reports_date_wise/');
        $config["total_rows"] = $this->Reports->retrieve_product_sales_report_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config["num_links"] = 5; 
        /* This Application Must Be Used With BootStrap 3 * */
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $links = $this->pagination->create_links();
        #
        #pagination ends
        #  
        $content =$this->lreport->get_products_report_sales_view($links,$config["per_page"],$page);

		$this->template->full_admin_html_view($content);
	}
	#==============Product sales search reports============#
	public function product_sales_search_reports()
	{
		if ($this->session->userdata('user_type') == '2') {
            $this->session->set_userdata(array('error_message'=>display('you_are_not_access_this_part')));
            redirect('Admin_dashboard');
        }
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->library('lreport');
		$from_date = $this->input->get('from_date');		
		$to_date   = $this->input->get('to_date');	
        $content   = $CI->lreport->get_products_search_report($from_date,$to_date);
		$this->template->full_admin_html_view($content);
	}
	#============User login=========#
	public function login()
	{	
		if ($this->auth->is_logged() )
		{
			$this->output->set_header("Location: ".base_url().'Admin_dashboard', TRUE, 302);
		}
		$data['title'] = display('admin_login_area');
        $content = $this->parser->parse('user/admin_login_form',$data,true);
		$this->template->full_admin_html_view($content);
	}
	#==============Valid user check=======#
	public function do_login(){

		$error = '';
		$setting_detail = $this->Web_settings->retrieve_setting_editdata(); 

		if ($setting_detail[0]['captcha'] == 0 && $setting_detail[0]['secret_key'] != null && $setting_detail[0]['site_key'] != null) {

			$this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'required|callback_validate_captcha');
			$this->form_validation->set_message('validate_captcha', 'Please check the the captcha form');

			if ($this->form_validation->run() == FALSE){
				$this->session->set_userdata(array('error_message'=>display('please_enter_valid_captcha')));
				$this->output->set_header("Location: ".base_url().'Admin_dashboard/login', TRUE, 302);
			}
			else{
				$username = $this->input->post('username',true);
				$password = $this->input->post('password',true);
				if ( $username == '' || $password == '' || $this->auth->login($username, $password) === FALSE ){
					$error = display('wrong_username_or_password');
				}
				if ( $error != '' ){
					$this->session->set_userdata(array('error_message'=>$error));
					$this->output->set_header("Location: ".base_url().'Admin_dashboard/login', TRUE, 302);
				}
				else{
					$this->output->set_header("Location: ".base_url(), TRUE, 302);
		        }
			}
		}
		else{
			$username = $this->input->post('username',true);
			$password = $this->input->post('password',true);
			if ( $username == '' || $password == '' || $this->auth->login($username, $password) === FALSE ){
				$error = display('wrong_username_or_password');
			}
			if ( $error != '' ){
				$this->session->set_userdata(array('error_message'=>$error));
				$this->output->set_header("Location: ".base_url().'Admin_dashboard/login', TRUE, 302);
			}else{
				$this->output->set_header("Location: ".base_url(), TRUE, 302);
	        }
		}
	}

	//Valid captcha check
	function validate_captcha() { 
	  	$captcha = $this->input->post('g-recaptcha-response'); 
		$url = "www.google.com/recaptcha/api/siteverify?secret=6LdiKhsUAAAAABH4BQCIvBar7Oqe-2LwDKxMSX-t&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR'];
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$contents = curl_exec($ch);
		if (curl_errno($ch)) {
		  echo curl_error($ch);
		  echo "\n<br />";
		  $contents = '';
		} else {
		  curl_close($ch);
		}
	 	if ($contents . 'success' == false) { return FALSE; } else { return TRUE; } 
	}

	#===============Logout=======#
	public function logout()
	{	
		if ($this->auth->logout())
		$this->output->set_header("Location: ".base_url().'Admin_dashboard/login', TRUE, 302);
	}
	#=============Edit Profile======#
	public function edit_profile()
	{	
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->library('luser');
		$content = $CI->luser->edit_profile_form();
		$this->template->full_admin_html_view($content);
	}
	#=============Update Profile========#
	public function update_profile()
	{	
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->model('Users');
		$this->Users->profile_update();
		$this->session->set_userdata(array('message'=> display('successfully_updated')));
		redirect(base_url('Admin_dashboard/edit_profile'));
	}
	#=============Change Password=========# 
	public function change_password_form()
	{	
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$content = $CI->parser->parse('user/change_password',array('title'=>display('change_password')),true);
		$this->template->full_admin_html_view($content);
	}
	#============Change Password===========#
	public function change_password()
	{	
		$CI =& get_instance();
		$this->auth->check_admin_auth();
		$CI->load->model('Users'); 

		$error = '';
		$email = $this->input->post('email',true);
		$old_password = $this->input->post('old_password',true);
		$new_password = $this->input->post('password',true);
		$repassword = $this->input->post('repassword',true);
		if ( $email == '' || $old_password == '' || $new_password == '')
		{
			$error = display('blank_field_does_not_accept');
		}else if($email != $this->session->userdata('user_email')){
			$error = display('you_put_wrong_email_address');
		}else if(strlen($new_password)<6 ){
			$error = display('new_password_at_least_six_character');
		}else if($new_password != $repassword ){
			$error = display('password_and_repassword_does_not_match');
		}else if($CI->Users->change_password($email,$old_password,$new_password) === FALSE ){
			$error = display('you_are_not_authorised_person');
		}
		if ( $error != '' )
		{
			$this->session->set_userdata(array('error_message'=>$error));
			$this->output->set_header("Location: ".base_url().'Admin_dashboard/change_password_form', TRUE, 302);
		}else{
			$this->session->set_userdata(array('message'=>display('successfully_changed_password')));
			$this->output->set_header("Location: ".base_url().'Admin_dashboard/change_password_form', TRUE, 302);
        }
	}
	 public function profit_manufacturer_form(){
        $CI =& get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('lreport');
        $content = $CI->lreport->profit_report_manufacturer_form();
        $this->template->full_admin_html_view($content);
        

    } 


    public function closing() {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $data = array('title' => "Reports | Daily Closing");
        $data = $this->Reports->accounts_closing_data();
        $content = $this->parser->parse('accounts/closing_form', $data, true);
        $this->template->full_admin_html_view($content);
    }

      //Closing report
    public function closing_report()
    {
        $CI = & get_instance();
        $CI->load->library('laccounts');
        $content =$this->laccounts->daily_closing_list();
        $this->template->full_admin_html_view($content);
    }
    // Date wise closing reports 
    public function date_wise_closing_reports()
    {    
        $CI = & get_instance();
        $CI->load->library('laccounts');
         $CI->load->model('Accounts');
        $from_date = $this->input->get('from_date');       
        $to_date = $this->input->get('to_date');
        #
        #pagination starts
        #
        $config["base_url"]     = base_url('Admin_dashboard/date_wise_closing_reports/');
        $config["total_rows"]   = $this->Accounts->get_date_wise_closing_report_count($from_date,$to_date);
        $config["per_page"] = 50;
        $config["uri_segment"] = 3;
        $config["num_links"] = 5; 
        $config['suffix'] = '?'. http_build_query($_GET, '', '&');
        $config['first_url'] = $config["base_url"] . $config['suffix'];
        /* This Application Must Be Used With BootStrap 3 * */
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $links = $this->pagination->create_links();
        #
        #pagination ends
        # 
        
        $content = $this->laccounts->get_date_wise_closing_reports($links,$config["per_page"],$page,$from_date,$to_date );
       
        $this->template->full_admin_html_view($content);
    }
	// profit report manufacturer wise
        public function profit_manufacturer(){
        $CI =& get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('lreport');
        $manufacturer_id = $this->input->post('manufacturer_id',true);
        $from_date       = $this->input->post('from_date',true);
        $to_date         = $this->input->post('to_date',true);
        $content = $CI->lreport->profit_report_manufacturer($manufacturer_id,$from_date,$to_date);
        $this->template->full_admin_html_view($content);
        

    } 
// product wise profit report form
     public function profit_productwise_form(){
        $CI =& get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('lreport');
        $content = $CI->lreport->profit_productwise_form();
        $this->template->full_admin_html_view($content);
        

    } 
    
    
    public function profit_loss_salepurchase(){
        $CI =& get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('lreport');
        $from_date = (!empty($this->input->post('from_date',true))?$this->input->post('from_date',true):date('Y-m-d'));
        $to_date   = (!empty($this->input->post('to_date',true))?$this->input->post('to_date',true):date('Y-m-d'));
        $content = $CI->lreport->profit_loss_salepurchase($from_date,$to_date);
        $this->template->full_admin_html_view($content);
        

    }
	// profit report manufacturer wise
       public function profit_productwise(){
        $CI =& get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('lreport');
        $product_id = $this->input->post('product_id',true);
        $from_date  = $this->input->post('from_date',true);
        $to_date    = $this->input->post('to_date',true);
        $content    = $CI->lreport->profit_productwise($product_id,$from_date,$to_date);
        $this->template->full_admin_html_view($content);
        

    } 
    
    public function daily_profit(){
        $CI =& get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('lreport');
        $from_date = (!empty($this->input->post('from_date',true))?$this->input->post('from_date',true):date('Y-m-d'));
        $to_date  = (!empty($this->input->post('to_date',true))?$this->input->post('to_date',true):date('Y-m-d'));
        $content  = $CI->lreport->daily_profit($from_date,$to_date);
        $this->template->full_admin_html_view($content);
    }
}