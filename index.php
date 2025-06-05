<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electrical Measurements</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        async function fetchData() {
            try {
                const response = await fetch('receive.php');
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const data = await response.json();
                updateDisplay(data);
            } catch (error) {
                console.error('Error fetching data:', error);
                // Optionally, you can display an error message on the page
            }
        }

        function updateDisplay(data) {
            document.getElementById('voltage').textContent = data.voltage + ' V';
            document.getElementById('current').textContent = data.current + ' A';
            document.getElementById('power').textContent = data.power + ' W';
            document.getElementById('energyWh').textContent = data.energyWh + ' Wh';
            document.getElementById('energyKWh').textContent = data.energyKWh + ' kWh';
            document.getElementById('frequency').textContent = data.frequency + ' Hz';
            document.getElementById('powerFactor').textContent = data.powerFactor;

        }

        // Fetch data every 5 seconds
        setInterval(fetchData, 1000);
        // Fetch data immediately on page load
        window.onload = fetchData;
    </script>
</head>
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
        background: rgb(252, 252, 252);
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

    .measurement:last-child {
        border-bottom: none;
    }

    label {
        font-weight: bold;
        color: #555;
    }

    span {
        color: #333;
    }
</style>

<body>
    <div class="container">
        <h1>Electrical Measurements</h1>
        <div class="measurement">
            <label for="voltage">Voltage (V):</label>
            <span id="voltage">Loading...</span>
        </div>
        <div class="measurement">
            <label for="current">Current (A):</label>
            <span id="current">Loading...></span>
        </div>
        <div class="measurement">
            <label for="power">Power (W):</label>
            <span id="power">Loading...</span>
        </div>
        <div class="measurement">
            <label for="energyWh">Energy (Wh):</label>
            <span id="energyWh">Loading...</span>
        </div>
        <div class="measurement">
            <label for="energyKWh">kWh:</label>
            <span id="energyKWh">Loading...</span>
        </div>
        <div class="measurement">
            <label for="frequency">Frequency (Hz):</label>
            <span id="frequency">Loading...</span>
        </div>
        <div class="measurement">
            <label for="powerFactor">powerFactor :</label>
            <span id="powerFactor">Loading...</span>
        </div>
    </div>
</body>

</html>