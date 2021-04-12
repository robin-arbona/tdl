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
        initModal()
    }

    function initModal(){
        document.querySelector('.modal-background').addEventListener('click',modalHide)
        
        document.querySelector('.button-add').addEventListener('click',async ()=>{
            await modalShow("Task/addForm")
            initSubmitAddTaskButton()
        })

        document.querySelector('.button-privilege').addEventListener('click',async ()=>{
            await modalShow("User/updateForm")
            initSearchFormButton()
        })
    }

    function initTask(){
        tasks = document.querySelectorAll('.task')
        tasks.forEach(task => { 
            task.addEventListener('click',async function(e){
                e.preventDefault()
                e.stopPropagation()
                postAndRefresh(this.parentElement,'Task/update/changeState')
            }) 
        });
        let rows = document.querySelectorAll('.task_row')
        rows.forEach(row=>{
            row.addEventListener('mouseover',function(){
                this.classList.add('is-selected')
            })
            row.addEventListener('mouseout',function(){
                this.classList.remove('is-selected')
            })
            row.addEventListener('click',async function(){
                let id = this.querySelector('input[name=task]').getAttribute('value')
                let form = new FormData()
                form.append('id',id)
                let response = await post('Task/updateForm',form)
                let content = await response.text()
                document.querySelector('.modal-content').innerHTML = content
                document.querySelector('.modal').classList.add('is-active')
                initUpdateTaskButtons()
            })
        })
    }

    function initSubmitAddTaskButton(){
        addBtn = document.querySelector('.task_add  input[type=submit]')
        addBtn.addEventListener('click',async (e)=>{
            let addForm = document.querySelector('.task_add')
            e.preventDefault()
            postAndRefresh(addForm,'Task/add')
        })
    }

    function initUpdateTaskButtons(){
        let btns = document.querySelectorAll('.task_update input[type=submit]')
        btns.forEach(btn=>{
            btn.addEventListener('click',async function(e){
                e.preventDefault()
                let form = new FormData(document.querySelector('.task_update'))
                let actionRequested = this.getAttribute('value')
                if(actionRequested == "Save"){
                    let response = await post('Task/update',form)
                    console.log(response);
                } else if (actionRequested == "Remove") {
                    let idVal = document.querySelector('.task_update input[name=id]').getAttribute('value') 
                    let response = await get('Task/remove/'+idVal,'json')
                    msg='<div class="notification is-success"><button class="delete"></button>'+response.msg+'</div>'
                }
                await refreshComponent('Task/todo',todolist)
                await refreshComponent('Task/done',doneList)
                //displayMessage(msg)
                initTask()
                modalHide()
            })
        })
    }

    function initSearchFormButton(){
        let searchBtn = document.querySelector('.user_update  input[type=submit]')
        searchBtn.addEventListener('click',async (e)=>{
            e.preventDefault()
            searchInDb(document.querySelector('.user_update'),'User/updateForm')
        })
        let privilegeBtn = document.querySelectorAll('.privilege')
        privilegeBtn.forEach(element=>{
            element.addEventListener('click',function(e){
                e.preventDefault()
                let id = this.id.replace("user-", "")
                let form = new FormData()
                form.append('id',id)
                if(this.parentElement.classList.contains('privilege2add')){
                    post('User/update/addPrivilege',form)
                } else {
                    post('User/update/removePrivilege',form)
                }
                searchInDb(document.querySelector('.user_update'),'User/updateForm')
            })
        })
    }

    async function searchInDb(formElement,action){
        let response = await post(action,new FormData(formElement))
        let content = await response.text()
        document.querySelector('.modal-content').innerHTML = content
        initSearchFormButton()
    }

    async function postAndRefresh(formElement,action){
        let response = await post(action,new FormData(formElement))
        let jsonContent = await response.json()
        let msg = jsonContent.msg
        if(response.status==201){
            await refreshComponent('Task/todo',todolist)
            await refreshComponent('Task/done',doneList)
            initTask()
            modalHide()
            msg='<div class="notification is-success"><button class="delete"></button>'+msg+'</div>'
        } else {
            msg='<div class="notification is-warning"><button class="delete"></button>'+msg+'</div>'
        }
        displayMessage(msg)
    }

    async function refreshComponent($url,component){
        component.innerHTML = await get($url)
    }

    function displayMessage($msg){
        serverMsg.innerHTML = $msg ;
    }

    async function get(url,type = 'text'){
        return fetch(url)
        .then(response=>{
            if(type=='text'){
                return response.text()
            } else if (type== 'json'){
                return response.json()
                }
            })
    }

    async function modalShow(action){
        let content = await get(action);
        document.querySelector('.modal-content').innerHTML = content
        document.querySelector('.modal').classList.add('is-active')
    }
    function modalHide(){
        document.querySelector('.modal').classList.remove('is-active')
    }

    async function post(url,data){
        return fetch(url,{
            method: 'POST',
            body: data
        }).then(response=>response)}
}
initTodoList()