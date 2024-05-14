@extends('layouts.app')

@section('template_title')
    {{ $employee->name ?? __('Show') . " " . __('Employee') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Employee</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('employee.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Users Id:</strong>
                            {{ $employee->users_id }}
                        </div>
                        <div class="form-group">
                            <strong>Gender:</strong>
                            {{ $employee->gender }}
                        </div>
                        <div class="form-group">
                            <strong>Civil Status:</strong>
                            {{ $employee->civil_status }}
                        </div>
                        <div class="form-group">
                            <strong>Routes Id:</strong>
                            {{ $employee->routes_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
