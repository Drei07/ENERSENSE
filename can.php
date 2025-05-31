<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

if ($data && isset($data['device']) && isset($data['wifi_status'])) {
    $device = htmlspecialchars($data['device']);
    $wifiStatus = htmlspecialchars($data['wifi_status']);
    $rssi = isset($data['rssi']) ? intval($data['rssi']) : 'N/A';

    // Save to file (optional)
    $log = "[" . date("Y-m-d H:i:s") . "] $device | $wifiStatus | RSSI: $rssi\n";
    file_put_contents("wifi_log.txt", $log, FILE_APPEND);

    echo json_encode([
        "status" => "success",
        "message" => "Data received successfully",
        "received" => $data
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid or missing data"
    ]);
}
?>
