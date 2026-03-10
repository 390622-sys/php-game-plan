<?php
// L1-A-StatsInit-2026-03-09
// These variables store your player's "Save Data"
$day = 1;
$health = 100;
$supplies = 10;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Forest Survival</title>
        <link rel="stylesheet" href="data/style.css">
    </head>
<body>
    <h1>Bunker Survival</h1>

    <div class="stats">
        <p><strong>Day:</strong> <?php echo $day; ?> / 30</p>
        <p><strong>Health:</strong> <?php echo $health; ?>%</p>
        <p><strong>Supplies:</strong> <?php echo $supplies; ?> units</p>
    </div>

    <p>The forest is quiet. You must survive until the chopper arrives.</p>
</body>
</html>