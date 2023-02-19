<?php
if(isset($_SESSION['admin']) && $_SESSION['admin'] == true) // admin connecter 
{
    $data = new OrdersController();
    $orders = $data->getAllOrders();
}else{
    Redirect::to("home");
}
?>
<div class="container">
    <div class="row my-5">
        <div class="col-md-10 mx-auto">
            <div class="card bg-light p-3">
                <caption><h3 class="font-weight-bold">Commandes</h3></caption>
                <table class="table table-hover table-inverse">
                    <thead>
                        <tr>
                            <th>Nom & Prenom</th>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                            <th>Total</th>
                            <th>Effectuée le</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($orders as $order) : ?>
                            <tr>
                                <td><?php echo $order["fullname"]; ?></td>
                                <td><?php echo $order["product"]; ?></td>
                                <td><?php echo $order["qte"]; ?></td>
                                <td><?php echo $order["price"]; ?></td>
                                <td><?php echo $order["total"]; ?></td>
                                <td><?php echo $order["done_at"]; ?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>