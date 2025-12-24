@extends('layouts.app')

@section('content')
<div class="row">
    @include('layouts.left-menu')

    <main class="col-lg-10 col-md-9 ms-sm-auto px-4 pt-3">
                    <h1 class="display-6 mb-3"><i class="bi bi-diagram-2"></i> Edit Kelas</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{url()->previous()}}">Kelas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Kelas</li>
                        </ol>
                    </nav>
                    @include('session-messages')
                    <div class="row">
                        <form class="col-6" action="{{route('school.class.update')}}" method="POST">
                            @csrf
                            <input type="hidden" name="session_id" value="{{$current_school_session_id}}">
                            <input type="hidden" name="class_id" value="{{$class_id}}">
                            <div class="mb-3">
                                <label for="class_name" class="form-label">Nama Kelas</label>
                                <input class="form-control" id="class_name" name="class_name" type="text" value="{{$schoolClass->class_name}}">
                            </div>
                            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-check2"></i> Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection