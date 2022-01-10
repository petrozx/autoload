document.addEventListener("DOMContentLoaded", async()=>{
    const form = document.getElementById('chat')
    const button = document.getElementById('send-message')
    const messages = document.querySelector('.messages')
    const spiner = document.querySelector('.spinner-border')
    const connectText = document.querySelector('#alert')
    spiner.classList.remove('d-none')
    const globalUser = await User();
    const chatWith = $_GET('user')
    // const usersALL = await getAllUsers()

    // async function getAllUsers() {
    //     const req = await fetch('/api/chat/users',{
    //         method: 'POST'
    //     })
    //     return await req.json()
    // }

    async function update(date) {
        const formData = new FormData();
        formData.append('method', 'update')
        formData.append('chat', chatWith)
        formData.append('date_create', date)
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
        form.reset()
        formData.append('method', 'send')
        formData.append('what_a_chat', chatWith)
        formData.append('chat', globalUser['success'])
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

    async function sendRead(array) {
        const req = await fetch('/api/chat/mesRead', {
            method: 'POST',
            body: JSON.stringify(array)
        })
        return await req.json();
    }

    let max;
    let run = true;
    async function updateMessage() {
        if(run) {
            run = false
            const mess = Array.from(messages?.querySelectorAll('div'))
            const response = await update(max||0)
            let newMes = "";
            (response.length)&&response.forEach(el=>{
                if (el['type'] == 'text') {
                    newMes = document.createElement('div')
                    newMes.dataset.id = el['id']
                    if(el['author'] == globalUser['success']){
                        newMes.className = 'd-flex me-2 mb-2 justify-content-start';
                    } else {
                        newMes.className = 'd-flex ms-2 mb-2 justify-content-end';
                    }
                    let name;
                    // usersALL.forEach(element => {
                    //     if (element['id'] == el['author']) name = element['name']
                    // });
                    // newMes.innerText = formatTime(el['date_create'])+"\n"+name+"\n"+el['message']+"\n\n"
                    newMes.innerText = el['message']
                } else if (el['type'] == 'audio') {
                    newMes = document.createElement('div')
                    const audio = new Audio(el['message'])
                    audio.type = 'audio/mpeg'
                    audio.controls = true;
                    audio.preload = 'auto';
                    newMes.append(audio)
                    const source = document.createElement('source')
                    if(el['author'] == globalUser['success']){
                        newMes.className = 'd-flex me-2 mb-2 justify-content-start';
                    } else {
                        newMes.className = 'd-flex ms-2 mb-2 justify-content-end';
                    }
                }
                    messages.append(newMes)
                    if(el['is_read']=='1' || el['author']==globalUser['success']) {
                        newMes.scrollIntoView({block: "center", behavior: "smooth"})
                    }
                    max = el['date_create']
            })
            response.length&&await sendRead(response)
        }
        run = true
    }

    async function User() {
        const req = await fetch('/api/login/userAuth', {
            method: 'POST',
            body: ""
        })
        return await req.json()
    }

    function formatTime(unix) {
        const date = new Date(unix*1000)
        return date.getDate()+"/"+date.getMonth()+1+"/"+date.getFullYear()+" "+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds()
    }

        button.addEventListener("click", async(e)=>{
            e.preventDefault();
            await sendMessage()
            await updateMessage()
        })

        setInterval(await updateMessage, 5000);

        await updateMessage()

    navigator.mediaDevices.getUserMedia({audio: true})
    .then(stream => {
        const mediaRecorder = new MediaRecorder(stream);

        document.querySelector('.mike').addEventListener('touchstart', function(e){
            e.preventDefault()
            mediaRecorder.start();
        });
        document.querySelector('.mike').addEventListener('mousedown', function(e){
            e.preventDefault()
            mediaRecorder.start();
        });

        let audioChunks = [];
        mediaRecorder.addEventListener("dataavailable",function(event) {
            audioChunks.push(event.data);
        });

        document.querySelector('.mike').addEventListener('touchend', function(e){
            e.preventDefault()
            mediaRecorder.stop();
        });
        document.querySelector('.mike').addEventListener('mouseup', function(e){
            e.preventDefault()
            mediaRecorder.stop();
        });

        mediaRecorder.addEventListener("stop", async function() {
            const audioBlob = new Blob(audioChunks, {
                type: 'audio/webm'
            });
            let fd = new FormData();
            fd.append('voice', audioBlob);
            fd.append('what_a_chat', chatWith)
            sendVoice(fd);
            updateMessage()
            audioChunks = [];
        });
    });

    async function sendVoice(form) {
        let promise = await fetch('/api/chat/save', {
            method: 'POST',
            body: form});
        let response = await promise.json()
    }
    spiner.classList.add('d-none')
    const fileInput = document.querySelector('[type=file]')
    const events = ['drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave'];
    events.forEach(e=>{
        messages.addEventListener(e, (event)=>{
            event.preventDefault()
            event.stopPropagation()
            messages.classList.add('focus')
        })
    })

    messages.addEventListener('drop', ()=>{
        messages.classList.remove('focus')
    })
})