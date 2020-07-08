@extends('layouts.admin')

@section('back')
@component('components.admin.back')
@endcomponent
@endsection

@section('content')
<!-- Single row selection -->
<div class="panel panel-default" id="controller">
    <div class="panel-heading">
        <h4 class="panel-title">{{ $quiz->matery->course->title . " - " . $quiz->matery->title }}</h4>
        <div class="heading-elements">

        </div>
    </div>

    <div class="panel-body">
        <input type="hidden" :value="question.id" name="matery_id">
        <div class="form-group">
            <label for="weekly_quiz">
                <input type="checkbox" name="weekly_quiz" id="weekly_quiz" value="1"> Tampilkan Di Ujian Pekan
            </label>
            &nbsp;
            <label for="monthly_quiz">
                <input type="checkbox" name="monthly_quiz" id="monthly_quiz" value="1"> Tampilkan Di Ujian Akhir
            </label>

        </div>
        <div class="form-group">
            <textarea id="ckeditor3" name="question" placeholder="Enter text ..."></textarea>
        </div>

        <div class="form-group row" v-for="(option, $index) in options">
            <div class="col-xs-1 text-right">
                <input type="radio" name="correct_answer" :value="$index" :checked="correct_answer == $index" required>
            </div>
            <div class="col-xs-10">
                <input type="text" class="form-control" placeholder="Jawaban" v-model="option.question" autocomplete="off" name="answer[]" required>
            </div>
            <div class="col-xs-1">
                <button type="button" class="btn btn-xs btn-warning" @click="options.splice($index, 1)"><i class="icon-cross"></i></button>
            </div>
        </div>

        <div class="form-group text-center">
            <button type="button" class="btn btn-link" @click="options.push({question: '', correct: ''})"><i class="icon-plus3 position-left"></i> Tambah</button>
        </div>

    </div>



</div>
<!-- /single row selection -->
@endsection

@push('js')
<script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
@endpush

@push('script')
<script>
    $(function() {
        let editor = CKEDITOR.replace('ckeditor3', {
            height: '200px',
            filebrowserImageBrowseUrl: '/admin/filemanager?type=Images',
            filebrowserImageUploadUrl: '/admin/filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/admin/filemanager?type=Files',
            filebrowserUploadUrl: '/admin/filemanager/upload?type=Files&_token=',
            toolbarGroups: [{
                    "name": "basicstyles",
                    "groups": ["basicstyles"]
                },
                {
                    "name": "insert",
                    "groups": ["insert"]
                },
                {
                    "name": "styles",
                    "groups": ["styles"]
                }
            ],
        });

        editor.setData(`{!! $quiz->question !!}`);
    });
    
    let answer = {!! $quiz->answer !!};
    
    answer = answer.map(item => {
        return {question: item}
    });

    console.log

    let controller = new Vue({
        el: "#controller",
        
        data: {
            options: answer,
            question: {},
            correct_answer: {!! $quiz->correct_answer !!},
        },
        mounted: function() {

        },
        methods: {

        }
    });
</script>
@endpush