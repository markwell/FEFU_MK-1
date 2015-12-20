<!DOCTYPE html>
<html lang="ru">

   <head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <meta http-equiv="Cache-Control" content="private">
	  <meta charset="utf-8">
	  <title>Мастер-Классы</title>
	  <link href="../css/bootstrap.css" rel="stylesheet">
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
	<script src="../js/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="../js/bootstrap.js"></script>
	<script src="../js/main_create_dates.js"></script>
	<script src="../js/main_update_height.js"></script>
	<script src="../js/main_scrolling.js"></script>
	<script src="../js/moment.js"></script>
  <script src="../js/responsive-calendar.js"></script>
  <?php $currentdate = date('Y-m'); $link = '/shop/user/showevent?id=';?>
    <script type="text/javascript">
      $(document).ready(function () {
        $(".responsive-calendar").responsiveCalendar({
          time: '<?php echo $currentdate ?>',
           events: {
       "<?php echo $data['0']['date'] ?>":{"number": '<?php echo $data["0"]["name"] ?>', "url": "<?php echo $link.$data['0']['id'] ?>"},
       "<?php echo $data['1']['date'] ?>":{"number": '<?php echo $data["1"]["name"] ?>', "url": "<?php echo $link.$data['1']['id'] ?>"},
       "<?php echo $data['2']['date'] ?>":{"number": '<?php echo $data["2"]["name"] ?>', "url": "<?php echo $link.$data['2']['id'] ?>"},
       "<?php echo $data['3']['date'] ?>":{"number": '<?php echo $data["3"]["name"] ?>', "url": "<?php echo $link.$data['3']['id'] ?>"},
       "<?php echo $data['4']['date'] ?>":{"number": '<?php echo $data["4"]["name"] ?>', "url": "<?php echo $link.$data['4']['id'] ?>"},
       "<?php echo $data['5']['date'] ?>":{"number": '<?php echo $data["5"]["name"] ?>', "url": "<?php echo $link.$data['5']['id'] ?>"},
       "<?php echo $data['6']['date'] ?>":{"number": '<?php echo $data["6"]["name"] ?>', "url": "<?php echo $link.$data['6']['id'] ?>"},
       "<?php echo $data['7']['date'] ?>":{"number": '<?php echo $data["7"]["name"] ?>', "url": "<?php echo $link.$data['7']['id'] ?>"},
       "<?php echo $data['8']['date'] ?>":{"number": '<?php echo $data["8"]["name"] ?>', "url": "<?php echo $link.$data['8']['id'] ?>"},
       "<?php echo $data['9']['date'] ?>":{"number": '<?php echo $data["9"]["name"] ?>', "url": "<?php echo $link.$data['9']['id'] ?>"},
       "<?php echo $data['10']['date'] ?>":{"number": '<?php echo $data["10"]["name"] ?>', "url": "<?php echo $link.$data['10']['id'] ?>"},
                   }
        });
      });
    </script>
  
<?php
        /*$d = 1;
        $i = 1;
        $currentdate = date('Y-m-d');
        $date = date('jS MS');
        while ($i<25)
        { 
           echo ' 
           <div class="col-md-2 calendar_day">
               <div class="date">
                   <p class="lead">'.$date.'</p>
               </div>
               <div class="scroll_image"></div>
               <div class="list_events">
                   <span>';
                   foreach ($data as $key) {
                    if ($key['date'] == $currentdate) {
                    echo '<a class="btn" href="/shop/user/showevent?id='.$key['id'].'">'.$key['name']."</a><br />";
                    }
                   }
                 echo "  
                   </span>
               </div>
           </div>";
           $currentdate = date ('Y-m-d', strtotime ('+'.$i.' days'));
           $date = date('jS MS', strtotime ('+'.$i.' days'));
           $d++;
           $i++;
        }*/
        ?>
   </body>
</html>
