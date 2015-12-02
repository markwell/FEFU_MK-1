<?php

class Controller_Timetable extends Controller
{ 
    function __construct()
    {
        $this->model = new Model_Timetable();
        $this->view  = new View();
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
            $this->model->addEvent($_POST['nameFF'],$_POST['dateFF'],$_POST['descriptionFF'],$_POST['taskFF']);
            header('Location:/shop/timetable/showTimetable');
        }
    }
}