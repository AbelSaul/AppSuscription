@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
       <a href="{{url('/suscription/create')}}" class="btn btn-success">Create Suscription</a>
    </div>
    @if(session()->has('success'))
      <div class="alert alert-success">
          {{ session()->get('success') }}
      </div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
              <td>System</td>
              <td>Init Date</td>
              <td>End Date</td>
              <td colspan="2">Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach($suscriptions as $suscription)
            <tr>
                <td>{{$suscription->system->name}}</td>
                <td>{{$suscription->initdate}}</td>
                <td>{{$suscription->enddate}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
<div>
@endsection