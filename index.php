<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    exec('which chromium', $output, $status);

    if ($status !== 0) {
        echo json_encode(['success' => false, 'error' => 'Chromium not found', 'detail' => $output]);
        exit;
    }

    $data = json_decode(file_get_contents('php://input'), true);
    $url = $data['url'] ?? '';

    if ($url) {
        $outputFile = __DIR__ . '/output.pdf'; // Simpan file PDF di direktori yang sama dengan index.php
        $command = "/usr/bin/chromium --headless --disable-gpu --no-sandbox --disable-software-rasterizer --print-to-pdf='/var/www/html/output.pdf' --no-margins --no-header-footer --header-template='' --footer-template='' '$url' 2>&1";

        exec($command, $output, $status);

        if ($status === 0 && file_exists($outputFile)) {
            $pdfContent = file_get_contents($outputFile);
            $base64Pdf = base64_encode($pdfContent);

            echo json_encode(['success' => true, 'pdf_base64' => $base64Pdf]);
        } else {
            $errorDetail = $status === 0 ? 'PDF file not found' : 'Command execution failed';
            echo json_encode(['success' => false, 'error' => 'Failed to generate PDF', 'detail' => $errorDetail, 'command_output' => $output]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'No URL provided']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
