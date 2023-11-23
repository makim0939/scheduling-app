<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task $task
 * @var \Cake\Collection\CollectionInterface|string $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('All Schedule'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Weekly Schedule'), ['action' => 'weekly'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Monthly Schedule'), ['action' => 'monthly'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <?php
    ?>
    <div class="column column-80">
        <div class="tasks form content">
            <?= $this->Form->create($task) ?>
            <fieldset>
                <legend><?= __('Add Task') ?></legend>
                <?php
                echo $this->Form->control('user_id', ["value" => $user->id, "type" => "hidden"]);
                echo $this->Form->control('begin', ["step" => "60"]);
                echo $this->Form->control('end', ["step" => "60"]);
                echo $this->Form->control('place');
                echo $this->Form->control('context');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>