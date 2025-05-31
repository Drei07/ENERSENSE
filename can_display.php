<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Real-Time CAN Data</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0f2f5;
      padding: 40px;
      text-align: center;
    }

    .card {
      background-color: white;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      display: inline-block;
      min-width: 300px;
    }

    h2 {
      color: #333;
    }

    .status {
      font-size: 1.2rem;
      margin-top: 20px;
    }

    .connected {
      color: green;
      font-weight: bold;
    }

    .disconnected {
      color: red;
      font-weight: bold;
    }

    .seatbelt {
      font-size: 1.5rem;
      margin-top: 10px;
    }
  </style>
</head>
<body>

  <div class="card">
    <h2>CAN Bus Live Status</h2>
    <div class="status" id="wifiStatus">Loading WiFi status...</div>
    <div class="seatbelt" id="seatbeltStatus">Loading Seatbelt status...</div>
  </div>

  <script>
    async function fetchCANData() {
      try {
        const response = await fetch('can_receive.php');
        const data = await response.json();

        // WiFi Status
        const wifiElem = document.getElementById('wifiStatus');
        if (data.wifi_status === 'CONNECTED') {
          wifiElem.textContent = "WiFi: CONNECTED";
          wifiElem.className = "status connected";
        } else {
          wifiElem.textContent = "WiFi: DISCONNECTED";
          wifiElem.className = "status disconnected";
        }

        // Seatbelt Status
        const seatbeltElem = document.getElementById('seatbeltStatus');
        seatbeltElem.textContent = "Seatbelt: " + data.seatbeltStatus;
      } catch (error) {
        document.getElementById('wifiStatus').textContent = "WiFi: ERROR";
        document.getElementById('seatbeltStatus').textContent = "Seatbelt: ERROR";
        console.error("Failed to fetch CAN data:", error);
      }
    }

    // Fetch every 5 seconds
    setInterval(fetchCANData, 5000);
    fetchCANData(); // Initial call
  </script>

</body>
</html>
