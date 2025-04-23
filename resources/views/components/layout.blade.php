<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task Management Dashboard</title>
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> 
  <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script> 
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="{{ asset('assets/js/script.js') }}" defer></script>
</head>
<body>
    <div class="notify-container"></div>
    <div class="dashboard">
        <header class="header">
            <div class="logo">
                <i class="ri-side-bar-line"></i>
                <img src="{{ asset('assets/img/favpng_logo-graphic-design.png')}}" alt="img">
                <h3>TaskMaster</h3>
            </div>
            <div class="user-actions">
                <a href="#"><i class="ri-settings-2-line"></i></a>
                <a href="#"> 
                    <i class="ri-notification-3-line"></i>
                    <p class="notification">99+</p>
                </a>
                <a href="#"><img src="{{ asset('assets/img/3d-illustration-cartoon-character-avatar-profile_1183071-154.avif') }}" alt="User"></a>
            </div>
        </header>
        <aside class="side-bar"> 
            <div class="side-bar-search">
                <svg xmlns="http://www.w3.org/2000/svg" class="svg_icon bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path></svg>
                <input class="input" type="text" placeholder="Search">
            </div>
            <div class="side-bar-contents">
                <h5>GENERAL</h5>
                <a href="{{ route('taskManagement.index')}}" class="side-bar-link" data-popup="popup1">
                    <i class="ri-dashboard-horizontal-line"></i>
                    <p>Dashboard</p>
                </a>
                <span id="popup1" class="popup">Dashboard</span>
                <a href="{{ route('taskManagement.create')}}" class="side-bar-link" data-popup="popup2">
                    <i class="ri-list-check-3"></i>
                    <p>Tasks</p>
                    <p class="To_do_list">08</p>
                </a>
                <span id="popup2" class="popup">Tasks</span>
                <a href="#" class="side-bar-link" data-popup="popup4">
                    <i class="ri-calendar-todo-line"></i>
                    <p>Calendar</p>
                    <p class="Budgets">New</p>
                </a>
                <span id="popup4" class="popup">Calendar</span>
                <a href="#" class="side-bar-link" data-popup="popup5">
                    <i class="ri-align-item-top-line"></i>
                    <p>Analytics</p>
                </a>
                <span id="popup5" class="popup">Analytics</span>
            </div>
            <div class="side-bar-bottom">
                <div class="more">
                    <a href="#">
                        <i class="ri-notification-3-line"></i>
                        <p class="notification">99+</p>
                    </a>
                    <a href="#"><i class="ri-qr-scan-2-line"></i></a>
                    <a href="#"><i class="ri-questionnaire-line"></i></a>
                    <a href="#"><i class="ri-settings-2-line"></i></a>
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider"></span>
                    </label>
                </div> 
                <div class="profile">
                    <img src="{{ asset('assets/img/3d-illustration-cartoon-character-avatar-profile_1183071-154.avif') }}" alt="img">
                    <p>Codingberhan</p>
                </div>
            </div>
        </aside>
        <main class="main-content">  
            @if(session('task_status'))
                <div>{{ session('task_status') }}</div>
            @else
            {{ $slot }}
            @endif
        </main>
    </div>
</body> 
</html>