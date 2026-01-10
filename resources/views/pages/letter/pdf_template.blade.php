<!DOCTYPE html>
<html>

<head>
    <title>{{ $item->letterType->name }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid black;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .logo {
            width: 70px;
            float: left;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .subtitle {
            font-size: 14px;
        }

        .content {
            margin: 0 40px;
        }

        .field {
            margin-bottom: 10px;
        }

        .label {
            width: 150px;
            display: inline-block;
            font-weight: bold;
        }

        .ttd {
            float: right;
            width: 200px;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="title">Pemerintah Kabupaten [Nama Kab]</div>
        <div class="title">Kecamatan [Nama Kec]</div>
        <div class="title">Desa [Nama Desa]</div>
        <div class="subtitle">Alamat: Jl. Raya Desa No. 1, Kode Pos 12345</div>
    </div>

    <div class="content">
        <h3 style="text-align: center; text-decoration: underline;">{{ $item->letterType->name }}</h3>
        <p style="text-align: center;">Nomor: 470 / {{ $item->id }} / DS / {{ date('M') }} / {{ date('Y') }}
        </p>

        <p>Yang bertanda tangan di bawah ini Kepala Desa [Nama Desa], menerangkan bahwa:</p>

        <div class="field">
            <span class="label">Nama Lengkap</span>: {{ $item->user->name }}
        </div>
        <div class="field">
            <span class="label">NIK</span>: {{ $resident->nik ?? '-' }}
        </div>
        <div class="field">
            <span class="label">Tempat/Tgl Lahir</span>: {{ $resident->birth_place ?? '-' }},
            {{ $resident->birth_date ?? '-' }}
        </div>
        <div class="field">
            <span class="label">Alamat</span>: {{ $resident->address ?? '-' }}
        </div>
        <div class="field">
            <span class="label">Keperluan</span>: {{ $item->purpose }}
        </div>

        <p>Demikian surat keterangan ini dibuat dengan sebenarnya dan diberikan kepada yang bersangkutan untuk dapat
            dipergunakan sebagaimana mestinya.</p>

        <div class="ttd" style="margin-top: 50px; width: 100%;">
            <div style="float: right; width: 40%; text-align: center;">
                <p>[Nama Desa], {{ date('d F Y') }}</p>
                <p>Mengetahui,<br>Kepala Desa</p>

                <div style="margin: 10px 0;">
                    {{-- Menggunakan QR Code Base64 yang dikirim dari Controller --}}
                    <img src="data:image/svg+xml;base64, {{ $qrcode }}" alt="QR Validation">
                </div>

                <p><strong>BAPAK KEPALA DESA</strong></p>
                <p style="font-size: 10px; color: gray;">Ditandatangani secara elektronik</p>
            </div>
        </div>
    </div>
</body>

</html>
