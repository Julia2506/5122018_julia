<?php 
$pageConfig = [
    'title'=>'Карточка товара',
    'cssFiles'=>[
        '/css/style.css'
    ],
    'jsFiles'=>[
        '/js/script.js',
        '/js/product.js',
    ],
];
include($_SERVER['DOCUMENT_ROOT'].'/parts/header.php');

$template = [
    'product'=>[],
    'catalog'=>[]
];

if(isset($_GET['id'])) {
    $sql_products = "SELECT * FROM products WHERE id = {$_GET['id']}";
    $result_products = mysqli_query($db, $sql_products);

    $template['product'] = mysqli_fetch_assoc($result_products);
    d($template);  
    
    $sql_product_catalog = "SELECT * FROM product_catalog WHERE product_id = {$_GET['id']}";
    $result_product_catalog = mysqli_query($db, $sql_product_catalog);

    $catalog_id = mysqli_fetch_assoc($result_product_catalog)['catalog_id'];

    $sql_catalog = "SELECT * FROM catalogs WHERE id = {$catalog_id}";
    $result_catalog = mysqli_query($db, $sql_catalog);

    $template['catalog'] = mysqli_fetch_assoc($result_catalog);
    d($template);  

} else {
    header("HTTP/1.1 303 See Other");
    header("Location: /catalog.php");
}
?>

<?php if(!empty($template['product'])): ?>
    <div class="product">
        <img src="<?=$template['product']['img_src']?>">
        <h3><?=$template['product']['name']?></h3>
        <p><?=$template['product']['price']?> рублей</p>
        <p><?=$template['product']['description']?></p>
        <p><?=$template['catalog']['name']?></p>
        <button data-product-id = '<?=$template['product']['id']?>' class='add-to-basket'>Добавить в корзину</button>
    </div>
<?php else: ?>
    <h2>Такого товара нет</h2>
<?php endif; ?>



<?php 
    include($_SERVER['DOCUMENT_ROOT'].'/parts/footer.php');
?>
