@extends('layouts.admin')
@section('title', 'Редактирование категории товара')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-fluid" id="kt_content_container">
            <form action="{{$action}}" method="POST">
                @csrf
                @if (isset($category) && $category->id)
                    @method('PATCH')
                @endif
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Имя" value="{{$category->title ?? ''}}"/>
                    <label for="name">Название категории курсов</label>
                </div>
                <!--end::Input group-->

                <div class="form-floating mb-7">
                    <button type="submit" class="btn btn-primary me-3">
                        @if (isset($category) && $category->id)
                            Обновить
                        @else
                            Сохранить
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection