<?php

class Controller 
{
	public $model;
	public $view;
	function __construct()
	{
		$this->view = new View();
	}
	// действие (action), вызываемое по умолчанию
	function action_index()
	{
		// todo	
	}
	function action_checkUser()
	{
	    @$userdata = $this->model->getUserHashAndID(intval($_COOKIE['id']));
	    if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
	        if (($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])) {
	            setcookie("id", "", time() - 3600*24*30*12, "/");
	            setcookie("username", "", time() - 3600*24*30*12, "/");
	            setcookie("hash", "", time() - 3600*24*30*12, "/");
	            setcookie("root", "", time() - 3600*24*30*12, "/");
	            return false;
	        } else {
	            return true;
	        }
	    } else {
	    	setcookie("id", "", time() - 3600*24*30*12, "/");
	    	setcookie("username", "", time() - 3600*24*30*12, "/");
	    	setcookie("hash", "", time() - 3600*24*30*12, "/");
	        setcookie("root", "", time() - 3600*24*30*12, "/");
	    	return false;
	    }
	}
}
