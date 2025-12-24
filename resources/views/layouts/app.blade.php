<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">

    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LMS MIHU') }}</title>

    <link rel="shortcut icon" href="{{asset('favicon_io/mahasiswa.png')}}">
    <link rel="shortcut icon" href="{{asset('favicon_io/favicon-mihu-unsur.ico')}}">
    <link rel="shortcut icon" sizes="16x16" href="{{asset('favicon_io/favicon-mihu-unsur-16x16.png')}}">
    <link rel="shortcut icon" sizes="32x32" href="{{asset('favicon_io/favicon-mihu-unsur-32x32.png')}}">
    <link rel="apple-touch-icon" href="{{asset('favicon_io/apple-touch-icon.png')}}">
    <link rel="icon" href="{{asset('favicon_io/logo-mihu-unsur-192x192.png')}}" sizes="192x192">
    <link rel="icon" href="{{asset('favicon_io/logo-mihu-unsur-512x512.png')}}" sizes="512x512">

    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-yellow: #ffd900;
            --dark-yellow: #e6c200;
            --text-dark: #1e293b;
            --text-light: #64748b;
        }
        
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body>
    <div id="app">
        <!-- Modern Navbar - REVISED STRUCTURE -->
<nav class="navbar navbar-expand-lg navbar-modern sticky-top">
    <div class="container-fluid px-4">
        <!-- Brand Logo & Name -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <div class="navbar-logo">
                <div class="logo-icon">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
            </div>
            <div class="navbar-brand-text">
                <span class="fw-bold">{{ config('app.name', 'LMS MIHU') }}</span>
                <small>Learning Management System</small>
            </div>
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side - Academic Session Info -->
            @auth
            <div class="navbar-session-info">
                @php
                    $latest_school_session = \App\Models\SchoolSession::latest()->first();
                    $current_school_session_name = null;
                    if($latest_school_session){
                        $current_school_session_name = $latest_school_session->session_name;
                    }
                @endphp
                
                @if (session()->has('browse_session_name') && session('browse_session_name') !== $current_school_session_name)
                <div class="session-badge session-badge-warning">
                    <i class="bi bi-exclamation-diamond-fill me-1"></i>
                    <span>Browsing: {{ session('browse_session_name') }}</span>
                </div>
                @elseif(\App\Models\SchoolSession::latest()->count() > 0)
                <div class="session-badge session-badge-primary">
                    <i class="bi bi-calendar-check me-1"></i>
                    <span>Session: {{ $current_school_session_name }}</span>
                </div>
                @else
                <div class="session-badge session-badge-danger">
                    <i class="bi bi-exclamation-diamond-fill me-1"></i>
                    <span>Buat Sesi Akademik</span>
                </div>
                @endif
            </div>
            @endauth

            <!-- Right Side - User Menu -->
            <ul class="navbar-nav ms-auto">
                @guest
                    @if (Route::has('login'))
                    <!-- Login link jika perlu -->
                    @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle user-dropdown" href="#" 
                       role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <!-- User Avatar -->
                            <div class="user-avatar">
                                <div class="avatar-circle">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                            </div>
                            
                            <!-- User Info Desktop -->
                            <div class="user-info">
                                <div class="user-name fw-medium">
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                </div>
                                <div class="user-role">
                                    <span class="badge role-badge">{{ ucfirst(Auth::user()->role) }}</span>
                                </div>
                            </div>
                            
                            <!-- User Info Mobile -->
                            <div class="user-info-mobile">
                                <span class="fw-medium">{{ Auth::user()->first_name }}</span>
                            </div>
                        </div>
                    </a>

                    <!-- Dropdown Menu -->
                    <div class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="navbarDropdown" 
                         style="border-radius: 12px; border: none; margin-top: 5px;">
                        <!-- User Header in Dropdown -->
                        <div class="dropdown-header px-4 py-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle me-3">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h6>
                                    <small class="text-muted">{{ Auth::user()->email }}</small>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dropdown Items -->
                        <a class="dropdown-item d-flex align-items-center py-3" href="{{route('password.edit')}}">
                            <div class="dropdown-icon">
                                <i class="bi bi-key text-primary"></i>
                            </div>
                            <div class="ms-3">
                                <span class="fw-medium">Ubah Kata Sandi</span>
                                <small class="text-muted d-block">Ganti password akun Anda</small>
                            </div>
                        </a>
                        
                        <div class="dropdown-divider"></div>
                        
                        <a class="dropdown-item d-flex align-items-center py-3 text-danger" 
                           href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <div class="dropdown-icon">
                                <i class="bi bi-box-arrow-right"></i>
                            </div>
                            <div class="ms-3">
                                <span class="fw-medium">{{ __('Keluar') }}</span>
                                <small class="text-muted d-block">Logout dari sistem</small>
                            </div>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

        <script>
// Navbar auto-hide tanpa duplikasi
$(document).ready(function() {
    var lastScrollTop = 0;
    var $navbar = $('nav.navbar'); // Gunakan class yang sudah ada
    
    // Tambahkan transition saja
    $navbar.css('transition', 'transform 0.3s ease');
    
    $(window).scroll(function() {
        var scrollTop = $(this).scrollTop();
        
        if (scrollTop > lastScrollTop && scrollTop > 150) {
            // Scroll down - hide
            $navbar.css('transform', 'translateY(-100%)');
        } else if (scrollTop < lastScrollTop) {
            // Scroll up - show
            $navbar.css('transform', 'translateY(0)');
        }
        
        lastScrollTop = scrollTop;
    });
});
</script>

        <main>
            @yield('content')
        </main>
    </div>

    <div id="watermark">
        <p>LMS MIHU</p>
    </div>

    <style>
    /* NAVBAR SUPER MINIMALIS - Warna Kuning MIHU - DIREVISI */
    .navbar-modern {
        background: #ffd900; /* Warna kuning solid */
        box-shadow: 0 1px 10px rgba(0, 0, 0, 0.08);
        padding: 0; /* Reset padding */
        min-height: 55px;
        max-height: 55px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    /* Container dengan flex yang tepat */
    .navbar-modern .container-fluid {
        padding: 0 1rem;
        height: 55px; /* Sama dengan tinggi navbar */
        display: flex;
        align-items: center;
    }

    /* Logo dan brand yang sejajar */
    .navbar-brand {
        display: flex;
        align-items: center;
        margin-right: 0;
        padding: 0;
        height: 100%;
    }

    /* Logo icon yang presisi */
    .navbar-logo {
        display: flex;
        align-items: center;
        margin-right: 12px;
    }
    
    .navbar-logo .logo-icon {
        width: 36px;
        height: 36px;
        background: #1e293b;
        color: white;
        font-size: 1.1rem;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Brand text yang rapi */
    .navbar-brand-text {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .navbar-brand .fw-bold {
        font-size: 1rem;
        color: #1e293b;
        line-height: 1.2;
        font-weight: 700;
    }
    
    .navbar-brand small {
        font-size: 0.65rem;
        color: #64748b;
        line-height: 1.2;
        display: block;
        margin-top: 1px;
    }

    /* Toggler button yang rapi */
    .navbar-toggler {
        padding: 0.35rem 0.5rem;
        border-radius: 6px;
        border: 1px solid rgba(30, 41, 59, 0.1);
        font-size: 0.9rem;
        height: 36px;
        width: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .navbar-toggler-icon {
        width: 18px;
        height: 18px;
    }

    /* Session badge minimalis */
    .navbar-session-info {
        margin-left: 1.5rem;
        display: flex;
        align-items: center;
        height: 100%;
    }
    
    .session-badge {
        padding: 0.3rem 0.8rem;
        font-size: 0.75rem;
        border-radius: 12px;
        background: rgba(30, 41, 59, 0.9);
        color: white;
        display: inline-flex;
        align-items: center;
        white-space: nowrap;
    }
    
    .session-badge i {
        font-size: 0.7rem;
        margin-right: 5px;
    }

    /* User section yang compact dan rapi */
    .navbar-nav {
        display: flex;
        align-items: center;
        height: 100%;
        margin: 0;
    }
    
    .nav-item {
        display: flex;
        align-items: center;
        height: 100%;
    }
    
    .user-dropdown {
        padding: 0.25rem 0;
        height: 100%;
        display: flex;
        align-items: center;
    }
    
    .user-dropdown .d-flex {
        display: flex !important;
        align-items: center;
        height: 100%;
    }

    .user-avatar {
        display: flex;
        align-items: center;
        margin-right: 10px;
    }
    
    .user-avatar .avatar-circle {
        width: 36px;
        height: 36px;
        background: #1e293b;
        color: white;
        font-size: 1rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid rgba(255, 255, 255, 0.8);
    }

    /* User info text */
    .user-info {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .user-info .user-name {
        font-size: 0.8rem;
        color: #1e293b;
        font-weight: 600;
        line-height: 1.2;
    }
    
    .role-badge {
        background: #1e293b;
        color: white;
        padding: 0.15rem 0.5rem;
        font-size: 0.65rem;
        border-radius: 10px;
        display: inline-block;
        margin-top: 2px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* User info mobile */
    .user-info-mobile {
        display: none;
    }

    /* Dropdown arrow yang konsisten */
    .dropdown-toggle::after {
        margin-left: 6px;
        vertical-align: middle;
        border-top: 0.35em solid;
        border-right: 0.35em solid transparent;
        border-left: 0.35em solid transparent;
    }

    /* Responsive untuk tablet/mobile */
    @media (max-width: 991.98px) {
        .navbar-modern {
            min-height: auto;
            max-height: none;
            padding: 0.4rem 0;
        }
        
        .navbar-modern .container-fluid {
            height: auto;
            flex-wrap: wrap;
        }
        
        /* Logo tetap di kiri, toggler di kanan */
        .navbar-brand {
            flex: 1;
        }
        
        /* Session info full width */
        .navbar-session-info {
            order: 3;
            width: 100%;
            margin: 0.5rem 0 0 0;
            justify-content: center;
        }
        
        /* Collapse menu styling */
        .navbar-collapse {
            order: 4;
            width: 100%;
            background: white;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: 0.5rem;
            padding: 1rem;
        }
        
        /* User info mobile muncul */
        .user-info-mobile {
            display: block;
            margin-left: 10px;
        }
        
        .user-info-mobile .fw-medium {
            font-size: 0.85rem;
            color: #1e293b;
            font-weight: 600;
        }
        
        /* Sembunyikan desktop user info */
        .user-info {
            display: none;
        }
        
        /* Dropdown di mobile */
        .dropdown-menu {
            width: 100%;
            margin-top: 5px;
        }
    }

    /* Responsive untuk mobile kecil */
    @media (max-width: 576px) {
        .navbar-modern .container-fluid {
            padding: 0 0.75rem;
        }
        
        .navbar-brand .fw-bold {
            font-size: 0.9rem;
        }
        
        .navbar-brand small {
            font-size: 0.6rem;
        }
        
        .session-badge {
            font-size: 0.7rem;
            padding: 0.25rem 0.6rem;
        }
        
        .user-avatar .avatar-circle {
            width: 32px;
            height: 32px;
            font-size: 0.9rem;
        }
    }
</style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth animation to session badge
            const sessionBadge = document.querySelector('.session-badge');
            if (sessionBadge) {
                sessionBadge.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                    this.style.boxShadow = '0 6px 12px rgba(0, 0, 0, 0.15)';
                });
                
                sessionBadge.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 2px 8px rgba(0, 0, 0, 0.1)';
                });
            }
            
            // User dropdown hover effect
            const userDropdown = document.querySelector('.user-dropdown');
            if (userDropdown) {
                const avatarCircle = userDropdown.querySelector('.avatar-circle');
                
                userDropdown.addEventListener('mouseenter', function() {
                    avatarCircle.style.transform = 'scale(1.1)';
                    avatarCircle.style.borderColor = 'rgba(255, 255, 255, 0.5)';
                });
                
                userDropdown.addEventListener('mouseleave', function() {
                    avatarCircle.style.transform = 'scale(1)';
                    avatarCircle.style.borderColor = 'rgba(255, 255, 255, 0.3)';
                });
            }
        });
    </script>
</body>
</html>