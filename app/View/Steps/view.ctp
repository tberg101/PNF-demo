
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

    <?php echo $this->Html->image('uploads/demos/' . $step['Step']['image_upload']); ?>

<!--    TODO: PLAY WITH THE MAP JS AND HTML ELEMENTS TO MAKE IT WORK. It will require to add new fields to the DB-->

<!--    <map name="beatles-map">-->
<!--        <area shape="rect" data-name="paul,all" coords="36,46,121,131" href="#" />-->
<!--        <area shape="rect" data-name="ringo,all" coords="113,76,198,161" href="#" />-->
<!--        <area shape="rect" data-name="john,all" coords="192,50,277,135" href="#" />-->
<!--        <area shape="rect" data-name="george,all" coords="262,60,347,145" href="#" />-->
<!--    </map>-->
<!---->
<!--    <div id="beatles-caption" style="clear:both;border: 1px solid black; width: 400px; padding: 6px; display:none;">-->
<!--        <div id="beatles-caption-header" style="font-style: italic; font-weight: bold; margin-bottom: 12px;"></div>-->
<!--        <div id="beatles-caption-text"></div>-->
<!--    </div>-->

        <p>
            <?php
        echo $this->Paginator->counter(array(
            'format' => __('Step {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
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
