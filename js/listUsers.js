const friends = document.querySelector('.friends-list')
let formdata = {
    action: 'list'
}
fetch('http://localhost/chatSimples/src/api/userApi.php', {
    method: 'POST',
    body: JSON.stringify(formdata)
})
    .then(response => {
        if (response.ok) {
            return response.json()
        }
    })
    .then(data => {
        renderHtml(data.data)
        
    })

    function renderHtml(data) {
        data.forEach(element => {
            const a = document.createElement('a');
            a.href = `index.php?user_id=${element.id_user}`;
            a.classList.add('friend-item');
            
            a.innerHTML = `
            <div class="avatar"></div>
            <div class="item-info">
                <div class="item-name">
                 <div class="item-name">${element.name}</div>
                </div>
                <div class="item-preview">${element.status}</div>
            </div>`;
            
            friends.appendChild(a);
        });
    }
    