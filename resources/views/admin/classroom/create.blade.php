@extends('layouts.admin')

@section('content')
<!-- Basic layout-->
<div class="row">
    <div class="col-md-8">
        <form method="POST" action="/admin/classroom">
            @csrf
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Tambah Kelas</h4>
                    <div class="heading-elements">
                    <a href="{{ url()->previous() }}" class="btn btn-xs btn-default"><i class="icon-circle-left2 position-left"></i>  Kembali</a>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="form-group form-group-xlg">
                        <label>@lang('Nama Kelas') :</label>
                        <input type="text" class="form-control" placeholder="Nama kelas" name="name" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('Kode Kelas') :</label>
                        <input type="text" class="form-control" placeholder="Kode kelas" name="code" value="{{ old('code') }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('Deskripsi') :</label>
                        <textarea cols="18" rows="18" class="wysihtml5 wysihtml5-min form-control" name="description" placeholder="Enter text ...">
                                {!! old('description') !!}
                            </textarea>
                    </div>

                    @if ($errors->count())
                    <div class="alert alert-danger no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                        <span class="text-semibold">@lang('Terjadi kesalahan')</span>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">@lang('Simpan') <i class="icon-check position-right"></i></button>
                    </div>
                </div>
            </div>
        </form>
        <!-- /basic layout -->
    </div>
</div>
@endsection

@push('js')

<script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/editors/wysihtml5/wysihtml5.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/editors/wysihtml5/toolbar.js"></script>
<script type="text/javascript" src="assets/js/plugins/editors/wysihtml5/parsers.js"></script>
<script type="text/javascript" src="assets/js/plugins/editors/wysihtml5/locales/bootstrap-wysihtml5.ua-UA.js"></script>
<script type="text/javascript" src="assets/js/plugins/notifications/jgrowl.min.js"></script>
@endpush

@push('script')
<script type="text/javascript" src="assets/js/pages/editor_wysihtml5.js"></script>
@endpush