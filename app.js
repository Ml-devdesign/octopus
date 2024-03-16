document.getElementById("login").addEventListener("change",function(){   
    fetch(`./checklogin.php?login=${this.value}`) //check login en selectionnant le e event donc de l'evenement 
    .then(function(response){
        return response.text();     
        
    })
    .then(function(data){
        console.log(data);
        document.getElementById("msg").innerText = " ";
        if(data != "0"){
            document.getElementById("msg").innerText = "Login déjà pris";
            document.getElementById("msg").style.color = "red";
            document.getElementById("msg").style.display = "block";
        }
        else{
            document.getElementById("msg").innerText = "Login OK";
            document.getElementById("msg").style.color = "green";
            document.getElementById("msg").style.display = "block";
        }
    });
});