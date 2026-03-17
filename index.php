<?php
// L1-A-SessionMemory-2026-03-10
// 1. Plug in the Memory Card
session_start();











// 2. If it is a New Game, set the starting stats
if (!isset($_SESSION['day'])) {
    $_SESSION['day'] = 1;
    $_SESSION['health'] = 100;
    $_SESSION['supplies'] = 10;
    $_SESSION['baseHealth'] = 100; 
    $_SESSION['baseLevel'] = 1; // <-- NEW: Start at Level 1
}

// 3. Load the stats from the Memory Card
$day = $_SESSION['day'];
$health = $_SESSION['health'];
$supplies = $_SESSION['supplies'];
$baseHealth = $_SESSION['baseHealth'];
$baseLevel = $_SESSION['baseLevel']; // <-- NEW: Load the level

$isRescued = false; // Everyone starts out stuck in the forest!

// Create an empty message string
$eventMessage = "";

 // Check if the player sent an action command
 if (isset($_POST['action'])) {
     $playerChoice = $_POST['action'];

     // If they chose to scavenge...
      if ($playerChoice == 'scavenge') {
          $day = $day + 1;           
          $supplies = $supplies - 1; 
          $supplies = $supplies + 3; 

          // --- CHECKPOINT 7: RANDOM MINI-EVENTS ---
           $diceRoll = rand(1, 10); // Roll a 10-sided dice!

           // Triple the danger! If it rolls 1, 2, or 3 (30% chance)
           if ($diceRoll <= 3) {
               $health = $health - 15; 
               $eventMessage = "⚠️ You were attacked by a wild animal! Lost 15 Health.";

           // Keep the stash exactly the same (10% chance)
           } elseif ($diceRoll == 10) {
               $supplies = $supplies + 5; 
               $eventMessage = "🎒 Jackpot! You found a hidden stash! Gained 5 extra Supplies.";

           // Normal scavenge (rolls 4 through 9)
           } else {
               $eventMessage = "🌲 You scavenged safely and found some supplies.";
           }
     // L1-A-RestLogic-2026-03-10
     } elseif ($playerChoice == 'rest') {
         $day = $day + 1;               
         $supplies = $supplies - 1;     
         $baseHealth = $baseHealth - 10; 

     // L1-A-FortifyLogic-2026-03-11
     } elseif ($playerChoice == 'fortify') {
         $day = $day + 1;               
         $supplies = $supplies - 1;     
         $baseHealth = $baseHealth + 15;  



         // L1-A-FortifyLogic-2026-03-11
         } elseif ($playerChoice == 'fortify') {
             $day = $day + 1;               
             $supplies = $supplies - 1;     
             $baseHealth = $baseHealth + 15;  

         // --- CHECKPOINT 7: HEALTH SYSTEM (HEAL) ---
         } elseif ($playerChoice == 'heal') {

             // The Bouncer: Only allow healing if they have 2 or more supplies!
             if ($supplies >= 2) {
                 $day = $day + 1;               // Healing takes 1 full day
                 $supplies = $supplies - 2;     // It takes 2 supplies to make bandages
                 $health = $health + 5;        // Restore 5 Health!

                 // Safety Check: Don't let health go over 100%
                 if ($health > 100) {
                     $health = 100;
                 }
             }

          // --- CHECKPOINT 8: BASE UPGRADES ---
          } elseif ($playerChoice == 'upgrade') {

              // The Bouncer: Do they have enough supplies?
              if ($supplies >= 10) {
                  $day = $day + 1;               // Takes a full day of hard work
                  $supplies = $supplies - 10;    // Costs 10 supplies!
                  $baseLevel = $baseLevel + 1;   // Level up!
                  $baseHealth = $baseHealth + 50; // Huge bonus to base health

                  $eventMessage = "🛠️ SUCCESS! You upgraded your bunker to Level " . $baseLevel . "!";
              } else {
                  // If they don't have 10 supplies, reject them!
                  $eventMessage = "❌ Not enough materials! You need 10 supplies to upgrade.";

              }


          // --- CHECKPOINT 8: CHOPPER RESCUE ---
          } elseif ($playerChoice == 'rescue') {

              // The Bouncer: Do they have 5 supplies for the flare?
              if ($supplies >= 5) {
                  $isRescued = true; // Trigger the Win State!
              } else {
                  $eventMessage = "❌ You need 5 supplies to build a signal flare! Keep scavenging!";
              }

          // --- CHECKPOINT 6: MULTIPLAYER SAVE SYSTEM ---

          // --- CHECKPOINT 6: MULTIPLAYER SAVE SYSTEM ---
           } elseif ($playerChoice == 'save') {
               // Grab the typed name, or default to "Unknown Survivor"
               $playerName = !empty($_POST['playerName']) ? $_POST['playerName'] : "Unknown Survivor";

               $saveData = [
                   'name' => $playerName, // <-- NEW: Save the player's name!
                   'day' => $day,
                   'health' => $health,
                   'supplies' => $supplies,
                   'baseHealth' => $baseHealth,
                   'baseLevel' => $baseLevel 
               ];
               $jsonString = json_encode($saveData);

               // Create a unique file for THIS specific player!
               $playerId = session_id();
               file_put_contents('data/save_' . $playerId . '.json', $jsonString); 

               $eventMessage = "💾 Game Saved for " . $playerName . "!";

     // --- CHECKPOINT 6: MULTIPLAYER LOAD SYSTEM ---
     } elseif ($playerChoice == 'load') {
         // Find THIS specific player's file
         $playerId = session_id();
         $fileName = 'data/save_' . $playerId . '.json';

         // Only load if they actually have a save file!
         if (file_exists($fileName)) {
             $jsonString = file_get_contents($fileName);
             $loadData = json_decode($jsonString, true);

             // Update the game stats with the loaded data!
             $day = $loadData['day'];
             $health = $loadData['health'];
             $supplies = $loadData['supplies'];
             $baseHealth = $loadData['baseHealth'];
         }

     // --- CHECKPOINT 7: RESTART SYSTEM ---
     } elseif ($playerChoice == 'restart') {
         session_destroy(); // Shred the memory card
         header("Location: index.php"); // Refresh the page to trigger a New Game
         exit; // Stop running the rest of the code
     }

     // --- CHECKPOINT 5: END OF DAY RULES ---

     if ($supplies < 0) {
         $supplies = 0;             
         $health = $health - 5;     
     }

     if ($baseHealth < 0) {
         $baseHealth = 0; 
     }

     // Save ALL stats to the Memory Card!
     $_SESSION['day'] = $day;
     $_SESSION['supplies'] = $supplies;
     $_SESSION['baseHealth'] = $baseHealth;
     $_SESSION['health'] = $health; 
     $_SESSION['baseLevel'] = $baseLevel; // <-- NEW: Save the level

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

     <?php if ($eventMessage != "") { ?>
         <p style="background-color: #333; color: orange; padding: 10px; border-radius: 5px;">
             <strong><?php echo $eventMessage; ?></strong>
         </p>
     <?php } ?>

    <div class="stats">
        <p><strong>Day:</strong> <?php echo $day; ?> / 30</p>
        <p><strong>Health:</strong> <?php echo $health; ?>%</p>
        <p><strong>Supplies:</strong> <?php echo $supplies; ?> units</p>
        <p><strong>Base Health:</strong> <?php echo $baseHealth; ?>%</p>
        <p><strong>Base Level:</strong> <?php echo $baseLevel; ?></p>
    </div>

    <?php if ($health <= 0) { ?>

        <h2 style="color: red;">GAME OVER</h2>
        <p>You succumbed to the wilderness. You survived for <?php echo $day; ?> days.</p>

    <?php } elseif ($isRescued == true) { ?>

        <h2 style="color: green;">VICTORY!</h2>
        <p>The rescue chopper has arrived! You survived the full 30 days.</p>

    <?php } else { ?>

        <form method="POST">
            <button type="submit" name="action" value="scavenge">Scavenge for Supplies</button>
            <button type="submit" name="action" value="rest">Rest in Bunker</button>
            <button type="submit" name="action" value="fortify">Fortify Base</button>
            <button type="submit" name="action" value="heal">🩹 Heal Wounds</button>
            <button type="submit" name="action" value="upgrade">🛠️ Upgrade Base (Cost: 10)</button>
            <?php if ($day >= 30) { ?>
                <button type="submit" name="action" value="rescue" style="background-color: green; color: white;">🚁 Signal Chopper (Cost: 5 Supplies)</button>
            <?php } ?>
           <br><br> 
           <input type="text" name="playerName" placeholder="Enter your name...">
           <button type="submit" name="action" value="save">💾 Save Game</button>
           <button type="submit" name="action" value="load">📂 Load Game</button>
           <button type="submit" name="action" value="restart">🔄 Restart Game</button>

           <br><br>
           <a href="leaderboard.php" style="color: yellow;">🏆 View Leaderboard</a>
        </form>

    <?php } ?>

    <p>The forest is quiet. You must survive until the chopper arrives.</p>
</body>
</html>