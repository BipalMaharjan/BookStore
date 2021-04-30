@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Books</h2>
            </div>
            <div class="pull-right">
                @can('book-create')
                <a class="btn btn-success" href="{{ route('books.create') }}"> Create New Book</a>
                @endcan
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
            <th>No</th>
            <th>Image</th>
            <th>Name</th>
            <th>Author</th>
            <th>Price</th>
            <th>Country</th>
            {{-- <th>Status</th> --}}
            <th>Seller_name</th>
            <th>Genre</th>
            <th>Description</th>
            <th>Action</th>
        </thead>
        <tbody>
        <?php $no = 1; ?>
	    @foreach ($Books as $Book)
	    <tr>
	        {{-- <td>{{ ++$i }}</td> --}}

            <td>{{ $no }}</td>
            <?php $no++; ?>
            <td><img src="/storage/{{ $Book->image }}" width="80px" height="80px"></td>
	        <td>{{ $Book->name }}</td>
	        <td>{{ $Book->author }}</td>
            <td>${{ $Book->price }}</td>
            <td>
            @foreach ($Book->countries as $country)
            <label class="badge badge-info"> {{ $country->countryname}}</label>
            @endforeach
            </td>
            {{-- <td>{{ $Book->status }}</td> --}}

            <td>{{ $Book->seller->user->name}}</td>
            <td>
                @foreach ($Book->genres as $genre)
                <label class="badge badge-info">{{ $genre->genre}}</label>
                @endforeach
            </td>
            <td>{{ $Book->description }}</td>
	        <td>

                    <a class="btn btn-info" href="{{ route('books.show',$Book->id) }}">Show</a>
                    @can('book-edit')
                    <a class="btn btn-primary" href="{{ route('books.edit',$Book->id) }}">Edit</a>
                    @endcan

                    <form action="{{ route('books.destroy',$Book->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @can('book-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
        </tbody>
    </table>




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
