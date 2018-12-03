<?php

namespace Anax\View;

/**
 * Weather service
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());



?>

<p class="error">
    <h3>Error: <?= $error ?></h3>
</p>
<a href="<?= url("weather/index") ?>" style="padding-top: 16px;"><button>Gå tillbaks</button></a>
