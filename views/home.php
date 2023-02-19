<?php

    $categories = new CategoriesController();
    $categories = $categories->getAllCategories();

    if(isset($_POST["cat_id"])) 
    {
        $products = new ProductsController();
        $products = $products->getProductsByCategory($_POST['cat_id']);
    }else {     // maclikach 3la catégorie
        $data = new ProductsController();
        $products = $data->getAllProducts();
    }

?>

<div class="container">
    <div class="row my-5">
        <div class="col-md-8">
            <div class="row">
                <?php
                    if(count($products) > 0) :
                        // print_r($_SESSION);
                ?>
                    <?php
                        foreach($products as $product) :
                    ?>
                    <div class="col-md-6 mb-2">
                        <div class="card h-100 bg-white rounded p-2">
                            
                            <!-- -------- Title Produit -------- -->
                            <div class="card-header bg-light">
                                <!-- form -->
                                <form id="form" method="POST" action="<?php echo BASE_URL;?>show">
                                    <input type="hidden" name="product_id" id="product_id"/>
                                </form>
                                <!-- id -->
                                <h3 onclick="submitForm(<?php echo $product['product_id']; ?>)" class="card-title">
                                    <?php // ---- Title Produit ----
                                        echo $product['product_title'];
                                    ?>
                                </h3>
                            </div>

                            <!-- image produit -->
                            <div class="card-img-top">
                                    <img 
                                        src="./public/uploads/<?php echo $product["product_image"]; ?>" 
                                        alt="" class="img-fluid"
                                    >
                            </div>
    
                            <!--short desc -->
                            <div class="card-body">
                                <div class="card-text">
                                    <?php
                                        echo $product['short_desc'];
                                    ?>
                                </div>
                            </div>
                            <!-- prix produit -->
                            <div class="card-footer">
                                <span class="badge badge-danger p-2">
                                    <?php // new prix
                                        echo $product['product_price'];
                                    ?> dh
                                </span>
                                <span class="badge badge-dark p-2">
                                    <strike>
                                        <?php // old prix
                                            echo $product['old_price'];
                                        ?> dh
                                    </strike>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php
                        endforeach;
                    ?>
                <?php   // no produit
                    else :
                ?>
                    <div class="alert alert-danger">
                        aucun produit trouvé 
                    </div>
                <?php
                    endif;
                ?>
            </div>
        </div>

        <!-- catégories  -->
        <div class="col-md-4">
            <h3 class="text-secondary m-3 text-center">
                Catégories
            </h3>
            <ul class="list-group">
                <?php
                    foreach($categories as $category) :
                ?>
                    <li class="list-group-item text-center">

                        <!-- form la meme page-->
                        <form id="catPro" method="POST" action="<?php echo BASE_URL; ?>"> 
                            <!-- value == $id -->
                            <input type="hidden" name="cat_id" id="cat_id"/>
                        </form>

                        <!--  --------------- link ------------------------- -->
                        <a onclick="getCatProducts(<?php echo $category['cat_id']; ?>)" 
                            class="btn btn-link text-secondary" 
                            style="text-decoration:none;font-size:24px;cursor:pointer;">
                            <!-- titre -->
                            <?php
                                echo $category['cat_title'];
                            ?>
                            <!-- count produit by categorie -->
                            (<?php
                                $productsByCat = new ProductsController();
                                $productsByCat = $productsByCat->getProductsByCategory($category['cat_id']);
                                echo count($productsByCat);
                            ?>)
                        </a>
                    </li>
                <?php
                    endforeach;
                ?>
            </ul>
        </div>
    </div>
</div>