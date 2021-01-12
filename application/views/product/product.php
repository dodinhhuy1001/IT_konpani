<script src="<?php echo base_url()?>my-assets/js/admin_js/json/product_invoice.js.php" ></script>
<script src="<?php echo base_url()?>my-assets/js/admin_js/invoice.js" type="text/javascript"></script>
<!-- Manage Product Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('manage_product') ?></h1>
	        <small><?php echo display('manage_your_product') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('product') ?></a></li>
	            <li class="active"><?php echo display('manage_product') ?></li>
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
                    if($this->permission1->method('add_medicine','create')->access()) { ?>
                        <a href="<?php echo base_url('Cproduct')?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-plus"> </i><?php echo display('add_product')?></a>
                    <?php } ?>

                    <?php
                    if($this->permission1->method('import_medicine_csv','create')->access()) { ?>
                        <a href="<?php echo base_url('Cproduct/add_product_csv')?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-plus"> </i><?php echo display('import_product_csv')?></a>
                    <?php } ?>

                </div>
           
        </div>
        <?php
        if($this->permission1->method('manage_medicine','read')->access() || $this->permission1->method('manage_medicine','update')->access() || $this->permission1->method('manage_medicine','delete')->access()) { ?>
           
		<!-- Manage Product report -->
		   <div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4><?php echo display('manage_product') ?></h4>
		                    <p  class="text-right"><a href="<?php echo base_url().'Cproduct/exportCSV'; ?>" class="btn btn-success"><?php echo display('export_csv')?></a></p>
		                </div>
		            </div>
		            <div class="panel-body">
		                <div class="table-responsive">
		                     <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="productList">
		                        <thead>
									<tr>
										<th><?php echo display('sl') ?></th>
										<th><?php echo display('product_name') ?></th>
										<th><?php echo display('generic_name') ?></th>
										<th><?php echo display('category') ?></th>
										<th><?php echo display('manufacturer') ?></th>
										<th><?php echo display('shelf') ?></th>
										<th><?php echo display('sell_price') ?></th>
									    <th><?php echo display('purchase_price') ?></th>
										<th><?php echo display('strength') ?></th>
										<th><?php echo display('image') ?>s</th>
										<th width="130px"><?php echo display('action') ?></th>
									</tr>
								</thead>
								<tbody>
					
								</tbody>
		                    </table>
		                  
		                  </div>
		              </div>
		          </div>
		            <input type="hidden" id="total_product" value="<?php echo html_escape($total_product);?>" name="">
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
