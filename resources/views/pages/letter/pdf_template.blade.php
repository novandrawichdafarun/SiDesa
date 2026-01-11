<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $item->letterType->name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.6;
            color: #333;
            background-color: #fff;
            padding: 20px;
        }

        .container {
            max-width: 210mm;
            margin: 0 auto;
            background-color: white;
            padding: 35px 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Header Section */
        .header {
            text-align: center;
            border-bottom: 3px solid #000;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .header-content {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            margin-bottom: 10px;
        }

        .logo-placeholder {
            width: 75px;
            height: 75px;
            min-width: 75px;
            border: 2px solid #000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 11px;
            text-align: center;
            padding: 0;
            flex-shrink: 0;
            overflow: hidden;
            background-color: #f5f5f5;
        }

        .logo-placeholder img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .header-text {
            text-align: center;
        }

        .header-text .kabupaten {
            font-size: 12px;
            letter-spacing: 1px;
        }

        .header-text .kecamatan {
            font-size: 14px;
            font-weight: bold;
            margin: 5px 0;
        }

        .header-text .desa {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .header-text .alamat {
            font-size: 11px;
            color: #555;
        }

        /* Document Title */
        .document-title {
            text-align: center;
            margin: 15px 0 8px 0;
        }

        .document-title h2 {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: underline;
            text-decoration-thickness: 2px;
            text-underline-offset: 5px;
            letter-spacing: 0.5px;
        }

        .document-number {
            text-align: center;
            font-size: 11px;
            margin-bottom: 15px;
            color: #555;
        }

        /* Content Section */
        .content {
            font-size: 11px;
            line-height: 1.5;
        }

        .opening-paragraph {
            text-align: justify;
            margin-bottom: 12px;
        }

        .data-section {
            margin: 12px 0;
            padding: 12px;
            background-color: #f9f9f9;
            border-left: 3px solid #4a90e2;
        }

        .data-row {
            margin-bottom: 8px;
            display: flex;
        }

        .data-label {
            width: 130px;
            font-weight: bold;
            color: #333;
            font-size: 11px;
        }

        .data-separator {
            margin: 0 10px;
        }

        .data-value {
            flex: 1;
            text-align: justify;
            color: #444;
            font-size: 11px;
        }

        .closing-paragraph {
            text-align: justify;
            margin: 12px 0;
            font-size: 11px;
            line-height: 1.5;
        }

        /* Signature Section */
        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            padding-top: 10px;
        }

        .signature-box {
            width: 40%;
            text-align: center;
        }

        .signature-date {
            font-size: 10px;
            margin-bottom: 15px;
            font-weight: normal;
        }

        .signature-title {
            font-size: 10px;
            font-weight: normal;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .signature-qrcode {
            margin: 8px 0;
            display: flex;
            justify-content: center;
        }

        .signature-qrcode img {
            width: 70px;
            height: 70px;
            border: 1px solid #ddd;
            padding: 3px;
        }

        .signature-name {
            font-size: 10px;
            font-weight: bold;
            margin-top: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .signature-status {
            font-size: 8px;
            color: #888;
            margin-top: 3px;
            font-style: italic;
        }

        /* Footer */
        .footer {
            text-align: center;
            font-size: 9px;
            color: #999;
            margin-top: 10px;
            padding-top: 8px;
            border-top: 1px dotted #ccc;
        }

        @media print {
            body {
                padding: 0;
                background-color: white;
            }

            .container {
                box-shadow: none;
                padding: 40px;
                max-height: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <div class="header-text">
                    <div class="kabupaten">PEMERINTAH KABUPATEN NYENI NYENUK</div>
                    <div class="kecamatan">Kecamatan Nyenuk</div>
                    <div class="desa">Desa Nyeni</div>
                    <div class="alamat">Alamat: Jl. Keri-Keri No. 1, Kode Pos 6767</div>
                </div>
            </div>
        </div>

        <!-- Document Title -->
        <div class="document-title">
            <h2>{{ $item->letterType->name }}</h2>
        </div>

        <div class="document-number">
            Nomor: 470/{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}/DS/{{ strtoupper(date('M')) }}/{{ date('Y') }}
        </div>

        <!-- Content -->
        <div class="content">
            <p class="opening-paragraph">
                Yang bertanda tangan di bawah ini, Kepala Desa Nyeni, Kecamatan Nyenuk, Kabupaten Nyeni Nyenuk, menerangkan dengan sebenarnya bahwa:
            </p>

            <!-- Data Section -->
            <div class="data-section">
                <div class="data-row">
                    <span class="data-label">Nama Lengkap</span>
                    <span class="data-separator">:</span>
                    <span class="data-value">{{ $item->user->name }}</span>
                </div>
                <div class="data-row">
                    <span class="data-label">Nomor Induk Kependudukan</span>
                    <span class="data-separator">:</span>
                    <span class="data-value">{{ $resident->nik ?? '-' }}</span>
                </div>
                <div class="data-row">
                    <span class="data-label">Tempat/Tanggal Lahir</span>
                    <span class="data-separator">:</span>
                    <span class="data-value">
                        {{ $resident->birth_place ?? '-' }},
                        {{ $resident->birth_date ? date('d F Y', strtotime($resident->birth_date)) : '-' }}
                    </span>
                </div>
                <div class="data-row">
                    <span class="data-label">Alamat</span>
                    <span class="data-separator">:</span>
                    <span class="data-value">{{ $resident->address ?? '-' }}</span>
                </div>
                <div class="data-row">
                    <span class="data-label">Keperluan</span>
                    <span class="data-separator">:</span>
                    <span class="data-value">{{ $item->purpose }}</span>
                </div>
            </div>

            <p class="closing-paragraph">
                Demikian surat keterangan ini dibuat dengan sebenarnya dan diberikan kepada yang bersangkutan untuk
                dapat dipergunakan sebagaimana mestinya sebagai kelengkapan berkas permohonan.
            </p>
        </div>

        <!-- Signature Section -->
        <div class="signature-section">
            <div class="signature-box" style="visibility: hidden;"></div>
            <div class="signature-box">
                <div class="signature-date">
                    Desa Nyeni, {{ date('d F Y', strtotime($item->updated_at ?? $item->created_at)) }}
                </div>
                <div class="signature-title">
                    Kepala Desa
                </div>
                <div class="signature-qrcode">
                    <img src="data:image/svg+xml;base64,{{ $qrcode }}" alt="QR Code Validasi">
                </div>
                <div class="signature-name">
                    Bahlil Etanol
                </div>
                <div class="signature-status">
                    Tanda tangan digital - Validasi dengan QR Code
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Dokumen ini telah ditandatangani secara elektronik dan berlaku sebagai dokumen resmi.</p>
        </div>
    </div>
</body>

</html>
