@extends('layouts.admin')
@section('title', 'Редактирование курса')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-fluid" id="kt_content_container">
            <form action="{{$action}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($course) && $course->id)
                    @method('PATCH')

                    <div class="form-floating mb-7 d-flex align-items-center justify-content-center">
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-200px symbol-lg-800px symbol-fixed position-relative">
                                <img src="{{$course->image}}" alt="image">
                            </div>
                        </div>
                    </div>
                @endif

                <input type="hidden" name="author_id" value="{{ Auth()->user()->id }}">
                <!--begin::Input group-->
                <div class="form mb-7">
                    <input type="file" name="image" class="form-control" id="avatar" placeholder="avatar"/>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Имя" value="{{$course->title ?? ''}}"/>
                    <label for="name">Название курса</label>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <textarea name="short_description" id="kt_docs_ckeditor_classic" >
                        {{ $course->short_description ?? 'Короткое описание курса' }}
                    </textarea>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <textarea name="full_description" id="kt_docs_ckeditor_classic_full" >
                        {{ $course->full_description ?? 'Полное описание курса' }}
                    </textarea>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <select class="form-select" data-control="select2" data-placeholder="Выберите категорию" name="category_id">
                        @if(isset($course->category_id))
                            <option value="{{$course->category->id}}">{{ $course->category->title }}</option>
                        @else
                        <option></option>
                        @endif
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>

                <!--begin::Input group-->
                <div class="form mb-7">
                    <label class="form-label">Дата начала курса</label>
                    <input class="form-control form-control-solid" name="start_date" placeholder="Pick date rage" id="kt_daterangepicker_3_start" value="{{ $course->start_date ?? '' }}"/>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="form mb-7">
                    <label class="form-label">Дата завершения курса</label>
                    <input class="form-control form-control-solid" name="end_date" placeholder="Pick date rage" id="kt_daterangepicker_3_end" value="{{ $course->end_date ?? '' }}"/>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <input type="text" class="form-control" id="old_price" name="old_price" placeholder="Старая цена" value="{{$course->old_price ?? ''}}"/>
                    <label for="old_price">Старая цена</label>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <input type="text" class="form-control" id="current_price" name="current_price" placeholder="Текущая цена" value="{{$course->current_price ?? ''}}"/>
                    <label for="old_price">Текущая цена</label>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="" id="is_cashback_available" name="is_cashback_available" checked="{{ $course->is_cashback_available ?? '' }}"/>
                        <label class="form-check-label" for="flexSwitchDefault">
                            Доступен ли кешбек
                        </label>
                    </div>
                </div>

                <div class="form-floating mb-7">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="" id="is_active" name="is_active" checked="{{ $course->is_active ?? '' }}"/>
                        <label class="form-check-label" for="flexSwitchDefault">
                            Активен ли курс
                        </label>
                    </div>
                </div>
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <input type="text" class="form-control" id="cashback_percent" name="cashback_percent" placeholder="Процент кешбека" value="{{$course->cashback_percent ?? 0}}"/>
                    <label for="cashback_percent">Процент кешбека</label>
                </div>
                <!--end::Input group-->

                <div class="form-floating mb-7">
                    <button type="submit" class="btn btn-primary me-3">
                        @if (isset($course) && $course->id)
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