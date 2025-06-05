<?php

$secret_ip = "33.24.198.0";
$secret_port = "321";
$flag = "FLAG{Science_bitch_mNjBhV2}";
$next = "rFytXrt7";

$error = "";
$success = false;

header("X-Secret-IP: $secret_ip");
header("X-Secret-Port: $secret_port");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ip = $_POST["ip"] ?? "";
    $port = $_POST["port"] ?? "";

    if ($ip === $secret_ip && $port === $secret_port) {
        $success = true;
    } else {
        $error = "Wrong IP or Port! Try checking the HTTP headers carefully.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Network Challenge</title>
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
        border: 2px solid #39ff14;
        padding: 30px;
        border-radius: 12px;
        width: 320px;
        box-sizing: border-box;
        text-align: center;
    }
    input[type=text] {
        width: 90%;
        padding: 8px;
        margin: 10px 0;
        background-color: #002200;
        border: 1px solid #39ff14;
        color: #39ff14;
        font-size: 16px;
        border-radius: 5px;
    }
    input[type=submit] {
        background-color: #39ff14;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        font-weight: bold;
        font-size: 16px;
        border-radius: 5px;
        color: black;
    }
    .hint {
        margin-top: 15px;
        font-size: 14px;
        color: #66ff66;
    }
    .error {
        color: #ff3333;
        margin-top: 12px;
        font-weight: bold;
    }

</style>
</head>
<body>
<div class="container">
    <h3>The answer’s already in front of you — hidden in plain sight.</h3>

    <?php if (!$success): ?>
        <form method="POST" action="">
            <input type="text" name="ip" placeholder="Enter IP Address" required />
            <input type="text" name="port" placeholder="Enter Port" required />
            <br />
            <input type="submit" value="Submit" />
        </form>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="hint">🎉 Correct! Here is your flag:<br><br><strong><?= $flag ?></strong></div>
        <div class="hint">🎉 next path :<br><br><strong><?= $next ?></strong></div>
    <?php endif; ?>
</div>
</body>
</html>

