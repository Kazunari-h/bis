<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="stylesheet" href="">
    <script src=""></script>
</head>
<body>
<h1>商品一覧</h1>
<form action="view.php" method="post">
    <input type="text" name="search_word">
    <input type="submit" value="検索">
</form>

{foreach from=$reserves item=reserves name=p_loop key=key_name}
    {if $smarty.foreach.p_loop.first}
        <table>
            <tr>
                <th>No</th>
                <th>タイトル</th>
                <th>テキスト</th>
                <th>最低人数</th>
                <th>最高人数</th>
            </tr>
    {/if}
    <tr>
        <td>{$smarty.foreach.p_loop.iteration}</td>
        <td>{$reserves['title']}</td>
        <td>{$reserves['text']}</td>
        <td>{$reserves['min']}</td>
        <td>{$reserves['max']}</td>
        {*<td><img src="images/{$reserves['image']|default:'noimage.jpg'}" alt=""></td>*}
    </tr>
    {if $smarty.foreach.p_loop.last}
        </table>
    {/if}
    {foreachelse}
    <p>１件もヒットしませんでした。</p>
{/foreach}

</body>
</html>