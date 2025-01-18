const form = document.querySelector('.registration-form');
const sendData = document.querySelector('.form-button');
const messageAlert = document.querySelector('.message-alert')

form.onsubmit = (e) => {
    let formData = {
        action: 'login',
        email: form.email.value,
        password: form.password.value,
    };

    e.preventDefault()
    fetch('http://localhost:3000/xampp/htdocs/chatSimples/src/api/controllerApi.php', { 
    method: 'POST', body: JSON.stringify(formData)
    })
    .then(response => { 
        if(response.ok){ 
            return response.json()
          
        }
    }).then(data => {
    if(data.success){
        console.log(data);
        location.href = `./users.php`
    }else{
        console.log(data);
    }
    })
};
