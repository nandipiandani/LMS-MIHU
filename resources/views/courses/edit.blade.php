@extends('layouts.app')

@section('content')
<div class="row">
    @include('layouts.left-menu')

    <main class="col-lg-10 col-md-9 ms-sm-auto px-4 pt-3">
                    <h1 class="display-6 mb-3"><i class="bi bi-journal-medical"></i> Edit Mata Kuliah</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{url()->previous()}}">Mata Kuliah</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Mata Kuliah</li>
                        </ol>
                    </nav>
                    @include('session-messages')
                    <div class="row">
                        <form class="col-6" action="{{route('school.course.update')}}" method="POST">
                            @csrf
                            <input type="hidden" name="session_id" value="{{$current_school_session_id}}">
                            <input type="hidden" name="course_id" value="{{$course_id}}">
                            <div class="mb-3">
                                <label for="course_name" class="form-label">Course Name</label>
                                <input class="form-control" id="course_name" name="course_name" type="text" value="{{$course->course_name}}">
                            </div>
                            <div class="mb-3">
                                <label for="course_type" class="form-label">Course Type</label>
                                <select class="form-select" id="course_type" name="course_type" aria-label="Course type">
                                    <option value="Core" {{($course->course_type == 'Core')? 'selected' : ''}}>Core</option>
                                    <option value="General" {{($course->course_type == 'General')? 'selected' : ''}}>General</option>
                                    <option value="Elective" {{($course->course_type == 'Elective')? 'selected' : ''}}>Elective</option>
                                    <option value="Optional" {{($course->course_type == 'Optional')? 'selected' : ''}}>Optional</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-check2"></i> Save</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection