var addCategoryButton = document.getElementById('addCategoryButton');
var addSubCategoryButton = document.getElementById('addSubCategoryButton');
var addCategoryPrompt = document.getElementsByClassName('addCategory')[0];
var addSubCategoryPrompt = document.getElementsByClassName('addSubCategory')[0];
var addCategoryPromptClose = document.getElementById('addCategoryPromptClose');
var addSubCategoryPromptClose = document.getElementById('addSubCategoryPromptClose');


addCategoryButton.addEventListener('click', ()=>{
    addCategoryPrompt.style.bottom = "50px";
    addCategoryPrompt.style.right = "50px";
    //close sub category
    addSubCategoryPrompt.style.bottom = "50px";
    addSubCategoryPrompt.style.right = "-310px";
});


addCategoryPromptClose.addEventListener('click', ()=>{
    addCategoryPrompt.style.bottom = "50px";
    addCategoryPrompt.style.right = "-310px";
});


addSubCategoryButton.addEventListener('click', ()=>{
    addSubCategoryPrompt.style.bottom = "50px";
    addSubCategoryPrompt.style.right = "50px";

    //close category
    addCategoryPrompt.style.bottom = "50px";
    addCategoryPrompt.style.right = "-310px";
});

addSubCategoryPromptClose.addEventListener('click', ()=>{
    addSubCategoryPrompt.style.bottom = "50px";
    addSubCategoryPrompt.style.right = "-310px";
});




//meal
var addMealButton = document.getElementById('addMealButton');
var addMealPrompt = document.getElementsByClassName('addMeal')[0];
var addMealPromptClose = document.getElementById('addMealPromptClose');


addMealButton.addEventListener('click', ()=>{
    addMealPrompt.style.bottom = "50px";
    addMealPrompt.style.right = "50px";
});


addMealPromptClose.addEventListener('click', ()=>{
    addMealPrompt.style.bottom = "50px";
    addMealPrompt.style.right = "-410px";
});
