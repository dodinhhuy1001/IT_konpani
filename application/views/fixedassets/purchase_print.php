<?php
$CI = & get_instance();
$CI->load->model('Web_settings');
$Web_settings = $CI->Web_settings->retrieve_setting_editdata();
?>

<!-- Printable area end -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('fixed_assets_purchase_details') ?></h1>
            <small><?php echo display('fixed_assets_purchase_details') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('purchase') ?></a></li>
                <li class="active"><?php echo display('fixed_assets_purchase_details') ?></li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
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
                <div class="panel panel-bd">
                    <div id="printableArea">
                        <div class="panel-body">
                           <div class="row">
                                {company_info}
                                <div class="col-sm-8 purchasedetails-address">
                                     <img src="<?php if (isset($Web_settings[0]['invoice_logo'])) {echo $Web_settings[0]['invoice_logo']; }?>" class="marginbottom20" alt="">
                                    <br>
                                    <span class="label label-success-outline m-r-15 p-10" ><?php echo display('billing_from') ?></span>
                                    <address class="margin-top10">
                                        <strong>{company_name}</strong><br>
                                        {address}<br>
                                        <abbr><b><?php echo display('mobile') ?>:</b></abbr> {mobile}<br>
                                        <abbr><b><?php echo display('email') ?>:</b></abbr>
                                        {email}<br>
                                        <abbr><b><?php echo display('website') ?>:</b></abbr>
                                        {website}
                                        {/company_info}<br>
                                      
                                    </address>
                                </div>
                                
                                
                                <div class="col-sm-4 text-left invoice-address">
                                    <h2 class="m-t-0"><?php echo display('purchase') ?></h2>
                                   
                                     <div><?php echo display('purchase_id') ?>: <?php echo html_escape($purchase_id);?></div>
                                    <div class="m-b-15"><?php echo display('billing_date') ?>: <?php echo html_escape($final_date);?></div>

                                    <span class="label label-success-outline m-r-15"><?php echo display('billing_to') ?></span>

                                      <address class="customer_name_p">
                                        <strong><?php echo html_escape($supplier_name)?> </strong>
                                        <br>
                                        <abbr><b><?php echo display('mobile') ?>:</b></abbr>
                                        <?php if ($supplier_mobile) { ?>
                                       
                                        <?php echo html_escape($supplier_mobile);}
                                        ?>
                                       
                                    </address>
                                </div>
                            </div> <hr>
                           
                              

                                             <table width="100%" class="table-striped" >
                                                <thead >
                                    <tr class="tbodydata">
                                        <td><?php echo display('sl'); ?></td>
                                        <td><?php echo display('item_name'); ?></td>
                                        <td></td>
                                        <td align="right"><?php echo display('quantity'); ?></td>
                                        
                                        <td align="right"><?php echo display('rate'); ?></td>
                                        <td align="right"><?php echo display('ammount'); ?></td>
                                    </tr>
                                </thead>
                               <tbody>
                                <?php
                                    if ($purchase_all_data) {
                                ?>
                                    {purchase_all_data}
                                    <tr>
                                        <td align="left"><nobr>{sl}</nobr></td>
                                    <td align="left"><nobr>{item_name}</nobr></td>
                                      <td></td>
                                    <td align="right"><nobr>{qty}</nobr></td>
                                
                                    <td align="right">
                                    <nobr>
                                       <?php echo (($position==0)?"$currency {price}":"{price} $currency") ?>
                                    </nobr>
                                    </td>

                                    <td align="right">
                                    <nobr>
                                       <?php echo (($position==0)?"$currency {total_amount}":"{total_amount} $currency") ?>
                                    </nobr>
                                    </td>
                                    </tr>
                                 {/purchase_all_data}
                             <?php }?>
                                </tbody>
                          <tfoot>
                                    <tr>
                                        <td colspan="6" class="print-footer"><nobr></nobr></td>
                                    </tr>

                                    <tr>
                                        <td colspan="6" class="print-footer"><nobr></nobr></td>
                                    </tr>
                                     <tr>
                                        <td align="left"><nobr></nobr></td>
                                    <td align="right" colspan="4"><nobr><?php echo display('total') ?></nobr></td>
                                    <td align="right">
                                    <nobr>
                                       <?php echo (($position==0)?"$currency {ptotal_amount}":"{ptotal_amount} $currency") ?>
                                    </nobr>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="print-footer"><nobr></nobr></td>
                                    </tr>
                                    <tr>
                                        <td align="left"><nobr></nobr></td>
                                    <td colspan="3"><nobr><span align="right"><?php echo display('in_word').' : ' ?>{am_inword}</span> <?php echo display('taka_only')?></td><td align="right"><strong><?php echo display('grand_total')?></strong></nobr></td>
                                    <td align="right"><nobr>
                                        <strong>
                                            <?php echo (($position == 0) ? "$currency {sub_total_amount}" : "{sub_total_amount} $currency")
                                             ?>
                                        </strong></nobr></td>
                                    </tr>
                                </tfoot>
                                </table>
                               
                               
                                </div>


                        </div>
                    </div>
                        <div class="panel-footer text-left">
                        <a  class="btn btn-danger" href="<?php echo base_url('Cpurchase/manage_purchase'); ?>"><?php echo display('cancel') ?></a>
                        <a  class="btn btn-info" href="#" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></a>
                   
                    </div>

  </div>                     
</div> <!-- /.content-wrapper -->
</div>
</section>
</div>