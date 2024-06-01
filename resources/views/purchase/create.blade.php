@extends('layouts.app')

@section('template_title')
{{ __('Create') }} Purchase
@endsection

@section('content')
<br>
<section class="content container-fluid">
    <div class="row">
        <div >
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Create Purchase') }}</span>
                </div>
                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('purchase.store') }}" role="form" enctype="multipart/form-data">
                        @csrf

                        {{-- Formulario de compra --}}
                        @include('purchase.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection