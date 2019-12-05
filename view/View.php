<!DOCTYPE html>
<html lang="en">

<head>
    <title>SkålEiga - <?php echo $pagetitle; ?></title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="icon" href="assets/icons/favicon.ico" type="image/x-icon">
    <link href="assets/css/styles.css" type="text/css" rel="stylesheet">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
  <header>
    <nav class="blue-grey darken-3" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="index.php" class="brand-logo">SkålEiga</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="index.php">Home</a></li>
          <?php
          if(Session::is_admin()) {
              echo '<li><a href="index.php?action=readAll&controller=user">Users</a></li>';
          }
          ?>
        <li><a href="index.php?action=readAll&controller=film">Films</a></li>
        <li><a href="index.php?action=readAll&controller=category">Categories</a></li>
        <li><a href="index.php?action=readAll&controller=director">Directors</a></li>
        <li><a href="index.php?action=read&controller=cart">Cart</a></li>
          <?php
          if(Session::is_loggedin()) {
              echo '<li><a class="waves-effect waves-light btn-large grey darken-3" href="index.php?controller=user&action=disconnect">Disconnect</a></li>';
          } else {
              echo '<li><a class="waves-effect waves-light btn-large grey darken-3" href="index.php?controller=user&action=connect">Connect</a></li>';
          }
          ?>

      </ul>

      <ul id="slide-out" class="sidenav">
        <li><a href="index.php">Home</a></li>
          <?php
          if(Session::is_admin()) {
              echo '<li><a href="index.php?action=readAll&controller=user">Users</a></li>';
          }
          ?>
        <li><a href="index.php?action=readAll&controller=film">Films</a></li>
        <li><a href="index.php?action=readAll&controller=category">Categories</a></li>
        <li><a href="index.php?action=readAll&controller=director">Directors</a></li>
        <li><a href="index.php?action=read&controller=cart">Cart</a></li>
          <?php
          if(Session::is_loggedin()) {
              echo '<li><a class="waves-effect waves-light btn-large grey darken-3" href="index.php?controller=user&action=disconnect">Disconnect</a></li>';
          } else {
              echo '<li><a class="waves-effect waves-light btn-large grey darken-3" href="index.php?controller=user&action=connect">Connect</a></li>';
          }
          ?>
      </ul>
      <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
    </nav>
  </header>

  <?php
  if(isset($obj)){
      require File::build_path(array("view", $obj, "$view.php"));
  } else {
      require File::build_path(array("view", static::$object, "$view.php"));
  }
  ?>

  <footer class="page-footer blue-grey darken-3">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5>Who are we ? </h5>
          <p class="grey-text text-lighten-4">We are a multilingual team of unpaid students who works on multiple projects at the same time but it's great !</p>


        </div>
        <div class="col l3 s12">
        <?php
        if(Session::is_admin()) {
          echo '<h5>Add</h5>
          <ul>
          <li><a class="red-text text-lighten-1" href="index.php?action=add&controller=film">Movie</a></li>
          <li><a class="red-text text-lighten-1" href="index.php?action=add&controller=category">Category</a></li>
          <li><a class="red-text text-lighten-1" href="index.php?action=add&controller=director">Director</a></li>
          <li><a class="red-text text-lighten-1" href="index.php?action=add&controller=user">User</a></li>
          </ul>';
        }
        ?>
        </div>
        <div class="col l3 s12">
          <h5>See</h5>
          <ul>
            <li><a class="red-text text-lighten-1" href="index.php?action=readAll&controller=film">Movies</a></li>
            <li><a class="red-text text-lighten-1" href="index.php?action=readAll&controller=category">Categories</a></li>
            <li><a class="red-text text-lighten-1" href="index.php?action=readAll&controller=director">Directors</a></li>
            <?php
              if(Session::is_admin()) {
                echo '<li><a class="red-text text-lighten-1" href="index.php?action=readAll&controller=user">Users</a></li>';
              }
            ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made by BOULAY Pierre-Yves, JORDA Léa, TRIBES Tristan
      </div>
    </div>
  </footer>
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <!-- Materialize functions-->
  <script>
    $(document).ready(function(){
      $('.sidenav').sidenav();
    });
  </script>
</body>
