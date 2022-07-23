@extends('layouts.admin')
@section('title', 'Турагенства')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-fluid" id="kt_content_container">
            @if(empty($agencies[0]))
                <h2>Пусто</h2>
            @else
                <table id="kt_datatable_example_5" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                    <thead>
                    <tr class="fw-bolder fs-6 text-gray-800 px-7">
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Адресс</th>
                        <th>Телефон</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($agencies as $agency)
                        <tr>
                            <td>{{ $agency->name }}</td>
                            <td>{{ $agency->description }}</td>
                            <td>{{ $agency->addresses[0]->address }}</td>
                            <td>{{ $agency->phone }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection