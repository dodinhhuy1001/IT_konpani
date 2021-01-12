<?php
    $CI =& get_instance();
    $CI->load->model('Web_settings');
    $Web_settings = $CI->Web_settings->retrieve_setting_editdata();
?>
<script src="<?php echo base_url() ?>my-assets/js/admin_js/invoice_onloadprint.js" type="text/javascript"></script>
<style>
    @media print {
  #printPageButton {
    display: none;
  }
   #main-footer {
    display: none;
  }
  #content-header{
       display: none;
  }
  #pre-ldr{
    display: none;  
  }
  
  #main-heades{
      display:none;
  }
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" id="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('invoice_details') ?></h1>
            <small><?php echo display('invoice_details') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('invoice') ?></a></li>
                <li class="active"><?php echo display('invoice_details') ?></li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
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
        <?php
        if($this->permission1->method('manage_invoice','read')->access() ){ ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
	                <div>
	                    <div class="panel-body" id="printableArea">
	                        <div class="row print_header"> 
                                <div class="col-sm-8 company-content">
                                    {company_info}
                                    <img src="<?php
                                    if (isset($Web_settings[0]['invoice_logo'])) {
                                        echo html_escape($Web_settings[0]['invoice_logo']);
                                    }
                                    ?>" class="img-bottom-m" alt="" >
                                    <br>
                                    <span class="label label-success-outline m-r-15 p-10" ><?php echo display('billing_from') ?></span>
                                    <address class="margin-top10">
                                        <strong class="company_name_p">{company_name}</strong><br>
                                        {address}<br>
                                        <abbr><b><?php echo display('mobile') ?>:</b></abbr> {mobile}<br>
                                        <abbr><b><?php echo display('email') ?>:</b></abbr> 
                                        {email}<br>
                                        <abbr><b><?php echo display('website') ?>:</b></abbr> 
                                        {website}<br>
                                         {/company_info}
                                         <abbr>{tax_regno}</abbr>
                                    </address>

                                </div>
                                
                                 
                                <div class="col-sm-4 text-left invoice-address">
                                    <h2 class="m-t-0"><?php echo display('invoice') ?></h2>
                                    <div><?php echo display('invoice_no') ?>: {invoice_no}</div>
                                    <div class="m-b-15"><?php echo display('billing_date') ?>: {final_date}</div>

                                    <span class="label label-success-outline m-r-15"><?php echo display('billing_to') ?></span>

                                    <address class="customer_name_p">  
                                        <strong  class="c_name" >{customer_name} </strong><br>
                                        <?php if ($customer_address) { ?>
                                            {customer_address}
                                        <?php } ?>
                                        <br>
                                        <abbr><b><?php echo display('mobile') ?>:</b></abbr>
                                        <?php if ($customer_mobile) { ?>
                                            {customer_mobile}
                                        <?php }if ($customer_email) {
                                            ?>
                                            <br>
                                            <abbr><b><?php echo display('email') ?>:</b></abbr> 
                                            {customer_email}
                                        <?php } ?>
                                    </address>
                                </div>
                            </div> 


	                        <div class="table-responsive m-b-20">
	                            <table class="table table-striped table-bordered">
	                                <thead>
	                                    <tr>
	                                        <th class="text-center"><?php echo display('sl') ?></th>
	                                        <th class="text-center"><?php echo display('product_name') ?></th>
	                                        <th class="text-center"><?php echo display('quantity') ?></th>

	                                        <?php if ($discount_type == 1) { ?>
	                                        <th class="text-center"><?php echo display('discount_percentage') ?> %</th>
	                                        <?php }elseif($discount_type == 2){ ?>
	                                        <th class="text-center"><?php echo display('discount') ?> </th>
	                                        <?php }elseif($discount_type == 3) { ?>
	                                        <th class="text-center"><?php echo display('fixed_dis') ?> </th>
	                                        <?php } ?>

	                                        <th class="text-center"><?php echo display('rate') ?></th>
	                                        <th class="text-center"><?php echo display('ammount') ?></th>
	                                    </tr>
	                                </thead>
	                                <tbody>
										
										<?php 
                                        $subtotalamount = 0;
                                        $return_discount = 0;
                                        $return_amount = 0;
										 foreach($invoice_all_data as $details){?>
										<tr>
	                                    	<td class="text-center"><?php echo $details['sl']?></td>
	                                        <td class="text-center"><div><strong><?php echo html_escape($details['product_name']).' - '.html_escape($details['strength']);
	                                        if($details['quantity'] < 0){
	                                        	echo '('.' <span class="text-danger">Returned</span> '.')';
	                                        }?></strong></div></td>
	                                        <td align="center"><?php
	                                        if($details['quantity'] < 0){ echo $qty = -1*html_escape($details['quantity']);}else{
	                                        	echo $qty = html_escape($details['quantity']);
	                                        }
	                                          ?></td>

	                                        <?php
	                                        if($details['quantity'] < 0){
	                                         $discounts =  -1*html_escape($details['discount']);
	                                         $tp = -1*html_escape($details['total_price']);
	                                        
	                                     }else{
	                                        $discounts = $details['discount'];
	                                        $tp = $details['total_price'];
	                                        }
	                                         if ($discount_type == 1) { ?>
	                                        <td align="center"><?php echo $discounts;
	                                         $dis_amount = ($qty*$details['rate']*$discounts)/100;
	                                        ?></td>
	                                        <?php }elseif($discount_type == 2){ ?>
	                                        <td align="center"><?php echo (($position==0)?"$currency ".$discounts."":"".$discounts." $currency");
                                            $dis_amount = $qty*$discounts;
	                                         ?></td>
	                                        <?php }else{ ?>
	                                        	 <td align="center"><?php echo (($position==0)?"$currency ".$discounts."":"".$discounts." $currency");
                                                 $dis_amount = $discounts;
	                                        	  ?></td>
	                                        <?php }?>

	                                        <td align="center"><?php echo (($position==0)?"$currency ".$details['rate']."":"".$details['rate']." $currency") ?></td>
	                                        <td align="right"><?php
	                                         if($details['quantity'] < 0){ 
	                                         	 $totalprice = $tp - $dis_amount;
	                                         	 $subtotalamount -= $totalprice;
	                                         	 $return_discount += $dis_amount;
	                                         	 $return_amount  +=$totalprice;
	                                         }else{
	                                        	 $totalprice = $tp;
	                                        	 $subtotalamount += $totalprice;
	                                        }

                                           
	                                         echo (($position==0)?"$currency ".html_escape($totalprice)."":"".html_escape($totalprice)." $currency") ?></td>
	                                    </tr>
	                                <?php }?>
	                                    
	                                </tbody>
	                                <tfoot>
	                                	<td align="center" colspan="1"><b><?php echo display('sub_total')?>:</b></td>
	                                	<td></td>
	                                	<td align="center" ><b>{subTotal_quantity}</b></td>
	                                	<td></td>
	                                	<td></td>

	                                	<td class="text-right" align="center" ><b><?php echo (($position==0)?"$currency ".html_escape($subtotalamount): html_escape($subtotalamount)." $currency") ?></b></td>
	                                </tfoot>
	                            </table>
	                        </div>
	                        <div class="row">

		                        	<div class="col-xs-8">

		                                <p></p>
		                                <p><strong>{invoice_details}</strong></p>
		                               
		                            </div>
		                            <div class="col-xs-4">

				                        <table class="table">
				                            <?php
                                        if ($invoice_all_data[0]['invoice_discount'] != 0) {
                                            ?>
                                            <tr>
                                                <th><?php echo display('invoice_discount') ?> : </th>
                                                <td class="text-right"><?php echo (($position == 0) ? "$currency {invoice_discount}" : "{invoice_discount} $currency") ?> </td>
                                            </tr>
                                            <?php
                                        }
                                        if ($invoice_all_data[0]['total_discount'] != 0) {
                                            ?>
                                            <tr>
                                                <th><?php echo display('total_discount') ?> : </th>
                                                <td class="text-right"><?php
                                                  $dis = $total_discount + $return_discount + $invoice_discount;
                                                 echo (($position == 0) ? "$currency ".html_escape($dis) : html_escape($dis)." $currency") ?> </td>
                                            </tr>
                                            <?php
                                        }
                                        if ($invoice_all_data[0]['total_tax'] != 0) {
                                            ?>
                                            <tr>
                                                <th class="text-left"><?php echo display('tax') ?> : </th>
                                                <td  class="text-right"><?php echo (($position == 0) ? "$currency {total_tax}" : "{total_tax} $currency") ?> </td>
                                            </tr>
                                        <?php } ?>
                                       
                                        <tr>
                                            <th class="text-left grand_total"><?php echo display('previous'); ?> :</th>
                                            <td class="text-right grand_total"><?php echo (($position == 0) ? "$currency {previous}" : "{previous} $currency") ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-left grand_total"><?php echo  display('grand_total') ?> :</th>
                                            <td class="text-right grand_total"><?php
                                            $tmnt = $total_amount-$return_amount;
                                             echo (($position == 0) ? "$currency ".html_escape($tmnt)  : html_escape($tmnt)." $currency") ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-left grand_total"><?php echo display('paid_ammount') ?> : </th>
                                            <td class="text-right grand_total"><?php echo (($position == 0) ? "$currency {paid_amount}" : "{paid_amount} $currency") ?></td>
                                        </tr>				 
                                        <?php
                                        if ($invoice_all_data[0]['due_amount'] != 0) {
                                            ?>
                                            <tr>
                                                <th class="text-left grand_total"><?php echo display('due') ?> : </th>
                                                <td  class="text-right grand_total"><?php
                                                 $due = $tmnt - $paid_amount;
                                                 echo (($position == 0) ? "$currency ".html_escape($due) : html_escape($due)."{due_amount} $currency") ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>

		                              

		                        </div>
		                        <div class="row">
                                <div class="col-sm-4">
                                 <div class="inv-footer-left">
                                 	 <input type="hidden" name="" id="url" value="<?php echo base_url('Cinvoice');?>">
                                        <?php echo display('received_by') ?>
                                    </div>
                                </div>
                               <div class="col-sm-4"></div>
                                     <div class="col-sm-4"> <div class="inv-footer-right">
                                        <?php echo display('authorised_by') ?>
                                    </div></div>
                            </div>
	                        </div>
	                    </div>
	                </div>

                    
                </div>
                 <div class="panel-footer text-left">
						<button  class="btn btn-info" id="printPageButton" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></button>

                    </div>
            </div>
        </div>
        <?php
        }
        else{
        ?>
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('You do not have permission to access. Please contact with administrator.');?></h4>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->



