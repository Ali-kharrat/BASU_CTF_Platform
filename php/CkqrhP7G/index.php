<?php
include('waf.php');
include('db.php');

$message = '';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = waf($_POST['username']);
    $password = waf($_POST['password']);

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $message = '<span class="success">Welcome admin! <strong>FLAG{I_am_awake_rT5vYpL}</strong> next path: /QsEGip68/ </span>';
    } else {
        $message = '<span class="error">Login failed.</span>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Breaking Bad CTF Login</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap');

  body {
    background: #0b0c0e url('https://upload.wikimedia.org/wikipedia/commons/6/6d/Breaking_Bad_title_card.png') no-repeat center top;
    background-size: 300px auto;
    font-family: 'Share Tech Mono', monospace;
    color: #0f0;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
    margin: 0;
    padding-top: 350px;
  }

  .login-box {
    background: rgba(0, 0, 0, 0.85);
    border: 3px solid #0f0;
    padding: 30px 40px;
    border-radius: 8px;
    box-shadow: 0 0 15px #a6e22e;
    width: 340px;
  }

  h1 {
    color: #0f0;
    text-align: center;
    margin-bottom: 30px;
  }

  label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
  }

  input[type="text"], input[type="password"] {
    width: 100%;
    padding: 8px 10px;
    margin-bottom: 20px;
    border: 2px solid #a6e22e;
    background: #111;
    color: #a6e22e;
    font-size: 16px;
    border-radius: 4px;
    outline: none;
    transition: border-color 0.3s ease;
  }

  input[type="text"]:focus, input[type="password"]:focus {
    border-color: #f7f100;
    box-shadow: 0 0 8px #f7f100;
  }

  input[type="submit"] {
    background: #a6e22e;
    border: none;
    color: #0b0c0e;
    font-weight: bold;
    padding: 12px;
    width: 100%;
    cursor: pointer;
    font-size: 18px;
    border-radius: 6px;
    transition: background 0.3s ease;
  }

  input[type="submit"]:hover {
    background: #f7f100;
  }

  .message {
    margin-bottom: 20px;
    text-align: center;
  }

  .success {
    color: #a6e22e;
    font-weight: bold;
    text-shadow: 0 0 5px #a6e22e;
  }

  .error {
    color: #ff3300;
    font-weight: bold;
    text-shadow: 0 0 5px #ff3300;
  }

  /* زیرنویس یا واترمارک */
  footer {
    position: fixed;
    bottom: 5px;
    width: 100%;
    text-align: center;
    font-size: 12px;
    color: #444;
    font-family: 'Arial', sans-serif;
  }
</style>
</head>
<body>
  <div class="login-box">
    <h1>BREAKING BAD LOGIN</h1>
    <div class="message"><?= $message ?></div>
    <form method="POST" autocomplete="off">
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" required />

      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required />

      <input type="submit" value="Login" />
    </form>
  </div>
  <footer>CTF Challenge inspired by Breaking Bad</footer>
</body>
</html>

