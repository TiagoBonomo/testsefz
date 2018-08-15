<?php

class bancoClasse extends SQLite3 {
    function __construct() {
       $this->open('debito101.db');
    }
 }

 
 