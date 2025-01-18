const friends = document.querySelector('.friends-list')
const navButton = document.querySelectorAll('.nav-button')

let formdata = {
    action: 'list'
}

function listUsers(){
    setInterval(async () => {
        const response = await fetch('http://localhost:3000/xampp/htdocs/chatSimples/src/api/controllerApi.php', {
            method: 'POST', body: JSON.stringify(formdata)
        })
        .then(response => { 
            if (response.ok) { 
                return response.json() 
            } 
        })
        .then(data => { 
            renderHtml(data.data) 
        })    
    }, 500)
}

listUsers()

function renderHtml(data) {
    friends.innerHTML = ''
    data.forEach(element => {
        const a = document.createElement('a');
        a.href = `chat.php?receiver_id=${element.id_user}`;
        a.classList.add('friend-item');
        a.innerHTML = `
            <div class="avatar"></div>
            <div class="item-info">
                <div class="item-name">
                 <div class="item-name">${element.name} id user: ${element.id_user}</div>
                </div>
                <div class="item-preview">${element.status}</div>
            </div>`;
        friends.appendChild(a);
    });
}


