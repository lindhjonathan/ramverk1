<?php

namespace Anax\View;

/**
 * Ip Adress Validator
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());



?><h1>IP Address Validator</h1>
<p>Mata in en IPv4 eller IPv6 address.</p>
<form class="stylechooser" method="post" action="<?= url("ip/validate") ?>">
    <fieldset>
        <legend>IP Address Validator</legend>
        <p>
            <label for="ip_address">Input an IP Address to validate<br>
                <input type="text" name="ip_address">
                <input type="submit" name="doit" value="Validera">
            </label>
        </p>
    </fieldset>
</form>

<h2>JSON Result Validator</h2>

<p>Mata in i följande formulär för att få resultatet skrivet i JSON format.</p>
<form class="stylechooser" method="post" action="<?= url("json/validate") ?>">
    <fieldset>
        <legend>JSON IP Address Validator</legend>
        <p>
            <label for="ip_address">Input an IP Address to validate<br>
                <input type="text" name="ip_address">
                <input type="submit" name="doit" value="Validera">
            </label>
        </p>
    </fieldset>
</form>

<p>Använd följande testroutes för att interagera med mitt JSON REST API.</p>
<ul>
    <li><a href="<?= url("json/index") ?>">json/index</a></li>
    <li><a href="<?= url("json/validate/193.11.185.32") ?>">json/validate/ipv4</a></li>
    <li><a href="<?= url("json/validate/2001:6b0:2a:c280:487c:27f8:34d6:1435") ?>">json/validate/ipv6</a></li>
    <li><a href="<?= url("json/validate/2001:6b0:2a:c280:487c:27f8:3wwd6:14") ?>">json/validate/ipv6-fail</a></li>
    <li><a href="<?= url("json/validate/193.11.185.3g") ?>">json/validate/ipv4-fail</a></li>
</ul>
