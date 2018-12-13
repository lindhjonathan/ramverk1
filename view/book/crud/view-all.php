<?php

namespace Anax\View;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToCreate = url("book/create");
$urlToDelete = url("book/delete");



?><h1>View all books</h1>

<?php if (!$items) : ?>
    <p>There are no books to show.</p>
    <?php
    return;
endif;
?>

<table id="table1">
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Author</th>
        <th>Cover Art</th>
    </tr>
    <?php foreach ($items as $item) : ?>
    <tr>
        <td>
            <a href="<?= url("book/update/{$item->id}"); ?>"><?= $item->id ?></a>
        </td>
        <td><?= $item->title ?></td>
        <td><?= $item->author ?></td>
        <td><img src="<?= $item->cover ?>" alt="Omslagsbild" height="100" width="75"></img></td>
    </tr>
    <?php endforeach; ?>
</table>

<p>
    <a href="<?= $urlToCreate ?>"><button>Add</button></a>
    <a href="<?= $urlToDelete ?>"><button>Delete</button></a>
</p>
