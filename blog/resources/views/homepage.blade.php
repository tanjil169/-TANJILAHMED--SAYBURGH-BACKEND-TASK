@extends('layouts.master')

@section('content')

    <div class="col-md-12 mb-3  d-flex justify-content-center">
        <a href="/" class="btn btn-primary m-2"> <i class="fa fa-home"></i> Home</a>
        <a href="{{ route('card.index') }}" class="btn btn-primary m-2"> <i class="fas fa-cog fa-spin"></i> Manage
            Blog</a>

    </div>


    <div class="col-md-12 row d-flex justify-content-center">


        @if ($cards)
            @foreach ($cards as $card)
                <div class="col-md-4 m-2 ">
                    <div class="card " style="width: 100%; height: 350px;">
                        <img class="card-img-top" src="{{ asset("uploads/image/$card->image") }}"
                            style="width:100%; height:158px;" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $card->title }}</h5>
                            <p class="card-text"> {{ Str::limit(strip_tags($card->description), 70, $end = '.........') }}
                            </p>
                            <a href="{{route('post.details', $card->id )}}" class="btn btn-primary float-right">Read More</a>
                        </div>
                    </div>
                </div>

            @endforeach

        @else

        @endif

    </div>

@endsection
