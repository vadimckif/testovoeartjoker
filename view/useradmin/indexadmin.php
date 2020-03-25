Список пользователей в модуле админ
<table border="1" border-collapse="collapse">
    <tr>
        <th>ФИО</th>
        <th>Email</th>
        <th>Адрес</th>
    </tr>
    <?php
    foreach($users as $user)
    {
        ?>
        <tr><td><?php echo $user->name; ?></td><td><?php echo $user->email; ?></td><td><?php echo $user->territory; ?></td></tr>
    <?php } ?>
</table>
<a href="user/register">Регистрация</a><br>
<a href="">На главную</a>
