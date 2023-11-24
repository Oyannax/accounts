<?php
// ---------- GLOBAL INTERFACE

/**
 * Turn array into string as HTML list
 *
 * @param array $array
 * @param string $ulClass Optionnal CSS class to UL element
 * @param string $liClass Optionnal CSS class to LI element
 * @return string
 */
function turnArrayIntoString(array $array, ?string $ulClass = NULL, ?string $liClass = NULL): string
{
    $ulClass = $ulClass ? " class=\"{$ulClass}\"" : '';
    $liClass = $liClass ? " class=\"{$liClass}\"" : '';
    return "<ul{$ulClass}><li{$liClass}>" . implode("</li><li{$liClass}>", $array) . '</li></ul>';
}

/**
 * Return current page
 *
 * @return string
 */
function getCurrentPage(): string
{
    return basename($_SERVER['SCRIPT_NAME']);
}

/**
 * Generate HTML link for the given page
 *
 * @param array $page
 * @return string
 */
function generatePageLink(array $page): string
{
    return '<a href="' . $page['file'] . '" class="nav-link' . (getCurrentPage() === $page['file'] ? 'link-secondary" aria-current="page' : 'link-body-emphasis') . '">' . $page['name'] . '</a>';
}

/**
 * Generate HTML main navigation from pages data
 *
 * @param array $pages
 * @return string
 */
function generateHTMLNav(array $pages): string
{
    $html = '<nav class="col-11 col-md-7">' . turnArrayIntoString(array_map('generatePageLink', $pages), 'nav', 'nav-item') . '</nav>';
    return $html;
}

/**
 * Get array from data for current page data
 *
 * @param array $pages
 * @return array
 */
function getCurrentPageData(array $pages): ?array
{
    foreach ($pages as $page) {
        if ($page['file'] === getCurrentPage()) {
            return $page;
        }
    }
    return NULL;
}

/**
 * Generate style sheet links
 *
 * @param array $styleSheetFiles
 * @return string
 */
function generateStyleSheetLinks(array $styleSheetFiles): string
{
    return implode('', array_map(fn ($cssFile) => "<link rel=\"stylesheet\" href=\"{$cssFile}\">", $styleSheetFiles));
}

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
        $html .= '<li class="alert alert-warning" style="list-style: none">' . $_SESSION['msg'] . '</li>';
        unset($_SESSION['msg']);
    }
    if (isset($_SESSION['error'])) {
        $html .= '<li class="alert alert-warning" style="list-style: none">' . $_SESSION['error'] . '</li>';
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
