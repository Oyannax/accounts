<?php
require_once 'vendor/autoload.php';
require_once 'includes/_functions.php';
include 'includes/_db.php';

if (!isset($_REQUEST['action'])) addErrorAndExit('Aucune action.');

session_start();
checkCSRF('index.php');
checkXSS($_REQUEST);

// Add a transaction
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_REQUEST['action'] === 'add') {
    if (!is_numeric($_REQUEST['amount'])) addErrorAndExit('Veuillez saisir un montant valide.', 'add.php');

    if (empty($_REQUEST['category'])) $_REQUEST['category'] = NULL;

    $addTransac = $dbCo->prepare("INSERT INTO transaction (name, amount, date_transaction, id_category) VALUES (:name, :amount, :date, :category);");
    $isAddOk = $addTransac->execute([
        'name' => $_REQUEST['name'],
        'amount' => $_REQUEST['amount'],
        'date' => $_REQUEST['date'],
        'category' => $_REQUEST['category'],
    ]);

    if (!$isAddOk || $addTransac->rowCount() !== 1) addErrorAndExit('Votre opération n\'a pas pu être créée.');

    addMsg('Votre opération a bien été ajoutée.');
} else
// Edit a transaction
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_REQUEST['action'] === 'edit' && isset($_REQUEST['id'])) {
    $id = intval($_REQUEST['id']);

    if (empty($id)) addErrorAndExit('Impossible de cibler l\'opération.');

    if (!is_numeric($_REQUEST['amount'])) addErrorAndExit('Veuillez saisir un montant valide.', 'edit.php?id='.$id);

    if (empty($_REQUEST['category'])) $_REQUEST['category'] = NULL;

    $editTransac = $dbCo->prepare("UPDATE transaction SET name = :name, amount = :amount, date_transaction = :date, id_category = :category WHERE id_transaction = :id;");
    $isEditOk = $editTransac->execute([
        'name' => $_REQUEST['name'],
        'amount' => $_REQUEST['amount'],
        'date' => $_REQUEST['date'],
        'category' => $_REQUEST['category'],
        'id' => $id
    ]);

    if (!$isEditOk || $editTransac->rowCount() !== 1) addErrorAndExit('Votre opération n\'a pas pu être modifiée.');

    addMsg('Votre opération a bien été modifiée.');
} else
// Delete a transaction
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_REQUEST['action'] === 'delete' && isset($_REQUEST['id'])) {
    $id = intval($_REQUEST['id']);

    if (empty($id)) addErrorAndExit('Impossible de cibler l\'opération.');

    $delete = $dbCo->prepare("DELETE FROM transaction WHERE id_transaction = :id;");
    $isDeleteOk = $delete->execute([
        'id' => $id
    ]);

    if (!$isDeleteOk || $delete->rowCount() !== 1) addErrorAndExit('Votre opération n\'a pas pu être supprimée.');

    addMsg('Votre opération a bien été supprimée.');
}

header('Location: index.php');