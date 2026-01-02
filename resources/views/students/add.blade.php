@extends('layouts.app')

@section('content')
<div class="row">
    @include('layouts.left-menu')

    <main class="col-lg-10 col-md-9 ms-sm-auto px-4 pt-3">
        <h1 class="display-6 mb-3">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-person-lines-fill"></i> Tambah Mahasiswa
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Mahasiswa</li>
                        </ol>
                    </nav>

                    @include('session-messages')

                    <p class="text-primary">
                        <small><i class="bi bi-exclamation-diamond-fill me-2"></i> Ingat untuk membuat "Kelas" dan "Bagian" yang terkait sebelum menambahkan siswa.</small>
                    </p>
                    <div class="mb-4">
                        <form class="row g-3" action="{{route('school.student.create')}}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label for="inputFirstName" class="form-label">Nama Depan<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputFirstName" name="first_name" placeholder="Nama Depan" required value="{{old('first_name')}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputLastName" class="form-label">Nama Belakang<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputLastName" name="last_name" placeholder="Nama Belakang" required value="{{old('last_name')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Email<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="email" class="form-control" id="inputEmail4" name="email" required value="{{old('email')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Password<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="password" class="form-control" id="inputPassword4" name="password" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="formFile" class="form-label">Photo</label>
                                    <input class="form-control" type="file" id="formFile" onchange="previewFile()">
                                    <div id="previewPhoto"></div>
                                    <input type="hidden" id="photoHiddenInput" name="photo" value="">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputBirthday" class="form-label">Tanggal Lahir<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="date" class="form-control" id="inputBirthday" name="birthday" placeholder="Birthday" required value="{{old('birthday')}}">
                                </div>
                                <div class="col-3-md">
                                    <label for="inputAddress" class="form-label">Alamat<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Contoh: Jl. Raya Cianjur, Gg., Nomor Rumah, RT/RW., Kel./Desa, Kecamatan" required value="{{old('address')}}">
                                </div>
                                <div class="col-3-md">
                                    <label for="inputAddress2" class="form-label">Alamat 2</label>
                                    <input type="text" class="form-control" id="inputAddress2" name="address2" placeholder="Contoh: Apartment, Perumahan, atau Lainnya" value="{{old('address2')}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputCity" class="form-label">Kab./Kota<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputCity" name="city" placeholder="Contoh: Cianjur, Bandung" required value="{{old('city')}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputZip" class="form-label">Kode Pos<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputZip" name="zip" required value="{{old('zip')}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputState" class="form-label">Jenis Kelamin<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <select id="inputState" class="form-select" name="gender" required>
                                        <option value="Laki-laki" {{old('gender') == 'male' ? 'selected' : ''}}>Laki-laki</option>
                                        <option value="Perempuan" {{old('gender') == 'female' ? 'selected' : ''}}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputNationality" class="form-label">Kewarganegaraan<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputNationality" name="nationality" placeholder="Contoh: Indonesia" required value="{{old('nationality')}}">
                                </div>
                                <div class="col-md-4">
                                    <label for="inputBloodType" class="form-label">Golongan Darah<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <select id="inputBloodType" class="form-select" name="blood_type" required>
                                        <option {{old('blood_type') == 'A+' ? 'selected' : ''}}>A+</option>
                                        <option {{old('blood_type') == 'A-' ? 'selected' : ''}}>A-</option>
                                        <option {{old('blood_type') == 'B+' ? 'selected' : ''}}>B+</option>
                                        <option {{old('blood_type') == 'B-' ? 'selected' : ''}}>B-</option>
                                        <option {{old('blood_type') == 'O+' ? 'selected' : ''}}>O+</option>
                                        <option {{old('blood_type') == 'O-' ? 'selected' : ''}}>O-</option>
                                        <option {{old('blood_type') == 'AB+' ? 'selected' : ''}}>AB+</option>
                                        <option {{old('blood_type') == 'AB-' ? 'selected' : ''}}>AB-</option>
                                        <option {{old('blood_type') == 'other' ? 'selected' : ''}}>Lainnya</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputReligion" class="form-label">Agama<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <select id="inputReligion" class="form-select" name="religion" required>
                                        <option {{old('religion') == 'Islam' ? 'selected' : ''}}>Islam</option>
                                        <option {{old('religion') == 'Hinduism' ? 'selected' : ''}}>Hinduism</option>
                                        <option {{old('religion') == 'Christianity' ? 'selected' : ''}}>Christianity</option>
                                        <option {{old('religion') == 'Buddhism' ? 'selected' : ''}}>Buddhism</option>
                                        <option {{old('religion') == 'Judaism' ? 'selected' : ''}}>Judaism</option>
                                        <option {{old('religion') == 'Others' ? 'selected' : ''}}>Lainnya</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputPhone" class="form-label">Nomor Telpon<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputPhone" name="phone" placeholder="+62 21......" required value="{{old('phone')}}">
                                </div>
                                <div class="col-5-md">
                                    <label for="inputIdCardNumber" class="form-label">Nomor Id Card<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputIdCardNumber" name="id_card_number" placeholder="Contoh: 2025-03-01-02-01 (Tahun-Semester-Kelas-Bagian-Absen)" required value="{{old('id_card_number')}}">
                                </div>
                            </div>
                            <div class="row mt-4 g-3">
                                <h6>Informasi Orang Tua</h6>
                                <div class="col-md-3">
                                    <label for="inputFatherName" class="form-label">Nama Ayah<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputFatherName" name="father_name" placeholder="Nama Ayah" required value="{{old('father_name')}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputFatherPhone" class="form-label">Telpon Ayah<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputFatherPhone" name="father_phone" placeholder="+62 21......" required value="{{old('father_phone')}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputMotherName" class="form-label">Nama Ibu<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputMotherName" name="mother_name" placeholder="Nama Ibu" required value="{{old('mother_name')}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputMotherPhone" class="form-label">Telpon Ibu<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputMotherPhone" name="mother_phone" placeholder="+62 21......" required value="{{old('mother_phone')}}">
                                </div>
                                <div class="col-4-md">
                                    <label for="inputParentAddress" class="form-label">Alamat<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputParentAddress" name="parent_address" placeholder="Contoh: Jl. Raya Cianjur No. 123" required value="{{old('parent_address')}}">
                                </div>
                            </div>
                            <div class="row mt-4 g-3">
                                <h6>Informasi Akademik</h6>
                                <div class="col-md-6">
                                    <label for="inputAssignToClass" class="form-label">Tugaskan ke kelas:<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <select onchange="getSections(this);" class="form-select" id="inputAssignToClass" name="class_id" required>
                                        @isset($school_classes)
                                            <option selected disabled>Silakan pilih kelas</option>
                                            @foreach ($school_classes as $school_class)
                                                <option value="{{$school_class->id}}" >{{$school_class->class_name}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputAssignToSection" class="form-label">Tugaskan ke bagian:<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                    <select class="form-select" id="inputAssignToSection" name="section_id" required>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="inputBoardRegistrationNumber" class="form-label">Nomor pendaftaran LMS.</label>
                                    <input type="text" class="form-control" id="inputBoardRegistrationNumber" name="board_reg_no" placeholder="Nomor Registrasi" value="{{old('board_reg_no')}}">
                                </div>
                                <input type="hidden" name="session_id" value="{{$current_school_session_id}}">
                            </div>
                            <div class="row mt-4">
                                <div class="col-12-md">
                                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-person-plus"></i> Tambah</button>
                                </div>
                            </div>
                        </form>
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
            var sectionSelect = document.getElementById('inputAssignToSection');
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
@include('components.photos.photo-input')
@endsection
