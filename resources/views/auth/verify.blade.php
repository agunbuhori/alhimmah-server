@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="cover"></div>
    <div class="wrapper">
        <div class="form-header">
            <h1>@lang('Verifikasi Email')</h1>
            <p>@lang('Email verifikasi telah dikirim ke ')<strong>{{ auth()->user()->email }}</strong>. Jika tidak menerima email, silakan tekan <strong><i>Kirim Ulang</i></strong>.</p>
        </div>
        <form class="login" method="post" action="/email/resend">
            @csrf

            @if (session('resent'))
                <p class="success">
                    @lang('Email verifikasi telah dikirim').
                </p>
            @endif

            <div class="form-group">
                <button class="primary">@lang('Kirim Ulang')</button>
            </div>

            <!-- <div class="form-group">
            <p>@lang('Jika tidak menerima kode verifikasi'), <a href="#" onclick="resend()"> @lang('klik disini untuk mengirim ulang').</a></p>
            </div> -->
        </form>
    </div>
</div>

<script>
async function resend() {
    await fetch("/email/resend", {
        method: "POST"
    })
    .then(response => {
        // location.reload();
    })
}
</script>
@endsection
