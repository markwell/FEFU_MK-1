 <?php global $HTTP_POST_VARS; ?>
 <!-- Форма регистрации -->
	<div class="container">	
		<h2>Регистрация</h2><br>
		 <div class="row">
		<form role="form" method="POST" action="/shop/user/newuser">

		  <div class="form-group text-center">
		    <label for="exampleInputPassword2">Название группы</label><br/>
		    <div class="btn-group">
		    <p><select size="1" name="group" class="btn  dropdown-toggle">
		        <option value="0" selected>Не знаю в какой я группе</option>
		        <?php
		          for ($i=1; $i <= count($HTTP_POST_VARS); $i++) { 
		            if (isset($HTTP_POST_VARS[$i]['name']))  {
		        ?>
		        <option value="<?php echo $HTTP_POST_VARS[$i]['id'];?>"><?php echo $HTTP_POST_VARS[$i]['name'];?></option>
		        <?php 
		          } } unset($HTTP_POST_VARS); 
		        ?>
		    </select></p>
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="exampleInputEmail1">Логин</label>
		    <input type="login" class="form-control" id="exampleInputEmail1" name="login" placeholder="Enter login" required>
		  </div>

		  <div class="form-group">
		    <label for="exampleInputPassword1">Пароль</label>
		    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" required>
		  </div>
		  
		  <div class="form-group">
		    <label for="exampleInputPassword2">Повторите пароль</label>
		    <input type="password" class="form-control" id="exampleInputPassword2" name="repass" placeholder="Password" required>
		  </div>
		  
		  <input name="submit" type="submit" class="btn btn-default" value="Регистрация">
		  <a href="/shop/user/showlogin">Авторизация</a>
		</form>
		    </div>
		  </div>
		  <div class="container">
		  	<div class="row">
					<? 
					if (isset($data)) //по идее такого в виде не должно быть, но иначе будет ошибка на странице
					{ 
						foreach ($data['error'] as $value) 
						{
							echo('<br><div class="alert alert-warning" role="alert">'.$value.'</div>');
						}	
					}
					?>
		    </div>
		   </div>
		  <br>
		  <br>
		  