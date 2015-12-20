<?
class Model_Timetable extends Model
{
    public function __construct()
    {
        $this->db_connect();
    }
    public function getEvent()
    {   
        $query = $this->DBH->prepare("SELECT * FROM event");
        $query->execute();
        $eventdata = $query->fetchAll(PDO::FETCH_ASSOC);
        return $eventdata;
    }
    public function addMark($id, $groupID)
    {   
        $query = $this->DBH->prepare("SELECT user_id FROM users WHERE group_id=:groupID"); 
        $query->bindParam(':groupID', $groupID);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $key) {
            $query = $this->DBH->prepare("INSERT INTO marks SET event_id=:id, user_id=:user_id"); 
            $query->bindParam(':id', $id);
            $query->bindParam(':user_id', $key['user_id']);
            $query->execute();
        }
    }
    public function addEvent($name, $dateYMD, $description, $task, $groupID, $staffID)
    {
        $query = $this->DBH->prepare("INSERT INTO event SET name=:name,date=:dateYMD,description=:description,task=:task, group_id=:groupID, staff_id=:staffID");
        $query->bindParam(':name', $name);
        $query->bindParam(':dateYMD', $dateYMD);
        $query->bindParam(':description', $description);
        $query->bindParam(':task', $task);
        $query->bindParam(':groupID', $groupID);
        $query->bindParam(':staffID', $staffID);
        $query->execute();
        $lastid = $this->DBH->lastInsertId();
        $this->addMark($lastid, $groupID);
    }
    public function deleteEvent($eventID)
    {
        $query = $this->DBH->prepare("SELECT * FROM marks WHERE event_id=:event_id"); //выборка оценок, чтобы их вычесть из рейтинга
        $query->bindParam(':event_id', $eventID);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            $query = $this->DBH->prepare("SELECT * FROM users WHERE user_id=:user_id LIMIT 1"); //в цикле запрашиваем по каждому user_id в таблицу users
            $query->bindParam(':user_id', $row['user_id']);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $result['0']['user_rating'] -= $row['mark'];

            $query = $this->DBH->prepare("UPDATE users SET user_rating=:user_rating WHERE user_id=:user_id");
            $query->bindParam(':user_id', $row['user_id']);
            $query->bindParam(':user_rating', $result['0']['user_rating']);
            $query->execute();
        }
        

        $query = $this->DBH->prepare("DELETE FROM marks WHERE event_id=:event_id"); //удаление оценок
        $query->bindParam(':event_id', $eventID);
        $query->execute();

        $query = $this->DBH->prepare("DELETE FROM event WHERE id=:ID"); //удалить событие
        $query->bindParam(':ID', $eventID);
        $query->execute();
    }
    public function getCategory()
    {
        $query = $this->DBH->prepare("SELECT id, name FROM category");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>