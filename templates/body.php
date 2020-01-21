


<?php if (login_check()) {

$posts = userposts($_SESSION['username'], $_SESSION['user_pk']);

  ?>

  <a href="?logout" class="btn btn-secondary m-4">Log Out</a>

<div class="container mt-4">
  <form action="" method="post">
  <div class="form-group">
    <label>Headng</label>
    <input type="text" name="heading" class="form-control" placeholder="Post's Heading">
  </div>
  <div class="form-group">
    <label>Text</label>
    <textarea class="form-control" name="text" rows="3"></textarea>
  </div>
  <input type="submit" name="new_post" value="Add post">
</form>
</div>


  <div class="container mt-4">
    <h3 class="text-center">Posts</h3>
    <div class="row">

      <?php  foreach ($posts as $post) { ?>
            <div class="col-md-4 col-12 row m-0">
              <div class="col-md-8 user-data">
                <a target="_blank" href="<?php echo $url . "front/?pk=" . $post['pk']; ?>">
                  <h4><?php echo $post['heading']; ?>
                  </h4>
                </a>
                <small><?php echo $post['author']; ?></small>
                <p><?php // echo $post['post_text']; ?></p>
                <form class="" action="" method="post">
                  <input type="hidden" name="pk" value="<?php echo $post['pk']; ?>">
                  <input class="btn btn-danger" type="submit" name="del_post" value="X">
                </form>
              </div>
            </div>
      <?php } ?>

    </div>
  </div>

  

<?php } else { ?>

    <a href="#reg" class="btn btn-secondary m-4">Log Out</a>

<div style="margin-top:120px; padding:100px" class="container">
  <h2>Log In</h2>
  <form method="post" action="">
    <div class="form-group">
      <label>Username</label>
      <input type="text" class="form-control" placeholder="Enter Username" name="username">
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" class="form-control" placeholder="Password">
    </div>
    <input type="submit" name="login" class="btn btn-primary" value="Log In">
  </form>
</div>

<hr> <h1 id="reg">OR</h1>

<div style="margin-top:40px; padding:100px" class="container">
  <h2>register</h2>
  <form method="post" action="">
    <div class="form-group">
      <label>Username</label>
      <input type="text" class="form-control" placeholder="Enter Username" name="username">
    </div>
    <div class="form-group">
      <label>E-mail</label>
      <input type="text" class="form-control" placeholder="Enter E-mail" name="email">
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" class="form-control" placeholder="Password">
    </div>
    <input type="submit" name="register" class="btn btn-primary" value="Log In">
  </form>
</div>




<?php } ?>
