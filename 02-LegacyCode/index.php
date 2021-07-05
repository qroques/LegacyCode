<?php

require_once("User.php");
require_once("Expense.php");

const RED_TEXT = "\e[0;30;31m";
const GREEN_TEXT = "\e[0;30;32m";
const WHITE_TEXT = "\e[0;30;31m";

//User creation
$balances = [];
/** @var User[] $users */
$users = [];
$users[] = $robert = new User('Jean', 'Robichet', 'robert.robichet@domain.com');
$users[] = $marcel = new User('Marcel', 'Patulacci', 'marcel.patulacci@domain.com');
$users[] = $jeanPierre = new User('Jean-Pierre', 'Avidol', 'jean-pierre.avidol@domain.com');


//Expenses creation
/** @var Expense[] $expenses */
$expenses = [];
$expenses[] = new Expense(120, 'Restaurant pour tous le monde', new DateTime('12 june 2021'), $robert, [$robert, $marcel, $jeanPierre]);
$expenses[] = new Expense(23.50, 'La tournée de Marcel', new DateTime('13 june 2021'), $marcel, [$robert, $marcel, $jeanPierre]);
$expenses[] = new Expense(17.30, 'La tournée de Jean-Pierre (Robert n\'a rien pris car il n\'avait pas terminé sa pinte)', new DateTime('13 june 2021'), $jeanPierre, [$marcel, $jeanPierre]);
$expenses[] = new Expense(6.50, 'Robert qui a finalement fini sa pinte et a pris un coca', new DateTime('13 june 2021'), $robert, [$robert]);
$expenses[] = new Expense(30, 'Cadeau de Robert et Marcel pour l\'anniv de Jean-Paul', new DateTime('14 june 2021'), $robert, [$robert, $marcel]);
$expenses[] = new Expense(54.99, 'Marcel a avancé le billet de train retour pour Robert', new DateTime('15 june 2021'), $marcel, [$robert]);

try{
    echo(GREEN_TEXT . "Liste des dépenses" . PHP_EOL);
    echo(GREEN_TEXT . "==================" . PHP_EOL);
    foreach($expenses as $expense) {
        echo(sprintf("- %s %s a payé %s€ (%s€ par participant) (%s)", $expense->getPayer()->getFirstname(), $expense->getPayer()->getLastname(), $expense->getAmount(), $expense->getUnitaryShared(), $expense->getDescription()).PHP_EOL);
        foreach($users as $user) {
            $balances[$user->getFullname()] += $expense->getUserShare($user);
        }
    }
    echo(GREEN_TEXT . "Liste des Soldes de chaque utilisateur" . PHP_EOL);
    echo(GREEN_TEXT . "======================================" . PHP_EOL);
    foreach($balances as $name => $balance) {
        echo(WHITE_TEXT . sprintf("- Solde de %s : %s%s€", $name, $balance < 0 ? RED_TEXT : GREEN_TEXT, $balance) . PHP_EOL);
    }

}catch(\Throwable $exception) {
    echo(RED_TEXT . "Certaines features semblent manquante pour le bon fonctionnement de ce script" . PHP_EOL);
}
