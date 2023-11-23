<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task $task
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <div class="nav-category">
                <?= $this->Form->postLink(
                    __('Delete'),
                    ['action' => 'delete', $task->id],
                    ['confirm' => __('Are you sure you want to delete # {0}?', $task->id), 'class' => 'side-nav-item']
                ) ?>
            </div>
            <div class="nav-category">
                <?= $this->Html->link(__('All Schedule'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
                <?= $this->Html->link(__('Weekly Schedule'), ['action' => 'weekly'], ['class' => 'side-nav-item']) ?>
                <?= $this->Html->link(__('Monthly Schedule'), ['action' => 'monthly'], ['class' => 'side-nav-item']) ?>
            </div>
        </div>
    </aside>
    <div class="column column-80">
        <div class="tasks form content">
            <?= $this->Form->create($task) ?>
            <fieldset>
                <legend><?= __('Edit Task') ?></legend>
                <?php
                echo $this->Form->control('user_id', ['options' => $users]);
                echo $this->Form->control('begin');
                echo $this->Form->control('end');
                echo $this->Form->control('place');
                echo $this->Form->control('context');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>