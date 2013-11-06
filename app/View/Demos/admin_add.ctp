
<!--TODO: extract these css rules to a separated file-->

<style type="text/css">

    div#add-step-div {
        clear: both;
        margin-bottom: 0px;
        padding: 0px;
    }
</style>

<?php echo $this->Html->script('jquery-1.10.2.min'); // Include jQuery library ?>

<div class="demos form">
<?php echo $this->Form->create('Demo', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Add Demo'); ?></legend>
	<?php
        end($clients);         // move the internal pointer to the end of the array
		echo $this->Form->input('client_id', array('default' => key($clients)));
		echo $this->Form->input('name');
		echo $this->Form->input('url');
		echo $this->Form->input('logo_upload', array('type' => 'file'));
	?>
	</fieldset>
    <?php $i = 0; //STEP INDEX ?>
    <fieldset id="add">
        <legend><?php echo __('DEMO Steps'); ?></legend>
        <?php
        echo $this->Form->hidden('Step.'.$i.'.step_number', array('value' => $i));
        echo $this->Form->input('Step.'.$i.'.title', array('div' => false, 'value' => 'Search Flight'));
        echo $this->Form->input('Step.'.$i.'.image_upload', array('type' => 'file', 'div' => false, 'label' => false));
        $i++;
        ?>
        <?php
        echo $this->Form->hidden('Step.'.$i.'.step_number', array('value' => $i));
        echo $this->Form->input('Step.'.$i.'.title', array('div' => false, 'value' => 'Select Flight'));
        echo $this->Form->input('Step.'.$i.'.image_upload', array('type' => 'file', 'div' => false, 'label' => false));
        $i++;
        ?>
        <?php
        echo $this->Form->hidden('Step.'.$i.'.step_number', array('value' => $i));
        echo $this->Form->input('Step.'.$i.'.title', array('div' => false, 'value' => 'Cross-sell'));
        echo $this->Form->input('Step.'.$i.'.image_upload', array('type' => 'file', 'div' => false, 'label' => false));
        $i++;
        ?>
        <?php
        echo $this->Form->hidden('Step.'.$i.'.step_number', array('value' => $i));
        echo $this->Form->input('Step.'.$i.'.title', array('div' => false, 'value' => 'Complete booking'));
        echo $this->Form->input('Step.'.$i.'.image_upload', array('type' => 'file', 'div' => false, 'label' => false));
        $i++;
        ?>
        <?php
        echo $this->Form->hidden('Step.'.$i.'.step_number', array('value' => $i));
        echo $this->Form->input('Step.'.$i.'.title', array('div' => false, 'value' => 'Service activation'));
        echo $this->Form->input('Step.'.$i.'.image_upload', array('type' => 'file', 'div' => false, 'label' => false));
        $i++;
        ?>
        <?php
        echo $this->Form->hidden('Step.'.$i.'.step_number', array('value' => $i));
        echo $this->Form->input('Step.'.$i.'.title', array('div' => false, 'value' => 'Check-in Confirmation'));
        echo $this->Form->input('Step.'.$i.'.image_upload', array('type' => 'file', 'div' => false, 'label' => false));
        echo $this->Form->button('Add Step', array('type' => 'button', 'id' => 'add-step', 'div' => false));
        $i++;
        ?>
        <div id="add-step-div"></div>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Demos'), array('action' => 'index', 'admin' => true)); ?></li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index', 'admin' => true)); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add', 'admin' => true)); ?> </li>
		<li><?php echo $this->Html->link(__('List Steps'), array('controller' => 'steps', 'action' => 'index', 'admin' => true)); ?> </li>
		<li><?php echo $this->Html->link(__('New Step'), array('controller' => 'steps', 'action' => 'add', 'admin' => true)); ?> </li>
	</ul>
</div>



<script>
    $("#add-step").click(function(e) {
        $('#add-step-div').trigger('addStep');
    });
    $('#add-step-div').on('addStep', function() {
        console.log(this);
        $(this).append('<?php echo $this->Form->hidden('Step.'.$i.'.step_number', array('value' => $i));
                      echo $this->Form->input('Step.'.$i.'.title', array('div' => false));
                      echo $this->Form->input('Step.'.$i.'.image_upload', array('type' => 'file', 'div' => false, 'label' => false));
//                      echo $this->Form->button('Add Step', array('type' => 'button', 'id' => 'add-step'));
                      $i++;
            ?> ');
    });
</script>
