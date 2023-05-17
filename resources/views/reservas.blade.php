@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Lista de Reservas</h1>
                </div>

                <div class="card-body">

                <listar-reservas></listar-reservas>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
