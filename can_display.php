<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>CAN BUS ID</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .measurement {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        label {
            font-weight: bold;
            color: #555;
        }

        span {
            color: #333;
        }

        #error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>CAR STATUS</h1>
        <div class="measurement">
            <label>SEAT BELT STATUS</label>
            <span id="seatbeltStatus">Loading...</span>
        </div>
        <div class="measurement">
            <label>WIFI STATUS</label>
            <span id="wifiStatus">Loading...</span>
        </div>
        <p id="error"></p>
    </div>

    <script>
        async function fetchData() {
            try {
                const response = await fetch("can_receive.php");
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }

                const data = await response.json();
                console.log("Received data:", data); // DEBUG

                // Update the DOM
                document.getElementById("seatbeltStatus").textContent = data.seatbeltStatus;
                document.getElementById("wifiStatus").textContent = data.wifi_status;
                document.getElementById("error").textContent = "";
            } catch (error) {
                console.error("Fetch error:", error);
                document.getElementById("error").textContent = "Failed to load data.";
            }
        }

        // Run immediately and repeat every second
        window.onload = fetchData;
        setInterval(fetchData, 1000);
    </script>
</body>

</html>
