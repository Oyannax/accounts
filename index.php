<?php
require_once 'vendor/autoload.php';
require_once 'includes/_functions.php';
include 'includes/_db.php';

session_start();
generateToken();
// var_dump($_SESSION['token']);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opérations de Juillet 2023 - Mes Comptes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <div class="notif-cntnr">
        <?= getNotifHTML() ?>
    </div>

    <div class="container-fluid">
        <header class="row flex-wrap justify-content-between align-items-center p-3 mb-4 border-bottom">
            <a href="index.php" class="col-1">
                <i class="bi bi-piggy-bank-fill text-primary fs-1"></i>
            </a>
            <nav class="col-11 col-md-7">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link link-secondary" aria-current="page">Opérations</a>
                    </li>
                    <li class="nav-item">
                        <a href="summary.html" class="nav-link link-body-emphasis">Synthèses</a>
                    </li>
                    <li class="nav-item">
                        <a href="categories.html" class="nav-link link-body-emphasis">Catégories</a>
                    </li>
                    <li class="nav-item">
                        <a href="import.html" class="nav-link link-body-emphasis">Importer</a>
                    </li>
                </ul>
            </nav>
            <form action="" class="col-12 col-md-4" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Rechercher..." aria-describedby="button-search">
                    <button class="btn btn-primary" type="submit" id="button-search">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </header>
    </div>

    <div class="container">
        <section class="card mb-4 rounded-3 shadow-sm">
            <?php
            $displayTtlAmount = $dbCo->prepare("SELECT SUM(amount) FROM transaction;");
            $displayTtlAmount->execute();
            $ttlAmount = $displayTtlAmount->fetchColumn();
            ?>
            <div class="card-header py-3">
                <h2 class="my-0 fw-normal fs-4">Solde aujourd'hui</h2>
            </div>
            <div class="card-body">
                <p class="card-title pricing-card-title text-center fs-1"><?= $ttlAmount ?> €</p>
            </div>
        </section>

        <section class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h1 class="my-0 fw-normal fs-4">Opérations de Juillet 2023</h1>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2">Opération</th>
                            <th scope="col" class="text-end">Montant</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $displayTransac = $dbCo->prepare("SELECT id_transaction, name, amount, date_transaction, icon_class FROM transaction LEFT JOIN category USING (id_category) WHERE MONTH(date_transaction) = 7 AND YEAR(date_transaction) = 2023 ORDER BY date_transaction DESC;");
                        $displayTransac->execute();
                        $transactions = $displayTransac->fetchAll();

                        foreach ($transactions as $transac) {
                            // $isEditOk = isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id']) && intval($_GET['id']) === intval($transac['id_transaction']);

                            $date = new DateTimeImmutable($transac['date_transaction']);
                            $formattedDate = $date->format('d/m/Y');
                        ?>
                            <tr>
                                <td width="50" class="ps-3">
                                    <i class="bi bi-<?= $transac['icon_class'] ?> fs-3"></i>
                                </td>
                                <td>
                                    <time datetime="<?= $transac['date_transaction'] ?>" class="d-block fst-italic fw-light"><?= $formattedDate ?></time>
                                    <?= $transac['name'] ?>
                                </td>
                                <td class="text-end">
                                    <?php
                                    if ($transac['amount'] < 0) {
                                    ?>
                                        <span class="rounded-pill text-nowrap bg-warning-subtle px-2">
                                            <?= $transac['amount'] ?> €
                                        </span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="rounded-pill text-nowrap bg-success-subtle px-2">
                                            <?= $transac['amount'] ?> €
                                        </span>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td class="text-end text-nowrap">
                                    <a href="edit.php?id=<?= $transac['id_transaction'] ?>" class="btn btn-outline-primary btn-sm rounded-circle">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="action.php?token=<?= $_SESSION['token'] ?>&action=delete&id=<?= $transac['id_transaction'] ?>" class="btn btn-outline-danger btn-sm rounded-circle">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <nav class="text-center">
                    <ul class="pagination d-flex justify-content-center m-2">
                        <li class="page-item disabled">
                            <span class="page-link">
                                <i class="bi bi-arrow-left"></i>
                            </span>
                        </li>
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">Juillet 2023</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="index.php">Juin 2023</a>
                        </li>
                        <li class="page-item">
                            <span class="page-link">...</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="index.php">
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </section>
    </div>

    <div class="position-fixed bottom-0 end-0 m-3">
        <a href="add.php" class="btn btn-primary btn-lg rounded-circle">
            <i class="bi bi-plus fs-1"></i>
        </a>
    </div>

    <footer class="py-3 mt-4 border-top">
        <p class="text-center text-body-secondary">© 2023 Mes comptes</p>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>