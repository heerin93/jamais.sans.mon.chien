/*const dropdownMenuCreer= document.getElementById("dropdownMenuCreer");
const showMenuCreer= document.getElementById("showMenuCreer");

dropdownMenuCreer.onmouseenter=(function(){mouseEnterCreer()});
dropdownMenuCreer.onmouseleave=(function(){mouseLeaveCreer()});

function mouseEnterCreer(){
    showMenuCreer.classList.add("menuCache");
}
function mouseLeaveCreer(){
    showMenuCreer.classList.remove("menuCache")
}*/

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