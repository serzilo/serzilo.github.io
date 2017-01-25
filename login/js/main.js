(function() {
    var User = {
            login: 'admin',
            password: 'qwerty12345'
        },
        Utils = {
            addClass: function(o, c) {
                var re = new RegExp("(^|\\s)" + c + "(\\s|$)", "g");
                if (re.test(o.className)) return;
                o.className = (o.className + " " + c).replace(/\s+/g, " ").replace(/(^ | $)/g, "");
            },
            removeClass: function(o, c) {
                var re = new RegExp("(^|\\s)" + c + "(\\s|$)", "g");
                o.className = o.className.replace(re, "$1").replace(/\s+/g, " ").replace(/(^ | $)/g, "");
            }
        };

    function init() {
        initShowPassword();
        processingForm();
    }

    function initShowPassword() {
        var button = document.getElementById('showPasswordButton'),
            input = document.getElementById('password'),
            constants = {
                showPassword: {
                    title: 'Показать пароль',
                    type: 'password'
                },
                hidePassword: {
                    title: 'Спрятать пароль',
                    type: 'text'
                },
                btnClass: 'clicked'
            };

        button.addEventListener('click', function(e) {
            e.preventDefault();

            var type = input.type;

            if (type === constants.showPassword.type) {
                input.type = constants.hidePassword.type;
                button.setAttribute('title', constants.hidePassword.title);
                Utils.addClass(button, constants.btnClass);
            } else {
                input.type = constants.showPassword.type;
                button.setAttribute('title', constants.showPassword.title);
                Utils.removeClass(button, constants.btnClass);
            }

            input.focus();
        }, false);
    }

    function processingForm() {
        var form = document.getElementById('loginForm'),
            formInputs = form.querySelectorAll('.js-form-input');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            var formData = {};

            formInputs.forEach(function(element) {
                var data = validateFormInput(element);

                if (data.error && data.error === true) {
                    if (formData.error === undefined) {
                        element.focus();
                    }

                    formData.error = true;
                }

                formData[data.name] = data.value;
            });

            if (!formData.error) {
                if (processingConfidentialData(formData)) {
                    showUserPage(formData.login);
                }
            } else {
                toggleErrorMessage(false);
            }
        }, false);
    }

    function validateFormInput(element) {
        var data = {},
            value = element.value.trim();

        data.name = element.getAttribute('name');
        data.value = value;

        if (element.hasAttribute('data-required')) {
            var parent = element.parentNode,
                error = parent.querySelector('.form-error');

            if (value.length == 0) {
                Utils.addClass(parent, 'form-field_error');

                error.innerHTML = 'Поле должно быть заполнено';
                Utils.removeClass(error, 'hidden');

                data.error = true;
            } else {
                Utils.removeClass(parent, 'form-field_error');

                error.innerHTML = '';
                Utils.addClass(error, 'hidden');
            }
        }

        return data;
    }

    function processingConfidentialData(data) {
        var isValidated = true,
            errorMessage = '',
            serverErrors = document.getElementById('serverErrors');

        if (User.login !== data.login) {
            isValidated = false;
            errorMessage = 'Аккаунт с таким логином не найден. Попробуйте ещё раз';
        } else if (User.password !== data.password) {
            isValidated = false;
            errorMessage = 'Неправильный пароль. Попробуйте ещё раз';
        }

        serverErrors.innerHTML = errorMessage;

        toggleErrorMessage(isValidated === false);

        return isValidated;
    }

    function toggleErrorMessage(show) {
        var serverErrors = document.getElementById('serverErrors');

        if (show) {
            Utils.removeClass(serverErrors, 'hidden');
        } else {
            Utils.addClass(serverErrors, 'hidden');
        }
    }

    function showUserPage(login) {
        var userLayout = document.getElementById('userLayout');

        userLayout.querySelector('.layout_wrapper').innerHTML = 'Добро пожаловать, ' + login + '!';

        Utils.addClass(document.getElementById('formLayout'), 'hidden');
        Utils.removeClass(userLayout, 'hidden');
    }

    init();
})();
