@extends('layouts.app')

@section('title', 'Nosotros')

@section('content')
<div class="hero-section">
    <div class="container text-center">
        <h1 class="display-4">Sobre Nosotros</h1>
        <p class="lead">Colegio Santa María de Jesús</p>
    </div>
</div>

<div class="container">
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body p-5">
                    <h2 class="mb-4" style="color: var(--vinotinto-oscuro);">Nuestra Historia</h2>
                    <p>El Colegio Santa María de Jesús fue fundado con el propósito de brindar una educación de excelencia que integre formación académica, desarrollo personal y valores cristianos. Desde nuestros inicios, hemos mantenido un compromiso inquebrantable con la calidad educativa y el desarrollo integral de nuestros estudiantes.</p>
                    
                    <p>A lo largo de los años, nos hemos consolidado como una institución educativa de referencia, caracterizada por su innovación pedagógica, infraestructura moderna y un equipo docente altamente calificado y comprometido con la misión educativa.</p>
                    
                    <hr class="my-4">
                    
                    <h3 class="mb-3" style="color: var(--vinotinto-oscuro);">Misión</h3>
                    <p class="bg-light p-4 rounded">Formar personas íntegras, con sólidos conocimientos académicos, valores cristianos y habilidades para enfrentar los desafíos del siglo XXI, contribuyendo al desarrollo de una sociedad más justa y solidaria.</p>
                    
                    <h3 class="mb-3 mt-4" style="color: var(--vinotinto-oscuro);">Visión</h3>
                    <p class="bg-light p-4 rounded">Ser reconocidos como una institución educativa de excelencia, líder en innovación pedagógica y formación integral, que prepara a sus estudiantes para ser agentes de cambio positivo en la sociedad.</p>
                    
                    <hr class="my-4">
                    
                    <h3 class="mb-3" style="color: var(--vinotinto-oscuro);">Nuestros Valores</h3>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill me-3" style="color: var(--dorado); font-size: 1.5rem;"></i>
                                <div>
                                    <h5>Excelencia Académica</h5>
                                    <p>Compromiso con la calidad en todos los procesos educativos.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill me-3" style="color: var(--dorado); font-size: 1.5rem;"></i>
                                <div>
                                    <h5>Respeto y Tolerancia</h5>
                                    <p>Valoración de la diversidad y dignidad de cada persona.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill me-3" style="color: var(--dorado); font-size: 1.5rem;"></i>
                                <div>
                                    <h5>Responsabilidad</h5>
                                    <p>Formación de ciudadanos comprometidos con su entorno.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-check-circle-fill me-3" style="color: var(--dorado); font-size: 1.5rem;"></i>
                                <div>
                                    <h5>Innovación</h5>
                                    <p>Incorporación de tecnología y metodologías modernas.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-4 mb-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="bi bi-award-fill" style="font-size: 3rem; color: var(--vinotinto-oscuro);"></i>
                    <h4 class="mt-3">Acreditación</h4>
                    <p>Institución acreditada con los más altos estándares de calidad educativa.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="bi bi-people-fill" style="font-size: 3rem; color: var(--vinotinto-oscuro);"></i>
                    <h4 class="mt-3">Comunidad</h4>
                    <p>Más de 500 estudiantes y 50 docentes comprometidos con la excelencia.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="bi bi-graph-up-arrow" style="font-size: 3rem; color: var(--vinotinto-oscuro);"></i>
                    <h4 class="mt-3">Resultados</h4>
                    <p>Altos índices de ingreso a universidades y desarrollo profesional.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
