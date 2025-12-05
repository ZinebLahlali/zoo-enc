const addtop = document.getElementById("addtop");
const Animal = document.querySelector(".animal");
const cancel = document.getElementById("animalCancel");
const btnHabitat = document.getElementById("btnHabitat");
const habitat= document.querySelector(".habitat");
const habitatCancel = document.getElementById("habitatCancel");

addtop.addEventListener('click', ()=>{
 Animal.classList.remove("hidden");

})
addtop.addEventListener("click",function(){

     console.log("hello");
})

     cancel.addEventListener('click', ()=>{
     Animal.classList.add("hidden");

    })

//     btnHabitat.addEventListener('click', ()=>{
//      console.log("hello")
//     habitat.classList.remove("hidden");

// })

btnHabitat.addEventListener("click",function(){
     console.log("click");
})











