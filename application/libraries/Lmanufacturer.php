<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lmanufacturer {

    //manufacturer add form
    public function manufacturer_add_form() {
        $CI = & get_instance();
        $CI->load->model('manufacturers');
        $CI->load->model('Country_model');
        $data = array(
            'title' => display('add_manufacturer'),
           'country_list' => $CI->Country_model->country(),
        );
        $manufacturerForm = $CI->parser->parse('manufacturer/add_manufacturer_form', $data, true);
        return $manufacturerForm;
    }

    //Insert manufacturer
    public function insert_manufacturer($data) {
        $CI = & get_instance();
        $CI->load->model('manufacturers');
        $result = $CI->manufacturers->manufacturer_entry($data);
        if ($result == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //manufacturer List
    public function manufacturer_list() {
   
        $CI =& get_instance();
        $CI->load->model('manufacturers');
        $CI->load->model('Web_settings');
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data['total_manufacturer']    = $CI->manufacturers->count_manufacturer();
        $data['currency']          = $currency_details[0]['currency'];
        $data['company_info']      = $CI->manufacturers->retrieve_company();
        $manufacturerlist = $CI->parser->parse('manufacturer/manufacturer',$data,true);
        return $manufacturerlist;
    }

    // manufacturer search
    public function manufacturer_search($manufacturer_id) {
        $CI = & get_instance();
        $CI->load->model('manufacturers');
        $manufacturers_list = $CI->manufacturers->manufacturer_search($manufacturer_id);
        $i = 0;
        if (!empty($manufacturers_list)) {
            foreach ($manufacturers_list as $k => $v) {
                $i++;
                $manufacturers_list[$k]['sl'] = $i;
            }
        }

        $data = array(
            'title'          => display('search'),
            'manufacturers_list' => $manufacturers_list,
            'links'          => '',
        );

        $manufacturerList = $CI->parser->parse('manufacturer/manufacturer', $data, true);
        return $manufacturerList;
    }

    //manufacturer Search Item
    public function manufacturer_search_item($manufacturer_id) {
        $CI = & get_instance();
        $CI->load->model('manufacturers');
        $manufacturers_list = $CI->manufacturers->manufacturer_search_item($manufacturer_id);
        $i = 0;
        if ($manufacturers_list) {
            foreach ($manufacturers_list as $k => $v) {
                $i++;
                $manufacturers_list[$k]['sl'] = $i;
            }

            $data = array(
                'title'          => display('manage_suppiler'),
                'manufacturers_list' => $manufacturers_list
            );
            $manufacturerList = $CI->parser->parse('manufacturer/manufacturer', $data, true);
            return $manufacturerList;
        } else {
            redirect('Cmanufacturer/manage_manufacturer');
        }
    }

    //Product search by manufacturer
    public function product_by_search() {
        $CI = & get_instance();
        $CI->load->model('manufacturers');
        $manufacturers_list = $CI->manufacturers->product_search_item($manufacturer_id);
        $i = 0;
        foreach ($manufacturers_list as $k => $v) {
            $i++;
            $manufacturers_list[$k]['sl'] = $i;
        }
        $data = array(
            'title' => display('manage_manufacturer'),
            'manufacturers_list' => $manufacturers_list
        );
        $manufacturerList = $CI->parser->parse('manufacturer/manufacturer', $data, true);
        return $manufacturerList;
    }

    //manufacturer Edit Data
    public function manufacturer_edit_data($manufacturer_id) {
        $CI = & get_instance();
        $CI->load->model('manufacturers');
        $CI->load->model('Country_model');
        $manufacturer_detail = $CI->manufacturers->retrieve_manufacturer_editdata($manufacturer_id);
        $data = array(
            'title'         => display('manufacturer_edit'),
            'manufacturer_id'   => $manufacturer_detail[0]['manufacturer_id'],
            'manufacturer_name' => $manufacturer_detail[0]['manufacturer_name'],
            'address'       => $manufacturer_detail[0]['address'],
            'address2'      => $manufacturer_detail[0]['address2'],
            'mobile'        => $manufacturer_detail[0]['mobile'],
            'emailnumber'   => $manufacturer_detail[0]['emailnumber'],
            'email_address' => $manufacturer_detail[0]['email_address'],
            'phone'         => $manufacturer_detail[0]['phone'],
            'contact'       => $manufacturer_detail[0]['contact'],
            'fax'           => $manufacturer_detail[0]['fax'],
            'city'          => $manufacturer_detail[0]['city'],
            'state'         => $manufacturer_detail[0]['state'],
            'zip'           => $manufacturer_detail[0]['zip'],
            'country'       => $manufacturer_detail[0]['country'],
            'details'       => $manufacturer_detail[0]['details'],
            'country_list'  => $CI->Country_model->country(),
            'status'        => $manufacturer_detail[0]['status']
        );
        $chapterList = $CI->parser->parse('manufacturer/edit_manufacturer_form', $data, true);
        return $chapterList;
    }

    //manufacturer Details Data
    public function manufacturer_detail_data($manufacturer_id) {
        $CI = & get_instance();
        $CI->load->model('manufacturers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $manufacturer_detail = $CI->manufacturers->manufacturer_personal_data($manufacturer_id);
        $purchase_info = $CI->manufacturers->manufacturer_purchase_data($manufacturer_id);
        $total_amount = 0;
        if (!empty($purchase_info)) {
            foreach ($purchase_info as $k => $v) {
                $purchase_info[$k]['final_date'] = $CI->occational->dateConvert($purchase_info[$k]['purchase_date']);
                $total_amount = $total_amount + $purchase_info[$k]['grand_total_amount'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title'            => display('manufacturer_details'),
            'manufacturer_id'      => $manufacturer_detail[0]['manufacturer_id'],
            'manufacturer_name'    => $manufacturer_detail[0]['manufacturer_name'],
            'manufacturer_address' => $manufacturer_detail[0]['address'],
            'manufacturer_mobile'  => $manufacturer_detail[0]['mobile'],
            'details'          => $manufacturer_detail[0]['details'],
            'total_amount'     => number_format($total_amount, 2, '.', ','),
            'purchase_info'    => $purchase_info,
            'currency'         => $currency_details[0]['currency'],
            'position'         => $currency_details[0]['currency_position'],
        );
        $chapterList = $CI->parser->parse('manufacturer/manufacturer_details', $data, true);
        return $chapterList;
    }

    public function manufacturer_sales_data($manufacturer_id) {
        $CI = & get_instance();
        $CI->load->model('manufacturers');
        $CI->load->library('occational');
        $manufacturer_detail = $CI->manufacturers->manufacturer_personal_data($manufacturer_id);
        $sales_info = $CI->manufacturers->manufacturer_sales_data($manufacturer_id, null);

        if (!empty($sales_info)) {
            foreach ($sales_info as $k => $v) {
                $sales_info[$k]['date'] = $CI->occational->dateConvert($sales_info[$k]['date']);
            }
        }
        $data = array(
            'manufacturer_id'       => $manufacturer_detail[0]['manufacturer_id'],
            'manufacturer_name'     => $manufacturer_detail[0]['manufacturer_name'],
            'manufacturer_address'  => $manufacturer_detail[0]['address'],
            'manufacturer_mobile'   => $manufacturer_detail[0]['mobile'],
            'details'           => $manufacturer_detail[0]['details'],
            'sales_info'        => $sales_info,
        );
        $sales_report = $CI->parser->parse('manufacturer/manufacturer_sales_report', $data, true);
        return $sales_report;
    }

    //Ledger Book Maintaining information....
    public function manufacturer_ledger($manufacturer_id, $start, $end) {
        $CI = & get_instance();
        $CI->load->model('manufacturers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $manufacturer = $CI->manufacturers->manufacturer_list("110", "0");
        $manufacturer_details = $CI->manufacturers->manufacturer_personal_data($manufacturer_id);
        $ledger = $CI->manufacturers->manufacturers_ledger($manufacturer_id, $start, $end);
       
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $data = array(
            'title'            => display('manufacturer_ledger'),
            'ledgers'          => $ledger,
            'manufacturer_name'    => $manufacturer_details[0]['manufacturer_name'],
            'address'          => $manufacturer_details[0]['address'],
            'manufacturer_ledger'  => 'Cmanufacturer/manufacturer_ledger',
            'manufacturer'         => $manufacturer,
            'currency'         => $currency_details[0]['currency'],
            'position'         => $currency_details[0]['currency_position'],
            'links'            => '',
        );

        $singlecustomerdetails = $CI->parser->parse('manufacturer/manufacturer_ledger', $data, true);
        return $singlecustomerdetails;
    }

    public function manufacturer_sales_details($manufacturer_id, $start, $end) {
        $CI = & get_instance();
        $CI->load->model('manufacturers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');

        $manufacturer_detail = $CI->manufacturers->manufacturer_personal_data($manufacturer_id);
        $sales_info = $CI->manufacturers->manufacturer_sales_details($manufacturer_id, $start, $end);

        $sub_total = 0;
        if (!empty($sales_info)) {
            foreach ($sales_info as $k => $v) {
                $sales_info[$k]['date'] = $CI->occational->dateConvert($sales_info[$k]['date']);
                $sub_total += $sales_info[$k]['total'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title'            => display('manufacturer_sales_details'),
            'manufacturer_id'      => $manufacturer_detail[0]['manufacturer_id'],
            'manufacturer_name'    => $manufacturer_detail[0]['manufacturer_name'],
            'manufacturer_address' => $manufacturer_detail[0]['address'],
            'manufacturer_mobile'  => $manufacturer_detail[0]['mobile'],
            'details'          => $manufacturer_detail[0]['details'],
            'sub_total'        => number_format($sub_total, 2, '.', ','),
            'sales_info'       => $sales_info,
            'currency'         => $currency_details[0]['currency'],
            'position'         => $currency_details[0]['currency_position'],
        );
        $sales_report = $CI->parser->parse('manufacturer/manufacturer_sales_details', $data, true);
        return $sales_report;
    }

    ################################################################################################ manufacturer sales details all from menu###########

    public function manufacturer_sales_details_allm($links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('manufacturers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $manufacturer_detail = $CI->manufacturers->manufacturer_personal_data_all();
        $sales_info = $CI->manufacturers->manufacturer_sales_details_all($per_page, $page);

        $sub_total = 0;
        if (!empty($sales_info)) {
            foreach ($sales_info as $k => $v) {
                $sales_info[$k]['date'] = $sales_info[$k]['date'];
                $sub_total += $sales_info[$k]['total'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title'           => display('manufacturer_sales_details'),
            'manufacturer_id'     => $manufacturer_detail[0]['manufacturer_id'],
            'manufacturer_name'   => '',
            'details'         => $manufacturer_detail[0]['details'],
            'sub_total'       => number_format($sub_total, 2, '.', ','),
            'sales_info'      => $sales_info,
            'links'           => $links,
            'manufacturer_ledger' => 'Cmanufacturer/manufacturer_ledger/',
            'manufacturer_sales_details' => 'Cmanufacturer/manufacturer_sales_details',
            'manufacturer_sales_summary' => 'Cmanufacturer/manufacturer_sales_summary/',
            'sales_payment_actual'   => 'Cmanufacturer/sales_payment_actual/',
            'currency'        => $currency_details[0]['currency'],
            'position'        => $currency_details[0]['currency_position'],
        );
        $sales_report = $CI->parser->parse('manufacturer/manufacturer_sales_details', $data, true);
        return $sales_report;
    }

     public function manufacturer_sales_details_datewise($links, $per_page, $page,$fromdate,$todate) {
        $CI = & get_instance();
        $CI->load->model('manufacturers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $manufacturer_detail = $CI->manufacturers->manufacturer_personal_data_all();
        $sales_info = $CI->manufacturers->manufacturer_sales_details_datewise($per_page, $page,$fromdate,$todate);

        $sub_total = 0;
        if (!empty($sales_info)) {
            foreach ($sales_info as $k => $v) {
                $sales_info[$k]['date'] = $sales_info[$k]['date'];
                $sub_total += $sales_info[$k]['total'];
            }
        }
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title'           => display('manufacturer_sales_details'),
            'manufacturer_id'     => $manufacturer_detail[0]['manufacturer_id'],
            'manufacturer_name'   => '',
            'details'         => $manufacturer_detail[0]['details'],
            'sub_total'       => number_format($sub_total, 2, '.', ','),
            'sales_info'      => $sales_info,
            'links'           => $links,
            'fromdate'        => $fromdate,
            'todate'          => $todate,
            'currency'        => $currency_details[0]['currency'],
            'position'        => $currency_details[0]['currency_position'],
        );
        $sales_report = $CI->parser->parse('manufacturer/manufacturer_sales_details', $data, true);
        return $sales_report;
    }


    public function manufacturer_sales_summary($manufacturer_id, $links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('manufacturers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $manufacturer_detail = $CI->manufacturers->manufacturer_personal_data($manufacturer_id);
        $sales_info = $CI->manufacturers->manufacturer_sales_summary($per_page, $page);

        $sub_total = 0;
        if (!empty($sales_info)) {
            foreach ($sales_info as $k => $v) {
                $sales_info[$k]['date'] = $CI->occational->dateConvert($sales_info[$k]['date']);
                $sub_total += $sales_info[$k]['total'];
            }
        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $data = array(
            'title'                  => display('manufacturer_sales_summary'),
            'manufacturer_detail'        => $manufacturer_detail,
            'sub_total'              => number_format($sub_total, 2, '.', ','),
            'sales_info'             => $sales_info,
            'links'                  => $links,
            'manufacturer_ledger'        => 'Cmanufacturer/manufacturer_ledger/' . $manufacturer_id,
            'manufacturer_sales_details' => 'Cmanufacturer/manufacturer_sales_details/' . $manufacturer_id,
            'manufacturer_sales_summary' => 'Cmanufacturer/manufacturer_sales_summary/' . $manufacturer_id,
            'sales_payment_actual'   => 'Cmanufacturer/sales_payment_actual/' . $manufacturer_id,
            'currency'               => $currency_details[0]['currency'],
            'position'               => $currency_details[0]['currency_position'],
        );
        $sales_report = $CI->parser->parse('manufacturer/manufacturer_sales_summary', $data, true);
        return $sales_report;
    }

    ########################## Sales & Payment ledger #########################
    #	This function will be responsible for retreive all actual sales information 
    # 	as well as payment info.Whatever stock that will not be matter .
    ############################################################################

    function sales_payment_actual($manufacturer_id, $links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('manufacturers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');

        $sales_payment_actual = $CI->manufacturers->sales_payment_actual($per_page, $page);
        $sup_per_info = $CI->manufacturers->manufacturer_personal_data($manufacturer_id);

        $total_amount = 0;
        if (!empty($sales_payment_actual)) {
            foreach ($sales_payment_actual as $k => $v) {
                $sales_payment_actual[$k]['total_amount'] = $total_amount + $sales_payment_actual[$k]['amount'];
                $total_amount = $sales_payment_actual[$k]['total_amount'];
            }
        }

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $data = array(
            'title'                 => display('manufacturer_actual_ledger'),
            'info'                  => $CI->manufacturers->manufacturer_personal_data($manufacturer_id),
            'total_details'         => $CI->manufacturers->sales_payment_actual_total($manufacturer_id),
            'ledger'                => $sales_payment_actual,
            'links'                 => $links,
            'company_info'          => $CI->manufacturers->retrieve_company(),
            'manufacturer_ledger'       => 'Cmanufacturer/manufacturer_ledger/' . $manufacturer_id,
            'manufacturer_sales_details'=> 'Cmanufacturer/manufacturer_sales_details/' . $manufacturer_id,
            'manufacturer_sales_summary'=> 'Cmanufacturer/manufacturer_sales_summary/' . $manufacturer_id,
            'sales_payment_actual'  => 'Cmanufacturer/sales_payment_actual/' . $manufacturer_id,
            'currency'              => $currency_details[0]['currency'],
            'position'              => $currency_details[0]['currency_position'],
        );

        $sales_actual_report = $CI->parser->parse('manufacturer/sales_payment_ledger', $data, true);
        return $sales_actual_report;
    }

    //Search manufacturer
    public function manufacturer_search_list($cat_id, $company_id) {
        $CI = & get_instance();
        $CI->load->model('manufacturers');
        $category_list = $CI->manufacturers->retrieve_category_list();
        $manufacturers_list = $CI->manufacturers->manufacturer_search_list($cat_id, $company_id);
        $data = array(
            'title'          => display('manage_suppiler'),
            'manufacturers_list' => $manufacturers_list,
            'category_list'  => $category_list
        );
        $manufacturerList = $CI->parser->parse('manufacturer/manufacturer', $data, true);
        return $manufacturerList;
    }

    ################################################################################################################################################### manufacturer Report Part ################################

    public function manufacturer_ledger_report($links, $per_page, $page) {
        $CI = & get_instance();
        $CI->load->model('manufacturers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');

        $manufacturer = $CI->manufacturers->manufacturer_list();
        $manufacturer_details = $CI->manufacturers->manufacturer_personal_data1();
        $ledger = $CI->manufacturers->manufacturer_product_sale1($per_page, $page);

        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $data = array(
            'title'          => display('manufacturer_ledger'),
            'ledgers'        => $ledger,
            'manufacturer_name'  => '',
            'manufacturer_ledger'=> 'Cmanufacturer/manufacturer_ledger',
            'manufacturer'       => $manufacturer,
            'currency'       => $currency_details[0]['currency'],
            'position'       => $currency_details[0]['currency_position'],
            'links'          => $links,
        );

        $singlecustomerdetails = $CI->parser->parse('manufacturer/manufacturer_ledger', $data, true);
        return $singlecustomerdetails;
    }

    // manufacturer id wise info from view/mange page
    public function manufacturer_ledger_info($manufacturer_id) {
        $CI = & get_instance();
        $CI->load->model('manufacturers');
        $CI->load->model('Web_settings');
        $CI->load->library('occational');
        $manufacturer_details = $CI->manufacturers->manufacturer_personal_data($manufacturer_id);
        $manufacturer         = $CI->manufacturers->manufacturer_list("110", "0");
        $ledgers          = $CI->manufacturers->manufacturer_product_sale_info($manufacturer_id);
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();

        $data = array(
            'title'           => display('manufacturer_ledger'),
            'ledgers'         => $ledgers,
            'manufacturer_name'   => $manufacturer_details[0]['manufacturer_name'],
            'address'         => $manufacturer_details[0]['address'],
            'manufacturer_ledger' => 'Cmanufacturer/manufacturer_ledger',
            'manufacturer'        => $manufacturer,
            'currency'        => $currency_details[0]['currency'],
            'position'        => $currency_details[0]['currency_position'],
            'links'           => '',
        );

        $singlecustomerdetails = $CI->parser->parse('manufacturer/manufacturer_ledger', $data, true);
        return $singlecustomerdetails;
    }



        public function advance_details_data($receiptid,$manufacturer_id) {

        $CI = & get_instance();
        $CI->load->model('manufacturers');
        $CI->load->model('Purchases');
        $CI->load->model('Web_settings');
        $receiptdata      = $CI->manufacturers->advance_details($receiptid,$manufacturer_id);
        $manufacturer_details = $CI->manufacturers->manufacturer_personal_data($manufacturer_id);
        $currency_details = $CI->Web_settings->retrieve_setting_editdata();
        $company_info     = $CI->Purchases->retrieve_company();
        $data = array(
            'title'            => display('manufacturer_advance'),
            'details'          => $receiptdata,
            'manufacturer_name'    => $manufacturer_details[0]['manufacturer_name'],
            'receipt_no'       => $receiptdata[0]['VNo'],
            'address'          => $manufacturer_details[0]['address'],
            'mobile'           => $manufacturer_details[0]['mobile'],
            'company_info'     => $company_info,
            'currency'         => $currency_details[0]['currency'],
            'position'         => $currency_details[0]['currency_position'],
        );

        $resultdata = $CI->parser->parse('manufacturer/manufacturer_advance_receipt', $data, true);
        return $resultdata;
    }

}

?>