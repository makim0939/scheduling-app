<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Task> $tasks
 */
?>
<div class="tasks index content">
    <div class="schedule-header">
        <nav class="header-nav">
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="current">
                <h3><?= __('All') ?></h3>
            </a>
            <a href="<?= $this->Url->build(['action' => 'weekly']) ?>">
                <h3><?= __('Week') ?></h3>
            </a>
            <a href="<?= $this->Url->build(['action' => 'monthly']) ?>">
                <h3><?= __('Month') ?></h3>
            </a>
        </nav>
        <?= $this->Html->link(__('New Task'), ['action' => 'add'], ['class' => 'addButton button float-right']) ?>
    </div>

    <div class="table-responsive">

        <table>
            <thead>
                <th>All schedule</th>
                <th></th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                <?php if ((int)($this->Paginator->counter("{{count}}")) <= 0) : ?>
                    <tr>
                        <td>
                            予定はありません
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php endif; ?>
                <?php $prevTaskDate = "none"; ?>
                <?php foreach ($tasks as $task) : ?>
                    <tr>
                        <td><?= h($task->begin->format("m/d H:i")) ?> - <?= $task->begin->month === $task->end->month ? h($task->end->format("H:i")) :  h($task->end->format("m/d H:i")) ?></td>
                        <td><?= h($task->context) ?></td>
                        <td class='td-place'>
                            <?= $this->Html->image('icons/location-icon.svg', ['width' => '21px', 'class' => 'location-icon']); ?><?= h($task->place) ?>
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

</div>