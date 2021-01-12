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
                    <div class="form-group text-right">

<a href="<?php echo base_url();?>Cattendance/single_checkin" class="btn btn-primary"><?php echo display('single_checkin')?></a>

<button type="button" class="btn btn-primary btn-md" data-target="#add1" data-toggle="modal"  >
<i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo display('bulk_checkin')?></button> 



<a href="<?php echo base_url();?>Cattendance/manage_attendance" class="btn btn-primary"><?php echo display('manage_attendance')?></a>
                    </div>
                </div>
                <div class="panel-body">
                


 <!-- signout modal end -->         
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 

            <div class="panel-body">
               
  <table width="100%" class="datatable table table-striped table-bordered table-hover example">
                <caption><?php echo display('attendance_list')?></caption>
                <thead>
                    <tr>
                      <th><?php echo display('Sl') ?></th>
                        <th><?php echo display('name')?></th>
                        <th><?php echo display('date')?></th>
                        <th><?php echo display('checkin')?></th>
                        <th><?php echo display('checkout')?></th>
                        <th><?php echo display('stay')?></th>
                         <th><?php echo display('action')?></th>
                         
                    </tr>
                </thead>
                <tbody>

                        <?php if($att_list){
                           $sl = 1; 
                         foreach ($att_list as $row){?>
                            <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                            <td><?php echo $sl; ?></td>
                                <td><?php echo html_escape($row['first_name']).' '.html_escape($row['last_name']); ?></td>
                                <td><?php echo html_escape($row['date']); ?></td>
                                <td><?php echo html_escape($row['sign_in']); ?></td>
                                <td><?php echo html_escape($row['sign_out']); ?></td>
                                <td><?php echo html_escape($row['staytime']); ?></td>
                                
                                <td> 
                                <?php if($row['staytime']==''){
                                    $id=$row["att_id"];
                                    ?>
                                   <a href='<?php echo base_url("Cattendance/checkout/".$id)?>' class='btn btn-success'><i class='fa fa-clock-o' aria-hidden='true'></i> <?php echo display('checkout') ?></a>
                                  <?php  }else{
                                        echo display('checked_out');
                                    }

                                        ?> 

                                </td>
                               
                            </tr>
                              
                        <?php $sl++;}} ?>
                           
                   
                </tbody>
            </table>


                <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>

<div id="add1" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('add_attendance')?></strong>
            </div>
            <div class="modal-body">
        <div class="panel">
                    <div class="panel-heading">
                        
                            <div><a href="<?php echo base_url('assets/data/csv/attendance_csv_sample.csv') ?>" class="btn btn-primary pull-right"><i class="fa fa-download"></i><?php echo display('download_sample_file')?> </a> </div>
                       
                    </div>
                    
                    <div class="panel-body">
                       
                      <?php echo form_open_multipart('Cattendance/attendance_bulkupload',array('class' => 'form-vertical', 'id' => 'validate','name' => 'insert_attendance'))?>
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="upload_csv_file" class="col-sm-4 col-form-label"><?php echo display('upload_csv_file') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="upload_csv_file" type="file" id="upload_csv_file" placeholder="<?php echo display('upload_csv_file') ?>" required>
                                    </div>
                                </div>
                            </div>
                        
                       <div class="col-sm-12">
                        <div class="form-group row">
                            <div class="col-sm-12 text-right">
                                <input type="submit" id="add-product" class="btn btn-primary btn-large" name="add-product" value="<?php echo display('submit') ?>" />
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                               
                            </div>
                        </div>
                        </div>
                          <?php echo form_close()?>
                    </div>
                    </div>   

    </div>

</div>
</div>
</div>
  </section>
</div>
