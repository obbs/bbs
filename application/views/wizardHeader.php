<div class="row no-padding-LR">
	<div class="col-md-12 no-padding-LR">
<?php $counterStep=1; $exClasses=""; ?>
		<div class="wiz-header">
			<div class="row" style="padding: 0px 15px;">
				<?php 
					if($step==$counterStep){ $exClasses = 'wiz_active';} 
					if($step>$counterStep){ $exClasses = 'wiz_inactive';}
				?>
				<div class="col-xs-4 wiz_step_1 wiz_step <?php echo $exClasses; ?>">
					<i class="icon-search"></i>
					Search Room
				</div>
				<?php
					$counterStep = $counterStep+1; $exClasses='';
					if($step==$counterStep){ $exClasses = 'wiz_active';} 
					if($step>$counterStep){ $exClasses = 'wiz_inactive';}
				?>
				<div class="col-xs-4 wiz_step_2 no-padding-LR wiz_step <?php echo $exClasses; ?>">
					<i class="icon-book"></i>
					Booking Room
				</div>
				<?php
					$counterStep = $counterStep+1;  $exClasses='';
					if($step==$counterStep){ $exClasses = 'wiz_active';} 
					if($step>$counterStep){ $exClasses = 'wiz_inactive';}
				?>
				<div class="col-xs-4 wiz_step_3 no-padding-LR wiz_step <?php echo $exClasses; ?>">
					<i class="icon-search"></i>
					Confirmation
				</div>
			</div>
		</div>
		
	</div>
</div>
