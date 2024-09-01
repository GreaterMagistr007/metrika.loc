@extends('layouts.auth')
@section('content')

    <div class="card mb-3">

        <div class="card-body">

            <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Авторизация</h5>
            </div>

            <form class="row g-3 "  action="{!! route('cabinet.postLoginPage') !!}" method="post">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                @php
                    $errorEmail = isset($templateErrors['email']) ? $templateErrors['email'] : false;
                    $oldEmail = isset($oldValues['email']) ? $oldValues['email'] : '';
                @endphp

                <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @if($errorEmail) is-invalid @endif" id="email" @if($oldEmail) value="{!! $oldEmail !!}" @endif required>
                    <div class="invalid-feedback">@if($errorEmail) {!! $errorEmail !!} @else Введите корректный Email @endif</div>
                </div>

                <?php
                    $errorPassword = isset($templateErrors['password']) ? $templateErrors['password'] : false;
                ?>
                <div class="col-12 @if($errorPassword) was-validated @endif">
                    <label for="yourPassword" class="form-label">Пароль</label>
                    <input type="password" name="password" class="form-control @if($errorPassword) is-invalid @endif" id="password" required>
                    <div class="invalid-feedback">@if($errorPassword) {!! $errorPassword !!} @else Введите пароль @endif</div>
                </div>

                <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Войти</button>
                </div>

                <div class="col-12">
                    <p class="small mb-0">Еще не создан аккаунт? <a href="{!! route('cabinet.getLoginPage') !!}">Зарегистрируйтесь</a></p>
                </div>
            </form>

        </div>
    </div>

@endsection
