<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home </a>
                    </li>
                </ul>

            </div>
            <ul class="navbar-nav ml-auto">
                @guest
                <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Profile
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">User: {{ auth()->user()->name }}</a>
                        @can('book-buy')
                        <a class="dropdown-item" href="/history">History</a>
                        @endcan
                        @can('book-create')
                        <a class="dropdown-item" href="/home">panel</a>
                        @endcan
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/logout">Logout</a>
                    </div>
                </li>
                @endguest

            </ul>

        </div>
    </nav>

<div class="container">
<div class="col-sm-10">
    <div class="card" >
        <div class="mx-auto">
        <a href="/detail/{{ $book['id'] }}">
        <img class="card-img-top" src="/storage/{{ $book->image }}"alt="Card image cap">
        </a>
        <div class="card-body">
            <h5 class="card-title">{{ $book->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $book->author }}</h6>
            <p class="card-text">{{ $book->description }}</p>
            <h6 class="card-text">${{ $book->price }}</h6>
            <form action="{{ route('sales', $book->id) }}" method="POST">
                @csrf
                @can('book-buy')
                @if(!$filterBook->has($book->id))
                <button onclick="Redirect();"  class="btn btn-success" >Purchase</button>
                @endif
                @endcan
            </form>
            {{-- <a href="#" class="card-link">Another link</a> --}}
        </div>
    </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script type = "text/javascript">
function Redirect(e){
    // alert("your purchase was successful");
    // var url = "http://www.(url).com";
    e.preventDefault();
    window.location = "https://www.tutorialspoint.com";
}
</script>
</body>
</html>
