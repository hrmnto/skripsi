<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Dashboard">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Admin | Dashboard</title>
    
    <link href="/css/dashboard.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


    <style>

        
      body{
      background-image: url('/img/playstation-pattern.webp');
    }
    </style>
  </head>
  <body>
    
@include("adminDash.layouts.header")

<div class="container-fluid">
  <div class="row">
@include("adminDash.layouts.sidebar")

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
@yield("container")
    </main>
  </div>
</div>

<!-- choose one -->
{{-- <script src="https://unpkg.com/feather-icons"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="/js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <script>
  </body>
</html>
