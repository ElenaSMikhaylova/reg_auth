<?php
class User
{
    private $name;
    private $lastname;
    private $email;
    private $id;

    function __construct($id, $name, $lastname, $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->email = $email;
    }
    function getId()
    {
        return $this->id;
    }
    function getName()
    {
        return $this->name;
    }
    function getLastname()
    {
        return $this->lastname;
    }

    function getEmail()
    {
        return $this->email;
    }


    //Статический метод регистрации пользователя
    static function addUser($name, $lastname, $email, $pass)
    {
        global $mysqli;
        $email = trim(mb_strtolower($email));
        $pass = trim($pass);
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $result = $mysqli->query("SELECT * FROM `users` WHERE `email` = '$email'");

        if ($result->num_rows != 0) {
            return json_encode(["result" => "exist"]);
        } else {
            $mysqli->query("INSERT INTO `users`(`name`, `lastname`, `email`, `pass`) VALUES ('$name', '$lastname', '$email','$pass')");
            return json_encode(["result" => "success"]);
        }
        //echo "User added";
        //var_dump($mysqli);
    }
    //Статический метод авторизации пользователя
    static function authUser($email, $pass)
    {
        global $mysqli;
        //return "Авторизация пользователя";
        $email = trim(mb_strtolower($_POST['email']));
        $pass = trim($_POST['pass']);

        $result = $mysqli->query("SELECT * FROM `users` WHERE `email` = '$email'");
        $result = $result->fetch_assoc();

        //var_dump($result["pass"]);

        if (password_verify($pass, $result["pass"])) {
            //$_SESSION['name'] = $result['name'];
            //$_SESSION['lastname'] = $result['lastname'];
            //$_SESSION['email'] = $result['email'];
            //$_SESSION['id'] = $result['id'];
            return json_encode(["otvet" => "ok"]);
        } else {
            return json_encode(["otvet" => "user_not_found"]);
        }
    }
}

