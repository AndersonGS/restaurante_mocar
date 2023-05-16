@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <h1>Reserva de Mesas</h1> -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Reserva de Mesas</h1>
                </div>

                <div class="card-body">

                <reservar-mesa></reservar-mesa>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
