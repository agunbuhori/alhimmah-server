@extends('layouts.admin')

@section('back')
@component('components.admin.back')
@endcomponent
@endsection

@section('content')
<!-- Basic layout-->
<div class="row" id="controller">
    <!-- Basic modal -->
    <form id="modal_quiz" class="modal" method="POST" action="/admin/quiz">
        @csrf
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Buat Soal : @{{ question.title }}</h3>
                </div>

                <div class="modal-body">
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
                        <label>Pertanyaan</label>
                        <textarea id="ckeditor3" name="question" placeholder="Enter text ...">
                        </textarea>
                    </div>

                    <div class="form-group row" v-for="(option, $index) in options">
                        <div class="col-xs-1 text-right">
                            <input type="radio" name="correct_answer" :value="$index" :checked="$index === 0" required>
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
                
                <div class="modal-footer">
                    <div class="pull-right">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-primary">@lang('Simpan')</button>

                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- /basic modal -->

    <!-- Basic modal -->
    <form id="modal_default" class="modal" method="POST" :action="editMode ? '/admin/matery/'+matery.id : '/admin/matery'">
        @csrf
        <div v-if="editMode">
            @method('PUT')
        </div>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 v-if="!editMode" class="modal-title">@lang('Tambah Materi') {{ Str::title($course->title) }}</h3>
                    <h3 v-else class="modal-title">Edit Materi : @{{ matery.title }}</h3>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Judul</label>
                        <input type="text" class="form-control" placeholder="Masukkan judul materi" v-model="matery.title" name="title" autocomplete="off" value="{{ old('value') }}">
                    </div>

                    <input type="hidden" name="course_id" value="{{ $course->id }}">

                    <div class="form-group">
                        <label>Durasi Materi (1-320 Menit)</label>
                        <input type="number" class="form-control" name="duration" value="5">
                    </div>

                    <div class="form-group">
                        <label for="">Jenis Materi</label>
                        <select name="kind" class="form-control" @change="changeKind($event)">
                            <option :selected="matery.video_url" value="video_url">Video</option>
                            <option :selected="matery.audio_url" value="audio_url">Audio</option>
                            <option :selected="matery.article_url" value="article_url">URL Artikel</option>
                        </select>
                    </div>

                    

                    <div class="input-group form-group" v-show="kind !== 'article'">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> @lang('Pilih File')
                            </a>
                        </span>
                        <input id="thumbnail" v-model="matery_url" class="form-control" type="text" :name="kind !== 'article' ? kind : 'url'" autocomplete="off" placeholder="Masukkan URL video, audio, atau artikel">
                    </div>

                    <div class="form-group">
                        <label>Tulis Artikel</label>
                        <textarea id="ckeditor2" name="article" placeholder="Enter text ...">
                        </textarea>
                    </div>

                </div>
                
                <div class="modal-footer">
                    <div class="pull-left">
                        <a v-if="editMode" class="btn btn-link text-danger" @click.prevent="deleteMatery()">Hapus Materi</a>

                    </div>    
                    <div class="pull-right">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-primary">@lang('Simpan')</button>

                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- /basic modal -->

    <div class="col-md-8">
        @if ($errors->count())
        <div class="alert alert-danger no-border">
            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
            <span class="text-semibold">Terjadi kesalahan!</span> mohon masukkan data yang valid. <a href="#" data-toggle="modal" data-target="#modal_default" class="alert-link">Ulangi pengisian</a>.
        </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-heading no-border-bottom">
                <h4 class="panel-title">{{ $course->classroom->name." - ".$course->title }}</h4>
            </div>
<!-- 
            <div class="panel-body">
                <input type="text" class="form-control" placeholder="Pencarian...">
            </div> -->

            <div class="table-responsive">
                <table class="table text-nowrap">
                    <tbody>
                        <tr v-if="materies.length === 0">
                            <td colspan="4" class="text-center"><i>Tidak ada materi</i></td>
                        </tr>
                        <tr v-for="(matery, $index) in materies">
                            <td>
                                <div class="media-left media-middle">
                                    <a @click.prevent="editMatery($index)" href="#" class="btn bg-primary-400 btn-rounded btn-icon btn-xs legitRipple">
                                        <span class="letter-icon">@{{ $index+1 }}</span>
                                    </a>
                                </div>

                                <div class="media-body">
                                    <div class="media-heading">
                                        <a @click.prevent="editMatery($index)" href="#" class="h6 text-semibold letter-icon-title">@{{ matery.title }}</a>
                                    </div>

                                    <div class="text-success text-size-small">
                                        <span v-if="matery.video_url"><i class="icon-play text-size-mini position-left"></i> Video</span>
                                        <span v-if="matery.audio_url"><i class="icon-volume-high text-size-mini position-left"></i> Audio</span>
                                        <span v-if="matery.article_url"><i class="icon-magazine text-size-mini position-left"></i> Article</span>
                                        <span v-if="matery.article"><i class="icon-magazine text-size-mini position-left"></i> Article</span>
                                        <span><i class="icon-magazine text-size-mini position-left ml-15"></i> @{{ matery.quizzes_count }} Bank Soal</span>
                                    </div>

                                </div>
                            </td>
                            <td>
                                <h6 class="text-semibold no-margin">@{{ matery.duration }} Menit</h6>
                            </td>

                            <td>
                                <a href="#" class="h6 text-semibold no-margin" data-toggle="modal" data-target="#modal_quiz" @click="question = matery"><i class="icon-plus3 position-left"></i> Buat Soal</a>
                            </td>


                        </tr>


                    </tbody>
                </table>
            </div>
            <div class="panel-footer text-center p-15">
                <button class="btn btn-link" @click="addNew()">
                    <i class="icon-plus3 position-left"></i>
                    Tambah Baru</button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <form method="POST" action="/admin/course/{{ $course->id }}">
            @csrf
            @method('PUT')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">@lang('Pengaturan Mata Pelajaran')</h4>
                    <div class="heading-elements">
                        <div class="checkbox checkbox-switchery">
                            <label>
                                <input type="checkbox" name="published" class="switchery" {!! $course->published ? 'checked' : '' !!}>
                                PUBLIKASI
                            </label>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="form-group form-group-xlg">
                        <label>@lang('Kelas') :</label>
                        <select class="form-control select2" name="classroom_id">
                            @foreach (App\Classroom::all() as $classroom)
                            <option {!! $course->classroom_id == $classroom->id || old('classroom_id') == $classroom->id ? 'selected' : '' !!} value="{{ $classroom->id }}">{{ "$classroom->code - ".$classroom->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group form-group-xlg">
                        <label>@lang('Judul Pelajaran') :</label>
                        <input type="text" class="form-control" placeholder="Judul pelajaran" name="title" value="{{ $course->title }}">
                    </div>


                    <div class="form-group">
                        <label>@lang('Kode Kode Mata Pelajaran') :</label>
                        <input type="text" class="form-control" placeholder="Kode mata pelajaran" name="code" value="{{ $course->code }}">
                    </div>

                    <div class="form-group">
                        <label for="">Pemateri</label>
                        <select class="form-control select2" name="teacher_id">
                            @foreach (App\Teacher::all() as $teacher)
                            <option {!! $course->teacher_id === $teacher->id ? 'selected' : '' !!} value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label>@lang('Deskripsi') :</label>
                        <textarea id="ckeditor" name="description" placeholder="Enter text ...">
                        {!! $course->description !!}
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
<script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
@endpush

@push('script')
<script>
    $(function() {
        CKEDITOR.replace('ckeditor', {
            height: '400px',
            filebrowserImageBrowseUrl: '/admin/filemanager?type=Images',
            filebrowserImageUploadUrl: '/admin/filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/admin/filemanager?type=Files',
            filebrowserUploadUrl: '/admin/filemanager/upload?type=Files&_token='
        });
        CKEDITOR.replace('ckeditor3', {
            height: '200px',
            filebrowserImageBrowseUrl: '/admin/filemanager?type=Images',
            filebrowserImageUploadUrl: '/admin/filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/admin/filemanager?type=Files',
            filebrowserUploadUrl: '/admin/filemanager/upload?type=Files&_token=',
            toolbarGroups: [
                {
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
        $('#lfm').filemanager('image', {prefix: '/admin/filemanager'});
    });

    var controller = new Vue({
        el: "#controller",
        data: {
            kind: "video_url",
            matery: {},
            options: [
                {"question": ""}
            ],
            question: {},
            matery_url: "",
            editMode: false,
            editor: {},
            materies: []
        },
        mounted: function () {
            const _this = this;
            Vue.nextTick(function () {
                _this.editor = CKEDITOR.replace('ckeditor2', {
                    height: '400px',
                    filebrowserImageBrowseUrl: '/admin/filemanager?type=Images',
                    filebrowserImageUploadUrl: '/admin/filemanager/upload?type=Images&_token=',
                    filebrowserBrowseUrl: '/admin/filemanager?type=Files',
                    filebrowserUploadUrl: '/admin/filemanager/upload?type=Files&_token='
                });
            });
            this.getMateries();
        },
        methods: {
            getMateries: function() {
                axios.get('/admin/matery?course_id='+{{ $course->id }})
                .then(response => {
                    this.materies = response.data;
                })
            },
            editMatery: function(index) {
                $('#modal_default').modal('show');

                this.editMode = true;
                this.matery = this.materies[index];
                this.matery_url = "";

                if (this.matery.video_url) {
                    this.matery_url = this.matery.video_url;
                    this.kind = 'video_url';
                } else if (this.matery.audio_url) {
                    this.matery_url = this.matery.audio_url;
                    this.kind = 'audio_url';
                } else if (this.matery.article_url) {
                    this.matery_url = this.matery.article_url;
                    this.kind = 'article_url';
                } 
                    
                this.editor.setData(this.matery.article);
            },
            changeKind(event) {
                this.kind = event.target.value;
            },
            closeModal: function() {
                $('#modal_default').modal('hide');
            },
            addNew: function() {
                this.editMode = false;
                this.matery = {};
                this.matery_url = "";
                $('#modal_default').modal('show');
                this.editor.setData('');
            },
            deleteMatery: function() {
                const _this = this;
                swal({
                        title: "Hapus Materi",
                        text: "Tekan OK jika yakin",
                        type: "info",
                        animation: false,
                        showCancelButton: true,
                        closeOnConfirm: false,
                        confirmButtonColor: "#2196F3",
                        showLoaderOnConfirm: true
                    },
                    function() {
                        axios.delete('/admin/matery/' + _this.matery.id)
                            .then(response => {
                                swal({
                                    title: "Berhasil menghapus",
                                    confirmButtonColor: "#2196F3"
                                });

                                var filter = _this.materies.findIndex(item => item.id === _this.matery.id);

                                _this.materies.splice(filter, 1);
                                $('#modal_default').modal('hide');
                            })

                    });
            }
        }
    });
</script>
@endpush