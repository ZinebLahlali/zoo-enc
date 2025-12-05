const addtop = document.getElementById("addtop");
const Animal = document.querySelector(".animal");
const cancel = document.querySelector("cancel");

addtop.addEventListener('click', ()=>{
 Animal.classList.remove("hidden");

})

addtop.addEventListener('click', ()=>{
     cancel.classList.add("hidden");

    })
