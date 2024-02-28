<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $userInput = isset($data["userInput"]) ? $data["userInput"] : "";
    $userInput = mb_convert_encoding($userInput, 'UTF-8');
    $command = "D:\\python\\python.exe C:\\Users\\quili\\Downloads\\BaseProject\\FAQ\\suggest.py" . escapeshellarg($userInput);
    exec($command . " 2>&1", $output, $returnCode);

        echo implode("\n", $output); 

    exit;
}
?>