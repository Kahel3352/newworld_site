<div class="container profil">
    <div id="EmplacementDeMaCarte">
    </div>
</div>

<!-- script pour l'API de google -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1H2GdqzMpty57RJV_9E7XqG9EHMDa-HU"></script>
<!-- paramètres de la carte -->
<script type="text/javascript">
    var locations = <?php echo json_encode($infos_pointDeVente); ?>;
    var test_département = <?php echo json_encode($point_departement); ?>;
    if(locations.length >0 && !test_département)
    {
        var optionsCarte = {
            zoom: 9,
            center: new google.maps.LatLng(locations[0].latitude, locations[0].longitude),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: true,
            zoomControl: true
        }
    }
    else
    {
        var optionsCarte = {
            zoom: 6,
            center: new google.maps.LatLng(48, 2),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: true,
            zoomControl: true
        }
    }
        var map = new google.maps.Map(document.getElementById("EmplacementDeMaCarte"), optionsCarte);
    //var infowindow = new google.maps.InfoWindow();
    var marker, i;
    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i].latitude, locations[i].longitude),
        map: map,
        title: locations[i].nomPoint
      });
      (function(marker, i) {
            // add click event
            var contentString = '<div id="content">'+
            '<h4 id="firstHeading" class="firstHeading"> ' + locations[i].nomPoint + ' </h4> <br />'+
            '<table>'+
            '<tr>'+
            '<td>'+
            '<p>' + locations[i].ruePoint + '</p <br />' +
            '<p>' + locations[i].cpPoint + ' ' + locations[i].villePoint+'</p> <br />' +
            '<p> <a class="nav-link" href=\'index.php?module=vitrine&action=maps&point=' + locations[i].idPoint +'\'>Ajouter au favoris</a>'+
            '</td>'+
            '<td>'+
            '<p>'+ locations[i].cpPoint +' </p>'+
            '</td>'
            '</tr>'+
            '</table>'+
            '</div>';
            google.maps.event.addListener(marker, 'click', function() {
                infowindow = new google.maps.InfoWindow({
                    content: contentString
                });
                infowindow.open(map, marker);
            });
        })(marker, i);
    }
</script>