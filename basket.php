<?php 
$pageConfig = [
    'title'=>'Корзина',
    'cssFiles'=>[
        '/css/style.css',
        '/css/basket.css'
    ],
    'jsFiles'=>[
        '/js/script.js',
        '/js/basket.js'
    ]
];
include($_SERVER['DOCUMENT_ROOT'].'/parts/header.php');
session_start();
d($_SESSION);

$template = [
    'products'=>[]
];

foreach($_SESSION['basket'] as $basketItem) {
    $sql = "SELECT * FROM products WHERE id = {$basketItem['product_id']}";
    $result = mysqli_query($db, $sql);
    $product = mysqli_fetch_assoc($result);
    $product['count'] = $basketItem['count'];
    $product['final_price'] = $basketItem['count'] * $product['price'];
    $template['products'][] = $product;
    d($template);
}

?>

<!-- <div class="basket-box">
    <?php if(!empty($template['products'])): ?>
        <?php foreach($template['products'] as $templateItem):?> 

            <div class="basket-box-item">
                <p><?$templateItem['img_src']?></p>
                <p class="col">
                <span><?=$templateItem['name']?></span>
                <i>арт. <?=$templateItem['sku']?></i>
                </p>
                <p><?=$templateItem['price']?></p>
                <p><?=$templateItem['count']?></p>
                <p><?=$templateItem['final_price']?></p>
                <div class="del" data-del-id = <?=$templateItem['id']?> ></div>
            </div>
            
        <?php endforeach; ?>
    <?php else: ?>
        <h3>Корзина пуста</h3>
    <?php endif; ?>
</div> -->

    <?php if(!empty($template['products'])): ?>
        <table class="basket-box">
        <caption>Ваша корзина</caption>
            <tr>
                <th>Фото</th>
                <th>Наименование</th>
                <th>Размер</th>
                <th>Количество</th>
                <th>Стоимость</th>
                <th>Удалить</th>
            </tr>
        <?php foreach($template['products'] as $templateItem):?> 
        <tr>
            <td class="photo">
                <div style = "background-image: url(<?=$templateItem['img_src']?>)"></div>
            </td>
            <td class="name"> 
                <span><?=$templateItem['name']?></span><br>
                <i>арт. <?=$templateItem['sku']?></i>
            </td>
            <td class="size">s</td>
            <td class="count">
                <div><?=$templateItem['count']?></div>
                <div class="bnts">
                    <div>+</div>
                    <div>-</div>
                </div>
            </td>
            <td class="final-price"><?=$templateItem['final_price']?> руб.</td>
            <td class="del" data-del-id = <?=$templateItem['id']?>></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <h3>Корзина пуста</h3>
    <?php endif; ?> 
</table>

<?php 
    include($_SERVER['DOCUMENT_ROOT'].'/parts/footer.php');
?>
