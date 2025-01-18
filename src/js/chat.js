const chatMessage = document.querySelector('.chat-display');
const form = document.querySelector('.chat-input');
const sendbtn = document.querySelector('.sendChat');
const chatPage = document.querySelector('.chat-container')


chatPage.onmouseenter = () => {
    chatPage.classList.add("scroll"); 
}

chatPage.onmouseleave = () => {
    chatPage.classList.remove("scroll"); 
}


function insertMessages() {
    form.addEventListener('submit', (e) => {
        e.preventDefault();
      
        const userId = form.querySelector('[name="user_id"]');
        const receiverId = form.querySelector('[name="receiver_id"]');
        const message = form.querySelector('[name="message"]');

        if (!userId || !receiverId || !message) {
            console.error("Campos obrigatórios não encontrados!");
            return;
        }

        fetch('./src/api/controllerApi.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'update-messages',
                id: userId.value,
                user_id: receiverId.value,
                message: message.value,
            }),
        })
            .then((response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error("Erro na requisição!");
                }
            })
            .then((data) => {
                console.log("Mensagem enviada com sucesso:", data);
                scrollToBottom(); 
            })
            .catch((error) => console.error("Erro:", error));

        message.value = '';
    });
}

insertMessages();

function getMessagesChat() {
    setInterval(async () => {
        const userId = form.querySelector('[name="user_id"]');
        const receiverId = form.querySelector('[name="receiver_id"]');

        if (!userId || !receiverId) {
            console.error("IDs de usuário não encontrados!");
            return;
        }

        try {
            const response = await fetch('http://localhost:3000/xampp/htdocs/chatSimples/src/api/controllerApi.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'list-my-messages',
                    user_id: receiverId.value,
                    id: userId.value,
                }),
            });

            if (!response.ok) {
                throw new Error("Erro na requisição!");
            }

            const data = await response.json();

            if (data.success) {
                renderChat(data.data);
                if(!chatPage.classList.contains("scroll")){
                    scrollToBottom();
                }
            } else {
                renderChat(false);
            }
        } catch (error) {
            console.error("Erro ao buscar mensagens:", error);
        }
    }, 500);

}

getMessagesChat();

function renderChat(data) {
    let count = 0;
    chatMessage.innerHTML = '';
    if (!data) {
        chatMessage.innerHTML = `
            <div class="noMessages">Sem mensagens</div>
        `;
    } else {
        data.forEach((element) => {
            const div = document.createElement('div');
            const p = document.createElement('p')
            p.classList.add('created_at')
            if (element.sender_id == form.querySelector('[name="user_id"]').value) {
                div.classList.add('message', 'sent');
                div.textContent = element.message;
                p.innerHTML = element.created_at
                div.appendChild(p)
            } else {
                div.classList.add('message', 'received');
                div.textContent = element.message;
                p.innerHTML = element.created_at
                div.appendChild(p)
            }
            chatMessage.appendChild(div);
        });
    }

}

function scrollToBottom(){
    chatPage.scrollTop = chatPage.scrollHeight; 
}
