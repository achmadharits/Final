@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    
    <style>
        /* Your CSS styles */
    </style>
@stop

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h2>Tabel Fasilitas Kesehatan</h2> -->
@stop

@section('content')
<style>
.button {
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}

.button {
  background-color: white; 
  color: black; 
  border: 3px solid #404040;
  border-radius: 12px;
}

.button:hover {
  background-color: #404040;
  color: white;
}
.center {
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}

</style>
<body>

<h1>Pemetaan</h1>
  <div class="container">
    <div class="vertical-center">
      <a class="button button" href="/map_facility" target="_blank">Fasilitas Kesehatan</a>
    <h2>Pemetaan Tenaga Kesehatan</h2>
      <a class="button button" href="/map_dr_spesialis?worker=1" target="_blank">Dokter Spesialis</a>
      <a class="button button" href="/map_dr_spesialis?worker=2" target="_blank">Dokter Umum</a>
      <a class="button button" href="/map_dr_spesialis?worker=3" target="_blank">Dokter Gigi</a>
      <a class="button button" href="/map_dr_spesialis?worker=4" target="_blank">Dokter Gigi Spesialis</a>
      <a class="button button" href="/map_dr_spesialis?worker=5" target="_blank">Bidan</a>
      <a class="button button" href="/map_dr_spesialis?worker=6" target="_blank">Perawat</a>
      <a class="button button" href="/map_dr_spesialis?worker=7" target="_blank">Tenaga Kesehatan Masyarakat</a>
      <a class="button button" href="/map_dr_spesialis?worker=8" target="_blank">Tenaga Kesehatan Lingkungan</a>
      <a class="button button" href="/map_dr_spesialis?worker=9" target="_blank">Tenaga Gizi</a>
      <a class="button button" href="/map_dr_spesialis?worker=10" target="_blank">Ahli Teknologi Laboratorium Medik</a>
      <a class="button button" href="/map_dr_spesialis?worker=11" target="_blank">Tenaga Teknik Biomedika Lainnya</a>
      <a class="button button" href="/map_dr_spesialis?worker=12" target="_blank">Keterapian Fisik</a>
      <a class="button button" href="/map_dr_spesialis?worker=13" target="_blank">Keteknisian Medis</a>
      <a class="button button" href="/map_dr_spesialis?worker=14" target="_blank">Tenaga Teknis Kefarmasian</a>
      <a class="button button" href="/map_dr_spesialis?worker=15" target="_blank">Apoteker</a>
</div>
</div>



</body>
@stop

@section('js')
    <!-- Your JavaScript code -->
@stop
