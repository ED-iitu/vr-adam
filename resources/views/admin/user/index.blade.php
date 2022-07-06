@extends('layouts.admin')
@section('title', 'Пользователи')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-fluid" id="kt_content_container">

            <table id="kt_datatable_example_5" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                <thead>
                <tr class="fw-bolder fs-6 text-gray-800 px-7">
                    <th>ФИО</th>
                    <th>Email</th>
                    <th>Телефон</th>
                    <th>Роль</th>
                    <th>Верифицирован</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->getRoleNames()[0] ?? 'User' }}</td>
                    <td>Да</td>
                    <td>
                        <a href="{{route('user.edit', $user)}}" class="btn btn-primary btn-hover-rise me-3">Изменить</a>
                        <form method="post"
                              action="{{route('user.destroy', $user)}}"
                              style="display: inline-block">
                            @csrf @method('DELETE')
                            <a class="btn btn-danger btn-hover-rise me-3 js-is-destroy" href="javascript:void(0)">Удалить</a>
                        </form>
                        @if ($user->is_blocked)
                            <a href="#" class="btn btn-info btn-hover-rise me-3 js-is-unblock">Разблокировать</a>
                        @else
                            <a href="#" class="btn btn-danger btn-hover-rise me-3 js-is-block">Заблокировать</a>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection