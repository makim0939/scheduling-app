<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task $task
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <div class="nav-category">
                <?= $this->Html->link(__('Edit Task'), ['action' => 'edit', $task->id], ['class' => 'side-nav-item']) ?>
                <?= $this->Form->postLink(__('Delete Task'), ['action' => 'delete', $task->id], ['confirm' => __('Are you sure you want to delete # {0}?', $task->id), 'class' => 'side-nav-item']) ?>

            </div>
            <div class="nav-category">
                <?= $this->Html->link(__('All Schedule'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
                <?= $this->Html->link(__('Weekly Schedule'), ['action' => 'weekly'], ['class' => 'side-nav-item']) ?>
                <?= $this->Html->link(__('Monthly Schedule'), ['action' => 'monthly'], ['class' => 'side-nav-item']) ?>
            </div>


            <?= $this->Html->link(__('New Task'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="tasks view content">
            <h3><?= h($task->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $task->hasValue('user') ? $task->user->email : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($task->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Begin') ?></th>
                    <td><?= h($task->begin) ?></td>
                </tr>
                <tr>
                    <th><?= __('End') ?></th>
                    <td><?= h($task->end) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Place') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($task->place)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Context') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($task->context)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>