@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-person-lines-fill"></i> Daftar Mahasiswa
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Daftar Mahasiswa</li>
                        </ol>
                    </nav>
                    @include('session-messages')
                    <h6>Filter daftar berdasarkan:</h6>
                    <div class="mb-4 mt-4">
                        <form class="row" action="{{route('student.list.show')}}" method="GET">
                            <div class="col">
                                <select onchange="getSections(this);" class="form-select" aria-label="Class" name="class_id" required>
                                    @isset($school_classes)
                                        <option selected disabled>Silakan pilih kelas</option>
                                        @foreach ($school_classes as $school_class)
                                            <option value="{{$school_class->id}}" {{($school_class->id == request()->query('class_id'))?'selected="selected"':''}}>{{$school_class->class_name}}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-select" id="section-select" aria-label="Section" name="section_id" required>
                                    <option value="{{request()->query('section_id')}}">{{request()->query('section_name')}}</option>
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-arrow-counterclockwise"></i> Daftar Muat</button>
                            </div>
                        </form>
                        @foreach ($studentList as $student)
                            @if ($loop->first)
                                <p class="mt-3"><b>Bagian:</b> {{$student->section->section_name}}</p>
                                @break
                            @endif
                        @endforeach
                        <div class="bg-white border shadow-sm p-3 mt-4" style="border-radius: 8px;">
                            <div class="table-container" style="overflow-x: auto;">
                            <table class="table mb-0" style="min-width: 100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">Nomor Kartu Identitas</th>
                                        <th scope="col">Photo</th>
                                        <th scope="col">Nama Depan</th>
                                        <th scope="col">Nama Belakang</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Telpon</th>
                                        <th scope="col">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($studentList as $student)
                                    <tr>
                                        <th scope="row">{{$student->id_card_number}}</th>
                                        <td>
                                            @if (isset($student->student->photo))
                                                <img src="{{asset('/storage'.$student->student->photo)}}" class="rounded" alt="Profile picture" height="30" width="30">
                                            @else
                                                <i class="bi bi-person-square"></i>
                                            @endif
                                        </td>
                                        <td>{{$student->student->first_name}}</td>
                                        <td>{{$student->student->last_name}}</td>
                                        <td>{{$student->student->email}}</td>
                                        <td>{{$student->student->phone}}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{route('student.attendance.show', ['id' => $student->student->id])}}" role="button" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i> Kehadiran</a>
                                                <a href="{{url('students/view/profile/'.$student->student->id)}}" role="button" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i> Profil</a>
                                                @can('edit users')
                                                <a href="{{route('student.edit.show', ['id' => $student->student->id])}}" role="button" class="btn btn-sm btn-outline-primary"><i class="bi bi-pen"></i> Edit</a>
                                                @endcan
                                                <form action="{{route('student.delete', ['id' => $student->student->id])}}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="bi bi-trash2"></i> Hapus</button>
                                            </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
<script>
    function getSections(obj) {
        var class_id = obj.options[obj.selectedIndex].value;

        var url = "{{route('get.sections.courses.by.classId')}}?class_id=" + class_id 

        fetch(url)
        .then((resp) => resp.json())
        .then(function(data) {
            var sectionSelect = document.getElementById('section-select');
            sectionSelect.options.length = 0;
            data.sections.unshift({'id': 0,'section_name': 'Silakan pilih satu bagian'})
            data.sections.forEach(function(section, key) {
                sectionSelect[key] = new Option(section.section_name, section.id);
            });
        })
        .catch(function(error) {
            console.log(error);
        });
    }
</script>
@endsection
