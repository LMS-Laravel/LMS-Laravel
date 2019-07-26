@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="card" style="text-align: center">
                <div class="card-header" sty>Usuarios</div>
                <div class="card-body"><div style="font-size: 50px;">{{ $totalUsers }}</div></div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bienvenido {{ auth()->user()->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>
                        Esta plataforma nace para apoyar a todas aquellas personas que estan aprendiendo Laravel y/o aquellas que quieren aprender conceptos avanzados de desarrollo,
                        para lograr dicho objetivo estaremos construyendo un proyecto open-source llamado LMS-Laravel, durante el transcurso del desarrollo estaremos aprendiendo los siguientes conceptos:
                    </p>
                    <ul>
                        <li>Principio SOLID</li>
                        <li>Principio DRY : Don't repeat yourself</li>
                        <li>Patron Repositorio</li>
                        <li>Patron Estrategia</li>
                        <li>Arquitectura Limpia</li>
                        <li>Pruebas Unitarias</li>
                        <li>Desarrollo basado en contratos</li>
                        <li>Principio "Object Parameter"</li>
                        <li>Git Flow & Feature Flags</li>
                        <li>Desarrollo Modular</li>
                    </ul>

                    <p>La metodologia de trabajo sera muy simple, se realizaran talleres via streaming de Lunes a Sabado, la duracion de cada taller sera de 2 horas hasta tener una version 1.0 del LMS.</p>
                    <p>Este sitio web se ira actualizando a medida que el LMS se vaya desarrollando, la idea principal es convertir esta experiencia en un laboratio real en donde se vayan viendo los resultados del dia a dia y que todos podamos aportar para el desarrollo del LMS.</p>
                    <p>A cada usuario internamente se le asiganara un codigo de seguridad, esto con el fin de que solo los usuarios registrados puedan ver los streaming y mas adelante solo se podra mantener una sesion abierta por dispositvo.</p>
                    <p>SOLICITUD: Estoy tratando de brindar una experiencia educativa diferente a lo que regularmente se hace asi que espero poder contar con tu apoyo a la hora de difundir esta idea.</p>
                    <p>Si quieres realizar una donacion para apoyar el sitio web y su contenido no dudes en escribirme a <a href="mailto:akurten@angelkurten.com">akurten@angelkurten.com</a></p>
                    <h1>Fecha inicio: 01-Agosto-2019</h1>
                </div>
                <div class="fb-comments" data-href="{{ Request::url()}}" data-order-by="social" data-width="100%" data-numposts="10"></div>
            </div>
        </div>
    </div>
</div>
@endsection
