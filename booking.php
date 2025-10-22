<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>RentACar Clone - Home</title>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    padding-bottom: 50px;
}

header {
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    color: white;
    padding: 30px 20px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    position: relative;
    overflow: hidden;
}

header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: pulse 15s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

header h1 {
    font-size: 2.8em;
    font-weight: 700;
    letter-spacing: 2px;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
    position: relative;
    z-index: 1;
}

form {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    width: 85%;
    max-width: 900px;
    margin: -30px auto 40px;
    padding: 35px;
    border-radius: 20px;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.25);
    position: relative;
    z-index: 2;
    border: 2px solid rgba(255, 255, 255, 0.5);
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    align-items: center;
    justify-content: center;
}

form::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2, #667eea);
    border-radius: 20px 20px 0 0;
}

input, select {
    padding: 14px 18px;
    width: calc(25% - 12px);
    min-width: 200px;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    font-size: 15px;
    transition: all 0.3s ease;
    background: white;
    color: #333;
}

input:focus, select:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    transform: translateY(-2px);
}

input::placeholder {
    color: #999;
}

button {
    padding: 14px 35px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    text-transform: uppercase;
}

button:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
}

button:active {
    transform: translateY(-1px);
}

h2 {
    text-align: center;
    color: white;
    font-size: 2.2em;
    margin: 40px 0 30px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    font-weight: 700;
    letter-spacing: 1px;
}

.featured {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
    margin: 20px auto;
    padding: 0 30px;
    max-width: 1400px;
}

.car-card {
    background: white;
    padding: 0;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
}

.car-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.car-card:hover::before {
    transform: scaleX(1);
}

.car-card:hover {
    transform: translateY(-15px) scale(1.02);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
}

.car-card img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    border-radius: 0;
    transition: transform 0.4s ease;
}

.car-card:hover img {
    transform: scale(1.1);
}

.car-card h3 {
    margin: 0;
    padding: 20px 20px 10px;
    color: #2c3e50;
    font-size: 1.4em;
    font-weight: 700;
    letter-spacing: 0.5px;
}

.car-card p {
    padding: 0 20px 20px;
    color: #667eea;
    font-size: 1.3em;
    font-weight: 700;
    margin: 0;
}

@media (max-width: 768px) {
    header h1 {
        font-size: 2em;
    }
    
    form {
        width: 90%;
        padding: 25px;
    }
    
    input, select {
        width: 100%;
    }
    
    button {
        width: 100%;
    }
    
    .featured {
        grid-template-columns: 1fr;
        padding: 0 20px;
    }
    
    h2 {
        font-size: 1.8em;
    }
}

@media (max-width: 480px) {
    header h1 {
        font-size: 1.6em;
        letter-spacing: 1px;
    }
    
    form {
        padding: 20px;
    }
}
</style>
<script>
function redirectToCars(){
    const location=document.getElementById('location').value;
    const start=document.getElementById('start_date').value;
    const end=document.getElementById('end_date').value;
    window.location.href='cars.php?location='+location+'&start='+start+'&end='+end;
}
</script>
</head>
<body>
<header><h1>RentACar Clone</h1></header>
<form onsubmit="redirectToCars(); return false;">
    <input type="text" id="location" placeholder="Pickup Location" required>
    <input type="date" id="start_date" required>
    <input type="date" id="end_date" required>
    <button type="submit">Search Cars</button>
</form>

<h2>Featured Cars</h2>
<div class="featured">
<?php
$stmt = $conn->query("SELECT * FROM cars LIMIT 4");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo "<div class='car-card'>
    <img src='{$row['image']}' alt='Car'>
    <h3>{$row['brand']} {$row['model']}</h3>
    <p>\${$row['price_per_day']} / day</p>
    </div>";
}
?>
</div>
</body>
</html>
