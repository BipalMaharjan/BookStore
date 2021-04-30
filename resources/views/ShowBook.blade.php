<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Book Store</title>
</head>

<body>
    {{-- navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home </a>
                    </li>
                </ul>
                {{-- <div class="container box">
                    <div class="panel panel-default">
                      <div class="form-group">
                       <input type="text" name="search" id="search" class="form-control" placeholder="Search Customer Data" />
                     </div>
                    </div>
                </div> --}}
                <form action="/search" class="navbar-form navbar-left">
                <div>
                    <input type="text" class="form-control search-box">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
                </form>
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
    {{-- {{ route('bookshow') }} --}}
    <div class="container">
        <div class="row ">
            <h3>Top Selling</h3>
        </div>
        <div class="row">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($data as $Book)
                        <div class="carousel-item {{ $loop->iteration == 1 ? 'active' : '' }}">
                            <a href="/detail/{{ $Book['book_id'] }}">
                            <img class="d-block " width="1080px" height="500px" src="/storage/{{ $Book->book->image }}" height="660px" width=""
                                alt="First slide">
                            </a>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>

            </div>

        </div>

        <div id="user_data">
            @include('pages.user_data')
        </div>

    </div>
    {{-- table --}}



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script>
        function myFunction() {
            alert("your purchase was successful");
        }

    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click','.pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page')[1];
            getMoreUsers(page);
        });
        });

        function getMoreUsers(page){
            $.ajax({
                type:"GET",
                url: "{{ route('more-books') }}"+"?page"+page,
                success:function(data){
                    $('#user_data').html(data);
                }
            });
        }
    </script>
</body>


</html>
