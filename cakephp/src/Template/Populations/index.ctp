<div class="populations index large-9 medium-8 columns content">
    <h3><?= __('Populations') ?></h3>

    <?= $this->Form->create('', array('id' => 'ajaxForm')) ?>
    <fieldset>
        <legend><?= __('Import CSV') ?></legend>
        <?php
            echo $this->Form->input('prefecture_id', ['options' => $prefectures, 'empty' => '-- Select Prefecture --']);
            echo $this->Form->input('year', ['options' => $years, 'empty' => '-- Select Year --']);
        ?>
    </fieldset>
    <?= $this->Form->end() ?>
    
    <div class="ajaxData">
		<?php echo $this->element('ajaxtable'); ?>
    </div>
</div>
