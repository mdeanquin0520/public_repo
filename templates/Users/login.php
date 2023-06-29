<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="users form content">
    <?= $this->Form->create() ?>
    <fieldset>
        <?= $this->Form->control('username', ['label' => 'Usuario']) ?>
        <?= $this->Form->control('password', ['label' => 'Contraseña']) ?>
    </fieldset>
    <?= $this->Form->button(__('Login')); ?>
    <?= $this->Form->end() ?>
    <?php if(empty($countProfiles)){ ?>
	<?= $this->Html->link("Agregar perfil", ['controller' => 'Profiles', 'action' => 'add']) ?>
  	 | 
	<?php }elseif(empty($countPermissions)){ ?>
	<?= $this->Html->link("Crear permisos", ['controller' => 'MyPermissions', 'action' => 'add']) ?>
  	 | 
	<?php } ?>
    <?php if($countUsers==0){ ?>
    <?= $this->Html->link("Agregar usuario", ['action' => 'add']) ?>
	<?php }else{ ?>
    <?= $this->Html->link("Olvidé la contraseña", ['action' => 'forgotpassword']) ?>
	<?php } ?>
</div>
