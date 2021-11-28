@extends('layout')

@section('cdns')
@endsection


@section('content')
    <section>
        <div class="index-container">
            <h1>BIENVENIDO</h1>   
            <ul id="titulo-clinica">
                <h1>Clinica Riobam</h1>
            </ul> 
            <div class="icons">
                <i class="fas fa-user-md"></i>
                <i class="fas fa-hospital-alt"></i>
                <i class="fas fa-heartbeat"></i>
            </div>
            <a class="btn btn-info" href="{{ route('login') }}" role="button">Ingresar al sistema</a>
        </div>
    </section>
@endsection
