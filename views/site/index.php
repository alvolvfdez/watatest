<?php

/* @var $this yii\web\View */
/* @var $cart Cart */

use app\models\Cart;

$this->title = 'Watatest';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">¡Hola!</h1>

        <p class="lead">A continuación la salida del carrito:</p>


    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-12">
                Cliente:
                <?php
                var_dump($cart->getCustomer());
                ?>
                Productos añadidos:
                <?php
                    foreach ($cart->getProductList() as $product)
                    {
                        var_dump($product);
                    }
                ?>
                <br>
                Total del carrito: <?= $cart->totalCalculation() ?><br>
            </div>
        </div>

    </div>
</div>
