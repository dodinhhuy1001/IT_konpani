 <link href="<?php echo base_url('assets/css/payslip.css') ?>" rel="stylesheet" type="text/css"/>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('payroll') ?></h1>
            <small><?php echo $title; ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('payroll') ?></a></li>
                <li class="active"><?php echo $title; ?></li>
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
                <div class="panel panel-bd">
                	<div class="panel title text-right">
                		 <button  class="btn btn-warning" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></button>
                	</div>
                    <div id="printableArea">
                        <div class="panel-body" id="payslip">
                            <div class="row" >
                                
                                <div class="col-sm-12">
                                	
                                	<table>
                                		<tr>

                                			<td class="payslip-logo"><img src="<?php echo(!empty($setting[0]['logo'])?html_escape($setting[0]['logo']):'') ?>" width="250px;" alt=""></td>
                                			<td class="text-center"> <address class="margin-top10">
                                        <strong class="font30"><?php echo (!empty($company[0]['company_name'])?html_escape($company[0]['company_name']):'Bdtask Ltd')?></strong><br>
                                        <?php echo (!empty($company[0]['address'])?html_escape($company[0]['address']):'Demo Address')?><br>
                                       <b> Salary Slip - <?php echo  html_escape($paymentdata[0]['salary_month'])?></b>
                                       
                                      
                                    </address></td>
                                    <td></td>
                                		</tr>
                                	</table>
                                	<table>
       <div id="details">
		<div class="scope-entry">
			<div class="title"><?php echo  display('employee_name')?> :<?php echo  html_escape($paymentdata[0]['first_name']).' '.html_escape($paymentdata[0]['last_name'])?></div>
			<div class="title"><?php echo  display('designation')?>   : <?php echo  html_escape($paymentdata[0]['position_name'])?></div>
			<div class="title"><?php echo  display('salary_date')?>   : <?php echo  html_escape($paymentdata[0]['payment_date'])?></div>
			
		</div>
		
	</div>
                                	</table>
                                
                                </div>
                                
                      
                            

                        <div class="col-sm-12">
                        	<table class="table">
                        		<tr>
                        			<td class="left-panel borderright"> 
                        			 <table class="" width="100%">
                        			 	
                                    <thead>
                                        <tr class="employee">
                                            <th class="name text-center border-bottom" colspan="2"><?php echo display('earnings'); ?></th>
                                            
                                           
                                        </tr>
                                    </thead>
                                    <tbody class="details">
                                      
                                        <tr class="entry">
                                            <td class="value"><?php if($paymentdata[0]['salarytype'] == 1){ echo display('basic_salary');}else{echo display('basic_salary');}?></td>
                                            <td class="value"><div><?php if($paymentdata[0]['salarytype'] == 1){ echo $basicsal = $paymentdata[0]['basic']*$paymentdata[0]['total_working_minutes'];}else{echo $basicsal = $paymentdata[0]['basic'];}?></div></td>
                                           
                                        </tr>
                                        <?php 
                                        $totalAddition = 0;
                                        foreach($addition as $additions){?>
                                         <tr class="entry">
                                            <td class="value"><?php echo  html_escape($additions->sal_name);?></td>
                                            <td class="value"><div><?php echo  $basicsal*($additions->amount)/100;
                                            $totalAddition +=$basicsal*($additions->amount)/100;
                                            ?></div></td>
                                           
                                        </tr>
                                    <?php }?>
                                         
                                        <tr class="entry nti">
                                             <td class="value text-left"><?php echo  display('total_addition')?></td>
                                            <td class="value"><b><?php echo number_format($totalAddition+$basicsal,2); ?></b></td>
                                        </tr>
                              
                                      
                                    </tbody>
                                </table></td>
                        			<td  class="right-panel">  <table class="" width="100%">
                        				
                                  
                        			 	
                                    <thead>
                                        <tr class="employee">
                                            <th class="name text-center border-bottom" colspan="2"><?php echo display('deduction'); ?></th>
                                            
                                           
                                        </tr>
                                    </thead>
                                    <tbody class="details">
                                      <?php 
                                      $totalDeduction = 0;
                                      foreach($deduction as $deductions){?>
                                        <tr class="entry">
                                            <td class="value"><?php echo  $deductions->sal_name; ?></td>
                                            <td class="value"><div><?php echo  $basicsal*($deductions->amount)/100;
                                            $totalDeduction +=$basicsal*($deductions->amount)/100;
                                            ?></div></td>
                                           
                                        </tr>
                                    <?php }?>
                                    <?php $gross = $totalAddition+($basicsal-$totalDeduction);
                                     if($paymentdata[0]['total_salary'] < $gross){
                                    ?>
                                     <tr class="entry">
                                            <td class="value"><?php echo  display('tax')?></td>
                                            <td class="value"><div><?php  $tax = $gross - intval(str_replace(',', '', $paymentdata[0]['total_salary']));
                                            echo $totaltax = number_format($tax,2);
                                            ?></div></td>
                                           
                                        </tr>
                                <?php }?>
                                       
                                         <tr class="entry nti">
                                             <td class="value text-left"><?php echo  display('total_deduction')?></td>
                                            <td class="value"><b><?php echo number_format($totalDeduction+(!empty($totaltax)?$totaltax:0),2); ?></b></td>
                                        </tr>
                                        
                                    </tbody>
                                
                                </table></td>
                        		</tr>

                        	</table>
                        </div>
                    </div>
                              
                           
                            <div class="row">

                               
                                <div class="col-sm-12">

                                    <table class="table">
                                   
                                      
                                            <tr class="details">
                                            	<tbody class="nti">
                                                <th class="value"><?php echo display('net_salary'); ?> : <?php echo display('in_word').':'.html_escape($amountinword); ?></th>
                                                <td class="value text-right"><b><?php echo  html_escape($paymentdata[0]['total_salary'])?></b> </td>
                                                </tbody>
                                            </tr>
                                           	 
                                      
                                    </table>

                                   

                                </div>
                            </div>
                             <div class="row paddingbottom">
                                <div class="col-sm-12">
                             
                                        <div class="col-sm-6 text-left"><b><?php echo  display('ref_number')?>: .........</b></div>
                                    
                                </div>
                              
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                 <div  class="employee-signature">
                                        <?php echo display('employee_signature'); ?>
                                    </div>
                                </div>
                              
                                     <div class="col-sm-6"> <div  class="paidby">
                                        <?php echo display('paid_by'); ?>
                                    </div></div>
                            </div>
                           
                        </div>
                    </div>

                  
                </div>
            </div>
        </div>
    </section>
    </div>
   
 