

<!-- Barcode list start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php if(empty($qr_image)){echo display('barcode');}else{echo display('qr_code');}?></h1>
            <small><?php if(empty($qr_image)){echo display('barcode');}else{echo display('qr_code');}?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('product') ?></a></li>
                <li class="active"><?php if(empty($qr_image)){echo display('barcode');}else{echo display('qr_code');}?></li>
            </ol>
        </div>
    </section>

    <section class="content">
        <!-- Product Barcode and QR code -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php if(empty($qr_image)){echo display('barcode');}else{echo display('qr_code');}?> </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('Cproduct/insert_product')?>
                    <div class="panel-body">

                
                        <div class="table-responsive">
                            <?php
							if (isset($product_id)) {
							?>
								<div id="printableArea">
								
									     <table  id="" class="table-bordered">
                                       	<?php
									$counter = 0;
									for ($i=0; $i < 18 ; $i++) { 
									?>
									<?php if($counter == 3) { ?>
									<tr> 
									<?php $counter = 0; ?>
									<?php } ?>
                                                <td class="barcode-toptd">      

                                                    <div class="barcode-inner barcode-innerdiv">
                                                        <div class="product-name barcode-productname">
                                                            {company_name}
                                                        </div>
                                                        <span class="model-name barcode-modelname">{strength}</span>
                                                        <img src="<?php echo base_url('Cbarcode/barcode_generator/{product_id}') ?>" class="img-responsive center-block barcode-image" alt="" >
                                                        <div class="product-name-details barcode-productdetails">{product_name}</div>
                                                        <div class="price barcode-price"><?php echo (($position == 0) ? "$currency {price}" : "{price} $currency") ?> <small class="barcode-vat"><?php echo display('incl_vat') ?>. 

                                                        </div>
                                                    </div>

                                                </td>
                                              	<?php if($counter == 3) { ?>
											</tr> 
											<?php $counter = 0; ?>
										<?php } ?>
										<?php $counter++; ?>
									<?php
									}
									?>
                                    </table>
								</div>
							<?php
							}else{
							?>
							<div id="printableArea">
								<table class="table table-bordered">
								<?php
								$counter = 0;
								for ($i=0; $i < 9 ; $i++) { 
								?>
								<?php if($counter == 3) { ?>
								<tr> 
								<?php $counter = 0; ?>
								<?php } ?>
									        <td class="barcode-toptd">  
                                                    <div class="barcode-inner barcode-innerdiv">
                                                        <div class="product-name barcode-productname">
                                                            {company_name}
                                                        </div>
                                                        <span class="model-name barcode-modelname">{strength}</span>
                                                        <img src="<?php echo base_url('my-assets/image/qr/{qr_image}') ?>" class="img-responsive center-block qrcode-image" alt="">
                                                        <div class="product-name-details qrcode-productdetails">{product_name}</div>
                                                        <div class="price barcode-price"><?php echo (($position == 0) ? "$currency {price}" : "{price} $currency") ?> <small class="barcode-vat"><?php echo display('incl_vat') ?></small>
                                                        </div>
                                                    </div>
                                                </td>
									<?php if($counter == 3) { ?>
										</tr> 
										<?php $counter = 0; ?>
									<?php } ?>
									<?php $counter++; ?>
								<?php
								}
								?>
								</table>
							</div>
							<?php
							}
							?>
                        </div>
                                <?php
                        if ( !empty($product_id) || !empty($qr_image)) {
                        ?>
                            <div class="text-center">
                                <a  class="btn btn-info" href="#" onclick="printDiv('printableArea')"><?php echo display('print')?></a>
                                <a  class="btn btn-danger" href="<?php echo base_url('Cproduct');?>"><?php echo display('cancel')?></a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Barcode list End -->