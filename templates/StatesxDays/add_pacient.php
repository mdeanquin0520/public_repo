<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\StatesxDays> $StatesxDays
 */
?>
<div class="StatesxDays addPacient content">
	<?php
		echo $this->Form->create($statesxDay);
		echo $this->Form->control('estado',['label'=>'Estado','options'=>[1 => 'Alerta verde', 2 => 'Alerta amarillo', 3 => 'Alerta naranja', 4 => 'Alerta rojo'], 'id' => 'estadoId']);
		echo $this->Form->button('Quitar selección',['type' => 'button', 'id' => 'quitar', 'class' => 'button float-right']);
		echo $this->Form->button('Seleccionar todos',['type' => 'button', 'id' => 'seleccionar', 'class' => 'button float-right']);
	?>
    <h3><?= __('Bloquear pacientes') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Telefono</th>
					<th>Fecha de nacimiento</th>
					<th>Direccion</th>
					<th>Célula</th>
					<th>UF</th>
					<th>Nodo</th>
					<th>Inmunización</th>
					<th>Agente asignado</th>
					<th>Estado</th>
					<th>Acciones</th>
					<th>Aislado</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 0;
				foreach ($pacients as $pacient):
					$color = '';
					if($pacient->inmunity_a && $pacient->inmunity_b) {
						$color = '#3c9f40';
					} else if ($pacient->inmunity_a) {
						$color = '#f15f21';
					} else if ($pacient->inmunity_b) {
						$color = '#ccb700';
					} else {
						$color = '#f44336';
					}
				?>
				<tr>
					<td>
						<?= ($pacient->status == 3) ? $this->Html->image('covid-icon.png',['style'=>'width:24px']) : '' ?>
						<?= $pacient->name ?>
					</td>
					<td><?= $pacient->lastname ?></td>
					<td><?= $pacient->phone ?></td>
					<td><?= $pacient->birthday ?></td>
					<td><?= $pacient->address ?></td>
					<td><?= $pacient->group->group_name ?></td>
					<td><?= $pacient->net->net_name ?></td>
					<td><?= $pacient->main_gate ?></td>
					<td style="background-color:<?= $color ?>;color:#fff">
						Gripe: <?= $pacient->inmunity_a ? 'Si' : 'No' ?><br/>
						Neumococo: <?= $pacient->inmunity_b ? 'Si' : 'No' ?><br/>
					</td>
					<td><?= $pacient->user->full_name ?></td>
					<td><?= $statusEnum[$pacient->status] ?></td>
					<td>
						<?= $this->Form->control($i.'.StatesxDays.status',['label'=>false, 'options'=>[1 =>'Alerta verde','Alerta amarillo','Alerta naranja','Alerta rojo'], 'class'=>'status']) ?>
						<?= $this->Form->hidden($i.'.StatesxDays.pacient_id',['value'=>$pacient->id]) ?>
						<?= $this->Form->hidden($i.'.StatesxDays.date',['value'=>date('Y-m-d')]) ?>
						<?= $this->Form->hidden($i.'.StatesxDays.hour',['value'=>date('H:i:s')]) ?>
						<?= $this->Form->hidden($i.'.StatesxDays.user_id',['value'=>$viewUser['id']]) ?>
						<?= $this->Form->hidden($i.'.StatesxDays.group_id',['value'=>$pacient->group_id]) ?>
						<?= $this->Form->hidden($i.'.StatesxDays.net_id',['value'=>$pacient->net_id]) ?>
						<?= $this->Form->hidden($i.'.StatesxDays.main_gate',['value'=>$pacient->main_gate]) ?>
					</td>
					<td>
						 <?= $this->Form->checkbox($i.'.pacient.isolated',['value'=>true,'hiddenField' => false, 'class' => 'isolated']) ?>
					</td>
				</tr>
				<?php
						$i++;
					endforeach;
				?>
			</tbody>
		</table>
	</div>
	<?= $this->Form->button(__('Guardar')) ?>
	<?= $this->Form->end() ?>
</div>
<script>
$(function(){
	$('#estadoId').change(function(){
		$('.status').val($(this).val());
	})
})
$(function(){
	$('#seleccionar').click(function() {
		$('.isolated').prop('checked', true);
	});
});
$(function(){
	$('#quitar').click(function() {
		$('.isolated').prop('checked', false);
	});
});
</script>