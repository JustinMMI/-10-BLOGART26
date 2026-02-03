<?php
include '../../../header.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur'&& $_SESSION['user']['statut'] !== 'Modérateur') {
    header('Location: /');
    exit;
}

if(isset($_GET['numMotCle'])){
    $numMotCle = (int)$_GET['numMotCle'];
    $libMotCle = sql_select("MOTCLE", "libMotCle", "numMotCle = $numMotCle")[0]['libMotCle'];
}
?>

<div class="container">
<div class="row">
    <div class="col-md-12">
        <h1>Modifier Statut</h1>
    </div>
    <div class="col-md-12">
        <!-- Form to create a new statut -->

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Modifier un mot-clé</h1>
        </div>
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/keywords/update.php' ?>" method="post">
                <!-- Numéro -->
                <div class="form-group">
                    <label for="libMotCle">Numero</label>
                    <input id="numMotCle" name="numMotCle" class="form-control" style="display: none" type="text" value="<?php echo($numMotCle); ?>" readonly="readonly" />
                    <input id="numMotCle" name="numMotCle" class="form-control" type="text" value="<?php echo($numMotCle); ?>" readonly="readonly"  />
                </div>

                <!-- Mot cle -->
                <div class="form-group">
                    <label for="libMotCle">Mot cle </label>
                    <input id="libMotCle" name="libMotCle" class="form-control" type="text" autofocus="autofocus" />
                </div>
            <div class="form-group mt-2">
                <a href="list.php" class="btn btn-primary">List</a>
                <button type="submit" class="btn btn-danger">Confirmer Edit ?</button>
            </div>
        </form>
    </div>
</div>
</div>