<footer>
    <div class="footer">
        <?php 
            $ano = date("Y");
            echo "<p>Davi Simionato - $ano</p>";
        ?>
        <p style="font-size: 11px;">
            As imagens, preços, marcas e produtos são de total autoria da empresa Kabum™ | CNPJ: 05.570.714/0001-59 |  
            disponíveis para acesso em https://www.kabum.com.br
        </p>
    </div>
</footer>
<?php 
    $bd->close();
?>