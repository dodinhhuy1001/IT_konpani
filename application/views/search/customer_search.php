
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('customer_search') ?></h1>
	        <small><?php echo display('customer_search') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('search') ?></a></li>
	            <li class="active"><?php echo display('customer_search') ?></li>
	        </ol>
	    </div>
	</section>
	<section class="content">
		<div class="row">
            <div class="col-sm-12">
               
                    <?php
                    if($this->permission1->method('manage_medicine','read')->access()){ ?>
                        <a href="<?php echo base_url('Csearch/medicine')?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo display('medicine_search')?></a>
                    <?php } ?>
                    <?php
                    if( $this->permission1->method('manage_invoice','read')->access()){ ?>
                        <a href="<?php echo base_url('Csearch/invoice')?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo display('invoice_search')?></a>
                    <?php } ?>
                    <?php
                    if($this->permission1->method('manage_purchase','read')->access() ){ ?>
                        <a href="<?php echo base_url('Csearch/purchase')?>" class="btn btn-primary m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo display('purchase_search')?></a>
                    <?php } ?>
               
            </div>
        </div>


        <?php
        if($this->permission1->method('manage_customer','read')->access()){ ?>
		<!-- Manage Product report -->
		<div class="row">
			<div class="col-sm-12">
		        <div class="panel panel-default">
		            <div class="panel-body">
						<?php echo form_open('Csearch/customer_search',array('class' => 'form-inline', 'id' => 'validate'));?>
							<?php date_default_timezone_set("Asia/Dhaka"); $today = date('Y-m-d'); ?>
							<label class="select"><?php echo display('search') ?>:</label>
							<input type="text" name="what_you_search" class="form-control" placeholder='<?php echo display('what_you_search') ?>' id="what_you_search" required>
							<button type="submit" class="btn btn-primary"><?php echo display('search') ?></button>
			            <?php echo form_close()?>
		            </div>
		        </div>
		    </div>
	    </div>

		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4><?php echo display('customer_search') ?></h4>
		                </div>
		            </div>
		            <div class="panel-body">
						<div id="printableArea">
			                <div class="table-responsive">
			                    <table class="table table-bordered table-striped table-hover medicine_search">
			                        <thead>
										<tr>
											<th class="text-center"><?php echo display('sl') ?></th>
											<th class="text-center"><?php echo display('customer_name') ?></th>
											<th class="text-center"><?php echo display('customer_address') ?></th>
											<th class="text-center"><?php echo display('customer_mobile') ?></th>
											<th class="text-center"><?php echo display('customer_email') ?></th>
                                        
										</tr>
									</thead>
									<tbody>
									<?php
										if ($search_result != null) {
									?>
										{search_result}
										<tr>
											<td>{sl}</td>
											<td>{customer_name}</td>
											<td>{customer_address}</td>
											<td>{customer_mobile}</td>
											<td>{customer_email}</td>
                                            
										</tr>
										{/search_result}
									<?php
										}else{
									?>
                                <tr>
                                	<td colspan="5"><center> No Result Found</center></td>
                                </tr>
								<?php }?>
									</tbody>
			                    </table>
			                </div>
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
