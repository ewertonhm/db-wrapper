<?php

/**
 *
 * @author Ewerton
 */
interface dbControl {
    public static function get_instance();
    public function query();
    public function insert();
    public function update();
    public function delete();
    public function find(); 
    public function findFirst();
}
