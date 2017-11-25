<!DOCTYPE html>
<html>
<head>
    <title>Задача 4</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<?php
$cities = [
    "Владивосток",
    "Москва",
    "Санкт-Петербург",
    "Хабаровск",
    "другой"
];
$genderList = [
    "Женский",
    "Мужской"
];

$city = isset($_POST["city"]) ? $_POST["city"] : "";
$sex = isset($_POST["sex"]) ? $_POST["sex"] : "";
?>
<body>
<div class="block">
    <form action="test4.php" method="POST">
        <div>
            <div>
                Имя: <input type="text" name="firstname"><br>
                Фамилия: <input type="text" name="lastname"><br>
            </div>
            <div> Выберите пол: <br>
                <input type="radio" name="sex" value=":Женский"> Ж <br>
                <input type="radio" name="sex" value="Мужской"> M <br>
            </div>
            <div> Ваш город:
                <select name="city">
                    <?php
                    foreach ($cities as $item) {
                        $selected = "";
                        if ($item == $city) {
                            $selected = "selected";
                        }
                        echo "<option {$selected}>{$item}</option>";
                    }
                    ?>
                </select>
            </div><br>
            <input type="submit" value="Отправить">
        </div>
    </form>
    <div>
        <p id="info">
				<span style="color:red">
				<?php
                echo $city;
                echo $sex;
                ?>
				</span>
        </p>
    </div>
</div>
</body>
<script>

</script>
</html>