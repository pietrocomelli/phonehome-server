<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hardware</title>
    <link rel="stylesheet" href="{{ asset('css/hardware.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" href="{{ asset('images/logoNethesis.png')}}">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand"><img src="{{ asset('images/logoNethesis.png') }}" alt="Logo Nethesis"></a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="{{route('map')}}">Map</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{route('select-hardware')}}">Select Hardware</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="scrollable-content">
    <div class="container">
    <h1>Find {{$installation}} Hardware</h1>
    <p>Enter a search term in the input box below to find {{$installation}} hardware matching your requirements.</p>

    <form action="{{ route('hardware', ['installation' => $installation]) }}" method="GET">
        @csrf
        <input type="text" name="search_term" id="search_term" placeholder="Search hardware...">
        <button type="submit">Search</button>
    </form>

    @if (empty($groupedInputMatch))
        <p>No hardware found</p>
    @else
        <ul>
        {{$count}} hardware found <br><br>
        <!-- Looping through grouped input matches -->
        @foreach ($groupedInputMatch as $key => $group)
        @php
            $totalCount = 0;
            foreach ($group['occurrences'] as $occurrence) {
                $totalCount += $occurrence;
            }
        @endphp
            <button class="accordion"><h2><strong>{{ $key }}: <span>({{$totalCount}})</span></strong></h2>
            <span><i class="bi bi-caret-down-fill"></i></span></button>
            <div class="panel">
            <ul>
                <!-- Looping through hardware details -->
                @foreach ($group['rows'] as $row)
                    <!-- Displaying hardware details and occurrences -->
                    <li class="rows">{{ $row }} <span>({{ $group['occurrences'][$row] }})</span></li>
                @endforeach
            </ul>
            </div>
        @endforeach
        </ul>
    @endif
    </div>
</div>
<script>
    var accordions = document.getElementsByClassName("accordion");
    var i;

    // Loop through all accordion elements
    for (i = 0; i < accordions.length; i++) {
        // Add click event listener to toggle accordion
        accordions[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>
</body>
</html>
