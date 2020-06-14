<?php

/**
 * @var array $variables
 */

use App\Document\Document;

/** @var Document[] $documents */
$documents = $variables['documents'];

?>

<style>
    table {
        font-size: 14px;
        border-radius: 10px;
        border-spacing: 0;
        text-align: center;
    }

    th {
        background: #4CAF50;
        color: white;
        text-shadow: 0 1px 1px #2D2020;
        padding: 10px 20px;
    }

    th, td {
        border-style: solid;
        border-width: 0 1px 1px 0;
        border-color: white;
    }

    th:first-child, td:first-child {
        text-align: left;
    }

    th:first-child {
        border-top-left-radius: 10px;
    }

    th:last-child {
        border-top-right-radius: 10px;
        border-right: none;
    }

    td {
        padding: 10px 20px;
        background: #8DC26F;
    }

    tr:last-child td:first-child {
        border-radius: 0 0 0 10px;
    }

    tr:last-child td:last-child {
        border-radius: 0 0 10px 0;
    }

    tr td:last-child {
        border-right: none;
    }
</style>

<a href="/">Back</a>

<h2>Документы</h2>


<form method="post">
    <p>
        <input name="title" placeholder="Document`s title">
    </p>
    <p>
        <textarea name="content" placeholder="Document`s content"></textarea>
    </p>
    <p>
        <input type="submit" value="Add">
    </p>
</form>

<?php if ($documents) : ?>
    <table>
        <thead>
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th>Created at</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($documents as $document) : ?>
            <tr>
                <td><?= $document->getTitle() ?></td>
                <td><?= $document->getContent() ?></td>
                <td><?= $document->getCreatedAt()->toDateTimeString() ?></td>
                <td>
                    <a href="/edit_document?uid=<?= $document->getUid() ?>">edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
