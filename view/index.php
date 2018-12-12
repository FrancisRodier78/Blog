<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

// Redirection vers le répertoire précédent
// qui redirigera lui-même vers le précédent jusqu'à trouver une
// page autorisée

header('location:../');
exit();
