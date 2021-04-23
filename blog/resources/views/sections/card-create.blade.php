@extends('layouts.master')

@section('content')

    <form action="{{ route('card.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                    placeholder="Enter Title">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group col-md-6 px-0">
            <label for="exampleFormControlFile1">Image </label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                id="exampleFormControlFile1">
            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1"> Description </label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="exampleFormControlTextarea1"
                rows="3" name="description"></textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>



        <button type="submit" class="btn btn-primary"> Create </button>
    </form>

@endsection
