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
	public function getUserHashAndID($userID)
	{
		$this->db_connect();
		if (isset($_COOKIE['root']) and $_COOKIE['root'] == '1') {
			$query = $this->DBH->prepare("SELECT * FROM staff WHERE user_id=:id LIMIT 1");
		} else {
			$query = $this->DBH->prepare("SELECT * FROM users WHERE user_id=:id LIMIT 1");
		}
		$query->bindParam(':id', $userID);
		$query->execute();
		$userdata = $query->fetch(PDO::FETCH_ASSOC);
		return $userdata;
	}
	// метод выборки данных
	public function get_data()
	{
		// todo
	}
}