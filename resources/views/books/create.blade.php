@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New books</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('books.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
    	@csrf
         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>
		            <input type="text" name="name" class="form-control" placeholder="Name">
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Choose image</strong>
                <input type="file" name="file">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Author:</strong>
                    <input type="text" name="author" class="form-control" placeholder="author">
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Price:</strong>
                    <input type="number" name="price" class="form-control" placeholder="price">
		        </div>
		    </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Genre:</strong>
                    <div>
                  <select multiple name="genre[]">
                      @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->genre }}</option>
                  </div>
                      @endforeach
                  </select>
		        </div>
		    </div>


            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Description:</strong>
                    <textarea type="text" name="description" class="form-control" placeholder="description"></textarea>
		        </div>
		    </div>
            @if(auth()->user()->hasRole('Admin'))
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Seller:</strong>
                  <select name="seller_id" id="">
                      @foreach ($sellers as $seller)
                    <option value="{{ $seller->id }}">{{ $seller->user->name }}</option>
                      @endforeach
                  </select>
		        </div>
		    </div>
            @else
            <input type="hidden" name="seller_id" value="{{ $sellerId }}">
            @endif

            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Country:</strong>
                    <div>
                  <select multiple name="country[]">
                      @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->countryname }}</option>
                    <div>
                      @endforeach
                  </select>
		        </div>
		    </div>


            {{-- <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Seller_id:</strong>
		            <textarea class="form-control" name="seller_id" placeholder="seller_id"></textarea>
		        </div>
		    </div> --}}
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>


@endsection
