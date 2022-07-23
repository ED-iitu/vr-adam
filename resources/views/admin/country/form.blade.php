@extends('layouts.admin')
@section('title', 'Редактирование страны')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-fluid" id="kt_content_container">
            <form action="{{$action}}" method="POST">
                @csrf
                @if (isset($country) && $country->id)
                    @method('PATCH')
                @endif
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <select class="form-select" data-control="select2" data-placeholder="Выберите регион" name="region_id">
                        @if(isset($country->region_id))
                            <option value="{{$country->region_id}}">{{ $country->region->title }}</option>
                        @else
                            <option></option>
                        @endif
                        @foreach($regions as $region)
                            <option value="{{$region->id}}">{{ $region->title }}</option>
                        @endforeach
                    </select>
                </div>
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Название" value="{{$country->title ?? ''}}"/>
                    <label for="title">Название страны</label>
                </div>
                <!--end::Input group-->

                <div class="form-floating mb-7">
                    <button type="submit" class="btn btn-primary me-3">
                        @if (isset($country) && $country->id)
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