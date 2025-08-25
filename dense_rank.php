<?php

function hitungPeringkatSederhana(array $ranked, array $player): array
{
    // membuat daftar skor unik dari papan peringkat.
    $papan_peringkat_unik = array_values(array_unique($ranked));
    
    $hasil_akhir_gits = [];

    // ulangi untuk setiap skor yang didapat GITS.
    foreach ($player as $skor_gits) {
        
        $peringkat_ditemukan = false;

        // mencari posisi skor GITS di papan peringkat unik, dari atas ke bawah.
        foreach ($papan_peringkat_unik as $indeks => $skor_di_papan) {
            
            // peringkat dimulai dari 1, sedangkan indeks array dimulai dari 0.
            
            $peringkat_saat_ini = $indeks + 1;

            // jika skor GITS lebih tinggi atau sama, berarti itu peringkatnya.
            if ($skor_gits >= $skor_di_papan) {
                $hasil_akhir_gits[] = $peringkat_saat_ini;
                $peringkat_ditemukan = true;
                break; // keluar
            }
        }
        // melakukan pengecekan apakah skor GITS terendah
        if (!$peringkat_ditemukan) {
            $peringkat_terakhir = count($papan_peringkat_unik) + 1;
            $hasil_akhir_gits[] = $peringkat_terakhir;
        }
    }
    
    return $hasil_akhir_gits;
}

$ranked_scores = [100, 100, 50, 40, 40, 20, 10];
$gits_scores = [5, 25, 50, 120];

// memanggil fungsi versi sederhana
$hasil_peringkat = hitungPeringkatSederhana($ranked_scores, $gits_scores);

// menampilkan hasil
echo implode(' ', $hasil_peringkat);

?>