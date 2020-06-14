<?php

/**
 * @var array $variables
 */

use App\Document\Document;

/** @var Document $document */
$document = $variables['document'];

?>

<a href="/documents">Back</a>

<h2>Edit document</h2>


<form method="post">
    <p>
        <input name="title" placeholder="Document`s title" value="<?= $document->getTitle() ?>">
        <input name="createdAt" type="hidden" value="<?= $document->getCreatedAt()->toDateTimeString() ?>">
    </p>
    <p>
        <textarea name="content" placeholder="Document`s content"><?= $document->getContent() ?></textarea>
    </p>
    <p>
        <input type="submit" value="Edit">
    </p>
</form>
