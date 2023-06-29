<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SourcingEvent $sourcingEvent
 * @var \Cake\Collection\CollectionInterface|string[] $profiles
 */
?>
<div class="row">
    <div class="column-responsive column-80">
		<div class="sourcingEvents form content">
            <?= $this->Form->create($sourcingEvent) ?>
            <fieldset>
                <legend><?= __('Agregar evento de abastecimiento') ?></legend>
                <?php
					echo $this->Form->control('description',['label'=>'Descripción del evento']);
					echo $this->Form->button('Quitar selección',['type' => 'button', 'id' => 'quitar', 'class' => 'button float-right']);
					echo $this->Form->button('Seleccionar todos',['type' => 'button', 'id' => 'seleccionar', 'class' => 'button float-right']);
				?>
				<div class="table-responsive">
					<table>
						<thead>
							<tr>
								<th>Perfil</th>
								<th>Nodo</th>
								<th>Seleccionar</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$i=0;
								foreach ($profiles as $profile):
									$color = '';
									switch ($profile->profile_id) {
										case '4':
											$color = '#6D147A';
											break;
										case '5':
											$color = '#CC7400';
											break;
										case '6':
											$color = '#2E2EBF';
											break;            
										default:
											$color = '#30773D';
											break;
									}
							?>
							<tr>
								<td align="center" style="background-color:<?= $color ?>;color:#fff"><?= $profile->profile->name ?></td>
								<td align="center"><?= !empty($profile->main_gate) ? '#'.$profile->main_gate : ' - ' ?></td>
								<td align="center">
									<?= $this->Form->checkbox('profiles.'.$i.'.id', ['value'=>$profile->profile_id, 'hiddenField' => false, 'class' => 'profile']) ?>
									<?= $this->Form->hidden('profiles.'.$i.'._joinData.main_gate', ['value'=>$profile->main_gate]) ?>
								</td>
							</tr>
							<?php
									$i++;
								endforeach;
							?>
						</tbody>
					</table>
				</div>
            </fieldset>
            <?= $this->Form->button(__('Guardar')) ?>
			<?= $this->Form->end() ?>
		</div>
	</div>
</div>
<script>
$(function(){
	$('#seleccionar').click(function() {
		$('.profile').prop('checked', true);
	});
});
$(function(){
	$('#quitar').click(function() {
		$('.profile').prop('checked', false);
	});
});
</script>