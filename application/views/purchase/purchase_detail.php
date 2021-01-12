<!-- Purchase Payment Ledger Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('purchase') ?></h1>
	        <small><?php echo display('purchase_detail') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('purchase') ?></a></li>
	            <li class="active"><?php echo display('purchase_detail') ?></li>
	        </ol>
	    </div>
	</section>

	<!-- Invoice information -->
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
	    <div class="row">
            <div class="col-sm-12">
               
                    <?php
                    if($this->permission1->method('add_purchase','create')->access()){ ?>
                        <a href="<?php echo base_url('Cpurchase')?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-plus"> </i> <?php echo display('add_purchase')?> </a>
                    <?php
                    } ?>

                    <?php
                    if($this->permission1->method('manage_purchase','read')->access() || $this->permission1->method('manage_purchase','update')->access() || $this->permission1->method('manage_purchase','delete')->access()){ ?>
                        <a href="<?php echo base_url('Cpurchase/manage_purchase')?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo display('manage_purchase')?> </a>
                    <?php
                    }
                    ?>
               
            </div>
        </div>

        <?php
        if( $this->permission1->method('manage_purchase','read')->access()){ ?>

		<!-- Purchase Ledger -->
		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4><?php echo display('purchase_detail') ?></h4>
		                    <div class="text-right"> <button  class="btn btn-info" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></button></div>
		                </div>
		            </div>
		            <div class="panel-body" id="printableArea">
		            	<div>

							<div class="text-center">
				        	{company_info}
				        	<h2> {company_name} </h2> 
				        	{/company_info}
				        	 <?php echo display('manufacturer_name') ?> : &nbsp;<span>{manufacturer_name}</span>  <span><?php echo display('manufacturer_invoice') ?> </span> <br />
				            Date :&nbsp;{final_date} <br /><?php echo display('invoice_no') ?> :&nbsp; {chalan_no}<br> <?php echo display('details') ?> :&nbsp;{purchase_details} 
				            </div>

						</div>
		                <div class="table-responsive">
		                    <table id="" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th><?php echo display('sl') ?></th>
										<th class="text-center"><?php echo display('product_name') ?></th>
										<th class="text-center"><?php echo display('quantity') ?></th>
										<th class="text-center"><?php echo display('purchase_price') ?></th>
										<th class="text-center"><?php echo display('total_ammount') ?></th>
									</tr>
								</thead>
								<tbody>
								<?php
									if ($purchase_all_data) {
								?>
								{purchase_all_data}
									<tr>
										<td>{sl}</td>
										<td>
											<a href="<?php echo base_url().'Cproduct/product_details/{product_id}'; ?>">
											{product_name}-({strength})
											</a>
										</td>
										<td class="text-right">{quantity}</td>
										<td class="text-right"><?php echo (($position==0)?"$currency {rate}":"{rate} $currency") ?></td>
										<td class="text-right"><?php echo (($position==0)?"$currency {total_amount}":"{total_amount} $currency") ?></td>
									</tr>
								{/purchase_all_data}
								<?php
									}
								?>
								</tbody>
								<tfoot>
									<tr>
										<td class="text-right" colspan="4"><b><?php echo display('grand_total') ?>:</b></td>
										<td  class="text-right"><b><?php echo (($position==0)?"$currency {sub_total_amount}":"{sub_total_amount} $currency") ?></b></td>
									</tr>
								</tfoot>
		                    </table>
		                </div>
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
	</section>
</div>
<!-- Purchase ledger End  -->