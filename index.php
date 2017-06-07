<?php

# подключаем библиотеку
include('simple_html_dom.php');

# глобальный массив, который будет заполняться информацией статьи
$articles = [];

# передаем первую страницу на парсинг, до последней он доберется сам
getArticles('https://tsn.ua/svit/bez-presi-pyeskov-anonsuvav-zustrich-trampa-ta-putina-zmi-941567.html');


function getArticles($page)
{
    global $articles, $descriptions;

    $html = new simple_html_dom();
    $html->load_file($page);

    $items = $html->find('div[class=preview]');

    foreach ($items as $post) {
        $articles[] = array($post->children(3)->outertext,
            $post->children(6)->first_child()->outertext);
    }
//
//    # посмотрим, есть ли следующая страница
//    if ($next = $html->find('a[class=nextpostslink]', 0)) {
//        $URL = $next->href;
//        echo "going on to $URL <<<\n";
//        # подчищаем утечки памяти
//        $html->clear();
//        unset($html);
//
//        getArticles($URL);
//    }
}

?>


<html>
<head>
    <style>
        #main {
            margin: 80px auto;
            width: 600px;
        }

        h1 {
            font: bold 20px/30px verdana, sans-serif;
            text-decoration: none;
        }

        p {
            font: 10px/14px verdana, sans-serif;
    </style>
</head>
<body>
<div id="main">
    <?php
    foreach ($articles as $item) {
        echo $item[0];
        echo $item[1];
    }
    ?>
</div>
</body>
</html>









