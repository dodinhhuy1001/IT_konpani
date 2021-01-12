<?php
$CI =& get_instance();
$CI->load->model('Web_settings');
$Web_settings = $CI->Web_settings->retrieve_setting_editdata();
?>

<script src="<?php echo base_url() ?>my-assets/js/admin_js/invoice_onloadprint.js" type="text/javascript"></script>
<style>
    @media print {
  #printPageButton {
    display: none;
  }
   #main-footer {
    display: none;
  }
  #content-header{
       display: none;
  }
  #pre-ldr{
    display: none;  
  }
  
  #main-heades{
      display:none;
  }
}
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" id="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('invoice_details') ?></h1>
            <small><?php echo display('invoice_details') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('invoice') ?></a></li>
                <li class="active"><?php echo display('invoice_details') ?></li>
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

        <?php
        if($this->permission1->method('pos_invoice', 'read')->access()){ ?>
        <body>
              <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-bd">
                    <div>
                        <div class="panel-body">
                            <div bgcolor='#e4e4e4' text='#ff6633' link='#666666' vlink='#666666' alink='#ff6633' id="printableArea">
                <tr>
                    <td>
                        <table border="0" width="100%" >
                            <tr>
                                {company_info}
                                <td align="center" class="print_header"><span>
                                        <img src="<?php if (isset($Web_settings[0]['invoice_logo'])) {echo $Web_settings[0]['invoice_logo']; }?>" class="" alt=""></span><br>
                                    {address}<br>
                                    {mobile}
                                </td>
                                {/company_info}
                            </tr>
                            <tr>
                                <td align="center"><b>{customer_name}</b><br>
                                    {customer_address}
                                    <br>
                                    {customer_mobile}
                                </td>
                            </tr>
                            <tr>
                                <td align="center"><nobr><date>Date:{final_date}<time></nobr></td>
                            </tr>
                        </table>

                        <table width="100%">
                            <tr>
                                <td align="right"><?php echo display('qty') ?></th>
                                <td align="center"><?php echo display('medicine') ?></td>
                                <td align="right"><?php echo display('price') ?></td>
                                <td align="right"><?php echo display('discounts') ?></td>
                                <td align="right"><?php echo display('total') ?></td>
                            </tr>
                         
                            <?php 
                                        $subtotalamount = 0;
                                        $return_discount = 0;
                                        $return_amount = 0;
                                         foreach($invoice_all_data as $details){?>
                            <tr>

                                <td align="right"><nobr><?php
                                            if($details['quantity'] < 0){ echo $qty = -1*$details['quantity'];}else{
                                                echo $qty = $details['quantity'];
                                            }
                                              ?></nobr></td>
                                <td align="center"><nobr><?php echo $details['product_name'].' - '.$details['strength'];
                                            if($details['quantity'] < 0){
                                                echo '('.' <span class="text-danger">Returned</span> '.')';
                                            }?><nobr></td>
                                <td align="right"><nobr><?php echo (($position==0)?"$currency ".$details['rate']."":"".$details['rate']." $currency") ?></nobr></td>
                                    <?php
                                            if($details['quantity'] < 0){
                                             $discounts =  -1*$details['discount'];
                                             $tp = -1*$details['total_price'];
                                            
                                         }else{
                                            $discounts = $details['discount'];
                                            $tp = $details['total_price'];
                                            }
                                             if ($discount_type == 1) { ?>
                                            <td align="right"><?php echo $discounts;
                                             $dis_amount = ($qty*$details['rate']*$discounts)/100;
                                            ?></td>
                                            <?php }elseif($discount_type == 2){ ?>
                                            <td align="right"><?php echo (($position==0)?"$currency ".$discounts."":"".$discounts." $currency");
                                            $dis_amount = $qty*$discounts;
                                             ?></td>
                                            <?php }else{ ?>
                                                 <td align="right"><?php echo (($position==0)?"$currency ".$discounts."":"".$discounts." $currency");
                                                 $dis_amount = $discounts;
                                                  ?></td>
                                            <?php }?>
                                
                                <td align="right"><nobr><?php
                                             if($details['quantity'] < 0){ 
                                                 $totalprice = $tp - $dis_amount;
                                                 $subtotalamount -= $totalprice;
                                                 $return_discount += $dis_amount;
                                                 $return_amount  +=$totalprice;
                                             }else{
                                                 $totalprice = $tp;
                                                 $subtotalamount += $totalprice;
                                            }

                                           
                                             echo (($position==0)?"$currency ".$totalprice."":"".$totalprice." $currency") ?></nobr></td>

                            </tr>
                               <?php }?>
                            
                            <tr>
                                <td colspan="5" class="minpos-bordertop"><nobr></nobr></td>
                            </tr>
                            <tr>
                                <td align="left"><nobr></nobr></td>
                                <td align="left" colspan="3"><nobr><?php echo display('sub_total') ?></nobr></td>
                                <td align="right"><nobr><?php echo (($position==0)?"$currency ".$subtotalamount: $subtotalamount." $currency") ?></nobr></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="minpos-bordertop"><nobr></nobr></td>
                            </tr>
                            <tr>
                                <td align="left"><nobr></nobr></td>
                                <td align="left" colspan="3"><nobr><?php echo display('tax') ?></nobr></td>
                                <td align="right"><nobr><?php echo (($position==0)?"$currency {total_tax}":"{total_tax} $currency") ?></nobr></td>
                            </tr>
                            <tr>
                                <td align="left"><nobr></nobr></td>
                                <td align="left" colspan="3"><nobr><?php echo display('invoice_discount') ?></nobr></td>
                                <td align="right"><nobr><?php echo (($position == 0) ? "$currency {invoice_discount}" : "{invoice_discount} $currency") ?></nobr></td>
                            </tr>
                            <tr>
                                <td align="left"><nobr></nobr></td>
                                <td align="left" colspan="3"><nobr><?php echo display('total_discount') ?></nobr></td>
                                <td align="right"><nobr><?php
                                                  $dis = $total_discount + $return_discount + $invoice_discount;
                                                 echo (($position == 0) ? "$currency ".$dis : $dis." $currency") ?></nobr></td>
                            </tr>
                            
                            <tr>
                                <td colspan="5" class="minpos-bordertop"><nobr></nobr></td>
                            </tr>
                            <tr>
                                <td align="left"><nobr></nobr></td>
                                <td align="left" colspan="3"><nobr><strong><?php echo display('grand_total') ?></strong></nobr></td>
                                <td align="right"><nobr><strong><?php
                                            $tmnt = $total_amount-$return_amount;
                                             echo (($position == 0) ? "$currency ".$tmnt  : $tmnt." $currency") ?></strong></nobr></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="minpos-bordertop"><nobr></nobr></td>
                            </tr>
                            <tr>
                                <td align="left"><nobr></nobr></td>
                                <td align="left" colspan="3"><nobr><?php echo display('paid') ?></nobr></td>
                                <td align="right"><nobr><?php echo (($position==0)?"$currency {paid_amount}":"{paid_amount} $currency") ?></nobr></td>
                            </tr>

                            <tr>
                                <td align="left"><nobr></nobr></td>


                                <td align="left" colspan="3">
                                    <nobr>
                                        <?php
                                        $change=$paid_amount-$total_amount;
                                        if($change > 0){
                                            echo 'Change';
                                        }else{
                                            echo 'Due';
                                        }
                                        ?>
                                    </nobr>
                                </td>
                                <td align="right">
                                    <nobr>
                                     <?php
                                        $change=$paid_amount-$total_amount;
                                        if($change > 0){
                                            echo $change;
                                        }else{
                                             $due = $tmnt - $paid_amount;
                                                 echo (($position == 0) ? "$currency ".$due : $due."{due_amount} $currency");
                                        }?>
                                    </nobr>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="5" class="minpos-bordertop"><nobr></nobr></td>
                            </tr>
                        </table>
                        <table width="100%">
                            <tr>
                                <td>Receipt  No:{invoice_no}</td>
                                <td>User: <?php echo $this->session->userdata('user_name');?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>{company_info}
                        Powered  By: {company_name}, {email}
                        {/company_info}
                    </td>
                </tr>
            </table>
        </div>
        <div class="panel-footer text-left">
        
             <input type="hidden" name="" id="url" value="<?php echo base_url('Cinvoice/gui_pos');?>">
            	<button  class="btn btn-info" id="printPageButton" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></button>

        </div>
        </div>
        </div>
        </div>
        </div>
        </body>
        <?php
        }
        else{
            ?>
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('You do not have permission to access. Please contact with administrator.');?></h4>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
        ?>
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->
