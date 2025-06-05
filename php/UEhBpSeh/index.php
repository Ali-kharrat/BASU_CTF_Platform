<?php
$correct_password = "BLUE METH";
$message = "";
$next_level = "CkqrhP7G/";
$flag = "FLAG{No_more_half_measures_kLdF7gH}";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input = strtoupper(trim($_POST["password"] ?? ""));

    if ($input === $correct_password) {
        $message = "Correct! Go to the next level: $next_level and flag $flag";
    } else {
        $message = "Incorrect password, try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<style>
  body {
    background: #000;
    color: #0f0;
    font-family: 'Courier New', Courier, monospace;
    display: flex;
    height: 100vh;
    justify-content: center;
    align-items: center;
    margin: 0;
  }
  .container {
    background: #111;
    border: 2px solid #0f0;
    padding: 2rem;
    width: 350px;
    text-align: center;
    box-shadow: 0 0 15px #0f0;
  }
  input[type="text"] {
    width: 90%;
    padding: 0.5rem;
    font-size: 1.2rem;
    background: #000;
    color: #0f0;
    border: 1px solid #0f0;
    outline: none;
  }
  input[type="text"]:focus {
    box-shadow: 0 0 8px #0f0;
  }
  .hint {
    font-size: 0.9rem;
    margin: 1rem 0 0;
    color: #0a0;
  }
  a {
    color: #0f0;
    text-decoration: underline;
  }
</style>
<script>
  function submitForm() {
    document.getElementById('passForm').submit();
  }
</script>
</head>
<body>
  <div class="container">
    <h2>Enter the password</h2>
    <form id="passForm" method="post" action="">
      <input type="text" name="password" autocomplete="off" placeholder="Type password here"
        onblur="submitForm()" />
    </form>

    <div class="hint" title="Elements: Oxygen, Thorium, Boron, Hydrogen, Lutetium, Molybdenum, Einsteinium, Carbon">
      Hint: The crystal's color and what it really is – spell it with the periodic table elements.
    </div>

    <div style="margin-top:1rem; font-weight:bold;">
      <?php echo $message; ?>
    </div>
  </div>
</body>
</html>


