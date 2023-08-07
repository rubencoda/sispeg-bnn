<!DOCTYPE html>
<html>

<head>
     <title>Warning System</title>
</head>

<body>
     <p>Dalam upaya untuk menjaga transparansi dan menjaga kelancaran operasional, berikut ini adalah daftar karyawan yang telah tidak absen selama 3 hari:</p>
     <ol>
          @foreach ($data as $item)
               <li>{{ $item->name }}</li>
          @endforeach
     </ol>
     <p style="margin-top: 30px;">System</p>
</body>

</html>
