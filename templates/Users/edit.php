<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var string[]|\Cake\Collection\CollectionInterface $profiles
 * @var string[]|\Cake\Collection\CollectionInterface $referrer
 * @var string[]|\Cake\Collection\CollectionInterface $groups
 */
?>
<div class="row">
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Editar Usuario') ?></legend>
                <?php
                    echo $this->Form->control('username', ['label' => 'Nombre de usuario']);
                    echo $this->Form->control('email', ['label' => 'E-mail']);
                    echo $this->Form->control('firstname', ['label' => 'Nombre']);
                    echo $this->Form->control('lastname', ['label' => 'Apellido']);
                    echo $this->Form->control('profile_id', ['label' => 'Perfil', 'options' => $profiles, 'empty' => '-- Seleccione un perfil --', 'id' => 'profileId']);
                    echo $this->Form->control('referrer_id', ['label' => 'Referente', 'options' => $referrer, 'empty' => '-- Seleccione un referente --']);
                    echo $this->Form->control('image_file_name_url', ['label' => 'Foto de perfil', 'type' => 'file']);
                    echo $this->Form->control('active', ['label' => 'Activo']);
					echo '<div id="selectGroup" style="display:none;">'.$this->Form->control('groups._ids', ['label' => 'Célula', 'options' => $groups, 'empty' => '-- Seleccione una célula --', 'id' => 'groupsId']).'</div>';
                    echo '<div id="selectNet" style="display:none;">'.$this->Form->control('groups.0._joinData.net_id', ['label' => 'Unidad funcional', 'id' => 'netId']).'</div>';
                    echo '<div id="selectGate" style="display:none;">'.$this->Form->control('groups.0._joinData.main_gate', ['label' => 'Nodo', 'options' => ['A' => 'A', 'B' => 'B'], 'empty' => '-- Seleccione un nodo --']).'</div>';
                ?>
            </fieldset>
            <?= $this->Form->button(__('Guardar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
$(function(){
	$('#profileId').change(function(){
		profile_id=$(this).val();
		switch (profile_id) {
			case "1": $('#selectGroup').hide();$('#selectNet').hide();$('#selectGate').hide();
				break;
			case "2": $('#selectGroup').hide();$('#selectNet').hide();$('#selectGate').hide();
				break;
			case "3": $('#selectGroup').show();$('#selectNet').hide();$('#selectGate').hide();
				$('#groupsId').prop('multiple', 'multiple');
				$('#groupsId').addClass('select-multiple');
				break;
			case "4": $('#selectGroup').show();$('#selectNet').show();$('#selectGate').hide();
				$('#groupsId').prop('multiple', false);
				$('#groupsId').removeClass('select-multiple');
				break;
			case "5": $('#selectGroup').show();$('#selectNet').show();$('#selectGate').show();
				$('#groupsId').prop('multiple', false);
				$('#groupsId').removeClass('select-multiple');
				break;
			case "6": $('#selectGroup').show();$('#selectNet').show();$('#selectGate').show();
				$('#groupsId').prop('multiple', false);
				$('#groupsId').removeClass('select-multiple');
				break;
			case "7": $('#selectGroup').show();$('#selectNet').show();$('#selectGate').show();
				$('#groupsId').prop('multiple', false);
				$('#groupsId').removeClass('select-multiple');
				break;
		}
	})
})
$(function(){
	$(document).ready(function(){
		var group_id = $('#groupsId').val();
		var net_id = <?= $user->groups[0]->_joinData->net_id ?>;
		$.ajax({
			type:"GET",
			url: '/users/listNet/'+group_id+'/'+net_id,
			success: function(data) {
				$('#netId').html(data);
			},
			headers:{
				'X-CSRF-Token':$('meta[name="csrfToken"]').attr('content')
			}
		})
		<?php
			switch ($profile_id) {
				case "1": echo "$('#selectGroup').hide();$('#selectNet').hide();$('#selectGate').hide();";
					break;
				case "2": echo "$('#selectGroup').hide();$('#selectNet').hide();$('#selectGate').hide();";
					break;
				case "3": echo "$('#selectGroup').show();$('#selectNet').hide();$('#selectGate').hide();";
					echo "$('#groupsId').prop('multiple', 'multiple');";
					echo "$('#groupsId').addClass('select-multiple');";
					break;
				case "4": echo "$('#selectGroup').show();$('#selectNet').show();$('#selectGate').hide();";
					echo "$('#groupsId').prop('multiple', false);";
					echo "$('#groupsId').removeClass('select-multiple');";
					break;
				case "5": echo "$('#selectGroup').show();$('#selectNet').show();$('#selectGate').show();";
					echo "$('#groupsId').prop('multiple', false);";
					echo "$('#groupsId').removeClass('select-multiple');";
					break;
				case "6": echo "$('#selectGroup').show();$('#selectNet').show();$('#selectGate').show();";
					echo "$('#groupsId').prop('multiple', false);";
					echo "$('#groupsId').removeClass('select-multiple');";
					break;
				case "7": echo "$('#selectGroup').show();$('#selectNet').show();$('#selectGate').show();";
					echo "$('#groupsId').prop('multiple', false);";
					echo "$('#groupsId').removeClass('select-multiple');";
					break;
			}
		?>
	})
})
$(function(){
	$('#groupsId').change(function(){
		var group_id = $(this).val();
		$.ajax({
			method:"POST", 
			url: '/users/listNet/'+group_id,
			success: function(data) {
				$('#netId').html(data);
			},
			headers:{
				'X-CSRF-Token':$('meta[name="csrfToken"]').attr('content')
			}
		})
	})
})
</script>