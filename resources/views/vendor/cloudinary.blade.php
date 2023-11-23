@extends('vendor.layouts.account')

@section('account')
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                @livewire('cloud-upload')
            </div>
        </div>       
    </div>
@endsection