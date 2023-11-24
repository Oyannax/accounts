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
// -------------------- ADD DATA

/**
 * Add an error to display and stop script
 * Redirect to the given page
 *
 * @param string $error
 * @param string|null $url The page to redirect
 * @return void
 */
function addErrorAndExit(string $error, ?string $url = 'index.php'): void
{
    $_SESSION['error'] = $error;

    header('Location: ' . $url);
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

// -------------------- DISPLAY

/**
 * Get and display the HTML structure of notifications
 *
 * @return string
 */
function displayNotifHTML(): string
{
    $html = '<ul class="notif-content">';

    if (isset($_SESSION['msg'])) {
        $html .= '<li class="msg">' . $_SESSION['msg'] . '</li>';
        unset($_SESSION['msg']);
    }
    if (isset($_SESSION['error'])) {
        $html .= '<li class="alert alert-warning">' . $_SESSION['error'] . '</li>';
        unset($_SESSION['error']);
    }

    $html .= '</ul>';
    return $html;
}

// ---------- TRANSACTIONS
// -------------------- GET DATA

/**
 * Get the remaining amount of money
 *
 * @return string
 */
function getTtlAmount(): string
{
    global $dbCo;
    $getTtl = $dbCo->prepare("SELECT SUM(amount) FROM transaction;");
    $getTtl->execute();
    return $getTtl->fetchColumn();
}

/**
 * Get all data from transaction table from given id
 *
 * @param integer $id
 * @return array
 */
function getAllFromId(int $id): array
{
    global $dbCo;
    $getAll = $dbCo->prepare("SELECT * FROM transaction LEFT JOIN category USING (id_category) WHERE id_transaction = :id");
    $getAll->execute([
        'id' => $id
    ]);
    return $getAll->fetch();
}

// -------------------- DISPLAY

// function displayNavLink(string $url, string $name): string {
//     $html = '<li class="nav-item">';

//     if (str_contains($_SERVER['SCRIPT_NAME'], $url)) return $html .= '<a href="'.$url.'" class="nav-link link-secondary" aria-current="page">'.$name.'</a></li>';

//     return $html .= '<a href="'.$url.'" class="nav-link link-secondary">'.$name.'</a></li>';
// }