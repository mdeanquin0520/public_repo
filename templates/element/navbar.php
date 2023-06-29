<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
		<?php
			$controller = !empty($id) ? 'Home' : 'Users';
			$action = !empty($id) ? 'index' : 'login';
		?>
		<?= $this->Html->link('Estado a tu lado',['controller'=>$controller,'action'=>$action], ["class"=>"navbar-brand"]); ?>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item dropdown dropdown-hover">
					<?php 
						if(!empty($checkII1) || !empty($checkII2) || !empty($checkII3) || !empty($checkII4) || !empty($checkII5) || !empty($checkPI1) || 
							!empty($checkPI2) || !empty($checkPI3) || !empty($checkPI4) || !empty($checkPI5) || !empty($checkGI1) || !empty($checkGI2) || 
							!empty($checkGI3) || !empty($checkGI4) || !empty($checkGI5) || !empty($checkNI1) || !empty($checkNI2) || !empty($checkNI3) || 
							!empty($checkNI4) || !empty($checkNI5) || !empty($checkUI1) || !empty($checkUI2) || !empty($checkUI3) || !empty($checkUI4) || 
							!empty($checkUI5) || !empty($checkPrI1) || !empty($checkPrI2) || !empty($checkPrI3) || !empty($checkPrI4) || !empty($checkPrI5) || 
							!empty($checkMI1) || !empty($checkMI2) || !empty($checkMI3) || !empty($checkMI4) || !empty($checkMI5) || !empty($checkPGI1) || 
							!empty($checkPGI2) || !empty($checkPGI3) || !empty($checkPGI4) || !empty($checkPGI5)): 
					?>
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Administración
					</a>
					<?php endif; ?>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><?php if(!empty($checkII1) || !empty($checkII2) || !empty($checkII3) || !empty($checkII4) || !empty($checkII5)) echo $this->Html->link('Instituciones',['controller'=>'institutions','action'=>'index'], ["class"=>"dropdown-item"]); ?></li>
						<li><?php if(!empty($checkPI1) || !empty($checkPI2) || !empty($checkPI3) || !empty($checkPI4) || !empty($checkPI5)) echo $this->Html->link('Pacientes',['controller'=>'pacients','action'=>'index'], ["class"=>"dropdown-item"]); ?></li>
						<li><?php if(!empty($checkPM1) || !empty($checkPM2) || !empty($checkPM3) || !empty($checkPM4) || !empty($checkPM5)) echo $this->Html->link('Mapa',['controller'=>'pacients','action'=>'map'], ["class"=>"dropdown-item"]); ?></li> 
						<li><?php if(!empty($checkGI1) || !empty($checkGI2) || !empty($checkGI3) || !empty($checkGI4) || !empty($checkGI5)) echo $this->Html->link('Células',['controller'=>'groups','action'=>'index'], ["class"=>"dropdown-item"]); ?></li> 
						<li><?php if(!empty($checkNI1) || !empty($checkNI2) || !empty($checkNI3) || !empty($checkNI4) || !empty($checkNI5)) echo $this->Html->link('UFs',['controller'=>'nets','action'=>'index'], ["class"=>"dropdown-item"]); ?></li> 
						<li><?php if(!empty($checkUI1) || !empty($checkUI2) || !empty($checkUI3) || !empty($checkUI4) || !empty($checkUI5)) echo $this->Html->link('Usuarios',['controller'=>'Users','action'=>'index'], ["class"=>"dropdown-item"]); ?></li> 
						<li><?php if(!empty($checkPrI1) || !empty($checkPrI2) || !empty($checkPrI3) || !empty($checkPrI4) || !empty($checkPrI5)) echo $this->Html->link('Perfiles de usuario',['controller'=>'profiles','action'=>'index'], ["class"=>"dropdown-item"]); ?></li> 
						<li><?php if(!empty($checkMI1) || !empty($checkMI2) || !empty($checkMI3) || !empty($checkMI4) || !empty($checkMI5)) echo $this->Html->link('Permisos', ['controller'=>'MyPermissions','action'=>'index'], ["class"=>"dropdown-item"]) ?></li>
						<li><?php if(!empty($checkPGI1) || !empty($checkPGI2) || !empty($checkPGI3) || !empty($checkPGI4) || !empty($checkPGI5)) echo $this->Html->link('Perfiles por nodos',['controller'=>'profilesGates','action'=>'index'], ["class"=>"dropdown-item"]); ?></li> 
					</ul>
				</li>
				<li class="nav-item dropdown dropdown-hover">
					<?php
						if(!empty($checkSGI1) || !empty($checkSGI2) || !empty($checkSGI3) || !empty($checkSGI4) || !empty($checkSGI5) || !empty($checkSGG1) || 
							!empty($checkSGG2) || !empty($checkSGG3) || !empty($checkSGG4) || !empty($checkSGG5)):
					?>
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Gestión de células
					</a>
					<?php endif; ?>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><?php if(!empty($checkSGI1) || !empty($checkSGI2) || !empty($checkSGI3) || !empty($checkSGI4) || !empty($checkSGI5)) echo $this->Html->link('Estado de célula',['controller'=>'StatusGroups','action'=>'index'], ["class"=>"dropdown-item"]); ?></li> 
						<li><?php if(!empty($checkSGG1) || !empty($checkSGG2) || !empty($checkSGG3) || !empty($checkSGG4) || !empty($checkSGG5)) echo $this->Html->link('Tablero de control',['controller'=>'StatusGroups','action'=>'graphics'], ["class"=>"dropdown-item"]); ?></li> 
					</ul>
				</li>
				<li class="nav-item dropdown dropdown-hover">
					<?php 
						if(!empty($checkSDI1) || !empty($checkSDI2) || !empty($checkSDI3) || !empty($checkSDI4) || !empty($checkSDI5) || !empty($checkSI1) || 
							!empty($checkSI2) || !empty($checkSI3) || !empty($checkSI4) || !empty($checkSI5) || !empty($checkSuI1) || !empty($checkSuI2) || 
							!empty($checkSuI3) || !empty($checkSuI4) || !empty($checkSuI5) || !empty($checkOrI1) || !empty($checkOrI2) || !empty($checkOrI3) || 
							!empty($checkOrI4) || !empty($checkOrI5) || !empty($checkStI1) || !empty($checkStI2) || !empty($checkStI3) || !empty($checkStI4) || 
							!empty($checkStI5) || !empty($checkStI1) || !empty($checkStI2) || !empty($checkStI3) || !empty($checkStI4) || !empty($checkStI5) || 
							!empty($checkEI1) || !empty($checkEI2) || !empty($checkEI3) || !empty($checkEI4) || !empty($checkEI5) || !empty($checkTI1) || 
							!empty($checkTI2) || !empty($checkTI3) || !empty($checkTI4) || !empty($checkTI5)):
					?>
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Gestión de personal y pacientes
					</a>
					<?php endif; ?>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><?php if(!empty($checkSDI1) || !empty($checkSDI2) || !empty($checkSDI3) || !empty($checkSDI4) || !empty($checkSDI5)) echo $this->Html->link('Estados de alerta',['controller'=>'StatesxDays','action'=>'index'], ["class"=>"dropdown-item"]); ?></li> 
						<li><?php if(!empty($checkSI1) || !empty($checkSI2) || !empty($checkSI3) || !empty($checkSI4) || !empty($checkSI5)) echo $this->Html->link('Agendas',['controller'=>'Schedules','action'=>'index'], ["class"=>"dropdown-item"]); ?></li>
						<li><?php if(!empty($checkSuI1) || !empty($checkSuI2) || !empty($checkSuI3) || !empty($checkSuI4) || !empty($checkSuI5)) echo $this->Html->link('Insumos',['controller'=>'Supplies','action'=>'index'], ["class"=>"dropdown-item"]); ?></li>
						<li><?php if(!empty($checkOrI1) || !empty($checkOrI2) || !empty($checkOrI3) || !empty($checkOrI4) || !empty($checkOrI5)) echo $this->Html->link('Pedidos',['controller'=>'Orders','action'=>'index'], ["class"=>"dropdown-item"]); ?></li>
						<li><?php if(!empty($checkStI1) || !empty($checkStI2) || !empty($checkStI3) || !empty($checkStI4) || !empty($checkStI5)) echo $this->Html->link('Stocks',['controller'=>'Stocks','action'=>'index'], ["class"=>"dropdown-item"]); ?></li>
						<li><?php if(!empty($checkStI1) || !empty($checkStI2) || !empty($checkStI3) || !empty($checkStI4) || !empty($checkStI5)) echo $this->Html->link('Eventos de abastecimiento',['controller'=>'SourcingEvents','action'=>'index'], ["class"=>"dropdown-item"]); ?></li> 
						<li><?php if(!empty($checkEI1) || !empty($checkEI2) || !empty($checkEI3) || !empty($checkEI4) || !empty($checkEI5)) echo $this->Html->link('Eventos',['controller'=>'Events','action'=>'index'], ["class"=>"dropdown-item"]); ?></li> 
						<li><?php if(!empty($checkTI1) || !empty($checkTI2) || !empty($checkTI3) || !empty($checkTI4) || !empty($checkTI5)) echo $this->Html->link('Turnos',['controller'=>'Turns','action'=>'index'], ["class"=>"dropdown-item"]); ?></li> 
					</ul>
				</li>
				<li class="nav-item"><?php if(!empty($checkULo1) || !empty($checkULo2) || !empty($checkULo3) || !empty($checkULo4) || !empty($checkULo5)) echo $this->Html->link('Cerrar Sesion',['controller'=>'Users','action'=>'logout'], ["class"=>"nav-link"]) ?></li> 
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>

<?php if(isset($viewUser['username']) && isset($viewUser['fullname'])): ?>
<!--<div style="position: absolute;
    margin-top: -20px;
    right: 0px;
    padding: 10px 20px;
    background: #f0f0f0;">
<span class="hidden-xs">
  Usuario: <strong><?= $viewUser['fullname']; ?></strong> Rol: <?= $viewUser['role']; ?>
</div>-->
<?php endif; ?>