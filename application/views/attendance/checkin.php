<!-- Add new customer start -->


<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('attendance') ?></h1>
            <small><?php echo display('add_attendance') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('attendance') ?></a></li>
                <li class="active"><?php echo display('add_attendance') ?></li>
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
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4><?php echo display('checkin') ?></h4>
                    <div class="form-group text-right">
<a href="<?php echo base_url();?>Cattendance/manage_attendance" class="btn btn-primary"><?php echo display('manage_attendance')?></a>

                    </div>
                </div>
 <div class="panel-body">
                
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel ">
               
                <div class="panel-body">

                    <?php echo  form_open('Cattendance/create_atten') ?>
                        <div class="form-group row">
                            <label for="employee_id" class="col-sm-3 col-form-label"><?php echo display('employee_name') ?><span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                       <?php  if($this->session->userdata('isAdmin')==1){?> 
                              <?php echo form_dropdown('employee_id',$dropdownatn,null,'class="form-control" id="employee_id" required') ?>
                              <?php }else{?> 
                                <input type="text" name="employee_name" class="form-control" value="<?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name');?>" readonly>
                                 <input type="hidden" name="employee_id" id="employee_id" class="form-control" value="<?php echo $this->session->userdata('employee_id');?>">
                               <?php }?>
                            </div>
                        </div> 
                        <div class="form-group row ">
                            <label for="date" class="col-sm-3 col-form-label"><?php echo display('date') ?> <span class="text-danger">*</span></label>
                            <div class="col-sm-9 picker-container">                          
                              
                                 <input type="text" id="date" value="<?php echo  date('Y-m-d');?>" name="date" class="form-control datepicker" required="">
                            </div>
                        </div>
                              <div class="form-group row ">
                            <label for="time" class="col-sm-3 col-form-label"><?php echo display('sign_in') ?> <span class="text-danger">*</span></label>
                            <div class="col-sm-9 picker-container">                          
                              
                                 <input type="text" id="timepicker-12-hr" name="intime" class="form-control timepicker-12-hr" required="">
                            </div>
                        </div>
                                
                        <div class="form-group text-center">
                           
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('check_in') ?></button>
                        </div>
                    <?php echo form_close() ?>

                </div>  
            </div>
        </div>
    </div>

</div>

  </section>
</div>
<!-- Start Modal -->

