@extends('layouts.admin')

@section('content')
<!-- Basic layout-->
<div class="row">
    <div class="col-md-8">
        <form method="POST" action="/admin/course">
            @csrf
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">@lang('Tambah Mata Pelajaran')</h4>
                    <div class="heading-elements">
                        <a href="/admin/classroom" class="btn btn-xs btn-default"><i class="icon-circle-left2 position-left"></i> Kembali</a>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="form-group form-group-xlg">
                        <label>@lang('Kelas') :</label>
                        <select class="form-control select2" name="classroom_id">
                            @foreach (App\Classroom::all() as $classroom)
                            <option {!! Request::get('classroom_id') || old('classroom_id')==$classroom->id ? 'selected' : '' !!} value="{{ $classroom->id }}">{{ "$classroom->code - ".$classroom->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group form-group-xlg">
                        <label>@lang('Judul Pelajaran') :</label>
                        <input type="text" class="form-control" placeholder="Judul pelajaran" name="title" value="{{ old('title') }}" autocomplete="off">
                    </div>


                    <div class="form-group">
                        <label>@lang('Kode Kode Mata Pelajaran') :</label>
                        <input type="text" class="form-control" placeholder="Kode mata pelajaran" name="code" value="{{ old('code') }}" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="">Pemateri</label>
                        <select class="form-control select2" name="teacher_id">
                            @foreach (App\Teacher::all() as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>@lang('Deskripsi') :</label>
                        <textarea id="ckeditor" name="description" placeholder="Enter text ...">
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
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
@endpush

@push('script')
<script>
    $(function() {
        CKEDITOR.replace( 'ckeditor', {
            height: '400px',
            filebrowserImageBrowseUrl: '/admin/filemanager?type=Images',
            filebrowserImageUploadUrl: '/admin/filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/admin/filemanager?type=Files',
            filebrowserUploadUrl: '/admin/filemanager/upload?type=Files&_token='
        });
    });
</script>
@endpush