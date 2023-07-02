<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StatesxDay $statesxDay
 */
?>
<div class="row">
    <div class="column-responsive column-80">
        <div class="statesxDays view content">
            <h3><?= h($statesxDay->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Usuario') ?></th>
                    <td><?= $statesxDay->has('user') ? !empty($checkUV1) || !empty($checkUV2) || !empty($checkUV3) || !empty($checkUV4) || !empty($checkUV5) ?
							$this->Html->link($statesxDay->user->full_name, ['controller' => 'Users', 'action' => 'view', $statesxDay->user->id]) :
							h($statesxDay->user->full_name) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Célula') ?></th>
                    <td><?= $statesxDay->has('group') ? !empty($checkGV1) || !empty($checkGV2) || !empty($checkGV3) || !empty($checkGV4) || !empty($checkGV5) ?
							$this->Html->link($statesxDay->group->group_name, ['controller' => 'Groups', 'action' => 'view', $statesxDay->group->id]) :
							h($statesxDay->group->group_name) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Unidad funcional') ?></th>
                    <td><?= $statesxDay->has('net') ? !empty($checkNV1) || !empty($checkNV2) || !empty($checkNV3) || !empty($checkNV4) || !empty($checkNV5) ?
							$this->Html->link($statesxDay->net->net_name, ['controller' => 'Nets', 'action' => 'view', $statesxDay->net->id]) :
							h($statesxDay->net->net_name) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Nodo') ?></th>
                    <td><?= h($statesxDay->main_gate) ?></td>
                </tr>
                <tr>
                    <th><?= __('Paciente') ?></th>
                    <td><?= $statesxDay->has('pacient') ? !empty($checkPV1) || !empty($checkPV2) || !empty($checkPV3) || !empty($checkPV4) || !empty($checkPV5) ?
							$this->Html->link($statesxDay->pacient->name, ['controller' => 'Pacients', 'action' => 'view', $statesxDay->pacient->id]) :
							h($statesxDay->pacient->name) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Estado') ?></th>
                    <td><?= $this->Number->format($statesxDay->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fecha') ?></th>
                    <td><?= h($statesxDay->date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hora') ?></th>
                    <td><?= h($statesxDay->hour) ?></td>
                </tr>
                <tr>
                    <th><?= __('Creado') ?></th>
                    <td><?= h($statesxDay->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modificado') ?></th>
                    <td><?= h($statesxDay->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
