<?php

function generateLazyCatererSequence($jumlahSuku)
{
    // jika input tidak valid, kembalikan teks kosong.
    if ($jumlahSuku <= 0) {
        return "";
    }

    // siapkan sebuah (array) untuk menampung angka-angka.
    $hasilUrutan = [];

    // melakukan perulangan untuk menghitung setiap angka dalam urutan.
    for ($n = 0; $n < $jumlahSuku; $n++) {
        // hitung angkanya menggunakan rumus.
        $angka = ($n * $n + $n + 2) / 2;
        
        // masukkan angka yang sudah dihitung kedalam array
        $hasilUrutan[] = $angka;
    }

    return implode('-', $hasilUrutan);
}

$input = 7;

$output = generateLazyCatererSequence($input);

// Tampilkan di layar.
echo "Input: " . $input . "\n";
echo "Output: " . $output . "\n";

?>