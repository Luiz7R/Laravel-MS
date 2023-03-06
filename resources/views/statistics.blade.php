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
                        <div class="center-loading" style="display: none;">
                            <div class="triple-spinner"></div>
                        </div>
                        <div>   
                            <canvas id="myChart"></canvas>
                        </div>                          
                    </div>    
                </div>    
            </div>    
        </div>        
    </div> 
    <script>

    const loading = () => {
        $('.center-loading')[0].style.display = $('.center-loading')[0].style.display === 'none' ? 'flex': 'none';
    }

    getProductSales()

    $(function() {
        $('.main-menu').hover(function() {
            $('.container').css('margin-left', '255px');
        }, function() {
            // on mouseout, reset the margin left
            $('.container').css('margin-left', '60px');
        });

    }); 

    function getProductSales()
    {
        var url = '{{ route('getProductSales') }}' 
        loading();
        
        $.ajax({
            type: 'ajax',
            method: 'get',
            async: false,
            url: url,
            dataType: 'json',
            success: function(data)
            {
                const ctx = document.getElementById('myChart').getContext('2d')

                console.log(data)
                productNames = data.map(product => {
                    return product.name
                })
 
                productSales = data.map(product => {
                    return product.sales
                })

                const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: productNames,
                    datasets: [{
                        label: 'Sales',
                        data: productSales,
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
        }).done(function() {
            loading();
        })
    }
 </script>

</body>
</html>