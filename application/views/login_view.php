<div class="container">	
		<h2>Авторизация</h2><br>
		    <div class="container">
		    	<div class="row">
				  	<? 
				  		if (isset($data)){
				  			echo('<br><div class="alert alert-info" role="alert">'.$data.'</div>');
				  		}
				  	?>
		      	</div>
		     </div>
		<div class="row">
		<form role="form" method="POST" action="/shop/user/authUser">
		  <div class="form-group">
		    <label for="exampleInputEmail1">Логин</label>
		    <div class="input-group">
		    	<input type="login" class="form-control" id="exampleInputEmail1" name="login" placeholder="Enter login" required>
		    	<span class="input-group-addon">
		    	    <input type="checkbox" name="checkStaff"> Staff
		    	</span>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Пароль</label>
		    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" required>
		  </div>
		  
		  <input name="submit" type="submit" class="btn btn-default" value="Авторизация">
		  <a href="/shop/user/showRegister"> Регистрация</a>

		</form>
		</div>
</div>
		    
<br>
<br>
<br>
<br>