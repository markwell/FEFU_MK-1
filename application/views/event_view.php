	<div class="container">
		<!-- <div class="col-lg-1 centered">
		</div> -->
		<div class="col-lg-4 centered">
			<h5>
				Группа: 
				<b><i>
					<?php print $data['group']['0']['name'];?>
				</i></b>
			</h5>
		</div>
		<div class="col-lg-4 centered">
			<h5>
				Дата: 
				<b><i>
					<?php print $data['event']['0']['date'];?>
				</i></b>
			</h5>
		</div>
		<div class="col-lg-4 centered">
			<h5>	
				Преподаватель:
				<b><i>
					<?php print $data['staff']['name'];?>
				</i></b>
			</h5>
		</div>
	<br/><br/>
	<h2>
		<?php print $data['event']['0']['name'];?>
	</h2>
	<br/>
	<div class="row">

<?php if (count($data['event']) != 0) { ?> <!-- проверяем на наличие элементов -->
	<div>
		
		<h5>Описание: <b><i>
		<?php print $data['event']['0']['description'];?>
		</i></b></h5>
		<h5>Задание: <b><i>
		<?php print $data['event']['0']['task'];?>

		</i></b></h5>
		<br/>
	</div>

	


	<div class="form_container">
	<form id="event_form" role="form" method="POST" action="/shop/user/showEvent?id=<?php print $data['event']['0']['id'];?>&edit=1">
	<h3>Проставление оценок</h3>
	  <table class="table text-center">
	  	<tr>
	  		<td><b>Номер</b></td>
	  		<td class="text-left"><b>Имя ученика</b></td>
	  		<td><b>Посещение</b></td>
	  		<td><b>Оценка</b></td>
	  	</tr>
	    <tr>
	    	<td>
	    		<?php $i = 1;
	    		foreach ($data['users'] as $row) {
	    			print '<h4><i>'.$i."</i></h4>";
	    			$i++;
	    		}?>
	    	</td>
	    	<td class="text-left">
	    		<?php foreach ($data['users'] as $row) {
	    			foreach ($data['info'] as $ro) {
	    				if ($ro['user_login'] == $row['user_login']) {
	    					print '<h4><i>'.$ro['family_name'].' '.$ro['name']."</i></h4>";
	    				}
	    				
	    			}
	    		}?>
	    	</td>
	    	<td>
	    		<?php foreach ($data['users'] as $row) {
	    			foreach ($data['marks'] as $ro) {
	    				if ($ro['user_id'] == $row['user_id']) {
	    					print '<input type="checkbox" class="form-controll" value="1" name="'.$ro['user_id'].'"';
	    					if ($ro['visited'] == '1') {
	    						print ' checked>';
	    					} else {
	    						print '>';
	    					}
	    				}
	    				
	    			}
	    		}?>
	    	</td>
	    	<td>
	    		<?php foreach ($data['users'] as $row) {
	    			foreach ($data['marks'] as $ro) {
	    				if ($ro['user_id'] == $row['user_id']) {
	    					print '<input type="login" class="form-control" size="2" name="m'.$ro['user_id'].'" placeholder="'.$ro['mark'].'">';
	    				}
	    				
	    			}
	    		}?>
	    	</td>
	    </tr>
	  </table>
	  <input name="submit" type="submit" class="btn btn-default" value="Сохранить">
	</form>
	</div>

	<div class="col-lg-3 centered"> 
	</div>
	<div class="col-lg-6 centered">
	<div class="panel panel-default">

	  <table class="table text-center">
	  	<tr>
	  		<td><b>Номер</b></td>
	  		<td class="text-left"><b>Имя ученика</b></td>
	  		<td><b>Посещение</b></td>
	  		<td><b>Оценка</b></td>
	  	</tr>
	    <tr>
	    	<td>
	    		<?php $i = 1;
	    		foreach ($data['users'] as $row) {
	    			print '<h4><i>'.$i."</i></h4>";
	    			$i++;
	    		}?>
	    	</td>
	    	<td class="text-left">
	    		<?php foreach ($data['users'] as $row) {
	    			foreach ($data['info'] as $ro) {
	    				if ($ro['user_login'] == $row['user_login']) {
	    					print '<h4><i>'.$ro['family_name'].' '.$ro['name']."</i></h4>";
	    				}
	    				
	    			}
	    		}?>
	    	</td>
	    	<td>
	    		<?php foreach ($data['users'] as $row) {
	    			foreach ($data['marks'] as $ro) {
	    				if ($ro['user_id'] == $row['user_id']) {
	    					print '<h4><i>'.$ro['visited']."</i></h4>";
	    				}
	    				
	    			}
	    		}?>
	    	</td>
	    	<td>
	    		<?php foreach ($data['users'] as $row) {
	    			foreach ($data['marks'] as $ro) {
	    				if ($ro['user_id'] == $row['user_id']) {
	    					print '<h4><i>'.$ro['mark']."</i></h4>";
	    				}
	    				
	    			}
	    		}?>
	    	</td>
	    </tr>
	  </table>
	</div>
	</div>


	</div>
	</div>
	<?php if ($data['roots']=='1') {
		echo '
		<form method="POST" action="/shop/timetable/deleteevent?id='.$_GET['id'].'">
		    <div class="form-group">
		    	<span class="create_event_show btn btn-default">Проставить оценки</span>
		        <input type="submit" name="submit" class="btn btn-default" value="Удалить событие">
		    </div>
		</form>';
	}
	} else echo '<h4 class="media-heading container text-center">Запрос не содержит элементов</h4>'?>