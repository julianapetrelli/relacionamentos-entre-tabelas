# SEARCH LIKE AND FULL TEXT 

## Utilizando o operador Like

O operador LIKE é usado em uma cláusula WHERE para pesquisar por um padrão especificado em uma coluna.

```php
$conn = require __DIR__.'/utils/connection.php';

$term = $argv[1] ?? null;
$term = '%'.$term.'%';

**$stmt = $conn->prepare('SELECT * FROM posts WHERE body LIKE ?;');
$stmt->bind_param('s', $term);
$stmt->execute();**

$result = $stmt->get_result();
$posts = $result->fetch_all(MYSQLI_ASSOC);

foreach ($posts as $post) {
    echo $post['title']. PHP_EOL;
    echo $post['body']. PHP_EOL;
    echo PHP_EOL;
}
```

## Uso da % exemplo:

<div align="center">
 <img alt="fulltext" height="100" src="https://i.imgur.com/hqQdmJm.png">
</div>

Nos queremos selecionar as pessoas que vivem em uma cidade que começa com 'S':

```
   1:SELECT * FROM Pessoas
   2:WHERE cidade LIKE 'S%'
```

O símbolo % pode ser usado para definir um padrão (letras faltando no padrão) tanto antes como depois do padrão. O resultado da pesquisa acima será:

<div align="center">
 <img alt="fulltext" height="100" src="https://i.imgur.com/hqQdmJm.png">
</div>

Agora nós queremos selecionar as pessoas que vivem em uma cidade cujo nome termina com 'S':

```
   1:SELECT * FROM Pessoas
   2:WHERE cidade LIKE '%s'
```

O resultado para esta pesquisa será:

<div align="center">
 <img alt="fulltext" height="100" src="https://i.imgur.com/kBeJbMx.png">
</div>

## Utilizando o operador full-text

Para efetuar a pesquisa através de um índice fulltext utilizamos as funções MATCH e AGAINST, que recebem o nome dos campos e o valor a ser pesquisado, respectivamente. Veja o exemplo:

```php
$stmt = $conn->prepare('SELECT *, MATCH(title, body) AGAINST(? IN BOOLEAN MODE) as score FROM posts ORDER BY score DESC ;');
$stmt->bind_param('s', $term);
$stmt->execute();
```

**MATCH:** Uma construção especial usada para realizar uma pesquisa de texto completo em um índice de texto completo. Quando match() é usado em uma cláusula, como no exemplo mostrado anteriormente, **as linhas devolvidas são automaticamente classificadas com a maior relevância primeiro**. Valores de relevância são números de pontos flutuantes não negativos. Nenhuma relevância significa nenhuma semelhança. **A relevância é calculada com base no número de palavras na linha (documento), no número de palavras únicas na linha, no número total de palavras na coleção e no número de linhas que contêm uma palavra específica**. 

Conteúdo da pesquisa:

```sql
INSERT INTO posts (title, body) VALUES
    ("Laravel framework", "O laravel é muito utilizado hoje em dia"),
    ("CakePHP", "Framework de desenvolvimento rápido"),
    ("Slim Framework", "Micro framework, podemos utilizar o Eloquent do laravel nele")
    
```

<div align="center">
 <img alt="fulltext" height="490" width="1000" src="https://i.imgur.com/tDMjNJl.gif">
 <img alt="like" height="490" width="1000" src="https://i.imgur.com/WfGcqi1.gif">
</div>