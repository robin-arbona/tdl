const formPH = document.querySelector('.form')
const serverMsg = document.querySelector('.server_msg')

let BASE_URL ="/";

document.addEventListener('DOMContentLoaded',async ()=>{
    BASE_URL = await fetch('base_url').then(reponse=>reponse.text())
    init();
})

async function init(){
    loadConnexionForm()
}

async function loadConnexionForm(){
    formPH.innerHTML = await loadContent(BASE_URL + '/view/component/connexion_form.php')
    document.querySelector('a[href="#inscription"]').addEventListener('click',async (e)=>{
        e.preventDefault()
        await loadInscriptionForm()
    })
    handleForm('user/connexion',()=>changePage('Todolist/dashboard'))
}

async function loadInscriptionForm(){
    formPH.innerHTML = await loadContent('view/component/inscription_form.php')
    handleForm('user/new',loadConnexionForm)
}

function handleForm(action,callback){
    document.querySelector('#submit').addEventListener('click',async (e)=>{
        e.preventDefault();
        data = new FormData(document.querySelector('form'))
        const response = await postContent(action,data)
        if(response.status == 201){
            callback()
        } 
        jsonContent = await response.json()
        displayMessage(jsonContent.msg)
    })
}

function displayMessage($msg){
    serverMsg.innerHTML = $msg;
}

async function loadContent(url){
    return fetch(url)
    .then(response=>response.text())
}

async function postContent(url,data){
    return fetch(url,{
        method: 'POST',
        body: data
    }).then(response=>response)}

function changePage(page){
    console.log('yeahhh',page)
}