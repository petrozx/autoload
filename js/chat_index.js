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
            if( (+user['date_update']*1000 + 10*60*1000) > (new Date().getTime()) ) {
                divUser.className = 'user online'
            } else {
                divUser.className = 'user offline'
            }
            if (globalUser['success'] != user['id']) {
                chats.append(divUser)
            }
        })
    }

    navigator.mediaDevices.getUserMedia({ audio: true})
    .then(stream => {
        const mediaRecorder = new MediaRecorder(stream);

        document.querySelector('.mike').addEventListener('mousedown', function(){
            mediaRecorder.start();
        });
        let audioChunks = [];
        mediaRecorder.addEventListener("dataavailable",function(event) {
            audioChunks.push(event.data);
        });

        document.querySelector('.mike').addEventListener('mouseup', function(){
            mediaRecorder.stop();
        });

        mediaRecorder.addEventListener("stop", function() {
            const audioBlob = new Blob(audioChunks, {
                type: 'audio/wav'
            });

            let fd = new FormData();
            fd.append('voice', audioBlob);
            sendVoice(fd);
            audioChunks = [];
        });
    });

    async function sendVoice(form) {
        let promise = await fetch('/api/voice/save', {
            method: 'POST',
            body: form});
        if (promise.ok) {
            let response =  await promise.json();
            console.log(response.data);
            let audio = document.createElement('audio');
            audio.src = response.data;
            audio.controls = true;
            audio.autoplay = true;
            document.querySelector('#messages').appendChild(audio);
        }
    }
})