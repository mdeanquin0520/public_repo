<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AuthLink $user
 */
?>
<div class="row">
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Cambiar contraseña. Usuario: '.$user->full_name) ?></legend>
                <?php
                    echo $this->Form->control('password', ['label' => 'Contraseña']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Modificar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
