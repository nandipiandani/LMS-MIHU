@extends('layouts.app')

@section('content')
<div class="container-fluid px-3 py-4">
    <div class="row">
        <!-- Left Menu (keep as is) -->
        @include('layouts.left-menu')
        
        <!-- Main Content Area -->
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <!-- Welcome Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 20px; background: linear-gradient(135deg, #ffd900 0%, #ffd900 100%);">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-9">
                                    <h1 class="display-5 fw-bold text-dark mb-2">Welcome to LMS MIHU</h1>
                                    <p class="lead text-dark mb-0">
                                        <i class="bi bi-emoji-heart-eyes me-2"></i> 
                                        Learning Everywhere, Every Time
                                    </p>
                                </div>
                                <div class="col-md-3 text-end">
                                    <div class="bg-white bg-opacity-25 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                        <i class="bi bi-mortarboard-fill text-dark fs-1"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           <!-- Stats Cards - Modern Design -->
<div class="row g-4 mb-4">
    <!-- Total Mahasiswa -->
    <div class="col-xl-4 col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: linear-gradient(135deg, #4361ee 0%, #3a56e4 100%);">
            <div class="card-body p-4 text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-white-100 mb-2">Total Mahasiswa</p>
                        <h2 class="fw-bold display-6 mb-0">{{ $studentCount }}</h2>
                        <small class="text-white-75">
                            <i class="bi bi-people-fill me-1"></i> Terdaftar
                        </small>
                    </div>
                    <div class="bg-white bg-opacity-10 p-3 rounded-circle d-flex align-items-center justify-content-center">
                        <img src="{{ asset('favicon_io/mahasiswa.png') }}" 
                             alt="Logo {{ config('app.name') }}"
                             style="width: 50px; height: 50px; object-fit: contain;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Total Mahasiswa -->
    
    <!-- Total Dosen -->
    <div class="col-xl-4 col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: linear-gradient(135deg, #10b981 0%, #0da271 100%);">
            <div class="card-body p-4 text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-white-100 mb-2">Total Dosen</p>
                        <h2 class="fw-bold display-6 mb-0">{{ $teacherCount }}</h2>
                        <small class="text-white-75">
                            <i class="bi bi-person-badge me-1"></i> Aktif
                        </small>
                    </div>
                    <div class="bg-white bg-opacity-10 p-3 rounded-circle d-flex align-items-center justify-content-center">
                        <img src="{{ asset('favicon_io/dosen.png') }}" 
                             alt="Logo {{ config('app.name') }}"
                             style="width: 50px; height: 50px; object-fit: contain;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Total Dosen -->
    
    <!-- Total Kelas -->
    <div class="col-xl-4 col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
            <div class="card-body p-4 text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-white-100 mb-2">Total Kelas</p>
                        <h2 class="fw-bold display-6 mb-0">{{ $classCount }}</h2>
                        <small class="text-white-75">
                            <i class="bi bi-diagram-3 me-1"></i> Tersedia
                        </small>
                    </div>
                    <div class="bg-white bg-opacity-10 p-3 rounded-circle d-flex align-items-center justify-content-center">
                        <img src="{{ asset('favicon_io/kelas.png') }}" 
                             alt="Logo {{ config('app.name') }}"
                             style="width: 50px; height: 50px; object-fit: contain;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Total Kelas -->
</div>
<!-- End Stats Cards -->
 

            <!-- Gender Distribution Chart -->
            @if($studentCount > 0)
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">
                                <i class="bi bi-gender-ambiguous text-primary me-2"></i>
                                Distribusi Jenis Kelamin Mahasiswa
                            </h5>
                            
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <div class="d-flex flex-column">
                                        <span class="mb-3">
                                            <span class="badge rounded-pill d-inline-flex align-items-center px-3 py-2 mb-2" style="background-color: #0678c8;">
                                                <i class="bi bi-gender-male me-2"></i> Laki-laki
                                            </span>
                                            <span class="fw-bold ms-2">{{ $maleStudentsBySession }}</span>
                                        </span>
                                        <span>
                                            <span class="badge rounded-pill d-inline-flex align-items-center px-3 py-2 mb-2" style="background-color: #49a4fe;">
                                                <i class="bi bi-gender-female me-2"></i> Perempuan
                                            </span>
                                            <span class="fw-bold ms-2">{{ $studentCount - $maleStudentsBySession }}</span>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="col-md-9">
                                    @php
                                        $malePercentage = round(($maleStudentsBySession/$studentCount), 2) * 100;
                                        $femalePercentage = round((($studentCount - $maleStudentsBySession)/$studentCount), 2) * 100;
                                    @endphp
                                    
                                    <div class="progress" style="height: 40px; border-radius: 20px; overflow: hidden;">
                                        <div class="progress-bar fw-bold d-flex align-items-center justify-content-center" 
                                             role="progressbar" 
                                             style="background-color: #0678c8; width: {{ $malePercentage }}%"
                                             aria-valuenow="{{ $malePercentage }}" 
                                             aria-valuemin="0" 
                                             aria-valuemax="100">
                                            {{ $malePercentage }}%
                                        </div>
                                        <div class="progress-bar fw-bold d-flex align-items-center justify-content-center" 
                                             role="progressbar" 
                                             style="background-color: #49a4fe; width: {{ $femalePercentage }}%"
                                             aria-valuenow="{{ $femalePercentage }}" 
                                             aria-valuemin="0" 
                                             aria-valuemax="100">
                                            {{ $femalePercentage }}%
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between mt-2">
                                        <small class="text-muted">Mahasiswa Laki-laki</small>
                                        <small class="text-muted">Mahasiswa Perempuan</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Events & Notifications Section -->
            <div class="row g-4">
                <!-- Events Calendar -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100 no-hover-card" style="border-radius: 20px;">
                        <div class="card-header bg-white border-0 py-3" style="border-radius: 20px 20px 0 0;">
                            <h5 class="fw-bold mb-0">
                                <i class="bi bi-calendar-event text-primary me-2"></i>
                                Acara
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="bg-light p-3 rounded" style="min-height: 300px;">
                                @include('components.events.event-calendar', ['editable' => 'false', 'selectable' => 'false'])
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('events.index') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-calendar3 me-1"></i> Lihat semua acara
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notifications -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 20px;">
                        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center" 
                             style="border-radius: 20px 20px 0 0;">
                            <h5 class="fw-bold mb-0">
                                <i class="bi bi-megaphone text-primary me-2"></i>
                                Pemberitahuan
                            </h5>
                            <div>{{ $notices->links() }}</div>
                        </div>
                        <div class="card-body p-0">
                            @isset($notices)
                            <div class="accordion accordion-modern" id="noticeAccordion">
                                @foreach ($notices as $notice)
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed py-3" 
                                                type="button" 
                                                data-bs-toggle="collapse" 
                                                data-bs-target="#flush-collapse{{$notice->id}}" 
                                                aria-expanded="{{ ($loop->first) ? 'true' : 'false' }}" 
                                                aria-controls="flush-collapse{{$notice->id}}"
                                                style="border-radius: 0;">
                                            <div class="d-flex w-100 align-items-center">
                                                <div class="sidebar-icon">
                                                    <i class="bi bi-megaphone text-primary"></i>
                                                </div>
                                                <div class="flex-grow-1 text-start">
                                                    <span class="fw-medium">{{ \Illuminate\Support\Str::limit(strip_tags($notice->notice), 50) }}</span>
                                                    <br>
                                                    <small class="text-muted">
                                                        <i class="bi bi-clock me-1"></i>
                                                        {{ $notice->created_at->diffForHumans() }}
                                                    </small>
                                                </div>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="flush-collapse{{$notice->id}}" 
                                         class="accordion-collapse collapse {{ ($loop->first) ? 'show' : '' }}" 
                                         aria-labelledby="flush-heading{{$notice->id}}" 
                                         data-bs-parent="#noticeAccordion">
                                        <div class="accordion-body p-3" style="background: #f8f9fa; border-radius: 0 0 10px 10px;">
                                            <div class="p-3 bg-white rounded">
                                                {!! Purify::clean($notice->notice) !!}
                                                <div class="mt-3 pt-2 border-top">
                                                    <small class="text-muted">
                                                        <i class="bi bi-calendar me-1"></i>
                                                        Published: {{ $notice->created_at->format('M d, Y h:i A') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endisset
                            
                            @if(count($notices) < 1)
                            <div class="text-center py-5">
                                <div class="mb-3">
                                    <i class="bi bi-bell-slash text-muted fs-1"></i>
                                </div>
                                <h6 class="text-muted mb-2">Tidak ada pemberitahuan</h6>
                                <p class="text-muted small">Periksa lagi nanti untuk pembaruan</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>

<style>
    /* Custom Modern Styling */
    .no-hover-card:hover {
    transform: none !important;
    box-shadow: inherit !important;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
    
    .progress {
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .progress-bar {
        transition: width 1.5s ease-in-out;
    }
    
    .accordion-modern .accordion-button:not(.collapsed) {
        background-color: #f8f9fa;
        color: #4361ee;
        box-shadow: none;
    }
    
    .accordion-modern .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0, 0, 0, 0.125);
    }
    
    .accordion-modern .accordion-item {
        margin-bottom: 10px;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .badge {
        transition: all 0.3s ease;
    }
    
    .badge:hover {
        transform: scale(1.05);
    }
    
    .display-6 {
        font-weight: 800;
    }
    
    /* Custom scrollbar for notices */
    .accordion-body::-webkit-scrollbar {
        width: 6px;
    }
    
    .accordion-body::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .accordion-body::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate progress bars on page load
        const progressBars = document.querySelectorAll('.progress-bar');
        progressBars.forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0';
            setTimeout(() => {
                bar.style.width = width;
            }, 300);
        });
        
        // Add click animation to stats cards
        const statCards = document.querySelectorAll('.card');
        statCards.forEach(card => {
            card.addEventListener('click', function() {
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 200);
            });
        });
    });
</script>
@endsection