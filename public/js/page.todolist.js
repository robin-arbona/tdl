let addBtn 
let serverMsg 
let BASE_URL


console.log('hello todo list');

document.addEventListener('DOMContentLoaded',async ()=>{
    BASE_URL = await fetch('base_url').then(reponse=>reponse.text())
    addBtn = document.querySelector('.task_add > input[type=submit]');
    serverMsg = document.querySelector('.server_msg')
    init()
})

function init(){
    addBtn.addEventListener('click',async (e)=>{
        e.preventDefault()
        taskAddForm = new FormData(task_add)
        let response = await postContent('Task/add',taskAddForm)
        if(response.status==201){

        } else {
            jsonContent = await response.json()
            displayMessage(jsonContent.msg)
        }
    })
}

function displayMessage($msg){
    serverMsg.innerHTML = $msg;
}

async function postContent(url,data){
    return fetch(url,{
        method: 'POST',
        body: data
    }).then(response=>response)}