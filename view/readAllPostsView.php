<?php

    echo '<h4><a href="?id=', $post->getId(), '">', $post->getTitre(), '</a></h4>', "\n",
         '<p>', nl2br($content), '</p>';
