<div class="demos form">
<?php echo $this->Form->create('Demo', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Edit Demo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('client_id');
		echo $this->Form->input('name');
		echo $this->Form->input('url');
		echo $this->Form->input('logo_upload', array('type' => 'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Demo.id'), 'admin' => true), null, __('Are you sure you want to delete # %s?', $this->Form->value('Demo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Demos'), array('action' => 'index', 'admin' => true)); ?></li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index', 'admin' => true)); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add', 'admin' => true)); ?> </li>
		<li><?php echo $this->Html->link(__('List Steps'), array('controller' => 'steps', 'action' => 'index', 'admin' => true)); ?> </li>
		<li><?php echo $this->Html->link(__('New Step'), array('controller' => 'steps', 'action' => 'add', 'admin' => true)); ?> </li>
	</ul>
</div>
