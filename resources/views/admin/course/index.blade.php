@extends('layouts.admin')
@section('title', 'Курсы')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-fluid" id="kt_content_container">
            <div class="form-floating mb-7">
                <a href="{{route('course.create')}}" class="btn btn-primary btn-hover-rise me-3">Добавить</a>
            </div>

            @if(empty($courses[0]))
                <h2>Пусто</h2>
            @else
            <table id="kt_datatable_example_5" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                <thead>
                <tr class="fw-bolder fs-6 text-gray-800 px-7">
                    <th>Название</th>
                    <th>Категория</th>
                    <th>Краткое описание</th>
                    <th>Автор</th>
                    <th>Активна</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{ $course->title }}</td>
                        <td>{{ $course->category->title }}</td>
                        <td>{{ $course->short_description }}</td>
                        <td>{{ $course->author->name }}</td>
                        <td>{{ $course->is_active }}</td>
                        <td>
                            <a href="{{route('course_lessons', $course)}}" class="btn btn-info btn-hover-rise me-3">Уроки</a>
                            <a href="{{route('course.edit', $course)}}" class="btn btn-primary btn-hover-rise me-3">Изменить</a>
                            <form method="post"
                                  action="{{route('course.destroy', $course)}}"
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