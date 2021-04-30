@extends('layouts.admin')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Seller Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('sellers.create') }}"> Create New User</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered" id="table_id">
    <thead>
      {{-- <th>No</th> --}}
      <th>Name</th>
      <th>Email</th>
      <th>Shop Name</th>
      <th>country Code</th>
      <th>Commision</th>
      <th>Status</th>
      <th width="280px">Action</th>
    </thead>
    <tbody>
    @foreach ($data as $key => $user)

       <td>{{ $user->user->name }}</td>
       <td>{{ $user->user->email }}</td>
       <td>{{ $user->shop_name }}</td>
       <td>{{ $user->countrycode }}</td>
       <td>{{ $user->commission }}</td>
       {{-- <td>
         @if(!empty($user->getRoleNames()))
           @foreach($user->getRoleNames() as $v)
              <label class="badge badge-success">{{ $v }}</label>
           @endforeach
         @endif
       </td> --}}
       <td>
           @if (!$user->is_active)
               <form action="{{ route('sellers.activate',$user->id) }}" method="POST">
            @csrf
        <button class="btn btn-info " style="display: inline;"> Activate</button>
        </form>
           @else
           Activated
           @endif
       <td>
          <a class="btn btn-info" href="{{ route('sellers.show',$user->id) }}">Show</a>
          {{-- <a class="btn btn-primary" href="{{ route('sellers.edit',$user->id) }}">Edit</a> --}}
           {!! Form::open(['method' => 'DELETE','route' => ['sellers.destroy', $user->id],'style'=>'display:inline']) !!}
               {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
           {!! Form::close() !!}
       </td>
     </tr>
    @endforeach
    </tbody>
   </table>

{{--
{!! $data->render() !!} --}}


@endsection
@section('tail')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
        $('#table_id').DataTable(
            {
    	"search":true
    }
        );
    } );
    </script>


@endsection
