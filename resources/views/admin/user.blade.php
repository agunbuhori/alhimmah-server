@extends('layouts.admin')

@section('content')
<!-- Content area -->
<div class="content">
    <!-- Single row selection -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5 class="panel-title">@lang('Manajemen Pengguna')</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>


        <table class="table datatable-selection-single" data-source="/admin/data/user">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Verified</th>
                    <th width="120px" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
    </div>
    <!-- /single row selection -->

</div>
@endsection

@push('js')
<script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
@endpush

@push('script')
<script>
    var column_config = [
            {data: "name"},
            {data: "email"},

            {render: function (a, b, data) {    
                var html = "";

                for (i = 0; i < data.roles.length; i++) {
                    html += `<span class="label label-info">${data.roles[i].name}</span>`;
                }

                return html;
            }},
            
            {render: function (a, b, data) {
                return data.email_verified_at 
                ? `<span class="label label-success">${data.email_verified_at}</span>`
                : `<span class="label label-default">Unverified</span>`
            }},

            {orderable: false, align: 'right', render: function() {
                return `
                <a href="#" class="label label-primary label-icon"><i class="icon-pencil"></i></a>
                <a href="#" class="label label-warning label-icon"><i class="icon-trash"></i></a>
                `
            }}
        ]
</script>
<script type="text/javascript" src="assets/js/pages/datatable_server.js"></script>
@endpush