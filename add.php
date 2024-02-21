<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <title>Adicionar Tarefas</title>
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
                        <a class="nav-link active" aria-current="page" href="view.php">Visualiza Tarefa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="delete.php">Deletar Tarefa</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="p-3 mb-2 bg-secondary text-white">
        <h2>Adicionar Tarefa</h2>
    
        <form action="add.php" method="POST">
            <input type="text" name="nome_da_tarefa" placeholder="Digite a tarefa">
            <button type="submit" class="btn btn-success">Adicionar</button>
        </form>
    </div> 
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script> 
</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_da_tarefa = $_POST["nome_da_tarefa"];
     
    //conexão com banco de dados postgress
    $host = 'localhost';
    $database = 'gerenciador_tarefas'; 
    $user = 'postgres';
    $password = 'postgres';

    try {
        $db = new PDO("pgsql:host=$host;dbname=$database",$user,$password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("INSERT INTO tarefas (nome) VALUES (:name)");
        $stmt->bindParam(':name', $nome_da_tarefa);
        $stmt->execute();

        header("Location: view.php");
        exit();
        
    } catch (PDOException $e) {
        echo "Que pena, não deu certo..." . $e;
    }

    
}