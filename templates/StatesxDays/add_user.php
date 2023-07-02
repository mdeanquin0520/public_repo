<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\statesx_days> $statesx_days
 */
?>
<div class="statesx_days add_user content">
	<?php
		echo $this->Form->create($statesxDay);
		echo $this->Form->control('estado',['label'=>'Estado','options'=>[1 => 'Alerta verde', 2 => 'Alerta amarillo', 3 => 'Alerta naranja', 4 => 'Alerta rojo'], 'id' => 'estadoId']);
		//echo '<div id="selectEVent" style="display:none;">'.$this->Form->control('sourcing_event_id',['label'=>'Tipo de evento','options'=>$sourcingEvents,'empty'=>'-- Seleccionar evento --']).'</div>';
		echo $this->Form->button('Quitar selección',['type' => 'button', 'id' => 'quitar', 'class' => 'button float-right']);
		echo $this->Form->button('Seleccionar todos',['type' => 'button', 'id' => 'seleccionar', 'class' => 'button float-right']);
	?>
    <h3><?= __('Cambiar estado de recursos humanos') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
					<th>Nivel</th>
					<th>Foto</th>
					<th>Email</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Rol</th>
					<th>Celula</th>
					<th>UF</th>
					<th>Nodo</th>
					<th>Estado</th>
					<th>Aislado</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$j = 0;
					foreach ($users as $user):
						$color = '';
						switch ($user->profile_id) {
							case '2':
								$color = '#000000';
								break;
							case '3':
								$color = '#041d54';
								break;
							case '4':
								$color = '#540404';
								break;
							case '5':
								$color = '#6D147A';
								break;
							case '6':
								$color = '#CC7400';
								break;
							case '7':
								$color = '#2E2EBF';
								break;            
							default:
								$color = '#30773D';
								break;
						}
				?>
				<tr>
					<td>
						<?php
							echo $user->profile_id;
							$group = '';
							$net = '';
							$main_gate = '';
							if($user->profile_id >= 3):
								$group = $user->groups[0]->group_name;
								if(!empty($user->groups[0]->_joinData->net_id)){
									$i = $user->groups[0]->_joinData->net_id - 1;
									$net = $this->Html->link($user->groups[0]->nets[$i]->net_name, ['controller' => 'Nets', 'action' => 'view', $user->groups[0]->_joinData->net_id]);
								}
								$main_gate = $user->groups[0]->_joinData->main_gate;
								echo $this->Form->hidden('statesx_days.'.$j.'.group_id',['value'=>$user->groups[0]->id]);
								echo $this->Form->hidden('statesx_days.'.$j.'.net_id',['value'=>$user->groups[0]->_joinData->net_id]);
								echo $this->Form->hidden('statesx_days.'.$j.'.main_gate',['value'=>$main_gate]);
							endif
						?>
					</td>
					<td><?= $this->Html->image($user->image_file_name_url, ['title' => $user->image_file_name_filename, 'class' => 'img-circle']) ?></td>
					<td><?= $user->email ?></td>
					<td><?= $user->firstname ?></td> 
					<td><?= $user->lastname ?></td> 
					<td style="background-color:<?= $color ?>;color:#fff"><?= $user->profile->name ?></td> 
					<td><?= $group ?></td> 
					<td><?= $net ?></td> 
					<td><?= (!empty($main_gate)) ? '#'.$main_gate : ' - ' ?></td> 
					<td>
						<?= $this->Form->control('statesx_days.'.$j.'.status',['label'=>false, 'options'=>[1 => 'Alerta verde', 2 => 'Alerta amarillo', 3 => 'Alerta naranja', 4 => 'Alerta rojo'], 'class'=>'status']) ?>
						<?= $this->Form->hidden('statesx_days.'.$j.'.date',['value'=>date('Y-m-d')]) ?>
						<?= $this->Form->hidden('statesx_days.'.$j.'.hour',['value'=>date('H:i:s')]) ?>
						<?= $this->Form->hidden('statesx_days.'.$j.'.user_id',['value'=>$user->id]) ?>
					</td>
					<td>
						<?= $this->Form->checkbox($j.'.users.isolated',['value'=>true,'hiddenField' => false, 'class' => 'isolated']) ?>
						<?= $this->Form->hidden($j.'.users.id',['value'=>$user->id]) ?>
					</td>
				</tr>
				<?php
						$j++;
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
		status = $(this).val();
		$('.status').val(status);
		if(status=="1" || status=="3") $('#selectEVent').show();
		else $('#selectEVent').hide();
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
$(function(){
    $(document).ready(function() {  
		$('.input_oculto').hide();
	});
});
</script>