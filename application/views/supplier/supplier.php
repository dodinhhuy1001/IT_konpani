<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('supplier') ?></h1>
	        <small><?php echo display('manage').' '.display('supplier') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('supplier') ?></a></li>
	            <li class="active"><?php echo display('manage').' '.display('supplier') ?></li>
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
                    if($this->permission1->method('manage_supplier','create')->access()) { ?>
                        <a href="<?php echo base_url('Csupplier')?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-plus"> </i> <?php echo display('add_supplier')?> </a>
                    <?php } ?>

                    <?php
                    if($this->permission1->method('supplier_ledger','read')->access()) { ?>
                        <a href="<?php echo base_url('Csupplier/supplier_ledger_report')?>" class="btn btn-primary m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('supplier_ledger')?> </a>
                    <?php } ?>
            
            </div>
        </div>

        <?php
        if($this->permission1->method('manage_supplier','read')->access()){ ?>
            <!-- Manage supplier -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4><?php echo display('manage').' '.display('supplier') ?></h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="dataTableExample4" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th><?php echo display('supplier_id') ?></th>
                                        <th><?php echo display('supplier_name') ?></th>
                                        <th><?php echo display('address') ?></th>
                                        <th><?php echo display('mobile') ?></th>
                                        <th><?php echo display('details') ?></th>
                                        <?php
                                        if($this->permission1->method('manage_supplier','update')->access() || $this->permission1->method('manage_supplier','delete')->access()) { ?>
                                            <th><?php echo display('action') ?></th>
                                        <?php } ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ($suppliers_list) {
                                        ?>
                                        {suppliers_list}
                                        <tr>
                                            <td>{supplier_id}</td>
                                            <td>
                                                <a href="<?php echo base_url() . 'Csupplier/supplier_ledger_info/{supplier_id}'; ?>">
                                                    {supplier_name}
                                                </a>
                                            </td>
                                            <td>{address}</td>
                                            <td>{mobile}</td>
                                            <td>{details}</td>
                                            <?php
                                            if($this->permission1->method('manage_supplier','update')->access() || $this->permission1->method('manage_supplier','delete')->access()) { ?>
                                                <td>
                                                    <center>
                                                        <?php
                                                        if($this->permission1->method('manage_supplier','update')->access()) { ?>
                                                            <a href="<?php echo base_url() . 'Csupplier/supplier_update_form/{supplier_id}'; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                        <?php } ?>

                                                        <?php
                                                        if($this->permission1->method('manage_supplier','delete')->access()) { ?>
                                                            <a onclick="return confirm('Are you Sure ?')" href="<?php echo base_url() . 'Csupplier/supplier_delete/{supplier_id}'; ?>" class="btn btn-danger btn-sm"  data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                    </center>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                        {/suppliers_list}
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <div class="text-right"><?php echo htmlspecialchars_decode($links)?></div>
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
