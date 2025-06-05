<?php
$output = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_name = $_POST['employee_name_input'] ?? '';

    if (empty(trim($employee_name))) {
        $output = "<p style='color:#f33;'>Please enter an employee name.</p>";
    } else {
        $mysqli = new mysqli("mysql_db", "newuser", "newpassword", "ctf_db", 3306);

        if ($mysqli->connect_errno) {
            $output = "<p style='color:#f33;'>Failed to connect to MySQL: " . htmlspecialchars($mysqli->connect_error) . "</p>";
        } else {
            $sql = "SELECT name, confidential_notes FROM employees WHERE LOWER(name) LIKE LOWER('%$employee_name%')";

            $result = $mysqli->query($sql);

            if ($result) {
                if ($result->num_rows > 0) {
                    $output = "<table>";
                    $output .= "<tr><th>Name</th><th>Details</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        $output .= "<tr><td>" . htmlspecialchars($row['name']) . "</td><td>" . htmlspecialchars($row['confidential_notes']) . "</td></tr>";
                    }
                    $output .= "</table>";
                } else {
                    $output = "<p>// No records match your query parameters. //</p>";
                }
            } else {
                $output = "<p style='color:#f33;'>SQL error: " . htmlspecialchars($mysqli->error) . "</p>";
            }

            $mysqli->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Los Pollos Hermanos - Internal DB Access</title>
    <style>
        body {
            background-color: #001000;
            color: #0f0;
            font-family: monospace;
            margin: 20px;
        }
        .terminal-window {
            border: 1px solid #004400;
            padding: 20px;
            background-color: #002200;
            max-width: 800px;
            margin: auto;
            border-radius: 5px;
        }
        header h1 {
            margin: 0 0 10px;
        }
        .info-box {
            border: 1px solid #006600;
            background-color: #003300;
            padding: 10px;
            margin-bottom: 15px;
        }
        .db-info {
            font-size: 0.8em;
            color: #008800;
            margin-top: 5px;
        }
        form label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 6px;
            background-color: #001100;
            border: 1px solid #004400;
            color: #0f0;
            font-family: monospace;
        }
        button {
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #004400;
            border: 1px solid #00aa00;
            color: #0f0;
            cursor: pointer;
            font-family: monospace;
        }
        button:hover {
            background-color: #006600;
        }
        .hint {
            margin-top: 15px;
            border: 1px dotted #ffa500;
            color: #ffa500;
            background-color: #111000;
            padding: 10px;
            font-size: 0.9em;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            color: #0f0;
        }
        th, td {
            border: 1px solid #0f0;
            padding: 8px;
            text-align: left;
        }
        p {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="terminal-window">
        <header>
            <h1>Los Pollos Hermanos - Internal Database Access</h1>
            <p style="text-align:center; font-size:0.9em; color:#00AA00;">
                "This setup is... acceptable. The MySQL backend is legacy, but it does the job." - G. Fring
            </p>
        </header>

        <div class="info-box">
            <strong>System Query Parameters:</strong> Search by employee name.<br>
            The system returns two columns: "Name" and "Details".<br>
            Your target: Lyle's confidential file notes. They contain a tracking code (FLAG) and instructions.<br>
            <div class="db-info">// Backend is MySQL based. Standard SQL comments should work. //</div>
        </div>

        <form method="POST" action="">
            <label for="employee_name_input">Employee Name (Case Insensitive Search):</label>
            <input type="text" id="employee_name_input" name="employee_name_input" placeholder="e.g., Lyle or lyle" required />

            <div class="hint">
                <strong>Mike's "Friendly" Advice:</strong> "Kid, I've seen databases leakier than a rusty bucket. If you ask it right, using the right... *combination*... it'll tell you more than its mother. Just make sure your columns line up. And don't forget to silence the rest of the noise."
            </div>

            <button type="submit">Initiate Search Query</button>
        </form>
	<p>FLAG{Just_get_me_my_money_iKoLpP8} -- next path: /MzagTFW7/</p>
        <div class="results-area">
            <h2>Query Output:</h2>
            <?= $output ?: '<p style="color:#555;">// System Idle. Awaiting your expert query... //</p>' ?>
        </div>
    </div>
</body>
</html>

