<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //BANK LIST
    public function get_bank_list() {
        $this->db->select('*');
        $this->db->from('bank_add');
        $this->db->order_by('bank_name','asc');
        $this->db->where('status', 1);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Person  List
    public function person_list() {
        $this->db->select('*');
        $this->db->from('person_information');
        $this->db->where('status', 1);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function pesonal_loan_information() {
        $this->db->select('*');
        $this->db->from('pesonal_loan_information');
        $this->db->where('status', 1);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Person  List
    public function person_list_limt($per_page, $limit) {
        $this->db->select('*');
        $this->db->from('person_information');
        $this->db->where('status', 1);
        $this->db->limit($per_page, $limit);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
//count office loan
    public function count_office_loan() {
        $this->db->select('*');
        $this->db->from('person_information');
        $this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }
    //Selecst Person
    public function select_person_by_id($person_id) {
        $this->db->select('*');
        $this->db->from('person_information');
        $this->db->where('person_id', $person_id);
        $this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // personal loan person id selecetd
    public function select_loan_person_by_id($person_id) {
        $this->db->select('*');
        $this->db->from('pesonal_loan_information');
        $this->db->where('person_id', $person_id);
        $this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //update date for loan
    public function updata_loan_id($person_id) {
        $this->db->select('a.*,b.*');
        $this->db->from('personal_loan a');
        $this->db->join('pesonal_loan_information  b', 'a.person_id=b.person_id', 'left');
        $this->db->where('per_loan_id', $person_id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Person  List Count
    public function person_list_count() {
        $this->db->select('*');
        $this->db->from('pesonal_loan_information');
        $this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    public function person_loan_count() {
        $this->db->select('*');
        $this->db->from('personal_loan');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    //Retrieve customer All data 
    public function personledger_tradational($person_id) {
        $this->db->select('
            person_ledger.*,
            sum(person_ledger.debit) as debit,
            sum(person_ledger.credit) as credit
            ');
        $this->db->from('person_ledger');
        $this->db->where('person_id', $person_id);
        $this->db->order_by('date', 'desc');
        $this->db->group_by('transaction_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Personal loan detail ledger
    public function personal_loan_tradational($person_id) {

        $this->db->select('
            personal_loan.*,
            sum(personal_loan.debit) as debit,
            sum(personal_loan.credit) as credit
            ');
        $this->db->from('personal_loan');
        $this->db->where('person_id', $person_id);
        $this->db->group_by('transaction_id');
        $this->db->order_by('date','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //personal loan limit 
    public function person_list_limt_loan($per_page, $limit) {
        $this->db->select('
                pesonal_loan_information.*,
                sum(personal_loan.debit) as debit,
                sum(personal_loan.credit) as credit
            ');
        $this->db->from('pesonal_loan_information');
        $this->db->join('personal_loan', 'pesonal_loan_information.person_id = personal_loan.person_id', 'left');
        $this->db->where('pesonal_loan_information.status', 1);
        $this->db->group_by('pesonal_loan_information.person_id');
        $this->db->limit($per_page, $limit);
        $this->db->order_by('pesonal_loan_information.id', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // personal loan list
    public function loan_list_personal($per_page, $limit) {
        $this->db->select('a.*,b.*');
        $this->db->from('personal_loan a');
        $this->db->join('pesonal_loan_information  b', 'a.person_id=b.person_id', 'left');

        $this->db->limit($per_page, $limit);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //loan person list for update form
    public function loan_updatlist_personal() {
        $this->db->select('*');
        $this->db->from('pesonal_loan_information');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    // submit person for personal loan
    public function submit_person_personal_loan($data) {
        $result = $this->db->insert('pesonal_loan_information', $data);
        if ($result) {
            $this->db->select('*');
            $this->db->from('pesonal_loan_information');
            $query = $this->db->get();
            foreach ($query->result() as $row) {
                $json_loan[] = array('label' => $row->person_name, 'value' => $row->person_id);
            }
            $cache_file = './my-assets/js/admin_js/json/loan_personl.json';
            $loanList = json_encode($json_loan);
            file_put_contents($cache_file, $loanList);
            return TRUE;
        } else {
            return false;
        }
    }

    public function person_list_personal_loan() {
        $this->db->select('*');
        $this->db->from('pesonal_loan_information');
        $this->db->where('status', 1);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrieve customer All data 
    public function ledger_search_by_date($person_id, $from_date, $to_date) {
        $this->db->select('
            person_ledger.*,
            sum(person_ledger.debit) as debit,
            sum(person_ledger.credit) as credit
            ');
        $this->db->from('person_ledger');
        $this->db->where('person_id', $person_id);
        $this->db->where('date >=', $from_date);
        $this->db->where('date <=', $to_date);
        $this->db->group_by('transaction_id');
        $this->db->order_by('date','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrieve customer All data 
    public function person_loan_search_by_date($person_id, $from_date, $to_date) {
        $this->db->select('
            personal_loan.*,
            sum(personal_loan.debit) as debit,
            sum(personal_loan.credit) as credit
            ');
        $this->db->from('personal_loan');
        $this->db->where('person_id', $person_id);
        $this->db->where('date >=', $from_date);
        $this->db->where('date <=', $to_date);
        $this->db->group_by('transaction_id');
        $this->db->order_by('date','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }


    public function ledger_search_by_date_count($person_id, $from_date, $to_date) {
        $this->db->select('
            person_ledger.*,
            sum(person_ledger.debit) as debit,
            sum(person_ledger.credit) as credit
            ');
        $this->db->from('person_ledger');
        $this->db->where('person_id', $person_id);
        $this->db->where('date >=', $from_date);
        $this->db->where('date <=', $to_date);
        $this->db->group_by('transaction_id');
         $this->db->order_by('date','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    public function person_loan_search_by_date_count($person_id, $from_date, $to_date) {
        $this->db->select('
            personal_loan.*,
            sum(personal_loan.debit) as debit,
            sum(personal_loan.credit) as credit
            ');
        $this->db->from('personal_loan');
        $this->db->where('person_id', $person_id);
        $this->db->where('date >=', $from_date);
        $this->db->where('date <=', $to_date);
        $this->db->group_by('transaction_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    //Get bank by id
    public function get_bank_by_id($bank_id) {
        $this->db->select('*');
        $this->db->from('bank_add');
        $this->db->where('bank_id', $bank_id);
        $this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Bank updaet by id
    public function bank_update_by_id($bank_id) {
        if ($_FILES['signature_pic']['name']) {

            $config['upload_path'] = './my-assets/image/logo/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
            $config['max_size'] = "*";
            $config['max_width'] = "*";
            $config['max_height'] = "*";
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('signature_pic')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
                redirect(base_url('Csettings/index'));
            } else {
                $image = $this->upload->data();
                $signature_pic = base_url() . "my-assets/image/logo/" . $image['file_name'];
            }
        }

        $old_logo = $this->input->post('old_pic',TRUE);

        $data = array(
            'bank_name' => $this->input->post('bank_name',TRUE),
            'ac_name' => $this->input->post('ac_name',TRUE),
            'ac_number' => $this->input->post('ac_no',TRUE),
            'branch' => $this->input->post('branch',TRUE),
            'signature_pic' => (!empty($signature_pic) ? $signature_pic : $old_logo),
            'status' => 1
        );
        $bank_coaupdate = [
             'HeadName'         => $this->input->post('bank_name',TRUE)
        ];

        $data['bank_name'] = $this->input->post('bank_name',TRUE);
        $this->db->where('bank_id', $bank_id);
        $this->db->update('bank_add', $data);
         $this->db->where('HeadName', $this->input->post('oldname',TRUE));
        $this->db->update('acc_coa', $bank_coaupdate);
        return true;
    }

    //==========Bank Ledger=============//
    public function bank_ledger($bank_name,$from,$to) {
        $this->db->select('a.*,b.HeadName');
        $this->db->from('acc_transaction a');
        $this->db->join('acc_coa b','a.COAID=b.HeadCode');
        $this->db->where('b.PHeadName','Cash At Bank');
        if(!empty($bank_name)){
        $this->db->where('b.HeadName',$bank_name);
         }
        $this->db->where('a.VDate >=', $from);
        $this->db->where('a.VDate <=', $to);
        $this->db->where('a.IsAppove',1);
        $this->db->order_by('a.VDate','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //==========Bank Info=============//
    public function bank_info($bank_id) {
        $this->db->select('*');
        $this->db->from('bank_add');
        $this->db->where('bank_id', $bank_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

 

    //COUNT PRODUCT
    public function bank_entry($data) {
        $this->db->insert('bank_add', $data);
    }

    //Add person
    public function submit_person($data) {
        $result = $this->db->insert('person_information', $data);
        if ($result) {
            $this->db->select('*');
            $this->db->from('person_information');
            $query = $this->db->get();
            foreach ($query->result() as $row) {
                $json_loan[] = array('label' => $row->person_name, 'value' => $row->person_id);
            }
            $cache_file = './my-assets/js/admin_js/json/loan.json';
            $loanList = json_encode($json_loan);
            file_put_contents($cache_file, $loanList);
            return TRUE;
        } else {
            return false;
        }
    }

    //Update person 
    public function update_person($data, $person_id) {
        $this->db->where('person_id', $person_id);
        $result = $this->db->update('person_information', $data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // Update loan 
    public function update_per_loan($data, $person_id) {
        $this->db->where('per_loan_id', $person_id);
        $result = $this->db->update('personal_loan', $data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

// update loan Person
    public function update_loan_person($data, $person_id) {
        $this->db->where('person_id', $person_id);
        $result = $this->db->update('pesonal_loan_information', $data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    //Add loan
    public function submit_loan($data) {
        $result = $this->db->insert('person_ledger', $data);
        if ($result) {
            $cache_file = './my-assets/js/admin_js/json/loan.json';
            file_put_contents($cache_file);
            return TRUE;
        } else {
            return false;
        }
    }

    public function submit_loan_personal($data) {
        $result = $this->db->insert('personal_loan', $data);
        if ($result) {
            $cache_file = './my-assets/js/admin_js/json/loan.json';
            $loanList = json_encode($result);
            file_put_contents($cache_file, $loanList);
            return TRUE;
        } else {
            return false;
        }
    }

    // loan person select list
    public function loan_list() {
        $this->db->select('*');
        $this->db->from('person_information');
        $this->db->order_by('person_id', 'desc');
        $this->db->limit('500');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Submit payment
    public function submit_payment($data) {
        $result = $this->db->insert('person_ledger', $data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    ####===========Submit payment personal loan ==================###

    public function submit_payment_per_loan($data) {
        $result = $this->db->insert('personal_loan', $data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }



    public function bank_balance($bnak_name = null){
        $this->db->select('(sum(a.Debit) - sum(a.Credit)) as balance,b.HeadName');
        $this->db->from('acc_transaction a');
        $this->db->join('acc_coa b','a.COAID=b.HeadCode');
        $this->db->where('b.HeadName',$bnak_name);
        $this->db->where('a.IsAppove',1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;

    }





    //Select customer from invoice
    public function customer_info() {
        $query = $this->db->select('*')
                ->from('customer_information')
                ->join('invoice', 'invoice.customer_id = customer_information.customer_id')
                ->group_by('invoice.customer_id')
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //Retrive product info
    public function product_info() {

        $product_id = $this->input->post('product_model',TRUE);
        $customer_id = $this->input->post('customer_name',TRUE);
        $from = $this->input->post('from',true);
        $to = $this->input->post('to',true);

        $query = $this->db->select('
                                invoice.date,
                                invoice_details.*,
                                product_information.product_model
                                ')
                ->from('invoice_details')
                ->join('product_information', 'invoice_details.product_id = product_information.product_id')
                ->join('invoice', 'invoice.invoice_id = invoice_details.invoice_id')
                ->where('invoice.customer_id', $customer_id)
                ->where('invoice.date >=', $from)
                ->where('invoice.date <=', $to)
                ->where('invoice_details.product_id', $product_id)
                ->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

        public function headcode(){
        $query=$this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='4' And HeadCode LIKE '1020102%'");
        return $query->row();

    }
    public function office_loan_person() {
        $this->db->select('*');
        $this->db->from('person_information');
        $this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function password_recovery($data = array())
    {
        return $this->db->select("*")
            ->from('user_login')
            ->where('username',$data['email'])
            ->get();
    }
        public function update_recovery_pass($data = [])
    {
        return $this->db->where('username',$data['email'])
            ->update('user_login',$data); 
    } 
    public function token_matching($token_id){
        return $this->db->select("*")
            ->from('user_login')
            ->where('security_code',$token_id)
            ->get(); 
    }
    // Currency list
 public function currencylist(){
         $this->db->select('*');
        $this->db->from('currency_tbl');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
 }
 public function currencyinfo($id){
return $info = $this->db->select('*')->from('currency_tbl')->where('id',$id)->get()->result_array();
 }

  public function delete_personal_loan($id = null)
    {
         $this->db->where('person_id',$id)
            ->delete('pesonal_loan_information');
        $this->db->where('person_id',$id)
            ->delete('personal_loan');
             $this->db->select('*');
            $this->db->from('pesonal_loan_information');
            $query = $this->db->get();
            foreach ($query->result() as $row) {
                $json_loan[] = array('label' => $row->person_name, 'value' => $row->person_id);
            }
            $cache_file = './my-assets/js/admin_js/json/loan_personl.json';
            $loanList = json_encode($json_loan);
            file_put_contents($cache_file, $loanList);

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    } 

     public function delete_office_loan($id = null)
    {
         $this->db->where('person_id',$id)
            ->delete('person_information');
             $this->db->select('*');
            $this->db->from('person_information');
            $query = $this->db->get();
            foreach ($query->result() as $row) {
                $json_loan[] = array('label' => $row->person_name, 'value' => $row->person_id);
            }
            $cache_file = './my-assets/js/admin_js/json/loan.json';
            $loanList = json_encode($json_loan);
            file_put_contents($cache_file, $loanList);

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    } 

    //setting update data
    public function tax_setting_info(){
        $this->db->select('*');
        $this->db->from('tax_settings');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
 }
    
}
