

<!-- Profit Report Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('profit_report_product_wise') ?></h1>
	        <small><?php echo display('total_profit_report')?></small>
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('report') ?></a></li>
	            <li class="active"><?php echo display('profit_report_product_wise') ?></li>
	        </ol>
	    </div>
	</section>

	<section class="content">
		

		<div class="row">
            <div class="col-sm-12">
               
                  <a href="<?php echo base_url('Admin_dashboard/all_report')?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo display('todays_report')?> </a>

                  <a href="<?php echo base_url('Admin_dashboard/todays_purchase_report')?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('purchase_report')?> </a>

                  <a href="<?php echo base_url('Admin_dashboard/product_sales_reports_date_wise')?>" class="btn btn-primary m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('sales_report_product_wise')?> </a>

                  <a href="<?php echo base_url('Admin_dashboard/todays_sales_report')?>" class="btn btn-warning m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('sales_report')?> </a>
                </div>
            </div>
        

		<!-- Profit report -->
		<div class="row">
			<div class="col-sm-12">
		        <div class="panel panel-default">
		            <div class="panel-body"> 
		                <?php echo form_open('Admin_dashboard/profit_productwise',array('class' => 'form-inline','method' => 'post'))?>
		                <?php date_default_timezone_set("Asia/Dhaka"); $today = date('Y-m-d'); ?>
		                <div class="row">
                            <label for="manufacturer" class="col-sm-3 col-form-label"><?php echo display('product_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                               <select name="product_id" class="form-control" width="200px">
                             <option value="">Select Medicine</option>
                             <?php foreach($medicine_list as $medicine){?>
                            <option value="<?php echo html_escape($medicine['product_id'])?>"  <?php if($medicine['product_id'] == $product_id){echo 'selected';}?>><?php echo html_escape($medicine['product_name']).' ('.html_escape($medicine['strength']).')'?></option>
                             <?php }?>
                           </select>
                            </div>
                        </div>
   
                          <br>
		                    
		                    <div class="row">
		                        <label for="from_date" class="col-sm-3 col-form-label"><?php echo display('start_date') ?>:</label>
		                         <div class="col-sm-6">
		                        <input type="text" name="from_date" class="form-control datepicker" id="from_date" placeholder="<?php echo display('start_date') ?>" value="<?php echo $from?>" >
		                    </div>
		                    </div> 
                           <br>
		                    <div class="row">
		                        <label for="to_date" class="col-sm-3 col-form-label"><?php echo display('end_date') ?>:</label>
		                        <div class="col-sm-6">
		                        <input type="text" name="to_date" class="form-control datepicker" id="to_date" placeholder="<?php echo display('end_date') ?>" value="<?php echo $to?>">
		                    </div>  
		                     </div> 
                             <br>
		                     <div class="row">
                        <div class="col-sm-10 text-center">
                        <button type="submit" class="btn btn-success"><?php echo display('view_report') ?></button>
                    </div>
                    </div>
                          
		               <?php echo form_close()?>
		               

		            </div>
		            
		        </div>
		    </div>
	    </div>

		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4><?php echo display('profit_report_product_wise') ?><span class="text-right"><a  class="btn btn-warning" href="#" onclick="printDiv('profit_div')"><?php echo display('print') ?></a></span></h4>
		                </div>
		            </div>
		           
		            <div class="panel-body"  id="profit_div">
							<div>
                         
                               <img src="<?php echo html_escape($logo); ?>" class="">

                               <span class="text-center">
                                    {product_detail}
								<h3><?php echo display('report_for') ?> {product_name} </h3>
								<h4 >Model: {product_model} </h4>
								<h4 >Generic Name: {generic_name} </h4>
								{/product_detail}
								<h4>From {from} To  {to}</h4>
                               </span>
                        </div>

		            	<div>
			            	
							
                       <table class="table table-striped table-hover">
                       	<tr><td class="text-center"><?php echo display('total_sale_qty');?></td><td class="text-right"><?php  if($total_sale_qty >0){
                       		echo $total_sale_qty;
                       	}else{
                       		echo 0;
                       	} ?> <?php if($quantity > 0){  echo 'Out Of'.' '.html_escape($quantity);
                       }else{
                       		echo '';
                       	} ?></td></tr>
                       	<tr><td class="text-center"><?php echo display('total_purchase_pric');?></td><td class="text-right"><?php 
echo (($position==0)?"$currency ".number_format($tpurchase, 2, '.', ','):number_format($tpurchase, 2, '.', ',')." $currency");?></td></tr>
                       	<tr><td class="text-center"><?php echo display('total_sale');?></td><td class="text-right"><?php 
echo (($position==0)?"$currency ".number_format($total_sale, 2, '.', ','):number_format($total_sale, 2, '.', ',')." $currency");?></td></tr>
                       	<tr><td class="text-center"><?php  $profit = $total_sale-$tpurchase;
                       	if($profit > 0){
                       		echo display('net_profit');
                       	}else{
                       		echo display('loss');
                       	} ?></td><td class="text-right"><?php
$profit=$total_sale-$tpurchase;
 echo (($position==0)?"$currency ".number_format($profit, 2, '.', ','):number_format($profit, 2, '.', ',')." $currency"); ?></td></tr>
                       </table>
<span class="text-left"><h4> <?php echo display('print_date') ?>: <?php echo date("d/m/Y h:i:s"); ?> </h4></span>
			            </div>

		                
		            </div>
		             <div>
		             	</div>
		        </div>
		    </div>
		</div>
	</section>
</div>
