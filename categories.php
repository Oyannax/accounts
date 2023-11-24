<?php
require_once 'vendor/autoload.php';
require_once 'includes/_functions.php';
include 'includes/_db.php';

session_start();
generateToken();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégories - Mes Comptes</title>
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
                        <a href="index.php" class="nav-link link-body-emphasis" aria-current="page">Opérations</a>
                    </li>
                    <li class="nav-item">
                        <a href="summary.php" class="nav-link link-body-emphasis">Synthèses</a>
                    </li>
                    <li class="nav-item">
                        <a href="categories.php" class="nav-link link-secondary">Catégories</a>
                    </li>
                    <li class="nav-item">
                        <a href="import.php" class="nav-link link-body-emphasis">Importer</a>
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
            <div class="card-header py-3">
                <h1 class="my-0 fw-normal fs-4">Catégories</h1>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-house-door fs-3"></i>
                            &nbsp;
                            Habitation
                            &nbsp;
                            <span class=" badge bg-secondary">34 opérations</span>
                        </div>
                        <div>
                            <a href="#" class="btn btn-outline-primary btn-sm rounded-circle">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-person-workspace fs-3"></i>
                            &nbsp;
                            Travail
                            &nbsp;
                            <span class=" badge bg-secondary">12 opérations</span>
                        </div>
                        <div>
                            <a href="#" class="btn btn-outline-primary btn-sm rounded-circle">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-emoji-smile fs-3"></i>
                            &nbsp;
                            Loisir
                            &nbsp;
                            <span class=" badge bg-secondary">26 opérations</span>
                        </div>
                        <div>
                            <a href="#" class="btn btn-outline-primary btn-sm rounded-circle">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-train-front fs-3"></i>
                            &nbsp;
                            Voyage
                            &nbsp;
                            <span class=" badge bg-secondary">6 opérations</span>
                        </div>
                        <div>
                            <a href="#" class="btn btn-outline-primary btn-sm rounded-circle">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <section class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h2 class="my-0 fw-normal fs-4">Ajouter une catégorie</h2>
            </div>
            <div class="card-body">
                <form class="row align-items-end">
                    <div class="col col-md-5">
                        <label for="name" class="form-label">Nom *</label>
                        <input type="email" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="col-md-5">
                        <label for="icon" class="form-label">Classe icone bootstrap *</label>
                        <input type="text" class="form-control" name="icon" id="icon" required>
                    </div>
                    <div class="col col-md-2 text-center text-md-end mt-3 mt-md-0">
                        <button type="submit" class="btn btn-secondary">Ajouter</button>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <div class="position-fixed bottom-0 end-0 m-3">
        <a href="add.php" class="btn btn-primary btn-lg rounded-circle">
            <i class="bi bi-plus fs-1"></i>
        </a>
    </div>

    <?php
    include_once 'includes/_footer.php';
