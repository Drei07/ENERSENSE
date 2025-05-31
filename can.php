<?php
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['seatbelt_status'])) {
    $status = $data['seatbelt_status'];
    file_put_contents("log.txt", "Seatbelt Status: $status\n", FILE_APPEND);
    echo json_encode(["status" => "success", "received" => $status]);
} else {
    echo json_encode(["status" => "error", "message" => "Missing seatbelt_status"]);
}
?>
