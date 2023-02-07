  <!-- start footer -->
  <div class="page-footer">
      <div class="page-footer-inner"> 2021 &copy; Nsnhotels</a>
      </div>
      <div class="scroll-to-top">
          <i class="icon-arrow-up"></i>
      </div>
  </div>
  <!-- end footer -->
  </div>
  <!-- start js include path -->
  <script src="{{ asset('/admin/assets/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('/admin/assets/plugins/popper/popper.min.js') }}"></script>
  <script src="{{ asset('/admin/assets/plugins/jquery-blockui/jquery.blockui.min.js') }}"></script>
  <script src="{{ asset('/admin/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
  <!-- bootstrap -->
  <script src="{{ asset('/admin/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('/admin/assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
  <script src="{{ asset('/admin/assets/js/pages/sparkline/sparkline-data.js') }}"></script>
  <!-- Common js-->
  <script src="{{ asset('/admin/assets/js/app.js') }}"></script>
  <script src="{{ asset('/admin/assets/js/layout.js') }}"></script>
  <script src="{{ asset('/admin/assets/js/theme-color.js') }}"></script>
  <!-- material -->
  <script src="{{ asset('/admin/assets/plugins/material/material.min.js') }}"></script>
  <!-- animation -->
  <script src="{{ asset('/admin/assets/js/pages/ui/animations.js') }}"></script>
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=e8cgxme8kbsc3u65sf2y8iixj1z0mzqlejahfw9hp9yoi1to">
  </script>
  <script src="{{ asset('/admin/assets/plugins/chosen/chosen.jquery.min.js') }}"></script>


  <!-- morris chart -->
  <!-- <script src="{{ asset('/admin/assets/plugins/morris/morris.min.js') }}"></script>
 <script src="{{ asset('/admin/assets/plugins/morris/raphael-min.js') }}"></script>
 <script src="{{ asset('/admin/assets/js/pages/chart/morris/morris_home_data.js') }}"></script> -->
  <script src="{{ asset('/admin/assets/plugins/switchery/dist/switchery.min.js') }}"></script>


  <script src="{{ asset('/admin/assets/plugins/pnotify/dist/pnotify.js') }}"></script>
  <script src="{{ asset('/admin/assets/plugins/pnotify/dist/pnotify.buttons.js') }}"></script>
  <script src="{{ asset('/admin/assets/plugins/pnotify/dist/pnotify.nonblock.js') }}"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="{{ asset('/admin/assets/js/commons.js') }}"></script>

  @stack('scripts')

  @if (session('error'))
      <script>
          notify("{{ session('error') }}", "error");
      </script>
  @endif
  @if (session('success'))
      <script>
          notify("{{ session('success') }}");
      </script>
  @endif

  {{-- <script>
      function placeMap() {

          let place_lat = parseFloat($('#place_lat').val()) || 20.5937;
          let place_lng = parseFloat($('#place_lng').val()) || 78.9629;

          let map = new google.maps.Map(document.getElementById('map'), {
              center: {
                  lat: place_lat,
                  lng: place_lng
              },
              zoom: 16,
              mapTypeId: 'roadmap',
              mapTypeControl: false,
              fullscreenControl: true,
              streetViewControl: false,
              disableDefaultUI: false,
          });

          // Create marker by lat,lng
          let latLng = new google.maps.LatLng(place_lat, place_lng);
          new google.maps.Marker({
              position: latLng,
              map: map,
              draggable: true
          });

          // Create the search box and link it to the UI element.
          let input = document.getElementById('place_address');
          let searchBox = new google.maps.places.SearchBox(input);
          // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

          // Bias the SearchBox results towards current map's viewport.
          map.addListener('bounds_changed', function() {
              searchBox.setBounds(map.getBounds());
          });

          let markers = [];
          // Listen for the event fired when the user selects a prediction and retrieve
          // more details for that place.
          searchBox.addListener('places_changed', function() {
              let places = searchBox.getPlaces();

              if (places.length === 0) {
                  return;
              }

              // Clear out the old markers.
              markers.forEach(function(marker) {
                  marker.setMap(null);
              });
              markers = [];

              // For each place, get the icon, name and location.
              let bounds = new google.maps.LatLngBounds();
              places.forEach(function(place) {
                  if (!place.geometry) {
                      console.log("Returned place contains no geometry");
                      return;
                  }

                  // Create a marker for each place.
                  markers.push(new google.maps.Marker({
                      map: map,
                      title: place.name,
                      position: place.geometry.location
                  }));

                  if (place.geometry.viewport) {
                      // Only geocodes have viewport.
                      bounds.union(place.geometry.viewport);
                  } else {
                      bounds.extend(place.geometry.location);
                  }

                  console.log("place:", place);
                  console.log("latitude: " + place.geometry.location.lat() + ", longitude: " + place
                      .geometry.location.lng());

                  $('#place_address').val(place.formatted_address);
                  $('#place_lat').val(place.geometry.location.lat());
                  $('#place_lng').val(place.geometry.location.lng());

              });
              map.fitBounds(bounds);
          });
      }
  </script>
  <script
      src="https://maps.googleapis.com/maps/api/js?key={{ setting('goolge_map_api_key', 'AIzaSyAwODglsF1sybi50BTXwKl6DsvwiCtl0PY') }}&callback=placeMap&libraries=places"
      async></script> --}}
  <!-- end js include path -->

  @include('admin.layouts.indiamap');
