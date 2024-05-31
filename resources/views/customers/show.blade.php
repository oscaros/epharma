@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $customer->FirstName }} {{ $customer->LastName }}</h1>
    <p>Email: {{ $customer->Email }}</p>
    <p>Phone: {{ $customer->Phone }}</p>
    <p>Address: {{ $customer->Address }}</p>
    <p>NIN: {{ $customer->NIN }}</p>

    @if($customer->qr_code_path)
        <div>
            <h3>QR Code:</h3>
            <img src="{{ asset('storage/' . $customer->qr_code_path) }}" alt="QR Code">
        </div>
    @endif
</div>
@endsection
