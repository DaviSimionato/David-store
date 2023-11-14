<div class="mLateral">
    <div class="menuLateralOpen">
        <div class="ola">
            <?php 
                if(isset($_SESSION["user"])) {
                    echo "<h2>Olá {$_SESSION["user"]->nome}</h2>";
                }else {
                    echo "<h2>Olá. Faça seu login</h2>";
                }
            ?>
            <span style="color: #fff;font-size:40px;" class="material-symbols-outlined fechaMenu">close</span>
        </div>
    </div>
    <div class="menuLateralOverlay">
    </div>
</div>