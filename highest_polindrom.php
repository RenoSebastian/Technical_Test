<?php

function findHighestPalindrome(string $s, int $k): string
{
    $angka_array = str_split($s);
    $panjang = count($angka_array);
    
    // array ini untuk mencatat posisi mana saja yang kita ubah di tugas pertama.
    $pernah_diubah = array_fill(0, $panjang, false);

    // --- TUGAS 1: Membuat angka menjadi palindrom ---
    // tanda '&' artinya fungsi ini akan langsung mengubah isi variabel $angka_array, $k, dan $pernah_diubah.
    $sisa_k = buatJadiPalindrom($angka_array, $k, 0, $panjang - 1, $pernah_diubah);

    // Jika hasilnya negatif, berarti jatah 'k' tidak cukup.
    if ($sisa_k < 0) {
        return "-1";
    }

    // --- TUGAS 2: Memaksimalkan nilai palindrom dengan sisa 'k' ---
    maksimalkanNilai($angka_array, $sisa_k, 0, $panjang - 1, $pernah_diubah);

    // menggabungkan kembali array menjadi string untuk hasil akhir.
    return implode("", $angka_array);
}

function buatJadiPalindrom(array &$angka_array, int $k, int $kiri, int $kanan, array &$pernah_diubah): int
{
    // berhenti jika pointer kiri dan kanan sudah bertemu di tengah.
    if ($kiri >= $kanan) {
        return $k; // mengembalikan sisa 'k'.
    }

    // kondisi jika angka di kiri dan kanan tidak sama.
    if ($angka_array[$kiri] != $angka_array[$kanan]) {
        $k--; // gunakan 1 jatah perubahan.
        $pernah_diubah[$kiri] = true; // tandai posisi ini.

        // samakan keduanya dengan angka yang lebih besar.
        if ($angka_array[$kiri] > $angka_array[$kanan]) {
            $angka_array[$kanan] = $angka_array[$kiri];
        } else {
            $angka_array[$kiri] = $angka_array[$kanan];
        }
    }
    
    // jika jatah 'k' habis, kembalikan -1 sebagai tanda gagal.
    if ($k < 0) {
        return -1;
    }

    // memanggil fungsi yang sama untuk pasangan angka berikutnya (bergerak ke tengah).
    return buatJadiPalindrom($angka_array, $k, $kiri + 1, $kanan - 1, $pernah_diubah);
}

function maksimalkanNilai(array &$angka_array, int &$k, int $kiri, int $kanan, array &$pernah_diubah): void
{
    if ($k <= 0 || $kiri > $kanan) {
        return;
    }

    // kasus khusus untuk angka di tengah (jika panjangnya ganjil).
    if ($kiri == $kanan) {
        if ($k > 0) $angka_array[$kiri] = '9';
        return;
    }

    // jika angka saat ini bukan '9', coba ubah.
    if ($angka_array[$kiri] != '9') {
        if (!$pernah_diubah[$kiri]) {
            if ($k >= 2) {
                $angka_array[$kiri] = '9';
                $angka_array[$kanan] = '9';
                $k -= 2;
            }
        } 
        else {
            if ($k >= 1) {
                $angka_array[$kiri] = '9';
                $angka_array[$kanan] = '9';
                $k--;
            }
        }
    }

    // memanggil fungsi yang samaa untuk pasangan angka berikutnya (bergerak ke tengah).
    maksimalkanNilai($angka_array, $k, $kiri + 1, $kanan - 1, $pernah_diubah);
}

// --- Contoh Penggunaan ---

// Sampel 1
echo "Input: string: 3943, k: 1\n";
echo "Output: " . findHighestPalindrome("3943", 1) . "\n\n";

// Sampel 2
echo "Input: string: 932239, k: 2\n";
echo "Output: " . findHighestPalindrome("932239", 2) . "\n\n";