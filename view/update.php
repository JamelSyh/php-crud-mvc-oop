<?php
include_once("header.php");
require_once("../controller/update_controller.php");
$row = get_data();
?>

<body>
  <div class="container">
    <form class="shadow-lg p-3 mb-5 bg-white rounded" action="../controller/update_controller.php" method="post">
      <h4 class="display-4 text-center">Update</h4>
      <hr>
      <br>
      <?php include_once("alert.php"); ?>
      <input type="text" name="id" value="<?= $row["id"] ?>" hidden>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="name" class="form-control" id="name" name="name" <?php echo isset($row["name"]) ? "value=" . $row["name"] : "" ?> placeholder="Enter name">
      </div>

      <div class="form-group">
        <label for="number">Number</label>
        <input type="number" class="form-control" id="number" name="number" <?php echo isset($row["number"]) ? "value=" . $row["number"] : "" ?> placeholder="Enter number">
      </div>
      <button type="submit" class="btn btn-primary" name="update">Update</button>
      <a href="index.php" class="link-primary">View</a>
    </form>
  </div>
</body>

<?php include_once("footer.php"); ?>
