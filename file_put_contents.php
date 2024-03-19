<?php
// Вводим данные в файл
file_put_contents("file.txt", "1. William Smith, 1990, 2344455666677\n");
file_put_contents("file.txt", "2. John Doe, 1988, 4445556666787\n", FILE_APPEND);
file_put_contents("file.txt", "3. Michael Brown, 1991, 7748956996777\n", FILE_APPEND);
file_put_contents("file.txt", "4. David Johnson, 1987, 5556667779999\n", FILE_APPEND);
file_put_contents("file.txt", "5. Robert Jones, 1992, 99933456678888\n", FILE_APPEND);

// Открываем файл для добавления данных и добавляем еще 3 записи
if (!file_put_contents("file.txt", "6. Christopher Davis, 1995, 1234567890123\n", FILE_APPEND | LOCK_EX)) {
    die("Ошибка добавления записи 6");
}
if (!file_put_contents("file.txt", "7. Matthew Wilson, 1998, 9876543210987\n", FILE_APPEND | LOCK_EX)) {
    die("Ошибка добавления записи 7");
}
if (!file_put_contents("file.txt", "8. Daniel Taylor, 1993, 3456789012345\n", FILE_APPEND | LOCK_EX)) {
    die("Ошибка добавления записи 8");
}

// Читаем данные из файла и выводим их
$data = file_get_contents("file.txt");
if ($data === false) {
    die("Ошибка чтения файла");
}
?>
<div>Данные из файла: </div>
<?= nl2br($data) ?>
