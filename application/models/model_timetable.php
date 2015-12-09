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
        $query = $this->DBH->prepare("DELETE FROM event WHERE id=:ID");
        $query->bindParam(':ID', $eventID);
        $query->execute();
        $query = $this->DBH->prepare("DELETE FROM marks WHERE event_id=:event_id");
        $query->bindParam(':event_id', $eventID);
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