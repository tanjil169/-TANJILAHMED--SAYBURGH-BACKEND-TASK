@extends('layouts.master')

@section('content')


    @if ($message = Session::get('success'))


        <div class=" alert alert-success alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h3 class="alert-heading h4 my-2">Success</h3>
            <p class="mb-0">{{ $message }}</p>
        </div>

    @endif

    <a href="/" class="btn btn-primary mb-2"> <i class="fa fa-home"> Home</i> </a>
    <a href="{{ route('card.create') }}" class="btn btn-primary mb-2"> <i class="fa fa-plus"></i> Add Post</a>
    


    <a class="btn btn-primary mb-2" href="{{ route('logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>


    @csrf
    <div>
        <table class="table table-sm table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Image </th>
                    <th scope="col" class="text-center"> Title </th>
                    <th scope="col" class="text-center"> Description </th>
                    <th scope="col" class="text-center"> Actions </th>
                </tr>
            </thead>
            <tbody>

                @if ($cards)
                    @foreach ($cards as $key => $card)

                        <tr>
                            <th scope="row" class="text-center"> {{ $key + 1 }} </th>
                            <td class="text-center"> <img style="width: 80px; height: 50px; border-radius: 7px;"
                                    src="{{ asset("uploads/image/$card->image") }}" alt=""> </td>
                            <td class="text-center"> {{ $card->title }} </td>

                            <td class="text-center">
                                {{ Str::limit(strip_tags($card->description), 70, $end = '.........') }}</td>
                            <td class="text-center">
                                <a href="" class="btn btn-sm btn-primary d-inline mx-1" data-toggle="modal"
                                    data-target="#editCardModal{{ $card->id }}"> <i class="fa fa-edit"></i> </a>
                                {{-- <a href="{{route('card.destroy', $card->id)}}" class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i> </a> --}}
                                <form class="d-inline" action="{{ route('card.destroy', $card->id) }}" method="POST">
                                    {{-- @csrf --}}
                                    <input name="_method" type="hidden" value="DELETE">
                                    {{ csrf_field() }}
                                    {{-- @method('DELETE') --}}

                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa fa-fw fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="editCardModal{{ $card->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Card </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('card.update', $card->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Edit Title</label>
                                                    <input type="text" class="form-control" name="title"
                                                        value="{{ $card->title }}" placeholder="Enter Title">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlFile1"> Change Image </label>
                                                <input type="file" name="image" class="form-control-file"
                                                    id="exampleFormControlFile1">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Edit Description </label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                    name="description"> {{ $card->description }} </textarea>
                                            </div>



                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    @endforeach

                @else
                    Data not available.

                @endif

            </tbody>
        </table>


    </div>



@endsection
