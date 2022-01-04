document.addEventListener("DOMContentLoaded", async()=>{
    const usersALL = await getAllUsers()
    const globalUser = await User();

    async function getAllUsers() {
        const req = await fetch('/api/chat/users',{
            method: 'POST'
        })
        return await req.json()
    }

    async function User() {
        const req = await fetch('/api/login/userAuth', {
            method: 'POST',
            body: ""
        })
        return await req.json()
    }

    if (!globalUser['error']) {
        const chats = document.querySelector('.chats')
        usersALL.forEach(user =>{
            const divUser = document.createElement('a')
            divUser.className = 'user'
            divUser.href = '/chat/private/?user=' + user['id']
            divUser.dataset.id = user['id']
            divUser.innerText = user['name']
            console.log(new Date(user['date_update'] + 15*60).getTime());
            console.log("-----------------------------------------");
            console.log(new Date().getTime());
            if(new Date(user['date_update'] + 15*60).getTime() > new Date().getTime() ) {
                divUser.className = 'user online'
            } else {
                divUser.className = 'user offline'
            }
            if (globalUser['success'] != user['id']) {
                chats.append(divUser)
            }
        })
    }
})