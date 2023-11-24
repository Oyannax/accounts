<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Synthèse de Juillet 2023 - Mes Comptes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>

    <div class="container-fluid">
        <header class="row flex-wrap justify-content-between align-items-center p-3 mb-4 border-bottom">
            <a href="index.php" class="col-1">
                <i class="bi bi-piggy-bank-fill text-primary fs-1"></i>
            </a>
            <nav class="col-11 col-md-7">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link link-body-emphasis">Opérations</a>
                    </li>
                    <li class="nav-item">
                        <a href="summary.php" class="nav-link link-secondary" aria-current="page">Synthèses</a>
                    </li>
                    <li class="nav-item">
                        <a href="categories.php" class="nav-link link-body-emphasis">Catégories</a>
                    </li>
                    <li class="nav-item">
                        <a href="import.php" class="nav-link link-body-emphasis">Importer</a>
                    </li>
                </ul>
            </nav>
            <form action="" class="col-12 col-md-4" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Rechercher..."
                        aria-describedby="button-search">
                    <button class="btn btn-primary" type="submit" id="button-search">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </header>
    </div>

    <div class="container">
        <section class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h2 class="my-0 fw-normal fs-4">Balance de Juillet 2023</h2>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-around align-items-center">
                        <span class="rounded-pill text-nowrap bg-warning-subtle fs-2 px-2">
                            - 399,94 €
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <h3 class="fs-4">Recettes</h3>
                        <span class="rounded-pill text-nowrap bg-success-subtle fs-4 px-2">
                            + 600,26 €
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <h3 class="fs-4">Dépenses</h3>
                        <span class="rounded-pill text-nowrap bg-warning-subtle fs-4 px-2">
                            - 1 000,20 €
                        </span>
                    </li>
                </ul>
            </div>
        </section>

        <section class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h2 class="my-0 fw-normal fs-4">Répartition des dépenses de Juillet 2023</h2>
            </div>
            <div class="card-body">
                <div class="alert alert-warning" role="alert">
                    Attention, 5 dépenses n'ont pas été catégoriées pour le mois de juillet 2017.
                </div>
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2">Catégorie</th>
                            <th scope="col" class="text-end">Dépense total</th>
                            <th scope="col" class="text-end">% des dépenses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-3">
                                <i class="bi bi-house-door fs-3"></i>
                            </td>
                            <td>
                                Habitation
                            </td>
                            <td class="text-end">
                                <span class="rounded-pill text-nowrap bg-warning-subtle px-2">
                                    - 604,00 €
                                </span>
                            </td>
                            <td class="text-end text-nowrap">
                                69,88 %
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-3">
                                <i class="bi bi-emoji-smile fs-3"></i>
                            </td>
                            <td>
                                Loisir
                            </td>
                            <td class="text-end">
                                <span class="rounded-pill text-nowrap bg-warning-subtle px-2">
                                    - 198,34 €
                                </span>
                            </td>
                            <td class="text-end text-nowrap">
                                22,95 %
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-3">
                                <i class="bi bi-train-front fs-3"></i>
                            </td>
                            <td>
                                Voyage
                            </td>
                            <td class="text-end">
                                <span class="rounded-pill text-nowrap bg-warning-subtle px-2">
                                    - 62,00 €
                                </span>
                            </td>
                            <td class="text-end text-nowrap">
                                7,17 %
                            </td>
                        </tr>
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
                            <a class="page-link" href="#">Juin 2023</a>
                        </li>
                        <li class="page-item">
                            <span class="page-link">...</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">
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