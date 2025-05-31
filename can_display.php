<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAN BUS ID</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        async function fetchData() {
            try {
                const response = await fetch('can_receive.php');
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
            document.getElementById('seatbeltStatus').textContent = data.seatbeltStatus + '';
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
            <label for="seatbeltStatus">SEAT BELT STATUS</label>
            <span id="seatbeltStatus">Loading...</span>
        </div>
    </div>
</body>

</html>