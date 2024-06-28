<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


<h1 class="h2 text-primary text-center mt-2">Rekap Tracer Study</h1>

              
            
<div class="row px-2">

<div class="col-sm-4 my-5">      
  <h3 class="text-center">Data Kelulusan </h3>     
    <div>
      <canvas id="chartKelulusan"></canvas>
    </div>
    <p class="text-secondary text-center">Total Alumni Mahasiswa Pendidikan Komputer : {{count($biodatas)}} </p>
</div>

<div class="col-sm-4 my-5">      
  <h3 class="text-center">Data Kelulusan Per Angkatan</h3>     
    <div>
      <canvas id="chartKelulusanAngkatan"></canvas>
    </div>
    <p class="text-secondary text-center">Total Alumni Mahasiswa Pendidikan Komputer : {{count($biodatas)}} </p>
</div>

<div class="col-sm-4 my-5">      
  <h3 class="text-center">Lama masa study</h3>     
    <div>
      <canvas id="chartLamaKuliah"></canvas>
    </div>
    <p class="text-secondary text-center">Rata rata lama masa study {{$datas['rata2_kuliah']}} Tahun</p>
</div>

<div class="col-sm-4 my-5">      
  <h3 class="text-center">IPK Alumni </h3>     
    <div>
      <canvas id="chartIPK"></canvas>
    </div>
    <p class="text-secondary text-center">Rata rata IPK alumni : {{$datas['avgIPK']}} </p>
</div>

<div class="col-sm-4 my-5">      
  <h3 class="text-center">Status Pekerjaan</h3>     
    <div>
      <canvas id="chartBekerja"></canvas>
    </div>
    <p class="text-secondary text-center">Jumlah Alumni yang sudah bekerja {{ count($datas["sudahBekerja"]) }}, yang belum bekerja {{count($datas['belumBekerja'])}} </p>
</div>

<div class="col-sm-4 my-5">      
  <h3 class="text-center">Relevansi Pekerjaan</h3>     
    <div>
      <canvas id="chartRelevansi"></canvas>
    </div>
    <p class="text-secondary text-center"> {{($datas['pRelevan'][0])}} relevansi tinggi, {{ ($datas['pRelevan'][1]) }} relevansi sedang dan {{($datas['pRelevan'][2])}} relevansi rendah</p>
</div>



<div class="col-sm-4 my-5">      
  <h3 class="text-center">Gaji Alumni</h3>     
  <div>
    <canvas id="chartGaji"></canvas>
  </div>
  <p class="text-secondary text-center">Rata-rata Gaji Alumni : Rp. {{number_format($datas['avgGaji'],2,",",".")}} </p>
</div>

<div class="col-sm-4 my-5">      
  <h3 class="text-center">Rentang Waktu Mendapatkan Pekerjaan</h3>     
  <div>
    <canvas id="chartRKerja"></canvas>
  </div>
  <p class="text-secondary text-center">Rata-rata Rentang Alumni Mendapatkan Pekerjaan : {{number_format($datas['avgRKerja'],2)}} Tahun</p>
</div>
<div class="col-sm-12 my-5">      
  <h3 class="text-center">Kategori Pekerjaan</h3>     
    <div>
      <canvas id="chartKategori2"></canvas>
    </div>
    <p class="text-secondary text-center">Jumlah Alumni yang sudah bekerja : {{count($datas['sudahBekerja'])}} </p>
</div>



</div>


{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript" src="https://unpkg.com/chartjs-chart-venn@3.6.0/build/index.umd.min.js"></script>

<script>
  const cKelulusan = document.getElementById('chartKelulusan'),
        cKelulusanAkt = document.getElementById('chartKelulusanAngkatan'),
        cBekerja = document.getElementById('chartBekerja'),
        cRelevansi = document.getElementById('chartRelevansi'),
        cKategori = document.getElementById('chartKategori'),
        cKategori2 = document.getElementById('chartKategori2'),
        cGaji = document.getElementById('chartGaji'),
        cRKerja = document.getElementById('chartRKerja'),
        cIPK = document.getElementById('chartIPK'),
        cLamaKuliah = document.getElementById('chartLamaKuliah');

        
  let dataLulus = [{{count($datas['kelulusan_2020'])}}, {{count($datas['kelulusan_2021'])}}, {{count($datas['kelulusan_2022'])}}, {{count($datas['kelulusan_2023'])}}, {{count($datas['kelulusan_2024'])}}, {{count($datas['kelulusan_2025'])}}],
      belumBekerja = {{count($datas['belumBekerja'])}},
      sudahBekerja = {{count($datas['sudahBekerja'])}},
      dataNama = <?= $datas['dataNama']?>
    


  new Chart(cKelulusan, {
    type: 'line',
    data: {
      labels: [2020, 2021, 2022,2023,2024,2025],
      datasets: [{
        label: 'Lulus',
        data: dataLulus,
        borderColor: '#36A2EB',
        borderWidth: 2,
      }]
    },

    options: {
      scales: {
        y: { // defining min and max so hiding the dataset does not change scale range
          beginAtZero: true
        }
      }
    }
  });

  new Chart(cKelulusanAkt, {
    type: 'line',
    data: {
      labels: [2020, 2021, 2022,2023,2024,2025],
      datasets: [
        {
        label: 'Angkatan 2016',
        data: [{{$datas['alumni2016'][0]}},{{$datas['alumni2016'][1]}},{{$datas['alumni2016'][2]}},{{$datas['alumni2016'][3]}},{{$datas['alumni2016'][4]}},{{$datas['alumni2016'][5]}},{{$datas['alumni2016'][6]}},{{$datas['alumni2016'][7]}}],
        borderColor: '#36A2EB',
        borderWidth: 2,
      },
      {
        label: 'Angkatan 2017',
        data: [{{$datas['alumni2017'][0]}},{{$datas['alumni2017'][1]}},{{$datas['alumni2017'][2]}},{{$datas['alumni2017'][3]}},{{$datas['alumni2017'][4]}},{{$datas['alumni2017'][5]}},{{$datas['alumni2017'][6]}},{{$datas['alumni2017'][7]}}],
        borderColor: 'red',
        borderWidth: 2,
      },
      {
        label: 'Angkatan 2018',
        data: [{{$datas['alumni2018'][0]}},{{$datas['alumni2018'][1]}},{{$datas['alumni2018'][2]}},{{$datas['alumni2018'][3]}},{{$datas['alumni2018'][4]}},{{$datas['alumni2018'][5]}},{{$datas['alumni2018'][6]}},{{$datas['alumni2018'][7]}}],
        borderColor: 'blue',
        borderWidth: 2,
      },
      {
        label: 'Angkatan 2019',
        data: [{{$datas['alumni2019'][0]}},{{$datas['alumni2019'][1]}},{{$datas['alumni2019'][2]}},{{$datas['alumni2019'][3]}},{{$datas['alumni2019'][4]}},{{$datas['alumni2019'][5]}},{{$datas['alumni2019'][6]}},{{$datas['alumni2019'][7]}}],
        borderColor: 'purple',
        borderWidth: 2,
      },
      {
        label: 'Angkatan 2020',
        data: [{{$datas['alumni2020'][0]}},{{$datas['alumni2020'][1]}},{{$datas['alumni2020'][2]}},{{$datas['alumni2020'][3]}},{{$datas['alumni2020'][4]}},{{$datas['alumni2020'][5]}},{{$datas['alumni2020'][6]}},{{$datas['alumni2020'][7]}}],
        borderColor: 'pink',
        borderWidth: 2,
      },
      {
        label: 'Angkatan 2021',
        data: [{{$datas['alumni2021'][0]}},{{$datas['alumni2021'][1]}},{{$datas['alumni2021'][2]}},{{$datas['alumni2021'][3]}},{{$datas['alumni2021'][4]}},{{$datas['alumni2021'][5]}},{{$datas['alumni2021'][6]}},{{$datas['alumni2021'][7]}}],
        borderColor: 'brown',
        borderWidth: 2,
      },
      {
        label: 'Angkatan 2022',
        data: [{{$datas['alumni2022'][0]}},{{$datas['alumni2022'][1]}},{{$datas['alumni2022'][2]}},{{$datas['alumni2022'][3]}},{{$datas['alumni2022'][4]}},{{$datas['alumni2022'][5]}},{{$datas['alumni2022'][6]}},{{$datas['alumni2022'][7]}}],
        borderColor: 'magenta',
        borderWidth: 2,
      }

    ]
    },

    options: {
      scales: {
        y: { // defining min and max so hiding the dataset does not change scale range
          beginAtZero: true
        }
      }
    }
  });

  new Chart(cBekerja, {
    type: 'pie',
    data: {
      labels: ["Sudah Bekerja", "Belum Bekerja"],
      datasets: [{
        label: 'Jumlah',
        data: [sudahBekerja, belumBekerja],
        hoverOffset: 4,
        backgroundColor: [
          '#47A992',
          'salmon'
        ],
      }]
    }
  });


  new Chart(cLamaKuliah, {
    type: 'bar',
    data: {
      labels: ["3 ~ 4 Tahun", "5 ~ 6 Tahun", "Lebih Dari 6 Tahun"],
      datasets: [{
        label: 'Alumni',
        data: [{{count($datas['K3tahun'])}}, {{count($datas['K5tahun'])}}, {{count($datas['K6tahun'])}}, ],
        hoverOffset: 4,
        borderWidth:2,
        borderColor: ['#47A992', '#36A2EB', '#B70404']
      }],
    },
    options:{
      scales: {
        y: { // defining min and max so hiding the dataset does not change scale range
          beginAtZero: true
        }
      },
      plugins: {
        legend: {
          display: false
        }
      }
    }
  });

  new Chart(cIPK, {
    type: 'bar',
    data: {
      labels: ["2.4 ~ 2.7", "2.7 ~ 3.0", "3.0 ~ 3.3", "3.3 ~ 3.6", "3.6 ~ 3.9"],
      datasets: [{
        label: 'Alumni',
        data: [{{$datas['ipk'][0]}}, {{$datas['ipk'][1]}}, {{$datas['ipk'][2]}}, {{$datas['ipk'][3]}}, {{$datas['ipk'][4]}} ],
        hoverOffset: 4,
        borderWidth:2,
        borderColor: ['black', 'red', '#DAA520', '#36A2EB','#47A992' ,'#B70404',]
      }],
    },
    options:{
      scales: {
        y: { // defining min and max so hiding the dataset does not change scale range
          beginAtZero: true
        }
      },
      plugins: {
        legend: {
          display: false
        }
      }
    }
  });

  new Chart(cRelevansi, {
    type: 'doughnut',
    data: {
      labels: ["Tinggi", "Sedang", "Rendah"],
      datasets: [{
        label: 'Jumlah',
        data: [{{$datas['pRelevan'][0]}}, {{$datas['pRelevan'][1]}}, {{$datas['pRelevan'][2]}} ],
        hoverOffset: 4,
        borderWidth:2,
        backgroundColor: ['#47A992', 'lightskyblue', 'red']
      }]
    },
  });



  new Chart(cGaji, {
    type: 'bar',
    data: {
      labels: ["1 ~ 3 Juta", "3 ~ 8 Juta", "8 ~ 13 Juta", "13 ~ 18 Juta", "18 ~ 25 Juta", "25 ~ 50 Juta", "50 ~ 100 Juta", "100 ~ 250 Juta", "Lebih dari 250 Juta" ],
      datasets: [{
        label: 'Jumlah',
        data: [{{ $datas['gajiAlumni'][0]}}, {{ $datas['gajiAlumni'][1] }}, {{ $datas['gajiAlumni'][2] }}, {{ $datas['gajiAlumni'][3] }}, {{ $datas['gajiAlumni'][4] }}, {{ $datas['gajiAlumni'][5] }}, {{ $datas['gajiAlumni'][6] }}, {{ $datas['gajiAlumni'][7] }}, {{ $datas['gajiAlumni'][8] }} ],
        hoverOffset: 4,
        borderWidth:2,
        backgroundColor: ['lightblue', '#47A992', 'blue', 'brown', 'red','brown', 'green', 'black', 'salmon']
      }]
    },
    options:{
      scales: {
        y: { // defining min and max so hiding the dataset does not change scale range
          beginAtZero: true
        }
      },
      plugins: {
          legend: {
            display: false
          },
      }
    }
  });

  new Chart(cRKerja, {
    type: 'bar',
    data: {
      labels: ["Kurang Dari 1 Tahun", "1 ~ 2 Tahun", "2 ~ 3 Tahun", "3 ~ 4 Tahun", "4 ~ 5 Tahun", "5 ~ 6 Tahun", "Lebih Dari 6 Tahun" ],
      datasets: [{
        label: 'Jumlah',
        data: [{{ $datas['rentangKerja'][0]}}, {{ $datas['rentangKerja'][1] }}, {{ $datas['rentangKerja'][2] }}, {{ $datas['rentangKerja'][3] }}, {{ $datas['rentangKerja'][4] }}, {{ $datas['rentangKerja'][5] }}, {{ $datas['rentangKerja'][6] }}],
        hoverOffset: 4,
        borderWidth:2,
        backgroundColor: [
        'rgba(255, 26, 104, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(0, 0, 0, 0.2)'
      ]
      }]
    },
    options:{
      scales: {
        y: { // defining min and max so hiding the dataset does not change scale range
          beginAtZero: true
        }
      },
      plugins: {
          legend: {
            display: false
          },
      }
    }
  });

  const config = {
    type: 'venn',
    data: ChartVenn.extractSets(
      [
        
        { label: 'Kependidikan', values: [@foreach ($datas['kategoriPekerjaan1'] as $a)
          {{$a}},
        @endforeach ]},
        { label: 'IT', values: [@foreach ($datas['kategoriPekerjaan2'] as $a)
          {{$a}},
        @endforeach ]},
        { label: 'Wirausaha', values: [@foreach ($datas['kategoriPekerjaan3'] as $a)
          {{$a}},
        @endforeach ]},
      ],
      {
        label: 'Kategori'
      }
    ),
    options: {
      backgroundColor: [
        'rgba(255, 26, 104, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(0, 0, 0, 0.2)'
      ],
      borderColor: [
        'rgba(255, 26, 104, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(0, 0, 0, 1)'
      ],
      borderWidth: 1,
      plugins: {
          legend: {
            display: false
          },
          tooltip: {
            enabled: false // <-- this option disables tooltips
          }
        }
    },
  };

// render init block
const myChart = new Chart(
document.getElementById('chartKategori2'),
config
);

</script>