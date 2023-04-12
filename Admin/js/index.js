

//toggle menu
const menu = document.querySelector("#menu-btn");
const closes = document.querySelector("#close-btn");
const aside = document.querySelector("aside");
const logo = document.querySelector("#logo");

menu.addEventListener('click', ()=>{
    if(getComputedStyle(aside).display == 'none'){
        aside.style.display = 'block';
        logo.style.display = 'block';


    }
})

closes.addEventListener('click', ()=>{
    if(getComputedStyle(aside).display == 'block'){
        aside.style.display = 'none';
        logo.style.display = 'none';
    }
})
//end toggle menu