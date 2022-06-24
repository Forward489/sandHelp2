//Navbar Function
function openNav() {
    document.getElementById("openBtn").style.visibility = "hidden";


    document.getElementById("mySidebar").style.width = "25%";
    document.getElementById("main").style.marginLeft = "25%";
    if (window.innerWidth <= 600) {
        document.getElementById("mySidebar").style.width = "100%";
        document.getElementById("main").style.marginLeft = "100%";
    }
    else if (window.innerWidth <= 1000) {
        document.getElementById("mySidebar").style.width = "50%";
        document.getElementById("main").style.marginLeft = "50%";
    }
}

function closeNav() {
    document.getElementById("openBtn").style.visibility = "visible";
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
}
//Navbar Function End