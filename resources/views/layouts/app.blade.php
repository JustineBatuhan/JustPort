<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Justine Batuhan – IT Student at Madridejos Community College. Portfolio showcasing projects and skills in web development.">
    <title>@yield('title', 'Justine Batuhan | Portfolio')</title>
    <link rel="stylesheet" href="/css/portfolio.css">
    @stack('styles')
</head>
<body>

<!-- Navbar -->
<nav class="navbar" id="navbar">
    <div class="container nav-inner">
        <a href="/" class="nav-brand">
            <img src="/images/profile.png" alt="JB" class="nav-avatar"> JB.
        </a>
        <ul class="nav-links" id="nav-links">
            <li><a href="#hero">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#skills">Skills</a></li>
            <li><a href="#projects">Projects</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>

        <div class="nav-admin">
            @auth
                <a href="{{ route('admin.dashboard') }}" class="btn-admin btn-dashboard">⚡ Dashboard</a>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-admin btn-logout">🚪 Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-admin btn-login">🔐 Admin Login</a>
            @endauth
        </div>

        <div class="nav-toggle" id="nav-toggle" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </div>
    </div>
</nav>

<!-- Page Content -->
@yield('content')

<!-- Footer -->
<footer class="footer">
    <p>Designed &amp; Built by <a href="#hero">Justine Batuhan</a> &mdash; Information Technology, Madridejos Community College &copy; {{ date('Y') }}</p>
</footer>

<!-- Scroll to Top -->
<button class="scroll-top" aria-label="Back to top">↑</button>

<script src="/js/portfolio.js"></script>
@stack('scripts')
</body>
</html>
