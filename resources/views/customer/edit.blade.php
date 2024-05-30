@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Customer
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center"> <!-- Modificado aquí -->
                            <span class="card-title">{{ __('Editar') }} Cliente</span>
                            <div>
                                <a href="{{ url()->previous() }}" class="btn btn-default btn-sm" style="background-color: #007bff; color: #fff;"><i class="fas fa-arrow-left"></i> {{ __('Atrás') }}</a>
                            </div>
                        </div> <!-- Modificado aquí -->
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('customer.update', $customer->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            {{-- Include the customer form and pass the $routes variable --}}
                            @include('customer.form', ['routes' => $routes, 'selectedRoute' => $customer->route_id])

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection