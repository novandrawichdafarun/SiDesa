@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @if (auth()->user()->role_id == 1)
            {{-- ======================= TAMPILAN ADMIN ======================= --}}
            @include('pages.dashboard.admin')
        @elseif (auth()->user()->role_id == 4)
            {{-- ======================= TAMPILAN RT/RW ======================= --}}
            @include('pages.dashboard.rt-rw')
        @elseif (auth()->user()->role_id == 3)
            {{-- ======================= TAMPILAN KADES ======================= --}}
            @include('pages.dashboard.kades')
        @else
            {{-- ======================= TAMPILAN WARGA (USER) ======================= --}}
            @include('pages.dashboard.penduduk')
        @endif
    </div>
@endsection
