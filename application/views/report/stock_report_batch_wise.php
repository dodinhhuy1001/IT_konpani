

<!-- Stock List manufacturer Wise Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('stock_report_batch_wise') ?></h1>
	        <small><?php echo display('stock_report_batch_wise') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('stock') ?></a></li>
	            <li class="active"><?php echo display('stock_report_batch_wise') ?></li>
	        </ol>
	    </div>
	</section>

	<section class="content">

		<div class="row">
            <div class="col-sm-12">
               

                    <?php
                    if($this->permission1->method('stock_report','read')->access()){ ?>
                        <a href="<?php echo base_url('Creport')?>" class="btn btn-primary m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('stock_report')?> </a>
                    <?php } ?>
              
            </div>
        </div>

        <?php
        if($this->permission1->method('stock_report_batch_wise','read')->access()){ ?>
	
		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4><?php echo display('stock_report_batch_wise') ?></h4>
		                </div>
		            </div>
		            <div class="panel-body">
						<div id="printableArea">

			                <div class="table-responsive">
			                     <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="batchStock">
			                        <thead>
										<tr>
											<th class="text-center"><?php echo display('sl') ?></th>
											<th class="text-center"><?php echo display('product_name') ?></th>
											<th class="text-center"><?php echo display('strength') ?></th>
											<th class="text-center"><?php echo display('batch_id') ?></th>
											<th class="text-center"><?php echo display('expire_date') ?></th>
											<th class="text-center"><?php echo display('in_qnty') ?></th>
											<th class="text-center"><?php echo display('out_qnty') ?></th>
											<th class="text-center"><?php echo display('stock') ?></th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
									
			                    </table>
			                </div>
			            </div>
		     <input type="hidden" id="currency" value="{currency}" name="">
		            </div>
		        </div>
		    </div>
		</div>
        <?php } ?>
	</section>
</div>
