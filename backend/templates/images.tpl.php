<?php

/**
 * @var array $variables
 */

use App\Image\Image;

/** @var Image[] $images */
$images = $variables['images'];

?>
<a href="/">Back</a>

<h2>Images</h2>


<form method="post" enctype="multipart/form-data">
    <p>
        <input type="file" name="image">
    </p>
    <p>
        <input type="submit" value="Add">
    </p>
</form>

<?php if ($images) : ?>
    <table>
        <thead>
        <tr>
            <th>Image</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($images as $image) : ?>
            <tr>
                <td>
                    <img width="400" src="/.storage/<?= $image->getUid() ?>.png">
                </td>
                <td>
                    <a href="/makeGrayImage?id=<?= $image->getUid() ?>&type=<?= $image->getType() ?>">make gray</a>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
<?php endif; ?>
