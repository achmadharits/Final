@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    
    <style>
        /* Your CSS styles */
    </style>
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h2>Tabel Tenaga Kesehatan</h2>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Kota</th>
                        <th class="text-center">Fasilitas Kesehatan</th>
                        <th class="text-center">Tenaga Kesehatan</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Populasi</th>
                        <th class="text-center">Rasio</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Edit / Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $facilityworkers = App\models\FacilityWorker::paginate(20);
                        // Assuming FacilityWorker is the model representing the facility_worker table
                    @endphp
                    @foreach($facilityworkers as $facilityworker)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-left">{{ $facilityworker->city_name ?? 'N/A' }}</td>
                            <td class="text-left">{{ $facilityworker->cityfacility->facility->name ?? 'N/A' }}</td>
                            <td class="text-left">{{ $facilityworker->worker->name ?? 'N/A' }}</td>
                            <td class="text-center">{{ number_format($facilityworker->total, 0, '.', '.') }}</td>
                            <td class="text-center">{{ number_format($facilityworker->population, 0, '.', '.') }}</td>
                            <td class="text-center">{{ number_format($facilityworker->ratio, 7, ',', ',') }}</td>
                            <td class="text-center">{{ $facilityworker->status }}</td>
                            <td class="text-center">
                                <a href="javascript:void(0)" data-id="{{ $facilityworker->id }}" class="edit btn btn-primary btn-sm editfacilityworker">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)" data-id="{{ $facilityworker->id }}" class="delete btn btn-danger btn-sm deletecfacilityworker">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination justify-content-center">
                {{ $facilityworkers->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@stop

@section('js')
@stop
