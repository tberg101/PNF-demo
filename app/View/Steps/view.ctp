<div class="steps view">
<h2><?php echo __('Step'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($step['Step']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Demo Id'); ?></dt>
		<dd>
			<?php echo h($step['Step']['demo_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Step Number'); ?></dt>
		<dd>
			<?php echo h($step['Step']['step_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($step['Step']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
            <?php echo $this->Html->image('uploads/demos/' . $step['Step']['image_upload']); ?>
			&nbsp;
		</dd>
	</dl>


<!--    TODO: adapt STEP PAGINATION -->

<!--    <p>-->
<!--        --><?php
//        echo $this->Paginator->counter(array(
//            'format' => __('Step {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
//        ));
//        ?><!--	</p>-->
<!--    <div class="paging">-->
<!--        --><?php
//        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
//        echo $this->Paginator->numbers(array('separator' => ''));
//        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
//        ?>
<!--    </div>-->


</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Step'), array('action' => 'edit', $step['Step']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Step'), array('action' => 'delete', $step['Step']['id']), null, __('Are you sure you want to delete # %s?', $step['Step']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Steps'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Step'), array('action' => 'add')); ?> </li>
	</ul>
</div>
