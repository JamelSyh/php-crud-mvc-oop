<?php
if (!isset($_SESSION)) {
  session_start();
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Create</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
</head>

<body>

  <nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
      <div>
        <a class="navbar-brand" href="index.php">Students</a>
        <a class="navbar-item" href="create.php">create</a>
      </div>
      <form class="d-flex" action="index.php" method="get" role="search">
        <input class="form-control " type="search" id="input" name="input" value="<?php if (isset($_GET["input"])) echo ($_GET["input"]); ?>" placeholder="Search" aria-label="Search">
        <div style="width:10px;"></div>
        <button class="btn btn-outline-success search-btn mx-auto" name="search" type="submit">
          Search
        </button>
      </form>
    </div>
  </nav>
