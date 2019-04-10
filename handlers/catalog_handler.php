<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/config/configuration.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/config/functions.php');

    $page = (int)$_GET['page'];
    $section = (isset ($_GET['section'])) ? $_GET['section'] : 'man';
    $filter_price = (isset ($_GET['filters_price'])) ? explode ('-', $_GET['filters_price']) : [];
    $filter_category = (isset ($_GET['filter_category'])) ? ($_GET['filter_category']) : '';
    // d($filter_category);
    $sql_count_rows = "SELECT  COUNT(id) as len FROM products
    WHERE id IN 
    (
        SELECT pc.product_id FROM catalogs as c
        JOIN product_catalog as pc ON c.id=pc.catalog_id
        JOIN product_category as pct ON pc.product_id=pct.product_id 
        WHERE c.code = '{$section}' 
    ";

    if(!empty($filter_price)) {
    $sql_count_rows .= " AND price >={$filter_price[0]} AND price <={$filter_price[1]}";
    }

    if(!empty($filter_category)) {
    $sql_count_rows .= " AND pct.category_id = (SELECT id FROM category WHERE code = '{$filter_category}')";
    }
    
    $sql_count_rows .= ")";

    // d($sql_count_rows);
    $result_count_rows_arr = mysqli_query($db, $sql_count_rows);
    $count_rows = mysqli_fetch_assoc($result_count_rows_arr)['len'];
    

    $count_products_on_page = 5;
    $count_page = ceil($count_rows / $count_products_on_page); 


    $response = [
        'products'=>[],
        'pagination'=>[
            'countPage'=> $count_page,
            'nowPage'=> $page,
            'section' => $section,
        ],
        'category'=>[
        ] 
    ];

    $from_row = ($page-1) * $count_products_on_page;
    $sql_products = "SELECT  *  FROM products
    WHERE id IN 
    (
        SELECT pc.product_id FROM catalogs as c
        JOIN product_catalog as pc ON c.id=pc.catalog_id
        JOIN product_category as pct ON pc.product_id=pct.product_id 
        WHERE c.code = '{$section}' 
    ";
    if(!empty($filter_price)) {
        $sql_products .= " AND price >={$filter_price[0]} AND price <={$filter_price[1]}";
    }
    if(!empty($filter_category)) {
        $sql_products .= " AND pct.category_id = (SELECT id FROM category WHERE code = '{$filter_category}')";
    }
    $sql_products .= ")";

    $sql_products .= " limit {$from_row}, {$count_products_on_page}"; 

    //d($sql_products);

    $result_products = mysqli_query($db, $sql_products);
    while( $row = mysqli_fetch_assoc($result_products) ){
        $response['products'][]= $row;
    }


    $sql_name_category = "SELECT * FROM category";
    $result_name_category = mysqli_query($db, $sql_name_category);
    while( $row = mysqli_fetch_assoc($result_name_category) ){
        $response['category'][]= $row;
    }
    
   //d($response);

    //d(json_encode($response));
    echo json_encode($response);

