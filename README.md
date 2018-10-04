# db wrapper

Feita com fins de estudo, acabou sendo a classe que utilizo em todos os meus projetos
pretende atualizar ela conforme achar necessário


### Funções ###

Query: Roda um comando SQL de qualquer tipo
    Recebe uma Query SQL e opcionalmente um array com valores
    essa função é utilizada pro todas as demais funções presentes nessa classe
    Retorna um objeto, e preenche os atributos _results, _count, e _lastInsertID caso rode sem problemas ou adiciona True no atributo _error caso haja algum problema

Insert: Roda um comando SQL do tipo Insert
    Recebe o nome da tabela e um Array com o nome dos campos e Valores a ser inserido
    retorna true ou false

Update: Roda um comando SQL do tipo Update
    Recebe o nome da tabela Recebe o nome da tabela, um Array com o nome dos campos e Valores e o ID de onde será feito as alterações
    retorna true ou false

Delete: Deleta uma entrada do banco
    Recebe tabela e id
    retorna true ou false

Find: Roda um comando SQL do tipo SELECT *
    Recebe um array de parametros onde:
        conditions são condições "WHERE"
        bind são os valores das condições WHERE
        order é o comando para ORDER BY
        limit é para limitar o numero de resultados
    Recebe também a tabela onde ira roda o commando
    Todos os campos são opicionais, podendo passar apenas a tabela para rodar um "SELECT * FROM tabela"
    Retorna um Array de Objetos com o Resultado

FindFirst: Similar ao comando anterios porém retorna apenas o primeiro resultado na forma de um Objeto