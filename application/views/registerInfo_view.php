<!-- Форма регистрации -->
	<div class="container">	
		<h2>Контактная информация</h2><br>
		 <div class="row">
		<form role="form" method="POST" action="/shop/user/newuserInfo">
		  <div class="form-group">
		    <label for="exampleInputPassword1">Фамилия</label>
		    <input type="login" class="form-control" id="exampleInputPassword1" name="family_name" placeholder="Last name" required>
		  </div>	
		  <div class="form-group">
		    <label for="exampleInputEmail1">Имя</label>
		    <input type="login" class="form-control" id="exampleInputEmail1" name="name" placeholder="First name" required>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Отчество</label>
		    <input type="login" class="form-control" id="exampleInputPassword4" name="middle_name" placeholder="Middle name" required>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword2">Email</label>
		    <input type="email" class="form-control" id="exampleInputPassword2" name="email" placeholder="Email" required>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword2">Номер телефона</label>
		    <input type="number" class="form-control" id="exampleInputPassword3" name="phone_number" placeholder="Phone number" required>
		  </div>
		  <input name="submit" type="submit" class="btn btn-default" value="Готово">
		</form>
		    </div>
	</div>
		  