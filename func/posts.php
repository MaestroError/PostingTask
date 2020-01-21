<?php
$mainlibrary = $_SERVER["DOCUMENT_ROOT"] . "/lib/mainlib.php";

include_once($mainlibrary);

function new_post($heading, $desc, $author) {

      include_once("pdo.php");
      $conn = db_connect($GLOBALS['db_main']);

$sql = "INSERT INTO posts (heading, post_text,	author ) VALUES (:heading, :post_text, :author)";

$data = [
  'heading' => $heading,
  'post_text' => $desc,
  'author' => $author
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

function del_post($pk1) {

  $pk = strip_tags(htmlspecialchars($pk1));

      try {

        include_once("pdo.php");
        $conn = db_connect($GLOBALS['db_main']);

          $sql = "DELETE FROM posts WHERE pk=:pk";

          $data = [
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

function userposts($username, $pk) {

    try  {

      $author = $username . " (" . $pk . ")";
      include_once("pdo.php");
      $conn = db_connect($GLOBALS['db_main']);

          $query = "SELECT * FROM posts WHERE author = '$author'";
          $data = $conn->query($query)->fetchAll();
          return $data;

 } catch(PDOException $error) {
      $message = $error->getMessage();
      $conn = NULL;
      return $message;
 }

}

?>
