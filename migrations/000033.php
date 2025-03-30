<?php
// Diese Migration fügt eine "type"-Spalte zur subscriptions-Tabelle hinzu,
// um zu unterscheiden, ob es sich um eine Ausgabe (expense) oder eine Einnahme (income) handelt

/** @noinspection PhpUndefinedVariableInspection */
$columnQuery = $db->query("SELECT * FROM pragma_table_info('subscriptions') where name='type'");
$columnRequired = $columnQuery->fetchArray(SQLITE3_ASSOC) === false;

if ($columnRequired) {
    // Standardmäßig sind alle bestehenden Einträge Ausgaben (0)
    $db->exec('ALTER TABLE subscriptions ADD COLUMN type INTEGER DEFAULT 0');
    echo "Spalte 'type' wurde zur Tabelle 'subscriptions' hinzugefügt.\n";
}