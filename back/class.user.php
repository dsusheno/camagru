<?php
class USER
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }

    private function email_register($login, $pwd_activation, $email)
    {
      $message = "Hello {$login}!\n\nIt'is Activation Code for your accaount: {$pwd_activation}\n\nSincerely,\nTeam PicYourSelf.";

      mail($email, 'Account activation', $message);
    }

    public function register($login,$pwd,$email)
    {
       try
       {
            $login = htmlentities($login);
            $email = addslashes($email);
            $pwd_activation = $this->pwd_generate();
            $stmt = $this->db->prepare("INSERT INTO users(login, pwd, email, activated, pwd_activation)
              VALUES(:login, :pwd, :email, 0, :pwd_activation)");
               
            $stmt->bindparam(":login", $login);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":pwd", $pwd);
            $stmt->bindparam(":pwd_activation", $pwd_activation);            
            $stmt->execute(); 
            
            $this->email_register($login, $pwd_activation, $email);
            return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 
    public function login($login,$pwd)
    {
       try
       {
          $login = addslashes($login);
          $stmt = $this->db->prepare("SELECT * FROM users WHERE login=:login");
          $stmt->execute(array(':login'=>$login));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
             if($pwd === $userRow['pwd'] && $userRow['activated'] == 1)
             {
                $_SESSION['user_session'] = $userRow['login'];
                return true;
             }
             else
             {
                return false;
             }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }

   public function pwd_generate()
   {
      $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP"; 
      $max = 10; 
      $size = StrLen($chars)-1; 
      $password = null; 
      while($max--) 
      $password.=$chars[rand(0,$size)];

      return $password;
   }

   public function change_pwd($login, $new_pwd)
   {
      $pwd_md5 = md5($new_pwd);
      $user_select = $this->db->prepare("UPDATE users SET pwd = '{$pwd_md5}' WHERE login = :login");
      $user_select->execute(array(':login'=>$login));
   }

   public function get_pwd($login)
   {
      $user_select = $this->db->prepare("SELECT pwd from users WHERE login = :login");
      $user_select->execute(array(':login'=>$login));
      $pwd = $user_select->fetchAll();
      return $pwd[0]["pwd"];
   }

   public function new_pwd_mail($email, $login, $new_pwd)
   {
      $message = "Hello {$login}!\n\nIt'is your new password: {$new_pwd}\n\nYou can change him on your profile page.\n\nSincerely,\nTeam PicYourSelf.";

      mail($email, 'Forgotten Password', $message);
   }

   public function new_comment($email, $login, $user_comment, $comment)
   {
    $message = "Hello {$login}!\n\nYou have a new comment from {$user_comment} on one of your image.\n\nComment: \" {$comment} \"\n\nSincerely,\nTeam PicYourSelf.";

      mail($email, 'New Comment', $message);
   }

   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
        return true;
      else
        return false;
   }
 
   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }
}
?>