// Placeholder jika ada interaksi JavaScript nanti
console.log("ShowCar Landing Page Loaded");

// Filter by brand (optional)
function filterBrand(brand) {
  const cards = document.querySelectorAll(".car-card");
  cards.forEach((card) => {
    card.style.display =
      card.dataset.brand === brand || brand === "Show All" ? "block" : "none";
  });
}
