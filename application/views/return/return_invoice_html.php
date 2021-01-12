<?php
    $CI =& get_instance();
    $CI->load->model('Web_settings');
    $Web_settings = $CI->Web_settings->retrieve_setting_editdata();
?>


<!-- Printable area end -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('return_details') ?></h1>
            <small><?php echo display('return_details') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('return') ?></a></li>
                <li class="active"><?php echo display('return_details') ?></li>
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
        if($this->permission1->method('manage_invoice','read')->access()) { ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd">
                        <div id="printableArea">
                            <div class="panel-body">
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
                                         
                                    </address>

                                </div>
                                
                                 
                                <div class="col-sm-4 text-left invoice-address">
                                    <h2 class="m-t-0"><?php echo display('return') ?></h2>
                                    <div><?php echo display('invoice_id') ?>: {invoice_id}</div>
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
                                                <th class="text-center"><?php echo display('discount_percentage') ?>%
                                                </th>
                                            <?php } elseif ($discount_type == 2) { ?>
                                                <th class="text-center"><?php echo display('discount') ?> </th>
                                            <?php } elseif ($discount_type == 3) { ?>
                                                <th class="text-center"><?php echo display('fixed_dis') ?> </th>
                                            <?php } ?>

                                            <th class="text-center"><?php echo display('rate') ?></th>
                                            <th class="text-center"><?php echo display('ammount') ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {invoice_all_data}
                                        <tr>
                                            <td class="text-center">{sl}</td>
                                            <td class="text-center">
                                                <div><strong>{product_name} - ({product_model})</strong></div>
                                            </td>
                                            <td align="center">{ret_qty}</td>

                                            <?php if ($discount_type == 1) { ?>
                                                <td align="center">{deduction}</td>
                                            <?php } else { ?>
                                                <td align="center"><?php echo(($position == 0) ? "$currency {deduction}" : "{deduction} $currency") ?></td>
                                            <?php } ?>

                                            <td align="center"><?php echo(($position == 0) ? "$currency {product_rate}" : "{product_rate} $currency") ?></td>
                                            <td align="center"><?php echo(($position == 0) ? "$currency {total_ret_amount}" : "{total_ret_amount} $currency") ?></td>
                                        </tr>
                                        {/invoice_all_data}
                                        </tbody>
                                        <tfoot>
                                        <td align="center" colspan="1">
                                            <b><?php echo display('total') ?>:</b></td>
                                        <td></td>
                                        <td align="center"><b>{subTotal_quantity}</b></td>
                                        <td></td>
                                        <td></td>

                                        <td align="center">
                                            <b><?php echo(($position == 0) ? "$currency {subTotal_ammount}" : "{subTotal_ammount} $currency") ?></b>
                                        </td>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="row">

                                    <div class="col-xs-8">
                                        <p><strong>Note : </strong>{note}</p>

                                      
                                    </div>
                                    <div class="col-xs-4">

                                        <table class="table">
                                            <?php
                                            if ($invoice_all_data[0]['total_deduct'] != 0) {
                                                ?>
                                                <tr>
                                                    <th><?php echo display('deduction') ?>
                                                        :
                                                    </th>
                                                    <td><?php echo(($position == 0) ? "$currency {total_deduct}" : "{total_deduct} $currency") ?> </td>
                                                </tr>
                                            <?php }
                                            if ($invoice_all_data[0]['total_tax'] != 0) {
                                                ?>
                                                <tr>
                                                    <th><?php echo display('tax') ?>
                                                        :
                                                    </th>
                                                    <td><?php echo(($position == 0) ? "$currency {total_tax}" : "{total_tax} $currency") ?> </td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <th class="grand_total"><?php echo display('grand_total') ?> :</th>
                                                <td class="grand_total"><?php echo(($position == 0) ? "$currency {total_amount}" : "{total_amount} $currency") ?></td>
                                            </tr>

                                        </table>

                                        
                                    </div>
                                </div>
                                      <div class="row">
                                <div class="col-sm-4">
                                 <div class="inv-footer-left">
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

                        <div class="panel-footer text-left">
                            <a class="btn btn-danger"
                               href="<?php echo base_url('Cretrun_m'); ?>"><?php echo display('cancel') ?></a>
                            <button class="btn btn-info" onclick="printDiv('printableArea')"><span
                                        class="fa fa-print"></span></button>

                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        else{
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
        }
        ?>
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->



