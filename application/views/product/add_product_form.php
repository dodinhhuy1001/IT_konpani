
<script src="<?php echo base_url()?>my-assets/js/admin_js/json/product.js" type="text/javascript"></script>
<!-- Add Product Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('new_product') ?></h1>
            <small><?php echo display('add_new_product') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('product') ?></a></li>
                <li class="active"><?php echo display('new_product') ?></li>
            </ol>
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
        <div class="row">
            <div class="col-sm-12">
                
                    <?php
                    if($this->permission1->method('import_medicine_csv','create')->access()) { ?>
                     <a href="<?php echo base_url('Cproduct/add_product_csv')?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-plus"> </i> <?php echo display('add_product_csv')?></a>
                    <?php } ?>

                    <?php
                    if($this->permission1->method('manage_medicine','read')->access()) { ?>
                     <a href="<?php echo base_url('Cproduct/manage_product')?>" class="btn btn-primary m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('manage_product')?></a>
                    <?php } ?>
              
            </div>
        </div>

     <?php
     if($this->permission1->method('add_medicine','create')->access()) { ?>
        <!-- Add Product -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('new_product') ?></h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('Cproduct/insert_product',array('class' => 'form-vertical', 'id' => 'insert_product','name' => 'insert_product'))?>
                    <div class="panel-body">
                         <div class="row">
                         <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="barcode_or_qrcode" class="col-sm-4 col-form-label"><?php echo display('barcode_or_qrcode') ?> <i class="text-danger"></i></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="product_id" type="text" id="product_id" placeholder="<?php echo display('barcode_or_qrcode') ?>"  tabindex="1" >
                                    </div>
                                </div>
                                
                            </div>
                              <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="product_name" class="col-sm-4 col-form-label"><?php echo display('product_name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" tabindex="1" name="product_name" type="text" id="product_name" placeholder="<?php echo display('product_name') ?>" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                           <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="strength" class="col-sm-4 col-form-label"><?php echo display('strength') ?> <i class="text-danger"></i></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" tabindex="1" name="strength" type="text" id="strength" placeholder="<?php echo display('strength') ?>" >
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="generic_name" class="col-sm-4 col-form-label"><?php echo display('generic_name') ?>  <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="generic_name" type="text" id="generic_name" placeholder="<?php echo display('generic_name') ?>" tabindex="2" required="required">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="box_size" class="col-sm-4 col-form-label"><?php echo display('box_size') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="box_size" type="text" id="box_size" placeholder="<?php echo display('box_size') ?>" tabindex="3" min="0" required="required">
                                    </div>
                                </div>
                            </div>
                           <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="unit" class="col-sm-4 col-form-label"><?php echo display('unit') ?>  <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="unit" name="unit" required="required" tabindex="4">
                                            <option value="">Select Unit</option>
                                             <?php
                                            if ($unit_list) {
                                        ?>
                                        {unit_list}
                                            <option value="{unit_name}">{unit_name}</option>
                                        {/unit_list}
                                        <?php
                                            }
                                        ?>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="product_location" class="col-sm-4 col-form-label"><?php echo display('product_location') ?></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" tabindex="5" name="product_location" type="text" id="product_location" placeholder="<?php echo display('product_location') ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="description" class="col-sm-4 col-form-label"><?php echo display('details') ?></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="description" id="description" rows="3" tabindex="6" placeholder="<?php echo display('details') ?>"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row"><div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="product_model" class="col-sm-4 col-form-label"><?php echo display('model') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="category_id" name="type_name" required="required" tabindex="7">
                                        <option value=""><?php echo display('select_one') ?></option>
                                        <?php
                                            if ($type_list) {
                                        ?>
                                        {type_list}
                                            <option value="{type_name}">{type_name}</option>
                                        {/type_list}
                                        <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                         <div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="image" class="col-sm-4 col-form-label"><?php echo display('image') ?> </label>
                                    <div class="col-sm-8">
                                        <input type="file" tabindex="8" name="image" class="form-control" id="image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-4 col-form-label"><?php echo display('category') ?></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="category_id" name="category_id" tabindex="9">
                                        <option value=""><?php echo display('select_one') ?></option>
                                        <?php
                                            if ($category_list) {
                                        ?>
                                        {category_list}
                                            <option value="{category_id}">{category_name}</option>
                                        {/category_list}
                                        <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="image" class="col-sm-4 col-form-label"><?php echo display('sell_price') ?> <i class="text-danger">*</i> </label>
                                    <div class="col-sm-8">
                                         <input class="form-control text-right" name="price" type="text" onkeyup="Checkprice()" required="required" id="price" placeholder="0.00" tabindex="10" min="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                

                         <div class="row">
                             <?php 
$i=0;
foreach ($taxfield as $taxss) {?>
                            <div class="col-sm-6">
                         <div class="form-group row">
                            <label for="tax" class="col-sm-4 col-form-label"><?php echo $taxss['tax_name']; ?> <i class="text-danger"></i></label>
                            <div class="col-sm-7">
                              <input type="text" name="tax<?php echo $i;?>" class="form-control" value="<?php echo number_format($taxss['default_value'], 2, '.', ',');?>">
                            </div>
                            <div class="col-sm-1"> <i class="text-success">%</i></div>
                        </div>
                    </div>
                    <?php $i++;}

?>
                </div>
                       

                         <div class="row" id="manufacturer_info">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="manufacturer" class="col-sm-4 col-form-label"><?php echo display('manufacturer') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <select name="manufacturer_id" class="form-control" required="required" tabindex="12" id="">
                                            <option value=""><?php echo display('select_manufacturer') ?> </option>
                                            <?php
                                            $manufacturer_id = $this->session->userdata('manufacturer_id');
                                            if ($manufacturer){
                                                foreach ($manufacturer as $manufac) {
                                            ?>
                                            <option value="<?php echo $manufac['manufacturer_id']?>" <?php if ($manufacturer_id == $manufac['manufacturer_id']){echo "selected";} ?>><?php echo $manufac['manufacturer_name']?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <a data-target="#manufac_modal" data-toggle="modal"><i class="fa fa-plus"></i><?php echo display('add_new_manufacturer') ?></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                               <div class="form-group row">

                                    <label for="manufacturer_price" class="col-sm-4 col-form-label"><?php echo display('manufacturer_price') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" tabindex="13"  onkeyup="ProfitPrice(),checkmprice()" class="form-control text-right"   name="manufacturer_price" placeholder="0.00"  required="required"  min="0" id="mprice"/>
                                        <span id="prft"></span>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">

                                <input type="submit" id="add-product" class="btn btn-primary btn-large" name="add-product" value="<?php echo display('save') ?>" tabindex="14"/>
                                <input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-product-another" class="btn btn-large btn-success" id="add-product-another" tabindex="15">
                            </div>
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


</div>
<!-- Add Product End -->
  <div id="manufac_modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <center><strong></i><?php echo display('add_new_manufacturer') ?></strong></center>
                </div>
                <div class="modal-body">
                   <div id="manufacturerErr" class="alert hide"></div>
                   <div id="manufacturer_mess" class="alert hide"></div>
                      <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('add_manufacturer') ?> </h4>
                        </div>
                    </div>
                   <?php echo form_open_multipart('Cmanufacturer/new_manufacturer',array( 'id' => 'manufacturerform'))?>
                    <div class="panel-body">

                        <div class="form-group row">
                            <label for="manufacturer_name" class="col-sm-3 col-form-label"><?php echo display('manufacturer_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="manufacturer_name" id="manufacturer_name" type="text" placeholder="<?php echo display('manufacturer_name') ?>"  required="required" tabindex="1">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile" class="col-sm-3 col-form-label"><?php echo display('manufacturer_mobile') ?> <i class="text-danger"></i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name="mobile" id="mobile" type="text" placeholder="<?php echo display('manufacturer_mobile') ?>"  min="0" tabindex="2">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address " class="col-sm-3 col-form-label"><?php echo display('manufacturer_address') ?></label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="address" id="address " rows="3" placeholder="<?php echo display('manufacturer_address') ?>" tabindex="3"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="details" class="col-sm-3 col-form-label"><?php echo display('manufacturer_details') ?></label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="details" id="details" rows="3" placeholder="<?php echo display('manufacturer_details') ?>" tabindex="4"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" id="add-manufacturer" class="btn btn-primary btn-large" name="add-manufacturer" value="<?php echo display('save') ?>" tabindex="6"/>

                            </div>
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>

                </div>

            </div>
        </div>

    </div>



