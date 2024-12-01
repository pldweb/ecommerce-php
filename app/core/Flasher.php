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
                  <h4 class="alert-heading">Well done!</h4>
                  <p>' . $_SESSION['flash_message']['action'] . '</p>
                  <hr>
                  <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
                  </div>';
            unset($_SESSION['flash_message']);
        }
    }
}