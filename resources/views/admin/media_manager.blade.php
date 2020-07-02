@extends('layouts.admin')

@section('content')
<iframe src="/admin/filemanager" width="100%" height="800px"></iframe>
@endsection
@push('js')
<script type="text/javascript" src="assets/js/plugins/uploaders/dropzone.min.js"></script>
@endpush

@push('script')
<script>
    $("#dropzone_multiple").dropzone({
        paramName: "file", // The name that will be used to transfer the file
        dictDefaultMessage: 'Drop files to upload <span>or CLICK</span>',
        maxFilesize: 100, // MB,
        sending: function(file, xhr, formData) {
            formData.append("_token", "{{ csrf_token() }}");
        },
    });
</script>
@endpush