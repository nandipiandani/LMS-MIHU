<div class="col-xs-1 col-sm-1 col-md-1 col-lg-2 col-xl-2 col-xxl-2 px-0">
    <div class="sidebar-modern">
        <!-- Sidebar Header -->
        <div class="sidebar-header p-3 text-center">
            <div class="logo-wrapper mb-3">
                <div class="bg-white bg-opacity-10 p-3 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                    <img src="{{ asset('favicon_io/favicon-mihu-unsur-32x32.png') }}" 
                         alt="Logo {{ config('app.name') }}"
                         style="width: 80px; height: 80px; object-fit: contain;">
                </div>
            </div>
            <h6 class="fw-bold text-dark mb-0">LMS MIHU</h6>
            <small class="text-muted">Learning Management System</small>
        </div>

        <!-- Sidebar Menu -->
        <div class="sidebar-menu px-3 pt-3">
            <!-- Main Menu Items -->
            <div class="accordion accordion-flush" id="sidebarAccordion">
                <!-- Dashboard -->
                <div class="accordion-item border-0 mb-2">
                    <a class="nav-link sidebar-item {{ request()->is('home')? 'active' : '' }}" href="{{url('home')}}">
                        <div class="d-flex align-items-center">
                            <div class="sidebar-icon">
                                <i class="bi bi-grid fs-5"></i>
                            </div>
                            <span class="sidebar-text ms-3">{{ __('Beranda') }}</span>
                        </div>
                    </a>
                </div>

                <!-- Kelas -->
                @can('view classes')
                <div class="accordion-item border-0 mb-2">
                    @php
                        if (session()->has('browse_session_id')){
                            $classCount = \App\Models\SchoolClass::where('session_id', session('browse_session_id'))->count();
                        } else {
                            $latest_session = \App\Models\SchoolSession::latest()->first();
                            if($latest_session) {
                                $classCount = \App\Models\SchoolClass::where('session_id', $latest_session->id)->count();
                            } else {
                                $classCount = 0;
                            }
                        }
                    @endphp
                    <a class="nav-link sidebar-item {{ request()->is('classes')? 'active' : '' }}" href="{{url('classes')}}">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="sidebar-icon">
                                    <i class="bi bi-diagram-3 fs-5"></i>
                                </div>
                                <span class="sidebar-text ms-3">Kelas</span>
                            </div>
                            <span class="badge bg-primary rounded-pill">{{ $classCount }}</span>
                        </div>
                    </a>
                </div>
                @endcan

                <!-- Mahasiswa (Non-Student) - MENGGUNAKAN ACCORDION -->
                @if(Auth::user()->role != "student")
                <div class="accordion-item border-0 mb-2">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed sidebar-item {{ request()->is('students*')? 'active' : '' }}" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#student-submenu" 
                                aria-expanded="{{ request()->is('students*')? 'true' : 'false' }}" 
                                aria-controls="student-submenu">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="d-flex align-items-center">
                                    <div class="sidebar-icon">
                                        <i class="bi bi-people-fill fs-5"></i>
                                    </div>
                                    <span class="sidebar-text ms-3">Mahasiswa</span>
                                </div>
                                <i class="bi bi-chevron-down sidebar-chevron"></i>
                            </div>
                        </button>
                    </h2>
                    <div id="student-submenu" 
                         class="accordion-collapse collapse {{ request()->is('students*')? 'show' : '' }}" 
                         data-bs-parent="#sidebarAccordion">
                        <div class="accordion-body p-0">
                            <div class="submenu-content">
                                <a class="submenu-item {{ request()->routeIs('student.list.show')? 'active' : '' }}" href="{{route('student.list.show')}}">
                                    <i class="bi bi-eye me-2"></i> Lihat Mahasiswa
                                </a>
                                @if (!session()->has('browse_session_id') && Auth::user()->role == "admin")
                                <a class="submenu-item {{ request()->routeIs('student.create.show')? 'active' : '' }}" href="{{route('student.create.show')}}">
                                    <i class="bi bi-person-plus me-2"></i> Tambah Mahasiswa
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dosen - MENGGUNAKAN ACCORDION -->
                <div class="accordion-item border-0 mb-2">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed sidebar-item {{ request()->is('teachers*')? 'active' : '' }}" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#teacher-submenu" 
                                aria-expanded="{{ request()->is('teachers*')? 'true' : 'false' }}" 
                                aria-controls="teacher-submenu">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="d-flex align-items-center">
                                    <div class="sidebar-icon">
                                        <i class="bi bi-person-badge fs-5"></i>
                                    </div>
                                    <span class="sidebar-text ms-3">Dosen</span>
                                </div>
                                <i class="bi bi-chevron-down sidebar-chevron"></i>
                            </div>
                        </button>
                    </h2>
                    <div id="teacher-submenu" 
                         class="accordion-collapse collapse {{ request()->is('teachers*')? 'show' : '' }}" 
                         data-bs-parent="#sidebarAccordion">
                        <div class="accordion-body p-0">
                            <div class="submenu-content">
                                <a class="submenu-item {{ request()->routeIs('teacher.list.show')? 'active' : '' }}" href="{{route('teacher.list.show')}}">
                                    <i class="bi bi-eye me-2"></i> Lihat Dosen
                                </a>
                                @if (!session()->has('browse_session_id') && Auth::user()->role == "admin")
                                <a class="submenu-item {{ request()->routeIs('teacher.create.show')? 'active' : '' }}" href="{{route('teacher.create.show')}}">
                                    <i class="bi bi-person-plus me-2"></i> Tambah Dosen
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Profil Magister Ilmu Hukum -->
<div class="accordion-item border-0 mb-2">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed sidebar-item {{ request()->is('profil-magister-hukum*') ? 'active' : '' }}"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#profil-prodi-submenu"
                aria-expanded="{{ request()->is('profil-magister-hukum*') ? 'true' : 'false' }}"
                aria-controls="profil-prodi-submenu">
            <div class="d-flex align-items-center justify-content-between w-100">
                <div class="d-flex align-items-center">
                    <div class="sidebar-icon">
                        <i class="bi bi-mortarboard-fill fs-5"></i>
                    </div>
                    <span class="sidebar-text ms-3">Profil Magister Ilmu Hukum</span>
                </div>
                <i class="bi bi-chevron-down sidebar-chevron"></i>
            </div>
        </button>
    </h2>

    <div id="profil-prodi-submenu"
         class="accordion-collapse collapse {{ request()->is('profil-magister-hukum*') ? 'show' : '' }}"
         data-bs-parent="#sidebarAccordion">
        <div class="accordion-body p-0">
            <div class="submenu-content">

                <a class="submenu-item {{ request()->routeIs('prodi.pimpinan') ? 'active' : '' }}"
                   href="{{ route('prodi.pimpinan') }}">
                    <i class="bi bi-person-badge me-2"></i> Pimpinan Program Studi
                </a>

                <a class="submenu-item {{ request()->routeIs('prodi.dosen') ? 'active' : '' }}"
                   href="{{ route('prodi.dosen') }}">
                    <i class="bi bi-people-fill me-2"></i> Dosen Magister Ilmu Hukum
                </a>

                <a class="submenu-item {{ request()->routeIs('prodi.tendik') ? 'active' : '' }}"
                   href="{{ route('prodi.tendik') }}">
                    <i class="bi bi-person-gear me-2"></i> Tenaga Kependidikan
                </a>

                <a class="submenu-item {{ request()->routeIs('prodi.kurikulum') ? 'active' : '' }}"
                   href="{{ route('prodi.kurikulum') }}">
                    <i class="bi bi-journal-text me-2"></i> Kurikulum Program Studi
                </a>

                <a class="submenu-item {{ request()->routeIs('prodi.sap') ? 'active' : '' }}"
                   href="{{ route('prodi.sap') }}">
                    <i class="bi bi-file-earmark-text me-2"></i> SAP
                </a>

                <a class="submenu-item {{ request()->routeIs('prodi.biaya') ? 'active' : '' }}"
                   href="{{ route('prodi.biaya') }}">
                    <i class="bi bi-cash-coin me-2"></i> Biaya Mahasiswa Baru
                </a>

                <a class="submenu-item {{ request()->routeIs('prodi.pengumuman') ? 'active' : '' }}"
                   href="{{ route('prodi.pengumuman') }}">
                    <i class="bi bi-megaphone me-2"></i> Pengumuman
                </a>

            </div>
        </div>
    </div>
</div>

                <!-- Mata Kuliah Saya (Teacher) -->
                @if(Auth::user()->role == "teacher")
                <div class="accordion-item border-0 mb-2">
                    <a class="nav-link sidebar-item {{ (request()->is('courses/teacher*') || request()->is('courses/assignments*'))? 'active' : '' }}" 
                       href="{{route('course.teacher.list.show', ['teacher_id' => Auth::user()->id])}}">
                        <div class="d-flex align-items-center">
                            <div class="sidebar-icon">
                                <i class="bi bi-journal-text fs-5"></i>
                            </div>
                            <span class="sidebar-text ms-3">Mata Kuliah Saya</span>
                        </div>
                    </a>
                </div>
                @endif

                <!-- Student Menu -->
                @if(Auth::user()->role == "student")
                <div class="accordion-item border-0 mb-2">
                    <a class="nav-link sidebar-item {{ request()->routeIs('student.attendance.show')? 'active' : '' }}" 
                       href="{{route('student.attendance.show', ['id' => Auth::user()->id])}}">
                        <div class="d-flex align-items-center">
                            <div class="sidebar-icon">
                                <i class="bi bi-calendar-check fs-5"></i>
                            </div>
                            <span class="sidebar-text ms-3">Kehadiran</span>
                        </div>
                    </a>
                </div>

                <div class="accordion-item border-0 mb-2">
                    <a class="nav-link sidebar-item {{ request()->routeIs('course.student.list.show')? 'active' : '' }}" 
                       href="{{route('course.student.list.show', ['student_id' => Auth::user()->id])}}">
                        <div class="d-flex align-items-center">
                            <div class="sidebar-icon">
                                <i class="bi bi-book-half fs-5"></i>
                            </div>
                            <span class="sidebar-text ms-3">Mata Kuliah</span>
                        </div>
                    </a>
                </div>

                <div class="accordion-item border-0 mb-2">
                    @php
                        if (session()->has('browse_session_id')){
                            $class_info = \App\Models\Promotion::where('session_id', session('browse_session_id'))->where('student_id', Auth::user()->id)->first();
                        } else {
                            $latest_session = \App\Models\SchoolSession::latest()->first();
                            if($latest_session) {
                                $class_info = \App\Models\Promotion::where('session_id', $latest_session->id)->where('student_id', Auth::user()->id)->first();
                            } else {
                                $class_info = [];
                            }
                        }
                    @endphp
                    <a class="nav-link sidebar-item" 
                       href="{{route('section.routine.show', [
                            'class_id'  => $class_info->class_id ?? '',
                            'section_id'=> $class_info->section_id ?? ''
                       ])}}">
                        <div class="d-flex align-items-center">
                            <div class="sidebar-icon">
                                <i class="bi bi-calendar4-week fs-5"></i>
                            </div>
                            <span class="sidebar-text ms-3">Jadwal</span>
                        </div>
                    </a>
                </div>
                @endif

                <!-- Ujian / Nilai (Non-Student) - MENGGUNAKAN ACCORDION -->
                @if(Auth::user()->role != "student")
                <div class="accordion-item border-0 mb-2">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed sidebar-item {{ request()->is('exams*')? 'active' : '' }}" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#exam-grade-submenu" 
                                aria-expanded="{{ request()->is('exams*')? 'true' : 'false' }}" 
                                aria-controls="exam-grade-submenu">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <div class="d-flex align-items-center">
                                    <div class="sidebar-icon">
                                        <i class="bi bi-file-text fs-5"></i>
                                    </div>
                                    <span class="sidebar-text ms-3">Ujian / Nilai</span>
                                </div>
                                <i class="bi bi-chevron-down sidebar-chevron"></i>
                            </div>
                        </button>
                    </h2>
                    <div id="exam-grade-submenu" 
                         class="accordion-collapse collapse {{ request()->is('exams*')? 'show' : '' }}" 
                         data-bs-parent="#sidebarAccordion">
                        <div class="accordion-body p-0">
                            <div class="submenu-content">
                                <a class="submenu-item {{ request()->routeIs('exam.list.show')? 'active' : '' }}" href="{{route('exam.list.show')}}">
                                    <i class="bi bi-eye me-2"></i> Lihat Ujian
                                </a>
                                @if (Auth::user()->role == "admin" || Auth::user()->role == "teacher")
                                <a class="submenu-item {{ request()->routeIs('exam.create.show')? 'active' : '' }}" href="{{route('exam.create.show')}}">
                                    <i class="bi bi-plus-circle me-2"></i> Buat Ujian
                                </a>
                                @endif
                                @if (Auth::user()->role == "admin")
                                <a class="submenu-item {{ request()->routeIs('exam.grade.system.create')? 'active' : '' }}" href="{{route('exam.grade.system.create')}}">
                                    <i class="bi bi-gear me-2"></i> Sistem Kelas
                                </a>
                                @endif
                                <a class="submenu-item {{ request()->routeIs('exam.grade.system.index')? 'active' : '' }}" href="{{route('exam.grade.system.index')}}">
                                    <i class="bi bi-list-check me-2"></i> Sistem Nilai
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Admin Menu -->
                @if (Auth::user()->role == "admin")
                <!-- Pemberitahuan -->
                <div class="accordion-item border-0 mb-2">
                    <a class="nav-link sidebar-item {{ request()->is('notice*')? 'active' : '' }}" href="{{route('notice.create')}}">
                        <div class="d-flex align-items-center">
                            <div class="sidebar-icon">
                                <i class="bi bi-megaphone fs-5"></i>
                            </div>
                            <span class="sidebar-text ms-3">Pemberitahuan</span>
                        </div>
                    </a>
                </div>

                <!-- Acara -->
                <div class="accordion-item border-0 mb-2">
                    <a class="nav-link sidebar-item {{ request()->is('calendar-event*')? 'active' : '' }}" href="{{route('events.show')}}">
                        <div class="d-flex align-items-center">
                            <div class="sidebar-icon">
                                <i class="bi bi-calendar-event fs-5"></i>
                            </div>
                            <span class="sidebar-text ms-3">Acara</span>
                        </div>
                    </a>
                </div>

                <!-- Silabus -->
                <div class="accordion-item border-0 mb-2">
                    <a class="nav-link sidebar-item {{ request()->is('syllabus*')? 'active' : '' }}" href="{{route('class.syllabus.create')}}">
                        <div class="d-flex align-items-center">
                            <div class="sidebar-icon">
                                <i class="bi bi-journal-text fs-5"></i>
                            </div>
                            <span class="sidebar-text ms-3">Silabus</span>
                        </div>
                    </a>
                </div>

                <!-- Jadwal -->
                <div class="accordion-item border-0 mb-2">
                    <a class="nav-link sidebar-item {{ request()->is('routine*')? 'active' : '' }}" href="{{route('section.routine.create')}}">
                        <div class="d-flex align-items-center">
                            <div class="sidebar-icon">
                                <i class="bi bi-calendar4-range fs-5"></i>
                            </div>
                            <span class="sidebar-text ms-3">Jadwal</span>
                        </div>
                    </a>
                </div>

                <!-- Akademik -->
                <div class="accordion-item border-0 mb-2">
                    <a class="nav-link sidebar-item {{ request()->is('academics*')? 'active' : '' }}" href="{{url('academics/settings')}}">
                        <div class="d-flex align-items-center">
                            <div class="sidebar-icon">
                                <i class="bi bi-tools fs-5"></i>
                            </div>
                            <span class="sidebar-text ms-3">Akademik</span>
                        </div>
                    </a>
                </div>

                <!-- Promosi -->
                @if (!session()->has('browse_session_id'))
                <div class="accordion-item border-0 mb-2">
                    <a class="nav-link sidebar-item {{ request()->routeIs('promotions.index') ? 'active' : '' }}"
   href="{{ route('promotions.index') }}">
    <div class="d-flex align-items-center">
        <div class="sidebar-icon">
            <i class="bi bi-graph-up-arrow fs-5"></i>
        </div>
        <span class="sidebar-text ms-3">Promosi</span>
    </div>
</a>

                </div>
                @endif

                <!-- Coming Soon Features -->
                <div class="sidebar-divider my-4"></div>
                <small class="text-muted px-3 mb-2">Coming Soon</small>

                <div class="accordion-item border-0 mb-2">
                    <a class="nav-link sidebar-item disabled" href="#">
                        <div class="d-flex align-items-center">
                            <div class="sidebar-icon">
                                <i class="bi bi-currency-exchange fs-5"></i>
                            </div>
                            <span class="sidebar-text ms-3 text-muted">Pembayaran</span>
                        </div>
                    </a>
                </div>

                <div class="accordion-item border-0 mb-2">
                    <a class="nav-link sidebar-item disabled" href="#">
                        <div class="d-flex align-items-center">
                            <div class="sidebar-icon">
                                <i class="bi bi-people fs-5"></i>
                            </div>
                            <span class="sidebar-text ms-3 text-muted">Staff</span>
                        </div>
                    </a>
                </div>

                <div class="accordion-item border-0 mb-2">
                    <a class="nav-link sidebar-item disabled" href="#">
                        <div class="d-flex align-items-center">
                            <div class="sidebar-icon">
                                <i class="bi bi-journals fs-5"></i>
                            </div>
                            <span class="sidebar-text ms-3 text-muted">Perpustakaan</span>
                        </div>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    /* Modern Sidebar Styles with Red & Yellow Theme - DIPERBAIKI */
    .sidebar-modern {
        background: linear-gradient(180deg, #ffffff 0%, #fef2f2 100%);
        min-height: 100vh;
        border-right: 1px solid #ffe4e6;
        box-shadow: 4px 0 20px rgba(220, 38, 38, 0.08);
        display: flex;
        flex-direction: column;
    }
    
    .sidebar-header {
        border-bottom: 1px solid #e2e8f0;
        background: white;
    }
    
    /* Accordion Button sebagai sidebar item */
    .accordion-button.sidebar-item {
        padding: 0.75rem 1rem;
        border-radius: 10px;
        color: #4b5563;
        transition: all 0.3s ease;
        margin-bottom: 0.25rem;
        display: block;
        text-decoration: none;
        background: transparent;
        border: none;
        width: 100%;
        text-align: left;
    }
    
    .nav-link.sidebar-item {
        padding: 0.75rem 1rem;
        border-radius: 10px;
        color: #4b5563;
        transition: all 0.3s ease;
        margin-bottom: 0.25rem;
        display: block;
        text-decoration: none;
    }
    
    .accordion-button.sidebar-item:hover,
    .nav-link.sidebar-item:hover {
        background: linear-gradient(90deg, rgba(220, 38, 38, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%);
        color: #dc2626;
        transform: translateX(5px);
    }
    
    .accordion-button.sidebar-item.active,
    .nav-link.sidebar-item.active {
        background: linear-gradient(90deg, #dc2626 0%, #f59e0b 100%);
        color: white !important;
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);
        transform: translateX(0);
    }
    
    .accordion-button.sidebar-item:not(.collapsed) {
        background: linear-gradient(90deg, #dc2626 0%, #f59e0b 100%);
        color: white !important;
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);
    }
    
    .sidebar-icon {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: linear-gradient(135deg, rgba(220, 38, 38, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%);
        color: #dc2626;
        transition: all 0.3s ease;
        margin-right: 12px;
    }
    
    .accordion-button.sidebar-item.active .sidebar-icon,
    .accordion-button.sidebar-item:not(.collapsed) .sidebar-icon,
    .nav-link.sidebar-item.active .sidebar-icon {
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }
    
    .accordion-button.sidebar-item:hover .sidebar-icon,
    .nav-link.sidebar-item:hover .sidebar-icon {
        background: linear-gradient(135deg, rgba(220, 38, 38, 0.2) 0%, rgba(245, 158, 11, 0.2) 100%);
        transform: scale(1.1);
    }
    
    .sidebar-text {
        font-weight: 500;
        font-size: 0.95rem;
    }
    
    .sidebar-chevron {
        transition: transform 0.3s ease;
        font-size: 0.875rem;
        color: #9ca3af;
    }
    
    .accordion-button.sidebar-item:not(.collapsed) .sidebar-chevron {
        transform: rotate(180deg);
        color: white;
    }
    
    /* Submenu Styling */
    .submenu-content {
        margin-left: 48px;
        margin-top: 0.25rem;
        margin-bottom: 0.5rem;
        border-left: 2px solid #fed7d7;
        padding-left: 1rem;
        display: flex;
        flex-direction: column;
    }
    
    .submenu-item {
        padding: 0.5rem 1rem;
        color: #6b7280;
        border-radius: 8px;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        margin-bottom: 0.125rem;
        display: flex;
        align-items: center;
        text-decoration: none;
    }
    
    .submenu-item:hover {
        background: rgba(220, 38, 38, 0.08);
        color: #dc2626;
        padding-left: 1.25rem;
    }
    
    .submenu-item.active {
        background: linear-gradient(90deg, rgba(220, 38, 38, 0.15) 0%, rgba(245, 158, 11, 0.15) 100%);
        color: #dc2626;
        font-weight: 500;
    }
    
    /* Accordion body padding */
    .accordion-body {
        padding: 0;
    }
    
    .sidebar-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
    }
    
    /* Badge Styling */
    .badge {
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
        font-weight: 500;
        background: linear-gradient(135deg, #dc2626 0%, #f59e0b 100%);
        color: white;
    }
    
    /* Responsive */
    @media (max-width: 1199px) {
        .sidebar-text {
            display: none;
        }
        
        .sidebar-icon {
            width: 44px;
            height: 44px;
            margin-right: 0;
        }
        
        .accordion-button.sidebar-item,
        .nav-link.sidebar-item {
            justify-content: center;
            padding: 0.75rem;
        }
        
        .submenu-content {
            margin-left: 0.75rem;
            padding-left: 0.75rem;
        }
    }
    
    @media (max-width: 768px) {
        .sidebar-modern {
            display: none;
        }
    }
    .nav-link.sidebar-item {
    pointer-events: auto;
    cursor: pointer;
}
.nav-link.sidebar-item {
    position: relative;
    z-index: 10;
}

.nav-link.sidebar-item:hover {
    transform: none !important;
}

</style>