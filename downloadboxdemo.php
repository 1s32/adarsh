<?php
// Specify the file path
$file_name = 'Kia Seltos 2023 Facelift 1677504205338.jpg';
$file_path = 'E:/xamp/htdocs/selfpro/' . $file_name;

// Check if the file exists
if (file_exists($file_path)) {
    // Set headers for the download
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file_path));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_path));

    // Read the file and output it to the browser
    readfile($file_path);

    exit;
} else {
    // Display an error message if the file doesn't exist
    echo "File not found.";
}
?>
