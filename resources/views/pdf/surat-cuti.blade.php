<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <title>Surat Perizinan Cuti</title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <style>
          .container-custom {
               display: flex;
               justify-content: space-between;
          }

          .signature {
               width: 200px;
          }

          .left {
               text-align: left;
          }

          .right {
               text-align: right;
          }
     </style>
</head>

<body>
     <table>
          <tr>
               <td>
                    <img class="logo-kop-surat" src="http://www.bnnsidoarjo.com/assets/images/logo-bnn-terbaru.png" alt="BNNK Sidoarjo Logo" style="width: 100px; height: 100px">
               </td>
               <td colspan="2" class="text-center">
                    <h1 class="head-kop-surat" style="font-size: 24px">BADAN NARKOTIKA NASIONAL KABUPATEN SIDOARJO</h1>
                    <p class="alamat-kop-surat" style="font-size: 16px">Jalan Perum Taman Pinang, Blok AA8, Nomor 1A, Kecamatan Sidoarjo, Kwadengan Barat, Lemahputro, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61213</p>
               </td>
          </tr>
          <tr>
               <td colspan="3">
                    <hr class="100%" style="border: 1px solid black;">
               </td>
          </tr>
          <tr>
               <td colspan="3">
                    <p>{{ \Illuminate\Support\Carbon::now()->format('d M Y') }}</p>
               </td>
          </tr>
          <tr>
               <td colspan="3" class="text-center">
                    <b>SURAT PERIZINAN CUTI</b>
               </td>
          </tr>
     </table>
     <div class="mt-5">
          <table>
               <tr>
                    <td>
                         Nama
                    </td>
                    <td width="20px"> : </td>
                    <td>
                         {{ $data->nama_pegawai }}
                    </td>
               </tr>
               <tr>
                    <td>
                         Jabatan
                    </td>
                    <td width="20px"> : </td>
                    <td>
                         {{ $data->jabatan }}
                    </td>
               </tr>
               <tr>
                    <td>
                         NIP/NRP
                    </td>
                    <td width="20px"> : </td>
                    <td>
                         {{ $data->nip }}
                    </td>
               </tr>
               <tr>
                    <td>
                         Jenis Cuti
                    </td>
                    <td width="20px"> : </td>
                    <td>
                         {{ $data->JenisCuti->nama_cuti }}
                    </td>
               </tr>
               <tr>
                    <td>
                         Masa Cuti
                    </td>
                    <td width="20px"> : </td>
                    <td>
                         {{ \Carbon\Carbon::parse($data->mulai_cuti)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($data->akhir_cuti)->format('d M Y') }}
                    </td>
               </tr>
               <tr>
                    <td>
                         Alamat Cuti
                    </td>
                    <td width="20px"> : </td>
                    <td>
                         {{ $data->alamat_cuti }}
                    </td>
               </tr>
          </table>
     </div>
     <div class="mt-5">
          <table>
               <tr>
                    <td>
                         <p style="text-align: justify; text-indent: 0.5in;">Kami dengan ini mengonfirmasi bahwa permintaan cuti Anda telah disetujui oleh perusahaan mulai dari tanggal {{ \Carbon\Carbon::parse($data->mulai_cuti)->format('d M Y') }} sampai dengan tanggal {{ \Carbon\Carbon::parse($data->akhir_cuti)->format('d M Y') }}. Anda diharapkan untuk melaksanakan cuti sesuai dengan jadwal yang telah ditentukan. Terimakasih</p>
                    </td>
               </tr>
          </table>
     </div>
     <div class="mt-5">
          <table style="width:100%">
               <tr>
                    <td class="text-center" style="width:70%">KEPALA BNNK SIDOARJO</td>
                    <td class="text-center">KEPALA SUB BAGIAN UMUM</td>
               </tr>
               <tr>
                    <td class="text-center">
                         <img src="{{ public_path('storage/ttd/ttd_kepalacabang.png') }}" style="width: 160px; height: 120px;" alt="">
                    </td>
                    <td class="text-center">
                         <img src="{{ public_path('storage/ttd/ttd_kasubag.png') }}" style="width: 160px; height: 120px;" alt="">
                    </td>
               </tr>
               <tr>
                    <td class="text-center" style="width: 50px">
                         <u>{{ $kepalabnn[0]['nama_lengkap'] }}</u>
                         <p>NIP. {{ $kepalabnn[0]['nip'] }}</p>
                    </td>
                    <td class="text-center" style="width: 50px">
                         <u>{{ $kepalasubbag[0]['nama_lengkap'] }}</u>
                         <p>NIP. {{ $kepalasubbag[0]['nip'] }}</p>
                    </td>
               </tr>
          </table>
     </div>
</body>

</html>
