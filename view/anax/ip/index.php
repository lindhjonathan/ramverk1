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
