/*const dropdownMenu1= document.getElementById("dropdownMenu1");
const showMenu1= document.getElementById("showMenu1");

dropdownMenu1.onmouseenter=(function(){mouseEnterCreer()});
dropdownMenu1.onmouseleave=(function(){mouseLeaveCreer()});

function mouseEnterCreer(){
    showMenu.classList.remove("menuCache");
}
function mouseLeaveCreer(){
    showMenu.classList.add("menuCache");
}*/


/* Menu déroulant */
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


/* REGEXP MDP*/

const mdp = document.getElementById('password');
const texte = document.getElementById("cadre-login__soustitre__message");
const email = document.getElementById('mail')

const regexMail = /^[a-z0-9.-]+@[a-z0-9.-]+\.[a-z]{2,6}$/;
const regexMDP = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;

mdp.addEventListener('keyup', ()=>{ 

    if(regexMDP.test(mdp.value)){    
            mdp.style.border = 'solid 1px rgb(31, 219, 72)'
            mdp.style.boxShadow=' 0px 0px 2px rgb(100, 206, 0.12)'

        }else{
            messageErreur()
        }

})

const sendButton = document.getElementById("send");

sendButton.addEventListener("click", (event) => {
    if (!regexMail.test(email.value)) {
        alert("L'adresse e-mail est invalide !");
        email.style.border = 'solid 2px red';
        event.preventDefault(); // Empêche l'envoi si l'email est invalide
    }
    
    if (!regexMDP.test(mdp.value)) {
        alert("Le mot de passe ne respecte pas les critères !");
        mdp.style.border = 'solid 2px red';
        event.preventDefault();
    }
});

texte.style.display='none';

const messageErreur=function(){
    
    texte.style.display='block'
    texte.style.fontFamily='"Kanit", serif'
    texte.style.margin='0'
    texte.style.color='rgb(236, 87, 87)'
    mdp.style.border= 'solid 2px rgb(240, 14, 14)'
    mdp.style.boxShadow=' 0px 0px 2px rgb(199, 84, 84)' 
}

/*REGEX MAIL*/
email.addEventListener('keyup', ()=>{ 

    if (regexMail.test(email.value)){
        email.style.border = 'solid 1px rgb(31, 219, 72)'
        email.style.boxShadow=' 0px 0px 2px rgb(100, 206, 0.12)'
        email.style.background='white'

    } else {

        email.style.border= 'solid 2px rgb(240, 14, 14)'
        email.style.boxShadow=' 0px 0px 2px rgb(199, 84, 84)' 
    }
})
