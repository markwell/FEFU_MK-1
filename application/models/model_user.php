<?
class Model_User extends Model
{
    public function __construct()
    {
        $this->db_connect();
        
    }
    # Функция для генерации случайной строки
    public function generateCode($length = 6)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIFJKLMNOPRQSTUVWXYZ0123456789";
        $code  = "";
        $clen  = strlen($chars) - 1;
        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0, $clen)];
        }
        return $code;
    }
    public function checkAndAddUser($login, $password, $repass, $group_id)
    {
        $err = array();
        if (!preg_match("/^[a-zA-Z0-9]+$/", $login)) {
            $err[] = "Имя пользователя должно содержать только буквы и числа!";
        }
        if (strlen($login) < 3 or strlen($login) > 30) {
            $err[] = "Имя пользователся должно быть не меньше трех и не больше тридцати символов!";
        }
        # проверяем, не сущестует ли пользователя с таким именем
        $query = $this->DBH->prepare("SELECT COUNT(user_id) FROM users WHERE user_login=:login");
        $query->bindParam(":login", $login);
        $query->execute();
        $resultArray = $query->fetchcolumn();
        if ($resultArray > 0) {
            $err[] = "Пользователь с таким именем уже существует!";
        }
        $password = md5($password);
        $repeat   = md5($repass);
        if ($password != $repeat) {
            $err[] = "Пароли не совпадают! Попробуйте еще раз!";
        }
        # Если нет ошибок, то добавляем в БД нового пользователя
        if (count($err) == 0) {
            $login = $login;
            # Убераем лишние пробелы и делаем двойное шифрование
            $password = md5(md5(trim($password)));
            $query = $this->DBH->prepare("INSERT INTO users SET user_login=:login, user_password=:password, group_id=:group_id");
            $query->bindParam(":login", $login);
            $query->bindParam(":password", $password);
            $query->bindParam(":group_id", $group_id);
            $query->execute();
            # Отправляем логин в checkAndAddUserInfo через куки
            setcookie("login_temp", $login, time() + 60 * 60 * 24 * 30, "/");
            return null;
        }
        return $err;
    }
    public function checkAndAddUserInfo($name, $family_name, $email, $phone_number, $middle_name)
    {
        #проверяем, есть ли зарегистрированный логин в куках
        if (isset($_COOKIE['login_temp'])){
            $login = $_COOKIE['login_temp'];
            $query = $this->DBH->prepare("INSERT INTO info SET user_login=:login, name=:name, family_name=:family_name, email=:email, phone_number=:phone_number, middle_name=:middle_name");
            $query->bindParam(":login", $login);
            $query->bindParam(":name", $name);
            $query->bindParam(":family_name", $family_name);
            $query->bindParam(":email", $email);
            $query->bindParam(":phone_number", $phone_number);
            $query->bindParam(":middle_name", $middle_name);
            $query->execute();   
        } 
        return null; 
    }
    public function checkRoots()
    {
        #проверяем, есть ли параметр админа в куках
        if ($_COOKIE['root'] == '1') {
            return '1';
        } else {
            return '0';
        } 
    }
    public function checkAndAuthUser($login, $password)
    {
        $error = "";
        # Вытаскиваем из БД запись, у которой логин равняеться введенному
        $query = $this->DBH->prepare("SELECT user_id, user_password FROM users WHERE user_login=:login LIMIT 1");
        $query->bindParam(':login', $login);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        # Сравниваем пароли
        /*echo ($data['user_password'].'<br>');
        echo md5(md5(md5($password)));
        break;*/
        if ($data['user_password'] === md5(md5(md5($password)))) {
            # Генерируем случайное число и шифруем его
            $hash  = md5($this->generateCode(10));
            # Записываем в БД новый хеш авторизации 
            $query = $this->DBH->prepare("UPDATE users SET user_hash=:hash WHERE user_id=:id");
            $query->bindParam(':hash', $hash);
            $query->bindParam(':id', $data['user_id']);
            $query->execute();
            # Ставим куки
            setcookie("id", $data['user_id'], time() + 60 * 60 * 24 * 30, "/");
            setcookie("hash", $hash, time() + 60 * 60 * 24 * 30, "/");
            setcookie("username", $login, time() + 60 * 60 * 24 * 30, "/");
            return null;
        } else {
            
            $error = "Неправильные имя пользователя или пароль. Пожалуйста, попробуйте еще раз.";
            return $error;
        }
    }
    public function checkAndAuthStaff($login, $password)
    {
        $error = "";
        # Вытаскиваем из БД запись, у которой логин равняеться введенному
        $query = $this->DBH->prepare("SELECT user_id, user_password FROM staff WHERE user_login=:login LIMIT 1");
        $query->bindParam(':login', $login);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        # Сравниваем пароли
        /*echo ($data['user_password'].'<br>');
        echo md5(md5(md5($password)));
        break;*/
        if ($data['user_password'] === md5(md5(md5($password)))) {
            # Генерируем случайное число и шифруем его
            $hash  = md5($this->generateCode(10));
            # Записываем в БД новый хеш авторизации 
            $query = $this->DBH->prepare("UPDATE staff SET user_hash=:hash WHERE user_id=:id");
            $query->bindParam(':hash', $hash);
            $query->bindParam(':id', $data['user_id']);
            $query->execute();
            # Ставим куки
            setcookie("id", $data['user_id'], time() + 60 * 60 * 24 * 30, "/");
            setcookie("hash", $hash, time() + 60 * 60 * 24 * 30, "/");
            setcookie("username", $login, time() + 60 * 60 * 24 * 30, "/");
            setcookie("root", "1", time() + 60 * 60 * 24 * 30, "/"); //разделение прав
            return null;
        } else {
            
            $error = "Неправильные имя пользователя или пароль. Пожалуйста, попробуйте еще раз.";
            return $error;
        }
    }
    public function updateMarks($user_id ,$mark, $event_id)
    {
        $array = $this->getHashAndID($user_id); //берем текущие данные ученика и записываем в массив
        $user_rating = $array['user_rating']; //берем только рейтинг

        $quer = $this->DBH->prepare("SELECT mark FROM marks WHERE event_id=:event_id AND user_id=:user_id LIMIT 1");
        $quer->bindParam(':event_id', $event_id);
        $quer->bindParam(':user_id', $user_id);
        $quer->execute();
        $result = $quer->fetchAll(PDO::FETCH_ASSOC);

        $user_rating -= $result['0']['mark']; //вычисляем новый рейтинг
        $user_rating += $mark;

        $query = $this->DBH->prepare("UPDATE users SET user_rating=:user_rating WHERE user_id=:user_id");
        $query->bindParam(':user_rating', $user_rating);
        $query->bindParam(':user_id', $user_id);
        $query->execute();

        $query = $this->DBH->prepare("UPDATE marks SET mark=:mark WHERE user_id=:user_id AND event_id=:event_id");
        $query->bindParam(':mark', $mark);
        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':event_id', $event_id);
        $query->execute();
        return null;
    }
    public function updateVisited($user_id ,$mark, $event_id)
    {
        $error = "";
            $query = $this->DBH->prepare("UPDATE marks SET visited=:mark WHERE user_id=:user_id AND event_id=:event_id");
            $query->bindParam(':mark', $mark);
            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':event_id', $event_id);
            $query->execute();
            return null;
    }
    public function updateUsers($user_id)
    {
        $query = $this->DBH->prepare("UPDATE users SET user_status='1' WHERE user_id=:user_id");
        $query->bindParam(':user_id', $user_id);
        $query->execute();
        return null; 
    }
    public function deleteUsers($user_id)
    {
        $query = $this->DBH->prepare("DELETE FROM users WHERE user_id=:user_id");
        $query->bindParam(':user_id', $user_id);
        $query->execute();
        return null; 
    }
    public function logOut()
    {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("username", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
        setcookie("root", "", time() - 3600*24*30*12, "/");
    }
    public function getHashAndID($userID)
    {
        $query = $this->DBH->prepare("SELECT * FROM users WHERE user_id=:id LIMIT 1");
        $query->bindParam(':id', $userID);
        $query->execute();
        $userdata = $query->fetch(PDO::FETCH_ASSOC);
        return $userdata;
    }
    public function getHashAndIDStaff($userID)
    {
        $query = $this->DBH->prepare("SELECT * FROM staff WHERE user_id=:id LIMIT 1");
        $query->bindParam(':id', $userID);
        $query->execute(); 
        $userdata = $query->fetch(PDO::FETCH_ASSOC);
        return $userdata;
    }
    public function getRating()
    {
        $query = $this->DBH->prepare("SELECT * FROM users WHERE user_status='1' ORDER BY user_rating DESC");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getEvent($id)
    {
        $query = $this->DBH->prepare("SELECT * FROM event WHERE id=:id LIMIT 1");
        $query->bindParam(':id', $id);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getUsers($group_id)
    {
        $query = $this->DBH->prepare("SELECT * FROM users WHERE group_id=:group_id AND user_status='1'");
        $query->bindParam(':group_id', $group_id);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getUnconfirmedUsers()
    {
        $query = $this->DBH->prepare("SELECT * FROM users WHERE user_status='0'");
        // $query->bindParam(':user_status', '0');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getMarks($event_id)
    {
        $query = $this->DBH->prepare("SELECT * FROM marks WHERE event_id=:event_id");
        $query->bindParam(':event_id', $event_id);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getInfo()
    {
        $query = $this->DBH->prepare("SELECT * FROM info");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getCategoryRating($category)
    {
        $query = $this->DBH->prepare("SELECT * FROM users WHERE group_id = :category AND user_status='1' ORDER BY user_rating DESC");
        $query->bindParam(':category', $category);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getCabinet($login)
    {
        $query = $this->DBH->prepare("SELECT * FROM info WHERE user_login = :login LIMIT 1");
        $query->bindParam(':login', $login);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getCategory()
    {
        $query = $this->DBH->prepare("SELECT id, name FROM category");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getTheCategory($id)
    {
        $query = $this->DBH->prepare("SELECT name FROM category WHERE id = :id LIMIT 1");
        $query->bindParam(':id', $id);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>