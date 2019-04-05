<?php 
$pageConfig = [
    'title'=>'Каталог',
    'cssFiles'=>[
        '/css/style.css',
        '/css/catalog.css'
    ],
    'jsFiles'=>[
        '/js/script.js',
        '/js/catalog.js'
    ],
];

$template = [
    'section' =>(isset($_GET['section'])) ? $_GET['section'] : 'man'
];
include($_SERVER['DOCUMENT_ROOT'].'/parts/header.php');
?>
    <div class='catalog' data-section='<?=$template['section']?>'>
        <div class='catalog-filters'></div>
        <div class='catalog-products'></div>
        <div class='catalog-pagination'></div>
    </div>
<?php 
    include($_SERVER['DOCUMENT_ROOT'].'/parts/footer.php');
?>
