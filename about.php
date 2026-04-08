<!DOCTYPE html>
<html>
<head>
    <title>Bunker Survival - About</title>
    <link rel="stylesheet" href="data/style.css">
    <style>
        .guide-section {
            background-color: #222;
            border: 1px solid #444;
            padding: 20px;
            margin: 15px auto;
            width: 80%;
            max-width: 600px;
            text-align: left;
            border-radius: 8px;
        }
        .guide-section h3 {
            color: lightgreen;
            border-bottom: 1px solid #555;
            padding-bottom: 5px;
            margin-top: 0;
        }
        .guide-section ul {
            list-style-type: square;
            color: #ddd;
            padding-left: 20px;
        }
        .guide-section li {
            margin-bottom: 10px;
            line-height: 1.4;
        }
        .highlight {
            color: orange;
            font-weight: bold;
        }
        .danger {
            color: #ff4c4c;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>📖 Survivor's Field Guide</h1>
    <p>The forest is unforgiving. Read this manual carefully if you want to make it out alive.</p>

    <div class="guide-section">
        <h3>🎯 The Goal</h3>
        <p>You are stranded in a hostile wilderness. You must survive for <span class="highlight">30 Days</span>. Once Day 30 arrives, the rescue chopper will be in range. However, building the massive signal fire to get their attention will cost you <span class="highlight">20 Supplies</span>. Start stockpiling early!</p>
    </div>

    <div class="guide-section">
        <h3>📊 Vital Stats</h3>
        <ul>
            <li><strong>Health:</strong> Keep this above 0%. If you run out of supplies at the end of the day, you will <span class="danger">starve and lose 20 Health</span>.</li>
            <li><strong>Supplies:</strong> The currency of survival. You consume 1 supply every single day. You also use them to heal, upgrade, and signal the chopper.</li>
            <li><strong>Base Health:</strong> Your bunker's integrity. <span class="danger">It naturally decays by 5 every single day</span> from the harsh elements. Protect your walls!</li>
            <li><strong>Base Level:</strong> Upgrading your base increases its level and grants a massive boost to Base Health.</li>
        </ul>
    </div>

    <div class="guide-section">
        <h3>⚙️ Daily Actions</h3>
        <ul>
            <li><strong>Scavenge for Supplies:</strong> Search the forest. Usually yields 3 supplies, but beware: there is a 30% chance a wild animal attacks you <span class="danger">(-15 Health AND -10 Base Health)</span>. There is also a 10% chance to find a hidden stash!</li>
            <li><strong>Rest in Bunker:</strong> Stay inside. Saves your personal health, but your base takes an extra 10 damage from neglect.</li>
            <li><strong>Fortify Base:</strong> Spend a day repairing your bunker to restore 15 Base Health.</li>
            <li><strong>Heal Wounds:</strong> Spend <span class="highlight">5 Supplies</span> to craft bandages and restore 5 Health.</li>
            <li><strong>Upgrade Base:</strong> Spend <span class="highlight">10 Supplies</span> to heavily reinforce your bunker and gain 50 Base Health.</li>
        </ul>
    </div>

    <br><br>
    <a href="index.php" style="font-size: 1.2em; color: lightblue; text-decoration: none; border: 1px solid lightblue; padding: 10px 20px; border-radius: 5px;">⬅️ Return to the Bunker</a>
    <br><br>

</body>
</html>