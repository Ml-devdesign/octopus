let btnDelete = document.querySelectorAll('.btn-delete');
btnDelete.forEach(function(btn) {
    btn.addEventListener('click',function(){
        document.getElementById("modal-delete").style.display ="block";
    });
});
/////////////////////////delete button
document.getElementById("modal-cancel").addEventListener('click',function(){
    document.getElementById("modal-delete").style.display = "none";
});