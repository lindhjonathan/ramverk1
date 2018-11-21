<?php

namespace Anax\View;

/**
 * Ip Adress Locator
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());



?><h1>JSON Result Validator</h1>

<p>Mata in i formuläret för att få lokaliseringsresultatet utskrivet i JSON format.</p>
<form class="stylechooser" method="post" action="<?= url("gjson/locate") ?>">
    <fieldset>
        <legend>JSON IP Address Validator</legend>
        <p>
            <label for="ip_address">Input an IP Address to locate<br>
                <input type="text" name="ip_address" value="<?= $userIp ?>">
                <input type="submit" name="doit" value="Locate">
            </label>
        </p>
    </fieldset>
</form>

<p>Använd följande testroutes för att interagera med mitt JSON REST API.</p>
<p>Resultatet kommer skrivas ut i följande format:<br>
    "result": {ip, validation result},<br>
    "hostname": {hostname of given ip address},<br>
    "ip": {ip},<br>
    "type": {ip type},<br>
    "country_name": {country name},<br>
    "city": {city},<br>
    "latitude": 40.2347,<br>
    "longitud": -111.6447
</p>
<ul>
    <li><a href="<?= url("gjson/index") ?>">gjson/index</a></li>
    <li><a href="<?= url("gjson/locate/69.89.31.226") ?>">gjson/locate/ipv4</a></li>
    <li><a href="<?= url("gjson/locate/2002:4559:1fe2::4559:1fe2") ?>">gjson/locate/ipv6</a></li>
    <li><a href="<?= url("gjson/locate/2001:6b0:2a:c280:487c:27f8:3wwd6:14") ?>">gjson/locate/ipv6-fail</a></li>
    <li><a href="<?= url("gjson/locate/193.11.185.3g") ?>">gjson/locate/ipv4-fail</a></li>
</ul>
