@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

<!-- Carrusel de Imágenes -->
<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('images/slide1.jpg') }}" class="d-block w-100 carousel-img" alt="Educación de Calidad">
            <div class="carousel-caption">
                <h1 class="display-3 fw-bold text-shadow">Colegio Santa María de Jesús</h1>
                <p class="lead text-shadow">Formando líderes con excelencia académica</p>
                <a href="{{ route('nosotros') }}" class="btn btn-lg btn-gold mt-3">Conócenos</a>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/slide2.jpg') }}" class="d-block w-100 carousel-img" alt="Estudiantes">
            <div class="carousel-caption">
                <h1 class="display-3 fw-bold text-shadow">Educación Integral</h1>
                <p class="lead text-shadow">Desarrollando el potencial de cada estudiante</p>
                <a href="{{ route('contacto') }}" class="btn btn-lg btn-gold mt-3">Contáctanos</a>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/slide3.jpg') }}" class="d-block w-100 carousel-img" alt="Aula Moderna">
            <div class="carousel-caption">
                <h1 class="display-3 fw-bold text-shadow">Infraestructura Moderna</h1>
                <p class="lead text-shadow">Espacios diseñados para el aprendizaje</p>
                <a href="{{ route('login') }}" class="btn btn-lg btn-gold mt-3">Ingresar al Sistema</a>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Sección de Bienvenida con Borde Dorado -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="gold-border-box">
                    <h2 class="text-primary mb-4">
                        <i class="bi bi-star-fill text-gold me-2"></i>
                        Bienvenidos a Scholarium
                    </h2>
                    <p class="lead">El <strong>Colegio Santa María de Jesús</strong> es una institución educativa comprometida con la formación integral de nuestros estudiantes en Lima, Perú.</p>
                    <p>Contamos con más de 25 años de experiencia brindando educación de calidad, valores sólidos y preparación para el futuro.</p>
                    <div class="mt-4">
                        <a href="{{ route('nosotros') }}" class="btn btn-primary btn-lg me-2">
                            <i class="bi bi-info-circle me-2"></i>Más Información
                        </a>
                        <a href="{{ route('contacto') }}" class="btn btn-outline-gold btn-lg">
                            <i class="bi bi-envelope me-2"></i>Contacto
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                        <h3 class="stat-number">500+</h3>
                        <p class="stat-label">Estudiantes</p>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="bi bi-person-badge"></i></div>
                        <h3 class="stat-number">50+</h3>
                        <p class="stat-label">Docentes</p>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="bi bi-book"></i></div>
                        <h3 class="stat-number">30+</h3>
                        <p class="stat-label">Asignaturas</p>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="bi bi-trophy"></i></div>
                        <h3 class="stat-number">25+</h3>
                        <p class="stat-label">Años</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Características con Iconos Dorados -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">
            <span class="gold-underline">¿Por Qué Elegirnos?</span>
        </h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-gold">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <h4>Excelencia Académica</h4>
                    <p>Programas educativos de alto nivel con docentes calificados y metodologías innovadoras.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-gold">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                    <h4>Formación en Valores</h4>
                    <p>Educamos con principios éticos y morales para formar ciudadanos responsables.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-gold">
                        <i class="bi bi-building"></i>
                    </div>
                    <h4>Infraestructura Moderna</h4>
                    <p>Instalaciones equipadas con tecnología de punta para un aprendizaje efectivo.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-gold">
                        <i class="bi bi-people"></i>
                    </div>
                    <h4>Atención Personalizada</h4>
                    <p>Grupos reducidos que permiten un seguimiento cercano de cada estudiante.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-gold">
                        <i class="bi bi-globe"></i>
                    </div>
                    <h4>Visión Global</h4>
                    <p>Preparamos estudiantes con competencias para un mundo globalizado.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-gold">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4>Ambiente Seguro</h4>
                    <p>Espacios seguros y protegidos para el desarrollo integral de nuestros estudiantes.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Llamado a la Acción con Fondo Dorado -->
<section class="cta-section">
    <div class="container text-center">
        <h2 class="display-4 fw-bold mb-4">¿Listo para Ser Parte de Nuestra Familia?</h2>
        <p class="lead mb-4">Únete a una comunidad educativa comprometida con la excelencia</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                <i class="bi bi-person-plus me-2"></i>Registrarse
            </a>
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                <i class="bi bi-box-arrow-in-right me-2"></i>Ingresar al Sistema
            </a>
            <a href="{{ route('contacto') }}" class="btn btn-outline-light btn-lg">
                <i class="bi bi-envelope me-2"></i>Solicitar Información
            </a>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .carousel-img {
        height: 600px;
        object-fit: cover;
        filter: brightness(0.7);
    }
    
    .carousel-caption {
        background: rgba(107, 28, 61, 0.7);
        padding: 2rem;
        border-radius: 10px;
        bottom: 10%;
    }
    
    .text-shadow {
        text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
    }
    
    .btn-gold {
        background: linear-gradient(135deg, #D4AF37 0%, #F4D03F 100%);
        color: #6B1C3D;
        border: none;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-gold:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(212, 175, 55, 0.4);
        color: #6B1C3D;
    }
    
    .btn-outline-gold {
        border: 2px solid #D4AF37;
        color: #D4AF37;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-outline-gold:hover {
        background: #D4AF37;
        color: #6B1C3D;
        transform: translateY(-2px);
    }
    
    .gold-border-box {
        border-left: 5px solid #D4AF37;
        padding-left: 2rem;
    }
    
    .text-gold {
        color: #D4AF37 !important;
    }
    
    .gold-underline {
        position: relative;
        padding-bottom: 10px;
    }
    
    .gold-underline::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: linear-gradient(90deg, transparent, #D4AF37, transparent);
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
    
    .stat-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-top: 4px solid #D4AF37;
        transition: all 0.3s;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(212, 175, 55, 0.3);
    }
    
    .stat-icon {
        font-size: 3rem;
        color: #D4AF37;
        margin-bottom: 1rem;
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #6B1C3D;
        margin: 0;
    }
    
    .stat-label {
        color: #6c757d;
        margin: 0;
        font-weight: 500;
    }
    
    .feature-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        text-align: center;
        height: 100%;
        transition: all 0.3s;
        border: 2px solid transparent;
    }
    
    .feature-card:hover {
        border-color: #D4AF37;
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(212, 175, 55, 0.2);
    }
    
    .feature-icon-gold {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, #D4AF37 0%, #F4D03F 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: white;
        box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
    }
    
    .cta-section {
        background: linear-gradient(135deg, #6B1C3D 0%, #8B2E52 100%);
        color: white;
        padding: 5rem 0;
        position: relative;
        overflow: hidden;
    }
    
    .cta-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(212, 175, 55, 0.2) 0%, transparent 70%);
        border-radius: 50%;
    }
    
    .cta-section::after {
        content: '';
        position: absolute;
        bottom: -50%;
        left: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(212, 175, 55, 0.2) 0%, transparent 70%);
        border-radius: 50%;
    }
    
    @media (max-width: 768px) {
        .carousel-img {
            height: 400px;
        }
        
        .carousel-caption h1 {
            font-size: 2rem;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush
