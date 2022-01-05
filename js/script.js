document.addEventListener('DOMContentLoaded', async()=>{

    document.querySelectorAll('.nav-link').forEach(function(link){
        const prepare = window.location.pathname.replace(/\//g, ' ')
        console.log(prepare);
        if (prepare.includes(link.pathname))
            link.classList.add('active')
    })





    async function isOnline() {
        const req = await fetch('/api/chat/online', {
            method: 'POST'
        })
        return null
    }
    setInterval(await isOnline, 60000)
    await isOnline()
})