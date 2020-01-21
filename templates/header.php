<?php

// Post form handling

if (isset($_POST['new_post'])) {
  $header = strip_tags(htmlspecialchars($_POST['heading']));
  $text = strip_tags(htmlspecialchars($_POST['text']));
  $author = $_SESSION['username'] . " (" . $_SESSION['user_pk'] . ")";
  new_post($header, $text, $author);
  header("location: /");
}

if (isset($_POST['del_post'])) {
  del_post($_POST['pk']);
  header("location: /");
}

// Forms handling

if (isset($_POST['reset_password'])) {
  $email = strip_tags(htmlspecialchars($_POST['email']));
  if (reset_password($email)) {
    $msg = "Please check $email e-mail!";
  }
}

if (isset($_POST['register'])) {

  if (!empty($_POST['password']) && !empty($_POST['username']) && !empty($_POST['email'])) {
    $username = strip_tags(htmlspecialchars($_POST['username']));
    $password = strip_tags(htmlspecialchars($_POST['password']));
    $email = strip_tags(htmlspecialchars($_POST['email']));
    if (username_check($username)) {
      $register = register($username, $password, $email);
      if ($register) {
        $msg = "You are registeres Successfully! you can login now...";
      } else {
        $msg = "[" . $register . "]. Something went wrong, try again or contact support";
      }
    } else {
      $msg = "Username Exists!";
    }
  } else {
    $msg = "Please fill all required fields!";
  }

}

if (isset($_POST['login'])) {
  $username = strip_tags(htmlspecialchars($_POST['username']));
  $password = strip_tags(htmlspecialchars($_POST['password']));
  $login = login($username, $password);
  if ($login) {
    $msg = "User logged in Successfully!";
  } else {
    $msg = "Something went wrong, try again or contact support";
  }
}

  if (isset($_GET['logout'])) {
    session_destroy();
    header("location: /");
  }

 ?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="description" content="<?php echo $desc; ?>">
<meta name="keywords" content="<?php echo $keywords; ?>">
<meta name="author" content="MaestroError">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php echo $title; ?></title>

<meta property="og:title" content="<?php echo $title; ?>" />

<meta property="og:url" content="<?php echo $url; ?>" />

<meta property="og:description" content="<?php echo $desc; ?>" />

<meta property="og:image" content="<?php echo $url . '/img/favicon.png'; ?>" />

<link rel="shortcut icon" type="image/png" href="<?php echo $favicon; ?>"/>
<link rel="icon" type="image/png" href="<?php echo $favicon; ?>"/>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<link rel="stylesheet" href="<?php echo $url . 'static/style.css'; ?>">

</head>
<body>


<?php if (!empty($msg)) { ?>
  <div class="alert alert-primary">
    <?php echo $msg; ?>
  </div>
<?php } ?>
