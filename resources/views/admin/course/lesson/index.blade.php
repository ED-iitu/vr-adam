@extends('layouts.admin')
@section('title', 'Уроки курса')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-fluid" id="kt_content_container">
            <div class="form-floating mb-7">
                <a href="{{ URL::previous() }}" class="btn btn-info btn-hover-rise me-3">Назад</a>
                <a href="{{route('course_lesson_create', $course)}}" class="btn btn-primary btn-hover-rise me-3">Добавить</a>
            </div>

            @if(empty($lessons[0]))
                <h2>Пусто</h2>
            @else
                <table id="kt_datatable_example_5" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                    <thead>
                    <tr class="fw-bolder fs-6 text-gray-800 px-7">
                        <th>Название</th>
                        <th>Курс</th>
                        <th>Описание</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lessons as $lesson)
                        <tr>
                            <td>{{ $lesson->title }}</td>
                            <td>{{ $lesson->course->title }}</td>
                            <td>{{ $lesson->description }}</td>
                            <td>
                                <a href="{{route('course_lesson_edit', [$course, $lesson])}}" class="btn btn-primary btn-hover-rise me-3">Изменить</a>
                                <form method="post"
                                      action="{{route('course_lesson_delete', [$course, $lesson])}}"
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