<form action="user/calculate" method="post">
    <p><b>Регистрация пользователя</b></p>
    <p>
        <label for="fio" style="display: block">ФИО: </label>
        <input type="text" name="fio" value="" id="fio" placeholder="Введите Фио">
    </p>
    <p>
        <label for="email" style="display: block">Email:</label>
        <input type="text" name="email" value="" id="email" placeholder="Введите email">
    </p>
    <p>
        <label for="zone" style="display: block">Список областей</label>
        <select name="zone" width="160" class="chosen-select" id="zone">
            <option value="0">Выберите область</option>
            <?php

            foreach($zones as $zone)
            {
            ?>
            <option value="<?php echo $zone->ter_id; ?>"><?php echo $zone->ter_name; ?></option>

            <?php } ?>
        </select>
    </p>
    <p>
        <label for="city" style="display: block">Список городов</label>
        <select name="city" class="chosen-select" id="city"></select>
    </p>
    <p>
        <label for="rajen" style="display: block">Список районов</label>
        <select name="rajen" class="chosen-select" id="rajen"></select>
    </p>
    <p><input type="submit"></p>
</form>

<?php
if(isset($error))
{
   ?>
    <div>Пользователь с почтой  <?php echo $error->email; ?> уже зарегистрирован: <br> ФИО: <?php echo $error->name ?> <br>Адрес: <?php echo $error->territory ?></div>
<?php
}
if(isset($success))
{
   echo "<div>$success</div>";
}

?>
<a href="">На главную</a><br>
<a href="admin/useradmin/index">В админку</a>

