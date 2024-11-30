@extends('layouts.main')

@section('title', 'Lawyers')

@section('custom-styles')
    <link rel="stylesheet" href="{{ asset('css/lawyer.css') }}">
@endsection

@section('content')
<div class="containerLawyer">
    @foreach ($lawyers as $l)
    <div>
        {{$l->appointments_avg_rating}}
    </div>
    @endforeach
</div>


@endsection
