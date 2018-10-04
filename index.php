<?php

// importa a classe DB
require_once 'DB.php';

// istancia o objeto em $db;
$db = DB::get_instance();

// função query
// Recebe e roda um SQL
// Pode receber um Array com valores para serem inseridos no Banco em caso do SQL ser um insert
// Ao passar um SQL de inserção, no lugar dos valores inserir ?, a função ira fazer um bind deles aos valores passados no Array 
    
    // array com os valores a serem inseridas no banco
    $contact = [NULL,'Ewerton','Marschalk','Ewerton@hotmail.com','44444444444','5555555555555'];

    // chamando a função passando um SQL de inserção e um Array
    $db->query("INSERT INTO `contacts` (`id`,`fname`, `lname`, `email`, `cell_phone`, `home_phone`) VALUES (?, ?, ?, ?, ?, ?)",$contact);

    // chamando a função com um SQL de Select, o $query vai receber um objeto com o resultado
    $query = $db->query("SELECT * FROM contacts ORDER BY lname, fname");

    // a função get_results é similar ao pg_fetch, retorna um array com os resultados
    $contacts = $query->get_results();
    //var_dump($contacts);

    
// função Insert
// recebe o nome da tabela, e um array com o nome do campo e valor a ser inserido
// monta o Insert do SQL e roda a função query passando o SQL e os valores
// retorna true ou false;
      
    // array com o nome do campo e valor
    $contact = ['fname'=>'fharu','lname'=>'lharu','email'=>'haru@haru.com','cell_phone'=>'123 456 7890','home_phone'=>'098 765 4321'];
    
    // função recebe o nome da tabela e o array
    $db->insert('contacts',$contact);
    
// função Update
// similar a função anterior, porém ao invés de inserir no banco, altera o valor 
// recebe o nome da tabela, id e campos a serem modificado com seus respectivos valores
// retorna true ou false;

    // array com os nomes dos campos e valores
    $contact = ['fname'=>'HARU','email'=>'haru@haru.com'];
    
    // função recebe tabela, id, e array 
    $db->update('contacts',1,$contact);