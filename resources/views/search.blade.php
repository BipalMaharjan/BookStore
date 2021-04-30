


<!DOCTYPE html>
<html>
 <head>
  <title>Live search in laravel using AJAX</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
 <div class="container">
     <input type="text" name="q" class="form-control">
     <div class="card">
         <div class="card-header">Search Result</div>
         <div class="list-group list-group-flush search-result">
             {{-- <li class="list-group-item">Task-1</li>
             <li class="list-group-item">Task-2</li>
             <li class="list-group-item">Task-3</li> --}}
         </div>
     </div>
 </div>


<script>
$(document).ready(function(){
    $('.search-input').on('keyup',function(){
        var _q=$(this).val();
        if(_q.length>=2){
            $.ajax({
                url:"{{ url('search') }}",
                data:{
                    q:_q
                },
                dataType:'json',
                beforeSend:function(){
                    $('.search-result').html('<li class="list-group-item">Loading..</li>');
                },
                success:function(res){
                    console.log(res);
                }
            });
        }
    });

});
</script>

</body>
</html>
