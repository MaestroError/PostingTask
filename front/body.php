<?php if (isset($_GET['pk'])){

  $onepost = post($_GET['pk']);

  ?>

  <?php  foreach ($onepost as $post) { ?>

<a href="/front/" class="btn btn-secondary m-4">Back</a>

<div class="container mt-4">
  <div class="mt-4 col-md-12 col-12 row m-0">
    <div class="col-md-12 user-data text-center">
        <h1><?php echo $post['heading']; ?>
        </h1>
      <small><?php echo $post['author']; ?></small>
      <p><?php echo $post['post_text']; ?></p>
    </div>
  </div>
</div>

  <?php } ?>

<?php } else {

  $posts = posts();

   ?>

  <?php  foreach ($posts as $post) { ?>
      <div class="container mt-4">
        <div class="mt-4 col-md-12 col-12 row m-0">
          <div class="col-md-12 user-data">
            <a href="<?php echo $url . "front/?pk=" . $post['pk']; ?>">
              <h2><?php echo $post['heading']; ?>
              </h2>
            </a>
            <small><?php echo $post['author']; ?></small>
            <p><?php echo $post['post_text']; ?></p>
          </div>
        </div>
      </div>
        <hr>
  <?php } ?>

<?php } ?>
