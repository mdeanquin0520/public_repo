<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>
<div class="users index content">
    <?php
		if(!empty($checkUA1) || !empty($checkUA2)) echo $this->Html->link(__('Agregar usuario'), ['action' => 'add'], ['class' => 'button float-right']);
		echo $this->Form->create(null, ['valueSources' => 'query']);
		echo $this->Form->control('search', ['label' => 'Buscar', 'placeholder' => 'Buscar por nombre de usuario o e-mail']);
		echo $this->Form->button(__('Buscar'), ['class' => 'btn btn-primary']);
		if (!empty($_isSearch)) {
			echo ' ';
			echo $this->Html->link(__('Reset'), ['action' => 'index', '?' => array_intersect_key($this->request->getQuery(), array_flip(['sort', 'direction']))], ['class' => 'btn btn-default']);
		}
		echo $this->Form->end();
	?>
    <h3><?= __('Usuarios') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('image_file_name_url', 'Foto de perfil') ?></th>
                    <th><?= $this->Paginator->sort('username', 'Nombre de usuario') ?></th>
                    <th><?= $this->Paginator->sort('email', 'E-mail') ?></th>
                    <th><?= $this->Paginator->sort('firstname', 'Nombre') ?></th>
                    <th><?= $this->Paginator->sort('lastname', 'Apellido') ?></th>
                    <th><?= $this->Paginator->sort('created', 'Creado') ?></th>
                    <th><?= $this->Paginator->sort('modified', 'Modificado') ?></th>
                    <th><?= $this->Paginator->sort('profile_id', 'Perfil') ?></th>
                    <th><?= $this->Paginator->sort('group_id', 'Célula') ?></th>
                    <th><?= $this->Paginator->sort('net_id', 'Unidad funcional') ?></th>
                    <th><?= $this->Paginator->sort('main_gate', 'Nodo') ?></th>
                    <th><?= $this->Paginator->sort('referrer_id', 'Referente') ?></th>
                    <th><?= $this->Paginator->sort('active', 'Activo') ?></th>
                    <th><?= $this->Paginator->sort('map_lat', 'Latitud') ?></th>
                    <th><?= $this->Paginator->sort('map_long', 'Longitud') ?></th>
                    <th><?= $this->Paginator->sort('Estado') ?></th>
                    <th><?= $this->Paginator->sort('Aislado') ?></th>
                    <th class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
					foreach ($users as $user):
						$color = '';
						switch ($user->profile_id) {
							case '1':
								$color = '#000000';
								break;
							case '2':
								$color = '#041d54';
								break;
							case '3':
								$color = '#540404';
								break;
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
						$colorAlert = '';
						switch($user->status){
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
						$group = "";
						$net = "";
						$gate = "";
						if($user->has("groups_users")):
							foreach ($user->groups_users as $group_user):
								$mostrarGroup = (!empty($checkGV1) || !empty($checkGV2) || !empty($checkGV3) || !empty($checkGV4) || !empty($checkGV5)) ? 
									$this->Html->link($group_user->group->group_name, ['controller' => 'Groups', 'action' => 'view', $group_user->group->id]) : 
									h($group_user->group->group_name);
								$group .= $this->Html->tag("p", $mostrarGroup);
								if(!empty($group_user->net_id)){
									$net = (!empty($checkNV1) || !empty($checkNV2) || !empty($checkNV3) || !empty($checkNV4) || !empty($checkNV5)) ? 
										$this->Html->link($group_user->net->net_name, ['controller' => 'Nets', 'action' => 'view', 
										$group_user->net_id]) : h($group_user->net->net_name);
								}
								$gate = $group_user->main_gate;
							endforeach;
						endif;
				?>
                <tr>
                    <td><?= $user->image_file_name_url === null ? '' : $this->Html->image($user->image_file_name_url, ['class' => 'img-circle']) ?></td>
                    <td><?= h($user->username) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td><?= h($user->firstname) ?></td>
                    <td><?= h($user->lastname) ?></td>
                    <td><?= h($user->created) ?></td>
                    <td><?= h($user->modified) ?></td>
                    <td style="background-color:<?= $color ?>;color:#fff"><?= $user->has('profile') ? !empty($checkPrV1) || !empty($checkPrV2) || 
						!empty($checkPrV3) || !empty($checkPrV4) || !empty($checkPrV5) ? $this->Html->link($user->profile->name, ['controller' => 'Profiles', 
						'action' => 'view', $user->profile->id]) : h($user->profile->name) : '' ?></td>
					<td><?= (!empty($group)) ? $group : '' ?></td>
                    <td><?= (!empty($net)) ? $net : '' ?></td>
                    <td><?= (!empty($gate)) ? h($gate) : '' ?></td>
                    <td><?= $user->has('referrer') ? !empty($checkUV1) || !empty($checkUV2) || !empty($checkUV3) || !empty($checkUV4) || !empty($checkUV5) ?
							$this->Html->link($user->referrer->full_name, ['controller' => 'Users', 'action' => 'view', $user->referrer->id]) :
							h($user->referrer->full_name) : '' ?></td>
                    <td><?= h($user->active) ?></td>
                    <td><?= $user->map_lat === null ? '' : $this->Number->format($user->map_lat) ?></td>
                    <td><?= $user->map_long === null ? '' : $this->Number->format($user->map_long) ?></td>
                    <td style="background-color:<?= $colorAlert ?>;"><?php echo $statusAlertEnum[$user->status]; ?></td> 
                    <td><?= $user->isolated === null ? '' : $this->Number->format($user->isolated) ?></td>
                    <td class="actions">
                        <?= !empty($checkUC1) || !empty($checkUC2) ? $this->Html->link($this->Html->tag("span", "", ['class'=>'glyphicon glyphicon-user']), 
								['action' => 'changepassword', $user->id], ['escape' => false, 'title' => 'Cambiar contraseña']) : '' ?>
						<?= !empty($checkUS1) || !empty($checkUS2) ? $this->Html->link($this->Html->tag("span", "", ['class'=>'glyphicon glyphicon-globe']), 
								['action' => 'setgeo', $user->id], ['escape' => false, 'title' => 'Setear geolocalización']) : '' ?>
                        <?= !empty($checkUV1) || !empty($checkUV2) || !empty($checkUV3) || !empty($checkUV4) || !empty($checkUV5) ?
								$this->Html->link($this->Html->tag("span", "", ['class'=>'glyphicon glyphicon-search']), ['action' => 'view', $user->id], 
								['escape' => false, 'title' => 'Ver']) : '' ?>
                        <?= !empty($checkUE1) || !empty($checkUE2) ? $this->Html->link($this->Html->tag("span", "", ['class'=>'glyphicon glyphicon-edit']), 
								['action' => 'edit', $user->id], ['escape' => false, 'title' => 'Editar']) : '' ?>
                        <?= !empty($checkUD1) || !empty($checkUD2) ? $this->Form->postLink($this->Html->tag("span", "", ['class'=>'glyphicon glyphicon-remove']), 
								['action' => 'delete', $user->id], ['confirm' => __('Está seguro que desea eliminar a {0}?', $user->full_name), 'escape' => false, 
								'title' => 'Eliminar']) : '' ?>
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
