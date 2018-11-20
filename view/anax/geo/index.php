<?php

namespace Anax\View;

/**
 * IP Geo Location
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());



?><h1>IP Address Locator</h1>
<p>Mata in en IPv4 eller IPv6 address.</p>
<form class="stylechooser" method="post" action="<?= url("geo/locator") ?>">
    <fieldset>
        <legend>IP Geo Location</legend>
        <p>
            <label for="ip_address">Input an IP Address to get location<br>
                <input type="text" name="ip_address" placeholder="<?= $userIp ?>">
                <input type="submit" name="doit" value="Locate">
            </label>
        </p>
    </fieldset>
</form>
