<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Task> $tasks
 */

use Cake\I18n\DateTime;

$currentMonth = isset($month) ? new DateTime($month) : DateTime::now()->startOfMonth();
$prevMonth = $currentMonth->subMonths(1);
$nextMonth = $currentMonth->addMonths(1);
?>
<div class="tasks index content">
    <div class="schedule-header">
        <nav class="header-nav">
            <a href="<?= $this->Url->build(['action' => 'index']) ?>">
                <h3><?= __('All') ?></h3>
            </a>
            <a href="<?= $this->Url->build(['action' => 'weekly']) ?>">
                <h3><?= __('Week') ?></h3>
            </a>
            <a href="<?= $this->Url->build(['action' => 'monthly']) ?>" class="current">
                <h3><?= __('Month') ?></h3>
            </a>
        </nav>
        <?= $this->Html->link(__('New Task'), ['action' => 'add'], ['class' => 'addButton button float-right']) ?>
    </div>


    <div class="table-responsive">


        <table>
            <thead>
                <tr>
                    <th>
                        <?php echo $currentMonth->format("F Y") ?>
                    </th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $prevTaskDate = "none"; ?>
                <?php if ((int)($this->Paginator->counter("{{count}}")) <= 0) : ?>
                    <tr>
                        <td>
                            この月の予定はありません
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($tasks as $task) : ?>
                    <tr>
                        <td><?= h($task->begin->format("m/d H:i")) ?> - <?= $task->begin->month === $task->end->month ? h($task->end->format("H:i")) :  h($task->end->format("m/d H:i")) ?></td>
                        <td><?= h($task->context) ?></td>
                        <td>
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
    <div class="paginator">
        <ul class="pagination">
            <a href="<?= $this->Url->build(['action' => 'monthly', '?' => ['month' => $prevMonth->format('Y-m-d')]]) ?>">&lt; previous</a>
            <a href="<?= $this->Url->build(['action' => 'monthly', '?' => ['month' => $nextMonth->format('Y-m-d')]]) ?>">next &gt;</a>
        </ul>
    </div>
</div>