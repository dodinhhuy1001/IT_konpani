<!-- Add expence entry start-->
<div class="form-container">
    <form class="form-vertical" action="<?php echo base_url()?>Cclosing/add_expence_entry" id="add_expence_entry" method="post"  name="insert_transaction" enctype="multypart/formdata">
		<div class="lblFieldContnr">
			<div class="lblContnr"><?php echo display('title')?></div>
			<div class="fieldContnr">
				<input type="text" id="title" name="title" />
			</div>
		</div>
		<div class="lblFieldContnr">
			<div class="lblContnr"><?php echo display('description')?></div>
			<div class="fieldContnr">
				<textarea name="description"></textarea>
			</div>
		</div>
		<div class="lblFieldContnr">
			<div class="lblContnr"><?php echo display('amount')?></div>
			<div class="fieldContnr">
				<input type="number" id="amount" name="amount" />
			</div>
		</div>
		<div class="lblFieldContnr">
			<div class="lblContnr"></div>
			<div class="fieldContnr">
				<input type="submit" id="add-deposit" class="btn btn-primary" name="add-deposit" value="<?php echo display('save')?>" required />
			</div>
		</div>
    </form>
</div>
<!-- Add expence entry end-->