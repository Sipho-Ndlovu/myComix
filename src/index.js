const login = document.querySelector('.btnLogin');
const signup = document.querySelector('.btnSignup');

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

        $('#signupForm').submit(function(e) {
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
            }, function(data) {
                $('#signupMessageContainer').html(data);

                if (data.includes('error')) {
                    $('#signupMessageContainer').addClass('error');
                } else {
                    $('#signupMessageContainer').removeClass('error');
                }

                if (data.includes('success')) {
                    $('#signupMessageContainer').addClass('success');
                } else {
                    $('#signupMessageContainer').removeClass('success');
                }
            });
        });
    }
}
