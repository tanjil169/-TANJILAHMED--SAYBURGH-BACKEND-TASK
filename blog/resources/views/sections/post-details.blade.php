@extends('layouts.master')

@section('content')

@if ($post)

<h2 class="text-center mb-3 "> {{$post->title}} </h2>
<div class="text-center mb-3">
    <img src="{{asset("uploads/image/$post->image")}}" style="height:200px; width:350px; " alt="" >
</div>

<div class="text-center  mb-3">
    <p> {{ $post->description }} </p>
</div>

    
@else

<p> Something  wrong !! </p>
    
@endif
@endsection