<?php
/*
  Ensure you have SQLite installed:
  ~$ php -r 'var_dump(class_exists("SQLite3"));'
  And install DB via:
  ~$ sqlite3 methods.db < create.sql
*/

require_once '../config.php';

class DB {

    static private $DB;

    static function getInstance() {
        global $CONFIG;

        if (!empty(self::$DB)) return self::$DB;

        try {
            self::$DB = new PDO($CONFIG->PDO_URI);
        } catch(PDOException $ex) {
            self::$DB = NULL;
        }

        return self::$DB;
    }

    static protected function quotize($val) {
        // Deal with strings: escape + add quotes.
        $val = str_replace("'", "''", $val);
        return "'".$val."'";
    }

    static protected function prepare($entry) {
        // Sanitize user input.
        foreach ($entry as $key => &$val) {
            $prefix = substr($key, 0, 4);
            if ($prefix != 'min_' && $prefix != 'max_') {
                $val = self::quotize($val);
            } else {
                $val = floatval($val);
            }
        }
        return $entry;
    }

    static function rank() {
        if (self::$DB == NULL) {
            return self::rank_fallback();
        }

        return self::rank_main();
    }

    static function getAll() {
        if (self::$DB == NULL) {
            throw new Exception('SELECT operation not supported in file mode.');
        }

        $db = self::getInstance();
        $st = $db->query("SELECT * FROM methods");

        return $st->fetch(PDO::FETCH_ASSOC);
    }

    static function getOne($id) {
        if (self::$DB == NULL) {
            throw new Exception('SELECT operation not supported in file mode.');
        }

        $db = self::getInstance();
        $st = $db->query("SELECT * FROM methods WHERE id = ".intval($id));

        return $st->fetch(PDO::FETCH_ASSOC);
    }

    static function insert($entry) {
        if (self::$DB == NULL) {
            throw new Exception('INSERT operation not supported in file mode.');
        }

        $entry = self::prepare($entry);
        $names = array_keys($entry);
        $values = array_values($entry);
        $query = "INSERT INTO methods({$names}) VALUES ({$values})";

        $db = self::getInstance();
        return $db->exec($query);
    }

    static function update($id, $entry) {
        if (self::$DB == NULL) {
            throw new Exception('UPDATE operation not supported in file mode.');
        }

        $entry = self::prepare($entry);
        $values = array();
        foreach ($entry as $key => $val) {
            $values[] = $key.' = '.$val;
        }
        $values = implode(', ', $values);
        $query = "UPDATE methods SET {$values} WHERE id = ".intval($id);

        $db = self::getInstance();
        return $db->exec($query);
    }

    static function delete($id) {
        if (self::$DB == NULL) {
            throw new Exception('DELETE operation not supported in file mode.');
        }

        $query = "DELETE FROM methods WHERE id = ".intval($id);

        $db = self::getInstance();
        return $db->exec($query);
    }

    protected function rank_main() {
        $database = array();
        // Use a separated struct for the ranking.
        $feature_lo = array();
        $feature_hi = array();

        $db = self::getInstance();
        $st = $db->query("SELECT * FROM methods");

        if (!$st) {
            throw new Exception($db->errorInfo());
        }

        while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
            $database[] = array(
                $row['id'],
                $row['title'],
                $row['description'],
                $row['pros'],
                $row['cons'],
            );

            $feature_lo[] = array(
                $row['min_group_size'],
                $row['min_student_workload'],
                $row['min_teacher_workload'],
                $row['min_student_experience'],
                $row['min_teacher_experience'],
                $row['min_student_interaction'],
            );
            $feature_hi[] = array(
                $row['max_group_size'],
                $row['max_student_workload'],
                $row['max_teacher_workload'],
                $row['max_student_experience'],
                $row['max_teacher_experience'],
                $row['max_student_interaction'],
            );
        }

        return array($database, $feature_lo, $feature_hi);
    }

    protected function rank_fallback() {
        require 'tsvparser.php';

        // Fallback case: Load exported Excel sheet from gDrive.
        $filename = dirname(__FILE__).'/methods.tsv';
        list($database, $feature_lo, $feature_hi) = parse_tsv($filename);

        return array($database, $feature_lo, $feature_hi);
    }
}
