<?php
/**
 * Sanitizes the given data.
 * @param string $data The data to sanitize.
 * @return string The sanitized data.
 */
function sanitizeData(string $data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}

$errors = [];

if (isset($_POST["register"])) {
    // Валидация данных
    if (empty($_POST['login'])) {
        $errors['login'][] = 'Введите имя!';
    }
    if (empty($_POST['password'])) {
        $errors['password'][] = 'Введите пароль!';
    }
    // Добавьте другие проверки

    if (count($errors) === 0) {
        $login = sanitizeData($_POST['login']);
        $password = md5($_POST['password']); // Хешируем пароль

        // Проверяем, существует ли пользователь с таким именем
        $log = fopen("users.txt", "a+") or die("Недоступный файл!");
        $ifExist = false;
        while (!feof($log)) {
            $line = trim(fgets($log));
            if (strpos($line, $login) !== false) {
                $ifExist = true;
                $errors['login'][] = 'Пользователь с таким именем уже существует!';
                break;
            }
        }
        fclose($log);

        if (!$ifExist) {
            // Добавляем пользователя в файл
            $log = fopen("users.txt", "a") or die("Недоступный файл!");
            fwrite($log, "$login:$password\n");
            fclose($log);

            // Отправляем код 201 (Created) в случае успешной регистрации
            http_response_code(201);
            echo "Пользователь $login успешно зарегистрирован!";
        }
    }
}
?>
<div>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
        <label>
            <span>Name</span>
            <input name="login"/>
            <?php if (isset($errors["login"])) : ?>
                <?php foreach ($errors["login"] as $error) : ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php endforeach; ?>
            <?php endif; ?>
        </label>
        <label>
            <span>Password</span>
            <input type="password" name="password">
            <?php if (isset($errors["password"])) : ?>
                <?php foreach ($errors["password"] as $error) : ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php endforeach; ?>
            <?php endif; ?>
        </label>
        <input type="submit" name="register" value="Регистрация"/>
    </form>
</div>
