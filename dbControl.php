<?php

/**
 *
 * @author Ewerton
 */
interface dbControl {
    public static function get_instance();
    public function query($sql,$params = []);
    public function insert($table, $fields = []);
    public function update($table,$id,$fields = []);
    public function delete($table,$id);
    public function find($table,$params = []); 
    public function findFirst($table,$params = []);
}
