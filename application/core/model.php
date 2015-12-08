<?php

class Model
{
	public function db_connect()
	{
		   # Соединямся с БД
		
		try {  
          $this->DBH = new PDO("mysql:host=localhost;dbname=users", 'root', '');  
          $this->DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
          
        }  
        catch(PDOException $e) {  
        	$err[] = $e->getMessage;
            file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);

            // return $err = "Houston, we have a problem.";  
        }
	}
	
	// метод выборки данных
	public function get_data()
	{
		// todo
	}
}