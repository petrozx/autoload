document.addEventListener("DOMContentLoaded", async()=>{

    if (window.location.href == 'http://petroz.myjino.ru/chat/') {
        const chats = document.querySelector('.chats')
        const users = await getAllUsers()
        console.log(users);
        users.forEach(user =>{
            const divUser = document.createElement('a')
            divUser.className = 'user'
            divUser.href = '/chat/private/?user=' + user['id']
            divUser.dataset.id = user['id']
            divUser.innerText = user['name']
            chats.append(divUser)
        })

        async function getAllUsers() {
            const req = await fetch('/api/chat/users',{
                method: 'POST'
            })
            return await req.json()
        }

    } else {

        const form = document.getElementById('chat')
        const button = document.getElementsByTagName('button')[0]
        const messages = document.querySelector('.messages')
        const message = document.querySelector('.message')
        const connect = document.querySelector('.connect')
        const chatWith = $_GET('user')

        button?.addEventListener("click", async(e)=>{
            e.preventDefault();
            await sendMessage()
            await updateMessage()
            form.reset()
        })

        // setInterval(await updateMessage, 5000);
        await showAll(chatWith)

        async function showAll(chatWith) {
            const get = await getall(chatWith);
            let length = messages?.querySelectorAll('div').length
            while (length < get.length) {
                const newMes = document.createElement('div')
                newMes.dataset.id = get[length]['id']
                newMes.innerText = get[length]['date_create']+"\n"+get[length]['author']+"\n"+get[length]['message']+"\n\n"
                messages.append(newMes)
                length++
            }
        }

        async function updateMessage() {
            const mess = Array.from(messages?.querySelectorAll('div'))
            const max = mess[mess.length - 1]?.dataset.id
            const response = await update(max||0)
            response.forEach(el=>{
                const newMes = document.createElement('div')
                newMes.dataset.id = el['id']
                newMes.innerText = el['date_create']+"\n"+el['author']+"\n"+el['message']+"\n\n"
                messages.append(newMes)
            })
        }

        async function getall(chatWith) {
            const formData = new FormData();
            formData.append('method', 'getAll')
            formData.append('chat', chatWith)
            const req = await fetch('/api/chat/getMessage', {
                method: 'POST',
                body: formData
            })
            try {
                return await req.json()
            } catch (err) {
                return false
            }
        }

        async function update($id) {
            const formData = new FormData();
            formData.append('method', 'update')
            formData.append('id', $id)
            const req = await fetch('/api/chat/update', {
                method: 'POST',
                body: formData
            })
            try {
                return await req.json()
            } catch (err) {
                return false
            }
        }

        async function sendMessage() {
            const formData = new FormData(form)
            formData.append('method', 'send')
            const req = await fetch('/api/chat/sendMessage', {
                method: 'POST',
                body: formData
            })
            return await req.json()
        }

        function $_GET(key) {
            var p = window.location.search;
            p = p.match(new RegExp(key + '=([^&=]+)'));
            return p ? p[1] : false;
        }
    }

})