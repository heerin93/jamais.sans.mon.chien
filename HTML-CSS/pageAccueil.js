document.addEventListener("DOMContentLoaded", () => {
    const dropdown = document.querySelectorAll(".dropdown");
  
    dropdown.forEach((item) => {
      item.addEventListener("click", (e) => {
        e.preventDefault();
        const submenu = item.querySelector(".submenu");
  
        if (submenu.style.display === "block") {
          submenu.style.display = "none";
        } else {
          submenu.style.display = "block";
        }
      });
    });
  });