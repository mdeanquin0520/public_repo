<?php echo $this->Flash->render() ?>
<div class="column-responsive column-80">
	<div class="users form content">
		<?= $this->Form->create() ?>
		<fieldset>
			<legend><?= __('Resetear contraseña') ?></legend>
			<?= $this->Form->control('password', ['label' => 'Contraseña']); ?>
		</fieldset>
		<?= $this->Form->button(__('Modificar')) ?>
		<?= $this->Form->end() ?>
	</div>
</div>