@extends('layouts.auth')

@section('content')
<div class="wrapper">
    <div class="form-header">
        <h1>@lang('Daftar Baru')</h1>

    </div>
    <form class="login" method="post" action="/register">
        @csrf

        <div class="form-group">
            <div class="input-container">
                <input id="name" name="name" class="input" type="text" value="{{ old('name') }}" required />
                <label class="label" for="name">@lang('Nama')</label>
            </div>
        </div>

        <div class="form-group">
            <div class="input-container">
                <input id="email" name="email" class="input" type="text" value="{{ old('email') }}" required />
                <label class="label" for="email">@lang('Alamat email')</label>
            </div>
        </div>

        <div class="form-group">
            <div class="input-container">
                <input id="password" name="password" class="input" type="password" required min="8" />
                <label class="label" for="password">@lang('Kata sandi')</label>
            </div>
        </div>


        <div class="form-group">
            <div class="input-container">
                <input id="password_confirmation" name="password_confirmation" class="input" type="password" required />
                <label class="label" for="password_confirmation">@lang('Ulangi kata sandi')</label>
            </div>
        </div>


        @if ($errors->count())
        @foreach ($errors->all() as $error)
        <p class="danger">@lang($error)</p>
        @endforeach
        @endif

        <div class="form-group">
            <button class="primary">@lang('Mendaftar')</button>
        </div>

        <div class="form-group">
            <p class="or">@lang('Atau daftar dengan')</p>
        </div>

        <div class="form-group text-center">
            <a href="/auth/google" type="button" class="auth-button">
                <span class="auth-button__icon">
                    <img src="/images/social/google.png" />
                </span>
                <span class="auth-button__text">Google</span>
            </a>
            <a href="/auth/facebook" type="button" class="auth-button">
                <span class="auth-button__icon auth-button__icon--plus">
                    <img src="/images/social/facebook.png" />
                </span>
                <span class="auth-button__text">Facebook</span>
            </a>

        </div>

        <div class="form-group">
            <p class="or">@lang('Sudah punya akun? ') <a href="/login">Masuk</a></p>
        </div>
    </form>
</div>
@endsection