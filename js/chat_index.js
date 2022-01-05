// document.addEventListener("DOMContentLoaded", async()=>{
//     const usersALL = await getAllUsers()
//     const globalUser = await User();

//     async function getAllUsers() {
//         const req = await fetch('/api/chat/users',{
//             method: 'POST'
//         })
//         return await req.json()
//     }

//     async function User() {
//         const req = await fetch('/api/login/userAuth', {
//             method: 'POST',
//             body: ""
//         })
//         return await req.json()
//     }

//     if (!globalUser['error']) {
//         const chats = document.querySelectorAll('.online')
//         usersALL.forEach((user,key) =>{
//             if (globalUser['success'] != user['id']) {
//                 if( (+user['date_update']*1000 + 10*60*1000) > (new Date().getTime()) ) {
//                     chats[key].innerText = 'В сети'
//                 } else {
//                     chats[key].innerText = 'Не в сети'
//                 }
//             }
//         })
//     }
// })