@extends('layouts.admin')
@section('title', 'Редактирование урока')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-fluid" id="kt_content_container">
            <form action="{{$action}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($lesson) && $lesson->id)
                    @method('PATCH')

                    <div class="form-floating mb-7 d-flex align-items-center justify-content-center">
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-200px symbol-lg-800px symbol-fixed position-relative">
                                <img src="{{$lesson->preview}}" alt="image">
                            </div>
                        </div>
                    </div>
                @endif

                <input type="hidden" name="course_id" value="{{$course->id}}">

                <!--begin::Input group-->
                <div class="form mb-7">
                    <input type="file" name="preview" class="form-control" id="avatar" placeholder="avatar"/>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Имя" value="{{$lesson->title ?? ''}}"/>
                    <label for="name">Название урока</label>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <textarea name="description" id="kt_docs_ckeditor_classic_full" >
                        {{ $lesson->description ?? 'Описание урока' }}
                    </textarea>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <input type="text" class="form-control" id="video" name="video" placeholder="Видео" value="{{$lesson->video ?? ''}}"/>
                    <label for="video_link">Ссылка на видео</label>
                </div>
                <!--end::Input group-->

                <div class="form-floating mb-7">
                    <button type="submit" class="btn btn-primary me-3">
                        @if (isset($lesson) && $lesson->id)
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