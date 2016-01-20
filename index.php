
<?php
// валидация и запись данных в файл
// (email (поставил type = 'email') и textarea (поставил атрибут required) валидируются в браузере)

if (isset($_POST['data']) && ctype_alpha($_POST['data']['name'])) {
    $note = $_POST['data'];
    $note['date'] = date("m.d.Y");
    $data = fopen("guestbook.csv", "a");
    fwrite($data, json_encode($note)."\n");
    //fputcsv($data, $note);
    fclose($data);
}
function postCount(){
    $count=0;
    $data=fopen("guestbook.csv","r");
    while(!feof($data)){
        fgets($data);
        $count++;
    }
    return $count;
}
function pagination(){
$perPage=2;
$pageCount=ceil(postCount()/$perPage);
for(i=1;$i<=$pageCount,$i++){
echo  <li><a href=\"index.php?page=$i\">$i</a></li>;
    }
}
function display()
{
    $data = fopen("guestbook.csv", "r");
    while (!feof($data)) {
        //$note = fgetcsv($data);
        $line=fgets($data);
        $note=json_decode($line,true);
        if (empty($note)) {
            break;
        }
        ?>
        <div class="post-block">
            <b><?php echo $note['email'] ?></b> <i><?php echo $note['name'] ?></i> <i
                style="text-decoration: underline;"><?php echo $note['date'] ?></i>

            <p>
                <?php echo $note['text'] ?>
            </p>
        </div>
        <?php
    }
    fclose($data);
}
?>


<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Guestbook</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
          integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
</head>
<body>

<div class="container">

	<?php require_once 'navbar.php' ?>

<div class="panel panel-primary">
    <div class="panel-heading">
        GuestBook
    </div>
    <div class="panel-body">
        <form method="post">
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="data[email]"/>
            </div>
            <div class="form-group">
                <label>�?мя</label>
                <input type="text" class="form-control" name="data[name]"/>
            </div>
            <div class="form-group">
                <label>Текст</label>
                <textarea class="form-control" name="data[text]" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="form"/>
            </div>
        </form>

        <hr/>

        <?php if (file_exists("guestbook.csv")) {
            display();
        } ?>
echo "Hello World";
