    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('prefecture_id') ?></th>
                <th><?= $this->Paginator->sort('year') ?></th>
                <th><?= $this->Paginator->sort('count') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($populations as $population): ?>
            <tr>
                <td><?= $this->Number->format($population->id) ?></td>
                <td><?= $population->has('prefecture') ? $this->Html->link($population->prefecture->name, ['controller' => 'Prefectures', 'action' => 'view', $population->prefecture->id]) : '' ?></td>
                <td><?= ($population->year) ?></td>
                <td><?= $this->Number->format($population->count) ?></td>
                <td><?= h($population->created) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>