<div class="content-wrapper">
   <section class="content-header">
    <div class="header-icon">
        <i class="pe-7s-note2"></i>
    </div>
    <div class="header-title">
        <h1><?php echo display('user_assign_role')?></h1>
        <small><?php echo display('user_assign_role')?></small>
        <ol class="breadcrumb">
            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
            <li class="active"><?php echo display('user_assign_role')?></li>
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

        <?php
        if($this->permission1->method('user_assign_role','create')->access() || $this->permission1->method('user_assign_role','read')->access()){ ?>
         <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4> <?php echo display('user_assign_role')?> </h4>
                    </div>
                </div>
                <div class="panel-body">
                    <?php echo form_open("Permission/usercreate") ?>
                    <div class="form-group row">
                        <label for="blood" class="col-sm-3 col-form-label">
                        <?php echo display('user') ?> <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <select class="form-control" required="" name="user_id" id="user_type" onchange="userRole(this.value)">
                                <option value=""><?php echo display('select_one') ?></option>
                                <?php
                                foreach($user as $udata){
                                    ?>
                                    <option value="<?php echo $udata['user_id'] ?>"><?php echo html_escape($udata['first_name']).' '.html_escape($udata['last_name']) ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                     </div>

                    <div class="form-group row">
                        <label for="blood" class="col-sm-3 col-form-label">
                            <?php echo display('role_name'); ?> <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <select class="form-control" required="" name="user_type" id="user_type">
                                <option value=""><?php echo display('select_one') ?></option>
                                <?php
                                foreach($user_list as $data){
                                    ?>
                                    <option value="<?php echo html_escape($data['id']) ?>"><?php echo html_escape($data['type']) ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 roleborder">
                        <h3><?php echo display('exsisting_role') ?></h3>
                        <div id="existrole">

                        </div>
                    </div>
                    <?php
                    if($this->permission1->method('user_assign_role','create')->access()){ ?>
                        <div class="form-group text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                        </div>
                    <?php } ?>
                    <?php echo form_close() ?>
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
        }?>

    </section>
</div>

