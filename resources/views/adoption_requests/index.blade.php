@if(auth()->check())
@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 ">
      <div class="card">
        <div class="card-header">Display all Adoption Requests</div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>@sortablelink('Owner ID')</th>
                <th>@sortablelink('Owner Name')</th>
                <th>@sortablelink('Animal ID')</th>
                <th>@sortablelink('Animal Name')</th>
                <th>@sortablelink('State')</th>
                <th colspan="3">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($adoption_requests as $adoption_request)

              @if(auth()->check())
              @if (Auth::User() && Auth::User()->role == '1')
              <tr>
                <td>{{$adoption_request['user_id']}}</td>
                <td>{{$adoption_request['owner_name']}}</td>
                <td>{{$adoption_request['animal_id']}}</td>
                <td>{{$adoption_request['animal_name']}}</td>
                <td>{{$adoption_request['state']}}</td>
                <td><form action="{{ route('accept_adoption', ['id' => $adoption_request['id']]) }}" method="POST">
                  @method('PATCH')
                  @csrf

                  <button class="btn btn-success" type="submit">Accept</button>
                </form></td>

                <td><form action="{{ route('decline_adoption', ['id' => $adoption_request['id']]) }}" method="POST">
                  @method('PATCH')
                  @csrf

                  <button class="btn btn-warning" type="submit">Decline</button>
                </form></td>

                <td>
                  <form action="{{ action([App\Http\Controllers\AdoptionRequestController::class, 'destroy'],
                  ['adoption_request' => $adoption_request['id']]) }}" method="post">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit"> Delete</button>
                  </form>
                </td>
                </tr>

                @else

                @if($adoption_request['user_id'] === Auth::id())

                <tr>
                  <td>{{$adoption_request['user_id']}}</td>
                  <td>{{$adoption_request['owner_name']}}</td>
                  <td>{{$adoption_request['animal_id']}}</td>
                  <td>{{$adoption_request['animal_name']}}</td>
                  <td>{{$adoption_request['state']}}</td>
                </tr>
                @endif
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
