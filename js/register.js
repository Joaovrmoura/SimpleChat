const form = document.querySelector('.registration-form');
const sendData = document.querySelector('.form-button');
const messageAlert = document.querySelector('.message-alert')

function message(data) {
    if (data.success === true) {
          location.href = 'login.php'
          messageAlert.classList.add('success')
          messageAlert.innerHTML = data.message
          console.log(data);
        setTimeout(() => {
            messageAlert.classList.remove('success');
            messageAlert.innerHTML = ''
        }, 1500)

    } else {
        messageAlert.classList.add('error')
        messageAlert.innerHTML = data.message
        console.log(data);
        setTimeout(() => {
            messageAlert.classList.remove('error');
            messageAlert.innerHTML = ''
        }, 1500)
    }
}

form.onsubmit = (e) => {
    e.preventDefault(); 
    let formData = {
        action : 'register',
        name : form.name.value,
        email : form.email.value,
        password : form.password.value,
        confirmPassword : form.confirmPassword.value
    };

    fetch('http://localhost/chatSimples/src/api/userApi.php', 
    { method : 'POST', body : JSON.stringify(formData)})
    .then(response => {if(response.status === 200){ return response.json(); }})
    .then(data => {
        message(data)
     })
};
