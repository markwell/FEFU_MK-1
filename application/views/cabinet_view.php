<?php if (count($data) != 0) { ?> <!-- проверяем на наличие элементов -->
	<div class="container">	
		<h2>Личный кабинет</h2><br>
		 <div class="row">
		  	<h1><i> <?php print $data['info']['0']['name'].' '.$data['info']['0']['family_name']; ?></i></h1>
		  	<br/>
		  	<!-- <h4>Группа: <b></b></h4> -->
		  	<h4>Почтовый ящик: <b><?php print $data['info']['0']['email'];?></b></h4>
		  	<h4>Номер телефона: <b><?php print $data['info']['0']['phone_number'];?></b></h4>
		  	<br/>
		  <a class="btn btn-default" href="/shop/user/edituser">Изменить информацию</a>
		  <a class="btn btn-default" href="/shop/user/logoutuser">Выход из профиля</a>
		 </div>
		 <div>
		 	<?php if ($data['roots']=='1') {
		 		foreach ($data['unconfirmedUsers'] as $row) {
		 			echo $row['user_login'].' ';
		 		}
		 	}?>
		 </div>
	</div>
	<br>
	<br>
<?php } else header('Location: /shop/user/showLogin'); ?>