@extends('layouts.auth')
@section('content')

    <div class="card mb-3">

        <div class="card-body">

            <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Регистрация</h5>
            </div>

            <form class="row g-3 "  action="{!! route('cabinet.postRegisterPage') !!}" method="post">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                @php
                    $errorEmail = isset($templateErrors['email']) ? $templateErrors['email'] : false;
                    $oldEmail = isset($oldValues['email']) ? $oldValues['email'] : '';
                @endphp

                <div class="col-12 @if($errorEmail) was-validated @endif">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @if($errorEmail) is-invalid @endif" id="email" @if($oldEmail) value="{!! $oldEmail !!}" @endif required>
                    <div class="invalid-feedback">@if($errorEmail) {!! $errorEmail !!} @else Введите корректный Email @endif</div>
                </div>

                <?php
                    $errorPhone = isset($templateErrors['phone']) ? $templateErrors['phone'] : false;
                    $oldPhone = isset($oldValues['phone']) ? $oldValues['phone'] : '';
                ?>
                <div class="col-12 ">
                    <label for="phone" class="form-label">Телефон</label>
                    <input type="text" name="phone" class="form-control phone @if($errorPhone) is-invalid @endif" id="phone" @if($oldPhone) value="{!! $oldPhone !!}" @endif required>
                    <div class="invalid-feedback">@if($errorPhone) {!! $errorPhone !!} @else Введите номер телефона @endif</div>
                </div>

                <?php
                    $errorPassword = isset($templateErrors['password']) ? $templateErrors['password'] : false;
                ?>
                <div class="col-12 @if($errorPassword) was-validated @endif">
                    <label for="yourPassword" class="form-label">Пароль</label>
                    <input type="password" name="password" class="form-control @if($errorPassword) is-invalid @endif" id="password" required>
                    <div class="invalid-feedback">@if($errorPassword) {!! $errorPassword !!} @else Введите пароль @endif</div>
                </div>

                <div class="col-12 @if($errorPassword) was-validated @endif">
                    <label for="password_confirm" class="form-label">Подтвердите пароль</label>
                    <input type="password" name="password_confirm" class="form-control @if($errorPassword) is-invalid @endif" id="password_confirm" required>
                    <div class="invalid-feedback">@if($errorPassword) {!! $errorPassword !!} @else Подтвердите пароль @endif</div>
                </div>

                <?php
                    $errorTerms = isset($templateErrors['terms']) ? $templateErrors['terms'] : false;
                ?>
                <div class="col-12 @if($errorTerms) was-validated @endif">
                    <div class="form-check">
                        <input class="form-check-input @if($errorPassword) is-invalid @endif" name="terms" type="checkbox" value="on" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">Я согласен на <a href="#">обработку персональных данных</a></label>
                        <div class="invalid-feedback">@if($errorTerms) {!! $errorTerms !!} @else Вы должны согласиться с условиями обработки персональных данных. @endif</div>
                    </div>
                </div>


                <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Регистрация</button>
                </div>


                <div class="col-12">
                    <p class="small mb-0">Уже есть аккаунт? <a href="{!! route('cabinet.getLoginPage') !!}">Авторизуйтесь</a></p>
                </div>
            </form>

        </div>
    </div>

@endsection
