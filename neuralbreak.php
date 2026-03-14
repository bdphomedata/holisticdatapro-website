<style>
    /* ... existing styles ... */

    /* PATHFINDER LOGIC STYLES */
    .pathfinder-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        width: 100%;
        max-width: 200px;
        margin: auto;
    }
    .node {
        aspect-ratio: 1/1;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        position: relative;
    }
    .node:hover { background: rgba(255, 255, 255, 0.1); }
    .node i { font-size: 1.5rem; color: rgba(255, 255, 255, 0.3); transition: transform 0.3s ease; }
    
    .node.active i { color: var(--brand-gold); text-shadow: 0 0 10px var(--brand-gold); }
    .node.connected { border-color: var(--brand-gold); background: rgba(255, 198, 41, 0.1); }
    
    #logic-status {
        margin-top: 15px;
        font-size: 0.7rem;
        letter-spacing: 1px;
        color: var(--brand-gold);
        text-transform: uppercase;
        font-weight: bold;
    }
    
    /* Animation for the win state */
    @keyframes pulse-gold {
        0% { transform: scale(1); box-shadow: 0 0 0px var(--brand-gold); }
        50% { transform: scale(1.05); box-shadow: 0 0 20px var(--brand-gold); }
        100% { transform: scale(1); box-shadow: 0 0 0px var(--brand-gold); }
    }
    .win-pulse { animation: pulse-gold 0.5s ease-in-out; }
</style>

<div class="game-column-right">
            <div class="glass-panel" style="flex: 1.5; text-align: center;">
                <span class="label">Secondary: Neural Logic (Pathfinder)</span>
                <div style="margin: auto; width: 100%;">
                    <div class="pathfinder-grid" id="path-grid">
                        <div class="node" onclick="rotateNode(this, 0)"><i class="fas fa-route"></i></div>
                        <div class="node" onclick="rotateNode(this, 1)"><i class="fas fa-route"></i></div>
                        <div class="node" onclick="rotateNode(this, 2)"><i class="fas fa-route"></i></div>
                        <div class="node" onclick="rotateNode(this, 3)"><i class="fas fa-route"></i></div>
                        <div class="node" onclick="rotateNode(this, 4)"><i class="fas fa-route"></i></div>
                        <div class="node" onclick="rotateNode(this, 5)"><i class="fas fa-route"></i></div>
                        <div class="node" onclick="rotateNode(this, 6)"><i class="fas fa-route"></i></div>
                        <div class="node" onclick="rotateNode(this, 7)"><i class="fas fa-route"></i></div>
                        <div class="node" onclick="rotateNode(this, 8)"><i class="fas fa-route"></i></div>
                    </div>
                    <div id="logic-status">Circuit Fragmented</div>
                    <button onclick="resetLogic()" style="background: none; border: 1px solid var(--brand-green); color: var(--brand-green); font-size: 0.6rem; padding: 5px 10px; margin-top: 10px; cursor: pointer; border-radius: 4px;">RE-RANDOMIZE</button>
                </div>
            </div>
            
            <div class="glass-panel" style="flex: 1; overflow: hidden;" id="gemini-module">
                </div>
        </div>

<script>
    // --- PATHFINDER LOGIC ---
    let rotations = [0, 0, 0, 0, 0, 0, 0, 0, 0];
    const targetRotations = [90, 0, 270, 180, 90, 0, 90, 180, 270]; // A simple pre-set "correct" path
    
    function rotateNode(el, index) {
        rotations[index] = (rotations[index] + 90) % 360;
        const icon = el.querySelector('i');
        icon.style.transform = `rotate(${rotations[index]}deg)`;
        el.classList.add('active');
        
        checkConnection();
    }

    function checkConnection() {
        const nodes = document.querySelectorAll('.node');
        let isCorrect = true;
        
        // Simple logic: if all rotations match a divisible of 180 (simplified for demo)
        // In a real version, we'd check specific path alignments
        rotations.forEach((rot, i) => {
            if (rot !== targetRotations[i]) isCorrect = false;
        });

        if (isCorrect) {
            document.getElementById('logic-status').innerText = "CONNECTION ESTABLISHED";
            document.getElementById('logic-status').style.color = "var(--brand-green)";
            nodes.forEach(n => {
                n.classList.add('connected', 'win-pulse');
            });
        }
    }

    function resetLogic() {
        const nodes = document.querySelectorAll('.node');
        rotations = rotations.map(() => (Math.floor(Math.random() * 4) * 90));
        nodes.forEach((n, i) => {
            n.classList.remove('connected', 'win-pulse', 'active');
            n.querySelector('i').style.transform = `rotate(${rotations[i]}deg)`;
        });
        document.getElementById('logic-status').innerText = "Circuit Fragmented";
        document.getElementById('logic-status').style.color = "var(--brand-gold)";
    }

    // Initialize random positions on load
    window.addEventListener('DOMContentLoaded', resetLogic);
</script>
