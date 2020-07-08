@extends('layouts.admin')

@section('content')

@php
$classrooms = App\Classroom::all();

$classroom_id = request()->cid ?? $classrooms[0]->id;
@endphp
<!-- Single row selection -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">@lang('Bank Soal')</h4>
        <div class="heading-elements">
            <select name="" id="" class="form-control select2" onchange="changeClassroom(event)">
                @foreach ($classrooms as $classroom)
                <option {!! $classroom_id == $classroom->id ? 'selected' : '' !!} value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                @endforeach
            </select>
        </div>
    </div>


    <table class="table datatable-selection-single table-striped" data-source="/admin/quiz?classroom_id={{ $classroom_id }}">
        <thead>
            <tr>
                <th width="5%">NO</th>
                <th>Mata Pelajaran</th>
                <th>Judul Materi</th>
                <th>Pertanyaan</th>
                <th width="10%">Jawaban</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<!-- /single row selection -->
@endsection

@push('js')
<script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
@endpush

@push('script')
<script>
    console.log(window.location);
    function changeClassroom(event) {
        window.location.href = window.location.href.replace(/\?.*$/, '')   +'?cid='+event.target.value;
    }
var column_config = [
    {data: "DT_RowIndex", orderable: false, searchable: false},
    {
        
        data: "matery.course.title"
    },
    
    {
        render: function(a, b, data) {
           return `<a href="/admin/quiz/${data.id}/edit">${data.matery.title}</a>`
        },
        data: "matery.title"
    },

    {data: "question"},
    {orderable: false, align: 'right', render: function(a, b, data) {
        return `
        <a href="/admin/quiz/${data.id}/edit" class="btn btn-link btn-xs"><i class="icon-pencil position-left"></i> Edit</a>
        `
    }}
]
</script>
<script type="text/javascript" src="assets/js/pages/datatable_server.js"></script>
@endpush