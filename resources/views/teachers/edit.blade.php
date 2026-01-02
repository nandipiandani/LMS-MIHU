@extends('layouts.app')

@section('content')
<div class="row">
    @include('layouts.left-menu')

    <main class="col-lg-10 col-md-9 ms-sm-auto px-4 pt-3">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-person-lines-fill"></i> Edit Dosen
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{url()->previous()}}">Daftar Dosen</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Dosen</li>
                        </ol>
                    </nav>

                    @include('session-messages')

                    <div class="mb-4">
                        <form class="row g-3" action="{{route('school.teacher.update')}}" method="POST">
                            @csrf
                            <input type="hidden" name="teacher_id" value="{{$teacher->id}}">
                            <div class="col-3">
                                <label for="inputFirstName" class="form-label">Nama Depan<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="text" class="form-control" id="inputFirstName" name="first_name" placeholder="First Name" required value="{{$teacher->first_name}}">
                            </div>
                            <div class="col-3">
                                <label for="inputLastName" class="form-label">Nama Belakang<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="text" class="form-control" id="inputLastName" name="last_name" placeholder="Last Name" required value="{{$teacher->last_name}}">
                            </div>
                            <div class="col-3">
                                <label for="inputEmail" class="form-label">Email<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="email" class="form-control" id="inputEmail" name="email" required value="{{$teacher->email}}">
                            </div>
                            <div class="col-4">
                                <label for="inputAddress" class="form-label">Alamat<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="text" class="form-control" id="inputAddress" name="address" placeholder="634 Main St" required value="{{$teacher->address}}">
                            </div>
                            <div class="col-3">
                                <label for="inputAddress2" class="form-label">Alamat 2</label>
                                <input type="text" class="form-control" id="inputAddress2" name="address2" placeholder="Apartment, studio, or floor" value="{{$teacher->address2}}">
                            </div>
                            <div class="col-2">
                                <label for="inputCity" class="form-label">Kota<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="text" class="form-control" id="inputCity" name="city" placeholder="Dhaka..." required value="{{$teacher->city}}">
                            </div>
                            <div class="col-2">
                                <label for="inputZip" class="form-label">Kode Pos<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="text" class="form-control" id="inputZip" name="zip" required value="{{$teacher->zip}}">
                            </div>
                            <div class="col-3">
                                <label for="inputPhone" class="form-label">Telpon<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="text" class="form-control" id="inputPhone" name="phone" placeholder="+880 01......" required value="{{$teacher->phone}}">
                            </div>
                            <div class="col-2">
                                <label for="inputState" class="form-label">Jenis Kelamin<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <select id="inputState" class="form-select" name="gender" required>
                                    <option value="Laki-laki" {{($teacher->gender == 'Laki-laki')?'selected':null}}>Laki-laki</option>
                                    <option value="Perempuan" {{($teacher->gender == 'Perempuan')?'selected':null}}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="inputNationality" class="form-label">Kewarganegaraan<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="text" class="form-control" id="inputNationality" name="nationality" placeholder="e.g. Bangladeshi, German, ..." required value="{{$teacher->nationality}}">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-person-check"></i> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>

@include('components.photos.photo-input')
@endsection
