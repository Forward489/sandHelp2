function showPopup() {
  var popup = document.getElementById("popup");
  popup.style.visibility= "visible";
  // popup.style.display = "block";
  setTimeout(function(){
    popup.classList.toggle("animate__fadeOut");
  },5000)
}