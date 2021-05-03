@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 ">
      <div class="card">
        <div class="card-header">Display all animals</div>
        <div class="card-body">
          <table class="table table-striped" border="1" >
              <tr> <td> <b>Name</th> <td> {{$animal['name']}}</td></tr>
              <tr> <th>Availability </th> <td>{{$animal->available}}</td></tr>
              <tr> <th>Animal Species</th> <td>{{$animal->species}}</td></tr>
              <tr> <td>DOB</th> <td>{{$animal->DOB}}</td></tr>
              <tr> <th>Notes </th> <td style="max-width:150px;" >{{$animal->description}}</td></tr>
              <tr> <td colspan='2' ><img style="width:100%;height:100%"
                src="{{ asset('storage/images/'.$animal->image)}}"></td></tr>
          </table>
          <table><tr>
            <td><a href="{{route('animals.index')}}" class="btn btn-primary" role="button">Back to the list</a></td>

            @if(auth()->check())
              @if (Auth::User() && Auth::User()->role == '0')
                @if ($animal->userid !== null)
                @else
                <td><form action="{{ route('request_adoption', ['id' => $animal['id']]) }}" method="POST">
                  @method('PATCH')
                  @csrf
                  <button class="btn btn-success" type="submit">Adopt</button>
                </form></td>
                @endif
              @endif
            @endif

            @if(auth()->check())
              @if (Auth::User() && Auth::User()->role == '1')
                <td><a href="{{ route('animals.edit', ['animal' => $animal['id']]) }}" class="btn btn-info">Edit</a></td>
                <td><form action="{{ route('animals.destroy', ['animal' => $animal['id']]) }}" method="post"> @csrf
                  <input name="_method" type="hidden" value="DELETE">
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form></td>
              @endif
            @endif

          </tr></table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
