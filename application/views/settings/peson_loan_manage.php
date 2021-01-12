<!-- Account List Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('manage_person') ?></h1>
            <small><?php echo display('manage_person') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('personal_loan') ?></a></li>
                <li class="active"><?php echo display('manage_person') ?></li>
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
               
                   <?php if($this->permission1->method('add_person','create')->access()){ ?>    
                   <a href="<?php echo base_url('Csettings/add_person')?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-plus"> </i> <?php echo display('add_person')?> </a>
               <?php }?>

                    <?php if($this->permission1->method('add_loan','create')->access()){ ?>    
                <a href="<?php echo base_url('Csettings/add_loan')?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-plus"> </i> <?php echo display('add_loan')?> </a>
                <?php }?>

                   <?php if($this->permission1->method('add_payment','create')->access()){ ?>
                  <a href="<?php echo base_url('Csettings/add_payment')?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-plus"> </i> <?php echo display('add_payment')?> </a>
                  <?php }?>

               
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('manage_person') ?> </h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo display('name') ?></th>
                                        <th><?php echo display('address') ?></th>
                                        <th><?php echo display('phone') ?></th>
                                        <th><?php echo display('balance') ?></th>
                                        <th><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($person_list) {
                                        ?>
                                        {person_list}
                                        <tr>
                                            <td>
                                                <a href="<?php echo base_url('Csettings/person_loan_deails/{person_id}'); ?>">{person_name}</a>
                                            </td>
                                            <td>{person_address}</td>
                                            <td>{person_phone}</td>
                                            <td><?php echo (($position == 0) ? "$currency {balance}" : "{balance} $currency"); ?></td>
                                            <td>
                                    <center>
                                        <?php echo form_open() ?>
                                        <?php if($this->permission1->method('manage_person','update')->access()){ ?>
                                        <a href="<?php echo base_url('Csettings/person_loan_edit/{person_id}'); ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <?php }?>
                                    <?php if($this->permission1->method('manage_person','delete')->access()){ ?>
                                     <a href="<?php echo base_url("Csettings/delete_personal_loan/{person_id}") ?>" class="btn btn-sm btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> 
                                     <?php }?>
                                        <?php echo form_close() ?>  
                                    </center>
                                    </td>
                                    </tr>
                                    {/person_list}
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right"><?php echo htmlspecialchars_decode($links)?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Account List End -->

