<?php
include_once("header.php");
require_once("../controller/view_controller.php");

$row = get_data();
?>


<div class="container mt-3 mb-4">
  <div class="col-lg-9 mt-4 mt-lg-0">
    <div class="row">
      <div class="col-md-12">
        <div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm rounded">
          <table class="table manage-candidates-top mb-0 rounded">
            <thead>
              <tr>
                <th>Candidate Name</th>
                <th class="text-center">Group</th>
                <th class="action text-right">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr class="candidates-list">
                <td class="title">
                  <div class="thumb">
                    <img class="img-fluid" src=<?php echo $row["photo"] ?? "https://bootdey.com/img/Content/avatar/avatar" . $row["id"] % 7 + 1 . ".png" ?> alt="">
                  </div>
                  <div class="candidate-list-details">
                    <div class="candidate-list-info">
                      <div class="candidate-list-title">
                        <h5 class="mb-0"><a href="#"><?php echo $row["nom"] . " " . $row["prenom"]; ?></a></h5>
                      </div>
                      <div class="candidate-list-option">
                        <ul class="list-unstyled">
                          <li>
                            <?php echo $row["email"]; ?>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </td>
                <td class="candidate-list-favourite-time text-center">
                  <span class="candidate-list-time order-1"><?php echo $row["groupe"]; ?></span>
                </td>
                <td>
                  <ul class="list-unstyled mb-0 d-flex justify-content-end">
                    <li>
                      <a href="../view/update.php?id=<?= $row["id"] ?>" class="text-info" data-toggle="tooltip" title="" data-original-title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                      </a>
                    </li>
                    <li>
                      <a href="../controller/delete_controller.php?id=<?= $row["id"] ?>" class="text-danger" data-toggle="tooltip" title="" data-original-title="Delete">
                        <i class="far fa-trash-alt"></i>
                      </a>
                    </li>
                  </ul>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  </body>
  <?php
  include_once("footer.php");
  ?>
