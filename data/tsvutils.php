<?php
// Deal with strings: escape + add quotes.
function quotize($val) {
    $val = str_replace("'", "''", $val);
    return "'".$val."'";
}

function print_insert_statements($coldefs, $tsv_file) {
    $names = implode(',', array_keys($coldefs));

    list($database, $feature_lo, $feature_hi) = parse_tsv($tsv_file);

    foreach ($database as $row_num => $entry) {
        list($id, $title, $description, $pros, $cons) = array_values($entry);

        $lo = $feature_lo[$row_num];
        $hi = $feature_hi[$row_num];
        list($min_group_size, $min_student_workload, $min_teacher_workload,
             $min_student_experience, $min_teacher_experience, $min_student_interaction) = array_values($lo);
        list($max_group_size, $max_student_workload, $max_teacher_workload,
             $max_student_experience, $max_teacher_experience, $max_student_interaction) = array_values($hi);

        $values = array(
            $id,
            // Text data.
            quotize($title), quotize($description), quotize($pros), quotize($cons),
            // Min values.
            $min_group_size, $min_student_workload, $min_teacher_workload,
            $min_student_experience, $min_teacher_experience, $min_student_interaction,
            // Max values.
            $max_group_size, $max_student_workload, $max_teacher_workload,
            $max_student_experience, $max_teacher_experience, $max_student_interaction
        );
        $values = implode(',', $values);

        print_r("INSERT INTO methods({$names}) VALUES ({$values});".PHP_EOL);
    }
}
