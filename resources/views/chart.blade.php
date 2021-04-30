<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
<div>
        <h1>Sales</h1>
    </div>
    <section>
    <div class="container">
        <div class="card col">
                <div class="form form-group">
                    <select class="form-control">
                        <option value="daily">Daily</option>
                        <option value="weekly" selected >Weekly</option>
                        <option value="monthly">Monthly</option>
                    </select>
                </div>
                <div class="col card-body myChart"></div>
            </div>

        </div>
        </div>
    </section>
</body>

    <script>
        $(document).ready(function(){
            loadDailyData();
        $('select').on('change', function() {
            let reportType = $(this).val();
            switch (reportType) {
                case "daily":
                    loadDailyData();
                    break;
                case "weekly":
                loadWeeklyData();
                    break;
                case "monthly":
                loadMonthlyData();
                    break;
                default:
                console.log('default');
                $('#myChart').remove();
                    break;
            }
    });

        function loadDailyData() {
            $.ajax({
                type: "GET",
                url: '/daily',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(dataResult) {
                    console.log(dataResult);
                    render(dataResult[0],dataResult[1]);



                }
            });
        }

        function loadWeeklyData() {
            $.ajax({
                type: "GET",
                url: '/weekly',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(dataResult) {

                    render(dataResult[0],dataResult[1]);

                }
            });
        }

        function loadMonthlyData() {
            $.ajax({
                type: "GET",
                url: '/monthly',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(dataResult) {

                    render(dataResult[0],dataResult[1]);
                }
            });
        }

          function render(currentBookSold,currentBookClicked) {

            $('#myChart').remove();
            $('.myChart').append('<canvas id="myChart" width="500" height="200"></canvas>');
            let bookSalesDate = [];
                let bookSold = [];
                let bookClicked = [];

                for (var key in currentBookSold) {
                    if (currentBookSold.hasOwnProperty(key)) {
                        bookSalesDate.push(key);
                        bookSold.push(currentBookSold[key]);
                        bookClicked.push(currentBookClicked[key]);
                    }
                }
                let lineChartData = {
                    labels: bookSalesDate,
                    datasets: [
                        {
                            label: "Sold",
                            data: bookSold,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: "Clicked",
                            data: bookClicked,
                            backgroundColor: 'rgba(235, 162, 54, 0.2)',
                            borderColor: 'rgba(235, 162, 54, 1)',
                            borderWidth: 1
                        }
                    ]
                };
                let lineChartOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                };
                    let ctx = document.getElementById('myChart').getContext('2d');
                    let myChart = new Chart(ctx, {
                    type: 'line',
                    data: lineChartData,
                    options: lineChartOptions
                });
        }

        });
    </script>


    {{-- <script>
        let myChart = document.getElementById('myChart').getContext('2d');
        let massPopChart = new Chart(myChart, {
            type:'bar',
            data:{
                labels:['Kathmandu','Lalitput','Bahaktapur','Pokhara'],
                datasets:[{
                    label:'Population',
                    data:[
                        200000,
                        94422,
                        18331,
                    	182324,
                    ],
                    backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
            ],
            borderWidth: 1
                }],
            },
            option:{}
        })
    </script> --}}

</html>
