
<!-- Profit Report Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo 'Invoice wise'; ?></h1>
	        <small><?php echo display('report')?></small>
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('report') ?></a></li>
	            <li class="active"><?php echo 'Invoice wise'; ?></li>
	        </ol>
	    </div>
	</section>

	<section class="content">

		<!-- Profit report -->
		<div class="row">
			<div class="col-sm-12">
		        <div class="panel panel-default">
		            <div class="panel-body"> 
		                <div class="row">
		  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-bd">
                    <div class="panel-body pro-background">
                        <div class="statistic-box">
                             <h3 class="text-center pro-heads">Today's Profit</h3>
                           <table>
                               <tr>
                                   <td class="text-right">
                                    <h4>Total Sale Price :</h4>
                                    <h4>Total Manufacturer Price :</h4>
                                    <h4 class="pro-margintop">Total Profit :</h4>
                                   </td>
                                   <td class="text-right">
                                         <h4><?php echo $currency.' '.number_format($todays['sale_amount'], 2, '.', ',')?></h4> 
                                          <h4><?php echo $currency.' '.number_format($todays['manufacture_amount'], 2, '.', ',')?></h4>
                                          <h4 class="pro-borde-top"><?php echo $currency.' '.number_format($todays['profit'], 2, '.', ',')?></h4>
                                   </td>
                               </tr>
                           </table>
                        </div>
                    </div>
                </div>
            </div>
            		  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-bd">
                    <div class="panel-body pro-background2">
                        <div class="statistic-box">
                             <h3 class="text-center pro-heads">This Week's Profit</h3>
                           <table>
                               <tr>
                                   <td class="text-right">
                                    <h4>Total Sale Price :</h4>
                                    <h4>Total Manufacturer Price :</h4>
                                    <h4 class="pro-margintop">Total Profit :</h4>
                                   </td>
                                   <td class="text-right">
                                          <h4><?php echo $currency.' '.number_format($weekly['sale_amount'], 2, '.', ',')?></h4> 
                                          <h4><?php echo $currency.' '.number_format($weekly['manufacture_amount'], 2, '.', ',')?></h4>
                                          <h4 class="pro-borde-top"><?php echo $currency.' '.number_format($weekly['profit'], 2, '.', ',')?></h4>
                                   </td>
                               </tr>
                           </table>
                        </div>
                    </div>
                </div>
            </div>
            		  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-bd">
                    <div class="panel-body pro-background3">
                        <div class="statistic-box">
                             <h3 class="text-center pro-heads">This Month's Profit</h3>
                           <table>
                               <tr>
                                   <td class="text-right">
                                    <h4>Total Sale Price :</h4>
                                    <h4>Total Manufacturer Price :</h4>
                                    <h4 class="pro-margintop">Total Profit :</h4>
                                   </td>
                                   <td class="text-right">
                                         <h4><?php echo $currency.' '.number_format($monthly['sale_amount'], 2, '.', ',')?></h4> 
                                          <h4><?php echo $currency.' '.number_format($monthly['manufacture_amount'], 2, '.', ',')?></h4>
                                          <h4 class="pro-borde-top"><?php echo $currency.' '.number_format($monthly['profit'], 2, '.', ',')?></h4>
                                   </td>
                               </tr>
                           </table>
                        </div>
                    </div>
                </div>
            </div>
		                </div>
		            </div>
		           
		        </div>
		    </div>
	    </div>
     
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="panel-title">
                             
                            </div>
                        </div>
                        <div class="panel-body" >
                            
                            <div class="row">
                                <div class="text-right">
                                <?php echo form_open('Admin_dashboard/daily_profit',array('class' => 'form-inline','method' => 'post'))?>
		                <?php date_default_timezone_set("Asia/Dhaka"); $today = date('Y-m-d'); ?>
		               
                        <div class="form-group">
                            <label for="from_date"><?php echo display('start_date') ?>:</label>
                            <input type="text" name="from_date" class="form-control datepicker" id="from_date" placeholder="<?php echo display('start_date') ?>" value="<?php echo $today?>" >
                        </div>
                        <div class="form-group">
                            <label for="to_date"><?php echo display('end_date') ?>:</label>
                            <input type="text" name="to_date" class="form-control datepicker" id="to_date" placeholder="<?php echo display('end_date') ?>" value="<?php echo $today?>">
                        </div>
                        <div class="form-group serach-buttonmargin">
                        <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
                      </div>
		               <?php echo form_close()?>
                              </div>
                              <br>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                           
                                            <tr>
                                            <th>Date</th>
                                            <th>Invoice No</th>
                                            <th class="text-center">Total Sale Price</th>
                                            <th class="text-center">Total Manufacturer Price</th>
                                            <th class="text-center">Profit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php 
                                             $total_sale = 0;
                                             $total_mprice = 0;
                                             $totalprofit = 0;
                             foreach($salepurchase as $result){?>
                                            <tr>
                                    <td><?php echo $result['date'];?></td>
                                    <td><?php echo $result['invoice'];?></td>
                                    <td class="text-right"><?php echo $result['total_amount'];
                                       $total_sale  += $result['total_amount'];
                                    ?></td>
                                    <td class="text-right"><?php echo  $manufacturer_price = $this->Reports->invoice_manufacturerprice($result['invoice_id']);
                                    $total_mprice +=$manufacturer_price;
                                    ?></td>
                                    
                                    <td class="text-right"><?php   $profit = $result['total_amount'] - $manufacturer_price;
                                    echo number_format( $profit, 2, '.', ',');
                                    $totalprofit +=$profit;
                                    ?></td>
                                </tr>
                                
                                <?php   }?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" class="text-right"><b>Total</b></td>
                                                <td class="text-right"><b><?php echo  html_escape($total_sale);?></b></td>
                                                <td class="text-right"><b><?php echo  html_escape($total_mprice);?></b></td>
                                                <td class="text-right"><b><?php echo  html_escape($totalprofit);?></b></td>
                                            </tr>
                                        </tfoot>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
     
	
	</section>
</div>
 <!-- Profit Report End -->
