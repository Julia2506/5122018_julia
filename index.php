<?php 
$pageConfig = [
    'title'=>'Главная страница',
    'cssFiles'=>[
        '/css/style.css'
    ],
    'jsFiles'=>[
        '/js/script.js'
    ],
];
include($_SERVER['DOCUMENT_ROOT'].'/parts/header.php');
?>

<?php 
    include($_SERVER['DOCUMENT_ROOT'].'/parts/footer.php');
?>
