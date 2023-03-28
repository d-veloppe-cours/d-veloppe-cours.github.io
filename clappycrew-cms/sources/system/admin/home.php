<div class="main-home  row">
    <div class="col-md-2">
        <div class="panel-home">
            <div class="panel-button">
                <h4><i class="bi bi-gear"></i> Bientôt disponible</h4>
            </div>
        </div>
    </div>
    <div class="col-auto">
        <h4 class="simple-card white-tr">Bonjour. Bienvenue sur le panel.</h4>
        <div class="card-service">
        <div class="container">
            <div class="container-service">
                    <h4><?= $logo ?> Service <i class="bi bi-arrow-right"></i> <?= $service ?>   </h4>
                    <p>
                        <!--?= $sInfo['num'] ?-->
                        Type de service : <?= $sList[$service]["service"] ?> <br>
                        <!-- ?= $sList[$service]["owner"] ?-->
                        Hébergement : <?= $sList[$service]["offer"] ?> <br>
                        Identifiant : #<?= $sList[$service]["id"] ?> <br>
                    </p>

                    <button class="btn" type="submit" name="start-<?= $service?>" style="background-color: #1DC690;"><i class="bi bi-caret-right"></i> Start </button> 
                    <button class="btn" type="submit" name="reload-<?= $service?>" style="background-color: #F6A21E;"><i class="bi bi-arrow-clockwise"></i> Reload </button> 
                    <button class="btn" type="submit" name="stop-<?= $service?>" style="background-color: #E34234;"><i class="bi bi-stop"></i> Stop </button> 
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</div>