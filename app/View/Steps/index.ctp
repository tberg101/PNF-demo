<div class="steps index">
	<h2><?php echo __('Steps'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('demo_id'); ?></th>
			<th><?php echo $this->Paginator->sort('step_number'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('image_upload'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($steps as $step): ?>
	<tr>
		<td><?php echo h($step['Step']['id']); ?>&nbsp;</td>
		<td><?php echo h($step['Step']['demo_id']); ?>&nbsp;</td>
		<td><?php echo h($step['Step']['step_number']); ?>&nbsp;</td>
		<td><?php echo h($step['Step']['title']); ?>&nbsp;</td>
		<td><?php echo h($step['Step']['image_upload']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $step['Step']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $step['Step']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $step['Step']['id']), null, __('Are you sure you want to delete # %s?', $step['Step']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Step'), array('action' => 'add')); ?></li>
	</ul>
</div>
