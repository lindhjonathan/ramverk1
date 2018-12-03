<?php

namespace Anax\View;

/**
 * JSON Weather Service
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());



?><h1>JSON Weather</h1>

<p>Mata in Ortsnamn/IP-address och få resultatet utskrivet i JSON format.</p>
<form class="stylechooser" method="post" action="<?= url("wjson/forecast") ?>">
    <label for="userInput">IP-Address eller Ortsnamn<br>
        <input type="text" name="userInput" value="<?= $userIp ?>">
    </label>
    <button type="submit">7 Dagar</button>
    <button type="submit" formaction="<?= url("wjson/past") ?>">Passerat</button>
</form>

<h2>Dokumentation över JSON Rest-API</h2>

<p>Använd följande testroutes för att interagera med JSON API:t.</p>
<p>7-dagars väderprognos</p>
<p>
    <pre class="code">GET /wjson/forecast/[IP]/[City]</pre>
</p>
<p>Föregående 30 dagars väder</p>
<p>
    <pre class="code">GET /wjson/past/[IP]/[City]</pre>
</p>
<p>Testroutes för /wjson/forecast:</p>
<ul>
    <li><a href="<?= url("wjson/forecast/69.89.31.226") ?>">wjson/forecast/ip</a></li>
    <li><a href="<?= url("wjson/forecast/Karlskrona") ?>">wjson/forecast/Karlskrona</a></li>
</ul>
<p>Resultat <strong>wjson/forecast</strong>:</p>
<pre class="code">{
    "result": "Karlskrona is not a valid IP Address.",
    "hostname": "undefined host",
    "currently": "L\u00e4tt molnighet",
    "temp": 8,
    "feels": 5,
    "wind": 4.8,
    "gust": 12.4,
    "senare": "L\u00e4tt molnighet fram till imorgon eftermiddag.",
    "weekly": "Regnskurar idag fram till p\u00e5 l\u00f6rdag, med temperaturer
              som sjunker till 4\u00b0C under onsdagen.",
    "city": "Karlskrona",
    "latitude": "56.1621073",
    "longitud": "15.5866422"
}</pre>

<p>Testroutes för /wjson/past:</p>
<ul>
    <li><a href="<?= url("wjson/past/69.89.31.226") ?>">wjson/past/ip</a></li>
    <li><a href="<?= url("wjson/past/Karlskrona") ?>">wjson/past/Karlskrona</a></li>
</ul>

<p>Resultat <strong>wjson/past</strong>:</p>
<pre class="code">{
    "result": "Karlskrona is not a valid IP Address.",
    "hostname": "undefined host",
    "0": {
        "summary": "L\u00e4tt molnighet",
        "temperature": 8,
        "windSpeed": 4.5,
        "time": "2018-12-03"
    },
    "1": {
        "summary": "Regnskurar",
        "temperature": 5,
        "windSpeed": 4.5,
        "time": "2018-12-02"
    },
    "2": {
        "summary": "Duggregn",
        "temperature": 5,
        "windSpeed": 2.2,
        "time": "2018-12-01"
    },
    "city": "Karlskrona",
    "latitude": "56.1621073",
    "longitud": "15.5866422"
}</pre>
