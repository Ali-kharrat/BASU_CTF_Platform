<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heisenberg's Lost Recipe XXE Challenge v2</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: #000000;
            color: #00FF00; 
            margin: 0;
            padding: 20px;
            line-height: 1.5;
        }
        .terminal-window {
            border: 2px solid #00FF00;
            padding: 20px;
            max-width: 800px;
            margin: 30px auto;
            box-shadow: 0 0 20px #00FF0050; 
        }
        header h1 {
            color: #00FF00;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 3px;
            border-bottom: 1px dashed #00FF00;
            padding-bottom: 10px;
            margin-bottom: 25px;
            text-shadow: 0 0 5px #00FF00;
        }
        label { display: block; margin-top: 15px; font-weight: bold; }
        textarea {
            width: calc(100% - 24px);
            min-height: 200px;
            padding: 10px;
            margin-top: 8px;
            border: 1px solid #00FF00;
            border-radius: 0;
            background-color: #0A0A0A;
            color: #00FF00;
            font-family: 'Courier New', Courier, monospace;
            font-size: 1em;
            resize: vertical;
        }
        button {
            background-color: #003300;
            color: #00FF00;
            padding: 10px 20px;
            border: 1px solid #00FF00;
            border-radius: 0;
            cursor: pointer;
            margin-top: 20px;
            font-size: 1em;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        button:hover { background-color: #005500; box-shadow: 0 0 10px #00FF00; }
        .output-area {
            margin-top: 25px;
            padding: 15px;
            border: 1px dashed #00AA00;
            background-color: #001500;
            min-height: 70px;
            white-space: pre-wrap;
            word-wrap: break-word;
            font-size: 0.95em;
        }
        .output-area strong { color: #33FF33; }
        .info-box {
            font-size: 0.9em;
            color: #00DD00;
            margin-top:15px;
            padding:10px;
            background-color:#001000;
            border:1px solid #004400;
        }
        .info-box code { color: #00FF00; }
        .info-box strong { color: #33FF33; }
        .hint { margin-top: 20px; padding: 10px; border: 1px dotted #FFA500; color: #FFA500; background-color: #111000;}
    </style>
</head>
<body>
    <div class="terminal-window">
        <header>
            <h1>Heisenberg's Lost Recipe XXE Challenge v2</h1>
            <p style="text-align:center; font-size:0.9em; color:#00AA00;">"My XML parser? It's the best... an ARTIST!" - W.W. (He's probably wrong)</p>
        </header>

        <div class="info-box">
            <strong>Objective:</strong> This old system processes XML supply orders. The target file containing crucial data is located at
            <code>/opt/heisenberg_lab/backup_recipe_and_next_steps.txt</code> on the server.
            Exploit the XML parser (which reflects the <code>&lt;chemicalName&gt;</code> tag) to retrieve its content.
        </div>

        <label for="xmlDataInput">Supply Order XML (Handle with care):</label>
        <textarea id="xmlDataInput" name="xmlDataInput" placeholder="Enter XML data..."></textarea>
        <div class="info-box example-xml">
            <strong>Example valid XML structure:</strong><br>
            <code>
&lt;supplyOrder&gt;<br>
&nbsp;&nbsp;&lt;item&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&lt;chemicalName&gt;Phenylacetic Acid&lt;/chemicalName&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&lt;quantity units="kilos"&gt;50&lt;/quantity&gt;<br>
&nbsp;&nbsp;&lt;/item&gt;<br>
&lt;/supplyOrder&gt;
            </code>
        </div>

        <div class="hint">
            <strong>Heisenberg's Hint:</strong> "You know the business and I know the chemistry... or in this case, the XML. Sometimes, you gotta declare what you want. *Loud and clear*. Like when I say... **SYSTEM**atically... I am the one who knocks... for files."
        </div>

        <button onclick="submitXmlOrder()">Process XML Order</button>

        <h2>Parser Output Log:</h2>
        <div id="parserOutput" class="output-area">
            <p style="color:#555;">// System idle. Awaiting XML transmission... //</p>
        </div>
    </div>

    <script id="secretServerData">
        function getSimulatedFileContent(filePath) {
            const targetFilePath = "/opt/heisenberg_lab/backup_recipe_and_next_steps.txt";

            if (filePath === targetFilePath) {
                const flagCharCodes = [
                    70, 76, 65, 71, 123, 69, 118, 101, 114, 121, 111, 110, 101, 95, 100,
                    105, 101, 115, 95, 105, 110, 95, 116, 104, 105, 115, 95, 109, 111,
                    118, 105, 101, 95, 99, 88, 115, 69, 100, 67, 54, 125
                ];
                
                const newNextPathTextCharCodes = [
                    110, 101, 120, 116, 32, 112, 97, 116, 104, 32, 105, 115, 32, 58, 32, 
                    104, 76, 83, 69, 72, 120, 50, 77
                ];

                let fileContent = String.fromCharCode.apply(null, flagCharCodes);
                fileContent += "\n"; 
                fileContent += String.fromCharCode.apply(null, newNextPathTextCharCodes);
                return fileContent;
            }
            return `Error: File not found or access denied (simulated for path: ${escapeHTML_forNonXXE(filePath)})`;
        }
    </script>

    <script>
        function simulateVulnerableXmlParser(xmlString) {
            let chemicalName = "Error: Could not extract chemicalName from XML.";
            let outputMessage = "";

            try {
                if (xmlString.includes("<!DOCTYPE") && xmlString.includes("<!ENTITY") && xmlString.includes("SYSTEM")) {
                    const fileAccessRegex = /<!ENTITY\s+(\w+)\s+SYSTEM\s+"(file:\/\/\/opt\/heisenberg_lab\/backup_recipe_and_next_steps\.txt)"[^>]*>/i;
                    const fileEntityMatch = xmlString.match(fileAccessRegex);

                    if (fileEntityMatch) {
                        const entityNameForFile = fileEntityMatch[1];
                        const filePathAttempt = fileEntityMatch[2].substring("file://".length); 

                        const entityUsageRegex = new RegExp(`<chemicalName>\\s*&${entityNameForFile};\\s*<\\/chemicalName>`, "i");
                        if (entityUsageRegex.test(xmlString)) {
                            chemicalName = getSimulatedFileContent(filePathAttempt);
                        } else {
                            chemicalName = `Error: Entity '${entityNameForFile}' defined for target file but not used in <chemicalName>.`;
                        }
                    } else {
                         const genericEntityUsageRegex = /<chemicalName>\s*&(\w+);\s*<\/chemicalName>/i;
                         const genericMatch = xmlString.match(genericEntityUsageRegex);
                         if(genericMatch){
                            chemicalName = `SIMULATION: For this CTF, only the specific recipe file path will yield its actual content. Other SYSTEM entity paths will result in 'Access Denied by W.W.'`;
                         } else {
                            chemicalName = "DTD with SYSTEM entity found, but either not targeting the recipe file or not used correctly in <chemicalName>.";
                         }
                    }
                } else {
                    const productNameMatch = xmlString.match(/<chemicalName>(.*?)<\/chemicalName>/i);
                    if (productNameMatch && productNameMatch[1]) {
                        chemicalName = escapeHTML_forNonXXE(productNameMatch[1]);
                    }
                }
                outputMessage = `<strong>Processing chemical shipment data:</strong>\n${chemicalName}`;

            } catch (e) {
                outputMessage = `<strong>XML Parser Error:</strong> ${escapeHTML_forNonXXE(e.message)}`;
            }
            return outputMessage;
        }

        function escapeHTML_forNonXXE(str) {
            if (typeof str !== 'string') return String(str); 
            return str.replace(/[&<>"']/g, function (match) {
                return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[match];
            });
        }

        function submitXmlOrder() {
            const xmlInput = document.getElementById('xmlDataInput').value;
            const outputDiv = document.getElementById('parserOutput');

            if (!xmlInput.trim()) {
                outputDiv.innerHTML = "<p style='color:red;'>// XML data stream cannot be empty. Awaiting valid transmission... //</p>";
                return;
            }
            const result = simulateVulnerableXmlParser(xmlInput);
            outputDiv.innerHTML = result;
        }
    </script>
</body>
</html>
