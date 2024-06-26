<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!--
    //Uso del framework de css "TAILWINDCSS"
    <script src="https://cdn.tailwindcss.com"></script>
    -->

    <link rel="stylesheet" href="../resources/css/app.css">

    <!-- favicon -->
    <!-- estilos -->
    <style>
        .active{
            color: white;
            font-weight: bold;
        }
    </style>
</head>



<body>
    
    <!-- header -->
    @include('layouts.partials.header')




    <!-- nav -->

    @yield('content')



    <!-- footer -->
    @include('layouts.partials.footer')


    
    <!-- script -->
</body>
</html>