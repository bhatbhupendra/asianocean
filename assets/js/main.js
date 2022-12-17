/*===== MENU SHOW Y HIDDEN =====*/
const navMenu = document.getElementById('nav_section'),
      toggleMenu = document.getElementById('nav_toggle'),
      closeMenu = document.getElementById('nav_close');

/*SHOW*/
toggleMenu.addEventListener('click', ()=>{
    navMenu.style.right = "0%";
  })
  
  /*HIDDEN*/
  closeMenu.addEventListener('click', ()=>{
    navMenu.style.right = "-100%";
})

/*===== ACTIVE AND REMOVE MENU =====*/
const navLink = document.querySelectorAll('.nav_link');

function linkAction(){
  /*Active link*/
  navLink.forEach(n => n.classList.remove('active'));
  this.classList.add('active');

  /*Remove menu mobile*/
  navMenu.classList.remove('show');
}
navLink.forEach(n => n.addEventListener('click', linkAction));