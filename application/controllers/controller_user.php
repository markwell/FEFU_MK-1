<?php
class Controller_User extends Controller
{ 
    function __construct()
    {
        $this->model = new Model_User();
        $this->view  = new View();
        $category = $this->model->getCategory();
        global $HTTP_POST_VARS;
        for ($i = 1; $i <= count($category); $i++) 
        {
            $HTTP_POST_VARS[$i] = $category[$i - 1];
        }
    }
    function action_showLogin()
    {
        $this->view->generate('login_view.php', 'template_view.php');
    }
    function action_showMain()
    {
        $this->view->generate('main_view.php', 'template_view.php');
    }  
    function action_showRegister()
    {
        $this->view->generate('register_view.php', 'template_view.php');
    }
    function action_showTimetable()
    {
        $this->view->generate('timetable_view.php', 'template_view.php');
    }
    function action_showEvent()
    {

        $roots = $this->model->checkRoots(); //проверяем права админа
        $event = $this->model->getEvent($_GET['id']); //берем данные из бд
        $users = $this->model->getUsers($event['0']['group_id']);
        $info = $this->model->getInfo();
        $marks = $this->model->getMarks($event['0']['id']);
        $staff = $this->model->getHashAndIDStaff($event['0']['staff_id']);
        $group = $this->model->getTheCategory($event['0']['group_id']);
        if (isset($_GET['edit'])) { //если редактирование event
            if (isset($_POST['submit'])) { //если нам что-то послали
                foreach ($marks as $row) {
                    if ($_POST[$row['user_id']] !== '') { //редактирование посещения
                        $error = $this->model->updateVisited($row['user_id'], $_POST[$row['user_id']], $_GET['id']);    
                    }
                    if ($_POST[m.$row['user_id']] !== '') { //редактирование оценок
                        $error1 = $this->model->updateMarks($row['user_id'], $_POST[m.$row['user_id']], $_GET['id']);    
                    }
                }
                header('Location:/shop/user/showEvent?id='.$_GET['id']);
            } else {
                $this->view->generate('main_view.php', 'template_view.php');
            }
        } else { //если просто построение event
            $this->view->generate('event_view.php', 'template_view.php', array(
                'event' => $event,
                'users' => $users,
                'info' => $info,
                'marks' => $marks,
                'staff' => $staff,
                'roots' => $roots,
                'group' => $group));
        }
    }
    function action_confirmation()
    {
        $users = $this->model->getUnconfirmedUsers();
        foreach ($users as $row) {
            if ($_POST[$row['user_id']] !== '0') { //подтвердить позже
                if ($_POST[$row['user_id']] == '1') { //подтверждение
                    $error = $this->model->updateUsers($row['user_id']);    
                }   
                if ($_POST[$row['user_id']] == '2') { //отклонение
                    $error = $this->model->deleteUsers($row['user_id']);    
                }    
            }
        }
        header('Location:/shop/user/getCabinetAndShow?login='.$_COOKIE['username']);
    }
    function action_updateInfo()
    {
        if ($_POST['phone_number'] !== '') {
        $error = $this->model->updateInfo($_POST['phone_number']);
        }
        if ($_POST['email'] !== '') {
        $error = $this->model->updateInfoEmail($_POST['email']);
        }
        header('Location:/shop/user/getCabinetAndShow?login='.$_COOKIE['username']);
    }
    function action_newUser()
    {
        if (isset($_POST['submit'])) {
            $error = $this->model->checkAndAddUser($_POST['login'], $_POST['password'], $_POST['repass'], $_POST['group']);
            if (count($error) == 0) {
                $this->view->generate("registerInfo_view.php", 'template_view.php');
            } else {
                $this->view->generate('register_view.php', 'template_view.php', array(
                    'error' => $error
                ));
            }
        }     
    }
    function action_newUserInfo()
    {
        if (isset($_POST['submit'])) {
            $error = $this->model->checkAndAddUserInfo($_POST['name'], $_POST['family_name'], $_POST['email'], $_POST['phone_number'], $_POST['middle_name']);
                $message = 'Регистрация прошла успешно!';
                setcookie("login_temp", "", time() - 3600*24*30*12);
                $this->view->generate("login_view.php", 'template_view.php', $message);
        }
    }
    function action_authUser()
    {
        if (isset($_POST['submit'])) {
            if (isset($_POST['checkStaff'])) {
                $error = $this->model->checkAndAuthStaff($_POST['login'], $_POST['password']);
                if (is_null($error)) {

                    header('Location:/shop/user/checkStaff');
                } else {
                    $this->view->generate('login_view.php', 'template_view.php', $error);
                }
            } else {
                $error = $this->model->checkAndAuthUser($_POST['login'], $_POST['password']);
                if (is_null($error)) {
                    header('Location:/shop/user/checkUser');
                } else {
                    $this->view->generate('login_view.php', 'template_view.php', $error);
                }
            }
        }
    }
    
    function action_checkUser()
    {
        $userdata = $this->model->getHashAndID(intval($_COOKIE['id']));
        if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
            if (($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])) {
                setcookie("id", "", time() - 3600*24*30*12, "/");
                setcookie("username", "", time() - 3600*24*30*12, "/");
                setcookie("hash", "", time() - 3600*24*30*12, "/");
                $message = "Авторизуйтесь пожалуйста.";
                $this->view->generate('login_view.php', 'template_view.php', $message);
            } else {

                $message = "Привет, ".$userdata['user_login'].". Все отлично!";
                $this->view->generate('main_view.php', 'template_view.php', $message);
            }
        } else {
                $message = "Пожалуйста, включите куки.";
                $this->view->generate('login_view.php', 'template_view.php', $message);
        }
    }
    function action_checkStaff()
    {
        $userdata = $this->model->getHashAndIDStaff(intval($_COOKIE['id']));
        if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
            if (($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])) {
                setcookie("id", "", time() - 3600*24*30*12, "/");
                setcookie("username", "", time() - 3600*24*30*12, "/");
                setcookie("hash", "", time() - 3600*24*30*12, "/");
                $message = "Авторизуйтесь пожалуйста.";
                $this->view->generate('login_view.php', 'template_view.php', $message);
            } else {

                $message = "Привет, ".$userdata['user_login'].". Все отлично!";
                $this->view->generate('main_view.php', 'template_view.php', $message);
            }
        } else {
                $message = "Пожалуйста, включите куки.";
                $this->view->generate('login_view.php', 'template_view.php', $message);
        }
    }
    function action_logoutUser()
    {
        $logout = $this->model->logOut();
        header('Location: /shop/user/showMain');
    }
    // function action_editUser()
    // {
    //     $logout = $this->model->logOut();
    //     header('Location: /shop/user/showMain');
    // } 
    function action_getRatingAndShow()
    {
        @$category = $_GET['group'];
        if (!empty($category)) //если в url есть параметр 'category', то оставляем элементы только с указанной категорией
        {
          $rating = $this->model->getCategoryRating($category); //вытаскиваем все элементы указанной категории
        } else {
          $rating = $this->model->getRating(); //вытаскиваем все строки из бд
        }

        $info = $this->model->getInfo();
        
        $this->view->generate('rating_view.php', 'template_view.php', array('rating' => $rating,'info' => $info));//передаем View
    }
    function action_getCabinetAndShow()
    {
        
        //$root = $this->checkHash();
        @$login = $_GET['login'];
        if (empty($login)) //проверяем наличие логина в строке и куках
        {
          $this->view->generate('login_view.php', 'template_view.php'); //отправляем на авторизацию
        } else {
          $info = $this->model->getCabinet($login); //вытаскиваем контактную информацию пользователя
          $users = $this->model->getHashAndID($_COOKIE['id']);
          $theCategory = $this->model->getTheCategory($users['group_id']);
          $roots = $this->model->checkRoots(); //проверяем права админа
          if ($roots == '1') {
            $unconfirmedUsers = $this->model->getUnconfirmedUsers(); //вытаскиваем неподтвержденных пользователей
            $unconfirmedInfo = $this->model->getInfo();
            $category = $this->model->getCategory();
          }
          $this->view->generate('cabinet_view.php', 'template_view.php', array('info' => $info, 'users' => $users, 'theCategory' => $theCategory, 'roots' => $roots, 'unconfirmedUsers' => $unconfirmedUsers, 'unconfirmedInfo' => $unconfirmedInfo, 'category' => $category));//передаем View
        }   
    }
    function checkHash()
    {
        $userdata = $this->model->getHashAndID(intval($_COOKIE['id']));
        if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
            if (($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])) {
                setcookie("id", "", time() - 3600*24*30*12, "/");
                setcookie("username", "", time() - 3600*24*30*12, "/");
                setcookie("hash", "", time() - 3600*24*30*12, "/");
                $message = "Авторизуйтесь пожалуйста.";
                $this->view->generate('login_view.php', 'template_view.php', $message);
            } else {
                return 1;
            }
        } else {
            $message = "Пожалуйста, включите куки.";
            $this->view->generate('login_view.php', 'template_view.php', $message);
        }
    }
}