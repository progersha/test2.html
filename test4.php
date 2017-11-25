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
    "Хабаровск"
];
$genderList = [
    "Женский",
    "Мужской"
];

$city = isset($_POST["city"]) ? $_POST["city"] : "";
$sex = isset($_POST["sex"]) ? $_POST["sex"] : "";
$name = isset($_POST["firstname"]) ? $_POST["firstname"] : "";
$lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : "";

$customCity = isset($_POST["custom_city"]) ? $_POST["custom_city"] : "";

if (!empty($customCity)) {
    $cities = array_merge($cities, explode(",", $customCity), ["другой"]);
} else {
    $cities[] = "другой";
}

?>
<body>
<div class="block">
	<form action="test4.php" method="POST" id="form">
		<div>
			<div>
				Имя: <input type="text" name="firstname" value='<?= $name?>'><br>
				Фамилия: <input type="text" name="lastname" value='<?= $lastname?>'><br>
			</div>
			<div class="sex"> Выберите пол: <br>
          <?php
          $count = 0;
          foreach ($genderList as $value) {
              $checked = "";
              if ($count == $sex && isset($_POST["sex"])) {
                  $checked = "checked";
              }
              echo "<label><input type='radio' name='sex' value='{$count}' {$checked}> {$value}</label> <br>";
              $count ++;
          }
          ?>
			</div>
			<div> Ваш город:
				<select name="city" id="city">
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
			</div>
			<br>
			<input type="hidden" name="custom_city" id="custom_city" value="<?= $customCity ?>">
			<input type="submit" value="Отправить">
		</div>
	</form>
	<div>
		<p id="info">
				<span style="color:red">
				<?php
				if (isset($_POST["city"])) {
            $gender = $sex ? "ый" : "ая";
            echo "Уважаем{$gender} {$lastname} {$name} из города {$city} ваша регистрация прошла успешно!";
				}
        ?>
				</span>
		</p>
	</div>
</div>
</body>
<script>
    const OTHER_CITY = 'другой';

    var $form = document.querySelector("#form");
    var $city = document.querySelector("#city");
    var fields = document.querySelectorAll("input[type=text]");
    var sexFields = document.querySelectorAll("input[name=sex]");
    var customCity = document.querySelector("#custom_city");

    var sexBlock = document.querySelector('.sex');
      function init() {
        events();
    }

    function validate() {
        var isChecked = false,
		        require = true;
        [].map.call(sexFields, function (field) {
            if (field.checked) {
                isChecked = true;
            }
        });

        if (!isChecked) {
            sexBlock.classList.add('error');
            isChecked = false;
        } else {
            sexBlock.classList.remove('error');
        }

        [].map.call(fields, function (field) {
              if (!isRequire(field)) {
                  require = false;
              }
        });

        return isChecked && require;
    }

    function isRequire(field) {
        if (field.value.trim() === '') {
            field.classList.add('error');
            return false;
        }
		    field.classList.remove('error');
        return true;
    }

    function events() {
        [].map.call(fields, function (field) {
            field.addEventListener('blur', function () {
                isRequire(field);
            });
        });

        $city.addEventListener('change', function () {
            if (this.value === OTHER_CITY) {
                var newCityValue = prompt('Введите город:');
                var option = document.createElement('option');
                option.value = option.text = OTHER_CITY;

                var newCityOption = this.options[this.options.length - 1];
                newCityOption.text = newCityOption.value = newCityValue;

                if (customCity.value != "") {
                    customCity.value += ",";
                }
                customCity.value += newCityValue;

                this.appendChild(option);
            }
        });

        $form.onsubmit = function (event) {
            if (validate()) {
                return true;
            }
		        event.preventDefault();
            return false;
        };
    }
    init();
</script>
</html>