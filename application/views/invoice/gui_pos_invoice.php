 <link href="<?php echo base_url() ?>assets/css/gui_pos.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url()?>my-assets/js/admin_js/invoice.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>my-assets/js/admin_js/guibarcode.js" type="text/javascript"></script>

<!-- Add new invoice start -->


<!-- Customer type change by javascript end -->

<!-- Add New Invoice Start -->
<div class="content-wrapper">
    

    <section class="content">
    <div class="alert alert-danger fade in" id="almsg" > No Available Qty ..
   </div>

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


     <div class="row">
 <div class="col-sm-12">
         <div class="panel panel-default">
                    <div class="panel-body"> 
    
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="active">
          <a href="#nsale" role="tab" data-toggle="tab" >
               <?php echo display('new_invoice');?>
          </a>
      </li>
      <li><a href="#saleList" role="tab" data-toggle="tab" >
           Today's Sale
          </a>
      </li>

    </ul>
    
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane active" id="nsale">
         
                <div class="panel panel-default">
                    <div class="panel-body"> 
                         <input name="url" type="hidden" id="posurl" value="<?php echo base_url("Cinvoice/getitemlist") ?>" />
                        <div class="col-sm-6">
                        <form class="navbar-search" method="get" action="<?php echo base_url("ordermanage/order/pos_invoice")?>">
                    <label class="sr-only screen-reader-text" for="search">Search:</label>
                    <div class="input-group">
                        <input type="text" id="product_name" class="form-control search-field" dir="ltr" value="" name="s" placeholder="Search By Product" />

                        <div class="input-group-addon search-categories">
                        <?php 
                       
                        echo form_dropdown('category_id',$categorylist,(!empty($categorylist->categorey_id)?$categorylist->categorey_id:null),'id="category_id" class="form-control"') ?>
                        </div>
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-secondary" id="search_button"><i class="ti-search"></i></button>
                        </div>
                    </div>
                </form>
            <div class="product-grid scrollbar"  id="style-3">
             
                    <div class="row row-m-3" id="product_search">
                    <?php $i=0;
                    foreach($itemlist as $item){
                        
                        ?>
                            <div class="col-xs-6 col-sm-4 col-md-2 col-p-3">
                            <div class="panel panel-bd product-panel select_product">
                                <div class="panel-body">
                                    <img src="<?php echo !empty($item->image)?$item->image:'assets/img/icons/default.jpg'; ?>" class="img-responsive pointer" onclick="onselectimage('<?php echo $item->product_id ?>')" alt="<?php echo html_escape($item->product_name);?>" >
                                </div>
                                <div class="panel-footer"><?php
 $text=$item->product_name;
$pieces = substr($text, 0, 11);
$ps = substr($pieces, 0, 10)."...";
$cn=strlen($text);
if ($cn>11) {
  echo html_escape($ps);
}else
{
echo html_escape($text);
}
;
                                ?></div>
                            </div>
                        </div>
                       <?php } ?>
                       </div>
                                       
                                        
                </div>
                </div>
                <div class="col-sm-6"> 
                    
           <div class="form-group row guicustomerpanel">
 <div class="col-sm-5">                           
       <input type="text" name="product_name" class="form-control col-sm-2" placeholder='<?php echo display('barcode_qrcode_scan_here') ?>' id="add_item" autocomplete='off' tabindex="1" value="">
   </div>
   <label class="col-sm-2">OR</label>
   <div class="col-sm-5"> 
       <input type="text" name="product_name_m" class="form-control col-sm-2" placeholder='Manual Input barcode' id="add_item_m_g" autocomplete='off' tabindex="1" value="">
 <input type="hidden" id="product_value" name="">
           </div>  
           </div>      
 <div class="form-group">
   <?php echo form_open_multipart('Cinvoice/manual_sales_insert', array('class' => 'form-vertical', 'id' => 'gui_sale_insert', 'name' => 'insert_pos_invoice')) ?>
    <div class="form-group row">
        <div class="col-sm-10">
   <input type="text" size="100"  name="customer_name" class="customerSelection form-control" placeholder='<?php echo display('customer_name').'/'.display('phone') ?>' id="customer_name" value="{customer_name}" tabindex="3"  onkeypress="customer_autocomplete(1)"/>
   <input id="autocomplete_customer_id" class="customer_hidden_value" type="hidden" name="customer_id" value="{customer_id}">
    <input id="paytype" class="" type="hidden" name="paytype" value="1">
    <input id="date" class="" type="hidden" name="invoice_date" value="<?php echo date('Y-m-d');?>">
     <?php
                                        if (empty($customer_name)) {
                                            ?>
                                            <small id="emailHelp" class="text-danger"><?php echo display('please_add_walking_customer_for_default_customer') ?></small>
                                            <?php
                                        }
                                        ?>
</div>
<div class="col-sm-2">
      <a href="#" class="client-add-btn btn btn-success" aria-hidden="true" data-toggle="modal" data-target="#cust_info"><i class="ti-plus m-r-2"></i></a>
</div>
</div>
          <div class="table-responsive guiproductdata">
                            <table class="table table-bordered table-hover table-sm nowrap gui-products-table" id="normalinvoice">
                                <thead>
                                    <tr>
                                          <th class="text-center gui_productname"><?php echo display('item_information') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center" width="150"><?php echo display('batch') ?><i class="text-danger">*</i></th>
                                       <th class="text-center"><?php echo display('expiry') ?></th>
                                        <th class="text-center"><?php echo display('qty') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('price') ?> <i class="text-danger">*</i></th>
                                        <?php if ($discount_type == 1) { ?>
                                            <th class="text-center"><?php echo display('dis') ?> %</th>
                                        <?php } elseif ($discount_type == 2) { ?>
                                            <th class="text-center"><?php echo display('dis') ?> </th>
                                        <?php } elseif ($discount_type == 3) { ?>
                                            <th class="text-center"><?php echo display('fixed_dis') ?> </th>
                                        <?php } ?>
                                        <th class="text-center"><?php echo display('total') ?></th>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody id="addinvoiceItem">
                                    <tr></tr>
                                </tbody>
                          
                            </table>

                        </div>
                        <div class="footer">
                             <div class="form-group row guifooterpanel">
                                     <div class="col-sm-12"> <label for="date" class="col-sm-5 col-form-label"><?php echo display('invoice_discount') ?>:</label><div class="col-sm-5">  <input type="text" id="invdcount" class="form-control text-right" name="invdcount" onkeyup="calculateSum(),checknum();" onchange="calculateSum()" placeholder="0.00" />
                                            </div></div>
                                    <div class="col-sm-12"> <label for="date" class="col-sm-5 col-form-label"><?php echo display('total_discount') ?>:</label><div class="col-sm-5">  <input type="text" id="total_discount_ammount" class="form-control text-right" name="total_discount" value="0.00" readonly="readonly" />
                                             </div></div> 
                                        </div> 
                                <div class="form-group row hiddenRow guifooterpanel"  id="taxdetails">
                                         <?php $x=0;
                                     foreach($taxes as $taxfldt){?>

                               <div class="col-sm-12"> <label for="date" class="col-sm-5 col-form-label"><?php echo html_escape($taxfldt['tax_name']) ?>:</label><div class="col-sm-5">    <input id="total_tax_amount<?php echo $x;?>" tabindex="-1" class="form-control text-right valid totalTax" name="total_tax<?php echo $x;?>" value="0.00" readonly="readonly" aria-invalid="false" type="text">
                                             
                                            </div>
                                        </div> 
                                    
                            <?php $x++;}?>

                                    </div>
                                        <div class="form-group row guifooterpanel">
                                            
                                              <div class="col-sm-12"> <label for="date" class="col-sm-5 col-form-label"><?php echo display('total_tax') ?>:</label><div class="col-sm-5">   <input id="total_tax_amount" tabindex="-1" class="form-control text-right valid" name="total_tax" value="0.00" readonly="readonly" aria-invalid="false" type="text">
                                            </div> <a class="col-sm-2 btn btn-primary taxbutton" href="#" data-toggle="collapse" data-target="#taxdetails" aria-expanded="false" aria-controls="taxdetails"><i class="fa fa-angle-double-up"></i></a>
                                        </div> 
                                           
                                            
                                        </div> 
                                        <div class="form-group row guifooterpanel">
                                            <div class="col-sm-12"> <label for="date" class="col-sm-5 col-form-label"><?php echo display('grand_total') ?>:</label><div class="col-sm-5">   <input type="text" id="grandTotal" class="form-control text-right" name="grand_total_price" value="0.00" readonly="readonly" />
                                              <input type="hidden" id="txfieldnum" value="<?php echo count($taxes);?>"></div></div> 
                                            
                                        </div> 
                                         <div class="form-group row guifooterpanel">
                                              <div class="col-sm-12"> <label for="date" class="col-sm-5 col-form-label"><?php echo display('previous'); ?>:</label><div class="col-sm-5">  <input type="text" id="previous" class="form-control text-right" name="previous" value="0.00" readonly="readonly" /></div></div>

                                        </div> 
                                       
                                          <div class="form-group row guifooterpanel">
                                            <div class="col-sm-12"> <label for="date" class="col-sm-5 col-form-label"><?php echo display('change') ?>:</label><div class="col-sm-5">  <input type="text" id="change" class="form-control text-right" name="change" value="" readonly="readonly"/></div></div> 

                                        </div> 
                                        
                                        
                                    </div>
                        </div>




               
                </div>
                          <div class="fixedclasspos">
                            <div class="paymentpart text-center"><span  class="btn btn-warning "><i class="fa fa-angle-double-down"></i></span></div>
                        <div class="bottomarea">
                                 <div class="row">
                                    <div class="col-sm-6">
                                    <div class="col-sm-12">
                                      <input type="button" id="full_paid_tab" class="btn btn-warning btn-lg" value="<?php echo display('full_paid') ?>" tabindex="14" onClick="full_paid()"/>
                                        <input type="submit" id="add_invoice" class="btn btn-success btn-lg" name="add_invoice" value="Save Sale">
                                      <a href="#" class="btn btn-info btn-lg" data-toggle="modal" data-target="#calculator"><i class="fa fa-calculator" aria-hidden="true"></i> </a> 

                                    </div>
                                    </div>
                                    <div class="col-sm-6 text-center">
                                  <div class="col-sm-12">
                                    <label for="net_total" class="col-sm-1 col-form-label"><?php echo display('net_total'); ?>:</label><div class="col-sm-3">  <input type="text" id="n_total" class="form-control text-right guifooterfixedinput" name="n_total" value="0" readonly="readonly" placeholder="" />
                                            <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url(); ?>" id="baseurl"/>
                                            </div>
                                            <label for="date" class="col-sm-1 col-form-label"><?php echo display('paid_ammount') ?>:</label><div class="col-sm-3"> <input type="text" id="paidAmount" 
                                               onkeyup="invoice_paidamount();" class="form-control text-right guifooterfixedinput" name="paid_amount" placeholder="0.00" tabindex="13" autocomplete="off" /></div>                                            
                                        
                                        
                                           <label for="date" class="col-sm-1 col-form-label"><?php echo display('due') ?>:</label><div class="col-sm-3">  <input type="text" id="dueAmmount" class="form-control text-right guifooterfixedinput" name="due_amount" value="0.00" readonly="readonly" /></div>

                                        </div>
                                    </div>
                                 </div>
                            </div>
                    </div>
          
                </div>
                <?php echo form_close() ?>
            </div>
      </div>
      <div class="tab-pane fade" id="saleList">
                     <div class="panel-body">
                        <div class="table-responsive" id="invoic_list">
                            <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo display('sl') ?></th>
                                        <th><?php echo display('invoice_no') ?></th>
                                        <th><?php echo display('invoice_id') ?></th>
                                        <th><?php echo display('customer_name') ?></th>
                                        <th><?php echo display('date') ?></th>
                                        <th><?php echo display('total_amount') ?></th>
                                        <th><?php echo display('action') ?>
                                             <?php echo form_close() ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = '0.00';
                                    $sl = 1;
                                    if ($todays_invoice) {
                                        foreach($todays_invoice as $invoices_list){
                                        ?>
                                  
                                        <tr>
                                            <td><?php echo $sl ; ?></td>
                                            <td>
                                                <a href="<?php echo base_url() . 'Cinvoice/invoice_inserted_data/'.$invoices_list['invoice_id']; ?>">
                                                 
                                                    <?php echo html_escape($invoices_list['invoice']); ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url() . 'Cinvoice/invoice_inserted_data/'.$invoices_list['invoice_id']; ?>">
                                                  <?php echo html_escape($invoices_list['invoice_id'])?>  
                                                </a>
                                            </td>
                                            <td>
                                                <?php echo html_escape($invoices_list['customer_name'])?>        
                                            </td>

                                            <td><?php echo html_escape($invoices_list['date'])?></td>
                                            <td class="text-right"><?php 
                                            if($position == 0){
                                              echo $currency.' '.html_escape($invoices_list['total_amount']);  
                                            }else{
                                            echo html_escape($invoices_list['total_amount']).' '.$currency; 
                                            }
                                            $total += $invoices_list['total_amount']; ?></td>
                                            <td>
                                    <center>
                                        <?php echo form_open() ?>

                                        <a href="<?php echo base_url() . 'Cinvoice/invoice_inserted_data/'.$invoices_list['invoice_id']; ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('invoice') ?>"><i class="fa fa-window-restore" aria-hidden="true"></i></a>

                                        <a href="<?php echo base_url() . 'Cinvoice/pos_invoice_inserted_data/'.$invoices_list['invoice_id']; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('pos_invoice') ?>"><i class="fa fa-fax" aria-hidden="true"></i></a>
                                        <?php if($this->permission1->method('manage_invoice','update')->access()){ ?>

                                        <a href="<?php echo base_url() . 'Cinvoice/invoice_update_form/'.$invoices_list['invoice_id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <?php }?>
                                     <?php if($this->permission1->method('manage_invoice','delete')->access()){ ?>
                                        <a href="" class="deleteInvoice btn btn-danger btn-sm" name="<?php echo $invoices_list['invoice_id']?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                          <?php }?>
                                        <?php echo form_close() ?>
                                    </center>
                                    </td>
                                    </tr>
                                 
                                    <?php
                                $sl++;}
                                }
                                ?>
                                </tbody>
                               
                            </table>
                            
                        </div>
                       
</div>
                   
      </div>
    
     
    </div>
    

            
            
                 
        </div>

    </div>
    </div>
    </div>

    <div class="modal fade modal-success" id="cust_info" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            
                            <a href="#" class="close" data-dismiss="modal">&times;</a>
                            <h3 class="modal-title">Add Customer</h3>
                        </div>
                        
                        <div class="modal-body">
                            <div id="customeMessage" class="alert hide"></div>
                       <?php echo form_open('Cinvoice/instant_customer', array('class' => 'form-vertical', 'id' => 'newcustomer')) ?>
                    <div class="panel-body">

                        <div class="form-group row">
                            <label for="customer_name" class="col-sm-4 col-form-label"><?php echo display('customer_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="customer_name" id="" type="text" placeholder="<?php echo display('customer_name') ?>"  required="" tabindex="1">
                                <input type ="hidden" name="csrf_test_name" id="" value="<?php echo $this->security->get_csrf_hash();?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label"><?php echo display('customer_email') ?></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="email" id="email" type="email" placeholder="<?php echo display('customer_email') ?>" tabindex="2"> 
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile" class="col-sm-4 col-form-label"><?php echo display('customer_mobile') ?></label>
                            <div class="col-sm-6">
                                <input class="form-control allownumericwithdecimal" name ="mobile" id="mobile" type="text" placeholder="<?php echo display('customer_mobile') ?>" min="0" tabindex="3">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address " class="col-sm-4 col-form-label"><?php echo display('customer_address') ?></label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="address" id="address " rows="3" placeholder="<?php echo display('customer_address') ?>" tabindex="4"></textarea>
                            </div>
                        </div>

                       
                    </div>
                    
                        </div>

                        <div class="modal-footer">
                            
                            <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
                            
                            <input type="submit" class="btn btn-success" value="Submit">
                        </div>
                        <?php echo form_close() ?>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->


         <div id="detailsmodal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" class="close" data-dismiss="modal">&times;</a>
                <strong><center> <?php echo display('product_details')?></center></strong>
            </div>
            <div class="modal-body">
           
   <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd">
               
                <div class="panel-body"> 
             <span id="modalimg"></span><br>  
             <h4><?php echo display('product_name')?> :<span id="modal_productname"></span></h4>
            <h4><?php echo display('product_model')?> :<span id="modal_productmodel"></span></h4>
              <h4><?php echo display('price')?> :<span id="modal_productprice"></span></h4>
               <h4><?php echo display('unit')?> :<span id="modal_productunit"></span></h4>
             <h4><?php echo display('stock')?> :<span id="modal_productstock"></span></h4>
            
           

                </div>  
            </div>
        </div>
    </div>
             
    </div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>


         <div class="modal fade" id="printconfirmodal" tabindex="-1" role="dialog" aria-labelledby="printconfirmodal" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
        <a href="" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
            <h4 class="modal-title" id="myModalLabel">Print</h4>
          </div>
          <div class="modal-body">
            <?php echo form_open('Cinvoice/pos_invoice_inserted_data_manual', array('class' => 'form-vertical', 'id' => '', 'name' => '')) ?>
            <div id="outputs" class="hide alert alert-danger"></div>
            <h3> Successfully Inserted </h3>
            <h4>Do You Want to Print ??</h4>
            <input type="hidden" name="invoice_id" id="inv_id">
            <input type="hidden" name="url" value="<?php echo base_url('Cinvoice/gui_pos');?>">
          </div>
          <div class="modal-footer">
            <input type="button" name="" onclick="cancelprint()" class="btn btn-default" data-dismiss="modal" value="No">
            <input type="submit" name="" class="btn btn-primary" id="yes" value="Yes">
            <?php echo form_close() ?>
          </div>
        </div>
      </div>
    </div>
    </section>
</div>

