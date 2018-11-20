<?php

namespace Anax\View;

/**
 * Ip Adress Locator
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());



?><h1>IP Location lookup result</h1>
<p>Validation result: <?= $result ?></p>
<p>IP Version: <?= $type ?></p>
<p>Hostname: <?= $hostname ?></p>
<p>Country: <?= $country_name ?></p>
<p>City: <?= $city ?></p>
<p>Longitud: <?= $longitud ?></p>
<p>Latitud: <?= $latitude ?></p>
