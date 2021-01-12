 <!-- Add new customer start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('attendance') ?></h1>
            <small><?php echo display('checkout') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('attendance') ?></a></li>
                <li class="active"><?php echo display('checkout') ?></li>
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
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd">
               
                <div class="panel-body">
                 <?php echo  form_open('Cattendance/checkout') ?>

                    <input name="att_id" id="att_id" type="hidden" value="<?php echo $attendata[0]['att_id']?>">
                     <div class="form-group row">
                            <label for="sign_in" class="col-sm-3"><?php echo display('employee')?></label>
                            <div class="col-sm-6">
                                <input name="employee" class=" form-control" type="text"  value="<?php echo html_escape($attendata[0]['first_name']).' '.html_escape($attendata[0]['last_name'])?>" id="employee" readonly="readonly" >
                            </div>
                        </div>
                 
                        <div class="form-group row">
                            <label for="sign_in" class="col-sm-3"><?php echo display('sign_in')?></label>
                            <div class="col-sm-6">
                                <input name="sign_in" class=" form-control" type="text"  value="<?php echo html_escape($attendata[0]['sign_in'])?>" id="sign_in" readonly="readonly" >
                            </div>
                        </div>
                     
                       <div class="form-group row">
                         <label for="sign_in" class="col-sm-3"><?php echo display('sign_out')?><span class="text-danger">*</span></label>
                            <div class="col-sm-6">
                                <input name="sign_out" class="form-control timepicker-12-hr" type="text"  value=""  id="sign_out"  required="">
                            </div>
                        </div>
                      
             
                        <div class="form-group text-center">
                           
                            <button type="submit" class="btn btn-primary"><?php echo display('checkout')?></button>
                        </div>

                    <?php echo form_close() ?>


                </div>  
            </div>
        </div>
    </div>
</section>
</div>