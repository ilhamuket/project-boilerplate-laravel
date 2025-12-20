<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function suratKeterangan(Request $request)
    {
        // contoh dummy, nanti ambil dari DB (employee)
        $data = [
            'nomor' => 'SK/HR/2025/12/001',
            'nama' => 'Budi Santoso',
            'nik' => 'EMP-0001',
            'jabatan' => 'Staff HR',
            'unit' => 'HRGA',
            'tanggal_masuk' => '2024-01-10',
            'keperluan' => 'Administrasi Bank',
            'tanggal_surat' => now()->format('d M Y'),
            'ttd_nama' => 'Harun Sujadi',
            'ttd_jabatan' => 'HR Manager',
        ];

        $pdf = Pdf::loadView('pdf.surat-keterangan', $data)
            ->setPaper('A4');

        // stream = preview di browser, download = langsung unduh
        return $pdf->stream('surat-keterangan.pdf');
        // return $pdf->download('surat-keterangan.pdf');
    }
}
