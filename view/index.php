<?php
include_once("header.php");

require_once("../controller/read_controller.php");
require_once("../controller/pagination_controller.php");
require_once("../controller/search_controller.php");

$input = get_limit_data();
$result = $input["data"];
?>

<div class="container mt-3 mb-4">
  <h4 class="display-4 text-center">Read</h4>
  <div class="col-lg-9 mt-4 mt-lg-0">
    <div class="row">
      <div class="col-md-12">
        <div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm rounded">
          <?php include_once("alert.php"); ?>
          <table class="table manage-candidates-top mb-0 rounded">
            <thead>
              <tr>
                <th>Candidate Name</th>
                <th class="text-center">Group</th>
                <th class="action text-right">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($result)) { ?>
                <tr>
                  <th>No Data</th>
                </tr>
                <?php
              } else {
                foreach ($result as $key => $value) {
                ?>
                  <tr class="candidates-list">
                    <td class="title">
                      <div class="thumb">
                        <img class="img-fluid" src=<?php echo $value["photo"] != "null" ? $value["photo"] : "https://bootdey.com/img/Content/avatar/avatar" . ($value["id"] % 7 + 1) . ".png"; ?> alt="">
                      </div>
                      <div class="candidate-list-details">
                        <div class="candidate-list-info">
                          <div class="candidate-list-title">
                            <h5 class="mb-0"><a href="view.php?id=<?= $value["id"] ?>"><?php echo $value["nom"] . " " . $value["prenom"]; ?></a></h5>
                          </div>
                          <div class="candidate-list-option">
                            <ul class="list-unstyled">
                              <li><?php echo $value["email"]; ?></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="candidate-list-favourite-time text-center">
                      <span class="candidate-list-time order-1"><?php echo $value["groupe"]; ?></span>
                    </td>
                    <td>
                      <ul class="list-unstyled mb-0 d-flex justify-content-end">
                        <li>
                          <a href="view.php?id=<?= $value["id"] ?>" class="text-primary" data-toggle="tooltip" title="" data-original-title="view">
                            <i class="far fa-eye"></i>
                          </a>
                        </li>
                        <li>
                          <a href="../view/update.php?id=<?= $value["id"] ?>" class="text-info" data-toggle="tooltip" title="" data-original-title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                          </a>
                        </li>
                        <li>
                          <a href="../controller/delete_controller.php?id=<?= $value["id"] ?>" class="text-danger" data-toggle="tooltip" title="" data-original-title="Delete">
                            <i class="far fa-trash-alt"></i>
                          </a>
                        </li>
                      </ul>
                    </td>
                  </tr>
              <?php }
              } ?>
            </tbody>
          </table>
          <div class="text-center mt-3 mt-sm-3">
            <ul class="pagination justify-content-center mb-0">
              <?php include_once("pagination.php"); ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  </body>
  <?php include_once "footer.php"; ?>
