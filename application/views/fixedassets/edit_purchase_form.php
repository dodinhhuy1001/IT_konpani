<script src="<?php echo base_url() ?>my-assets/js/admin_js/fixedassets.js" type="text/javascript"></script>
<!-- Add New Purchase Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('fixed_assets') ?></h1>
            <small><?php echo display('add_new_purchase') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('fixed_assets') ?></a></li>
                <li class="active"><?php echo display('add_purchase') ?></li>
            </ol>
        </div>
    </section>

    <section class="content">
        <!-- Alert Message -->
        <?php
            $message = $this->session->userdata('message');
            if (isset($message)) {
        ?>
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
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

        <!-- Purchase report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('add_purchase') ?></h4>
                        </div>
                    </div>

                    <div class="panel-body">
                    <?php echo form_open_multipart('Fixedassets/update_asserts_purchase',array('class' => 'form-vertical', 'id' => 'update_asserts_purchase','name' => 'update_asserts_purchase'))?>
                        
                      <div class="row">
                          <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('purchase_date') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <?php $date = date('Y-m-d'); ?>
                                        <input type="text" tabindex="2" class="form-control datepicker" name="purchase_date" value="{date}" id="date" required />
                                        <input type="hidden" name="id" value="{id}">
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
                                            <option value="1" <?php if($type ==1){echo 'selected';}?>>Cash Payment</option>
                                            <option value="2" <?php if($type ==2){echo 'selected';}?>>Bank Payment</option>
                                            <option value="3" <?php if($type ==3){echo 'selected';}?>>Due Payment</option>
                                            
                                        </select>
                                      

                                     
                                    </div>
                                 
                                </div>
                            </div>
                        </div>
                        <div class="row">

                <div class="col-sm-6" id="payment_from_1">
                                <div class="form-group row">
                                    <label for="supplier_code" class="col-sm-4 col-form-label"><?php
                                        echo display('supplier_name');
                                        ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <select name="supplier_id" id="supplier_id" class="form-control" onchange="supplier_info(this)" required="">
                                        <option value="">Select Supplier</option>
                                        <?php foreach($supplier_list as $suppliers){?>
                                            <option value="<?php echo html_escape($suppliers['supplier_id'])?>" <?php if($suppliers['supplier_id']== $supplier_id){echo 'selected';}?>><?php echo html_escape($suppliers['supplier_name'])?></option>
                                        <?php }?>
                                    </select>
                                    <input type="hidden" name="purchase_id" value="{id}">
                                    </div>
                                 
                                </div>
                            </div>
                            
                             <div class="col-sm-6" id="">
                                <div class="form-group row">
                                    <label for="address" class="col-sm-4 col-form-label"><?php
                                        echo display('address');
                                        ?> <i class="text-danger"></i></label>
                                    <div class="col-sm-8">
                                        <input type="text" size="100"  name="address" class=" form-control" placeholder='<?php echo display('address') ?>' id="address" tabindex="1" value="{address}" readonly/>

                                     
                                    </div>
                                 
                                </div>
                            </div>
                            
                             <div class="col-sm-6" id="payment_from_1">
                                <div class="form-group row">
                                    <label for="previous" class="col-sm-4 col-form-label"><?php
                                        echo display('previous');
                                        ?> <i class="text-danger"></i></label>
                                    <div class="col-sm-8">
                                        <input type="text" size="100"  name="previous" class=" form-control" placeholder='<?php echo display('previous') ?>' id="previous" tabindex="1" readonly/>

                                     
                                    </div>
                                 
                                </div>
                            </div>

                                <div class="col-sm-6" id="bank_div">
                                <div class="form-group row">
                                    <label for="bank" class="col-sm-4 col-form-label"><?php
                                        echo display('bank');
                                        ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                       <select name="bank_id" class="form-control" id="bank_id">
                                            <option value="">Select Location</option>
                                            <?php foreach($bank_list as $bank){?>
                                                <option value="<?php echo html_escape($bank['bank_id'])?>" <?php if($bank['bank_id']==$bank_id){echo 'selected';}?>><?php echo html_escape($bank['bank_name']);?></option>
                                            <?php }?>
                                        </select>
                                     
                                    </div>
                                 
                                </div>
                            </div>
                           
                        </div>
                  

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="fixpurchaseTable">
                                <thead>
                                     <tr>
                                         <th class="text-center" width="20%"><?php echo display('item_code') ?><i class="text-danger">*</i></th> 
                                            <th class="text-center" width="20%"><?php echo display('item_information') ?><i class="text-danger">*</i></th> 
                                          
                                            <th class="text-center"><?php echo display('quantity') ?> <i class="text-danger">*</i></th>
                                            <th class="text-center"><?php echo display('price') ?><i class="text-danger">*</i></th>
                                            <th class="text-center"><?php echo display('total') ?></th>
                                            <th class="text-center"><?php echo display('action') ?></th>
                                        </tr>
                                </thead>
                                <tbody id="addPurchaseItem">
                                      {purchase_details}
                                    <tr>
                                        <td class="span3 supplier">
                                           <input type="text" name="item_codess" required class="form-control item_code productSelection" onkeypress="product_pur_or_list({sl});" placeholder="<?php echo display('item_code') ?>" id="item_code_{sl}" tabindex="5" value="{item_code}">

                                            <input type="hidden" class="autocomplete_hidden_value item_code_{sl}" name="item_code[]" id="SchoolHiddenId"  value="{item_code}"/>

                                            <input type="hidden" class="sl" value="{sl}">
                                        </td>
                                        <td class="span3 ">
                                           <input type="text" name="item_name" class="form-control item_name " placeholder="<?php echo display('item_name') ?>" id="item_name_{sl}" tabindex="5" readonly  value="{item_name}">
                                           
                                        </td>

                                      
                                        
                                            <td class="text-right">
                                                <input type="text" name="item_qty[]" id="cartoon_{sl}" class="form-control text-right store_cal_{sl}" onkeyup="calculate_store({sl});" onchange="calculate_store({sl});" placeholder="0.00" value="{qty}" min="0" tabindex="6"/>
                                            </td>
                                            <td class="test">
                                                <input type="text" name="item_price[]" onkeyup="calculate_store({sl});" onchange="calculate_store({sl});" id="item_price_{sl}" class="form-control item_price_{sl} text-right" placeholder="0.00" value="{price}" min="0" tabindex="7"/>
                                            </td>
                                           

                                            <td class="text-right">
                                                <input class="form-control total_price text-right" type="text" name="total_price[]" id="total_price_{sl}" value="{total}" readonly="readonly" />
                                            </td>
                                            

                                                             <td>
                             <button type="button" class="btn btn-danger" tabindex="12" onclick="deleteRowfix(this)"><i class="fa fa-close"></i></button>
                                            </td>
                                    </tr>
                                      {/purchase_details}
                                </tbody>
                                <tfoot>
                                          
                                  
                                    <tr>
                                        <td colspan="3">
                                          
                                        </td>
                                        <td class="text-right" colspan="1"><b><?php echo display('grand_total') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="grandTotal" class="text-right form-control" name="grand_total_price" value="{gtotal}" readonly="readonly" />
                                        </td>
                                         <td><button type="button" id="add_invoice_item" class="btn btn-info" name="add-invoice-item"  onClick="addPurchaseOrderField1Fixedassets('addPurchaseItem')" tabindex="9"><i class="fa fa-plus"></i></button>
                                          <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url();?>"/></td>
                                    </tr>
                                   
                                </tfoot>
                            </table>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 text-right">
                                <input type="submit" id="add_purchase" class="btn btn-primary btn-large" name="add-purchase" value="<?php echo display('update') ?>" />
                              
                            </div>
                        </div>
                    <?php echo form_close()?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>







