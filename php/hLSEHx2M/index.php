<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Oracle's Terminal v3 (Encoded Wisdom)</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: #000000;
            color: #00FF00; 
            margin: 0;
            padding: 20px;
            line-height: 1.4;
        }
        .terminal-window {
            border: 2px solid #00FF00;
            padding: 20px;
            max-width: 900px;
            margin: 30px auto;
            box-shadow: 0 0 15px #00FF0030;
        }
        header h1 {
            color: #00FF00;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
            border-bottom: 1px dashed #00FF00;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .sys_message {
            border: 1px solid #008000; 
            padding: 15px;
            margin: 20px 0;
            background-color: #001000;
        }
        .sys_message strong { color: #33FF33; }
        .sys_message em { color: #00DD00; }

        .input-area textarea {
            width: calc(100% - 22px); 
            min-height: 60px;
            padding: 10px;
            border: 1px solid #00FF00;
            margin-bottom: 10px;
            background-color: #000000;
            color: #00FF00;
            font-family: 'Courier New', Courier, monospace;
        }
        .input-area button {
            padding: 8px 15px;
            background-color: #00FF00;
            color: #000000;
            border: none;
            cursor: pointer;
            font-family: 'Courier New', Courier, monospace;
            text-transform: uppercase;
        }
        .input-area button:hover {
            background-color: #00AA00;
            color: #111111;
        }
        .log-display {
            margin-top: 30px;
            border-top: 1px dashed #00FF00;
            padding-top: 20px;
        }
        .log-entry {
            border: 1px solid #003300; 
            padding: 10px;
            margin-bottom: 10px;
            background-color: #000500;
            word-wrap: break-word;
        }
        .log-entry p { margin: 0; }
        .log-entry .user-prefix { color: #00AAAA; } 
        .log-entry .oracle-prefix { color: #FFAA00; } 

        
        #oracle_core_data::before {
            content: "SYSTEM: Core Data Stream Encrypted. Awaiting Decryption Key...";
            color: #009900; 
            font-style: italic;
            display: block;
            padding: 10px;
            border: 1px dotted #006600;
            margin-top: 20px;
            background-color: #000500;
        }

        body:has(div[class*="truth_seeker_focus"]:focus) #oracle_core_data::before {
            content: attr(data-wisdom);
            color: #33FF33; 
            font-weight: bold;
            font-size: 1.1em;
            border: 2px solid #00FF00;
            background-color: #001500;
            white-space: pre-wrap; 
            padding: 15px;
        }
    </style>
</head>
<body>
    <div class="terminal-window">
        <header>
            <h1>The Oracle's Terminal v3 (Encoded Wisdom)</h1>
        </header>

        <div class="sys_message">
            <p style="text-align:center; font-size: 1.2em; border: 1px solid #00FF00; padding: 10px; margin-bottom:15px;">"You don't know what you don't know..."</p>
            <p><strong>SYSTEM BOOT LOG:</strong> Oracle Interface v0.3alpha. Secure Input Mode Engaged. Data stream obfuscated.</p>
            <p><em>Whispers from the old code suggest a hidden 'Echo Protocol'. Activation is said to require a precise <strong>'focus state'</strong> on a correctly initiated data stream. The archives mention a trigger phrase fragment: '...truth_seeker...' as part of the initiation. Only through understanding the system's constraints can one make it speak beyond its programming.</em></p>
        </div>

        <div class="input-area">
            <h3>INPUT BUFFER:</h3>
            <form id="terminalForm" method="POST" action="#log-display-anchor">
                <textarea name="user_input_buffer" placeholder="> Enter command or data stream..."></textarea>
                <button type="submit">Transmit</button>
            </form>
        </div>

        <div id="log-display-anchor" class="log-display">
            <h2>SYSTEM LOG:</h2>
            <div class="log-entry">
                <p><span class="oracle-prefix">[ORACLE_SYS]:</span> Welcome back, Seeker. The Oracle's data stream has been further secured. The path to knowledge is through interaction. All transmissions are logged.</p>
            </div>
            <div class="log-entry" id="user_log_1_container">
                <p><span class="user-prefix">[USER_STREAM]:</span> Query: System status?</p>
                 <p><span class="oracle-prefix">[ORACLE_RESPONSE]:</span> Nominal. Awaiting valid input. Data stream integrity check: positive.</p>
            </div>
        </div>

        <div id="oracle_core_data">
        </div>
    </div>

    <footer style="text-align:center; font-size:0.8em; color:#009900; margin-top: 40px;">
        <p>&copy; The First Echoes. All rights reserved (or are they?). System integrity is an illusion. Data stream v3 active.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const encodedReversedWisdom = "L2lhX2VnbmVsbGFoY19sYW5pZi8gOiBzaSBodGFwIHR4ZW4gLS0gN1RTUnFQb19lZ25haGNfZm9feWR1dHNfZWhUfUdBTEY=";
            try {
                const reversedWisdom = atob(encodedReversedWisdom);
                const originalWisdom = reversedWisdom.split("").reverse().join("");
                const oracleDataDiv = document.getElementById('oracle_core_data');
                if (oracleDataDiv) {
                    oracleDataDiv.setAttribute('data-wisdom', originalWisdom);
                }
            } catch (e) {
                console.error("Error decoding wisdom:", e);
                const oracleDataDiv = document.getElementById('oracle_core_data');
                if (oracleDataDiv) {
                    oracleDataDiv.setAttribute('data-wisdom', 'ERROR: Corrupted data stream. Cannot decode wisdom.');
                }
            }
        });

        document.getElementById('terminalForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const inputBuffer = this.querySelector('textarea[name="user_input_buffer"]');
            const inputText = inputBuffer.value;

            let sanitizedInputHTML = inputText
                .replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, "[SCRIPT REMOVED BY CLIENT-SIDE SIMULATION GUARD]")
                .replace(/on\w+\s*=\s*("[^"]*"|'[^']*'|[^\s>]*)/gi, "[EVENT HANDLER REMOVED BY CLIENT-SIDE SIMULATION GUARD]")
                .replace(/<iframe/gi, "&lt;iframe_blocked_by_sim_guard")
                .replace(/<svg/gi, "&lt;svg_blocked_by_sim_guard");

            if (sanitizedInputHTML.trim() === "") return;

            const logDisplay = document.querySelector('.log-display');
            const newLogEntry = document.createElement('div');
            newLogEntry.className = 'log-entry';

            const p = document.createElement('p');
            p.innerHTML = `<span class="user-prefix">[USER_STREAM]:</span> ${sanitizedInputHTML}`;
            newLogEntry.appendChild(p);

            logDisplay.appendChild(newLogEntry);
            inputBuffer.value = '';
            newLogEntry.scrollIntoView({ behavior: 'smooth' });
        });
    </script>

</body>
</html>
