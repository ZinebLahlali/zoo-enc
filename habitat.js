

const btnHabitat = document.getElementById("btnHabitat");
const habitat= document.querySelector(".habitat");
const habitatCancel = document.getElementById("habitatCancel");


btnHabitat.addEventListener("click",function(){
    habitat.classList.remove("hidden");

})

    habitatCancel.addEventListener('click', ()=>{
    habitat.classList.add("hidden");
    })











