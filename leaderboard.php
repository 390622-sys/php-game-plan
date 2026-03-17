<?php
// 1. Scoop up all the save files from the data folder
$players = [];
$files = glob('data/save_*.json');

foreach ($files as $file) {
    $jsonString = file_get_contents($file);
    $data = json_decode($jsonString, true);

    // Safety check: Give older saves a name if they don't have one
    if (!isset($data['name'])) {
        $data['name'] = "Classic Survivor";
    }

    $players[] = $data;
}

// 2. Figure out how the user wants to sort (Default is 'day')
$sortMode = isset($_GET['sort']) ? $_GET['sort'] : 'day';

// 3. The Sorting Machine!
usort($players, function($a, $b) use ($sortMode) {
    if ($sortMode == 'name') {
        return strcmp($a['name'], $b['name']); // Sort names A to Z
    } else {
        return $b[$sortMode] <=> $a[$sortMode]; // Sort numbers Highest to Lowest
    }
});
?>

<!DOCTYPE html>
<html>
<head>
    <title>Survival Leaderboard</title>
    <link rel="stylesheet" href="data/style.css">
    <style>
        table { width: 80%; margin: 20px auto; border-collapse: collapse; background-color: #222; }
        th, td { border: 1px solid #555; padding: 10px; text-align: center; }
        th { background-color: #444; color: orange; }
        .sort-links a { color: yellow; text-decoration: none; margin: 0 10px; padding: 5px; border: 1px solid yellow; border-radius: 5px;}
        .sort-links a:hover { background-color: yellow; color: black; }
    </style>
</head>
<body style="text-align: center;">

    <h1>🏆 Global Survival Leaderboard</h1>

    <div class="sort-links">
        <strong>Sort By:</strong>
        <a href="leaderboard.php?sort=day">Days Survived</a>
        <a href="leaderboard.php?sort=supplies">Supplies Remaining</a>
        <a href="leaderboard.php?sort=name">Player Name</a>
    </div>

    <table>
        <tr>
            <th>Name</th>
            <th>Days Survived</th>
            <th>Supplies Hoarded</th>
            <th>Base Level</th>
        </tr>

        <?php foreach ($players as $p) { ?>
        <tr>
            <td><?php echo $p['name']; ?></td>
            <td><?php echo $p['day']; ?></td>
            <td><?php echo $p['supplies']; ?></td>
            <td><?php echo isset($p['baseLevel']) ? $p['baseLevel'] : 1; ?></td>
        </tr>
        <?php } ?>
    </table>

    <br>
    <a href="index.php" style="color: lightblue; font-size: 1.2em;">⬅️ Return to Bunker</a>

</body>
</html>