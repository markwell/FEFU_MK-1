<div class="form_container">
<form id="event_form" role="form" method="POST" action="/shop/user/confirmation">
<h3>Подтверждение подлинности </h3>
  <table class="table text-center">
  	<tr>
  		<td class="text-left"><b>Имя ученика</b></td>
  		<td><b>Группа</b></td>
  		<td><b>Статус</b></td>
  	</tr>
    <tr>
    	<td class="text-left">
    		<?php foreach ($data['unconfirmedUsers'] as $row) {
    			foreach ($data['unconfirmedInfo'] as $ro) {
    				if ($ro['user_login'] == $row['user_login']) {
    					print '<h4><i>'.$ro['family_name'].' '.$ro['name']."</i></h4>";
    				}
    				
    			}
		 	}
    		?>
    	</td>
    	<td>
    		<?php foreach ($data['unconfirmedUsers'] as $row) {
    			foreach ($data['category'] as $ro) {
    				if ($ro['id'] == $row['group_id']) {
    					print '<h4><i>'.$ro['name']."</i></h4>";
    				}
    				
    			}
		 	}
    		?>
    	</td>
    	<td>
    		<?php 
    		foreach ($data['unconfirmedUsers'] as $row) { ?>
    				<div class="btn-group">
    				<p><select size="1" name=" <?php print $row['user_id']; ?>" class="btnn  dropdown-toggle">
    				    <option value="0" selected>Решить позже</option>
    				    <option value="1">Подтвердить</option>
    				    <option value="2">Отклонить</option>
    				</select></p>
    				</div><br/>
    			<?php } ?>
    	</td>
    </tr>
  </table>
  <input name="submit" type="submit" class="btn btn-default" value="Сохранить">
</form>
</div> <!-- форма подтверждения новых пользователей -->

<div class="form_container2">
<form id="event_form2" role="form" method="POST" action="/shop/user/updateinfo">
    <h3>Изменение информации</h3>
    <div class="form-group">
      <label>Email</label>
      <input type="email" class="form-control" name="email" placeholder="Email">
    </div>
    <div class="form-group">
      <label>Номер телефона</label>
      <input type="number" class="form-control" name="phone_number" placeholder="Phone number">
    </div>
    <input name="submit" type="submit" class="btn btn-default" value="Сохранить">
</form>
</div> <!-- форма редактирования инфо -->

<?php if (count($data) != 0) { ?> <!-- проверяем на наличие элементов -->
	<div class="container">	
		<h2>Личный кабинет</h2><br>
		 <div class="row">
		  	<h1><i> 
		  		<?php print $data['info']['0']['name'].' '.$data['info']['0']['family_name']; 
		  		if ($data['roots']=='1') {
		  			print '<span class="label label-success">admin</span>';
		  		}
		  		?>
		  	</i></h1>
		  	<br/>
		  	<?php if ($data['roots']=='1') { ?> <!-- только для админов -->
		 		<span class="create_event_show btn btn-default">Показать список новых участников</span><br/><hr/>
		 		<!-- <span class="create_event_show btn btn-default">Создать группу</span>
		 		<span class="create_event_show btn btn-default">Удалить группу</span><hr/> -->

		 	<?php }
		 	if ($data['roots']=='0') { ?> <!-- только для учеников -->
			  	<h4>Группа: <b><?php print $data['theCategory']['0']['name'];?></b></h4>
			  	<h4>Почтовый ящик: <b><?php print $data['info']['0']['email'];?></b></h4>
			  	<h4>Номер телефона: <b><?php print $data['info']['0']['phone_number'];?></b></h4>

			  	<h4>Прогресс: <b><?php print $data['users']['user_rating'].' ';?></b>балл(ов)</h4>
			  	<div class="progress progress-striped active width50">
			  	  <div class="progress-bar"  role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php print $data['users']['user_rating'].'%';?>">
			  	  </div>
			  	</div>
		  	<?php } 
		  if ($data['roots']=='0') { ?>
            <span class="create_event_show2 btn btn-default">Изменить информацию</span>
		  <?php } ?>
		  <a class="btn btn-default" href="/shop/user/logoutuser">Выход из профиля</a>
		 </div>
		 <div>
		 <br/>
		 	
		 </div>
	</div>
	<br>
	<br>
<?php } else header('Location: /shop/user/showLogin'); ?>