<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <title>Criar Pessoa</title>
</head>

<body>
    <a class="btn btn-primary" href="index.php">Voltar para tela inicial</a>
    <div class="container">

        <h1 class="header">Criar Pessoa</h1>
        <form action="criar.php" method="post">
            <div class=" row row-field">
                <div class="col-sm">
                    <label class="label">Nome</label class="label">
                    <input size="50" class="form-control" name="nome" type="text" required="" value="">
                </div>
                <div class="col-sm">
                    <label class="label">CPF</label class="label">
                    <input size="80" class="form-control" name="cpf" type="text" required="" value="">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label class="label">Data de nascimento</label class="label">
                    <input size="80" class="form-control" name="data_nasc" type="text" required="" value="">
                </div>
                <div class="col-sm-2">
                    <label class="label">Altura</label class="label">
                    <input size="80" class="form-control" name="altura" type="text" required="" value="">
                </div>
                <div class="col-sm-2">
                    <label class="label">Peso</label class="label">
                    <input size="80" class="form-control" name="peso" type="text" required="" value="">
                </div>
                <div class="col-sm-4">
                    <label class="label">Cor da pele</label class="label">
                    <select name="cor_da_pele" class="custom-select d-block">
                        <option>Escolha a cor da pele</option>
                        <option value="Branca">Branca</option>
                        <option value="Negra">Negra</option>
                        <option value="Parda">Parda</option>
                    </select>
                </div>
            </div>
            <div class="text-center" style="margin-top:10px;">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" name="sexo" type="radio" id="sexo" value="M" ?>
                    <label class="form-check-label">Masculino</label>
                    <hr class="mb-4">
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" name="sexo" type="radio" name="inlineRadioOptions" id="sexo" value="F" ?>
                    <label class="form-check-label">Feminino</label>
                </div>
            </div>
            <div>
                <button class="btn btn-primary btn-block">Criar</button>
            </div>
        </form>
    </div>
</body>

</html>
<?php
require 'pessoa.php';
require 'banco.php';
$pessoa = new Pessoa();
if (!empty($_POST)) {
    $pessoa->setNome($_POST['nome']);
    $pessoa->setCpf($_POST['cpf']);
    $pessoa->setData_nasc($_POST['data_nasc']);
    $pessoa->setAltura($_POST['altura']);
    $pessoa->setPeso($_POST['peso']);
    $pessoa->setCor_da_pele($_POST['cor_da_pele']);
    $pessoa->setSexo($_POST['sexo']);

    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO pessoa (nome, cpf, data_nasc, altura, peso,cor_da_pele,sexo) VALUES(?,?,?,?,?,?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($pessoa->getNome(), $pessoa->getCpf(), $pessoa->getData_nasc(), $pessoa->getAltura(), $pessoa->getPeso(), $pessoa->getCor_da_pele(), $pessoa->getSexo()));
    header("Location: index.php");
    Banco::desconectar();
}
?>