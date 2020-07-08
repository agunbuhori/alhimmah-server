@extends('layouts.admin')

@section('content')
<!-- Single row selection -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">@lang('Manajemen Peserta')</h4>
        <div class="heading-elements">

        </div>
    </div>


    <table class="table datatable-selection-single table-striped" data-source="/admin/member_profile">
        <thead>
            <tr>
                <th>NO</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Email</th>
                <th>Sosial</th>
                <th>Whatsapp</th>
                <th>Waktu Pendaftaran</th>
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
var column_config = [
    {data: "DT_RowIndex", orderable: false, searchable: false},
    {data: "member_id"},
    {data: "name"},
    {
        render: function(a, b, data) {
            if (! data.gender)
            return '';
            
            return data.gender === 'male' ?
            'Ikhwan' :
            `Akhwat`
        },
        data: "gender"
    },
    {data: "user.email"},
    {
        render: function(a, b, data) {
            return '<img width="20px" src="/images/social/'+data.user.social+'.png"/>'
        },
        data: "user.social",
        class: "text-center",
    },
    {data: "whatsapp"},
    {data: "user.created_at"},

]
</script>
<script type="text/javascript" src="assets/js/pages/datatable_server.js"></script>
@endpush