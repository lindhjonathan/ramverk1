<?php

namespace Anax\View;

/**
 * Weather service
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());



?><h1>Väder i <?= $city ?> under kommande vecka.</h1>
<p>Väder just nu: <?= $currently ?> <br>
Temperatur: <?= $temp ?>°C <br>
Känns som: <?= $feels ?>°C <br>
Vind: <?= $wind ?>m/s med vindbyar upp till <?= $gust ?>m/s <br>
Senare idag: <?= $senare ?> <br>
Senare i veckan: <?= $weekly ?></p>

<div id="mapdiv" style="height: 300px;"></div>
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>
<script>
    var mymap = L.map('mapdiv').setView([<?= $latitude ?>, <?= $longitud ?>], 13);

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoibGluZGhqb25hdGhhbiIsImEiOiJjanA4ZDZmdGoxc3c1M3FsazBpcHZyNW9mIn0.Tu9ZcEfEUxfTVFqf7wz5LA'
    }).addTo(mymap);
</script>
