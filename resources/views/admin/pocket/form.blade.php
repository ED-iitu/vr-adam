@extends('layouts.admin')
@section('title', 'Редактирование пакета')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-fluid" id="kt_content_container">
            <form action="{{$action}}" method="POST">
                @csrf
                @if (isset($pocket) && $pocket->id)
                    @method('PATCH')
                @endif
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Название" value="{{$pocket->title ?? ''}}"/>
                    <label for="title">Название</label>
                </div>
                <div class="form-floating mb-7">
                    <input type="text" class="form-control" id="price" name="price" placeholder="Цена" value="{{$pocket->price ?? ''}}"/>
                    <label for="price">Цена</label>
                </div>
                <div class="form-floating mb-7">
                    <input type="text" class="form-control" id="view_count" name="view_count" placeholder="Цена" value="{{$pocket->view_count ?? ''}}"/>
                    <label for="view_count">Кол-во просмотров</label>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="" id="available_in_subscription" name="available_in_subscription" @if (isset($pocket) && $pocket->available_in_subscription) checked @else '' @endif/>
                        <label class="form-check-label" for="flexSwitchDefault">
                            Доступен ли по подписке
                        </label>
                    </div>
                </div>

                <div class="form-floating mb-7">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="" id="is_active" name="is_active" @if (isset($pocket) && $pocket->is_active) checked @else '' @endif/>
                        <label class="form-check-label" for="flexSwitchDefault">
                            Активен ли пакет
                        </label>
                    </div>
                </div>

                <div class="form-floating mb-7">
                    <button type="submit" class="btn btn-primary me-3">
                        @if (isset($pocket) && $pocket->id)
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