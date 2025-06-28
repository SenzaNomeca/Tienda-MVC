<h1>Algunos de nuestros productos</h1>

<?php while($product = $productos->fetch_object()): ?>
<div class="product">
    <a href="<?=base_url?>product/ver&id=<?=$product->id?>">
        <?php if($product->imagen != NULL): ?>
        <img src="<?=base_url?>uploads/images/<?=$product->imagen?>" alt="<?=$product->descripcion?>">
        <?php else: ?>
            <img src="<?=base_url?>assets/img/camiseta.png" alt="camiseta por default">
        <?php endif; ?>
        <h2><?=$product->nombre?></h2>
    </a>
    <p><?=$product->precio?></p>
    <?php if($product->stock > 0): ?>
    <a class="button" href="<?=base_url?>cart/add&id=<?=$product->id?>">Comprar</a>
    <?php else: ?>
        <a class="button button-red" >
            Fuera de stock
        </a>

    <?php endif; ?>
</div>
<?php endwhile; ?>

