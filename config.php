<?php
// === UI search params ===
// Each param is defined in the [1,5] range.
// We begin with neutral scores by default.
$UI_PARAMS = array(
  'group_size' => 3,
  'student_workload' => 3,
  'teacher_workload' => 3,
  'student_experience' => 3,
  'teacher_experience' => 3,
  'student_interaction' => 3,
);

//
// Don't edit below this line!
//
$cfg_file = dirname(__FILE__).'/.env';
$CONFIG = (object) parse_ini_file($cfg_file, false, INI_SCANNER_RAW);
