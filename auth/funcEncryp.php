<?php
// encryption.php

// Fungsi untuk mengenkripsi ID
function encrypt_id($id) {
    $key = "secret_key"; // Ganti dengan kunci rahasia yang kuat
    $encrypted_id = base64_encode($id ^ $key);
    return $encrypted_id;
}

// Fungsi untuk mendekripsi ID
function decrypt_id($encrypted_id) {
    $key = "secret_key"; // Ganti dengan kunci rahasia yang kuat
    $decrypted_id = base64_decode($encrypted_id) ^ $key;
    return $decrypted_id;
}
?>