<div class="container">
    <div class="row">
        <div class="col-md-8 bg-white">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($_SESSION as $name => $product) : ?>
                        <?php if(substr($name,0,9) == "products_"): ?>
                            <tr>
                                <td><?php echo $product["title"]; ?></td>
                                <td><?php echo $product["price"]; ?></td>
                                <td><?php echo $product["qte"]; ?></td>
                                <td><?php echo $product["total"]; ?></td>
                                    <!-- supprimer produit -->
                                <td> 
                                    <form method="POST" action="<?php echo BASE_URL;?>cancelcart">
                                        <input type="hidden" name="product_id" value="<?php echo $product["id"];?>">
                                        <input type="hidden" name="product_price" value="<?php echo $product["price"];?>">
                                        <input type="hidden" name="product_qte" value="<?php echo $product["qte"];?>">
                                        <button type="submit" class="btn btn-sm btn-danger text-white font-weight-bold p-1">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- paypal -->
            <?php if(isset($_SESSION["count"]) && $_SESSION["count"] > 0  && isset($_SESSION["logged"]) )  : ?>
                <div id="paypal-button-container"></div>
            <?php elseif(isset($_SESSION["count"]) && $_SESSION["count"] > 0): //ila makanch m connecter ?>
                <a href="<?php echo BASE_URL;?>login" class="btn btn-link">Connectez vous pour terminer vos achats</a>
            <?php endif; ?>
        </div>

        <div class="col-4 col-md-4 float-right bg-white">
            <table class="table table-bordered">
                <tbody>
                    
                    <tr>
                        <th scope="row">Produits</th>
                        <td>
                            <?php echo isset($_SESSION["count"]) ? $_SESSION["count"] : 0 ;?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Total TTC</th>
                        <td>
                            <strong id="amount" data-amount="<?php echo  isset($_SESSION["totaux"]) ? $_SESSION["totaux"] : 0;?>">
                                <?php echo isset($_SESSION["totaux"]) ? $_SESSION["totaux"] : 0 ?>
                                <span class="bb-danger">dh</span>
                            </strong>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- button -->
            <?php if(isset($_SESSION["count"]) && $_SESSION["count"] > 0 ): ?>
                <form method="POST" action="<?php echo BASE_URL;?>emptycart">
                    <button type="submit" class="btn btn-primary">
                        Vider le panier
                    </button>                    
                </form>
                <!-- fach idir commande -->
                <form method="POST" id="addOrder" action="<?php echo BASE_URL;?>addOrder"></form>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
        let amount = document.querySelector("#amount").dataset.amount;
        let finalAmount = Math.floor(amount/ 9.86);
        paypal.Buttons({
            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: finalAmount.toString()
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    alert('Commande effectuée par ' + details.payer.name.given_name);
                    document.querySelector("#addOrder").submit();
                });
            }
        }).render('#paypal-button-container');
    </script>