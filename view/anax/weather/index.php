<?php

namespace Anax\View;

/**
 * Weather service
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());



?><h1>Weather Service</h1>
<p>Mata in en IP address eller ett ortsnamn för att hämta kommande/passerat väder.</p>
<form class="stylechooser" method="post" action="<?= url("weather/forecast") ?>">
        <label for="userInput">IP-Address eller Ortsnamn<br>
            <input type="text" name="userInput" value="<?= $userIp ?>">
        </label>
    <button type="submit">Kommande</button>
    <button type="submit" formaction="<?= url("weather/past") ?>">Passerat</button>
</form>
