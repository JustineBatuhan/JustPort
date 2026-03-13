<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | Portfolio Admin</title>
    <link rel="stylesheet" href="/css/portfolio.css">
    @stack('styles')
</head>
<body>
<div class="admin-wrapper">

    {{-- Sidebar --}}
    <aside class="admin-sidebar">
        <div class="admin-logo">
            <span class="gradient-text">⚡ JB Admin</span>
        </div>
        <div class="admin-user">
            <img src="/images/profile.png" alt="{{ auth()->user()->name ?? 'Admin' }}" class="admin-user-avatar">
            <div class="admin-user-info">
                <div class="admin-user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                <div class="admin-user-role">{{ auth()->user()->email ?? '' }}</div>
            </div>
        </div>
        <nav class="admin-nav">
            <div class="admin-nav-label">Main</div>
            <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <span class="admin-nav-icon">📊</span> <span>Dashboard</span>
            </a>

            <div class="admin-nav-label">Content</div>
            <a href="/admin/projects" class="{{ request()->is('admin/projects*') ? 'active' : '' }}">
                <span class="admin-nav-icon">💡</span> <span>Projects</span>
            </a>
            <a href="/admin/skills" class="{{ request()->is('admin/skills*') ? 'active' : '' }}">
                <span class="admin-nav-icon">🛠️</span> <span>Skills</span>
            </a>
            <a href="/admin/messages" class="{{ request()->is('admin/messages*') ? 'active' : '' }}">
                <span class="admin-nav-icon">✉️</span> <span>Messages</span>
            </a>

            <div class="admin-nav-label">Site</div>
            <a href="/" target="_blank">
                <span class="admin-nav-icon">🌐</span> <span>View Site</span>
            </a>
        </nav>
        <form action="/logout" method="POST" style="padding:1rem 1rem 1.5rem;">
            @csrf
            <button type="submit" class="btn btn-outline btn-sm" style="width:100%;justify-content:center;">
                🚪 <span>Logout</span>
            </button>
        </form>
    </aside>

    {{-- Main --}}
    <main class="admin-main">
        <div class="admin-topbar">
            <h1>@yield('page-title', 'Dashboard')</h1>
            <div>
                @yield('topbar-actions')
            </div>
        </div>
        <div class="admin-content">
            @if(session('success'))
                <div class="alert alert-success">✅ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">❌ {{ session('error') }}</div>
            @endif
            @yield('content')
        </div>
    </main>
</div>
<script src="/js/portfolio.js"></script>
</body>
</html>
