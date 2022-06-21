/*
Despliega y recoge el menú del navegador
*/
function navFunction(){
    document.getElementById("myDropdown").classList.toggle("show");
}
//Cierra el menú si el usuario hace click fuera
window.onclick = function (event) {
    if (!event.target.matches('.dropbtn')){
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i=0;i <dropdowns.length; i++){
            var openDropdown = dropdowns [i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}