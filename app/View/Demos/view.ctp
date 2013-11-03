<div class="demos view">
<h2><?php echo __('Demo'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($demo['Demo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client'); ?></dt>
		<dd>
			<?php echo $this->Html->link($demo['Client']['name'], array('controller' => 'clients', 'action' => 'view', $demo['Client']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($demo['Demo']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($demo['Demo']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Logo'); ?></dt>
		<dd>
			<?php echo $this->Html->image('uploads/logos/' . $demo['Demo']['logo_upload']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Demo'), array('action' => 'edit', $demo['Demo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Demo'), array('action' => 'delete', $demo['Demo']['id']), null, __('Are you sure you want to delete # %s?', $demo['Demo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Demos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Demo'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Steps'), array('controller' => 'steps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Step'), array('controller' => 'steps', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Steps'); ?></h3>
	<?php if (!empty($demo['Step'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Demo Id'); ?></th>
		<th><?php echo __('Step Number'); ?></th>
		<th><?php echo __('Image Url'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($demo['Step'] as $step): ?>
		<tr>
			<td><?php echo $step['id']; ?></td>
			<td><?php echo $step['demo_id']; ?></td>
			<td><?php echo $step['step_number']; ?></td>
			<td><?php echo $step['title']; ?></td>
			<td><?php echo $step['image_upload']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Admin View'), array('controller' => 'steps', 'action' => 'view', $step['id'], 'admin' => true)); ?>
				<?php echo $this->Html->link(__('User View'), array('controller' => 'steps', 'action' => 'view', $step['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'steps', 'action' => 'edit', $step['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'steps', 'action' => 'delete', $step['id']), null, __('Are you sure you want to delete # %s?', $step['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Step'), array('controller' => 'steps', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
