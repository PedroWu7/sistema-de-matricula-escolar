

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Curso</title>
</head>
<body>
    <h1>Editar Curso</h1>
    <form method="post" action="atualizarCurso.php">
        <input type="hidden" name="id" value="<?= $curso['id'] ?>">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= $curso['nome'] ?>" required><br>
        <label>Imagem (URL):</label>
        <input type="text" name="imagem" value="<?= $curso['imagem'] ?>" required><br>
        <label>Descrição:</label>
        <input type="text" name="descricao" value="<?= $curso['descricao'] ?>" required><br>
        <label>Professor (ID ou Nome):</label>
        <input type="text" name="professor" value="<?= $curso['professor'] ?>"><br>
        <input type="submit" value="Atualizar Curso">
    </form>
</body>
</html>
