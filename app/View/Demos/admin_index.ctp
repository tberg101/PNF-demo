<div class="demos index">
	<h2><?php echo __('Demos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('client_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('url'); ?></th>
			<th><?php echo $this->Paginator->sort('logo_upload'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($demos as $demo): ?>
	<tr>
		<td><?php echo h($demo['Demo']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($demo['Client']['name'], array('controller' => 'clients', 'action' => 'view', $demo['Client']['id'], 'admin' => true)); ?>
		</td>
		<td><?php echo h($demo['Demo']['name']); ?>&nbsp;</td>
		<td><?php echo h($demo['Demo']['url']); ?>&nbsp;</td>
		<td><?php echo h($demo['Demo']['logo_upload']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $demo['Demo']['id'], 'admin' => true)); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $demo['Demo']['id'], 'admin' => true)); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $demo['Demo']['id'], 'admin' => true), null, __('Are you sure you want to delete # %s?', $demo['Demo']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Demo'), array('action' => 'add', 'admin' => true)); ?></li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index', 'admin' => true)); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add', 'admin' => true)); ?> </li>
		<li><?php echo $this->Html->link(__('List Steps'), array('controller' => 'steps', 'action' => 'index', 'admin' => true)); ?> </li>
		<li><?php echo $this->Html->link(__('New Step'), array('controller' => 'steps', 'action' => 'add', 'admin' => true)); ?> </li>
	</ul>
</div>
