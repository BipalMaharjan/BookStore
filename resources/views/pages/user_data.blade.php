<div>
    <h3>More Product</h3>
</div>
 <div class="row d-flex">
    @foreach ($book as $Book)
        <div class="col-4 p-2">
            <div class="card ">
                <a href="/detail/{{ $Book['id'] }}">
                    <img class="card-img-top" src="/storage/{{ $Book->image }}" height="200px" width="500px"
                        alt="Card image cap">
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{ $Book->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $Book->author }}</h6>
                    <p class="card-text">{{ $Book->description }}</p>
                    <h6 class="card-text">${{ $Book->price + $Book->seller->commission }}</h6>
                    <form action="{{ route('sales', $Book->id) }}" method="POST">
                        @csrf
                        @can('book-buy')
                            <button onclick="myFunction()" type="submit" class="btn btn-success">Purchase</button>
                        @endcan
                    </form>
                    {{-- <a href="#" class="card-link">Another link</a> --}}
                </div>
            </div>
        </div>
    @endforeach
</div>
{{ $book->links() }}
