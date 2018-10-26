<?php

/**
 *
 * @author Ewerton
 */
interface dbControl {
    // Verifica se o objeto PDO ja está instanciado, caso esteja, retorna o Objeto PDO, caso não, instancia e então retonar
    public static function get_instance();
        // ex:
            // $db recebe o objeto PDO
            // $db = DB::get_instance();
            
    // função query
    // Recebe e roda um SQL
    // Pode receber um Array com valores para serem inseridos no Banco em caso do SQL ser um insert
    // Ao passar um SQL de inserção, no lugar dos valores inserir ?, a função ira fazer um bind deles aos valores passados no Array 
    public function query();
        // ex:
            // array com os valores a serem inseridas no banco
            // $contact = ['Ewerton','Marschalk','Ewerton@hotmail.com','44444444444','5555555555555'];

            // chamando a função passando um SQL de inserção e um Array
            // $db->query("INSERT INTO contacts (fname, lname, email, cell_phone, home_phone) VALUES (?, ?, ?, ?, ?)",$contact);

            // chamando a função com um SQL de Select, o $query vai receber um objeto com o resultado
            // $query = $db->query("SELECT * FROM contacts ORDER BY lname, fname");

            // a função get_results é similar ao pg_fetch, retorna um array com os resultados
            // $contacts = $query->get_results();
    
    // função Insert
    // recebe o nome da tabela, e um array com o nome do campo e valor a ser inserido
    // monta o Insert do SQL e roda a função query passando o SQL e os valores
    // retorna true ou false;
    public function insert();
        // ex:
            // array com o nome do campo e valor
            // $contact = ['fname'=>'fharu','lname'=>'lharu','email'=>'haru@haru.com','cell_phone'=>'123 456 7890','home_phone'=>'098 765 4321'];
    
            // função recebe o nome da tabela e o array
            // $db->insert('contacts',$contact);
    // função Update
    // similar a função anterior, porém ao invés de inserir no banco, altera o valor 
    // recebe o nome da tabela, id e campos a serem modificado com seus respectivos valores
    // retorna true ou false;
    public function update();
        // ex:
            // array com os nomes dos campos e valores
            // $contact = ['fname'=>'HARU','email'=>'haru@haru.com'];
    
            // função recebe tabela, id, e array 
            // $db->update('contacts',1,$contact);
    
    // função Delete
    // deleta um entrada do banco de dados, recebe a tabela e o Id
    // retorna true ou false;
    public function delete();
        // ex: 
            // $db->delete(contacts,1);
    // recebe um array com parametros
    // joins é a tabela onde dar inner join
    // binjoins é as PK e FKs
    // condition é os campos para o WHERE
    // bind é os valores dos campos no WHERE
        // exemplo WHERE 'conditions' = 'bind'
    // order é o valor do ORDER BY
    // limit é o limite de resultados para exibir
    // qualquer um dos campos pode ser deixado em branco
    // retorna um array de objetos com o resultado
    public function find();
        // ex:
            // exemplo de array de parametros
            //$params = [
            //    'joins' => ['album','midia'],
            //    'bindjoin' => ['produto.cod_album = album.id','produto.cod_midia = midia.id'],
            //    'conditions' => ['lname = ?','fname = ?'],
            //    'bind' => ['lharu','fharu'],
            //    'order' => "fname Desc",
            //    'limit' => 5
            //];

            // chamando a função na tabela contacts com os parametros do array 
            //$contacts = $db->find('contacts',$params);

            //$resultados = $db->get_results;


            // não é necessario passar nenhum parametro
            // nesse caso o comando vai rodar um "SELECT * FROM tabela"
            //$contacts = $db->find('contacts');
    
    // Função findFirst
    // similar a função anterior, porém retorna apenas o primeiro resultado        
    public function findFirst();
        // ex:
            //$params = [
            //    'conditions' => ['lname = ?','fname = ?'],
            //    'bind' => ['lharu','fharu'],
            //    'order' => "fname Desc",
            //    'limit' => 5
            //];
            //$contacts = $db->findFirst('contacts',$params);
}
