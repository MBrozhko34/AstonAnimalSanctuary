@if(auth()->check())
@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 ">
      <div class="card">
        <div class="card-header">Display all Animals</div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>@sortablelink('Owner')</th>
                <th>@sortablelink('Animal_ID')</th>
                <th>@sortablelink('Name')</th>
                <th>@sortablelink('Availability')</th>
                <th>@sortablelink('Species')</th>
                <th>@sortablelink('DOB')</th>
                <th colspan="3">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($animals as $animal)

              @if(auth()->check())
              @if (Auth::User() && Auth::User()->role == '0')
              @if ($animal['userid'] === Auth::id() or $animal['userid'] === null)
              <tr>
                <td>{{$animal['userid']}}</td>
                <td>{{$animal['id']}}</td>
                <td>{{$animal['name']}}</td>
                <td>{{$animal['available']}}</td>
                <td>{{$animal['species']}}</td>
                <td>{{$animal['DOB']}}</td>
                <td><a href="{{route('animals.show', ['animal' => $animal['id'] ] )}}" class="btn btn-primary">Details</a></td>
              </tr>
              @endif

              @else
              <tr>
                <td>{{$animal['userid']}}</td>
                <td>{{$animal['id']}}</td>
                <td>{{$animal['name']}}</td>
                <td>{{$animal['available']}}</td>
                <td>{{$animal['species']}}</td>
                <td>{{$animal['DOB']}}</td>
                <td><a href="{{route('animals.show', ['animal' => $animal['id'] ] )}}" class="btn btn-primary">Details</a></td>
                <td><a href="{{ route('animals.edit', ['animal' => $animal['id']]) }}" class="btn btn-warning">Edit</a></td>
                <td>
                  <form action="{{ action([App\Http\Controllers\AnimalController::class, 'destroy'],
                  ['animal' => $animal['id']]) }}" method="post">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit"> Delete</button>
                  </form>
                </td>
              </tr>
              @endif
              @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@endif
