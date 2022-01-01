document.addEventListener("DOMContentLoaded", async()=>{
    const form = document.getElementById('chat')
    const button = document.getElementsByTagName('button')[0]
    const messages = document.querySelector('.messages')
    const message = document.querySelector('.message')

    button.addEventListener("click", async(e)=>{
        e.preventDefault();

    })

    showAll()

    function showAll() {
        const get = await getall();
        get?.foreach(mes=>{
            messages.innerHTML += mes['date_create']+"\n"+mes['author']+"\n"+mes['message']
        })
    }


    async function getall() {
        const formData = new FormData();
        formData.append('method', 'getAll')
        const req = await fetch('/api/chat/getMessage', {
            method: 'POST',
            body: formData
        })
        $response = await req?.json()
        return $response
    }

})