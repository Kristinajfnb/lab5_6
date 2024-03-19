<?php if (!isset($_REQUEST['start'])) { ?>
<form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="post">
 <div>
 <label>Ваше имя: <input name="name" type="text" size="30"></label>
 </div>
 <div>
 <label>Ваше мнение о нас напишите тут:
 <textarea name="message" cols="40" rows="4" placeholder="Ваше
мнение..."></textarea>
 </label>
 </div>
 <div>
 <label>Ваш возраст: <input name="age" type="number"></label>
 </div>
 <div>
 <label>Ваш E-mail: <input name="email" type="email"></label>
 </div>
 <div>
 <input type="reset" value="Стереть"/>
 <input type="submit" value="Передать" name="start"/>
 </div>
</form>
<?php } else {
 // Данные с формы
 $data = [
 'name' => $_POST['name'] ?? "",
 'message' => $_POST['message'] ?? "",
 'age' => $_POST['age'] ?? "",
 'email' => $_POST['email'] ?? "",
 ];
 // Сохранение данных в файл
 $file = fopen('messages.txt', 'a+') or die("Недоступный файл!");
 foreach ($data as $field => $value) {
     fwrite($file, "$field: $value\n"); 
 }
 fwrite($file, "\n");
 fclose($file);
 // Вывод данных на экран
 echo 'Данные были сохранены! Вот что хранится в файле: <br />';
 $file = fopen("messages.txt", "r") or die("Недоступный файл!");
 while (!feof($file)) {
 echo fgets($file) . "<br />";
 }
 fclose($file);
}
?>
