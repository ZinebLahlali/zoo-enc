// Get references
const togglePopupBtn = document.getElementById("togglePopupBtn");
const popupForm = document.getElementById("popupForm");         
const closePopup = document.getElementById("closePopup");         

togglePopupBtn.addEventListener('click', () => {
    popupForm.style.display = "flex";
});

closePopup.addEventListener('click', () => {
    popupForm.style.display = "none";
});

popupForm.addEventListener('click', (e) => {
    if (e.target === popupForm) { 
        popupForm.style.display = "none";
    }
});
