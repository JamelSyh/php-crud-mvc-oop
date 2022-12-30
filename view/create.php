<?php
include_once("header.php");
?>

<body>
  <div class="container">
    <form class="shadow-lg p-3 mb-5 bg-white rounded" action="../controller/create_controller.php" method="post">
      <h4 class="display-4 text-center">Create</h4>
      <hr>
      <br>
      <?php include_once("alert.php"); ?>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="name" class="form-control" id="name" name="name" placeholder="Enter name">
      </div>

      <div class="form-group">
        <label for="number">Number</label>
        <input type="number" class="form-control" id="number" name="number" placeholder="Enter number">
      </div>

      <button type="submit" class="btn btn-primary" name="create">Create</button>
      <a href="index.php" class="link-primary">View</a>
    </form>
  </div>
</body>
<?php include_once("footer.php"); ?>
