
<?php

$mainlibrary = $_SERVER["DOCUMENT_ROOT"] . "/lib/mainlib.php";

include_once($mainlibrary);

function approve($username1, $author1, $pk1) {

  $pk = strip_tags(htmlspecialchars($pk1));
  $username = strip_tags(htmlspecialchars($username1));
  $author = strip_tags(htmlspecialchars($author1));

      try {

        include_once("pdo.php");
        $conn = db_connect($GLOBALS['db_main']);

          $sql = "UPDATE user SET status='guest' WHERE username=:username AND pk=:pk";

          $data = [
            'username' => $username,
            'pk' => $pk
          ];

          $stmt= $conn->prepare($sql);
           if ($stmt->execute($data)) {
             $conn = NULL;
             include_once('note.php');
             $heading1 = "User Approved";
             $desc1 = "<a href='" . $url . "guest?username=" . $username . "'> " . $username . " </a>" . "User approved by " . $author;
             $type1 = "status";
             $status1 = "maestro";
             new_note($heading1, $desc1, $type1, '', $status1);
             $heading2 = "User Updated";
             $desc2 = "Your are approved by " . "<a href='" . $url . "guest?username=" . $author . "'> " . $author . " </a>";
             $type2 = "pk";
             $status2 = $pk;
             new_note($heading2, $desc2, $type2, $status2, '');
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

function del_manager($username1, $author1, $pk1) {

  $pk = strip_tags(htmlspecialchars($pk1));
  $username = strip_tags(htmlspecialchars($username1));
  $author = strip_tags(htmlspecialchars($author1));

      try {

        include_once("pdo.php");
        $conn = db_connect($GLOBALS['db_main']);

          $sql = "UPDATE user SET status='notactive' WHERE username=:username AND pk=:pk";

          $data = [
            'username' => $username,
            'pk' => $pk
          ];

          $stmt= $conn->prepare($sql);
           if ($stmt->execute($data)) {
             $conn = NULL;
             include_once('note.php');
             $heading1 = "Manager deleted";
             $desc1 = "<a href='" . $url . "guest?username=" . $username . "'> " . $username . " </a>" . "Manager deactivated by " . $author;
             $type1 = "status";
             $status1 = "maestro";
             new_note($heading1, $desc1, $type1, '', $status1);
             $heading2 = "Profile deactivated";
             $desc2 = "Your Profile deactivated by " . "<a href='" . $url . "guest?username=" . $author . "'> " . $author . " </a>";
             $type2 = "pk";
             $status2 = $pk;
             new_note($heading2, $desc2, $type2, $status2, '');
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


function set_manager($username1, $author1, $pk1) {

  $pk = strip_tags(htmlspecialchars($pk1));
  $username = strip_tags(htmlspecialchars($username1));
  $author = strip_tags(htmlspecialchars($author1));

      try {

        include_once("pdo.php");
        $conn = db_connect($GLOBALS['db_main']);

          $sql = "UPDATE user SET status='maestro' WHERE username=:username AND pk=:pk";

          $data = [
            'username' => $username,
            'pk' => $pk
          ];

          $stmt= $conn->prepare($sql);
           if ($stmt->execute($data)) {
             $conn = NULL;
             include_once('note.php');
             $heading1 = "User Set as Manager";
             $desc1 = "<a href='" . $url . "guest?username=" . $username . "'> " . $username . " </a>" . "User Set as Manager by " . $author;
             $type1 = "status";
             $status1 = "maestro";
             new_note($heading1, $desc1, $type1, '', $status1);
             $heading2 = "You are manager!";
             $desc2 = "Your are set as manager by " . "<a href='" . $url . "guest?username=" . $author . "'> " . $author . " </a>";
             $type2 = "pk";
             $status2 = $pk;
             new_note($heading2, $desc2, $type2, $status2, '');
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

function delete_user($username1, $author1, $pk1) {

  $pk = strip_tags(htmlspecialchars($pk1));
  $username = strip_tags(htmlspecialchars($username1));
  $author = strip_tags(htmlspecialchars($author1));

      try {

        include_once("pdo.php");
        $conn = db_connect($GLOBALS['db_main']);

          $sql = "DELETE FROM user WHERE username=:username AND pk=:pk";

          $data = [
            'username' => $username,
            'pk' => $pk
          ];

          $stmt= $conn->prepare($sql);
           if ($stmt->execute($data)) {
             $conn = NULL;
             include_once('note.php');
             $heading1 = "User Deleted";
             $desc1 = "<a href='" . $url . "guest?username=" . $username . "'> " . $username . " </a>" . "User Deleted by " . $author;
             $type1 = "status";
             $status1 = "maestro";
             new_note($heading1, $desc1, $type1, '', $status1);
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
?>
