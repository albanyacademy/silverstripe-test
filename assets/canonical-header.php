<?php

// Checking for the presence of the path variable in the query string allows us to easily 404 any requests that
// come directly to this script, just to be safe.
if (!empty($_GET['path'])) {
    // Be sure to add any new file types you want to handle here so the correct content-type header will be sent.
    $mimeTypes = array(
        'pdf' => 'application/pdf',
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
    );

    $path         = filter_input(INPUT_GET, 'path', FILTER_SANITIZE_URL);
    $file         = realpath($path);
    $extension    = pathinfo($path, PATHINFO_EXTENSION);
    $canonicalUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/' . dirname($path);
    $type         = $mimeTypes[$extension];

    // Verify that the file exists and is readable, or send 404
    if (is_readable($file)) {
        header('Content-Type: ' . $type);
        header('Link <' . $canonicalUrl . '>; rel="canonical"');
        readfile(realpath($path));
    } else {
        header('HTTP/1.0 404 Not Found');
        echo "File not found";
    }
} else {
    header('HTTP/1.0 404 Not Found');
    echo "File not found";
}