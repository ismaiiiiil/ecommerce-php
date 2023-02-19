<?php
$id = $_POST["product_id"];
$price = $_POST["product_price"];
$qte = $_POST["product_qte"];
$data = new ProductsController();
$data->emptyCart($id,$price,$qte);