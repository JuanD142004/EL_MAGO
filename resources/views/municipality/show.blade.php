@extends('layouts.app')

@section('template_title')
    {{ $municipality->name ?? __('Show') . " " . __('Municipality') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Municipality</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('municipality.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Name:</strong>
                            {{ $municipality->name }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Departaments Id:</strong>
                            {{ $municipality->departaments_id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Enabled:</strong>
                            {{ $municipality->enabled }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
