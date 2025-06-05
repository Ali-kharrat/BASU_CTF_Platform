<?php

$flag = "FLAG{We_had_a_good_thing_yHnUjM3}";
$next = "5zb45KBH";

$name = "Visitor";

if (isset($_POST['name'])) {
    $name = $_POST['name'];

    ob_start();
    eval('?>Hello, ' . $name . '!');
    $output = ob_get_clean();
} else {
    $output = "Hello, Visitor!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<style>
  body {
      background-color: #0d0d0d;
      color: #0f0;
      font-family: monospace;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
  h1 {
    text-shadow: 0 0 5px #a2ff00;
  }
  form {
    margin-top: 30px;
  }
  input[type="text"] {
    width: 300px;
    padding: 8px;
    border: 2px solid #a2ff00;
    border-radius: 5px;
    background: #122a12;
    color: #a2ff00;
    font-family: monospace;
  }
  input[type="submit"] {
    padding: 8px 16px;
    margin-left: 10px;
    background: #a2ff00;
    border: none;
    font-weight: bold;
    cursor: pointer;
    color: #0b3d0b;
    border-radius: 5px;
  }
  .output {
    margin-top: 30px;
    font-size: 1.5rem;
  }
</style>
</head>
<body>
  <h1>Enter the name of your favorite Breaking Bad character</h1>
  <form method="POST">
    <br><br>
    <input type="text" name="name" autocomplete="off" />
    <input type="submit" value="Submit" />
  </form>

  <div class="output">
    <?php echo $output; ?>
  </div>
</body>
</html>

