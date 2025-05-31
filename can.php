<?php
// Set headers to allow cross-origin requests and accept JSON
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Get the raw POST data
$rawData = file_get_contents("php://input");

// Decode JSON data
$data = json_decode($rawData, true);

// Check if decoding succeeded and required fields are present
if ($data && isset($data['device']) && isset($data['wifi_status'])) {
    // Extract values
    $device = htmlspecialchars($data['device']);
    $wifiStatus = htmlspecialchars($data['wifi_status']);
    $rssi = isset($data['rssi']) ? intval($data['rssi']) : 'N/A';

    // Example: Save to a log file (optional)
    $log = "[" . date("Y-m-d H:i:s") . "] Device: $device, Status: $wifiStatus, RSSI: $rssi\n";
    file_put_contents("wifi_log.txt", $log, FILE_APPEND);

    // Return response
    echo json_encode([
        "status" => "success",
        "message" => "Data received successfully",
        "received" => $data
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid JSON or missing fields"
    ]);
}
?>
