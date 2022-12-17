//getting password field
const passwordField = document.getElementById("password");
//getting conform password field
const conformPasswordField = document.getElementById("confirm_password");
//getting eye [return the arrey of two i]
const eye = document.getElementsByClassName("fa-eye");
console.log(eye);

//when user want to see password [click password eye icon]
eye[0].onclick = ()=>{
    if(passwordField.type == "password"){
        passwordField.type = "text";
        eye[0].classList.add("active_eye");//adding active_eye class
    }else{
        passwordField.type = "password";
        eye[0].classList.remove("active_eye");//removeing active_eye class
    }
}

//when user want to see conform password [click conform password eye icon]
eye[1].onclick = ()=>{
    if(conformPasswordField.type == "password"){
        conformPasswordField.type = "text";
        eye[1].classList.add("active_eye");//adding active_eye class
    }else{
        conformPasswordField.type = "password";
        eye[1].classList.remove("active_eye");//removeing active_eye class
    }
}