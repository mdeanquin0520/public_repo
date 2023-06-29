<?php echo $this->Flash->render() ?>
<?= $this->Form->create() ?>
<div class="column-responsive column-80">
	<div class="users form content">
		<?= $this->Form->create() ?>
		<fieldset>
			<legend><?= __('Olvidé la contraseña') ?></legend>
			<?= $this->Form->control('email', ['label' => 'E-mail']); ?>
		</fieldset>
		<?= $this->Form->button(__('Enviar')) ?>
		<?= $this->Form->end() ?>
	</div>
</div>