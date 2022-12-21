<section>
    <?php
    $test = $_POST['test'] ?? '';
     switch ($test) {
        case 1:
            $x = 1;
            $y = 1;
            echo test1($x, $y);
            echo test2($x, $y);
            break;
        case 2:
            break;
    }
    ?>
    <form action="" method="POST">
        <input type="number" name="test">
        <button type="submit">Valider</button>
    </form>
    <?php 
    function test1($x, $y) {
        return $x + $y;
    }
    function test2($x, $y) {
        return $x - $y;
    }
    ?>
</section>