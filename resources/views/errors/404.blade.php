@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-11 mx-auto">
                <section class="edica-404">
                    <h1 class="page-title aos-init aos-animate" data-aos="fade-up">404</h1>
                    <h5 class="edica-404-subtitle aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">Страница не найдена!</h5>
                    <p class="edics-404-text aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">Упс! Страница, которую вы ищете, не существует. Возможно, она была перемещена или удалена.</p>
                    <a href="{{ route('post.index') }}" class="edica-404-link btn btn-warning aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">Назад</a>
                </section>
            </div>
        </div>
    </div>
@endsection
