<?php
// L1-A-SessionMemory-2026-03-10
// 1. Plug in the Memory Card
session_start();






// 2. If it is a New Game, set the starting stats
if (!isset($_SESSION['day'])) {
    $_SESSION['day'] = 1;
    $_SESSION['health'] = 100;
    $_SESSION['supplies'] = 10;
    // L1-A-BaseHealthInit-2026-03-10
    $_SESSION['baseHealth'] = 100; // Your bunker starts at 100%
}

// 3. Load the stats from the Memory Card
$day = $_SESSION['day'];
$health = $_SESSION['health'];
$supplies = $_SESSION['supplies'];
$baseHealth = $_SESSION['baseHealth'];


// Check if the player sent an action command
if (isset($_POST['action'])) {
    $playerChoice = $_POST['action'];

    // If they chose to scavenge...
    if ($playerChoice == 'scavenge') {
        $day = $day + 1;           
        $supplies = $supplies - 1; 
        $supplies = $supplies + 3; 

    // L1-A-RestLogic-2026-03-10
    // If they chose to rest instead...
    } elseif ($playerChoice == 'rest') {
        $day = $day + 1;               // A day passes
        $supplies = $supplies - 1;     // You eat 1 supply
        $baseHealth = $baseHealth - 5; // The bunker takes 5 damage
        $health = $health - 10;

    // L1-A-FortifyLogic-2026-03-11
    // If they chose to fortify instead...
    } elseif ($playerChoice == 'fortify') {
        $day = $day + 1;               
        $supplies = $supplies - 1;     
        $baseHealth = $baseHealth + 15;  
    }

    // --- CHECKPOINT 5: END OF DAY RULES ---

    // 1. The Starvation Rule: If supplies drop below 0, take damage!
    if ($supplies < 0) {
        $supplies = 0;             // Keep supplies at 0 (no negative food)
        $health = $health - 5;     // Take 5 damage from starving
    }

    // 2. The Ruined Base Rule: Prevent base health from going below 0
    if ($baseHealth < 0) {
        $baseHealth = 0; 
    }

    // 3. Save ALL stats to the Memory Card!
    $_SESSION['day'] = $day;
    $_SESSION['supplies'] = $supplies;
    $_SESSION['baseHealth'] = $baseHealth;
    $_SESSION['health'] = $health; 

} // <-- This final bracket closes the main fence!
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
        <p><strong>Base Health:</strong> <?php echo $baseHealth; ?>%</p>
    </div>

    <?php if ($health <= 0) { ?>

        <h2 style="color: red;">GAME OVER</h2>
        <p>You succumbed to the wilderness. You survived for <?php echo $day; ?> days.</p>

    <?php } elseif ($day >= 30) { ?>

        <h2 style="color: green;">VICTORY!</h2>
        <p>The rescue chopper has arrived! You survived the full 30 days.</p>

    <?php } else { ?>

        <form method="POST">
            <button type="submit" name="action" value="scavenge">Scavenge for Supplies</button>
            <button type="submit" name="action" value="rest">Rest in Bunker</button>
            <button type="submit" name="action" value="fortify">Fortify Base</button>
            <br><br> <button type="submit" name="action" value="save">💾 Save Game</button>
            <button type="submit" name="action" value="load">📂 Load Game</button>
        </form>

    <?php } ?>

    <p>The forest is quiet. You must survive until the chopper arrives.</p>
</body>
</html>