<?php global $HTTP_POST_VARS; ?>

	<div class="container">
	<h2>Рейтинг учеников</h2><br>
	<div class="row">

		<div class="btn-group">
		  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Выберите группу <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu">
		  	<li><a href="/shop/user/getRatingAndShow">Общий рейтинг</a></li>
		    <?php
		    	for ($i=1; $i <= count($HTTP_POST_VARS); $i++) { 
		    		if (isset($HTTP_POST_VARS[$i]))  {
		    ?>
		    <li>
		    	<a href=" <?php echo '/shop/user/getRatingAndShow?group='.$i;?> ">
		    		<?php 
		    			echo $HTTP_POST_VARS[$i]; 
		    		?>
		    	</a>
		    </li>
		    <?php 
		    	} } unset($HTTP_POST_VARS); 
		    ?>
		  </ul>
		</div>
<br/><br/>
<?php if (count($data['rating']) != 0) { ?> <!-- проверяем на наличие элементов -->	
	<div class="col-lg-3 centered">
	</div>
	<div class="col-lg-6 centered">

	<div class="panel panel-default">

	  <table class="table text-center">
	  	<tr>
	  		<td><b>Номер</b></td>
	  		<td class="text-left"><b>Имя ученика</b></td>
	  		<td><b>Баллы</b></td>
	  	</tr>
	    <tr>
	    	<td>
	    		<?php $i = 1;
	    		foreach ($data['rating'] as $row) {
	    			print '<h4><i>'.$i."</i></h4>";
	    			$i++;
	    		}?>
	    	</td>
	    	<td class="text-left">
	    		<?php foreach ($data['rating'] as $row) {
	    			//print '<h4><i>'.$row['user_login']."</i></h4>";
	    			foreach ($data['info'] as $ro) {
	    				if ($ro['user_login'] == $row['user_login']) {
	    					print '<h4><i>'.$ro['family_name'].' '.$ro['name']."</i></h4>";
	    				}
	    				
	    			}
	    		}?>
	    	</td>
	    	<td>
	    		<?php foreach ($data['rating'] as $row) {
	    			print '<h4><i>'.$row['user_rating']."</i></h4>";
	    		}?>
	    	</td>

	    </tr>
	  </table>
	</div>

	</div>


	</div>
	</div>
<?php } else echo '<h4 class="media-heading container text-center">Запрос не содержит элементов</h4>'?>