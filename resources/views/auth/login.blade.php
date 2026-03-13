<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Justine Portfolio</title>
    <link rel="stylesheet" href="/css/portfolio.css">
</head>
<body>
<div class="login-page">

    {{-- Orbs --}}
    <div style="position:absolute;top:-120px;left:-120px;width:450px;height:450px;border-radius:50%;background:radial-gradient(circle,rgba(124,58,237,.25),transparent 70%);filter:blur(70px);pointer-events:none;animation:orb-drift-1 12s ease-in-out infinite alternate;z-index:0;"></div>
    <div style="position:absolute;bottom:-80px;right:-80px;width:350px;height:350px;border-radius:50%;background:radial-gradient(circle,rgba(6,182,212,.18),transparent 70%);filter:blur(60px);pointer-events:none;animation:orb-drift-2 10s ease-in-out infinite alternate;z-index:0;"></div>

    <div class="login-box">
        <div style="text-align:center;font-size:3rem;margin-bottom:.75rem;filter:drop-shadow(0 0 12px rgba(168,85,247,.6))">🔐</div>
        <h1 class="login-title gradient-text">Admin Login</h1>
        <p class="login-sub">Sign in to manage your portfolio</p>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $e){{ $e }}<br>@endforeach
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email', 'admin@portfolio.com') }}" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
            </div>
            <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.25rem">
                <input type="checkbox" name="remember" id="remember" style="width:auto;accent-color:var(--accent)">
                <label for="remember" style="margin:0;text-transform:none;font-size:.875rem;font-weight:400;color:var(--text-muted)">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:.85rem;font-size:1rem;">
                🚀 Sign In
            </button>
        </form>

        <div style="text-align:center;margin-top:1.5rem">
            <a href="/" style="color:var(--text-muted);font-size:.875rem;text-decoration:none;transition:color .2s" onmouseover="this.style.color='var(--accent-light)'" onmouseout="this.style.color='var(--text-muted)'">← Back to Portfolio</a>
        </div>

        <div style="margin-top:1.5rem;padding:1rem;background:rgba(124,58,237,.06);border-radius:8px;border:1px solid rgba(168,85,247,.15);font-size:.8rem;color:var(--text-muted);text-align:center">
            Default: <strong style="color:var(--accent-light)">admin@portfolio.com</strong> / <strong style="color:var(--accent-light)">password123</strong>
        </div>
    </div>
</div>
</body>
</html>
