@extends('layouts.admin')
@section('title', 'Редактирование продукта')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-fluid" id="kt_content_container">
            <form action="{{$action}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($product) && $product->id)
                    @method('PATCH')

                    <div class="form-floating mb-7 d-flex align-items-center justify-content-center">
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-200px symbol-lg-800px symbol-fixed position-relative">
                                <img src="{{$product->image}}" alt="image">
                            </div>
                        </div>
                    </div>
                @endif

                <!--begin::Input group-->
                <div class="form mb-7">
                    <input type="file" name="image" class="form-control" id="avatar" placeholder="avatar"/>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Имя" value="{{$product->title ?? ''}}"/>
                    <label for="name">Название продукта</label>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <textarea name="description" id="kt_docs_ckeditor_classic" >
                        {{ $product->description ?? 'Описание продукта' }}
                    </textarea>
                </div>
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <select class="form-select" data-control="select2" data-placeholder="Выберите категорию" name="category_id">
                        @if(isset($product->category_id))
                            <option value="{{$product->category->id}}">{{ $product->category->title }}</option>
                        @else
                            <option></option>
                        @endif
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>

                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <input type="text" class="form-control" id="current_price" name="price" placeholder="Текущая цена" value="{{$product->price ?? ''}}"/>
                    <label for="old_price">Цена</label>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="" id="is_cashback_available" name="is_cashback_available" @if ($product->is_cashback_available) checked @else '' @endif/>
                        <label class="form-check-label" for="flexSwitchDefault">
                            Доступен ли кешбек
                        </label>
                    </div>
                </div>

                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <input type="text" class="form-control" id="cashback_percent" name="cashback_percent" placeholder="Процент кешбека" value="{{$product->cashback_percent ?? 0}}"/>
                    <label for="cashback_percent">Процент кешбека</label>
                </div>
                <!--end::Input group-->

                <div class="form-floating mb-7">
                    <button type="submit" class="btn btn-primary me-3">
                        @if (isset($product) && $product->id)
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