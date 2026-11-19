<?php

require_once __DIR__ . '/../lib/dbconnect.php';
require_once __DIR__ . '/../lib/board.php';
require_once __DIR__ . '/../lib/game.php';

$method = $_SERVER['REQUEST_METHOD'];
$path = rtrim($_SERVER['PATH_INFO'] ?? '', '/');

// $path = rtrim($_SERVER['SCRIPT_NAME'] ?? '','/');
// Σε περίπτωση που τρέχουμε php –S 

$input = json_decode(file_get_contents('php://input'), true);

// Κάθε έκφραση ελέγχει ολόκληρο το PATH_INFO.
// Οι τελικές κάθετοι αφαιρούνται πριν από τον έλεγχο.

if (preg_match('#^/v1/board$#D', $path)) {
      handle_board($method);
} elseif (preg_match('#^/v1/board/piece/([1-8])/([1-8])$#D', $path, $matches)) {
     handle_piece($method, $matches[1], $matches[2], $input);
} elseif (preg_match('#^/v1/status$#D', $path)) {
    handle_status($method);
} elseif (preg_match('#^/v1/players(?:/([BW]))?$#D', $path, $matches)) {
    $players = isset($matches[1]) ? [$matches[1]] : [];
    handle_player($method, $players, $input);
} else {
    header('HTTP/1.1 404 Not Found');
    print '<h1>not FOUND</h1>';
    exit;
}

function handle_board($method) {
    if($method=='GET') {
           show_board();
    } else if ($method=='POST') {
           reset_board();
    } else {
        header('HTTP/1.1 405 Method Not Allowed');
    }
}

function handle_piece($method, $x,$y,$input) {
    print("x=$x, y=$y");
    print_r($input);
}

function handle_player($method, $p,$input) {
    ;
}

function handle_status($method) {
    if($method=='GET') {
        show_status();
    } else {
        header('HTTP/1.1 405 Method Not Allowed');
    }
}
