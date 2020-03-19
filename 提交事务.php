<?php

$pdo = new PDO('mysql:host=localhost;dbname=psd1808;port=3306', 'root', '');

$query = 'UPDATE account SET money=money-500 WHERE name="虾哥"';

//开启一个事务
$pdo->beginTransaction();

$res1 = $pdo->exec($query);

// if ($res1 === false) {
//     echo '<br>';
//     print_r($pdo->errorInfo());
// }

echo $res1 ? '扣款成功' : '扣款失败';

$query2 = 'UPDATE account SET money=money+500 WHERE name="分号哥"';

$res2 = $pdo->exec($query2);

echo $res2 ? '收款成功' : '收款失败';

if ($res1 && $res2) {
    //如果res1与res2同时为真就提交事物,因为exec()返回false 跟受影响条数(这里只返回1条)
    $pdo->commit();

} else {
    //其中有一个为假时,exec()返回0时就为假,就回滚事务操作
    $pdo->rollBack();
    echo '操作失败了,不影响数据库数据';
}
