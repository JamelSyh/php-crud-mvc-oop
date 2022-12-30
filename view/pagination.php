<?php
?>
<?php if (!empty($result)) { ?>
  <div class="link-right">
    <nav aria-label="...">
      <ul class="pagination">
        <li class="page-item <?php echo $input["current_page"] <= 1 ?  "disabled" : "enabled" ?> ">
          <a class="page-link" href="<?php echo "index.php?page=" . $input["current_page"] - 1; ?>">Previous</a>
        </li>
        <?php
        for ($i = 1; $i <= $input["number_pages"]; $i++) {
          $is_active = ($i == $input["current_page"]) ? "active" : "";
          $is_search = isset($_GET["search"]) ? "input=" . $_GET["input"] . "&search=&" : "";
          echo "<li class=\"page-item $is_active\"><a class=\"page-link\" href=\"index.php?" . $is_search . "page=$i\">$i</a></li>";
        }
        ?>
        <li class="page-item <?php echo $input["current_page"] >= $input["number_pages"] ?  "disabled" : "enabled" ?>">
          <a class="page-link" href="<?php echo "index.php?page=" . $input["current_page"] + 1; ?>">Next</a>
        </li>
      </ul>
    </nav>
  </div>
<?php } ?>
