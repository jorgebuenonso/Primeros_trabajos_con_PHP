<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<a class='volver' href=' ../vista/indexvista.php'>VOLVER</a>
<div class="container-editar">
    <h3 class="title-editar">Editar</h3>
    <form class="form-editar" action="" method="post">
        <?php foreach ($dat as $key) : ?>
            <?php foreach ($key as $v) : ?>
                <?php foreach ($v as $field => $value) : ?>
                    <?php if ($field !== 'codProd') : ?>
                        <label><?php echo $field ?></label>
                        <input type="text" name="<?php echo $field ?>" value="<?php echo $value ?>"><br>
                    <?php else: ?>
                        <label><?php echo $field ?></label>
                        <input type="text" name="<?php echo $field ?>" value="<?php echo $value ?>" readonly><br>  
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
        <br><input type="submit" class="btn" name="actualizar" value="ACTUALIZAR">
    </form>
</div>


    
</body>
</html>