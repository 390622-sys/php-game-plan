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

        $_SESSION['day'] = $day;
        $_SESSION['supplies'] = $supplies;

    // L1-A-RestLogic-2026-03-10
    // If they chose to rest instead...
    } elseif ($playerChoice == 'rest') {
        $day = $day + 1;               // A day passes
        $supplies = $supplies - 1;     // You eat 1 supply
        $baseHealth = $baseHealth - 5; // The bunker takes 5 damage

        // Save the updated stats back to the Memory Card!
        $_SESSION['day'] = $day;
        $_SESSION['supplies'] = $supplies;
        $_SESSION['baseHealth'] = $baseHealth; 

    // L1-A-FortifyLogic-2026-03-11
    // If they chose to fortify instead...
    } elseif ($playerChoice == 'fortify') {

        // REPLACE THESE COMMENTS WITH YOUR MATH CODE:
        $day = $day + 1;               
        $supplies = $supplies - 1;     
        $baseHealth = $baseHealth + 15;  

        // Save the updated stats back to the Memory Card!
        $_SESSION['day'] = $day;
        $_SESSION['supplies'] = $supplies;
        $_SESSION['baseHealth'] = $baseHealth;
    }
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

    <form method="POST">
        <button type="submit" name="action" value="scavenge">Scavenge for Supplies</button>
        <button type="submit" name="action" value="rest">Rest in Bunker</button>
        <button type="submit" name="action" value="fortify">Fortify Base</button>
    </form>

    <p>The forest is quiet. You must survive until the chopper arrives.</p>
</body>
</html>