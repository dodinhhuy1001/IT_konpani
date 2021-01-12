
<!-- Customer js php -->

<script src="<?php echo base_url() ?>my-assets/js/admin_js/return.js" type="text/javascript"></script>

<!-- Edit Invoice Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('return_invoice')?> </h1>
            <small><?php echo display('return_invoice')?></small>

        </div>
    </section>

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


        <?php
        if($this->permission1->method('return','create')->access()){
        ?>
        <!-- Invoice report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('return_invoice')?></h4>
                        </div>
                    </div>
                    <?php echo form_open('Cretrun_m/return_invoice',array('class' => 'form-vertical','id'=>'invoice_update' ))?>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-6" id="payment_from_1">
                                <div class="form-group row">
                                    <label for="product_name" class="col-sm-4 col-form-label"><?php echo display('customer_name') ?> <i class="text-danger"></i></label>
                                    <div class="col-sm-8">
                                       <input type="text" name="customer_name" value="{customer_name}" class="form-control customerSelection" placeholder='<?php echo display('customer_name') ?>' required id="customer_name" tabindex="1" readonly="">

                                        <input type="hidden" class="customer_hidden_value" name="customer_id" value="{customer_id}" id="SchoolHiddenId"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="product_name" class="col-sm-4 col-form-label"><?php echo display('date') ?> <i class="text-danger"></i></label>
                                    <div class="col-sm-8">
                                        <input type="text" tabindex="2" class="form-control" name="invoice_date" value="{date}"  required readonly="" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="normalinvoice">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('item_information') ?> <i class="text-danger"></i></th>
                                        <th class="text-center"><?php echo display('sold_qty') ?></th>

                                        <th class="text-center"><?php echo display('ret_quantity') ?>  <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('rate') ?> <i class="text-danger"></i></th>

                                        <?php if ($discount_type == 1) { ?>
                                        <th class="text-center"><?php echo display('discount_percentage') ?> %</th>
                                        <?php }elseif($discount_type == 2){ ?>
                                        <th class="text-center"><?php echo display('deduction') ?> </th>
                                        <?php }elseif($discount_type == 3) { ?>
                                        <th class="text-center"><?php echo display('fixed_dis') ?> </th>
                                        <?php } ?>

                                        <th class="text-center"><?php echo display('total') ?></th>
                                        <th class="text-center"><?php echo display('check_return') ?> <i class="text-danger">*</i></th>
                                    </tr>
                                </thead>
                                <tbody id="addinvoiceItem">
                                     <?php
                                    $sl=1;
                                    foreach ($invoice_all_data as $retdata) {?>

                                    <tr>
                                        <td class="product_field">
                                            <input type="text" name="product_name" onclick="invoice_productList(<?php echo $sl;?>);" value="<?php echo $retdata['product_name'].' ('.$retdata['strength'].')';?>" class="form-control productSelection" required placeholder='<?php echo display('product_name') ?>' id="product_names" tabindex="3" readonly="">

                                            <input type="hidden" class="product_id_<?php echo $sl;?> autocomplete_hidden_value"  value="<?php echo $retdata['product_id'];?>" id="product_id_<?php echo $sl;?>"/>
                                             <input type="hidden" class="batch_id_<?php echo $sl;?>"  value="<?php echo $retdata['batch_id'];?>" name="batch_id[]" id="batch_id_<?php echo $sl;?>"/>
                                        </td>
                                        <td>
                                            <input type="text" name="sold_qty[]" class="form-control text-right available_quantity_<?php echo $sl;?>" id="sold_qty_<?php echo $sl;?>" value="<?php

                                         $stockqty = $this->db->select('sum(quantity) as qty')->from('invoice_details')->where('product_id',$retdata['product_id'])->where('invoice_id',$retdata['invoice_id'])->get()->row();

                                             echo $stockqty->qty;?>" readonly="" />
                                        </td>

                                        <td>
                                            <input type="text"  onkeyup="quantity_calculate(<?php echo $sl;?>),checkrequird(<?php echo $sl;?>),checkqty(<?php echo $sl;?>);" onchange="quantity_calculate(<?php echo $sl;?>);"  class="total_qntt_<?php echo $sl;?> form-control text-right" id="total_qntt_<?php echo $sl;?>" placeholder="0.00" tabindex="4" />
                                        </td>

                                        <td>
                                            <input type="text" onkeyup="quantity_calculate(<?php echo $sl;?>);" onchange="quantity_calculate(<?php echo $sl;?>);" value="<?php echo $retdata['rate'];?>" id="price_item_<?php echo $sl;?>" class="price_item<?php echo $sl;?> form-control text-right" min="0" tabindex="5" required="" placeholder="0.00" readonly=""/>
                                        </td>
                                        <!-- Discount -->
                                        <td>
                                            <input type="text"  onkeyup="quantity_calculate(<?php echo $sl;?>);"  onchange="quantity_calculate(<?php echo $sl;?>);" id="discount_<?php echo $sl;?>" class="form-control text-right" placeholder="0.00" value="" min="0" tabindex="6"/>

                                            <input type="hidden" value="<?php echo $discount_type?>" name="discount_type" id="discount_type_<?php echo $sl;?>">
                                        </td>

                                        <td>
                                            <input class="total_price form-control text-right" type="text"  id="total_price_<?php echo $sl;?>" value="" readonly="readonly" />

                                            <input type="hidden" name="invoice_details_id[]" id="invoice_details_id" value="<?php echo $retdata['invoice_details_id'];?>"/>
                                        </td>
                                         <td>

                                            <!-- Tax calculate start-->
                                            <input id="total_tax_<?php echo $sl;?>" class="total_tax_<?php echo $sl;?>" type="hidden" value="<?php echo $retdata['tax'];?>">
                                            <input id="all_tax_<?php echo $sl;?>" class="total_tax" type="hidden" value="0" name="tax[]">
                                            <!-- Tax calculate end-->

                                            <!-- Discount calculate start-->
                                            <input type="hidden" id="total_discount_<?php echo $sl;?>" class="" value=""/>

                                            <input type="hidden" id="all_discount_<?php echo $sl;?>" class="total_discount" value="" />
                                            <!-- Discount calculate end -->
                                                 <input type="checkbox" name='rtn[]' onclick="checkboxcheck(<?php echo $sl;?>)" id="check_id_<?php echo $sl;?>" value="<?php echo $sl;?>" class="form-control cheklabel" >
                                        </td>
                                    </tr>
                                  <?php $sl++; }
                                 ?>
                                </tbody>

                                <tfoot>

                                    <tr>
                                        <td colspan="4" rowspan="3">
                                           <center><label class="text-center" for="details" class="  col-form-label"><?php echo display('reason') ?></label></center>
                                             <textarea class="form-control" name="details" id="details" placeholder="<?php echo display('reason') ?>"></textarea> <br>
                                             <input type="hidden" checked="checked" name="radio" value="1">
                                        </td>
                                        <td class="text-right" colspan="1"><b><?php echo display('to_deduction') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="total_discount_ammount" class="form-control text-right" name="total_discount" value="" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="1" ><b><?php echo display('total_tax') ?>:</b></td>
                                        <td class="text-right">
                                            <input id="total_tax_ammount" tabindex="-1" class="form-control text-right valid" name="total_tax" value="{total_tax}" readonly="readonly" aria-invalid="false" type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1"  class="text-right"><b><?php echo display('nt_return') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="grandTotal" class="form-control text-right" name="grand_total_price" value="" readonly="readonly" />
                                        </td>
                                         <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url();?>"/>
                                            <input type="hidden" name="invoice_id" id="invoice_id" value="{invoice_id}"/>
                                    </tr>


                                </tfoot>
                            </table>
                        </div>
                         <div class="form-group row">
                            <label for="example-text-input" class=" col-form-label"></label>
                            <div class="col-sm-12 text-right">


                                            <input type="submit" id="add_invoice" class="btn btn-success btn-large" name="add-invoice" value="<?php echo display('return') ?>" tabindex="9"/>

                            </div>
                        </div>
                    </div>
                    <?php echo form_close()?>
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
    </section>
</div>




