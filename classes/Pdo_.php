<?php
require './htmlpurifier-4.15.0/library/HTMLPurifier.auto.php';
include_once 'classes/Aes.php';

class Pdo_
{
    private $db;
    private $purifier;
    public function __construct()
    {
        $config = HTMLPurifier_Config::createDefault();
        $this->purifier = new HTMLPurifier($config);
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=php', 'Illia', 'Php2211.');
        } catch (PDOException $e) {
            // add relevant code
            die();
        }
    }

    public function add_user($login, $email, $password)
    {
        //generate salt
        $salt = random_bytes(16);
        $password = Aes::encrypt($password);

        //hash password with salt
        $password = hash('sha512', $password . $salt);
        $login = $this->purifier->purify($login);
        $email = $this->purifier->purify($email);
        try {
            $sql = "INSERT INTO `user`( `login`, `email`, `hash`, `salt`, `id_status`, `password_form`)
 VALUES (:login,:email,:hash,:salt,:id_status,:password_form)";
            //hash password
            $password = hash('sha512', $password);
            $data = [
                'login' => $login,
                'email' => $email,
                'hash' => $password,
                'salt' => $salt,
                'id_status' => '1',
                'password_form' => '1'
            ];
            $this->db->prepare($sql)->execute($data);
        } catch (Exception $e) {
            //modify the code here
            print 'Exception' . $e->getMessage();
        }
    }


    public function log_user_in($login, $password)
    {
        $salt = random_bytes(16);
        $pepper = "pepper";
        $sql = "SELECT id,hash,login,salt FROM user
        WHERE login=:login";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['login' => $login]);
        $user_data = $stmt->fetch();
        $password = hash('sha512', $password . $user_data['salt']);

        $login = $this->purifier->purify($login);
        try {
            $sql = "SELECT id,hash,login FROM user WHERE login=:login";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['login' => $login]);
            $user_data = $stmt->fetch();
            //hash password with salt and pepper
            if (hash_equals($password, $user_data['hash'])) {
                echo 'login successfull<BR/>';
                echo 'You are logged in as: ' . $user_data['login'] . '<BR/>';
            } else {
                echo 'login FAILED<BR/>';
            }
        } catch (Exception $e) {
            //modify the code here
            print 'Exception' . $e->getMessage();
        }
    }
    public function change_pass($login, $password)
    {
        $salt = random_bytes(16);
        $password = hash('sha512', $password . $salt);
        $login = $this->purifier->purify($login);
        try
        {
            $sql = "UPDATE `user` 
                    SET `hash`=:hash, `salt`=:salt 
                    WHERE `login`=:login";
            $data = [
                'login' => $login,
                'hash' => $password,
                'salt' => $salt,
            ];
            $this
                ->db
                ->prepare($sql)->execute($data);
            print 'Success';
        }
        catch(Exception $e)
        {
            //modify the code here
            print 'Exception' . $e->getMessage();
        }
    }
    // Dodac wiadomosc
    public function addMessage($name, $type, $content)
    {
        var_dump($name, $type, $content);
        if (!$type)
            return false;
        $sql = "INSERT INTO message (`name`,`type`, `message`,`deleted`)
            VALUES ('" . $name . "','" . $type . "','" . $content . "',0)";
        echo $sql;
        echo "<br>";
        return $this->db->query($sql);
    }
    // Edytowac wiadomosc
    public function editMessage($name, $type, $content, $id)
    {
        if (!$type) {
            return false;
        }
        $sql = "UPDATE message SET name='" . $name . "', type='" . $type . "', message='" . $content . "' WHERE id=" . $id . "";
        echo $sql;
        echo "<br>";
        return $this->db->query($sql);
    }
}