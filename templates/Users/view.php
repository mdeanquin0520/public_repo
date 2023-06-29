<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <div class="column-responsive column-80">
        <div class="users view content">
            <h3><?= h($user->full_name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nombre de usuario') ?></th>
                    <td><?= h($user->username) ?></td>
                </tr>
                <tr>
                    <th><?= __('E-mail') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nombre') ?></th>
                    <td><?= h($user->firstname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Apellido') ?></th>
                    <td><?= h($user->lastname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Perfil') ?></th>
                    <td><?= $user->has('profile') ? !empty($checkPrV1) || !empty($checkPrV2) || !empty($checkPrV3) || !empty($checkPrV4) || !empty($checkPrV5) ?
							$this->Html->link($user->profile->name, ['controller' => 'Profiles', 'action' => 'view', $user->profile->id]) :
							h($user->profile->name) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Referente') ?></th>
                    <td><?= $user->has('referrer') ? !empty($checkUV1) || !empty($checkUV2) || !empty($checkUV3) || !empty($checkUV4) || !empty($checkUV5) ?
							$this->Html->link($user->referrer->full_name, ['controller' => 'Users', 'action' => 'view', $user->referrer->id]) :
							h($user->referrer->full_name) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Foto de perfil') ?></th>
                    <td><?= $this->Html->image($user->image_file_name_url, ['title' => $user->image_file_name_filename, 'class' => 'img-circle']) ?></td>
                </tr>
                <tr>
                    <th><?= __('Creado') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modificado') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Activo') ?></th>
                    <td><?= $user->active ? __('Sí') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Eventos Relacionados') ?></h4>
                <?php if (!empty($user->events)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Descripción') ?></th>
                            <th><?= __('Célula') ?></th>
                            <th><?= __('Unidad funcional') ?></th>
                            <th><?= __('Nodo') ?></th>
                            <th><?= __('Agenda') ?></th>
                            <th><?= __('Estado') ?></th>
                            <th><?= __('Creado') ?></th>
                            <th><?= __('Modificado') ?></th>
                            <th class="actions"><?= __('Acciones') ?></th>
                        </tr>
                        <?php foreach ($user->events as $events) : ?>
                        <tr>
                            <td><?= h($events->id) ?></td>
                            <td><?= h($events->description) ?></td>
                            <td><?= h($events->group_id) ?></td>
                            <td><?= h($events->net_id) ?></td>
                            <td><?= h($events->main_gate) ?></td>
                            <td><?= h($events->schedule_id) ?></td>
                            <td><?= h($events->state) ?></td>
                            <td><?= h($events->created) ?></td>
                            <td><?= h($events->modified) ?></td>
                            <td class="actions">
                                <?= !empty($checkEV1) || !empty($checkEV2) || !empty($checkEV3) || !empty($checkEV4) || !empty($checkEV5) ?
										$this->Html->link($this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-search']), 
										['controller' => 'Events', 'action' => 'view', $events->id], ['escape' => false, 'title' => 'Ver']) : '' ?>
                                <?= !empty($checkEE1) || !empty($checkEE2) ? $this->Html->link($this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-edit']), 
										['controller' => 'Events', 'action' => 'edit', $events->id], ['escape' => false, 'title' => 'Editar']) : '' ?>
                                <?= !empty($checkED1) || !empty($checkED2) ? $this->Form->postLink($this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-remove']), 
										['controller' => 'Events', 'action' => 'delete', $events->id], ['confirm' => __('¿Está seguro que desea eliminar {0}?', 
										$events->description), 'escape' => false, 'title' => 'Eliminar']) : '' ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Células Relacionadas') ?></h4>
                <?php if (!empty($user->groups)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Nombre') ?></th>
                            <th><?= __('Creada') ?></th>
                            <th><?= __('Modificada') ?></th>
                            <th class="actions"><?= __('Acciones') ?></th>
                        </tr>
                        <?php foreach ($user->groups as $groups) : ?>
                        <tr>
                            <td><?= h($groups->group_name) ?></td>
                            <td><?= h($groups->created) ?></td>
                            <td><?= h($groups->modified) ?></td>
                            <td class="actions">
                                <?= !empty($checkGV1) || !empty($checkGV2) || !empty($checkGV3) || !empty($checkGV4) || !empty($checkGV5) ?
										$this->Html->link($this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-search']), 
										['controller' => 'Groups', 'action' => 'view', $groups->id], ['escape' => false, 'title' => 'Ver']) : '' ?>
                                <?= !empty($checkGE1) || !empty($checkGE2) ? $this->Html->link($this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-edit']), 
										['controller' => 'Groups', 'action' => 'edit', $groups->id], ['escape' => false, 'title' => 'Editar']) : '' ?>
                                <?= !empty($checkGD1) || !empty($checkGD2) ? $this->Form->postLink($this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-remove']), 
										['controller' => 'Groups', 'action' => 'delete', $groups->id], ['confirm' => __('¿Está seguro que desea eliminar {0}?', 
										$groups->group_name), 'escape' => false, 'title' => 'Eliminar']) : '' ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Stocks Relacionados') ?></h4>
                <?php if (!empty($user->stocks)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Insumo') ?></th>
                            <th><?= __('Cantidad') ?></th>
                            <th><?= __('Creado') ?></th>
                            <th><?= __('Modificado') ?></th>
                            <th class="actions"><?= __('Acciones') ?></th>
                        </tr>
                        <?php foreach ($user->stocks as $stocks) : ?>
                        <tr>
                            <td><?= h($stocks->supply_id) ?></td>
                            <td><?= h($stocks->quantity) ?></td>
                            <td><?= h($stocks->created) ?></td>
                            <td><?= h($stocks->modified) ?></td>
                            <td class="actions">
                                <?= !empty($checkStV1) || !empty($checkStV2) || !empty($checkStV3) || !empty($checkStV4) || !empty($checkStV5) ?
										$this->Html->link($this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-search']), 
										['controller' => 'Stocks', 'action' => 'view', $stocks->id], ['escape' => false, 'title' => 'Ver']) : '' ?>
                                <?= !empty($checkStD1) || !empty($checkStD2) ? $this->Form->postLink($this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-remove']), 
										['controller' => 'Stocks', 'action' => 'delete', $stocks->id], 
										['confirm' => __('¿Está seguro que desea eliminar este stock?'), 'escape' => false, 'title' => 'Eliminar']) : '' ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Observaciones Relacionadas') ?></h4>
                <?php if (!empty($user->observations)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Fecha') ?></th>
                            <th><?= __('Descripción') ?></th>
                            <th><?= __('Paciente') ?></th>
                            <th><?= __('Usuario') ?></th>
                            <th><?= __('Estado') ?></th>
                            <th><?= __('Pregunta #1') ?></th>
                            <th><?= __('Pregunta #2') ?></th>
                            <th><?= __('Pregunta #3') ?></th>
                            <th><?= __('Creada') ?></th>
                            <th><?= __('Modificada') ?></th>
                            <th class="actions"><?= __('Acciones') ?></th>
                        </tr>
                        <?php foreach ($user->observations as $observations) : ?>
                        <tr>
                            <td><?= h($observations->id) ?></td>
                            <td><?= h($observations->date) ?></td>
                            <td><?= h($observations->description) ?></td>
                            <td><?= h($observations->pacient_id) ?></td>
                            <td><?= h($observations->user_id) ?></td>
                            <td><?= h($observations->status) ?></td>
                            <td><?= h($observations->question_1) ?></td>
                            <td><?= h($observations->question_2) ?></td>
                            <td><?= h($observations->question_3) ?></td>
                            <td><?= h($observations->created) ?></td>
                            <td><?= h($observations->modified) ?></td>
                            <td class="actions">
                                <?= !empty($checkOV1) || !empty($checkOV2) || !empty($checkOV3) || !empty($checkOV4) || !empty($checkOV5) ?
										$this->Html->link($this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-search']), 
										['controller' => 'Observations', 'action' => 'view', $observations->id], ['escape' => false, 'title' => 'Ver']) : '' ?>
                                <?= !empty($checkOE1) || !empty($checkOE2) ? $this->Html->link($this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-edit']), 
										['controller' => 'Observations', 'action' => 'edit', $observations->id], ['escape' => false, 'title' => 'Editar']) : '' ?>
                                <?= !empty($checkOD1) || !empty($checkOD2) ? $this->Form->postLink($this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-remove']), 
										['controller' => 'Observations', 'action' => 'delete', $observations->id], 
										['confirm' => __('¿Está seguro que desea eliminar esta observación?'), 'escape' => false, 'title' => 'Eliminar']) : '' ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Pacientes Relacionados') ?></h4>
                <?php if (!empty($user->pacients)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Nombre') ?></th>
                            <th><?= __('Apellido') ?></th>
                            <th><?= __('Fecha de nacimiento') ?></th>
                            <th><?= __('Teléfono') ?></th>
                            <th><?= __('Teléfono del Contacto') ?></th>
                            <th><?= __('Nombre completo del Contacto') ?></th>
                            <th><?= __('Dirección') ?></th>
                            <th><?= __('Institución') ?></th>
                            <th><?= __('Usuario') ?></th>
                            <th><?= __('Unidad funcional') ?></th>
                            <th><?= __('Célula') ?></th>
                            <th><?= __('Nodo') ?></th>
                            <th><?= __('Estado') ?></th>
                            <th><?= __('Estado de Alerta') ?></th>
                            <th><?= __('Aislado') ?></th>
                            <th><?= __('Inmunización influenza') ?></th>
                            <th><?= __('Inmunización neumococo') ?></th>
                            <th><?= __('Creado') ?></th>
                            <th><?= __('Modificado') ?></th>
                            <th><?= __('Latitud') ?></th>
                            <th><?= __('Longitud') ?></th>
                            <th class="actions"><?= __('Acciones') ?></th>
                        </tr>
                        <?php foreach ($user->pacients as $pacients) : ?>
                        <tr>
                            <td><?= h($pacients->id) ?></td>
                            <td><?= h($pacients->name) ?></td>
                            <td><?= h($pacients->lastname) ?></td>
                            <td><?= h($pacients->birthday) ?></td>
                            <td><?= h($pacients->phone) ?></td>
                            <td><?= h($pacients->contact_phone) ?></td>
                            <td><?= h($pacients->contact_fullname) ?></td>
                            <td><?= h($pacients->address) ?></td>
                            <td><?= h($pacients->institution_id) ?></td>
                            <td><?= h($pacients->user_id) ?></td>
                            <td><?= h($pacients->net_id) ?></td>
                            <td><?= h($pacients->group_id) ?></td>
                            <td><?= h($pacients->main_gate) ?></td>
                            <td><?= h($pacients->status) ?></td>
                            <td><?= h($pacients->statusAlert) ?></td>
                            <td><?= h($pacients->isolated) ?></td>
                            <td><?= h($pacients->inmunity_a) ?></td>
                            <td><?= h($pacients->inmunity_b) ?></td>
                            <td><?= h($pacients->created) ?></td>
                            <td><?= h($pacients->modified) ?></td>
                            <td><?= h($pacients->map_lat) ?></td>
                            <td><?= h($pacients->map_long) ?></td>
                            <td class="actions">
								<?= !empty($checkPS1) || !empty($checkPS2) ? $this->Html->link($this->Html->tag("span", "", ['class'=>'glyphicon glyphicon-globe']), 
										['controller' => 'Pacients', 'action' => 'setgeo', $pacients->id], ['escape' => false, 'title' => 'Setear geolocalización']) : '' ?>
								<?= !empty($checkPV1) || !empty($checkPV2) || !empty($checkPV3) || !empty($checkPV4) || !empty($checkPV5) ? 
										$this->Html->link($this->Html->tag("span", "", ['class'=>'glyphicon glyphicon-search']), ['controller' => 'Pacients', 'action' => 'view', $pacients->id], 
										['escape' => false, 'title' => 'Ver']) : '' ?>
								<?= !empty($checkPE1) || !empty($checkPE2) ? $this->Html->link($this->Html->tag("span", "", ['class'=>'glyphicon glyphicon-edit']), 
										['controller' => 'Pacients', 'action' => 'edit', $pacients->id], ['escape' => false, 'title' => 'Editar']) : '' ?>
								<?= !empty($checkPD1) || !empty($checkPD2) ? $this->Form->postLink($this->Html->tag("span", "", ['class'=>'glyphicon glyphicon-remove']), 
										['controller' => 'Pacients', 'action' => 'delete', $pacients->id], ['confirm' => __('Está seguro que desea eliminar a {0}?', $pacient->full_name), 
										'escape' => false, 'title' => 'Eliminar']) : '' ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Estados de Alerta Relacionados') ?></h4>
                <?php if (!empty($user->statesx_days)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Usuario') ?></th>
                            <th><?= __('Célula') ?></th>
                            <th><?= __('Unidad funcional') ?></th>
                            <th><?= __('Nodo') ?></th>
                            <th><?= __('Paciente') ?></th>
                            <th><?= __('Fecha') ?></th>
                            <th><?= __('Hora') ?></th>
                            <th><?= __('Estado') ?></th>
                            <th><?= __('Creado') ?></th>
                            <th><?= __('Modificado') ?></th>
                            <th class="actions"><?= __('Acciones') ?></th>
                        </tr>
                        <?php foreach ($user->statesx_days as $statesxDays) : ?>
                        <tr>
                            <td><?= h($statesxDays->user_id) ?></td>
                            <td><?= h($statesxDays->group_id) ?></td>
                            <td><?= h($statesxDays->net_id) ?></td>
                            <td><?= h($statesxDays->main_gate) ?></td>
                            <td><?= h($statesxDays->pacient_id) ?></td>
                            <td><?= h($statesxDays->date) ?></td>
                            <td><?= h($statesxDays->hour) ?></td>
                            <td><?= h($statesxDays->status) ?></td>
                            <td><?= h($statesxDays->created) ?></td>
                            <td><?= h($statesxDays->modified) ?></td>
                            <td class="actions">
                                <?= !empty($checkSDV1) || !empty($checkSDV2) || !empty($checkSDV3) || !empty($checkSDV4) || !empty($checkSDV5) ?
										$this->Html->link($this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-search']), 
										['controller' => 'StatesxDays', 'action' => 'view', $statesxDays->id], ['escape' => false, 'title' => 'Ver']) : '' ?>
                                <?= !empty($checkSDD1) || !empty($checkSDD2) ? $this->Form->postLink($this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-remove']), 
										['controller' => 'StatesxDays', 'action' => 'delete', $statesxDays->id], 
										['confirm' => __('¿Está seguro que desea eliminar este estado de alerta?'), 'escape' => false, 'title' => 'Eliminar']) : '' ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Estados de Células Relacionados') ?></h4>
                <?php if (!empty($user->status_groups)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Paciente') ?></th>
                            <th><?= __('Fecha de nacimiento') ?></th>
                            <th><?= __('Célula') ?></th>
                            <th><?= __('Unidad funcional') ?></th>
                            <th><?= __('Nodo') ?></th>
                            <th><?= __('Usuario') ?></th>
                            <th><?= __('Estado') ?></th>
                            <th><?= __('Inmunización influenza') ?></th>
                            <th><?= __('Fecha de Inmunización influenza') ?></th>
                            <th><?= __('Inmunización neumococo') ?></th>
                            <th><?= __('Fecha de Inmunización neumococo') ?></th>
                            <th><?= __('Isopado') ?></th>
                            <th><?= __('Fecha de Isopado') ?></th>
                            <th><?= __('Globulina M') ?></th>
                            <th><?= __('Fecha de Globulina M') ?></th>
                            <th><?= __('Globulina G') ?></th>
                            <th><?= __('Fecha de Globulina G') ?></th>
                            <th><?= __('Polimerasa') ?></th>
                            <th><?= __('Fecha de Polimerasa') ?></th>
                            <th><?= __('Infectado') ?></th>
                            <th><?= __('Recuperado') ?></th>
                            <th><?= __('Muerto') ?></th>
                            <th><?= __('Alta Médica') ?></th>
                            <th><?= __('Fecha de Célula') ?></th>
                            <th><?= __('Creado') ?></th>
                            <th><?= __('Modificado') ?></th>
                            <th><?= __('Latitud') ?></th>
                            <th><?= __('Longitud') ?></th>
                            <th><?= __('Cron') ?></th>
                            <th class="actions"><?= __('Acciones') ?></th>
                        </tr>
                        <?php foreach ($user->status_groups as $statusGroups) : ?>
                        <tr>
                            <td><?= h($statusGroups->id) ?></td>
                            <td><?= h($statusGroups->pacient_id) ?></td>
                            <td><?= h($statusGroups->birthday) ?></td>
                            <td><?= h($statusGroups->group_id) ?></td>
                            <td><?= h($statusGroups->net_id) ?></td>
                            <td><?= h($statusGroups->main_gate) ?></td>
                            <td><?= h($statusGroups->user_id) ?></td>
                            <td><?= h($statusGroups->status) ?></td>
                            <td><?= h($statusGroups->inmunity_a) ?></td>
                            <td><?= h($statusGroups->date_inmunity_a) ?></td>
                            <td><?= h($statusGroups->inmunity_b) ?></td>
                            <td><?= h($statusGroups->date_inmunity_b) ?></td>
                            <td><?= h($statusGroups->swabbed) ?></td>
                            <td><?= h($statusGroups->date_swabbed) ?></td>
                            <td><?= h($statusGroups->globulin_m) ?></td>
                            <td><?= h($statusGroups->date_globulin_m) ?></td>
                            <td><?= h($statusGroups->globulin_g) ?></td>
                            <td><?= h($statusGroups->date_globulin_g) ?></td>
                            <td><?= h($statusGroups->polymerase) ?></td>
                            <td><?= h($statusGroups->date_polymerase) ?></td>
                            <td><?= h($statusGroups->infected) ?></td>
                            <td><?= h($statusGroups->recovered) ?></td>
                            <td><?= h($statusGroups->dead) ?></td>
                            <td><?= h($statusGroups->medical_discharge) ?></td>
                            <td><?= h($statusGroups->date_group) ?></td>
                            <td><?= h($statusGroups->created) ?></td>
                            <td><?= h($statusGroups->modified) ?></td>
                            <td><?= h($statusGroups->map_lat) ?></td>
                            <td><?= h($statusGroups->map_long) ?></td>
                            <td><?= h($statusGroups->cron) ?></td>
                            <td class="actions">
                                <?= !empty($checkSGV1) || !empty($checkSGV2) || !empty($checkSGV3) || !empty($checkSGV4) || !empty($checkSGV5) ?
										$this->Html->link($this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-search']), 
										['controller' => 'StatusGroups', 'action' => 'view', $statusGroups->id], ['escape' => false, 'title' => 'Ver']) : '' ?>
                                <?= !empty($checkSGE1) || !empty($checkSGE2) ? $this->Html->link($this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-edit']), 
										['controller' => 'StatusGroups', 'action' => 'edit', $statusGroups->id], ['escape' => false, 'title' => 'Editar']) : '' ?>
                                <?= !empty($checkSGD1) || !empty($checkSGD2) ? $this->Form->postLink($this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-remove']), 
										['controller' => 'StatusGroups', 'action' => 'delete', $statusGroups->id], 
										['confirm' => __('¿Está seguro que desea eliminar este estado de célula?'), 'escape' => false, 'title' => 'Eliminar']) : '' ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Turnos Relacionados') ?></h4>
                <?php if (!empty($user->turns)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Paciente') ?></th>
                            <th><?= __('Agente') ?></th>
                            <th><?= __('Célula') ?></th>
                            <th><?= __('Unidad funcional') ?></th>
                            <th><?= __('Nodo') ?></th>
                            <th><?= __('Fecha') ?></th>
                            <th><?= __('Hora') ?></th>
                            <th><?= __('Fecha próxima visita') ?></th>
                            <th><?= __('Hora próxima visita') ?></th>
                            <th><?= __('Usuario') ?></th>
                            <th><?= __('Evento') ?></th>
                            <th><?= __('Estado') ?></th>
                            <th><?= __('Creado') ?></th>
                            <th><?= __('Modificado') ?></th>
                            <th class="actions"><?= __('Acciones') ?></th>
                        </tr>
                        <?php foreach ($user->turns as $turns) : ?>
                        <tr>
                            <td><?= h($turns->id) ?></td>
                            <td><?= h($turns->pacient_id) ?></td>
                            <td><?= h($turns->doctor_id) ?></td>
                            <td><?= h($turns->group_id) ?></td>
                            <td><?= h($turns->net_id) ?></td>
                            <td><?= h($turns->main_gate) ?></td>
                            <td><?= h($turns->date) ?></td>
                            <td><?= h($turns->hour) ?></td>
                            <td><?= h($turns->return_date) ?></td>
                            <td><?= h($turns->return_time) ?></td>
                            <td><?= h($turns->user_id) ?></td>
                            <td><?= h($turns->event_id) ?></td>
                            <td><?= h($turns->status) ?></td>
                            <td><?= h($turns->created) ?></td>
                            <td><?= h($turns->modified) ?></td>
                            <td class="actions">
                                <?= !empty($checkTV1) || !empty($checkTV2) || !empty($checkTV3) || !empty($checkTV4) || !empty($checkTV5) ?
										$this->Html->link($this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-search']), 
										['controller' => 'Turns', 'action' => 'view', $turns->id], ['escape' => false, 'title' => 'Ver']) : '' ?>
                                <?= !empty($checkTE1) || !empty($checkTE2) ? $this->Html->link($this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-edit']), 
										['controller' => 'Turns', 'action' => 'edit', $turns->id], ['escape' => false, 'title' => 'Editar']) : '' ?>
                                <?= !empty($checkTD1) || !empty($checkTD2) ? $this->Form->postLink($this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-remove']), 
										['controller' => 'Turns', 'action' => 'delete', $turns->id], ['confirm' => __('¿Está seguro que desea eliminar este turno?'),
										'escape' => false, 'title' => 'Eliminar']) : '' ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
