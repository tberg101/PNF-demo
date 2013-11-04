<?php
    echo $this->Html->script('jquery-1.10.2.min'); // Include jQuery library
    echo $this->Html->script('jquery.imagemapster.min'); // Include jQuery plugin to enhance image maps.
    echo $this->Html->css('admin_step_view');
?>

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
            <?php echo $this->Html->image('uploads/demos/' . $step['Step']['image_upload'], array('id' => 'stepimage', 'usemap' => '#stepimage-map')); ?>

            <map name="stepimage-map">
                <area shape="rect" data-name="next,all" coords="46,46,421,531" href="#" />
            </map>
        </dd>
        <dt><?php echo __('Coords:'); ?></dt>
        <dd>
            <?php
            echo '<span class="coords-input">Pos X' .
                $this->Form->input('area_posx', array('value' => h($step['Step']['area_posx']),'class' => 'coords-box', 'id'=>'posx','label' => false))
                .'</span>';
            echo '<span class="coords-input">Pos Y' .
                $this->Form->input('area_posy', array('value' => h($step['Step']['area_posy']),'class' => 'coords-box', 'id'=>'posy','label' => false))
                .'</span>';
            echo '<span class="coords-input">Width' .
                $this->Form->input('area_width', array('value' => h($step['Step']['area_width']),'class' => 'coords-box', 'id'=>'width','label' => false))
                .'</span>';
            echo '<span class="coords-input">Height' .
                $this->Form->input('area_height', array('value' => h($step['Step']['area_height']),'class' => 'coords-box', 'id'=>'height','label' => false))
                .'</span>';
            ?>
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
        <li><?php echo $this->Html->link(__('Edit Step'), array('action' => 'edit', $step['Step']['id'], 'admin' => false)); ?></li>
        <li><?php echo $this->Form->postLink(__('Delete Step'), array('action' => 'delete', $step['Step']['id'], 'admin' => false), null, __('Are you sure you want to delete # %s?', $step['Step']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('List Steps'), array('action' => 'index', 'admin' => false)); ?> </li>
        <li><?php echo $this->Html->link(__('New Step'), array('action' => 'add', 'admin' => false)); ?> </li>
    </ul>
</div>

<script>

    var new_coords = $('area').data("name","next").attr('coords');
    var coords_array = new_coords.split(',');
    $('.coords-box').each(function (index) {
        $(this).val(coords_array[index]);
    })

    refreshMap();

    function refreshMap() {
        var inArea,
            map = $('#stepimage'),
            unfocused_opts = {
                fillColor: '000000',
                fillOpacity: 0,
                stroke: true,
                strokeColor: 'ff0000',
                strokeWidth: 2
            },
            focused_opts = {
                fillColor: 'ffffff',
                fillOpacity: 0.6,
                stroke: true,
                strokeWidth: 2,
                strokeColor: 'ffffff'
            },
            initial_opts = {
                mapKey: 'data-name',
                isSelectable: false,
                onMouseover: function (data) {
                    inArea = true;
                },
                onMouseout: function (data) {
                    inArea = false;
                }
            };
        opts = $.extend({}, focused_opts, initial_opts, unfocused_opts);


        // Bind to the image 'mouseover' and 'mouseout' events to activate or deactivate ALL the areas, like the
        // original demo. Check whether an area has been activated with "inArea" - IE<9 fires "onmouseover"
        // again for the image when entering an area, so all areas would stay highlighted when entering
        // a specific area in those browsers otherwise. It makes no difference for other browsers.

        map.mapster('unbind')
            .mapster(opts)
            .bind('mouseover', function () {
                if (!inArea) {
                    map.mapster('set_options', unfocused_opts)
                        .mapster('set', true, 'all')
                        .mapster('set_options', focused_opts);
                }
            }).bind('mouseout', function () {
                if (!inArea) {
                    map.mapster('set', false, 'all');
                }
            });
    }

    $('.coords-box').keydown(function (e) {
        var keyCode = e.keyCode || e.which,
            arrow = {left: 37, up: 38, right: 39, down: 40 };

        switch (keyCode) {
            case arrow.left:
                //..
                break;
            case arrow.up:
                //..
                var str = $(this).val();
                str = parseInt(str) +1;
                $(this).val(str);
                break;
            case arrow.right:
                //..
                break;
            case arrow.down:
                var str = $(this).val();
                str = parseInt(str) -1;
                (str >= 0) ? $(this).val(str) : $(this).val(0);
                break;
        }
        var coords_array = [];
        $('.coords-box').each(function (index) {
            coords_array.push($(this).val());
        })
        var new_coords = coords_array.join(",");
        $('area').data("name","next").attr('coords',new_coords);
        refreshMap();
        saveData();
    });

    function saveData(){

    }
</script>

