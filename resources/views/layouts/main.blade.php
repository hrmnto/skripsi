<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tracer Study | Pendidikan Komputer</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    {{-- AOS --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    {{-- Animate CSS --}}
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
    

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

        {{-- Plugin Path --}}
        {{-- <link rel="stylesheet" href="/css/leaflet-measure-path.css">
        <script src="/js/leaflet-measure-path.js"></script> --}}
        {{-- <script src="https://elfalem.github.io/Leaflet.curve/src/leaflet.curve.js"></script> --}}

        {{-- polyline --}}
        {{-- <link rel="stylesheet" href="https://ppete2.github.io/Leaflet.PolylineMeasure/Leaflet.PolylineMeasure.css" />
        <script src="https://ppete2.github.io/Leaflet.PolylineMeasure/Leaflet.PolylineMeasure.js"></script> --}}

        
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        
        {{-- cluster --}}
        <link rel="stylesheet" href="js/Leaflet.markercluster/dist/MarkerCluster.css" />
        <link rel="stylesheet" href="/js/Leaflet.markercluster/dist/MarkerCluster.Default.css" />
        <script src="/js/Leaflet.markercluster/dist/leaflet.markercluster-src.js"></script>
        <link rel="stylesheet" href="/js/treeLayer/L.Control.Layers.Tree.css">
        <script src="/js/treeLayer/L.Control.Layers.Tree.js"></script>
        {{-- Slide --}}
        <link rel="stylesheet" href="/css/L.Control.SlideMenu.css">
        <script src="/js/L.Control.SlideMenu.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
          {{-- routing machine --}}
          <link rel="stylesheet" href="/js/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
          <script src="/js/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

          
          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
          <script>
            import Swal from 'sweetalert2'

            const Swal = require('sweetalert2')
          </script>

{{-- particle js --}}
  <link rel="stylesheet" media="screen" href="css/style.css">
  </head>
  <body>
    <style>
      
      *{
        font-family: 'Manrope', sans-serif;
      }


      #loader{
        position: fixed;
        height: 100vh;
        width: 100vw;
        background: #ffffffc1;
        z-index: 99999;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .waviy {
        position: relative;
      }
      .waviy span {
        position: relative;
        display: inline-block;
        font-size: 40px;
        color: #ff9800;
        animation: flip 3s infinite;
        animation-delay: calc(.1s * var(--i))
      }
      @keyframes flip {
        0%,80% {
          transform: rotateY(360deg) 
        }
      }


    </style>

    <div id="loader">
      <div class="waviy">
        <span style="--i:1">T</span>
        <span style="--i:2">r</span>
        <span style="--i:3">a</span>
        <span style="--i:4">c</span>
        <span style="--i:5">e</span>
        <span style="--i:6">r</span>
        <span style="--i:7">-</span>
        <span style="--i:8">S</span>
        <span style="--i:9">t</span>
        <span style="--i:10">u</span>
        <span style="--i:11">d</span>
        <span style="--i:12">y</span>
       </div>
    </div>

    @include("partials.navbar")
    <div>
        @yield("container")
    </div>


    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

    <script src="js/particles.js"></script>
  <script src="js/app.js"></script>
    {{-- <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script> 
    <script>
      particlesJS("particles-js", 
      {"particles":{"number":{"value":90,"density":{"enable":true,"value_area":800}},"color":{"value":"#ff9800"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":150,"color":"#5173e1","opacity":0.4,"width":1},"move":{"enable":true,"speed":6,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"window","events":{"onhover":{"enable":true,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});
      
  </script> --}}

  <script>
    let loader = document.getElementById("loader"),
        navbar = document.querySelector(".navbar"),
        linkNav = document.querySelectorAll(".t-nav");

    window.onload = () =>{
      loader.style.display = "none";
    
    }

    window.addEventListener("scroll", () =>{
      if(window.scrollY > 150){
        navbar.style.backgroundColor = "#ffffff95"
        navbar.style.boxShadow = "0 0 3px black"
      }else {
        navbar.style.backgroundColor = "transparent"
        navbar.style.boxShadow = "none"
        
      }
    });
  </script>
  </body>
</html>