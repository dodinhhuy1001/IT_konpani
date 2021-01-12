<!-- Stock List Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('out_of_stock') ?></h1>
	        <small><?php echo display('out_of_stock') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('stock') ?></a></li>
	            <li class="active"><?php echo display('out_of_stock') ?></li>
	        </ol>
	    </div>
	</section>

	<section class="content">


		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4><?php echo display('out_of_stock') ?></h4>
		                </div>
		            </div>
		            <div class="panel-body">
		                <div class="table-responsive">
		                    <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="outof_stock">
		                        <thead>
									<tr>
										<th class="text-center"><?php echo display('sl') ?></th>
										<th class="text-center"><?php echo display('product_name') ?></th>
											<th class="text-center"><?php echo display('manufacturer_name') ?></th>
	
										<th class="text-center"><?php echo display('generic_name') ?></th>
	
										<th class="text-center"><?php echo display('stock') ?></th>
									</tr>
								</thead>
								<tbody>
								
								</tbody>
		                    </table>
		                </div>
			            
		                <div class="text-center">
		                	
		                </div>
		                <input type="hidden" name="" id="total_out_of_stock" value="<?php echo html_escape($totalnumber);?>">
		            </div>
		        </div>
		    </div>
		</div>
	</section>
</div>
