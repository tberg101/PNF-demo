<div class="steps form">
<?php echo $this->Form->create('Step', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Add Step'); ?></legend>
	<?php
		echo $this->Form->input('demo_id');
		echo $this->Form->input('step_number');
		echo $this->Form->input('title');
		echo $this->Form->input('image_upload', array('type' => 'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Steps'), array('action' => 'index')); ?></li>
	</ul>
</div>
