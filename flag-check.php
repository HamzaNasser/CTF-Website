
<?php
if (isset($_POST['flag'])) {
  $flag = $_POST['flag'];
  if ($flag == "CNA{Y0u 2re 7acker!}") {
    echo '<p class="success">Correct flag!</p>';
  } else {
    echo '<p class="error">Incorrect flag.</p>';
  }
}
?>