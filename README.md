## db wrapper

> **a database management class writen in php**

 - Generic Query Run
 - Insert
 - Update
 - Find
 - Delete

> **Documentation**
*only in pt-br at the moment, if someone agrees to translate, feel free*	
- **Configurando sua conexão com o banco de dados**
As configurações do DB vão no metodo construtor da classe, localizado no arquivo DB.php
linha 20: `$this->_pdo = new PDO('pgsql:host=IPDOSERVIDOR;port=PORTA;dbname=NOMEDOBANCO','USUARIO','SENHA');`

 - **Chamando / Instanciando o Objeto** *função get_instance()*
  `$db = DB::get_instance();`
A classe conta com uma função que verifica se o objeto já foi instanciado, caso não, instancia e retorna o objeto, caso sim, retorna o objeto que já foi instanciado anteriormente, assim evitando de se criar diversas instancias com o banco de dados.

 - **Executando querys SQL** *função query()*
`$query = $db->query("SELECT * FROM contacts ORDER BY lname, fname");`
`$contacts = $query->get_results();`
A função *query()* recebe e roda um SQL, pode ser usada para inserção, nesse caso a função conta com um sistema de bind de valores para seguraça contra SQL Injection. 
Para inserir:
Crie um array com os valores a ser inseridos no banco
`$contact = ['Ewerton','Marschalk','Ewerton@hotmail.com','44444444444','5555555555555'];`
Na hora de chamar a função, passe o SQL Statement e o Array, no SQL ao invés de adicionar os valores, adicione pontos de interrogação, os mesmos serão preenchidos com os dados do array.
`$db->query("INSERT INTO contacts (fname, lname, email, cell_phone, home_phone) VALUES (?, ?, ?, ?, ?)",$contact);`

- **Inserindo dados no banco** *Função insert()*
A função query recebe o nome da tabela e um array com os campos e os dados a serem inseridos.
Exemplo do array:
`$contact = ['fname'=>'fharu','lname'=>'lharu','email'=>'haru@haru.com','cell_phone'=>'123 456 7890','home_phone'=>'098 765 4321'];`
Chamando a função:
`$db->insert('contacts',$contact);`
Retorna true ou false.
- **Atualizando dados do banco** *Função update()*
A função update recebe o nome da tabela, id e array de campos a serem modificados.
`$contact = ['fname'=>'HARU','email'=>'haru@haru.com'];`
`$db->update('contacts',1,$contact);`
Retorna true ou false

- **Deletando dados do banco** *Função delete()*
A função dele recebe a tabela e o id a ser deletado
`$db->delete(contacts,1);`
Retorna True ou False

- **Consultas** *Funções find() e findFirst()*
A função find recebe o nome da tabela e opcionalmente um array com parametros para a procura.
Dos campos do array: 
	• join: nome das tabelas para fazer inner joins
	• bindJoin: PKs e FKs para o inner join, exemplo: `produto.cod_album = album.id`
	• conditions: campos do WHERE, exemplo: `lname = ?`
	• bind: valores pra buscar no where, vai dar bind nos pontos de interrogação do conditions
	• order: valores para orderby
	• limit: limita o numero de resultados
	exemplo de array:
	`$params = [
	'joins' => ['album','midia'],
'bindjoin' => ['produto.cod_album = album.id','produto.cod_midia = midia.id'],
    'conditions' => ['lname = ?','fname = ?'],
'bind' => ['lharu','fharu'],
'order' => "fname Desc",
 'limit' => 5
];`
chamando a função com o array:
`$contacts = $db->find('contacts',$params);`
`$resultados = $db->get_results;`
A função retorna um Array de objetos com os resultados da consulta, caso não encontre nenhum resultado retorna false
O array é completamente opicional, caso não seja passado um array o comando vai rodar um` SELECT * FROM TABELA`
`$contacts = $db->find('contacts');`
A função **findFirst()** funciona igual a Find, porém retorna apenas o primeiro objeto na forma de objeto
