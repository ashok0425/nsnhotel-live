<script src="https://apis.mapmyindia.com/advancedmaps/v1/a06c2c7a8cda101abdf381c26de91d29/map_load?v=1.5"></script>
<script src="https://apis.mapmyindia.com/advancedmaps/api/913de855-bdff-4ad8-bf7d-c3f00f4e68e1/map_sdk_plugins">
</script>


<script>
    /*Map Initialization*/
    var map = new MapmyIndia.Map('map', {
        center: [28.09, 78.3],
        zoom: 5,
        search: false
    });

    /*Search plugin initialization*/
    var optional_config = {
        location: [28.61, 77.23],
        /* pod:'City',
         bridge:true,
         tokenizeAddress:true,*
         filter:'cop:9QGXAM',
         distance:true,
         width:300,
         height:300*/
    };
    new MapmyIndia.search(document.getElementById("place_address"), optional_config, callback);

    /*CALL for fix text - LIKE THIS
     * 
     new MapmyIndia.search("agra",optional_config,callback);
     * 
     * */

    var marker;

    function callback(data) {
        if (data) {
            var dt = data[0];
            if (!dt) return false;
            var eloc = dt.eLoc;
            var place = dt.placeName + ", " + dt.placeAddress;
            /*Use elocMarker Plugin to add marker*/
            if (marker) marker.remove();
            marker = new MapmyIndia.elocMarker({
                map: map,
                eloc: eloc,
                popupHtml: place,
                popupOptions: {
                    openPopup: true
                }
            }).fitbounds();
        }
    }
</script>
