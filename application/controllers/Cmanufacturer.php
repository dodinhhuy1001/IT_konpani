<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cmanufacturer extends CI_Controller {

    public $manufacturer_id;

    function __construct() {
        parent::__construct();
        $this->db->query('SET SESSION sql_mode = ""');
        $this->load->library('auth');
        $this->load->library('lmanufacturer');
        $this->load->library('session');
        $this->load->model('manufacturers');
        $this->auth->check_admin_auth();
    }

    public function index() {
        $content = $this->lmanufacturer->manufacturer_add_form();
        $this->template->full_admin_html_view($content);
    }

    //Insert manufacturer
    public function insert_manufacturer() {
       
        $data = array(
            'manufacturer_name' => $this->input->post('manufacturer_name',TRUE),
            'address'       => $this->input->post('address',TRUE),
            'address2'      => $this->input->post('address2',TRUE),
            'mobile'        => $this->input->post('mobile',TRUE),
            'phone'         => $this->input->post('phone',TRUE),
            'contact'       => $this->input->post('contact',TRUE),
            'emailnumber'   => $this->input->post('email',TRUE),
            'email_address' => $this->input->post('emailaddress',TRUE),
            'fax'           => $this->input->post('fax',TRUE),
            'city'          => $this->input->post('city',TRUE),
            'state'         => $this->input->post('state',TRUE),
            'zip'           => $this->input->post('zip',TRUE),
            'country'       => $this->input->post('country',TRUE),
            'details'       => $this->input->post('details',TRUE),
            'status'        => 1
        );
         
        $this->db->insert('manufacturer_information',$data);


         $manufacturer_id = $this->db->insert_id();
          $coa = $this->manufacturers->headcode();
        if($coa->HeadCode!=NULL){
            $headcode=$coa->HeadCode+1;
        }
        else{
            $headcode="502000001";
        }
             $c_acc=$this->input->post('manufacturer_name',TRUE).'-'.$manufacturer_id;
        $createby=$this->session->userdata('user_id');
        $createdate=date('Y-m-d H:i:s');
        $manufacturer_coa = [
              'HeadCode'       => $headcode,
            'HeadName'         => $c_acc,
            'PHeadName'        => 'Account Payable',
            'HeadLevel'        => '3',
            'IsActive'         => '1',
            'IsTransaction'    => '1',
            'IsGL'             => '0',
            'HeadType'         => 'L',
            'IsBudget'         => '0',
            'manufacturer_id'  => $manufacturer_id,
            'IsDepreciation'   => '0',
            'DepreciationRate' => '0',
            'CreateBy'         => $createby,
            'CreateDate'       => $createdate,
        ];
            //Previous balance adding -> Sending to manufacturer model to adjust the data.
            $this->db->insert('acc_coa',$manufacturer_coa);
            $this->manufacturers->previous_balance_add($this->input->post('previous_balance',TRUE), $manufacturer_id,$c_acc,$this->input->post('manufacturer_name',TRUE));
            
            $this->session->set_userdata(array('message' => display('successfully_added')));
            if (isset($_POST['add-manufacturer'])) {
                redirect(base_url('Cmanufacturer/manage_manufacturer'));
                exit;
            } elseif (isset($_POST['add-manufacturer-another'])) {
                redirect(base_url('Cmanufacturer'));
                exit;
            }
     
    }

    //Manage manufacturer
    public function manage_manufacturer() {
        $CI =& get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('lmanufacturer');
        $CI->load->model('manufacturers');
        $content =$this->lmanufacturer->manufacturer_list();
        $this->template->full_admin_html_view($content);
    }

        public function CheckmanufacturerList(){
        // GET data
        $this->load->model('manufacturers');
        $postData = $this->input->post();
        $data = $this->manufacturers->getmanufacturerList($postData);
        echo json_encode($data);
    } 

    // search manufacturer 
    public function search_manufacturer() {
        $manufacturer_id = $this->input->post('manufacturer_id',TRUE);
        $content = $this->lmanufacturer->manufacturer_search($manufacturer_id);
        $this->template->full_admin_html_view($content);
    }

    //manufacturer Update Form
    public function manufacturer_update_form($manufacturer_id) {
        $content = $this->lmanufacturer->manufacturer_edit_data($manufacturer_id);

        $this->template->full_admin_html_view($content);
    }

    // manufacturer Update
    public function manufacturer_update() {
        $manufacturer_id = $this->input->post('manufacturer_id',TRUE);
        $old_headnam = $this->input->post('oldname',TRUE).'-'.$manufacturer_id;
        $c_acc=$this->input->post('manufacturer_name',TRUE).'-'.$manufacturer_id;
        $data = array(
            'manufacturer_name' => $this->input->post('manufacturer_name',TRUE),
            'address'       => $this->input->post('address',TRUE),
            'address2'      => $this->input->post('address2',TRUE),
            'mobile'        => $this->input->post('mobile',TRUE),
            'phone'         => $this->input->post('phone',TRUE),
            'contact'       => $this->input->post('contact',TRUE),
            'emailnumber'   => $this->input->post('email',TRUE),
            'email_address' => $this->input->post('emailaddress',TRUE),
            'fax'           => $this->input->post('fax',TRUE),
            'city'          => $this->input->post('city',TRUE),
            'state'         => $this->input->post('state',TRUE),
            'zip'           => $this->input->post('zip',TRUE),
            'country'       => $this->input->post('country',TRUE),
            'details'       => $this->input->post('details',TRUE)
        );
         $manufacturer_coa = [
             'HeadName'         => $c_acc
        ];
        $result = $this->manufacturers->update_manufacturer($data, $manufacturer_id);
        if ($result == TRUE) {
        $this->db->where('HeadName', $old_headnam);
        $this->db->update('acc_coa', $manufacturer_coa);
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Cmanufacturer/manage_manufacturer'));
        exit;
    }else{
        $this->session->set_userdata(array('error_message' => display('please_try_again'))); 
         redirect(base_url('Cmanufacturer/manage_manufacturer'));
    }
    }

    //manufacturer Search Item
    public function manufacturer_search_item() {
        $manufacturer_id = $this->input->post('manufacturer_id',TRUE);
        $content = $this->lmanufacturer->manufacturer_search_item($manufacturer_id);
        $this->template->full_admin_html_view($content);
    }

    // manufacturer Delete from System
    public function manufacturer_delete($manufacturer_id) {
        $invoiceinfo = $this->db->select('*')->from('product_purchase')->where('manufacturer_id',$manufacturer_id)->get()->num_rows();
          if($invoiceinfo > 0){
      $this->session->set_userdata(array('error_message' => 'Sorry !! You can not delete this Manufacturer.This Manufacturer already Engaged in calculation system!'));
  redirect(base_url('Cmanufacturer/manage_manufacturer'));
    }else{
        $this->manufacturers->delete_manufacturer($manufacturer_id);
        $this->session->set_userdata(array('message' => display('successfully_delete')));
       redirect(base_url('Cmanufacturer/manage_manufacturer'));
   }
    }


    public function manufacturer_details($manufacturer_id) {
        $content = $this->lmanufacturer->manufacturer_detail_data($manufacturer_id);
        $this->manufacturer_id = $manufacturer_id;
        $this->template->full_admin_html_view($content);
    }

    //manufacturer Ledger Book
    public function manufacturer_ledger() {
        $start = $this->input->post('from_date',TRUE);
        $end = $this->input->post('to_date',TRUE);

        $manufacturer_id = $this->input->post('manufacturer_id',TRUE);
       

        $content = $this->lmanufacturer->manufacturer_ledger($manufacturer_id, $start, $end);

        $this->template->full_admin_html_view($content);
    }

    public function manufacturer_ledger_report() {
        $config["base_url"] = base_url('Cmanufacturer/manufacturer_ledger_report/');
        $config["total_rows"] = $this->manufacturers->count_manufacturer_product_info();
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
        $content = $this->lmanufacturer->manufacturer_ledger_report($links, $config["per_page"], $page);
        $this->template->full_admin_html_view($content);
    }

    // manufacturer wise sales report details
    public function manufacturer_sales_details() {
        $start = $this->input->post('from_date',TRUE);
        $end = $this->input->post('to_date',TRUE);
        $manufacturer_id = $this->uri->segment(3);

        $content = $this->lmanufacturer->manufacturer_sales_details($manufacturer_id, $start, $end);
        $this->template->full_admin_html_view($content);
    }



    // search report 
    public function search_manufacturer_report() {
        $start = $this->input->post('from_date',TRUE);
        $end = $this->input->post('to_date',TRUE);

        $content = $this->lpayment->result_datewise_data($start, $end);
        $this->template->full_admin_html_view($content);
    }

    //manufacturer sales details all from menu
    public function manufacturer_sales_details_all() {
        $config["base_url"] = base_url('Cmanufacturer/manufacturer_sales_details_all/');
        $config["total_rows"] = $this->manufacturers->manufacturer_sales_details_count_all();
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
        $content = $this->lmanufacturer->manufacturer_sales_details_allm($links, $config["per_page"], $page);

        $this->template->full_admin_html_view($content);
    }



        public function manufacturer_sales_details_datewise() {
        $fromdate = $this->input->get('from_date',TRUE);
        $todate = $this->input->get('to_date',TRUE);      
        $config["base_url"] = base_url('Cmanufacturer/manufacturer_sales_details_datewise/');
        $config["total_rows"] = $this->manufacturers->manufacturer_sales_details_datewise_count($fromdate,$todate);
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
        $content = $this->lmanufacturer->manufacturer_sales_details_datewise($links, $config["per_page"], $page,$fromdate,$todate);

        $this->template->full_admin_html_view($content);
    }

    // manufacturer ledger for manufacturer information 
    public function manufacturer_ledger_info($manufacturer_id) {
        $content = $this->lmanufacturer->manufacturer_ledger_info($manufacturer_id);
        $this->manufacturer_id = $manufacturer_id;
        $this->template->full_admin_html_view($content);
    }
// ============================= CSV manufacturer UPLOAD  ======================================
        //CSV Manufacturer Add From here
    function uploadCsv_manufacturer()
    {
        $filename = $_FILES['upload_csv_file']['name'];
        
        $ext = end(explode('.', $filename));
        $ext = substr(strrchr($filename, '.'), 1);
        if($ext == 'csv'){
        $count=0;
        $fp = fopen($_FILES['upload_csv_file']['tmp_name'],'r') or die("can't open file");

        if (($handle = fopen($_FILES['upload_csv_file']['tmp_name'], 'r')) !== FALSE)
        {
  
         while($csv_line = fgetcsv($fp,1024)){
                //keep this if condition if you want to remove the first row
                for($i = 0, $j = count($csv_line); $i < $j; $i++)
                {                  
           $insert_csv = array();
           $insert_csv['manufacturer_name'] = (!empty($csv_line[0])?$csv_line[0]:null);
           $insert_csv['email'] = (!empty($csv_line[1])?$csv_line[1]:'');
           $insert_csv['emailaddress'] = (!empty($csv_line[2])?$csv_line[2]:'');
           $insert_csv['mobile'] = (!empty($csv_line[3])?$csv_line[3]:'');
           $insert_csv['phone'] = (!empty($csv_line[4])?$csv_line[4]:'');
           $insert_csv['fax'] = (!empty($csv_line[5])?$csv_line[5]:'');
           $insert_csv['contact'] = (!empty($csv_line[6])?$csv_line[6]:'');
           $insert_csv['city'] = (!empty($csv_line[7])?$csv_line[7]:'');
           $insert_csv['state'] = (!empty($csv_line[8])?$csv_line[8]:'');
           $insert_csv['zip'] = (!empty($csv_line[9])?$csv_line[9]:'');
           $insert_csv['country'] = (!empty($csv_line[10])?$csv_line[10]:'');
           $insert_csv['address'] = (!empty($csv_line[11])?$csv_line[11]:'');
           $insert_csv['address2'] = (!empty($csv_line[12])?$csv_line[12]:'');
           $insert_csv['previousbalance'] = (!empty($csv_line[13])?$csv_line[13]:0);
                }
                $depid = date('Ymdis');
                $manufacturerdata = array(  
           'manufacturer_name'  => $insert_csv['manufacturer_name'],
            'address'       => $insert_csv['address'],
            'address2'      => $insert_csv['address2'],
            'mobile'        => $insert_csv['mobile'],
            'phone'         => $insert_csv['phone'],
            'contact'       => $insert_csv['contact'],
            'emailnumber'   => $insert_csv['email'],
            'email_address' => $insert_csv['emailaddress'],
            'fax'           => $insert_csv['fax'],
            'city'          => $insert_csv['city'],
            'state'         => $insert_csv['state'],
            'zip'           => $insert_csv['zip'],
            'country'       => $insert_csv['country'],
            'status'        => 1
                );

                if ($count > 0) {
                    $this->db->insert('manufacturer_information',$manufacturerdata);

                $manufacturer_id    = $this->db->insert_id();
                $transaction_id = $this->auth->generator(10);


        $coa = $this->manufacturers->headcode();
        if($coa->HeadCode!=NULL){
            $headcode=$coa->HeadCode+1;
        }
        else{
            $headcode="502000001";
        }
        $c_acc=$insert_csv['manufacturer_name'].'-'.$manufacturer_id;
        $createby=$this->session->userdata('user_id');
        $createdate=date('Y-m-d H:i:s');

         $manufacturer_coa = [
            'HeadCode'         => $headcode,
            'HeadName'         => $c_acc,
            'PHeadName'        => 'Account Payable',
            'HeadLevel'        => '3',
            'IsActive'         => '1',
            'IsTransaction'    => '1',
            'IsGL'             => '0',
            'HeadType'         => 'L',
            'IsBudget'         => '0',
            'IsDepreciation'   => '0',
            'manufacturer_id'  => $manufacturer_id,
            'DepreciationRate' => '0',
            'CreateBy'         => $createby,
            'CreateDate'       => $createdate,
        ];

                     $this->db->insert('acc_coa', $manufacturer_coa);
                     $headcode = $this->db->select('HeadCode')->from('acc_coa')->where('manufacturer_id',$manufacturer_id)->get()->row();

                          $previous = array(
          'VNo'            =>  $transaction_id,
          'Vtype'          =>  'Previous',
          'VDate'          =>  date('Y-m-d'),
          'COAID'          =>  $headcode->HeadCode,
          'Narration'      =>  'Previous Balane For New manufacturer',
          'Debit'          =>  0,
          'Credit'         =>  $insert_csv['previousbalance'],
          'IsPosted'       =>  1,
          'CreateBy'       =>  $this->session->userdata('user_id'),
          'CreateDate'     =>  date('Y-m-d H:i:s'),
          'IsAppove'       =>  1
        ); 
                    
                    if($insert_csv['previousbalance'] > 0){
                    $this->db->insert('acc_transaction', $previous);
                    }
                    }  
                $count++; 
            }
            
        }
                        $this->db->select('*');
                        $this->db->from('manufacturer_information');
                        $this->db->where('status',1);
                    $query = $this->db->get();
                    foreach ($query->result() as $row) {
                        $json_manufacturer[] = array('label'=>$row->manufacturer_name,'value'=>$row->manufacturer_id);
                    }
                    $cache_file = './my-assets/js/admin_js/json/manufacturer.json';
                    $manufacturerlist = json_encode($json_manufacturer);
                    file_put_contents($cache_file,$manufacturerlist);
        fclose($fp) or die("can't close file");
        $this->session->set_userdata(array('message'=>display('successfully_added')));
        redirect(base_url('Cmanufacturer/manage_manufacturer'));
    }else{
        $this->session->set_userdata(array('error_message'=>'Please Import Only Csv File'));
        redirect(base_url('Cmanufacturer/manage_manufacturer'));
    }
    
    }
   
        /// manufacturer Advance Form
      public function manufacturer_advance(){
    $data['title'] = display('manufacturer_advance');
    $data['manufacturer_list'] = $this->manufacturers->manufacturer_list_advance();
    $content = $this->parser->parse('manufacturer/manufacturer_advance', $data, true);
    $this->template->full_admin_html_view($content); 
  }
  // manufacturer advane insert
  public function insert_manufacturer_advance(){
    $advance_type = $this->input->post('type',TRUE);
    if($advance_type ==1){
        $dr = $this->input->post('amount',TRUE);
        $tp = 'd';
    }else{
        $cr = $this->input->post('amount',TRUE);
        $tp = 'c';
    }
    
            $createby=$this->session->userdata('user_id');
            $createdate=date('Y-m-d H:i:s');
            $transaction_id=$this->auth->generator(10);
            $manufacturer_id = $this->input->post('manufacturer_id',TRUE);
            $supifo = $this->db->select('*')->from('manufacturer_information')->where('manufacturer_id',$manufacturer_id)->get()->row();
    $headn = $manufacturer_id;
    $coainfo = $this->db->select('*')->from('acc_coa')->where('manufacturer_id',$headn)->get()->row();
    $manufacturer_headcode = $coainfo->HeadCode;
               


                   $manufacturer_accledger = array(
      'VNo'            =>  $transaction_id,
      'Vtype'          =>  'Advance',
      'VDate'          =>  date("Y-m-d"),
      'COAID'          =>  $manufacturer_headcode,
      'Narration'      =>  'manufacturer Advance For '.$supifo->manufacturer_name,
      'Debit'          =>  (!empty($dr)?$dr:0),
      'Credit'         =>  (!empty($cr)?$cr:0),
      'IsPosted'       => 1,
      'CreateBy'       => $this->session->userdata('user_id'),
      'CreateDate'     => date('Y-m-d H:i:s'),
      'IsAppove'       => 1
    );
                    $cc = array(
      'VNo'            =>  $transaction_id,
      'Vtype'          =>  'Advance',
      'VDate'          =>  date("Y-m-d"),
      'COAID'          =>  1020101,
      'Narration'      =>  'Cash in Hand  For '.$supifo->manufacturer_name.' Advance',
      'Debit'          =>  (!empty($dr)?$dr:0),
      'Credit'         =>  (!empty($cr)?$cr:0),
      'IsPosted'       =>  1,
      'CreateBy'       =>  $this->session->userdata('user_id'),
      'CreateDate'     =>  date('Y-m-d H:i:s'),
      'IsAppove'       =>  1
    ); 
                   
       $this->db->insert('acc_transaction',$manufacturer_accledger);
       $this->db->insert('acc_transaction',$cc);
        redirect(base_url('Cmanufacturer/manufacturer_advancercpt/'.$transaction_id.'/'.$manufacturer_id));

  }

       public function new_manufacturer()
    {  
       $this->form_validation->set_rules('manufacturer_name', display('manufacturer_name')  ,'max_length[100]');
        $this->form_validation->set_rules('mobile', display('mobile')  ,'max_length[255]');
        $this->form_validation->set_rules('address', display('address')  ,'max_length[255]');
        $this->form_validation->set_rules('details', display('details')  ,'max_length[255]');
        #-------------------------------#
         $userData = array(
            'manufacturer_name' => $this->input->post('manufacturer_name'), 
            'mobile'   => $this->input->post('mobile'),
            'address'   => $this->input->post('address'),
            'details'   => $this->input->post('details'),
             'status'   => 1,
        );
     
        #-------------------------------#

        if ($this->form_validation->run()) {

            //Check user information
        $insertdata = $this->db->insert('manufacturer_information',$userData);
        $manufacturer_id = $this->db->insert_id();
          $coa = $this->manufacturers->headcode();
        if($coa->HeadCode!=NULL){
            $headcode=$coa->HeadCode+1;
        }
        else{
            $headcode="502000001";
        }
        $c_acc=$this->input->post('manufacturer_name',TRUE).'-'.$manufacturer_id;
        $createby=$this->session->userdata('user_id');
        $createdate=date('Y-m-d H:i:s');
        $manufacturer_coa = [
              'HeadCode'       => $headcode,
            'HeadName'         => $c_acc,
            'PHeadName'        => 'Account Payable',
            'HeadLevel'        => '3',
            'IsActive'         => '1',
            'IsTransaction'    => '1',
            'IsGL'             => '0',
            'HeadType'         => 'L',
            'IsBudget'         => '0',
            'manufacturer_id'  => $manufacturer_id,
            'IsDepreciation'   => '0',
            'DepreciationRate' => '0',
            'CreateBy'         => $createby,
            'CreateDate'       => $createdate,
        ];
            if($insertdata) {
                $this->db->insert('acc_coa',$manufacturer_coa);
                $sData['message'] = 'Successfully saved ';
                echo json_encode($sData);
            }else{
                $data['exception'] = 'Something wrong!';
                echo json_encode($data);
            }
        }else {  
            $data['exception'] = validation_errors();
            //Json encode for user data
            echo json_encode($data);
        }
    }



    public function manufacturer_advancercpt($receiptid = null,$manufacturer_id = null) {
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->library('lmanufacturer');
        $content = $CI->lmanufacturer->advance_details_data($receiptid,$manufacturer_id);
        $this->template->full_admin_html_view($content);
    }



}
