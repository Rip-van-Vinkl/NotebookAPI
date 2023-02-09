let id = null;

document.getElementById('name').value = '';
document.getElementById('company').value = '';
document.getElementById('phone').value = '';
document.getElementById('email').value = '';
document.getElementById('birthday').value = '';
document.getElementById('photo').value = '';

document.getElementById('nameErr').innerText = '';

document.getElementById('name-putch').value = '';
document.getElementById('company-putch').value = '';
document.getElementById('phone-putch').value = '';
document.getElementById('email-putch').value = '';
document.getElementById('birthday-putch').value = '';
document.getElementById('photo-putch').value = '';
document.getElementById('id-putch').value = '';

async function getNotes() {
    let res = await fetch('http://notebook/api/notes');
    let notes = await res.json();

    document.querySelector('.note-list').innerHTML = '';

    notes.forEach(note => {
        document.querySelector('.note-list').innerHTML +=`
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-name">ФИО: ${note.name}</h5>
                    <h5 class="card-name">Компания: ${note.company}</h5>
                    <h5 class="card-name">Телефон: ${note.phone}</h5>
                    <h5 class="card-name">Email: ${note.email}</h5>
                    <h5 class="card-name">Дата рождения: ${note.birthday}</h5>
                    <h5 class="card-name">Фото: ${note.photo}</h5>
                    <a href="#" class="card-link" onclick="selectNote('${note.name}','${note.company}','${note.phone}','${note.email}','${note.birthday}','${note.photo}', ${note.id})">Редактировать</a>
                    <a href="#" class="card-link" onclick="deleteNote(${note.id})">Удалить</a>
                </div>
            </div>
        `       
    });
}

async function addNote() {
    const name = document.getElementById('name').value;
    const company = document.getElementById('company').value;
    const phone = document.getElementById('phone').value;
    const email = document.getElementById('email').value;
    const birthday = document.getElementById('birthday').value;
    const photo = document.getElementById('photo').value;

    let formData = new FormData();
    formData.append('name', name);
    formData.append('company', company);
    formData.append('phone', phone);
    formData.append('email', email);
    formData.append('birthday', birthday);
    formData.append('photo', photo);

    const res = await fetch('http://notebook/api/notes', {
        method: "POST",
        body: formData
    });

    const data = await res.json();

    if (data.messageErr) {
        document.getElementById('nameErr').innerText = data.messageErr;
    }

    if (data.status === true) {
        await getNotes();

        document.getElementById('name').value = '';
        document.getElementById('company').value = '';
        document.getElementById('phone').value = '';
        document.getElementById('email').value = '';
        document.getElementById('birthday').value = '';
        document.getElementById('photo').value = '';

        document.getElementById('nameErr').innerText = '';
    }
}

async function deleteNote(id) {
    const res = await fetch(`http://notebook/api/notes/${id}`, {
        method: "DELETE"
    });

    const data = await res.json();

    if (data.status === true) {
        await getNotes();
    }
}

async function selectNote(name, company, phone, email, birthday, photo, id) {
    document.getElementById('name-putch').value = name;
    document.getElementById('company-putch').value = company;
    document.getElementById('phone-putch').value = phone;
    document.getElementById('email-putch').value = email;
    document.getElementById('birthday-putch').value = birthday;
    document.getElementById('photo-putch').value = photo;
    document.getElementById('id-putch').value = id;
}

async function putchNote(id = document.getElementById('id-putch').value) {

    const name = document.getElementById('name-putch').value;
    const company = document.getElementById('company-putch').value;
    const phone = document.getElementById('phone-putch').value;
    const email = document.getElementById('email-putch').value;
    const birthday = document.getElementById('birthday-putch').value;
    const photo = document.getElementById('photo-putch').value;

    const data = {
        name: name,
        company: company,
        phone: phone,
        email: email,
        birthday: birthday,
        photo: photo
    };

    const res = await fetch(`http://notebook/api/notes/${id}`, {
        method: "PATCH",
        body: JSON.stringify(data)
    });

    const resData = await res.json();

    if (resData.status === true) {
        getNotes();
    }

    document.getElementById('name-putch').value = '';
    document.getElementById('company-putch').value = '';
    document.getElementById('phone-putch').value = '';
    document.getElementById('email-putch').value = '';
    document.getElementById('birthday-putch').value = '';
    document.getElementById('photo-putch').value = '';
    document.getElementById('id-putch').value = '';
}

getNotes();