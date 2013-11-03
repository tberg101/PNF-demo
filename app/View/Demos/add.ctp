<?php echo $this->Html->script('jquery-1.10.2.min'); // Include jQuery library ?>
<div class="demos form">
<?php echo $this->Form->create('Demo', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Add Demo'); ?></legend>
	<?php
		echo $this->Form->input('client_id');
		echo $this->Form->input('name');
		echo $this->Form->input('url');
		echo $this->Form->input('title');
		echo $this->Form->input('logo_upload', array('type' => 'file'));
	?>
	</fieldset>
    <?php $i = 0; //STEP INDEX ?>
    <fieldset id="add">
        <legend><?php echo __('Add Step'); ?></legend>
        <?php
        echo $this->Form->hidden('Step.'.$i.'.step_number', array('value' => $i));
        echo $this->Form->input('Step.'.$i.'.title');
        echo $this->Form->input('Step.'.$i.'.image_upload', array('type' => 'file'));
        echo $this->Form->button('Add Step', array('type' => 'button', 'id' => 'add-step'));
        $i++;
        ?>
    </fieldset>
    <div id="add-step-div"></div>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Demos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Steps'), array('controller' => 'steps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Step'), array('controller' => 'steps', 'action' => 'add')); ?> </li>
	</ul>
</div>

<script>
    $("#add-step").click(function(e) {
        $('#add-step-div').trigger('addStep');
    });
    $('#add-step-div').on('addStep', function() {
        console.log(this);
        $(this).append('<fieldset id="add">'
            //+'<legend>--><?php //echo __("Add Step"); ?><!--</legend>'
            +'  <?php echo $this->Form->hidden('Step.'.$i.'.step_number', array('value' => $i));
                      echo $this->Form->input('Step.'.$i.'.title');
                      echo $this->Form->input('Step.'.$i.'.image_upload', array('type' => 'file'));
//                      echo $this->Form->button('Add Step', array('type' => 'button', 'id' => 'add-step'));
                      $i++;
            ?> ' + '</fieldset>');
    });</script>
