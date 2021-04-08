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
                let form = new FormData(this.parentElement)
                let response = await post('Task/update/changeState',form)
                if(response.status==201){
                    await refreshComponent('Task/todo',todolist)
                    await refreshComponent('Task/done',doneList)
                    initTask()
                } 
                let jsonContent = await response.text()
                displayMessage(jsonContent)
            }) 
        });
    }

    function initAddTaskButton(){
        addBtn = document.querySelector('.task_add > input[type=submit]')
        addBtn.addEventListener('click',async (e)=>{
            e.preventDefault()
            let taskAddForm = new FormData(addForm)
            let response = await post('Task/add',taskAddForm)
            if(response.status==201){
                await refreshComponent('Task/todo',todolist)
                await refreshComponent('Task/done',doneList)
                initTask()
            } 
            let jsonContent = await response.json()
            displayMessage(jsonContent.msg)
        })
    }

    async function refreshComponent($url,$component){
        $component.innerHTML = await get($url)
    }

    function displayMessage($msg){
        serverMsg.innerHTML = $msg;
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