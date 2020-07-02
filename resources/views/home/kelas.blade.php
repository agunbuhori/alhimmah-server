@extends('layouts.app')

@section('content')
<div class="kelas">
    <div class="container">
    <div class="row">
            <div class="col-xl-12">
                <div class="section_title text-center">
                    <h3>Pilihan Kelas</h3>
                    <p>Dalam satu bulan, peserta hanya boleh mengikuti maksimal satu kelas.<br/> Silahkan pilih kelas yang cocok untuk belajar di bulan ini.</p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($classes as $class)
            <div class="col-lg-4 col-xs-12">
                <div class="class">
                    <div class="class__img">
                        <img src="/home/img/nahwu.png"/>
                    </div>
                    <div class="class__detail">
                        <h3>{{$class->name}}</h3>
                        <p>
                            Mata pelajaran :
                            @foreach ($class->courses as $course)
                            {{$course->title}},&nbsp;
                            @endforeach
                        </p>
                    </div>
                    <div class="class__footer">
                    <a class="boxed_btn_orange" href="/kelas/{{ $class->code }}">
                                    <span>Lihat Kelas</span>
                                </a>
                    </div>
                </div>
            </div>
            @endforeach
            

        </div>
    </div>
</div>
@endsection