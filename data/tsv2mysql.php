<?php
/*
  Export: php -f tsv2mysql.php > mysql.sql
  Import: mysql -u YOUR_USERNAME -p'YOUR_PASSWORD' < mysql.sql
*/
require 'tsvparser.php';
require 'tsvutils.php';

$coldefs = array(
    'id' => 'INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
    'title' => 'VARCHAR(255) NOT NULL',
    'description' => 'TEXT NOT NULL',
    'pros' => 'TEXT',
    'cons' => 'TEXT',
    'min_group_size' => 'FLOAT(2)',
    'min_student_workload' => 'FLOAT(2)',
    'min_teacher_workload' => 'FLOAT(2)',
    'min_student_experience' => 'FLOAT(2)',
    'min_teacher_experience' => 'FLOAT(2)',
    'min_student_interaction' => 'FLOAT(2)',
    'max_group_size' => 'FLOAT(2)',
    'max_student_workload' => 'FLOAT(2)',
    'max_teacher_workload' => 'FLOAT(2)',
    'max_student_experience' => 'FLOAT(2)',
    'max_teacher_experience' => 'FLOAT(2)',
    'max_student_interaction' => 'FLOAT(2)',
);

$defvals = array();
foreach ($coldefs as $key => $value) {
    $defvals[] = $key.' '.$value;
}
$defvals = implode(', ', $defvals);

print_r("CREATE DATABASE IF NOT EXISTS teaching_wizard;".PHP_EOL);
print_r("USE teaching_wizard;".PHP_EOL);
print_r("DROP TABLE IF EXISTS methods;".PHP_EOL);
print_r("CREATE TABLE methods({$defvals});".PHP_EOL);

print_insert_statements($coldefs, dirname(__FILE__).'/methods.tsv');
