// user-message
const listChat = document.querySelector('.messages-list')
const myId = document.querySelector('#myId')

let dataSend = {
  action: 'user-message',
  my_id: Number(myId.value)
}

function listUserMessage() {
  setInterval(async () => {
    const response = await fetch('http://localhost/chatSimples/src/api/chatApi.php', {
      method: 'POST',
      body: JSON.stringify(dataSend)
    })
      .then(response => {
        if (response.ok) {
          return response.json()
        }
      }).then(data => {
        if (data.success == true) {
          renderListMessages(data.data)
        } else {
          renderListMessages(false)
        }
      })
  }, 2500)
  
}
listUserMessage()


function renderListMessages(data) {
  console.log('My SESSION: ' + myId.value);
  if (data) {
     const lastMessages = {};

    // Itera sobre a lista para obter a última mensagem por id_user
    data.forEach(element => {
        lastMessages[element.receiver_id] = element; 
        console.log( lastMessages[element.receiver_id] = element);
        
    });
    

    listChat.innerHTML = ''
     // Renderiza apenas as últimas mensagens de cada usuário
     Object.values(lastMessages).forEach(user => {
     const a = document.createElement('a');

      a.href = `chat.php?user_id=${user.id_user}`;
      a.classList.add('friend-item');
      a.innerHTML = `
          <div class="avatar"></div>
          <div class="item-info">
              <div class="item-name">${user.sender_name}</div>
              <div class="item-preview">${user.message}</div>
          </div>`;
          listChat.appendChild(a);
  });
  } else {
    listChat.innerHTML = ''
    const a = document.createElement('a')
    a.innerHTML = `
       <div class="message-item">
              <div class="item-info">
                <div class="item-preview">Sem menssagens</div>
              </div>
            </div>`
    listChat.appendChild(a)
  }
}