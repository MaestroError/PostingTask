<?php
$mainlibrary = $_SERVER["DOCUMENT_ROOT"] . "/lib/mainlib.php";

include_once($mainlibrary);

function login_check() {


if (!isset($_SESSION['login']) || $_SESSION['login'] != 'yes') {
	return false;
}

if (isset($_SESSION['login']) && $_SESSION['login'] == 'yes') {
	return true;
}

}


function login($username, $user_password) {

    try  {

      include_once("pdo.php");
      $conn = db_connect($GLOBALS['db_main']);

          $query = "SELECT pk, password, status FROM user WHERE username = :username LIMIT 1";
          $statement = $conn->prepare($query);
          $statement->execute(array('username' => $username));
          $user = $statement->fetch();

          $count = $statement->rowCount();

          $password = password_verify($user_password, $user['password']);

        if ($password) {

          if($count > 0) {
            $_SESSION["username"] = $username;
            $_SESSION['login'] = "yes";
            $_SESSION['user_pk'] = $user['pk'];
            $_SESSION['user_status'] = $user['status'];
            $message = 'Loged in Successfully';
            $conn = NULL;
            return $message;
          } else {
            $message = 'Wrong Data';
            $conn = NULL;
            return $message;
          }
        }


 } catch(PDOException $error) {
      $message = $error->getMessage();
      $conn = NULL;
      return $message;
 }

}

function username_check($username) {

  include_once("pdo.php");
  $conn = db_connect($GLOBALS['db_main']);

      $query = "SELECT pk FROM user WHERE username = :username LIMIT 1";
      $statement = $conn->prepare($query);
      $statement->execute(array('username' => $username));
      $user = $statement->fetch();

      $count = $statement->rowCount();

      if ($count > 0) {
        $conn = NULL;
        return FALSE;
      } else {
        $conn = NULL;
        return TRUE;
      }


}

function register($username, $password, $email) {

      include_once("pdo.php");
      $conn = db_connect($GLOBALS['db_main']);

      $passhash = password_hash($password,  PASSWORD_BCRYPT);

$sql = "INSERT INTO user (username, password, mail, reg_date) VALUES (:username, :password, :mail, NOW())";

$data = [
  'username' => $username,
  'password' => $passhash,
  'mail' => $email
];

$stmt= $conn->prepare($sql);
 if ($stmt->execute($data)) {
   $conn = NULL;

   return TRUE;
 } else {
   $conn = NULL;
   return FALSE;
 }

}


function update_info($email, $text, $img, $pk, $author) {

      try {

        include_once("pdo.php");
        $conn = db_connect($GLOBALS['db_main']);

          $sql = "UPDATE user SET mail=:mail, user_desc=:user_desc, img=:img WHERE pk=:pk";

          $data = [
            'mail' => $email,
            'user_desc' => $text,
            'img' => $img,
						'pk' => $pk
          ];

          $stmt= $conn->prepare($sql);
           if ($stmt->execute($data)) {
             $conn = NULL;

             return TRUE;
           } else {
             $conn = NULL;
             return FALSE;
           }
          } catch(PDOException $e) {
          $message = $sql . "<br>" . $e->getMessage();
          $conn = null;
          return $message;
          }

      $conn = null;

}

function update_password($pk, $user_password, $newpass) {
  try  {

    include_once("pdo.php");
    $conn = db_connect($GLOBALS['db_main']);

        $query = "SELECT password FROM user WHERE pk = :pk LIMIT 1";
        $statement = $conn->prepare($query);
        $statement->execute(array('pk' => $pk));
        $user = $statement->fetch();

        $count = $statement->rowCount();

        $password = password_verify($user_password, $user['password']);

      if ($password) {

        if($count > 0) {
          $passhash = password_hash($newpass,  PASSWORD_BCRYPT);

          $sql = "UPDATE user SET password=:password WHERE pk=$pk";

          $data = [
            'password' => $passhash
          ];

          $stmt= $conn->prepare($sql);
           if ($stmt->execute($data)) {
             $conn = NULL;

             return TRUE;
           } else {
             $conn = NULL;
             return FALSE;
           }

          $message = 'Password updated Successfully';
          $conn = NULL;
          return $message;
        } else {
          $message = 'Wrong Data';
          $conn = NULL;
          return $message;
        }
      } else {
        $message = 'Wrong Data Password';
        $conn = NULL;
        return $message;
      }


} catch(PDOException $error) {
    $message = $error->getMessage();
    $conn = NULL;
    return $message;
}
}

function reset_password($email) {

  include_once("pdo.php");
  $conn = db_connect($GLOBALS['db_main']);

  $pin = rand(1000, 9000);
  $new_pass = "pass" . $pin;

  $passhash = password_hash($new_pass,  PASSWORD_BCRYPT);

  $sql = "UPDATE user SET password=:password WHERE mail=:mail";

  $data = [
    'password' => $passhash,
    'mail' => $email
  ];

  $stmt= $conn->prepare($sql);
   if ($stmt->execute($data)) {
     include_once('send_mail.php');
     $subject = "Password Reset";
     $body = "Your new password: " . $new_pass . ". Please delete this message for security reasons";
     send_mail($email, $subject, $body);
     $conn = NULL;
     return TRUE;
   } else {
     $conn = NULL;
     return FALSE;
   }
}


function post($pk) {

  $pk1 = strip_tags(htmlspecialchars($pk));

    try  {

      include_once("pdo.php");
      $conn = db_connect($GLOBALS['db_main']);

          $query = "SELECT * FROM posts WHERE pk = '$pk1'";
          $data = $conn->query($query)->fetchAll();
          return $data;

 } catch(PDOException $error) {
      $message = $error->getMessage();
      $conn = NULL;
      return $message;
 }

}

function posts() {

    try  {

      include_once("pdo.php");
      $conn = db_connect($GLOBALS['db_main']);

          $query = "SELECT * FROM posts";
          $data = $conn->query($query)->fetchAll();
          return $data;

 } catch(PDOException $error) {
      $message = $error->getMessage();
      $conn = NULL;
      return $message;
 }

}
?>
