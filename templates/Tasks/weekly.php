<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Task> $tasks
 */

use Cake\I18n\DateTime;

$currentWeek = isset($week) ? new DateTime($week) : DateTime::now()->startOfWeek();
$prevWeek = $currentWeek->subWeeks(1);
$nextWeek = $currentWeek->addWeeks(1);
?>
<div class='tasks index content'>
    <div class="schedule-header">
        <nav class="header-nav">
            <a href="<?= $this->Url->build(['action' => 'index']) ?>">
                <h3><?= __('All') ?></h3>
            </a>
            <a href="<?= $this->Url->build(['action' => 'weekly']) ?>" class="current">
                <h3><?= __('Week') ?></h3>
            </a>
            <a href="<?= $this->Url->build(['action' => 'monthly']) ?>">
                <h3><?= __('Month') ?></h3>
            </a>
        </nav>
        <?= $this->Html->link(__('New Task'), ['action' => 'add'], ['class' => 'addButton button float-right']) ?>
    </div>

    <div class='table-responsive'>
        <?php if ((int)($this->Paginator->counter("{{count}}")) <= 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>
                            <?= $currentWeek->format('m/d D~') ?>
                        </th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <td>
                        この週の予定はありません
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>

                </tbody>
            </table>
        <?php endif; ?>

        <table>
            <tbody>
                <?php $prevTaskDate = 'none'; ?>
                <?php foreach ($tasks as $task) : ?>
                    <?php if ($task->begin->format('ymdN')  !== $prevTaskDate) : ?>
                        <tr>
                            <th>
                                <?= h($task->begin->format('m/d D')) ?>
                            </th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php $prevTaskDate = $task->begin->format('ymdN') ?>
                    <?php endif; ?>

                    <tr>
                        <td><?= h($task->begin->format('H:i')) ?> ~ <?= h($task->end->format('H:i')) ?></td>
                        <td><?= h($task->context) ?></td>
                        <td class='td-place'>
                            <?= $this->Html->image('icons/location-icon.svg', ['width' => '24px', 'class' => 'location-icon']); ?><?= h($task->place) ?>
                        </td>
                        <td class=" actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $task->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $task->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $task->id], ['confirm' => __('Are you sure you want to delete # {0}?', $task->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <div class='paginator'>
        <ul class='pagination'>
            <a href="<?= $this->Url->build(['action' => 'weekly', '?' => ['week' => $prevWeek->format('Y-m-d')]]) ?>">&lt; previous</a>
            <a href="<?= $this->Url->build(['action' => 'weekly', '?' => ['week' => $nextWeek->format('Y-m-d')]]) ?>">next &gt;</a>
        </ul>
    </div>
</div>