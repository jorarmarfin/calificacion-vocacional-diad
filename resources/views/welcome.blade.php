<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Calificación Vocacional - UNI DIAD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Abstract Shapes - Picasso Style */
        .abstract-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            opacity: 0.3;
        }

        .blob {
            position: absolute;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            filter: blur(40px);
            animation: morph 8s ease-in-out infinite;
        }

        .blob-1 {
            width: 400px;
            height: 400px;
            background: linear-gradient(45deg, #ff6b6b, #feca57);
            top: -10%;
            left: -5%;
            animation-delay: 0s;
        }

        .blob-2 {
            width: 350px;
            height: 350px;
            background: linear-gradient(45deg, #48dbfb, #0abde3);
            bottom: -10%;
            right: -5%;
            animation-delay: 2s;
        }

        .blob-3 {
            width: 300px;
            height: 300px;
            background: linear-gradient(45deg, #ee5a6f, #f29263);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: 4s;
        }

        @keyframes morph {
            0%, 100% {
                border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
                transform: rotate(0deg) scale(1);
            }
            25% {
                border-radius: 58% 42% 75% 25% / 76% 46% 54% 24%;
                transform: rotate(90deg) scale(1.1);
            }
            50% {
                border-radius: 50% 50% 33% 67% / 55% 27% 73% 45%;
                transform: rotate(180deg) scale(0.9);
            }
            75% {
                border-radius: 33% 67% 58% 42% / 63% 68% 32% 37%;
                transform: rotate(270deg) scale(1.05);
            }
        }

        /* Floating Elements */
        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            opacity: 0.6;
            animation: float-random 15s ease-in-out infinite;
        }

        .shape-circle {
            width: 80px;
            height: 80px;
            border: 3px solid rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            top: 20%;
            left: 10%;
        }

        .shape-triangle {
            width: 0;
            height: 0;
            border-left: 40px solid transparent;
            border-right: 40px solid transparent;
            border-bottom: 70px solid rgba(255, 255, 255, 0.3);
            top: 70%;
            right: 15%;
            animation-delay: 3s;
        }

        .shape-line {
            width: 150px;
            height: 3px;
            background: rgba(255, 255, 255, 0.4);
            top: 40%;
            right: 20%;
            transform: rotate(-45deg);
            animation-delay: 6s;
        }

        @keyframes float-random {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(20px, -30px) rotate(90deg); }
            50% { transform: translate(-15px, 20px) rotate(180deg); }
            75% { transform: translate(30px, 10px) rotate(270deg); }
        }

        /* Container */
        .container {
            position: relative;
            z-index: 10;
            max-width: 1100px;
            margin: 0 auto;
            padding: 3rem 2rem;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Header */
        header {
            text-align: center;
            margin-bottom: 4rem;
            animation: fadeIn 1.2s ease-out;
        }

        .logo-abstract {
            width: 140px;
            height: 140px;
            margin: 0 auto 2rem;
            position: relative;
            animation: rotate-slow 20s linear infinite;
        }

        .logo-piece {
            position: absolute;
            background: white;
            opacity: 0.9;
        }

        .piece-1 {
            width: 60px;
            height: 60px;
            top: 0;
            left: 40px;
            border-radius: 50% 0 50% 0;
            background: linear-gradient(135deg, #ffd89b, #19547b);
        }

        .piece-2 {
            width: 50px;
            height: 70px;
            bottom: 10px;
            left: 10px;
            border-radius: 0 50% 0 50%;
            background: linear-gradient(135deg, #f093fb, #f5576c);
        }

        .piece-3 {
            width: 55px;
            height: 55px;
            top: 20px;
            right: 10px;
            clip-path: polygon(50% 0%, 100% 100%, 0% 100%);
            background: linear-gradient(135deg, #4facfe, #00f2fe);
        }

        @keyframes rotate-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            color: white;
            margin-bottom: 0.5rem;
            font-weight: 900;
            text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.2);
            line-height: 1.2;
        }

        .subtitle {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.95);
            font-weight: 300;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Content Cards */
        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
            animation: slideUp 1s ease-out 0.3s both;
        }

        .card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 2.5rem;
            border: 2px solid rgba(255, 255, 255, 0.2);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.4s;
        }

        .card:hover::before {
            opacity: 1;
        }

        .card:hover {
            transform: translateY(-15px) scale(1.02);
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .card-icon {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            display: block;
            filter: drop-shadow(2px 4px 6px rgba(0, 0, 0, 0.2));
        }

        .card h3 {
            font-family: 'Playfair Display', serif;
            color: white;
            font-size: 1.6rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .card p {
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.7;
            font-size: 0.95rem;
        }

        /* CTA Buttons */
        .cta-section {
            text-align: center;
            animation: slideUp 1s ease-out 0.6s both;
        }

        .btn {
            display: inline-block;
            padding: 1.2rem 3rem;
            margin: 0.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.05rem;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary {
            background: white;
            color: #667eea;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(102, 126, 234, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-primary:hover::before {
            width: 400px;
            height: 400px;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-secondary:hover {
            background: white;
            color: #667eea;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 2rem 0;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            margin-top: 2rem;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.2rem;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .btn {
                display: block;
                margin: 0.5rem auto;
                max-width: 300px;
            }

            .blob {
                filter: blur(60px);
            }
        }
    </style>
</head>
<body>
    <!-- Abstract Background -->
    <div class="abstract-bg">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>

    <!-- Floating Shapes -->
    <div class="floating-shapes">
        <div class="shape shape-circle"></div>
        <div class="shape shape-triangle"></div>
        <div class="shape shape-line"></div>
    </div>

    <div class="container">
        <!-- Header -->
        <header>
            <div class="logo-abstract">
                <div class="logo-piece piece-1"></div>
                <div class="logo-piece piece-2"></div>
                <div class="logo-piece piece-3"></div>
            </div>
            <h1>Calificación Vocacional</h1>
            <p class="subtitle">Descubre tu potencial creativo en Arquitectura - Universidad Nacional de Ingeniería</p>
        </header>

        <!-- Content -->
        <div class="content-grid" style="max-width: 600px; margin-left: auto; margin-right: auto;">
            <div class="card" style="text-align: center;">
                <span class="card-icon">🏛️</span>
                <h3>Calificación de Preguntas Sensibles</h3>
                <p>Sistema especializado de evaluación vocacional diseñado para identificar las aptitudes, habilidades creativas y competencias específicas de los postulantes a la carrera de Arquitectura. A través de preguntas sensibles y análisis detallado, evaluamos tu potencial para transformar espacios y crear diseños innovadores.</p>
            </div>
        </div>

        <!-- CTA -->
        <div class="cta-section">
            @if (Route::has('login'))
                @auth
                    <a href="/grading" class="btn btn-primary">
                        <span style="position: relative; z-index: 1;">📊 Acceder al Dashboard</span>
                    </a>
                @else
                    <a href="/grading" class="btn btn-primary">
                        <span style="position: relative; z-index: 1;">🚀 Acceder al Sistema</span>
                    </a>

                @endauth
            @else
                <a href="/grading" class="btn btn-primary">
                    <span style="position: relative; z-index: 1;">🚀 Acceder al Sistema</span>
                </a>
            @endif
        </div>

        <!-- Footer -->
        <footer>
            <p>&copy; {{ date('Y') }} UNI - DIAD | Formando arquitectos del futuro</p>
        </footer>
    </div>
</body>
</html>
