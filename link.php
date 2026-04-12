<?php

/**
 * Script ini untuk membantu membuat storage link di hosting yang tidak punya SSH.
 * Cara pakai: Akses http://domain-mas.com/link.php sekali saja lewat browser.
 */

$target = __DIR__ . '/storage/app/public';
$link = __DIR__ . '/public/storage';

if (file_exists($link)) {
    echo "Folder public/storage sudah ada. Menghapus yang lama...<br>";
    // Jika berupa folder biasa (bukan symlink), hapus isinya
    if (is_link($link)) {
        unlink($link);
    } else {
        // Jika folder asli, Mas harus hapus manual folder 'public/storage' dulu lewat File Manager
        die("Error: 'public/storage' adalah folder asli, bukan link. Silakan hapus manual folder 'public/storage' di File Manager lalu jalankan lagi script ini.");
    }
}

if (symlink($target, $link)) {
    echo "<b>Berhasil!</b> Storage link sudah dibuat. Sekarang gambar-gambar harusnya muncul.";
} else {
    echo "Gagal membuat storage link. Cek izin folder.";
}
