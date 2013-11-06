
<!--TODO: extract these css rules to a separated file-->

<style type="text/css">

    div.steps.userview {
        clear: both;
        margin-bottom: 0px;
        padding: 0px;
        width: 100%;
        text-align: center;
    }
</style>

<div class="steps userview">

    <?php echo $this->Html->image('uploads/demos/' . $step['Step']['image_upload'], array('id' => 'stepimage', 'usemap' => '#stepimage-map')); ?>

    <map name="stepimage-map">
        <area shape="rect" href="#" data-name="next,all" coords="<?php echo h($step['Step']['area_coords']); ?>"/>
    </map>


<!--        <p>-->
<!--            --><?php
//        echo $this->Paginator->counter(array(
//            'format' => __('Step {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
//        ));
//        ?><!--	</p>-->
<!--        <div class="paging">-->
            <?php
//            echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
//            echo $this->Paginator->numbers(array('separator' => ''));
//            echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
//            ?>
<!--        </div>-->


</div>
<script>
    var nextStepUrl = '<?php echo $this->Html->url(array('action' => 'view', urlencode($demo['Demo']['name']),$next_offset)); ?>';
    $('area').data("name","next").attr('href', nextStepUrl);
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
                toolTipContainer: '<div data-opacity=\"0.9\" class=\"mapster_tooltip\">' +
                    'Go to next Step</div>',
                clickNavigate: true,
                isSelectable: false,
                onMouseover: function (data) {
                    $('area').mapster('tooltip')
                    inArea = true;
                },
                onMouseout: function (data) {
                    inArea = false;
                }
            };
        opts = $.extend({
            showToolTip: true
        }, focused_opts, initial_opts, unfocused_opts);


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
</script>
