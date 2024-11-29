@extends('layouts.main')

@section('title', 'Home')
    
@section('content')
  @if (Auth::guard('lawyer')->check())
    <h1>LAWYER YG LOGIN</h1>
  @else
    <h1>USER YG LOGIN</h1>
  @endif
  
  {{-- <form method="POST" action="{{ route('logout') }}">
  @csrf
  <div class="d-grid my-3">
      <button class="btn btn-dark btn-lg" type="submit">Logout</button>
  </div>
  </form> --}}
@endsection