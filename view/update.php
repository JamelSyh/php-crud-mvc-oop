<?php
include_once("header.php");
require_once("../controller/update_controller.php");
$row = get_data();
?>

<body>
  <div class="container">
    <form class="shadow-lg p-3 mb-5 bg-white rounded" action="../controller/update_controller.php" method="post" enctype="multipart/form-data">
      <h4 class="display-4 text-center">Update</h4>
      <hr>
      <br>
      <div class="mb-4">
        <div class="d-flex justify-content-center mb-4">
          <img src=<?php echo $row["photo"] ?? "https://bootdey.com/img/Content/avatar/avatar" . $row["Id"] % 7 + 1 . ".png"; ?> class="rounded-circle" id="input-image" alt="your image" style="width: 200px;" />
        </div>
        <div class="d-flex justify-content-center">
          <div class="btn btn-primary btn-rounded">
            <label class="form-label text-white m-1" for="customFile2">Choose file</label>
            <input type="file" name="photo" class="form-control d-none" id="customFile2" onchange="readURL(this);" />
          </div>
        </div>
      </div>
      <script>
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
              $('#input-image')
                .attr('src', e.target.result)
                .width(200)
                .height(200);
            };

            reader.readAsDataURL(input.files[0]);
          }
        }
      </script>
      <?php include_once("alert.php"); ?>
      <input type="text" name="id" value="<?= $row["Id"] ?>" hidden>
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="name" class="form-control" id="firstname" name="firstname" <?php echo isset($row["Prenom"]) ? "value=" . $row["Prenom"] : "" ?> placeholder="Enter name">
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="name" class="form-control" id="lastname" name="lastname" <?php echo isset($row["Nom"]) ? "value=" . $row["Nom"] : "" ?> placeholder="Enter name">
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" <?php echo isset($row["Email"]) ? "value=" . $row["Email"] : "" ?> placeholder="Enter name">
      </div>
      <div class="form-group">
        <label for="group">Group</label>
        <input type="number" class="form-control" id="group" name="group" <?php echo isset($row["groupe"]) ? "value=" . $row["groupe"] : "" ?> placeholder="Enter number">
      </div>

      <button type="submit" class="btn btn-primary" name="update">Update</button>
      <a href="index.php" class="link-primary">View</a>
    </form>
  </div>
</body>

<?php include_once("footer.php"); ?>
