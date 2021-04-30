@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit books</h2>
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


    <form action="{{ route('books.update',$book->id) }}" method="POST">
    	@csrf
        @method('PUT')


        <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>
		            <input type="text" name="name" value="{{ $book->name }}" class="form-control" >
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Choose image</strong>
                <input type="file" name="file" value="{{ $book->file }}">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Author:</strong>
                    <input type="text" name="author" value="{{ $book->author }}" class="form-control" >
		        </div>
		    </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Price:</strong>
                    <input type="number" name="price" value="{{ $book->price }}" class="form-control" placeholder="price">
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
            {{-- <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Description:</strong>
                    <textarea type="text" name="description" value="{{ $book->description }}" class="form-control" ></textarea>
		        </div>
		    </div> --}}
            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Description:</strong>
                    <input type="text" name="description" value="{{ $book->description }}" class="form-control" >
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



		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>


@endsection
