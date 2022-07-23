@extends('layouts.admin')
@section('title', 'Редактирование пользователя')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-fluid" id="kt_content_container">
            <form action="{{route('user.update', $user)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($user) && $user->id)
                    @method('PATCH')
                    @if (isset($user->avatar))
                        <div class="form-floating mb-7">
                            <div class="me-7 mb-4">
                                <div class="symbol symbol-200px symbol-lg-260px symbol-fixed position-relative">
                                    <img src="{{$user->avatar}}" alt="image">
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                <!--begin::Input group-->
                <div class="form mb-7">
                    <input type="file" name="avatar" class="form-control" id="avatar" placeholder="avatar"/>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Имя" value="{{$user->name ?? ''}}"/>
                    <label for="name">Введите Имя</label>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{$user->email ?? ''}}"/>
                    <label for="email">Введите email</label>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="form-floating mb-7">
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Телефон" value="{{$user->phone ?? ''}}"/>
                    <label for="phone">Введите телефон</label>
                </div>
                <!--end::Input group-->

                <div class="form-floating mb-7">
                    <button type="submit" class="btn btn-primary me-3">Обновить</button>
                </div>
            </form>
        </div>
    </div>
@endsection