<!DOCTYPE html>
<html>

<head>
     <title>Surat Perizinan Cuti</title>
</head>

<body>
     <p>{{ \Illuminate\Support\Carbon::now()->format('d M Y') }} <br> {{ $data->nama_pegawai }} <br> {{ $data->alamat_cuti }}</p>
     <p style="margin-top: 30px;">Hi, {{ $data->nama_pegawai }} </p>
     <p style="margin-top: 30px;">Surat ini sebagai tanggapan atas permintaan Anda untuk cuti mulai {{ \Carbon\Carbon::parse($data->mulai_cuti)->format('d M Y') }} sampai {{ \Carbon\Carbon::parse($data->akhir_cuti)->format('d M Y') }} untuk {{ $data->JenisCuti->nama_cuti }}. Permintaan cuti Anda disetujui.</p>
     <p>Jika Anda memerlukan permintaan lebih lanjut, jangan ragu untuk menghubungi saya dengan informasi lebih lanjut seputar kebutuhan cuti Anda.</p>
     <p>Berikut adalah lampiran dokumen perizinan cuti telah diterima.</p>
     <p>Terimakasih</p>
     <p style="margin-top: 30px;">BNN Sidoarjo</p>
</body>

</html>
