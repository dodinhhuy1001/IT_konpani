
<div class="content-wrapper">
       <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('manage_manufacturer') ?></h1>
            <small><?php echo display('manage_your_manufacturer') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('manufacturer') ?></a></li>
                <li class="active"><?php echo display('manage_manufacturer') ?></li>
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
               
                    <a href="<?php echo base_url('Cmanufacturer') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-plus"> </i> <?php echo display('add_manufacturer') ?> </a>

                    <a href="<?php echo base_url('Cmanufacturer/manufacturer_ledger_report') ?>" class="btn btn-primary m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('manufacturer_ledger') ?> </a>
                
            </div>
        </div>
        <!-- Manage Product report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('manage_manufacturer'); ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" cellspacing="0"  id="manufacturerList"> 
                          <thead>
                              <tr>
                                  <th><?php echo display('manufacturer_name') ?></th>
                                  <th><?php echo display('address') ?></th>
                                  <th><?php echo display('mobile') ?></th>
                                  <th><?php echo display('phone'); ?></th>
                                  <th><?php echo display('email'); ?></th>
                                  <th><?php echo display('city'); ?></th>
                                  <th><?php echo display('country'); ?></th>
                                  <th width="150px"><?php echo display('balance'); ?></th>
                                  <th><?php echo display('action'); ?> 
                                  </th>
                              </tr>
                          </thead>
                                <tbody>
                                  
                                </tbody>
                                 <tfoot>
                                            <tr>
                <th colspan="7" class="text-right"><?php echo display('total'); ?>:</th>
                <th id="stockqty"></th>
                  <th></th> 
            </tr>
                                            
                                        </tfoot> 
                            </table>
                          
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="total_manufacturer" value="<?php echo html_escape($total_manufacturer);?>" name="">
            <input type="hidden" id="currency" value="{currency}" name="">
        </div>
    </section>
</div>
