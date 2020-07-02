@extends('layouts.admin')

@section('content')
<!-- Support tickets -->
<div class="panel panel-default">
    <div class="panel-heading no-border-bottom">
        <h4 class="panel-title">@lang('Manajemen Kelas')</h4>
        <div class="heading-elements">
            <button data-toggle="modal" data-target="#modal_default" class="btn btn-primary"><i class="icon-plus3 position-left"></i> @lang('Buat Kelas Baru')</button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-xlg text-nowrap">
            <tbody>
                <tr>
                    <td class="col-md-4">
                        <div class="media-left media-middle">
                            <a href="#" class="btn border-success text-success btn-flat btn-rounded btn-xs btn-icon"><i class="icon-office"></i></a>
                        </div>

                        <div class="media-left">
                            <h5 class="text-semibold no-margin">{{ $classrooms->total() }} Kelas</h5>
                            <span class="text-muted"><span class="status-mark border-success position-left"></span> {{ $publishedClasrooms."/".$classrooms->count() }} DIPUBLIKASI</span>
                        </div>
                    </td>

                    <td class="col-md-3">
                        <div class="media-left media-middle">
                            <a href="#" class="btn border-success text-success btn-flat btn-rounded btn-xs btn-icon"><i class="icon-book"></i></a>
                        </div>

                        <div class="media-left">
                            <h5 class="text-semibold no-margin">
                                {{ $publishedCourses }} <small class="display-block no-margin">@lang('Mata Pelajaran')</small>
                            </h5>
                        </div>
                    </td>

                    <td class="col-md-3">
                        <div class="media-left media-middle">
                            <a href="#" class="btn border-success text-success btn-flat btn-rounded btn-xs btn-icon"><i class="icon-users"></i></a>
                        </div>

                        <div class="media-left">
                            <h5 class="text-semibold no-margin">
                                {{ $joinedMembers }}<small class="display-block no-margin">@lang('Peserta Aktif')</small>
                            </h5>
                        </div>
                    </td>

                    <td class="col-md-3">
                        <div class="media-left media-middle">
                            <a href="#" class="btn border-success text-success btn-flat btn-rounded btn-xs btn-icon"><i class="icon-users"></i></a>
                        </div>

                        <div class="media-left">
                            <h5 class="text-semibold no-margin">
                                {{ $totalMembers-$joinedMembers }}<small class="display-block no-margin">@lang('Peserta Baru')</small>
                            </h5>
                        </div>
                    </td>

                </tr>
            </tbody>
        </table>
    </div>

    <div class="table-responsive">
        <table class="table text-nowrap">

            <tbody>
                @foreach ($classrooms as $classroom)
                <tr>

                    <td width="15%">
                        <a href="/admin/classroom/{{ $classroom->id }}" class="h6 no-margin display-inline-block text-default text-semibold letter-icon-title">{{ strtoupper($classroom->name) }}</a>
                        <div class="text-muted text-size-small">
                            <span class="text-semibold">{{ $classroom->code }}</span>
                        </div>
                    </td>
                    <td class="text-center">
                        <span class="h6 no-margin">{{ $classroom->classroom_members_count }} <small class="display-block text-size-small no-margin">@lang('Peserta')</small></span>
                    </td>
                    <td class="wrap">
                        @if (! $classroom->courses->count())
                        <span class="text-muted">@lang('Tidak ada matpel')</span>
                        @endif
                        @foreach ($classroom->courses as $course)
                        <!-- <a class="btn btn-default btn-rounded btn-xs">{{ $course->title }}</a> -->
                        <a href="/admin/course/{{ $course->id }}">
                            <span class="label border-left-{!! $course->published ? 'success' : 'warning' !!} label-striped">{{ $course->title }} ({{ $course->materies->count() }})</span>
                        </a>
                        @endforeach
                        <a href="/admin/course/create?classroom_id={{ $classroom->id }}" class="btn btn-primary btn-rounded btn-xs"><i class="icon-plus3 position-left"></i> @lang('Tambah')</a>
                    </td>
                    <td class="text-right">
                        @if ($classroom->published)
                        <span class="label label-flat label-rounded label-success text-success">DIPUBLIKASI</span>
                        @else
                        <span class="label label-flat label-rounded label-warning text-warning">PENGEMBANGAN</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($classrooms->total() > $classrooms->perPage())
    <div class="panel-footer p-15 text-right">
        {!! $classrooms->links() !!}
    </div>
    @endif
</div>
<!-- /support tickets -->

<!-- Basic modal -->
<form id="modal_default" class="modal fade" method="POST" action="/admin/classroom">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">@lang('Buat Kelas Baru')</h5>
            </div>

            <div class="modal-body">
                @csrf
                <div class="form-group form-group-xlg">
                    <label>@lang('Nama Kelas') :</label>
                    <input type="text" class="form-control" placeholder="Nama kelas" name="name" value="{{ old('name') }}" autocomplete="off">
                </div>

                <div class="form-group">
                    <label>@lang('Kode Kelas') :</label>
                    <input type="text" class="form-control" placeholder="Kode kelas" name="code" value="{{ old('code') }}" autocomplete="off">
                </div>

                <div class="form-group">
                    <label>@lang('Deskripsi') :</label>
                    <textarea id="ckeditor" rows="4" cols="4" name="description">
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
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Batalkan</button>
                <button type="submit" class="btn btn-primary">@lang('Simpan')</button>
            </div>
        </div>
    </div>
</form>
<!-- /basic modal -->
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
<!-- <script type="text/javascript" src="assets/js/pages/form_checkboxes_radios.js"></script> -->
@endpush