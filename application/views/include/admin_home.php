<!-- Admin Home Start -->
 <div class="content-wrapper">
    <!-- Content Header(Page header)-->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('dashboard')?></h1>
            <small><?php echo display('home')?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home')?></a></li>
                <li class="active"><?php echo display('dashboard')?></li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
              <?php 
if(isset($_POST['btnSearch']))
{
   $postdate = $_POST['alldata'];
   $y = date("Y", strtotime($postdate) );
   $m = date("m", strtotime($postdate) );
  
}
$searchdate =(!empty($postdate)?$postdate:date('F Y'));
   $year = (!empty($y)?$y:date('Y'));
   $month = (!empty($m)?$m:date('m'));

?>
        <!-- Alert Message -->
        <?php
            $message = $this->session->userdata('message');
            if (isset($message)) {
        ?>
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $message ?>                    
        </div>
        <?php 
            $this->session->unset_userdata('message');
            }
            $error_message = $this->session->userdata('error_message');
            if (isset($error_message)) {
        ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $error_message ?>                    
        </div>
        <?php 
            $this->session->unset_userdata('error_message');
            }
        ?>
        <!-- First Counter -->
        <div class="row">

           <?php
            if($this->permission1->method('manage_customer','read')->access()){ ?>
               <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2">
         
                       <div class="small-box bg-green whitecolor">
            <div class="inner">
              <h4 class="text-center"><span class="coundownnumber"><?php echo html_escape($total_customer)?></span></h4>

              <p class="text-center"><?php echo display('total_customer')?></p>
            </div>
            <div class="icon">
             <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo base_url('Ccustomer/manage_customer')?>" class="small-box-footer"><?php echo display('total_customer')?> </a>
          </div>
               </div>
            <?php } ?>

             <?php
             if($this->permission1->method('manage_manufacturer','read')->access()) { ?>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2">
     
            <div class="small-box bg-bringal whitecolor">
            <div class="inner">
              <h4 class="text-center"><span class="coundownnumber"><?php echo html_escape($total_manufacturers) ?></span></h4>

              <p class="text-center"><?php echo display('total_manufacturer')?></p>
            </div>
            <div class="icon">
             <i class="fa fa-user"></i>
            </div>
            <a href="<?php echo base_url('Cmanufacturer/manage_manufacturer')?>" class="small-box-footer"><?php echo display('total_manufacturer')?> </a>
          </div>
                </div>
             <?php } ?>

            <?php
            if($this->permission1->method('manage_medicine','read')->access()){ ?>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2">
                   <div class="small-box bg-darkgreen whitecolor">
            <div class="inner">
              <h4 class="text-center"><span class="coundownnumber"><?php echo html_escape($total_product)?></span></h4>

              <p class="text-center"><?php echo display('total_product')?></p>
            </div>
            <div class="icon">
             <i class="fa fa-medkit"></i>
            </div>
            <a href="<?php echo base_url('Cproduct/manage_product')?>" class="small-box-footer"><?php echo display('total_product')?> </a>
          </div>
            </div>
           <?php } ?>


          
                  <?php
                if($this->permission1->method('manage_medicine','read')->access()) { ?>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2">
 
        <div class="small-box bg-orange whitecolor">
            <div class="inner">
              <h4 class="text-center"><span class="coundownnumber"><?php echo html_escape($stockout); ?></span></h4>

              <p class="text-center"><?php echo display('out_of_stock')?></p>
            </div>
            <div class="icon">
             <i class="fa fa-stack-overflow"></i>
            </div>
            <a href="<?php echo base_url('Creport/out_of_stock')?>" class="small-box-footer"><?php echo display('out_of_stock')?> </a>
          </div>
                </div>
                <?php } ?>
                  <?php
                if($this->permission1->method('manage_medicine','read')->access()) { ?>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-2">

            <div class="small-box bg-danger whitecolor">
            <div class="inner">
              <h4 class="text-center"><span class="coundownnumber"><?php echo html_escape($expired) ?></span></h4>

              <p class="text-center"><?php echo display('expired')?></p>
            </div>
            <div class="icon">
             <i class="fa fa-calendar"></i>
            </div>
            <a href="<?php echo base_url('Creport/out_of_date')?>" class="small-box-footer"><?php echo display('expired')?> </a>
          </div>
                </div>
                <?php } ?>
                      <?php
                if($this->permission1->method('manage_invoice','read')->access()) { ?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-2">
             
            <div class="small-box bg-pase whitecolor">
            <div class="inner">
              <h4 class="text-center"><span class="coundownnumber"><?php echo html_escape($total_sales) ?></span></h4>

              <p class="text-center"><?php echo display('total_invoice')?></p>
            </div>
            <div class="icon">
             <i class="fa fa-print"></i>
            </div>
            <a href="<?php echo base_url('Cinvoice/manage_invoice')?>" class="small-box-footer"><?php echo display('total_invoice')?> </a>
          </div>
                </div>
                <?php } ?>
<input type="hidden" id="bestsalelabel" value='<?php echo html_escape($chart_label);?>' name=""> 
<input type="hidden" id="bestsaledata" value='<?php echo html_escape($chart_data);?>' name=""> 

<input type="hidden" value='<?php $seperatedData = explode(',', $chart_data); echo html_escape(($seperatedData[0] + 10));?>' name="" id="bestsalemax"> 
<input type="hidden" name="" id="total_sales_amount" value="<?php echo $total_sales_amount?>">
<input type="hidden" id="months" value='<?php 
 $months_label = $this->Reports->monthlyprogress_label($year,$month); echo html_escape($months_label);?>' name="">
 <input type="hidden" id="progress_saledata" value='<?php 
 $salesamount = $this->Reports->monthlyprogress_saledata($year,$month); echo html_escape($salesamount);?>' name="">
 <input type="hidden" id="progress_purchasedata" value='<?php 
 $pu_amount = $this->Reports->monthlyprogress_purchasedata($year,$month); echo html_escape($pu_amount);?>' name="">  
 <input type="hidden" name="" id="pie_total_sale" value="<?php echo $pie_total_sale;?>"> 
 <input type="hidden" name="" id="pie_total_purchase" value="<?php echo $pie_total_purchase;?>">
 <input type="hidden" name="" id="pie_total_service" value="<?php echo $pie_total_service;?>">
 <input type="hidden" name="" id="pie_total_expense" value="<?php echo $pie_total_expense;?>"> 
 <input type="hidden" name="" id="pie_total_salary" value="<?php echo $pie_total_salary;?>">   
 <input type="hidden" id="currency" value="<?php echo  html_escape($currency)?>" name="">
        </div>
        <hr>
        <!-- Second Counter -->
       

   
        <div class="row">
            <!-- This month progress -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
       
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="panel-title">
                            
                            <?php echo form_open_multipart('','name="form1" id="form1"')?>   
                                  <div class="form-group row">
                                    <div class="col-sm-8"><h4> <?php echo display('monthly_progress_report')?></h4></div>
                                    <div class="col-sm-4">
                                    <div class="col-sm-8 marginpadding-right0">
                                  <input type="text" class="form-control " value="<?php echo $searchdate;?>" name="alldata" id="alldata" ></div>
                                  <div class="col-sm-4 marginpaddingleft0">
                                  <button type="submit" name="btnSearch" class="btn filterbutton"><i class="fa fa-search"></i> <?php echo display('filter')?></button>
                                </div>
                              </div>
                                </div>
                                <?php echo form_close();?>
                        </div>
                    </div>
                    <div class="panel-body">
                        <canvas id="myChart" width="500" height="220"></canvas>
                    </div>
                </div>
               
            </div>
            <!-- Total Report -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <?php
                if($this->permission1->method('todays_report','read')->access()){ ?>
                <div class="panel panel-bd lobidisable">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('todays_report')?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                         <div class="message_inner">
                            <div class="message_widgets">
                                
                                <table class="table table-bordered table-striped table-hover">
                                <tr>
                                    <th><?php echo display('todays_report')?></th>
                                    <th><?php echo display('amount')?></th>
                                </tr>
                                    <tr>
                                        <th><?php echo display('total_sales')?></th>
                                        <td class="text-right"><?php echo (($position==0)?"$currency $sales_amount":"$sales_amount $currency") ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo display('total_purchase')?></th>
                                        <td class="text-right"><?php echo (($position==0)?"$currency $purchase_amount":"$purchase_amount $currency") ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo display('cash_received')?></th>
                                        <td class="text-right"><?php echo (($position==0)?"$currency $total_cash_receive":"$total_cash_receive $currency") ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo display('bank_received')?> </th>
                                        <td class="text-right"><?php echo (($position==0)?"$currency $total_bank_receive":"$total_bank_receive $currency") ?></td>
                                    </tr>
                                   <tr>
                                        <th><?php echo display('invoice').' '.display('due')?> </th>
                                        <td class="text-right"><?php echo (($position==0)?"$currency $total_due_amount":"$total_due_amount $currency") ?></td>
                                    </tr>
                                     <tr>
                                        <th><?php echo display('total_service')?> </th>
                                        <td class="text-right"><?php echo (($position==0)?"$currency $total_service_amount":"$total_service_amount $currency") ?></td>
                                    </tr>
                                    
                                </table>
                            </div>
                        </div> 
                        
                    </div>
                </div>
                <?php } ?>
            </div>
             <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                <div class="panel panel-bd lobidisable">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('income_expense_statement')?><?php echo ' of '.date('F Y');?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div id="chartContainerPie"></div>
                    </div>
                </div>
               
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <div class="panel panel-bd lobidisable">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo 'Best Sales of'.' '.date('F Y');?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <canvas id="bestsalechart" height="160"></canvas>
                    </div>
                </div>
            </div>
  
        </div>

    </section> <!-- /.content -->

     <?php if($this->session->userdata('user_type') == '1')
     {
     ?>
   <div id="stockmodal" class="modal fade" role="dialog">
     <div class="modal-dialog">
    <!-- Modal content-->
      <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo display('out_of_stock_and_date_expired_medicine')?></h4>
              </div>
      <div class="modal-body">
        <?php
         $date=date('Y-m-d');
     $this->db->select("b.*,b.expeire_date as expdate,a.product_name,a.strength,((select ifnull(sum(quantity),0) from product_purchase_details where product_id= `a`.`product_id`)-(select ifnull(sum(quantity),0) from invoice_details where product_id= `a`.`product_id`)) as 'stock'");
         $this->db->from('product_information a');
         $this->db->join('product_purchase_details b','b.product_id=a.product_id','left');
         $this->db->where('b.expeire_date <=', $date);
         $this->db->having('stock > 0');
         $this->db->group_by('b.batch_id');
         $this->db->group_by('a.product_id');
         $this->db->limit(20);
         $query = $this->db->get()->result_array();

        ?>
       <table id="" class="table table-bordered table-striped table-hover">
         <caption> <h4><center>Date Expired Medicine</center></h4></caption>
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('product_name') ?></th>
                                        <th class="text-center"><?php echo display('batch_id') ?></th>
                                        <th class="text-center"><?php echo display('expeire_date') ?></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if ($query) {
                                        foreach ($query as $out) {
                                 
                                ?>
                               
                                    <tr>
                                      
                                        <td class="text-center">
                                            <a href="<?php echo base_url().'Cproduct/product_details/'.$out['product_id']; ?>">
                                           <?php echo html_escape($out['product_name'])?> 
                                            </a>    
                                        </td>
                                        <td class="text-center"> <?php echo html_escape($out['batch_id'])?> </td>
                                        <td class="text-center"><?php echo html_escape($out['expdate'])?>
                                     <input type="hidden" id="expdate" value="<?php echo html_escape($out['expdate'])?>">
                                         </td>
                                        
                                    </tr>
                             <?php     }
                             ?>
                                <?php
                                    }
                                ?>
                                </tbody>
                            </table>

                           <?php 
                           

     $this->db->select("a.*,b.manufacturer_name,a.product_name,a.generic_name,a.strength,((select ifnull(sum(quantity),0) from product_purchase_details where product_id= `a`.`product_id`)-(select ifnull(sum(quantity),0) from invoice_details where product_id= `a`.`product_id`)) as 'stock'");
         $this->db->from('product_information a');
          $this->db->join('manufacturer_information b','b.manufacturer_id=a.manufacturer_id','left');
         $this->db->having('stock < 10');
         $this->db->group_by('a.product_id');
         $this->db->order_by('a.product_name','asc');
         $this->db->limit(20);
        $out_of_stock = $this->db->get()->result_array();


                            ?>
        <table id="" class="table table-bordered table-striped table-hover">
             <caption> <h4><center>Out of Stock Medicine</center></h4></caption>
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('product_name') ?></th>
                                        <th class="text-center"><?php echo display('product_type') ?></th>
                                        <th class="text-center"><?php echo display('unit') ?></th>
                                        <th class="text-center"><?php echo display('stock') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $spcount = 0;
                                        $count = 0;
                                    if ($out_of_stock) {
                                       
                                        foreach ($out_of_stock as $stockout) { 
                                            $count += $spcount;?>
                                       
                            
                                    <tr>
                                        
                                        <td class="text-center">
                                            <a href="<?php echo base_url().'Cproduct/product_details/'.$stockout['product_id']; ?>">
                                           <?php echo html_escape($stockout['product_name'])?> 
                                            </a> 
                                            <input type="hidden" id="stockqty" class="stockqtymdl" value="<?php echo html_escape($stockout['stock'])?>">   
                                        </td>
                                        <td class="text-center"><?php echo html_escape($stockout['product_model'])?> </td>
                                        <td class="text-center"><?php echo html_escape($stockout['unit'])?></td>
                                        <td class="text-center"><span class="text-danger"><?php echo html_escape($stockout['stock'])?></span></td>
                                    </tr>
                                <?php  $spcount++;}
                                ?>
                                <?php
                                    }
                                ?>
                                <input type="hidden" value="<?php echo  $count;?>" id="stpcount">
                                </tbody>
                            </table>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="is_modal_shown" id="is_modal_shown" value="<?php echo $this->session->userdata('is_modal_shown');?>">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo display('close')?></button>
          </div>
        </div>
     </div>
  </div>

     <?php } ?>

</div> <!-- /.content-wrapper -->
<!-- Admin Home end -->
 
<!-- ChartJs JavaScript -->
<script src="<?php echo base_url() ?>assets/js/Chart.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/canvasjs.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/dashboard.js" type="text/javascript"></script>


