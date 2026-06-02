<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LabSystem') — Sistem Manajemen Aset Laboratorium</title>
    <meta name="description" content="Sistem Informasi Manajemen Aset dan BHP Laboratorium.">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { font-family: 'Outfit', 'Inter', sans-serif; }
        .auth-bg {
            background: linear-gradient(135deg, #0f0c29 0%, #1a1a4e 40%, #24243e 100%);
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }
        .auth-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 15% 80%, rgba(99, 102, 241, 0.18) 0%, transparent 50%),
                radial-gradient(circle at 85% 20%, rgba(168, 85, 247, 0.18) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(59, 130, 246, 0.08) 0%, transparent 70%);
        }
        .auth-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.02'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.5;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(255, 255, 255, 0.05);
        }
        .input-field {
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.14);
            color: white;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            width: 100%;
            transition: all 0.2s ease;
            font-size: 0.95rem;
        }
        .input-field:focus {
            outline: none;
            border-color: rgba(129, 140, 248, 0.7);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }
        .input-field::placeholder { color: rgba(255,255,255,0.35); }
        .input-field option { background: #1a1a4e; color: white; }
        .input-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: rgba(199, 210, 254, 0.9);
            margin-bottom: 0.4rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }
        .btn-primary {
            width: 100%;
            padding: 0.85rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 700;
            font-size: 1rem;
            color: white;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border: none;
            cursor: pointer;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
            letter-spacing: 0.02em;
        }
        .btn-primary::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.15) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.25s;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 12px 28px rgba(99, 102, 241, 0.45); }
        .btn-primary:hover::before { opacity: 1; }
        .btn-primary:active { transform: translateY(0); }
        .error-msg {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.35);
            color: #fca5a5;
            border-radius: 0.6rem;
            padding: 0.6rem 0.9rem;
            font-size: 0.85rem;
        }
        .link-accent { color: #a5b4fc; text-decoration: none; font-weight: 600; transition: color 0.2s; }
        .link-accent:hover { color: #c4b5fd; }
        .logo-icon {
            width: 52px; height: 52px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.5);
        }
        .divider { border: none; border-top: 1px solid rgba(255,255,255,0.09); margin: 1.25rem 0; }
    </style>
</head>
<body class="auth-bg flex items-center justify-center p-4">
    <div class="relative z-10 w-full">
        @yield('content')
    </div>
</body>
</html>
