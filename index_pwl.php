<?php

class Nilai
{
    private $partisipasi;
    private $tugas;
    private $uts;
    private $uas;

    public function __construct($partisipasi, $tugas, $uts, $uas)
    {
        $this->partisipasi = $partisipasi;
        $this->tugas = $tugas;
        $this->uts = $uts;
        $this->uas = $uas;
    }

    public function hitungNilaiAkhir()
    {
        // Hitung nilai akhir sesuai formula Universitas Negeri Surabaya
        $nilai_akhir = ($this->partisipasi * 0.1) + ($this->tugas * 0.2) + ($this->uts * 0.3) + ($this->uas * 0.4);
        return $nilai_akhir;
    }

    public function konversiNilaiHuruf()
    {
        $nilai_akhir = $this->hitungNilaiAkhir();

        // Konversi nilai akhir ke nilai huruf sesuai ketentuan
        if ($nilai_akhir >= 80) {
            return "A";
        } elseif ($nilai_akhir >= 70) {
            return "B";
        } elseif ($nilai_akhir >= 60) {
            return "C";
        } elseif ($nilai_akhir >= 50) {
            return "D";
        } else {
            return "E";
        }
    }
}
