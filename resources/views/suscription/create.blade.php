@extends('layouts.app')

@section('content')
<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <br />
@endif

    <!-- {{url('/suscription/create')}} -->
    <form method="POST" action="{{url('/suscription/create')}}"> 
    
        <input type="hidden" value="{{csrf_token()}}" name="_token" />
        <input id='plan' type="hidden"  name="plan" />
        <div class="row">
            <div class="form-group col-sm-3" >
            <h2>System</h2>
                <select class="form-control" id="system_id" name='system_id'>
                    @foreach($systems as $system)
                    <option value="{{$system->id}}">{{$system->name}}</option>
                    @endforeach
                </select>
            </div>

            
            <!--<div class="form-group col-sm-3" >
            <h2>User</h2>
                <select class="form-control" id="user_id" name='user_id'>
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div> -->
        </div>
    

        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Annual plan</h5>
                        <h3>$ 7.5 USD/MONTH</h3>
                        <p class="card-text">A single payment of $90 USD</p>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" name='btn_annual_plan' id='btn_annual_plan' >Suscribe</button>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Monthly Plan</h5>
                        <h3>$ 9 USD/MONTH</h3>
                        <p class="card-text">Access with $9 USD per month</p>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" name='btn_monthly_plan' id='btn_monthly_plan' >Suscribe</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">You are sure to make the purchase ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">
                    Once the purchase is made it is not possible to cancel the subscription
                </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Yes !</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No !</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
   
</div>
<!-- Para poder manipular codigo js desde aqui -->

@push('scripts')
    <script src="{{asset('js/suscriptions.js')}}"></script>
@endpush
@endsection