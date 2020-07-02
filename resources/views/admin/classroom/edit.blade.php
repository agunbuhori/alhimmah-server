@extends('layouts.admin')

@section('back')
@component('components.admin.back')
@endcomponent
@endsection

@section('content')
<!-- Basic layout-->
<div class="row">

    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">KELAS {{ $classroom->name }}</h4>
            </div>
            <div class="tabbable">
                <div class="p-15">

                    <ul class="nav nav-tabs nav-tabs-solid nav-tabs-component nav-justified">
                        <li class="active"><a href="#tab1" data-toggle="tab">MATA PELAJARAN</a></li>
                        <li><a href="#tab2" data-toggle="tab">PESERTA</a></li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div class="tab-pane table-responsive active" id="tab1">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>@lang('Judul')</th>
                                    <th>@lang('Jumlah Materi')</th>
                                    <th>@lang('Durasi Pembelajaran')</th>
                                    <th width="10%">@lang('Publikasi')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($classroom->courses as $course)
                                <tr>
                                    <td>
                                        <a href="/admin/course/{{ $course->id }}">{{ $course->code." - ".$course->title }}</a>
                                    </td>
                                    <td>{{ $course->materies->count() }} Materi</td>
                                    <td>{{ $course->materies->sum('duration') }} Menit</td>
                                    <td class="text-right">
                                    <td class="text-right">
                                        @if ($course->published)
                                        <span class="label label-flat label-rounded label-success text-success">DIPUBLIKASI</span>
                                        @else
                                        <span class="label label-flat label-rounded label-warning text-warning">PENGEMBANGAN</span>
                                        @endif
                                    </td>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane table-responsive" id="tab2">
                        <table class="table datatable-selection-single" data-source="/admin/classroom_member/{{ $classroom->id }}">
                            <thead>
                                <tr>
                                    <th>Nomor ID</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Persentase</th>
                                    <!-- <th width="120px" class="text-center">Actions</th> -->
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <form method="POST" action="/admin/classroom/{{ $classroom->id }}">
            @csrf
            @method('PUT')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Pengaturan</h4>
                    <div class="heading-elements">
                        <div class="checkbox checkbox-switchery">
                            <label>
                                <input type="checkbox" name="published" class="switchery" {!! $classroom->published ? 'checked' : '' !!}>
                                PUBLIKASI
                            </label>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="form-group form-group-xlg">
                        <label>@lang('Nama Kelas') :</label>
                        <input type="text" class="form-control" placeholder="Nama kelas" name="name" value="{{ $classroom->name }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('Kode Kelas') :</label>
                        <input type="text" class="form-control" placeholder="Kode kelas" name="code" value="{{ $classroom->code }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('Deskripsi') :</label>
                        <textarea id="ckeditor" name="description" placeholder="Enter text ...">
                                {!! $classroom->description !!}
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
<script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
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

    var column_config = [{
            data: "id_number"
        },
        {
            render: function(a, b, data) {
                return `<a href="#">${data.name}</a>`;
            },
            data: "name"
        },
        {
            render: function(a, b, data) {
                return data.gender === 'male' ?
                    'Ikhwan' :
                    `Akhwat`
            },
            data: "gender"
        },
        {
            render: function(a, b, data) {
                return '25%'
            },
            orderable: false,
            searchable: false
        },
    ];
</script>
<script type="text/javascript" src="assets/js/pages/datatable_server.js"></script>
@endpush