<?php if(isset($categoria)): ?>
    <h1><?=$categoria->nombre?></h1>

    <?php if($productos->num_rows == 0): ?>
        <p>No hay productos para mostrar</p>
    <?php else: ?>
        <?php while($prod = $productos->fetch_object()): ?>
            <div class="product">
                <a href="<?=base_url?>product/ver&id=<?=$prod->id?>">
                    <?php if($prod->imagen != NULL): ?>
                        <img src="<?=base_url?>uploads/images/<?=$prod->imagen?>" alt="<?=$prod->descripcion?>">
                    <?php else: ?>
                        <img src="<?=base_url?>assets/img/camiseta.png" alt="camiseta por default">
                    <?php endif; ?>
                    <h2><?=$prod->nombre?></h2>
                </a>
                <p><?=$prod->precio?></p>

                <?php if($prod->stock > 0): ?>
                    <a class="button" href="<?=base_url?>cart/add&id=<?=$prod->id?>">Comprar</a>
                <?php else: ?>
                    <a class="button button-red" >
                        Fuera de stock
                    </a>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>

<?php else: ?>
    <h1>La categoría no existe</h1>
<?php endif; ?>
