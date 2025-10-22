<?php include 'db.php'; 
$dest = $_GET['destination'] ?? '';
$checkin = $_GET['checkin'] ?? '';
$checkout = $_GET['checkout'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
<title>Listings - Airbnb Clone</title>
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

/* ===== NAVIGATION BAR ===== */
.navbar {
  background: #ffffff;
  padding: 15px 40px;
  box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: sticky;
  top: 0;
  z-index: 100;
}

.navbar .logo {
  font-size: 1.5em;
  font-weight: 700;
  color: #ff385c;
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 10px;
}

.navbar .logo::before {
  content: '🏠';
  font-size: 1.3em;
}

.navbar .back-btn {
  padding: 10px 25px;
  background: #f7f7f7;
  border: none;
  border-radius: 25px;
  cursor: pointer;
  font-weight: 600;
  color: #333;
  transition: all 0.3s ease;
}

.navbar .back-btn:hover {
  background: #e0e0e0;
  transform: translateX(-5px);
}

/* ===== HEADER STYLES ===== */
header {
  background: linear-gradient(135deg, #ff385c 0%, #e61e4d 50%, #bd1e59 100%);
  color: #fff;
  text-align: center;
  padding: 50px 20px 40px;
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
  font-size: 2.5em;
  font-weight: 700;
  position: relative;
  z-index: 1;
  text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.2);
  margin-bottom: 15px;
}

.search-info {
  position: relative;
  z-index: 1;
  font-size: 1.1em;
  opacity: 0.95;
  margin-top: 10px;
}

/* ===== FILTERS SECTION ===== */
.filters-section {
  background: #ffffff;
  padding: 25px 40px;
  margin: 30px auto;
  max-width: 1400px;
  border-radius: 20px;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
}

.filter-group {
  display: flex;
  flex-direction: column;
  gap: 8px;
  flex: 1;
  min-width: 150px;
}

.filter-group label {
  font-weight: 600;
  color: #333;
  font-size: 0.9em;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.filter-group select,
.filter-group input {
  padding: 12px 15px;
  border: 2px solid #e0e0e0;
  border-radius: 10px;
  font-size: 15px;
  background: #f8f9fa;
  transition: all 0.3s ease;
  outline: none;
}

.filter-group select:focus,
.filter-group input:focus {
  border-color: #ff385c;
  background: #fff;
  box-shadow: 0 0 0 4px rgba(255, 56, 92, 0.1);
}

.filter-btn {
  padding: 12px 30px;
  background: linear-gradient(135deg, #ff385c 0%, #e61e4d 100%);
  color: white;
  border: none;
  border-radius: 10px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  margin-top: 20px;
}

.filter-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(255, 56, 92, 0.4);
}

/* ===== SORTING & RESULTS INFO ===== */
.results-header {
  max-width: 1400px;
  margin: 30px auto;
  padding: 0 40px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 20px;
}

.results-count {
  font-size: 1.3em;
  font-weight: 600;
  color: #333;
}

.results-count span {
  color: #ff385c;
}

.sort-controls {
  display: flex;
  gap: 10px;
  align-items: center;
}

.sort-controls select {
  padding: 10px 15px;
  border: 2px solid #e0e0e0;
  border-radius: 10px;
  background: white;
  cursor: pointer;
  font-weight: 500;
  transition: all 0.3s ease;
}

.sort-controls select:hover {
  border-color: #ff385c;
}

.view-toggle {
  display: flex;
  gap: 5px;
  background: #f0f0f0;
  padding: 5px;
  border-radius: 10px;
}

.view-toggle button {
  padding: 8px 15px;
  border: none;
  background: transparent;
  cursor: pointer;
  border-radius: 8px;
  transition: all 0.3s ease;
  font-size: 18px;
}

.view-toggle button.active {
  background: white;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

/* ===== PROPERTIES GRID ===== */
.properties-container {
  max-width: 1400px;
  margin: 0 auto;
  padding: 20px 40px;
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 30px;
}

/* ===== PROPERTY CARD STYLES ===== */
.property-card {
  background: #ffffff;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
  border-radius: 18px;
  overflow: hidden;
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  position: relative;
  cursor: pointer;
}

.property-card:hover {
  transform: translateY(-15px);
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
}

.property-card .image-container {
  position: relative;
  overflow: hidden;
  height: 220px;
}

.property-card img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s ease;
}

.property-card:hover img {
  transform: scale(1.15);
}

.property-card .favorite-btn {
  position: absolute;
  top: 15px;
  right: 15px;
  background: rgba(255, 255, 255, 0.95);
  border: none;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  cursor: pointer;
  font-size: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  z-index: 10;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.property-card .favorite-btn:hover {
  background: #ff385c;
  transform: scale(1.1);
}

.property-card .favorite-btn:hover::after {
  content: '❤️';
}

.property-card .favorite-btn::after {
  content: '🤍';
}

.property-card .badge {
  position: absolute;
  top: 15px;
  left: 15px;
  background: linear-gradient(135deg, #ff385c, #e61e4d);
  color: white;
  padding: 8px 15px;
  border-radius: 20px;
  font-size: 0.85em;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  box-shadow: 0 4px 15px rgba(255, 56, 92, 0.4);
}

.property-card .card-content {
  padding: 20px;
}

.property-card h3 {
  font-size: 1.4em;
  color: #222;
  font-weight: 700;
  margin-bottom: 10px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.property-card .location {
  color: #666;
  font-size: 0.95em;
  margin-bottom: 15px;
  display: flex;
  align-items: center;
  gap: 8px;
}

.property-card .location::before {
  content: '📍';
  font-size: 1.1em;
}

.property-card .amenities {
  display: flex;
  gap: 15px;
  margin: 15px 0;
  flex-wrap: wrap;
}

.property-card .amenity {
  display: flex;
  align-items: center;
  gap: 5px;
  font-size: 0.9em;
  color: #555;
  background: #f7f7f7;
  padding: 6px 12px;
  border-radius: 20px;
}

.property-card .rating {
  display: flex;
  align-items: center;
  gap: 8px;
  margin: 12px 0;
  font-weight: 600;
  color: #333;
}

.property-card .rating::before {
  content: '⭐';
  font-size: 1.1em;
}

.property-card .rating .reviews {
  color: #888;
  font-weight: 400;
  font-size: 0.9em;
}

.property-card .price-section {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 20px;
  padding-top: 20px;
  border-top: 2px solid #f0f0f0;
}

.property-card .price {
  color: #ff385c;
  font-weight: 800;
  font-size: 1.6em;
  display: flex;
  align-items: baseline;
  gap: 5px;
}

.property-card .price::before {
  content: '$';
  font-size: 0.7em;
  opacity: 0.8;
}

.property-card .price span {
  font-size: 0.5em;
  font-weight: 400;
  color: #666;
}

.property-card button {
  padding: 12px 25px;
  background: linear-gradient(135deg, #ff385c 0%, #e61e4d 100%);
  color: white;
  border: none;
  border-radius: 10px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  font-size: 0.9em;
}

.property-card button:hover {
  background: linear-gradient(135deg, #e61e4d 0%, #bd1e59 100%);
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(255, 56, 92, 0.4);
}

/* ===== NO RESULTS ===== */
.no-results {
  text-align: center;
  padding: 80px 20px;
  max-width: 600px;
  margin: 0 auto;
}

.no-results .icon {
  font-size: 5em;
  margin-bottom: 20px;
  opacity: 0.5;
}

.no-results h2 {
  font-size: 2em;
  color: #333;
  margin-bottom: 15px;
}

.no-results p {
  font-size: 1.1em;
  color: #666;
  line-height: 1.6;
}

/* ===== LOADING ANIMATION ===== */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.property-card {
  animation: fadeInUp 0.6s ease-out forwards;
}

.property-card:nth-child(1) { animation-delay: 0.05s; }
.property-card:nth-child(2) { animation-delay: 0.1s; }
.property-card:nth-child(3) { animation-delay: 0.15s; }
.property-card:nth-child(4) { animation-delay: 0.2s; }
.property-card:nth-child(5) { animation-delay: 0.25s; }
.property-card:nth-child(6) { animation-delay: 0.3s; }

/* ===== RESPONSIVE DESIGN ===== */
@media (max-width: 1024px) {
  .properties-container {
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    padding: 20px;
  }
  
  .filters-section {
    padding: 20px;
  }
}

@media (max-width: 768px) {
  .navbar {
    padding: 12px 20px;
  }
  
  header h1 {
    font-size: 1.8em;
  }
  
  .filters-section {
    flex-direction: column;
    margin: 20px 15px;
  }
  
  .filter-group {
    width: 100%;
  }
  
  .results-header {
    flex-direction: column;
    align-items: flex-start;
    padding: 0 20px;
  }
  
  .properties-container {
    grid-template-columns: 1fr;
    padding: 15px;
  }
}

/* ===== SCROLL TO TOP BUTTON ===== */
.scroll-top {
  position: fixed;
  bottom: 30px;
  right: 30px;
  width: 50px;
  height: 50px;
  background: linear-gradient(135deg, #ff385c, #e61e4d);
  color: white;
  border: none;
  border-radius: 50%;
  cursor: pointer;
  font-size: 20px;
  box-shadow: 0 8px 25px rgba(255, 56, 92, 0.4);
  display: none;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  z-index: 1000;
}

.scroll-top:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 35px rgba(255, 56, 92, 0.5);
}

.scroll-top.show {
  display: flex;
}
</style>
<script>
// Scroll to top functionality
window.addEventListener('scroll', function() {
  const scrollBtn = document.querySelector('.scroll-top');
  if (window.pageYOffset > 300) {
    scrollBtn.classList.add('show');
  } else {
    scrollBtn.classList.remove('show');
  }
});

function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Filter functionality
function applyFilters() {
  const priceRange = document.getElementById('priceRange').value;
  const propertyType = document.getElementById('propertyType').value;
  // Add your filter logic here
  console.log('Filters applied:', { priceRange, propertyType });
}

// Sort functionality
function sortProperties(sortBy) {
  // Add your sorting logic here
  console.log('Sorting by:', sortBy);
}
</script>
</head>
<body>

<!-- Navigation Bar -->
<div class="navbar">
  <a href="index.php" class="logo">Airbnb Clone</a>
  <button class="back-btn" onclick="window.location.href='index.php'">← Back to Home</button>
</div>

<!-- Header -->
<header>
  <h1>Properties in "<?php echo htmlspecialchars($dest); ?>"</h1>
  <?php if($checkin && $checkout): ?>
  <div class="search-info">
    📅 <?php echo htmlspecialchars($checkin); ?> → <?php echo htmlspecialchars($checkout); ?>
  </div>
  <?php endif; ?>
</header>

<!-- Filters Section -->
<div class="filters-section">
  <div class="filter-group">
    <label>Price Range</label>
    <select id="priceRange">
      <option value="">Any Price</option>
      <option value="0-100">$0 - $100</option>
      <option value="100-200">$100 - $200</option>
      <option value="200-300">$200 - $300</option>
      <option value="300+">$300+</option>
    </select>
  </div>
  
  <div class="filter-group">
    <label>Property Type</label>
    <select id="propertyType">
      <option value="">All Types</option>
      <option value="apartment">Apartment</option>
      <option value="house">House</option>
      <option value="villa">Villa</option>
      <option value="cottage">Cottage</option>
    </select>
  </div>
  
  <div class="filter-group">
    <label>Guests</label>
    <input type="number" placeholder="Number of guests" min="1" value="1">
  </div>
  
  <button class="filter-btn" onclick="applyFilters()">Apply Filters</button>
</div>

<!-- Results Header -->
<div class="results-header">
  <div class="results-count">
    <span><?php 
    $countStmt = $conn->prepare("SELECT COUNT(*) FROM properties WHERE location LIKE ?");
    $countStmt->execute(["%$dest%"]);
    echo $countStmt->fetchColumn();
    ?></span> properties found
  </div>
  
  <div class="sort-controls">
    <select onchange="sortProperties(this.value)">
      <option value="">Sort by</option>
      <option value="price-low">Price: Low to High</option>
      <option value="price-high">Price: High to Low</option>
      <option value="rating">Highest Rated</option>
      <option value="popular">Most Popular</option>
    </select>
    
    <div class="view-toggle">
      <button class="active" title="Grid View">⊞</button>
      <button title="List View">☰</button>
    </div>
  </div>
</div>

<!-- Properties Grid -->
<div class="properties-container">
<?php
$stmt=$conn->prepare("SELECT * FROM properties WHERE location LIKE ?");
$stmt->execute(["%$dest%"]);
$count = 0;
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
  $count++;
  echo "<div class='property-card'>
        <div class='image-container'>
          <img src='{$row['image']}' alt='Property'>
          <button class='favorite-btn'></button>
          <div class='badge'>Featured</div>
        </div>
        <div class='card-content'>
          <h3>{$row['title']}</h3>
          <p class='location'>{$row['location']}</p>
          <div class='amenities'>
            <span class='amenity'>🛏️ 2 Beds</span>
            <span class='amenity'>🛁 2 Bath</span>
            <span class='amenity'>👥 4 Guests</span>
          </div>
          <div class='rating'>4.9 <span class='reviews'>(128 reviews)</span></div>
          <div class='price-section'>
            <div class='price'>{$row['price']}<span>/ night</span></div>
            <button onclick=\"window.location.href='booking.php?id={$row['id']}'\">Book</button>
          </div>
        </div>
        </div>";
}

if($count == 0) {
  echo "<div class='no-results'>
          <div class='icon'>🏠</div>
          <h2>No Properties Found</h2>
          <p>We couldn't find any properties matching your search criteria. Try adjusting your filters or search in a different location.</p>
        </div>";
}
?>
</div>

<!-- Scroll to Top Button -->
<button class="scroll-top" onclick="scrollToTop()">↑</button>

</body>
</html>
