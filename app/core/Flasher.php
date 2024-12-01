<?php


class Flasher {
    public static function setflash($message, $action, $type)
    {
        $_SESSION['flash_message'] = [
            'message' => $message,
            'action' => $action,
            'type' => $type
        ];
    }

    public static function flash()
    {
        if (isset($_SESSION['flash_message'])) {
            echo '<div class="alert alert-' . $_SESSION['flash_message']['type']  . ' role="alert">
                  <h4 class="alert-heading">' . $_SESSION['flash_message']['message'] . '</h4>
                  <div>' . $_SESSION['flash_message']['action'] . '</div>
                  </div>';
            unset($_SESSION['flash_message']);
        }
    }
}