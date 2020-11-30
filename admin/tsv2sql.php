<?php
/*
  Export: php -f tsv2sql.php > create.sql
  Import: sqlite3 methods.db < create.sql
*/
require 'tsvparser.php';

// Deal with strings: escape + add quotes.
function quotize($val) {
    $val = str_replace("'", "''", $val);
    return "'".$val."'";
}

$coldefs = array(
    'id' => 'INTEGER PRIMARY KEY AUTOINCREMENT',
    'title' => 'TEXT',
    'description' => 'TEXT',
    'pros' => 'TEXT',
    'cons' => 'TEXT',
    'min_group_size' => 'REAL',
    'min_student_workload' => 'REAL',
    'min_teacher_workload' => 'REAL',
    'min_student_experience' => 'REAL',
    'min_teacher_experience' => 'REAL',
    'min_student_interaction' => 'REAL',
    'max_group_size' => 'REAL',
    'max_student_workload' => 'REAL',
    'max_teacher_workload' => 'REAL',
    'max_student_experience' => 'REAL',
    'max_teacher_experience' => 'REAL',
    'max_student_interaction' => 'REAL',
);

$defvals = array();
foreach ($coldefs as $key => $value) {
    $defvals[] = $key.' '.$value;
}
$defvals = implode(', ', $defvals);

print_r("DROP TABLE methods;".PHP_EOL);
print_r("CREATE TABLE methods({$defvals});".PHP_EOL);

$names = implode(',', array_keys($coldefs));

list($database, $feature_lo, $feature_hi) = parse_tsv('methods.tsv');
foreach ($database as $row_num => $entry) {
    list($title, $description, $pros, $cons) = array_values($entry);

    $lo = $feature_lo[$row_num];
    $hi = $feature_hi[$row_num];
    list($min_group_size, $min_student_workload, $min_teacher_workload,
         $min_student_experience, $min_teacher_experience, $min_student_interaction) = array_values($lo);
    list($max_group_size, $max_student_workload, $max_teacher_workload,
         $max_student_experience, $max_teacher_experience, $max_student_interaction) = array_values($hi);

    $values = array(
        $row_num + 1,
        quotize($title), quotize($description), quotize($pros), quotize($cons),
        $min_group_size, $min_student_workload, $min_teacher_workload,
        $min_student_experience, $min_teacher_experience, $min_student_interaction,
        $max_group_size, $max_student_workload, $max_teacher_workload,
        $max_student_experience, $max_teacher_experience, $max_student_interaction
    );
    $values = implode(',', $values);

    print_r("INSERT INTO methods({$names}) VALUES ({$values});".PHP_EOL);
}
