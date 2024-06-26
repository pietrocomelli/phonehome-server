<html>
  <head>
    <meta charset="UTF-8" />
    <title>NethServer PhoneHome</title>
    <link
      rel="stylesheet"
      type="text/css"
      href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
      media="screen"
    />
    <link rel="stylesheet" href= "https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <link rel="stylesheet" href= "css/leaflet-beautify-marker-icon.css">
    <link rel="stylesheet" href= "css/style.css">
    <link rel="icon" href="images/logoNethesis.png">
  </head>
  <body>
    <br>
    <div class="dropdown" id="dropdown">
      <div class="dropdown-trigger">
        <button class="button is-medium is-info" aria-haspopup="true" aria-controls="dropdown-menu" id="button">
          <span class="icon "><img src="images/logoNethesis.png" ></hr></span>
          <span>Installations </span>
        </button>
      </div>
      <div class="dropdown-menu" id="dropdown-menu" role="menu">
        <div class="dropdown-content">
          <a class="dropdown-item" id="interval_week">
            Last week
          </a>
          <a  class="dropdown-item" id="interval_month">
            Last month
          </a>
          <a class="dropdown-item" id="interval_6months">
            Last 6 months
          </a>
          <a class="dropdown-item" id="interval_year">
            Last year
          </a>
          <hr class="dropdown-divider">
          <a class="dropdown-item" id="interval_all">
            All
          </a>
          <a href="{{ route('select-hardware')}}" class="dropdown-item">Search Hardware</a>
        </div>
      </div>
    </div>
    <div class="button" id="totalUnity">
    </div>
    <div class="loader" id="loader"></div>
    <div id="map"></div>
    <a class="current_interval" id="current_interval">Last week</a>
    <script
    type="text/javascript"
    src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"
    ></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="js/map/layer.js"></script>
    <script src="js/map/coordinates.js"></script>
    <script src="js/lib/function.js"></script>
    <script src="js/lib/leaflet-beautify-marker-icon.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
