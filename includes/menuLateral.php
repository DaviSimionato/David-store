<?php 
    $departamentosLateral = $bd->query("select * from departamentos");
?>
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
            <span style="font-size:40px;" class="material-symbols-outlined fechaMenu">close</span>
        </div>
        <div class="departamentosMenuLateral">
            <h3>Departamentos</h3>
            <ul>
                <?php 
                    while($dep = $departamentosLateral->fetch_object()) {
                        echo "
                        <li class='departamentoMenuLateral'>
                            <div class='depNome'>
                                <p>{$dep->departamento}</p>
                                <span style='' class='material-symbols-outlined setaDepartamentos'>
                                    expand_more
                                </span>
                            </div>";
                        $categoriasLateral = $bd->query("select * from categorias where idDepartamento = {$dep->idDepartamento}");
                        while($cat = $categoriasLateral->fetch_object()) {
                            echo "
                                <div class='categoriaMenuLateral'>
                                    <a href='pesquisa.php?categoria={$cat->categoria}'>{$cat->categoria}</a>
                                </div>";
                        } 
                        echo "</li>";
                    }
                ?>
            </ul>
        </div>
        <?php 
            if(!isset($_SESSION["user"])) {
                echo "
                <div class='btnEntrar'>
                    <a href='entrar.php' style='text-transform: uppercase;'>Entrar</a>
                </div>
                ";
            }else {
                echo "
                <div class='btnEntrar'>
                    <a href='entrar.php' style='text-transform: uppercase;'>Sair</a>
                </div>
                ";
            }
        ?>
    </div>
    <div class="menuLateralOverlay">
    </div>
</div>