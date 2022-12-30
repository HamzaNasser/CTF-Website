<?php
  // Start a new session
  session_start();

  // Connect to the database
  $server = "localhost";
  $username = "root";
  $password = "1995";
  $db = "users";

  $conn = mysqli_connect($server, $username, $password, $db);

  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  // Check if the form was submitted
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the login form was submitted
    if (isset($_POST['login'])) {
      // Get the form data
      $username = $_POST['username'];
      $password = $_POST['password'];

      // Validate the form data
      if (empty($username) || empty($password)) {
        // Email or password is empty, display an error message
        $error = "Please enter your username and password.";
      } else {
        // Email and password are not empty, check if they are correct
        $query = "SELECT password FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        if (!$row) {
          // No matching user found, display an error message
          $error = "Incorrect username or password. Please try again.";
        } else {
          // Matching user found, check if the password is correct
          if (!password_verify($password, $row['password'])) {
            // Password is incorrect, display an error message
            $error = "Incorrect username or password. Please try again.";
          } else {
            // Password is correct, log the user in
            $_SESSION['username'] = $username;
            header('Location: /dashboard.php');
            exit;
          }
        }
      }
    }
  }
?>

<div class="login-form">
  <h1>Login</h1>
  <form method="post">
    <label>Username:</label>
    <input type="text" name="username" required>
    <label>Password:</label>
    <input type="password" name="password" required>
    <input type="submit" name="login" value="Login">
  </form>
  <?php if (isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
  <?php endif; ?>
</div>
