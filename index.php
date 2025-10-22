<!DOCTYPE html>
<html>
<head>
<title>Airbnb Clone - Home</title>
<style>
/* ===== GLOBAL STYLES ===== */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: linear-gradient(135deg, #f5f7fa 0%, #e8ecef 100%);
  margin: 0;
  padding: 0;
  min-height: 100vh;
}

/* ===== HEADER STYLES ===== */
header {
  background: linear-gradient(135deg, #ff385c 0%, #e61e4d 50%, #bd1e59 100%);
  padding: 60px 20px;
  color: #fff;
  text-align: center;
  box-shadow: 0 8px 30px rgba(255, 56, 92, 0.3);
  position: relative;
  overflow: hidden;
}

header::before {
  content: '';
  position: absolute;
  top: -50%;
  right: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
  animation: pulse 15s ease-in-out infinite;
}

@keyframes pulse {
  0%, 100% { transform: scale(1) rotate(0deg); opacity: 0.3; }
  50% { transform: scale(1.2) rotate(180deg); opacity: 0.5; }
}

header h1 {
  font-size: 2.8em;
  font-weight: 700;
  letter-spacing: -1px;
  text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.2);
  position: relative;
  z-index: 1;
  margin: 0;
  animation: slideDown 0.8s ease-out;
}

@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* ===== SEARCH BOX STYLES ===== */
.search-box {
  background: #ffffff;
  padding: 35px 40px;
  margin: -40px auto 50px;
  max-width: 900px;
  box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
  border-radius: 20px;
  position: relative;
  z-index: 10;
  transform: translateY(0);
  transition: all 0.4s ease;
  display: flex;
  gap: 15px;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
}

.search-box:hover {
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
  transform: translateY(-5px);
}

/* ===== INPUT STYLES ===== */
input {
  padding: 16px 20px;
  margin: 5px;
  border: 2px solid #e0e0e0;
  border-radius: 12px;
  font-size: 15px;
  flex: 1;
  min-width: 200px;
  transition: all 0.3s ease;
  background: #f8f9fa;
  outline: none;
}

input:focus {
  border-color: #ff385c;
  background: #fff;
  box-shadow: 0 0 0 4px rgba(255, 56, 92, 0.1);
  transform: translateY(-2px);
}

input::placeholder {
  color: #999;
  font-weight: 500;
}

/* ===== BUTTON STYLES ===== */
button {
  padding: 16px 35px;
  margin: 5px;
  border: none;
  border-radius: 12px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

button.search-btn {
  background: linear-gradient(135deg, #ff385c 0%, #e61e4d 100%);
  color: #fff;
  box-shadow: 0 8px 25px rgba(255, 56, 92, 0.4);
  position: relative;
  overflow: hidden;
}

button.search-btn::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.3);
  transform: translate(-50%, -50%);
  transition: width 0.6s, height 0.6s;
}

button.search-btn:hover::before {
  width: 300px;
  height: 300px;
}

button.search-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 35px rgba(255, 56, 92, 0.5);
}

button.search-btn:active {
  transform: translateY(-1px);
}

/* ===== HEADING STYLES ===== */
h2 {
  text-align: center;
  font-size: 2.2em;
  color: #222;
  margin: 50px 0 40px;
  font-weight: 700;
  position: relative;
  display: inline-block;
  left: 50%;
  transform: translateX(-50%);
}

h2::after {
  content: '';
  position: absolute;
  bottom: -12px;
  left: 50%;
  transform: translateX(-50%);
  width: 80px;
  height: 4px;
  background: linear-gradient(90deg, #ff385c, #e61e4d);
  border-radius: 2px;
}

/* ===== PROPERTY CARD STYLES ===== */
.property-card {
  display: inline-block;
  width: 280px;
  margin: 20px 15px;
  background: #ffffff;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
  border-radius: 18px;
  overflow: hidden;
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  vertical-align: top;
  position: relative;
}

.property-card:hover {
  transform: translateY(-15px) scale(1.03);
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
}

.property-card img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.property-card:hover img {
  transform: scale(1.1);
}

.property-card h3 {
  margin: 18px 15px 10px;
  font-size: 1.3em;
  color: #222;
  font-weight: 600;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.property-card p {
  margin: 8px 15px;
  color: #666;
  font-size: 14px;
  display: flex;
  align-items: center;
  gap: 5px;
}

.property-card p::before {
  content: '📍';
  font-size: 16px;
}

.property-card .price {
  color: #ff385c;
  font-weight: 700;
  margin: 15px 15px 8px;
  font-size: 1.4em;
  display: flex;
  align-items: baseline;
  gap: 5px;
}

.property-card .price::before {
  content: '$';
  font-size: 0.8em;
  opacity: 0.8;
}

.property-card button {
  width: calc(100% - 30px);
  margin: 15px;
  padding: 14px;
  background: linear-gradient(135deg, #ff385c 0%, #e61e4d 100%);
  color: white;
  border: none;
  border-radius: 10px;
  font-weight: 600;
  font-size: 15px;
  cursor: pointer;
  transition: all 0.3s ease;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.property-card button:hover {
  background: linear-gradient(135deg, #e61e4d 0%, #bd1e59 100%);
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(255, 56, 92, 0.4);
}

/* ===== CONTAINER ===== */
div[style*="text-align:center"] {
  max-width: 1400px;
  margin: 0 auto;
  padding: 20px;
}

/* ===== RESPONSIVE DESIGN ===== */
@media (max-width: 768px) {
  header h1 {
    font-size: 2em;
  }
  
  .search-box {
    flex-direction: column;
    padding: 25px 20px;
    margin: -30px 15px 30px;
  }
  
  input {
    width: 100%;
    min-width: auto;
  }
  
  button.search-btn {
    width: 100%;
  }
  
  .property-card {
    width: calc(100% - 30px);
    max-width: 350px;
  }
  
  h2 {
    font-size: 1.8em;
  }
}

/* ===== LOADING ANIMATION ===== */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.property-card {
  animation: fadeIn 0.6s ease-out forwards;
}

.property-card:nth-child(1) { animation-delay: 0.1s; }
.property-card:nth-child(2) { animation-delay: 0.2s; }
.property-card:nth-child(3) { animation-delay: 0.3s; }
.property-card:nth-child(4) { animation-delay: 0.4s; }
</style>
<script>
function goToListings() {
  const dest=document.getElementById('destination').value;
  const inDate=document.getElementById('checkin').value;
  const outDate=document.getElementById('checkout').value;
  window.location.href=`listings.php?destination=${dest}&checkin=${inDate}&checkout=${outDate}`;
}
</script>
</head>
<body>
<header>
  <h1>Find your next stay</h1>
</header>
<div class="search-box">
  <input type="text" id="destination" placeholder="Destination">
  <input type="date" id="checkin">
  <input type="date" id="checkout">
  <button class="search-btn" onclick="goToListings()">Search</button>
</div>
<h2 style="text-align:center;">Featured Properties</h2>
<div style="text-align:center;">
<!-- Properties will be loaded here by PHP -->
<div class='property-card'>
  <img src='https://images.unsplash.com/photo-1568605114967-8130f3a36994' alt='Property'>
  <h3>Luxury Villa</h3>
  <p>Bali, Indonesia</p>
  <div class='price'>250 / night</div>
  <button>Book Now</button>
</div>
<div class='property-card'>
  <img src='https://images.unsplash.com/photo-1564013799919-ab600027ffc6' alt='Property'>
  <h3>Modern Apartment</h3>
  <p>New York, USA</p>
  <div class='price'>180 / night</div>
  <button>Book Now</button>
</div>
<div class='property-card'>
  <img src='https://images.unsplash.com/photo-1480074568708-e7b720bb3f09' alt='Property'>
  <h3>Beach House</h3>
  <p>Malibu, California</p>
  <div class='price'>320 / night</div>
  <button>Book Now</button>
</div>
<div class='property-card'>
  <img src='https://images.unsplash.com/photo-1512917774080-9991f1c4c750' alt='Property'>
  <h3>Cozy Cottage</h3>
  <p>London, UK</p>
  <div class='price'>150 / night</div>
  <button>Book Now</button>
</div>
</div>
</body>
</html>
