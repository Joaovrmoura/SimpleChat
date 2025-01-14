const receiver_id = document.querySelector('#receiverId')
const chatMessage = document.querySelector('.chat-display')
const form = document.querySelector('.chat-input')
const sendbtn  = document.querySelector('.sendChat')


function insertMessages(){
    form.addEventListener('submit', (e) => {
        e.preventDefault()
        fetch('http://localhost/chatSimples/src/api/chatApi.php', {
            method : 'POST',
            body : JSON.stringify({
                action : 'update-messages',
                id : myId.value,
                user_id : receiver_id.value,
                message : form.message.value
            })
        }).then(response => {
             if(response.ok){
                return response.json()
             }
        }).then(data => {
             console.log(true);
         })
         form.message.value = ''
    })
}

insertMessages()

function getMessagesChat(){
    setInterval(async () => {
        const response = await fetch('http://localhost/chatSimples/src/api/chatApi.php', {
            method : 'POST',
            body : JSON.stringify({
                action : 'list-my-messages',
                user_id : receiver_id.value,
                id : myId.value
            })
        }).then(response => {
            if(response.ok){
                return response.json()
            }
        }).then(data => {
            console.log(data);
            
            if(data.success === true){
                renderChat(data.data)
                console.log(data);

            }else{
                renderChat(false)
            }
        
        })
    },2000)
}
getMessagesChat()



function renderChat(data){
    chatMessage.innerHTML = ''
    if(!data){
        chatMessage.innerHTML = `
        <div class="noMessages">Sem menssagens</div>
        `
    }else{
        data.forEach(element => {
            const div = document.createElement('div')
            
            if(element.sender_id == myId.value){
                div.classList.add('message','received')
                div.innerHTML = `${element.message}`
                chatMessage.appendChild(div)
            }else{
                div.classList.add('message','sent')
                div.innerHTML = `${element.message}`
                chatMessage.appendChild(div)
            }
            console.log(element.receiver_id);
        });
    }
   
}
// <div class="message received">Olá! Como vai? <?= $_SESSION['id'] ?></div>
// <div class="message sent">Oi! Tudo bem, e você? <?= $receiver_id ?> </div>