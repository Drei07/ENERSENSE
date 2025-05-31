<?php
session_start();

$proxyServerUrl = 'https://enersense.space/can.php'; // Replace with your proxy server URL

$response = file_get_contents($proxyServerUrl);
if ($response !== false) {
    header('Content-Type: application/json');
    echo $response;
} else {
    header('Content-Type: application/json');
    echo json_encode([
        'wifi_status' => 'No device found',
        'seatbeltStatus' => 0.0,
    ]);

    error_log("Failed to fetch data from proxy server.");
}


?>
