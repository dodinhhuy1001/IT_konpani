<!-- Add new manufacturer start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('manufacturer') ?></h1>
            <small><?php echo display('manufacturer_advance') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('manufacturer') ?></a></li>
                <li class="active"><?php echo display('manufacturer_advance') ?></li>
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



        <!--  manufacturer Advance-->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('manufacturer_advance') ?> </h4>
                        </div>
                    </div>
                    <?php echo form_open('Cmanufacturer/insert_manufacturer_advance', array('class' => 'form-vertical', 'id' => 'insert_manufacturer_adavance')) ?>
                    <div class="panel-body">

                        <div class="form-group row">
                            <label for="manufacturer_name" class="col-sm-3 col-form-label"><?php echo display('manufacturer_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                            <select name="manufacturer_id" class="form-control"  required="">
                            <option value="">Select manufacturer</option>
                                <?php foreach($manufacturer_list as $manufacturers){?>
                            <option value="<?php echo html_escape($manufacturers['manufacturer_id'])?>"><?php echo html_escape($manufacturers['manufacturer_name'])?></option>
                                <?php }?>   
                            </select>
                            </div>
                        </div>

                       	<div class="form-group row">
                            <label for="advance_type" class="col-sm-3 col-form-label"><?php echo display('advance_type') ?><i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                               <select name="type" class="form-control" required="">
                                   <option value=""> Select Type</option>
                                   <option value="1"> Payment </option>
                                   <option value="2"> Receive</option>
                               </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="amount" class="col-sm-3 col-form-label"><?php echo display('amount') ?><i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="amount" id="amount" type="text" placeholder="<?php echo display('amount') ?>" required min="0" tabindex="3">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" id="add-advance" class="btn btn-primary btn-large" name="add-advance" value="<?php echo display('save') ?>" />
                              
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
 
    </section>
</div>
<!--  manufacturer advance end -->



