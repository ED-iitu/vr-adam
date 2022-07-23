@extends('layouts.admin')
@section('title', 'Редактирование региона')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-fluid" id="kt_content_container">
            <form action="{{$action}}" method="POST">
                @csrf
                @if (isset($region) && $region->id)
                    @method('PATCH')
                @endif
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Название" value="{{$region->title ?? ''}}"/>
                    <label for="title">Название региона</label>
                </div>
                <!--end::Input group-->

                <div class="form-floating mb-7">
                    <button type="submit" class="btn btn-primary me-3">
                        @if (isset($region) && $region->id)
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