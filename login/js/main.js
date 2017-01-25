(function() {
    var User = {
        login: 'admin',
        password: 'qwerty12345'
    };

    var Utils = {
        addClass: function (o, c) {
            var re = new RegExp("(^|\\s)" + c + "(\\s|$)", "g");
            if (re.test(o.className)) return;
            o.className = (o.className + " " + c).replace(/\s+/g, " ").replace(/(^ | $)/g, "");
        },
        removeClass: function (o, c) {
            var re = new RegExp("(^|\\s)" + c + "(\\s|$)", "g");
            o.className = o.className.replace(re, "$1").replace(/\s+/g, " ").replace(/(^ | $)/g, "");
        }
    };

    function init() {
        initShowPassword();
        validateForm();
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

        button.addEventListener('click', function (e) {
            e.preventDefault();

            var type = input.type;

            if (type === 'password') {
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

    function validateForm() {
        var form = document.getElementById('loginForm'),
            serverErrors = document.getElementById('serverErrors');

        form.addEventListener('submit', function (e) {
            e.preventDefault();

        }, false);
    }

    init();
})();
