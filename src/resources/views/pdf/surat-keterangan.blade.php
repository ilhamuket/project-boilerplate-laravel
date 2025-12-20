<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .title { text-align: center; font-size: 16px; font-weight: bold; margin-bottom: 6px; }
        .subtitle { text-align: center; margin-bottom: 18px; }
        .content { line-height: 1.6; }
        .sign { margin-top: 32px; width: 100%; }
        .sign td { vertical-align: top; width: 50%; }
        .right { text-align: right; }
        .small { font-size: 11px; color: #444; }
        hr { border: 0; border-top: 1px solid #000; margin: 8px 0 16px; }
    </style>
</head>
<body>
    <div class="title">SURAT KETERANGAN</div>
    <div class="subtitle">Nomor: {{ $nomor }}</div>
    <hr>

    <div class="content">
        Yang bertanda tangan di bawah ini menerangkan bahwa:

        <table style="margin-top:12px; margin-bottom:12px;">
            <tr><td style="width:120px;">Nama</td><td>: {{ $nama }}</td></tr>
            <tr><td>NIK</td><td>: {{ $nik }}</td></tr>
            <tr><td>Jabatan</td><td>: {{ $jabatan }}</td></tr>
            <tr><td>Unit</td><td>: {{ $unit }}</td></tr>
        </table>

        Adalah benar karyawan aktif di perusahaan kami sejak tanggal {{ $tanggal_masuk }}.
        Surat ini dibuat untuk keperluan: <b>{{ $keperluan }}</b>.
    </div>

    <table class="sign">
        <tr>
            <td>
                <div class="small">Catatan:</div>
                <div class="small">Surat ini berlaku sejak tanggal diterbitkan.</div>
            </td>
            <td class="right">
                Bandung, {{ $tanggal_surat }}<br>
                Hormat kami,<br><br><br><br>
                <b>{{ $ttd_nama }}</b><br>
                {{ $ttd_jabatan }}
            </td>
        </tr>
    </table>
</body>
</html>
