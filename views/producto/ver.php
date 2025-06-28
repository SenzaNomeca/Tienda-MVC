<?php if(isset($pro)): ?>
    <h1><?=$pro->nombre?></h1>
    <div class="detail_product">
        <div class="product_image">
            <?php if($pro->imagen != NULL): ?>
                <img class="product_img" src="<?=base_url?>uploads/images/<?=$pro->imagen?>" alt="<?=$pro->descripcion?>">
            <?php else: ?>
                <img class="product_img" src="<?=base_url?>assets/img/camiseta.png" alt="camiseta por default">
            <?php endif; ?>
        </div>
        <div class="product_data">
            <div class="data_explain">
                <p class="data_title"><?=$pro->nombre?></p>
                <p class="data_descripcion"><?=$pro->descripcion?></p>
                <p class="data_precio"><?=$pro->precio?></p>
            </div>

            <?php if($pro->stock > 0): ?>
                <a class="button product-bottom" href="<?=base_url?>cart/add&id=<?=$pro->id?>">Comprar</a>
            <?php else: ?>
                <a class="button button-red" >
                    Fuera de stock
                </a>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <h1>El producto no existe</h1>
<?php endif; ?>
