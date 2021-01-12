
<script src="<?php echo base_url()?>my-assets/js/admin_js/invoice.js" type="text/javascript"></script>
<!-- Edit Invoice Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('invoice_edit') ?></h1>
            <small><?php echo display('invoice_edit') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('invoice') ?></a></li>
                <li class="active"><?php echo display('invoice_edit') ?></li>
            </ol>
        </div>
    </section>

    <?php
    if ($this->permission1->method('manage_invoice','update')->access()){ ?>
  <section class="content">
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
        <!-- Invoice report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('invoice_edit') ?></h4>
                        </div>
                    </div>
                    <?php echo form_open('Cinvoice/invoice_update',array('class' => 'form-vertical','id'=>'invoice_update' ))?>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-6" id="payment_from_1">
                                <div class="form-group row">
                                    <label for="product_name" class="col-sm-4 col-form-label"><?php echo display('customer_name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">

                                         <input type="text" size="100"  name="customer_name" class=" form-control" placeholder='<?php echo display('customer_name').'/'.display('phone') ?>' id="customer_name" value="{customer_name}" tabindex="1" onkeyup="customer_autocomplete()"/>

                                        <input id="autocomplete_customer_id" class="customer_hidden_value abc" type="hidden" name="customer_id" value="{customer_id}">
                                    </div>
                                </div>
                            </div>
                                <div class="col-sm-6" id="payment_from_1">
                                <div class="form-group row">
                                    <label for="payment_type" class="col-sm-4 col-form-label"><?php
                                        echo display('payment_type');
                                        ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <select name="paytype" class="form-control" required="" onchange="bank_paymet(this.value)">
                                            <option value="">Select Payment Option</option>
                                            <option value="1" <?php if($paytype ==1){echo 'selected';}?>>Cash Payment</option>
                                            <option value="2"  <?php if($paytype ==2){echo 'selected';}?>>Bank Payment</option> 
                                        </select>
                                      
                            <input type="hidden" name="" id="paytype" value="{paytype}"> 
                                     
                                    </div>
                                 
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="product_name" class="col-sm-4 col-form-label"><?php echo display('date') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" tabindex="2" class="form-control datepicker" name="invoice_date" value="{date}"  required />
                                    </div>
                                </div>
                            </div>
                               <div class="col-sm-6" id="bank_div">
                            <div class="form-group row">
                                <label for="bank" class="col-sm-4 col-form-label"><?php
                                    echo display('bank');
                                    ?> <i class="text-danger">*</i></label>
                                <div class="col-sm-8">
                                   <select name="bank_id" class="form-control bankpayment"  id="bank_id">
                                        <option value="">Select Location</option>
                                        <?php foreach($bank_list as $bank){?>
                                            <option value="<?php echo html_escape($bank['bank_id'])?>" <?php if($bank['bank_id'] == $bank_id){echo 'selected';}?>><?php echo html_escape($bank['bank_name']);?></option>
                                        <?php }?>
                                    </select>
                                 
                                </div>
                             
                            </div>
                        </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="normalinvoice">
                                <thead>
                                    <tr>
                                        <th class="text-center" class="productSelection"><?php echo display('item_information') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center" width="130"><?php echo display('batch') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('available_qnty') ?></th>
                                        <th class="text-center" width="120"><?php echo display('expiry') ?></th>
                                        <th class="text-center"><?php echo display('unit') ?></th>
                                        <th class="text-center"><?php echo display('qty') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('price') ?> <i class="text-danger">*</i></th>

                                        <?php if ($discount_type == 1) { ?>
                                        <th class="text-center"><?php echo display('discount_percentage') ?> %</th>
                                        <?php }elseif($discount_type == 2){ ?>
                                        <th class="text-center"><?php echo display('discount') ?> </th>
                                        <?php }elseif($discount_type == 3) { ?>
                                        <th class="text-center"><?php echo display('fixed_dis') ?> </th>
                                        <?php } ?>

                                        <th class="text-center"><?php echo display('total') ?>
                                        </th>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody id="addinvoiceItem">
                                <?php
                                if ($invoice_all_data) {
                                    foreach ($invoice_all_data as $invoice) {
                                      $availablestock =  $this->Invoices->get_total_product_batch($invoice['batch_id'],$invoice['product_id']);
                                      $available =  $availablestock['total_product'] + $invoice['quantity'];

                                        $batch_info = $this->db->select('batch_id')
                                                        ->from('product_purchase_details')
                                                        ->where('product_id',$invoice['product_id'])
                                                        ->get()
                                                        ->result();
                                ?>
                                <?php

                               $expire = $this->db->select('expeire_date')
                                                        ->from('product_purchase_details')
                                                        ->where('batch_id',$invoice['batch_id'])
                                                        ->group_by('batch_id')
                                                        ->get()
                                                        ->result();

                                ?>
                                    <tr>
                                        <td class="productSelection">
                                            <input type="text" name="product_name" onkeyup="invoice_productList(<?php echo $invoice['sl']?>);" value="<?php echo html_escape($invoice['product_name'])?>-(<?php echo html_escape($invoice['product_model'])?>)" class="form-control productSelection" required placeholder='<?php echo display('product_name') ?>' id="product_name_<?php echo html_escape($invoice['sl'])?>" tabindex="<?php echo html_escape($invoice['sl'])+2?>)">

                                            <input type="hidden" class="product_id_<?php echo $invoice['sl']?> autocomplete_hidden_value" name="product_id[]" value="<?php echo html_escape($invoice['product_id'])?>" id="product_id_<?php echo $invoice['sl']?>"/>
                                        </td>
                                        <td>
                                            <select name="batch_id[]" id="batch_id_<?php echo $invoice['sl']?>" class="form-control" required="required" onchange="product_stock(<?php echo $invoice['sl']?>)" tabindex="<?php echo $invoice['sl']+3?>)">
                                                <?php foreach ($batch_info as $batch) {?>
                                                <option value="<?php echo $batch->batch_id; ?>" <?php if ($batch->batch_id == $invoice['batch_id']) {echo "selected"; }?>><?php echo html_escape($batch->batch_id); ?></option>
                                                <?php }?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="available_quantity[]" class="form-control text-right available_quantity_<?php echo $invoice['sl']?>" value="<?php echo html_escape($available);?>" readonly="" id="available_quantity_<?php echo $invoice['sl']?>"/>
                                        </td>
                                        <td id="expire_date_<?php echo $invoice['sl']?>">
                                            <?php foreach ($expire as $vale) {
                                                echo $vale->expeire_date;
                                            }?>
                                        </td>
                                         <td>
                                            <input name="" id="" class="form-control text-right unit_<?php echo $invoice['sl']?> valid" value="<?php echo html_escape($invoice['unit'])?>" readonly="" aria-invalid="false" type="text">
                                        </td>
                                        <td>
                                            <input type="text" name="product_quantity[]" onkeyup="quantity_calculate(<?php echo $invoice['sl']?>),checkqty(<?php echo $invoice['sl']?>);" onchange="quantity_calculate(<?php echo $invoice['sl']?>);" value="<?php echo html_escape($invoice['quantity'])?>" class="total_qntt_<?php echo $invoice['sl']?> form-control text-right" id="total_qntt_<?php echo $invoice['sl']?>" min="0" placeholder="0.00" tabindex="<?php echo $invoice['sl']+4?>)" />
                                        </td>

                                        <td>
                                            <input type="text" name="product_rate[]" onkeyup="quantity_calculate(<?php echo $invoice['sl']?>),checkqty(<?php echo $invoice['sl']?>);" onchange="quantity_calculate(<?php echo $invoice['sl']?>);" value="<?php echo html_escape($invoice['rate'])?>" id="price_item_<?php echo $invoice['sl']?>" class="price_item<?php echo $invoice['sl']?> form-control text-right" min="0" required="" placeholder="0.00" readonly/>
                                        </td>
                                        <!-- Discount -->
                                        <td>
                                            <input type="text" name="discount[]" onkeyup="quantity_calculate(<?php echo $invoice['sl']?>),checkqty(<?php echo $invoice['sl']?>);"  onchange="quantity_calculate(<?php echo $invoice['sl']?>);" id="discount_<?php echo $invoice['sl']?>" class="form-control text-right" placeholder="0.00" value="<?php echo html_escape($invoice['discount'])?>" min="0" tabindex="<?php echo $invoice['sl']+5?>)"/>

                                            <input type="hidden" value="<?php echo html_escape($discount_type)?>" name="discount_type" id="discount_type_<?php echo $invoice['sl']?>">
                                        </td>

                                        <td>
                                            <input class="total_price form-control text-right" type="text" name="total_price[]" id="total_price_<?php echo $invoice['sl']?>" value="<?php echo html_escape($invoice['total_price'])?>" readonly="readonly" />

                                            <input type="hidden" name="invoice_details_id[]" id="invoice_details_id" value="<?php echo html_escape($invoice['invoice_details_id'])?>"/>
                                        </td>
                                         <td>

                                            <!-- Tax calculate start-->
                                            <?php $x=0;
                                            $p_id = $invoice['product_id'];
                                            foreach($taxes as $taxfldt){
                                                 
                                                ?>
                                            <input id="total_tax<?php echo $x;?>_<?php echo $invoice['sl']?>" class="total_tax<?php echo $x;?>_<?php echo $invoice['sl']?>" value="<?php echo $invoice['tax'.$x];?>" type="hidden">
                                            <input id="all_tax<?php echo $x;?>_<?php echo $invoice['sl']?>" class="total_tax<?php echo $x;?>" type="hidden" name="tax[]">
                                             <?php $x++;} ?>
                                            <!-- Tax calculate end-->

                                            <!-- Discount calculate start-->
                                            <input type="hidden" id="total_discount_<?php echo $invoice['sl']?>" class="" value="<?php echo html_escape($invoice['discount'])?>"/>

                                            <input type="hidden" id="all_discount_<?php echo $invoice['sl']?>" class="total_discount" value="<?php echo html_escape($invoice['discount']) * html_escape($invoice['quantity'])?>" />
                                            <!-- Discount calculate end -->

                                            <button  class="btn btn-danger" type="button" value="<?php echo display('delete')?>" onclick="deleteRow(this)" tabindex="<?php echo $invoice['sl']+6?>)"><i class="fa fa-close"></i></button>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                }
                                ?>
                                </tbody>

                                       <tfoot>
                                    
                                    <tr>
                                        <td colspan="7" rowspan="2">
                                        <center><label class="text-center" for="details" class="  col-form-label"><?php echo display('invoice_details') ?></label></center>
                                        <textarea name="inva_details" class="form-control" placeholder="<?php echo display('invoice_details') ?>">{invoice_details}</textarea>
                                    </td>
                                        <td class="text-right" colspan="1"><b><?php echo display('invoice_discount') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="invdcount" class="form-control text-right" name="invdcount" onkeyup="calculateSum(),checknum();" onchange="calculateSum()" placeholder="0.00" value="{invoice_discount}" />
                                            <input type="hidden" name="invoice_id" id="invoice_id" value="{invoice_id}"/>
                                           
                                        </td>
                                        <td> 
                                            <button  class="btn btn-info" type="button" onClick="addInputField('addinvoiceItem');" tabindex="12" id="add_invoice_item"><i class="fa fa-plus"></i>
                                            </button>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="1"  class="text-right"><b><?php echo display('total_discount') ?>:</b></td>
                                        <td class="text-right">
                                           <input type="text" id="total_discount_ammount" class="form-control text-right" name="total_discount"  readonly="readonly" value="{total_discount}"/>
                                              <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url();?>"/>
                                        </td>
                                    </tr>
                         


                             <?php $x=0;
                                     foreach($taxes as $taxfldt){?>
                                    <tr class="hideableRow hiddenRow">
                                       
                                <td class="text-right" colspan="8"><b><?php echo $taxfldt['tax_name'] ?></b></td>
                                <td class="text-right">
                                    <input id="total_tax_amount<?php echo $x;?>" tabindex="-1" class="form-control text-right valid totalTax" name="total_tax<?php echo $x;?>" value="<?php $txval ='tax'.$x;
                                     echo html_escape($taxvalu[0][$txval])?>" readonly="readonly" aria-invalid="false" type="text">
                                </td>
                               
                               
                                 
                                </tr>
                            <?php $x++;}?>
                              <tr>
                                         
                                        <td class="text-right" colspan="8"><b><?php echo display('total_tax') ?>:</b></td>
                                        <td class="text-right">
                                            <input id="total_tax_amount" tabindex="-1" class="form-control text-right valid" name="total_tax" value="{total_tax}" readonly="readonly" aria-invalid="false" type="text">
                                        </td>
                                         <td><a class="btn btn-warning taxbutton text-center"  data-toggle="collapse" data-target=".hiddenRow" aria-expanded="false" aria-controls="hiddenRow"><i class="fa fa-angle-double-up"></i></a></td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="8"  class="text-right"><b><?php echo display('grand_total') ?>:</b></td>
                                        <td class="text-right">
                                             <input type="text" id="grandTotal" class="form-control text-right" name="grand_total_price" value="<?php $grandttl=$total_amount;
                                            echo html_escape($grandttl); ?>" readonly="readonly" />
                                              <input type="hidden" id="txfieldnum" value="<?php echo count($taxes);?>">
                                        </td>
                                    </tr>
                                    <tr>
                                         <tr>
                                    <td colspan="8"  class="text-right"><b><?php echo display('previous'); ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="previous" class="form-control text-right" name="previous" value="{prev_due}" readonly="readonly" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="8"  class="text-right"><b><?php echo display('net_total'); ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="n_total" class="form-control text-right" name="n_total" value="{total_amount}" readonly="readonly" placeholder="" />
                                    </td>
                                </tr>

                                        <td class="text-right" colspan="8"><b><?php echo display('paid_ammount') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="paidAmount"
                                            onkeyup="calculateSum(),checknum();" class="form-control text-right" name="paid_amount" placeholder="0.00" tabindex="13" value="{paid_amount}"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input type="button" id="full_paid_tab" class="btn btn-warning" value="<?php echo display('full_paid') ?>" tabindex="14" onClick="full_paid()"/>

                                            <input type="submit" id="add_invoice" class="btn btn-success" name="add-invoice" value="<?php echo display('save_changes') ?>" tabindex="15"/>
                                        </td>

                                        <td class="text-right" colspan="7"><b><?php echo display('due') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="dueAmmount" class="form-control text-right" name="due_amount" value="{due_amount}" readonly="readonly"/>
                                        </td>
                                    </tr>
                                    <tr id="change_m"><td class="text-right" colspan="8" id="ch_l"><b>Change:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="change" class="form-control text-right" name="change" value="" readonly="readonly"/>
                                        </td></tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>
    </section>
   <?php
    }
    else{
    ?>
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo display('You do not have permission to access. Please contact with administrator')?></h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</div>
