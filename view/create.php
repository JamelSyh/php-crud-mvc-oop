<?php
include_once("header.php");
?>

<body>
  <div class="container">
    <form class="shadow-lg p-3 mb-5 bg-white rounded" action="../controller/create_controller.php" method="post" enctype="multipart/form-data">
      <h4 class="display-4 text-center">Create</h4>
      <hr>
      <br>



      <div class="mb-4">
        <div class="d-flex justify-content-center mb-4">
          <img src="https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.jpg" class="rounded-circle" id="input-image" alt="your image" style="width: 200px;" />
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
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="name" class="form-control" id="firstname" name="firstname" placeholder="Enter name">
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="name" class="form-control" id="lastname" name="lastname" placeholder="Enter name">
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter name">
      </div>
      <div class="form-group">
        <label for="group">Group</label>
        <input type="number" class="form-control" id="group" name="group" placeholder="Enter number">
      </div>

      <button type="submit" class="btn btn-primary" name="create">Create</button>
      <a href="index.php" class="link-primary">View</a>
    </form>
  </div>
</body>
<?php include_once("footer.php"); ?>
