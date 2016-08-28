<div class="populations form large-9 medium-8 columns content">
    <?= $this->Form->create('', array('type' => 'file')) ?>
    <fieldset>
        <legend><?= __('Import CSV') ?></legend>
        <?php
            echo $this->Form->input('file', array('type' => 'file'));
        ?>
    </fieldset>
    <?= $this->Form->button(__('Upload CSV')) ?>
    <?= $this->Form->end() ?>
</div>
