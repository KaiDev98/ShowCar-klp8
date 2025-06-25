function switchTab(tab) {
  document.querySelectorAll(".tab-content").forEach((el) => el.classList.add("hidden"));
  document.getElementById(tab).classList.remove("hidden");

  document.querySelectorAll(".tab-button").forEach((el) => {
    el.classList.remove("border-b-2", "border-orange-500");
  });
  document.querySelector(`[data-tab="${tab}"]`).classList.add("border-b-2", "border-orange-500");
}

function toggleAccordion(button) {
  const content = button.nextElementSibling;
  const allContents = document.querySelectorAll(".accordion-content");

  allContents.forEach((c) => {
    if (c !== content) {
      c.classList.add("hidden");
      c.previousElementSibling?.querySelector("span").textContent = "+";
    }
  });

  content.classList.toggle("hidden");
  const icon = button.querySelector("span");
  icon.textContent = content.classList.contains("hidden") ? "+" : "−";
}
