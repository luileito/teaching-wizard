<?php
/*
  Export: php -f tsv2sqlite.php > sqlite.sql
  Import: sqlite3 methods.db < sqlite.sql
*/
require 'tsvparser.php';
require 'tsvutils.php';

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

print_insert_statements($coldefs, dirname(__FILE__).'/methods.tsv');
