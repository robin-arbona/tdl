let formPH 
let serverMsg 
let BASE_URL

document.addEventListener('DOMContentLoaded',async ()=>{
    BASE_URL = await fetch('base_url').then(reponse=>reponse.text())
    formPH = document.querySelector('.form')
    serverMsg = document.querySelector('.server_msg')
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
    handleForm('user/connexion',()=>changePage('Task/dashboard','todolist'))
}

async function loadInscriptionForm(){
    formPH.innerHTML = await loadContent('view/component/inscription_form.php')
    handleForm('user/add',loadConnexionForm)
}

function handleForm(action,callback){
    document.querySelector('#submit').addEventListener('click',async (e)=>{
        e.preventDefault();
        data = new FormData(document.querySelector('form'))
        const response = await postContent(action,data)
        let jsonContent = await response.json()
        let msg = jsonContent.msg
        if(response.status == 201){
            callback()
            msg='<div class="notification is-success"><button class="delete"></button>'+msg+'</div>'
        } else {
            msg='<div class="notification is-warning"><button class="delete"></button>'+msg+'</div>'
        }
        displayMessage(msg)
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

async function changePage(page,scriptName){
    const content = await fetch(page).then(response=>response.text())
    document.querySelector('.page_content').innerHTML = content
    document.querySelector('script').remove()
    script = document.createElement('script')
    script.type = 'text/javascript'
    script.src = BASE_URL +'/public/js/page.'+scriptName+'.js'
    document.querySelector(".script").appendChild(script);

}