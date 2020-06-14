<?php

/**
 * @var array $variables
 */

/** @var User $user */
$user = $variables['user'];

use App\User\User; ?>
<div id="main-authorized">
    <main-authorized
            :user-name='<?= json_encode($user->getName()) ?>'
    ></main-authorized>
</div>

<script src="/dist/js/page/manifest.js"></script>
<script src="/dist/js/page/vendor.js"></script>
<script src="/dist/js/page/main-authorized.js"></script>
