/* Validator Start */
let startValidate = (selector) => {
    let form = selector,
        inputs = form.querySelectorAll('input[type="text"]'),
        selects = form.querySelectorAll('select');
    /* console.log(form) */
    /* inputs.forEach(element => {
        console.log(element)
    }); */

    let validators = {
        global: {
            regex: /^\s*(?:\S\s*){3,500}$/
        },
        email: {
            regex: /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/
        },
        phone: {
            regex: /^[0-9]{0,10}[+]*[(]{0,1}[0-9]{8,}[)]{0,1}[-\s\./0-9]*$/,
        },
        cdTransaction: {
            regex: /^\s*(?:\S\s*){6,10}$/
        }
    };

    let validate = (klass, value) => {
        var isValid = true,
            error = '';

        if (!value && /required/.test(klass)) {
            error = 'Este campo es requerido.';
            isValid = false;
        } else {
            /* console.log(klass); */
            let klassi = klass;
            klassi.forEach((e, k) => {
                /* console.log(e,k); */
                if (validators[e]) {
                    if (value && !validators[e].regex.test(value)) {
                        isValid = false;
                        error = validators[e].error;
                    }
                }
            });
        };
        return {
            isValid: isValid,
            error: error
        };
    };

    let showError = (node) => {
        let klass = node.classList,
            value = node.value,
            test = validate(klass, value);

        klass.remove('is-invalid');
        klass.remove('invalid');
        /* document.querySelector('form-error').classList.add('hide'); */

        if (!test.isValid) {
            klass.add('is-invalid');
            klass.add('invalid');
            /* console.log('no e pasado, caramba'); */
        } else {
            /* console.log('pase'); */
        }
    }

    /* inputs.keyup(() => {
        showError(this);
    }); */
    inputs.forEach(element => {
        element.addEventListener('keyup', delay((e) => {
            showError(e.target);
        }, 500));

        element.addEventListener('change', (e) => {
            showError(e.target);
        });
    });

    selects.forEach(element => {
        element.addEventListener('change', (e) => {
            showError(e.target);
        });
    });

    if (form.id == 'principalForm') {
        form.addEventListener('submit', (e) => {
            console.log('adiosss');
            inputs.forEach(input => {
                if (input.required || input.classList.contains('invalid')) {
                    showError(input);
                }
            });

            selects.forEach(select => {
                if (select.required || select.classList.contains('invalid')) {
                    showError(select);
                }
            });

            /* form.querySelector('input[type="file"]').addEventListener( 'change', (e) => {
                  if (condition) {
                      
                  }
            }); */

            if (form.querySelector('input[type="file"]').value == '') {
                /* console.log('entro'); */
                /* showError(form.querySelector('input[type="file"]')); */
                form.querySelector('input[type="file"]').classList.add('invalid');
                form.querySelector('input[type="file"]').setAttribute('data-bs-content', 'Este campo es requerido.');
                var popover = bootstrap.Popover.getInstance(form.querySelector('input[type="file"]'));
                popover.show();
            } else {
                if (form.querySelector('input[type="file"]').classList.contains('invalid')) {
                    form.querySelector('input[type="file"]').classList.remove('invalid');
                }
                let fV = form.querySelector('input[type="file"]').files[0];
                let v = fV.type.split('/').pop().toLowerCase();

                if (v != "jpeg" && v != "jpg" && v != "png" && v != "webp" && v != "gif") {
                    form.querySelector('input[type="file"]').classList.add('invalid');
                    form.querySelector('input[type="file"]').setAttribute('data-bs-content', 'Porfavor selecciona un tipo de imagen valida, entre: JPG, PNG, WEBP, JPEG o GIF');
                    var popover = bootstrap.Popover.getInstance(form.querySelector('input[type="file"]'));
                    popover.show();
                }
            }

            if (form.querySelectorAll('.invalid').length) {
                e.preventDefault();
            }
        });
    } else {
        form.addEventListener('submit', (e) => {
            inputs.forEach(input => {
                if (input.required || input.classList.contains('invalid')) {
                    showError(input);
                }
            });

            selects.forEach(select => {
                if (select.required || select.classList.contains('invalid')) {
                    showError(select);
                }
            });

            if (form.querySelectorAll('invalid').length) {
                e.preventDefault();
            }
        });
    }
    return selector;
};

/* startValidate(document.querySelector('form')); */
/* Lazy Input */
function delay(fn, ms) {
    let timer = 0
    return function(...args) {
        clearTimeout(timer)
        timer = setTimeout(fn.bind(this, ...args), ms || 0)
    }
}

function createMessage(mesage) {
    var data = document.createElement('div');
    data.setAttribute('class', 'invalid-tooltip');
    var message = document.createTextNode(mesage);
    data.appendChild(message);
    return data;
}
/* function delay(callback, ms) {
    var timer = 0;
    return function() {
      var context = this, args = arguments;
      clearTimeout(timer);
      timer = setTimeout(function () {
        callback.apply(context, args);
      }, ms || 0);
    };
} */
/* Validator End */