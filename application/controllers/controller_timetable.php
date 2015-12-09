<?php

class Controller_Timetable extends Controller
{ 
    function __construct()
    {
        $this->model = new Model_Timetable();
        $this->view  = new View();
        $category = $this->model->getCategory();
        global $HTTP_POST_VARS;
        for ($i = 1; $i <= count($category); $i++) 
        {
            $HTTP_POST_VARS[$i] = $category[$i - 1];
        }
    }
    function checkRoot()
    {
        if (isset($_COOKIE['root']) && $_COOKIE['root'] == 1) {
            return 1;
        } else {
            return 0;
        }
    }
	function action_showTimetable()
    {	
        $root = $this->checkRoot();
        $event = $this->model->getEvent();
        $event['root'] = $root;
        $this->view->generate('timetable_view.php', 'template_view.php', $event);
    }
    function action_addEvent()
    {   
        if (isset($_POST['submit'])) {
            $this->model->addEvent($_POST['nameFF'],$_POST['dateFF'],$_POST['descriptionFF'],$_POST['taskFF'], $_POST['groupFF'], $_COOKIE['id']);
            header('Location:/shop/timetable/showTimetable');
        }
    }
    function action_deleteEvent()
    {   
        if (isset($_POST['submit'])) {
            $this->model->deleteEvent($_GET['id']);
            header('Location:/shop/timetable/showTimetable');
        }
    }
}