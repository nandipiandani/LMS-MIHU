@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-person-lines-fill"></i> Daftar Dosen
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Daftar Dosen</li>
                        </ol>
                    </nav>
                    <div class="bg-white border shadow-sm p-3 mt-4" style="border-radius: 8px;">
                            <div class="table-container" style="overflow-x: auto;">
                            <table class="table mb-0" style="min-width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Nama Depan</th>
                                    <th scope="col">Nama Belakang</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Telpon</th>
                                    <th scope="col">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teachers as $teacher)
                                <tr>
                                    <td>
                                        @if (isset($teacher->photo))
                                            <img src="{{asset('/storage'.$teacher->photo)}}" class="rounded" alt="Profile picture" height="30" width="30">
                                        @else
                                            <i class="bi bi-person-square"></i>
                                        @endif
                                    </td>
                                    <td>{{$teacher->first_name}}</td>
                                    <td>{{$teacher->last_name}}</td>
                                    <td>{{$teacher->email}}</td>
                                    <td>{{$teacher->phone}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{url('teachers/view/profile/'.$teacher->id)}}" role="button" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i> Profil</a>
                                            @can('edit users')
                                            <a href="{{route('teacher.edit.show', ['id' => $teacher->id])}}" role="button" class="btn btn-sm btn-outline-primary"><i class="bi bi-pen"></i> Edit</a>
                                            @endcan                                            
                                            <form action="{{route('teacher.delete', ['id' => $teacher->id])}}" method="POST" style="display: inline;">
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
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
