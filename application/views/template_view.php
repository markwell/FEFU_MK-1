<!DOCTYPE html>
<html lang="ru">

   <head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <meta http-equiv="Cache-Control" content="private">
	  <title>Мастер-Классы</title>
	  <link href="/shop/css/bootstrap.css" rel="stylesheet">
	  <!-- Стиль для календаря -->
	  <link href="/shop/css/timetable_style.css" rel="stylesheet"> 
	  
   </head>

   <body>
   	<!-- Адаптивная навигация по сайту -->
   	<div align="center">
   		<div class="navbar">
   			<br/>
   		    <div class="col-lg-3"><a href="/shop/" ><i>Домой</i></a></div>
   		    <div class="col-lg-1"></div>
   		    <div class="col-lg-4">Дальневосточный федеральный университет</div>
   		    <div class="col-lg-1"></div>
   		    <div class="col-lg-3"><i>
   		    	<?php if (isset($_COOKIE['username'])){
   		    	echo 
   		    		'Пользователь: <a href="/shop/user/getCabinetAndShow?login='.$_COOKIE['username'].'">'.$_COOKIE['username'].'</a>';
   		    	} else {
   		    		echo '<a href="/shop/user/showlogin" >Войти в систему</a>';
   		    	} ?>
   		    </i></div>
   		    <a></a>
   		    <br><hr>
   		</div>

		<!-- Контент -->
		<?php include 'application/views/'.$content_view; ?>

		<!-- Footer -->
		<div class="navbar navbar-fixed-bottom">
			<h5><?php echo 'FEFU '.date('Y')?></h5>
		</div>  	  
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="/js/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="/js/bootstrap.js"></script>
	<script src="/js/main_create_dates.js"></script>
	<script src="/js/main_update_height.js"></script>
	<script src="/js/main_scrolling.js"></script>
	<script src="/js/moment.js"></script>

   </body>
</html>
