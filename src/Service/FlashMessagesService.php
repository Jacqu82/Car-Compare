<?php

namespace Service;

class FlashMessagesService
{
    public static function setFlashMessage($kind, $message)
    {
        echo "<div class='alert alert-$kind flash-message'>";
        echo "<strong>$message</strong>";
        echo "</div>";
    }
}
