<?php
include '../../../header.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'Administrateur') {
    header('Location: /');
    exit;
}

if(isset($_GET['numStat'])){
    $numStat = (int)$_GET['numStat'];
    $libStat = sql_select("STATUT", "libStat", "numStat = $numStat")[0]['libStat'];
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Modifier un statut</h1>
        </div>
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/statuts/update.php' ?>" method="post">
                <!-- Numéro -->
                <div class="form-group">
                    <label for="libStat">Numero</label>
                    <input id="numStat" name="numStat" class="form-control" style="display: none" type="text" value="<?php echo($numStat); ?>" readonly="readonly" />
                    <input id="numStat" name="numStat" class="form-control" type="text" value="<?php echo($numStat); ?>" readonly="readonly"  />
                </div>

                <!-- Date de création -->
                <div class="form-group">
                    <label for="libStat">Date de création</label>
                    <input id="numStat" name="numStat" class="form-control" style="display: none" type="text" value="<?php echo($numStat); ?>" readonly="readonly" />
                    <input id="libStat" name="libStat" class="form-control" type="text" value="<?php echo($libStat); ?>" readonly="readonly"  />
                </div>

                <!-- Libellé -->
                <div class="form-group">
                    <label for="libStat">Libellé </label>
                    <input id="libStat" name="libStat" class="form-control" type="text" autofocus="autofocus" />
                </div>
            <div class="form-group mt-2">
                <a href="list.php" class="btn btn-primary">List</a>
                <button type="submit" class="btn btn-danger">Confirmer Edit ?</button>
            </div>
        </form>
    </div>
</div>
</div>