let initTodoList= ()=>{
    console.log('hello todo list');

    addForm = document.querySelector('.task_add')
    todolist = document.querySelector('.task_todo')
    doneList = document.querySelector('.task_done')
    serverMsg = document.querySelector('.server_msg')
    
    init()

    async function init(){

        BASE_URL = await fetch('base_url').then(reponse=>reponse.text())
        initTask()
        initAddTaskButton()
        
    }

    function initTask(){
        tasks = document.querySelectorAll('.task')
        tasks.forEach(task => { 
            task.addEventListener('click',async function(e){
                e.preventDefault()
                postAndRefresh(this.parentElement,'Task/update/changeState')
            }) 
        });
    }

    function initAddTaskButton(){
        addBtn = document.querySelector('.task_add > input[type=submit]')
        addBtn.addEventListener('click',async (e)=>{
            e.preventDefault()
            postAndRefresh(addForm,'Task/add')
        })
    }

    async function postAndRefresh(formElement,action){
        let response = await post(action,new FormData(formElement))
        let jsonContent = await response.json()
        let msg = jsonContent.msg
        if(response.status==201){
            await refreshComponent('Task/todo',todolist)
            await refreshComponent('Task/done',doneList)
            initTask()
            msg='<div class="notification is-success"><button class="delete"></button>'+msg+'</div>'
        } else {
            msg='<div class="notification is-warning"><button class="delete"></button>'+msg+'</div>'
        }
        displayMessage(msg)
    }

    async function refreshComponent($url,$component){
        $component.innerHTML = await get($url)
    }

    function displayMessage($msg){
        serverMsg.innerHTML = $msg + serverMsg.innerHTML;
    }

    async function get(url){
        return fetch(url)
        .then(response=>response.text())
    }

    async function post(url,data){
        return fetch(url,{
            method: 'POST',
            body: data
        }).then(response=>response)}
}
initTodoList()