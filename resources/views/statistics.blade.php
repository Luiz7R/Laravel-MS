<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Statistics</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">    
    <link rel="stylesheet" href="{{ asset('css/stylesHome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>    
    <script type="text/javascript" src="{{ asset('js/chart.js') }}"></script>      
</head>
<body class="bd">
    @include('layouts.navbar')
    <div class="container mh">
        <div class="row mDiv">
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <h5>Sales Report</h5>                           

                        <div>   
                            <canvas id="myChart"></canvas>
                        </div>                          
                    </div>    
                </div>    
            </div>    
        </div>        
    </div> 
    <script>
    
    jsonSales()

    $(function() {
        $('.main-menu').hover(function() {
            $('.container').css('margin-left', '255px');
        }, function() {
            // on mouseout, reset the margin left
            $('.container').css('margin-left', '60px');
        });

    }); 



    function jsonSales()
    {
        var url = '{{ route('jsonSales') }}' 
        
        $.ajax({
            type: 'ajax',
            method: 'get',
            async: false,
            url: url,
            dataType: 'json',
            success: function(data)
            {
                const ctx = document.getElementById('myChart').getContext('2d')

                const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [ data[0].name, data[1].name, data[2].name, data[3].name],
                    datasets: [{
                        label: 'Sales',
                        data:
                        [
                            data[0].salesQuantity,
                            data[1].salesQuantity,
                            data[2].salesQuantity,
                            data[3].salesQuantity
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
                });                
            }
        })

    }

    /*
    if ( sales != "" )
    {
         const ctx = document.getElementById('myChart').getContext('2d')

         const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Balenciaga EX', 'Nike Air Jordan E7', 'Adidas Originals X', 'Puma le Fran', 'Versace Erv', 'Erne 212'],
                datasets: [{
                    label: 'Sales',
                    data:
                    [
                        110,
                        20,
                        30,
                        40,
                        50,
                        10
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    }
*/    

        // const labels = [
        //     'January',
        //     'February',
        //     'March',
        //     'April',
        //     'May',
        //     'June',
        //     'July',
        // ];

        // const data = {
        //     labels: labels,
        //     datasets: [{
        //     label: 'Sales 2021',
        //     backgroundColor: 'rgb(99, 255, 125)',
        //     borderColor: 'rgb(99, 255, 125)',
        //     data: [120, 130, 125, 130, 135, 135, 130],
        //     }]
        // };

        // const config = {
        //     type: 'line',
        //     data: data,
        //     options: {}
        // };

        // const myChart = new Chart(
        //     document.getElementById('myChart'),
        //     config
        // ); 

    </script>

</body>
</html>