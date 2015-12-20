<link href="../css/timetable_style.css" rel="stylesheet"> 
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
<link href="../css/responsive-calendar.css" rel="stylesheet">
<?php global $HTTP_POST_VARS; ?>
  <h2>Расписание</h2><br>
<div class="form_container">
        <form id="event_form" method="POST" action="/shop/timetable/addevent">
        <h3>Добавление события</h3>
            <div class="form-group">
                <input type="text" name="nameFF" class="form-control" id="event_name" placeholder="Название события">
                <input type="date" name="dateFF" class="form-control" id="date" placeholder="YYYY-MM-DD">
            </div>
            <div class="form-group">
                <textarea id="description" name="descriptionFF" class="form-control" placeholder="Описание события"></textarea>
            </div>
            <div class="form-group">
                <textarea id="task" name="taskFF" class="form-control" placeholder="Описание задания к событию (если есть)"></textarea>
            </div>
            <div class="form-group text-center">
              
              <div class="btn-group">
              <p>Название группы:
              <select size="1" name="groupFF" class="btn  dropdown-toggle">
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
                <button type="submit" name="submit" class="btn btn-default">Добавить</button>
            </div>


        </form>
    </div>
    <?php if ($data['root'] == 1) {
   echo '<span class="create_event_show btn btn-default">Добавить событие</span>';
}?>
<br/>
<div class="container">
      <!-- Responsive calendar - START -->
      <div class="responsive-calendar">
        <div class="controls">
            <a class="pull-left" data-go="prev"><div class="btn btn-primary">Назад</div></a>
            <h4><span data-head-year></span> <span data-head-month></span></h4>
            <a class="pull-right" data-go="next"><div class="btn btn-primary">Вперед</div></a>
        </div><hr/>
        <div class="day-headers">
          <div class="day header">Пн</div>
          <div class="day header">Вт</div>
          <div class="day header">Ср</div>
          <div class="day header">Чт</div>
          <div class="day header">Пт</div>
          <div class="day header">Сб</div>
          <div class="day header">Вс</div>
        </div>
        <div class="days" data-group="days">
          
        </div>
      </div>
      <!-- Responsive calendar - END -->
    </div>

    