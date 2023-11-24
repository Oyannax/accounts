<?php
// ---------- SECURITY

/**
 * Generate a valid token is $_SESSION
 *
 * @return void
 */
function generateToken(): void
{
    if (!isset($_SESSION['token']) || time() > $_SESSION['tokenExpiry']) {
        $_SESSION['token'] = md5(uniqid(mt_rand(), true));
        $_SESSION['tokenExpiry'] = time() + 15 * 60;
    }
}

/**
 * Check for CSRF with referer and token
 * Redirect to the given page in case of error
 *
 * @param string $url The page to redirect
 * @return void
 */
function checkCSRF(string $url): void
{
    if (!isset($_SERVER['HTTP_REFERER']) || !str_contains($_SERVER['HTTP_REFERER'], 'http://localhost/accounts')) {
        $_SESSION['error'] = 'error_referer';
    } else if (!isset($_SESSION['token']) || !isset($_REQUEST['token']) || $_SESSION['token'] !== $_REQUEST['token'] || time() > $_SESSION['tokenExpiry']) {
        $_SESSION['error'] = 'error_token';
    }

    if (!isset($_SESSION['error'])) return;

    header('Location: ' . $url);
    exit;
}

/**
 * Apply treatment on given array to prevent XSS
 *
 * @param array $array
 * @return void
 */
function checkXSS(array &$array): void
{
    $array = array_map('strip_tags', $array);
}

// ---------- NOTIFICATIONS

/**
 * Add an error to display and stop script
 *
 * @param string $error
 * @return void
 */
function addErrorAndExit(string $error): void
{
    $_SESSION['error'] = $error;

    header('Location: index.php');
    exit;
}

/**
 * Add a message to display
 *
 * @param string $msg
 * @return void
 */
function addMsg(string $msg): void
{
    $_SESSION['msg'] = $msg;
}


function getNotifHTML(): string
{
    $html = '<ul class="notif-content">';

    if (isset($_SESSION['msg'])) {
        $html .= '<li class="msg">' . $_SESSION['msg'] . '</li>';
        unset($_SESSION['msg']);
    }
    if (isset($_SESSION['error'])) {
        $html .= '<li class="error">' . $_SESSION['error'] . '</li>';
        unset($_SESSION['error']);
    }

    $html .= '</ul>';
    return $html;
}
