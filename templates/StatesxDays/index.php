<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\StatesxDay> $statesxDays
 */
?>
<div class="statesxDays index content">
	<?php
		if($viewUser["isNetCoordinator"]){
			if(!empty($checkSDAu1) || !empty($checkSDAu2)) echo $this->Html->link('Modificar estado a usuarios',['action'=>'addUser'],['class' => 'button float-right']);
			if(!empty($checkSDAp1) || !empty($checkSDAp2)) echo $this->Html->link('Modificar estado a pacientes',['action'=>'addPacient'],['class' => 'button float-right']);
		}
	?>
    <h3><?= __('Estados de Alerta') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('user_id', 'Usuario') ?></th>
                    <th><?= $this->Paginator->sort('group_id', 'Célula') ?></th>
                    <th><?= $this->Paginator->sort('net_id', 'Unidad funcional') ?></th>
                    <th><?= $this->Paginator->sort('main_gate', 'Nodo') ?></th>
                    <th><?= $this->Paginator->sort('pacient_id', 'Paciente') ?></th>
                    <th><?= $this->Paginator->sort('date', 'Fecha') ?></th>
                    <th><?= $this->Paginator->sort('hour', 'Hora') ?></th>
                    <th><?= $this->Paginator->sort('status', 'Estado') ?></th>
                    <th><?= $this->Paginator->sort('created', 'Creado') ?></th>
                    <th><?= $this->Paginator->sort('modified', 'Modificado') ?></th>
                    <th class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
					foreach ($statesxDays as $statesxDay):
						$colorAlert = '';
						switch($statesxDay->status){
							case 1: $colorAlert = '#18FE00';
								break;
							case 2: $colorAlert = '#FFFF00';
								break;
							case 3: $colorAlert = '#FF8000';
								break;
							case 4: $colorAlert = '#FF0000';
								break;
							default: $colorAlert = '#FFFFFF';
								break;
						}
				?>
                <tr>
                    <td><?= $statesxDay->has('user') ? !empty($checkUV1) || !empty($checkUV2) || !empty($checkUV3) || !empty($checkUV4) || !empty($checkUV5) ?
							$this->Html->link($statesxDay->user->full_name, ['controller' => 'Users', 'action' => 'view', $statesxDay->user->id]) :
							h($statesxDay->user->full_name) : '' ?></td>
                    <td><?= $statesxDay->has('group') ? !empty($checkGV1) || !empty($checkGV2) || !empty($checkGV3) || !empty($checkGV4) || !empty($checkGV5) ?
							$this->Html->link($statesxDay->group->group_name, ['controller' => 'Groups', 'action' => 'view', $statesxDay->group->id]) :
							h($statesxDay->group->group_name) : '' ?></td>
                    <td><?= $statesxDay->has('net') ? !empty($checkNV1) || !empty($checkNV2) || !empty($checkNV3) || !empty($checkNV4) || !empty($checkNV5) ?
							$this->Html->link($statesxDay->net->net_name, ['controller' => 'Nets', 'action' => 'view', $statesxDay->net->id]) :
							h($statesxDay->net->net_name) : '' ?></td>
                    <td><?= h($statesxDay->main_gate) ?></td>
                    <td><?= $statesxDay->has('pacient') ? !empty($checkPV1) || !empty($checkPV2) || !empty($checkPV3) || !empty($checkPV4) || !empty($checkPV5) ?
							$this->Html->link($statesxDay->pacient->full_name, ['controller' => 'Pacients', 'action' => 'view', $statesxDay->pacient->id]) :
							h($statesxDay->pacient->full_name) : '' ?></td>
                    <td><?= h($statesxDay->date) ?></td>
                    <td><?= h($statesxDay->hour) ?></td>
                    <td style="background-color:<?= $colorAlert ?>"><?= $statusAlertEnum[$statesxDay->status] ?></td>
                    <td><?= h($statesxDay->created) ?></td>
                    <td><?= h($statesxDay->modified) ?></td>
                    <td class="actions">
                        <?= !empty($checkSDV1) || !empty($checkSDV2) || !empty($checkSDV3) || !empty($checkSDV4) || !empty($checkSDV5) ?
								$this->Html->link($this->Html->tag("span", "", ['class'=>'glyphicon glyphicon-search']), ['action' => 'view', $statesxDay->id], 
								['escape' => false, 'title' => 'Ver']) : '' ?>
                        <?= !empty($checkSDD1) || !empty($checkSDD2) ? $this->Form->postLink($this->Html->tag("span", "", ['class'=>'glyphicon glyphicon-remove']), 
								['action' => 'delete', $statesxDay->id], ['confirm' => __('¿Está seguro que desea eliminar este estado de alerta?'), 
								'escape' => false, 'title' => 'Eliminar']) : '' ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('Primera')) ?>
            <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Siguiente') . ' >') ?>
            <?= $this->Paginator->last(__('Última') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Página {{page}} de {{pages}}, mostrando {{current}} registro(s) de {{count}}')) ?></p>
    </div>
</div>
