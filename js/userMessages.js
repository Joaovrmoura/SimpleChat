// user-message
const listChat = document.querySelector('.messages-list');
const user_id = parseInt(document.querySelector('.user_id').value, 10);

if (isNaN(user_id)) {
  console.error("O ID do usuário é inválido!");
}

function listUserMessage() {
  setInterval(async () => {
    try {
      const response = await fetch('http://localhost/chatSimples/src/api/chatApi.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          action: 'user-message',
          my_id: user_id,
        }),
      });

      if (!response.ok) {
        throw new Error(`Erro na requisição: ${response.statusText}`);
      }

      const data = await response.json();

      if (data.success === true) {
        const messages = data.data;
        console.log("Mensagens recebidas:", messages);

        renderListMessages(getLastMessagesInOrder(messages, user_id));
      } else {
        renderListMessages(false);
      }
    } catch (error) {
      console.error("Erro ao buscar mensagens:", error);
    }
  }, 1000);
}


listUserMessage();


function getLastMessagesInOrder(data, user_id) {
  const latestMessages = {};

  data.forEach((item) => {
    const userKey = item.id_user === user_id ? item.receiver_id : item.id_user;
  
    if (
      !latestMessages[userKey] ||
      new Date(item.created_at) > new Date(latestMessages[userKey].created_at)
    ) {
      latestMessages[userKey] = {
        id_user: item.id_user,
        receiver_id: item.receiver_id,
        sender_name: item.sender_name,
        message: item.message,
        created_at: item.created_at,
        receiver_name: item.receiver_name,
      };
    }
  });

  return Object.values(latestMessages);
}




function renderListMessages(data) {
  console.log("ID da sessão do usuário:", user_id);


  listChat.innerHTML = '';

  const renderedUsers = new Set(); 

  if (data) {
    data.forEach((user) => {
      const uniqueKey = user.id_user === user_id ? user.receiver_id : user.id_user;

      if (renderedUsers.has(uniqueKey)) {
        return; 
      }
      renderedUsers.add(uniqueKey); 

      const a = document.createElement('a');

      // Define o link do chat
      a.href = user.id_user === user_id
        ? `chat.php?receiver_id=${user.receiver_id}`
        : `chat.php?receiver_id=${user.id_user}`;

      a.classList.add('friend-item');
      a.innerHTML = `
        <div class="avatar"></div>
        <div class="item-info">
            <div class="item-name">
              ${user.receiver_id !== user_id ? user.receiver_name : user.sender_name}
              ID: ${user.receiver_id !== user_id ? user.receiver_id : user.id_user}
            </div>
            <div class="item-preview">
              ${user.receiver_id === user_id ? '' : 'Me:'} ${user.message}
            </div>
        </div>
      `;
      listChat.appendChild(a);
    });
  } else {
    // Caso não existam mensagens
    const a = document.createElement('a');
    a.innerHTML = `
      <div class="message-item">
        <div class="item-info">
          <div class="item-preview">Sem mensagens</div>
        </div>
      </div>
    `;
    listChat.appendChild(a);
  }
}
