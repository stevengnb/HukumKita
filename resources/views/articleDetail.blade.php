@extends('layouts.main')

@section('title', 'Detail Article')

@section('content')
    <div style="display: flex; flex-direction: column;">
        <img src={{asset($article->imagePath)}} alt="Image" style="width:100%; height:48rem;" >
        <h1>{{$article->title}}</h1>
        <p>
            {{$article->description}}
        </p>
    </div>
@endsection