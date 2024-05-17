@extends('layouts.app')

@section('template_title')
    {{ $load->name ?? __('Show') . " " . __('Load') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Load</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('loads.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Date:</strong>
                            {{ $load->date }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Routes Id:</strong>
                            {{ $load->routes_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Truck Types Id:</strong>
                            {{ $load->truck_types_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
