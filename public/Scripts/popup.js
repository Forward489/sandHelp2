function showPopup(message) {
    document.getElementById("message").innerHTML = message
    var popup = document.getElementById("popup");

    popup.classList.toggle("animate__fadeIn");
    popup.style.visibility= "visible";
    // popup.style.display = "block";
    setTimeout(function(){
      popup.classList.toggle("animate__fadeOut");
    },5000)

    
  }