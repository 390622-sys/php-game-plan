<!DOCTYPE html>
<html>
<head>
    <title>About - Bunker Survival</title>
    <link rel="stylesheet" href="data/style.css">
    <style>
        /* A little extra CSS just for this page to make reading easier */
        .about-container { 
            width: 80%; 
            max-width: 800px;
            margin: 20px auto; 
            background-color: #222; 
            padding: 20px 40px; 
            border-radius: 10px; 
            text-align: left; 
            border: 2px solid #555;
        }
        h2 { color: orange; border-bottom: 1px solid #555; padding-bottom: 5px; }
        ul { line-height: 1.6; }
        li { margin-bottom: 10px; }
    </style>
</head>
<body>

    <h1>About Bunker Survival</h1>

    <div class="about-container">
        <h2>📜 How to Play (Rules)</h2>
        <ul>
            <li><strong>The Goal:</strong> Survive for 30 days in the harsh wilderness until the rescue chopper arrives.</li>
            <li><strong>Scavenging:</strong> Heading out to scavenge is the only way to find supplies, but it's dangerous! You might find a hidden stash, or you might get attacked by wild animals.</li>
            <li><strong>Health & Starvation:</strong> You need to eat every day. If you run out of supplies, you will starve and take damage. If your Health hits 0%, it's Game Over.</li>
            <li><strong>Base Upgrades:</strong> Stockpile 10 supplies to permanently upgrade your Bunker's level and increase its maximum health!</li>
            <li><strong>Winning the Game:</strong> Reaching Day 30 isn't enough. You must have at least 5 supplies saved up to build a flare and signal the chopper for rescue!</li>
        </ul>

        <h2>🧑‍💻 Credits</h2>
        <p><strong>Lead Developer & Game Designer:</strong> You! (Put your actual name here for your project submission!)</p>
        <p><strong>Assistant Programmer:</strong> Google Gemini (AI)</p>

        <h2>🤖 AI Documentation</h2>
        <p>Artificial Intelligence (Gemini) was utilized as a coding co-pilot during the development of this project. Specific uses include:</p>
        <ul>
            <li>Brainstorming and refining game mechanics (Economy balance, Win states, RNG events).</li>
            <li>Writing and structuring PHP logic for the game loop, bouncer checks, and session-based memory.</li>
            <li>Developing the JSON file reading/writing system for the Multiplayer Save and Leaderboard features.</li>
            <li>Debugging syntax errors and CSS layout issues.</li>
        </ul>
    </div>

    <br>
    <a href="index.php" style="color: lightblue; font-size: 1.2em;">⬅️ Return to Bunker</a>
    <br><br>

</body>
</html>