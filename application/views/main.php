<?php
$news_list['tab']='link';
$news_list['order']='order_num desc';
$news_list['select']='id,name as n';
$news_list['limit']='5';
print_n(get_list($news_list));
?>