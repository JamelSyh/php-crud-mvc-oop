<?php if (isset($_SESSION["message"])) { ?>
  <div class="alert alert-<?php echo $_SESSION["message_type"] ?>" role="alert">
    <?php echo $_SESSION["message"]; ?>
  </div>
<?php } ?>
