
<?php
//conexão com banco de dados postgress
    $host = 'localhost';
    $database = 'gerenciador_tarefas'; 
    $user = 'postgres';
    $password = 'postgres';

    try {
        $db = new PDO("pgsql:host=$host;dbname=$database",$user,$password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $db->query("SELECT * FROM tarefas");
        $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {
        echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    }
?>

<!-- tasks/view.php, exemplo de comentário em HTML -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <title>Lista de Tarefas</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">        
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="add.php">Adicionar Tarefa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="delete.php">Deletar Tarefa</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> 
   
    <div class="p-3 mb-2 bg-secondary text-white">
        <h2>Lista de Tarefas</h2>
    
        <?php foreach($tarefas as $tarefa ): ?>
            <ul class="list-group">
                <li class="list-group-item">
                    <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox">
                    <label class="form-check-label" for="firstCheckbox"><?php echo $tarefa['nome']; ?></label>
                </li>
            </ul>           
        <?php endforeach; ?>
    </div>   

      
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>    
    
</body>
</html>

