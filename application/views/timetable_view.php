<?php global $HTTP_POST_VARS; ?>
<div class="form_container">
        <form id="event_form" method="POST" action="/shop/timetable/addevent">
        <h3>Добавление события</h3>
            <div class="form-group">
                <input type="email" name="nameFF" class="form-control" id="event_name" placeholder="Название события">
                <input type="date" name="dateFF" class="form-control" id="date" placeholder="YYYY-MM-DD">
            </div>
            <div class="form-group">
                <textarea id="description" name="descriptionFF" placeholder="Описание события"></textarea>
            </div>
            <div class="form-group">
                <textarea id="task" name="taskFF" placeholder="Описание задания к событию (если есть)"></textarea>
            </div>
            <div class="form-group text-center">
              <label for="exampleInputPassword2">Номер группы</label><br/>
              <div class="btn-group">
              <p><select size="1" name="groupFF" class="btn  dropdown-toggle">
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
                <button type="submit" name="submit" class="btn btn-default">Добавить</button>
            </div>


        </form>
    </div>
<?php if ($data['root'] == 1) {
   echo '<span class="create_event_show btn btn-default">Добавить событие</span>';
}?>
<br/><br/>
<div class="container">
    <div class="row calendar_week">
        
        <?php
        $d = 1;
        $i = 1;
        $currentdate = date('Y-m-d');
        while ($i<20)
        { 
           echo ' 
           <div class="col-md-1 calendar_day">
               <div class="date">
                   '.$currentdate.'
               </div>
               <div class="scroll_image"></div>
               <div class="list_events">
                   <span>';
                   foreach ($data as $key) {
                    if ($key['date'] == $currentdate) {
                    echo '<a href="/shop/user/showevent?id='.$key['id'].'">'.$key['name']."</a><br />";
                    }
                   }
                 echo "  
                   </span>
               </div>
           </div>";
           $currentdate = date ('Y-m-d', strtotime ('+'.$i.' days'));
           $d++;
           $i++;
        }
        ?>
  </div>      
  </div>      