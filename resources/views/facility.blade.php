@extends('adminlte::page')

@section('css')

    <link rel="stylesheet" href="/css/admin_custom.css">
    <!--
                                <style>
                                .table {
                                    width: 100%;
                                    border-collapse: collapse;
                                }

                                .table th,
                                .table td {
                                    padding: 8px;
                                    text-align: center;
                                }

                                .table th {
                                    background-color: #f2f2f2;
                                }

                                .table tr:nth-child(even) {
                                    background-color: #f9f9f9;
                                }

                                .table tr:hover {
                                    background-color: #e2e2e2;
                                }

                                .table a {
                                    color: #fff;
                                }

                                .table a.edit {
                                    background-color: #007bff;
                                }

                                .table a.delete {
                                    background-color: #dc3545;
                                }
                                .pagination {
                                display: flex;
                                justify-content: left;
                                margin-top: 20px;
                                }

                                .pagination .page-item {
                                    margin: 0 5px;
                                    list-style-type: none;
                                }

                                .pagination .page-item .page-link {
                                    padding: 5px 10px;
                                    border: 1px solid #ccc;
                                    color: #333;
                                    text-decoration: none;
                                    background-color: #fff;
                                }

                                .pagination .page-item .page-link:hover {
                                    background-color: #eee;
                                }

                                .pagination .page-item.active .page-link {
                                    background-color: #007bff;
                                    color: #fff;
                                    border-color: #007bff;
                                }
                                </style> -->
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h2>Tabel Fasilitas Kesehatan</h2>
@stop

@section('content')
    <div class="card">
        <!-- <div class="card-header">
                                        <h3 class="card-title"></h3>
                                    </div> -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead style="background-color: #344D67">
                    <tr>
                        <th class="text-center text-white">No.</th>
                        <th class="text-center text-white">Kota</th>
                        <th class="text-center text-white">Fasilitas Kesehatan</th>
                        <th class="text-center text-white">Jumlah</th>
                        <th class="text-center text-white">Populasi</th>
                        <th class="text-center text-white">Rasio</th>
                        <th class="text-center text-white">Status</th>
                        <th class="text-center text-white">Edit / Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $cityFacilities = App\models\CityFacility::paginate(20);
                        // Assuming CityFacility is the model representing the city_facility table
                    @endphp
                    @foreach ($cityFacilities as $key => $val)
                        <tr>
                            <td class="text-center">{{ $cityFacilities->firstItem() + $key }}</td>
                            <td class="text-left">{{ $val->city->name }}</td>
                            <td class="text-left">{{ $val->facility->name }}</td>
                            <td class="text-center">{{ number_format($val->total, 0, '.', '.') }}</td>
                            <td class="text-center">{{ number_format($val->population, 0, '.', '.') }}</td>
                            <td class="text-center">{{ number_format($val->ratio, 7, ',', ',') }}</td>
                            <td class="text-center">{{ $val->status }}</td>
                            <td class="text-center">
                                <a href="javascript:void(0)" data-id="{{ $val->id }}"
                                    class="edit btn btn-primary btn-sm editcityfacility">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)" data-id="{{ $val->id }}"
                                    class="delete btn btn-danger btn-sm deletecityfacility">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination justify-content-center">
                {{ $cityFacilities->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@stop



@section('js')
    <!-- <script>
        console.log('Hi!');
    </script> -->
@stop
