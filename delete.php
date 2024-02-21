<?php
//conexão com banco de dados PostgreSQL
$host = 'localhost';
$database = 'gerenciador_tarefas'; 
$user = 'postgres';
$password = 'postgres';

try {
    $db = new PDO("pgsql:host=$host;dbname=$database",$user,$password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Recuperação das tarefas para exibição
    $stmt = $db->query("SELECT * FROM tarefas");
    $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verificação se o formulário foi submetido para deletar uma tarefa
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Preparação da declaração DELETE
        $stmt = $db->prepare("DELETE FROM tarefas WHERE nome = :name");

        // Recuperação do nome da tarefa a ser deletada do formulário
        $name = $_POST['nome_da_tarefa'];

        // Substituição do marcador de posição com o valor adequado
        $stmt->bindParam(':name', $name);

        // Execução da declaração
        $stmt->execute();

        // Redirecionamento após a exclusão
        header("Location: view.php");
        exit();
    }
} catch(PDOException $e) {
    echo "Que pena, não deu certo..." . $e->getMessage();
}
?>

<!-- tasks/delete.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <title>Deletar Tarefas</title>
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
                        <a class="nav-link active" aria-current="page" href="view.php">Visualiza Tarefa</a>
                    </li>                    
                </ul>
            </div>
        </div>
    </nav> 
    <div class="p-3 mb-2 bg-secondary text-white">
        <!-- Formulário para deletar tarefa -->
        <h2>Deletar Tarefa</h2>
        <form action="delete.php" method="POST">
            <input type="text" name="nome_da_tarefa" placeholder="Digite a tarefa a ser deletada">
            <button type="submit" class="btn btn-danger">Deletar</button>
        </form>
        
        <!-- Lista de tarefas -->
        <h2>Lista de Tarefas</h2>
        <ul class="list-group list-group-flush">
        <?php foreach($tarefas as $tarefa): ?>
            <li class="list-group-item"><?php echo $tarefa['nome']; ?></li> 
        <?php endforeach; ?>
        </ul>
    </div>
 
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>
