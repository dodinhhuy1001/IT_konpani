<link href="<?php echo base_url()?>assets/css/select2.min.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url()?>my-assets/js/admin_js/json/manufacturer.js.php" ></script>

<!-- Profit Report Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('profit_report_manufacturer_wise') ?></h1>
	        <small><?php echo display('total_profit_report')?></small>
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('report') ?></a></li>
	            <li class="active"><?php echo display('profit_report_manufacturer_wise') ?></li>
	        </ol>
	    </div>
	</section>

	<section class="content">

		<div class="row">
            <div class="col-sm-12">
                

                    <?php
                    if($this->permission1->method('todays_report','read')->access()){ ?>
                        <a href="<?php echo base_url('Admin_dashboard/all_report')?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo display('todays_report')?> </a>
                    <?php } ?>

                    <?php
                    if($this->permission1->method('purchase_report','read')->access()){ ?>
                        <a href="<?php echo base_url('Admin_dashboard/todays_purchase_report')?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('purchase_report')?> </a>
                    <?php } ?>

                    <?php
                    if($this->permission1->method('sales_report_medicine_wise','read')->access()){ ?>
                        <a href="<?php echo base_url('Admin_dashboard/product_sales_reports_date_wise')?>" class="btn btn-primary m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('sales_report_product_wise')?> </a>
                    <?php } ?>

                    <?php
                    if($this->permission1->method('sales_report','read')->access()){ ?>
                        <a href="<?php echo base_url('Admin_dashboard/todays_sales_report')?>" class="btn btn-warning m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('sales_report')?> </a>
                    <?php } ?>

                
            </div>
        </div>

        <?php
        if($this->permission1->method('profit_loss','read')->access()){ ?>
		<!-- Profit report -->
		<div class="row">
			<div class="col-sm-12">
		        <div class="panel panel-default">
		            <div class="panel-body"> 
		                <?php echo form_open('Admin_dashboard/profit_manufacturer',array('class' => 'form-inline','method' => 'post'))?>
		                <?php date_default_timezone_set("Asia/Dhaka"); $today = date('Y-m-d'); ?>
		                <div class="row">
                            <label for="manufacturer" class="col-sm-3 col-form-label"><?php echo display('manufacturer') ?><i class="text-danger">*</i></label>

                            <div class="col-sm-6">
                             <select name="manufacturer_id" class="form-control">
                                <option value="">Select Manufacturer </option>
                                 <?php foreach($manufacturer as $manufacturers){?>
                                 <option value="<?php echo html_escape($manufacturers['manufacturer_id']);?>"><?php echo html_escape($manufacturers['manufacturer_name']);?></option>
                                 <?php }?>
                             </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="from_date" class="col-sm-3 col-form-label"><?php echo display('start_date') ?>:</label>
                            <div class="col-sm-6">
                            <input type="text" name="from_date" class="form-control datepicker" id="from_date" placeholder="<?php echo display('start_date') ?>" value="<?php echo $today?>" >
                        </div>
                        </div>
                       <br>
                        <div class="row">
                            <label for="to_date" class="col-sm-3 col-form-label"><?php echo display('end_date') ?>:</label>
                            <div class="col-sm-6">
                            <input type="text" name="to_date" class="form-control datepicker" id="to_date" placeholder="<?php echo display('end_date') ?>" value="<?php echo $today?>">
                        </div>
                        </div>
             <br>
                      <div class="col-sm-8 text-center">
                        <button type="submit" class="btn btn-success"><?php echo display('view_report') ?></button>
                    </div>
                          
		               <?php echo form_close()?>

		            </div>
		           
		        </div>
		    </div>
	     </div>

	   <?php
        }else{
        ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('You do not have permission to access. Please contact with administrator.');?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        } ?>
	</section>
</div>
 <!-- Profit Report End -->