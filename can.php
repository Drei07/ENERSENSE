<?php
// can.php

// Set content type to JSON (optional but good practice)
header('Content-Type: application/json');

// Read raw POST data (JSON)
$input = file_get_contents('php://input');

// Decode JSON to PHP associative array
$data = json_decode($input, true);

if ($data === null) {
    // Invalid JSON or no data received
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid JSON']);
    exit;
}

// Example: Extract values from received data
$seatbelt_status = isset($data['seatbelt_status']) ? $data['seatbelt_status'] : 'unknown';
$wifi_status = isset($data['wifi_status']) ? $data['wifi_status'] : 'unknown';

// You can log this data or process it as needed
// For example, save to a file:
$log_entry = date('Y-m-d H:i:s') . " - Seatbelt: $seatbelt_status, WiFi: $wifi_status\n";
file_put_contents('can_log.txt', $log_entry, FILE_APPEND);

// Respond back to Arduino
echo json_encode([
    'status' => 'success',
    'received' => $data
]);
?>
