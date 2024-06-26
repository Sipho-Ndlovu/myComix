const login = document.querySelector('.btnLogin');
const signup = document.querySelector('.btnSignup');

$('#loginForm').submit(function (e) {
    e.preventDefault();
    var username = $('#loginUsername').val();
    var password = $('#loginPassword').val();
    var submit = $('#loginSubmit').val();
    $.post('src/auth.php', {
        username: username,
        password: password,
        submit: submit
    }, function (data) {
        $('#loginMessageContainer').html(data);

        if (data.includes('error')) {
            $('#loginMessageContainer').addClass('error');
        } else {
            $('#loginMessageContainer').removeClass('error');
        }

        if (data.includes('success')) {
            $('#loginMessageContainer').addClass('success');
            setTimeout(function() {window.location.href = "collection.php";}, 1000);
        } else {
            $('#loginMessageContainer').removeClass('success');
        }
    });
});

$('#signupForm').submit(function (e) {
    e.preventDefault();
    var name = $('#signupName').val();
    var email = $('#signupEmail').val();
    var username = $('#signupUsername').val();
    var password = $('#signupPassword').val();
    var confirmPassword = $('#signupConfirmPassword').val();
    var submit = $('#signupSubmit').val();
    $.post('src/auth.php', {
        name: name,
        email: email,
        username: username,
        password: password,
        confirmPassword: confirmPassword,
        submit: submit
    }, function (data) {
        $('#signupMessageContainer').html(data);

        if (data.includes('error')) {
            $('#signupMessageContainer').addClass('error');
        } else {
            $('#signupMessageContainer').removeClass('error');
        }

        if (data.includes('success')) {
            $('#signupMessageContainer').addClass('success');
            $('#signupName').val("");
            $('#signupEmail').val("");
            $('#signupUsername').val("");
            $('#signupPassword').val("");
            $('#signupConfirmPassword').val("");
        } else {
            $('#signupMessageContainer').removeClass('success');
        }
    });
});

login.onclick = () => {
    const signupForm = document.querySelector('.signupForm');
    const loginForm = document.querySelector('.loginForm');
    if (signupForm) {
        loginForm.style.display = 'flex';
        signupForm.style.display = 'none';
    }
}

signup.onclick = () => {
    const loginForm = document.querySelector('.loginForm');
    const signupForm = document.querySelector('.signupForm');
    if (login) {
        signupForm.style.display = 'flex';
        loginForm.style.display = 'none';
    }
}
