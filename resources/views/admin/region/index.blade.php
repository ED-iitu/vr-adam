@extends('layouts.admin')
@section('title', 'Регионы')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-fluid" id="kt_content_container">
            <div class="form-floating mb-7">
                <a href="{{route('region.create')}}" class="btn btn-primary btn-hover-rise me-3">Добавить</a>
            </div>
            @if(empty($regions[0]))
                <h2>Пусто</h2>
            @else
                <table id="kt_datatable_example_5" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                    <thead>
                    <tr class="fw-bolder fs-6 text-gray-800 px-7">
                        <th>Название</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($regions as $region)
                        <tr>
                            <td>{{ $region->title }}</td>
                            <td>
                                <a href="{{route('region.edit', $region)}}" class="btn btn-primary btn-hover-rise me-3">Изменить</a>
                                <form method="post"
                                      action="{{route('region.destroy', $region)}}"
                                      style="display: inline-block">
                                    @csrf @method('DELETE')
                                    <a class="btn btn-danger btn-hover-rise me-3 js-is-destroy" href="javascript:void(0)">Удалить</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection