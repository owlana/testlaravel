import axios from 'axios';
import Observer from '../../observer';
import Utils from '../../utils';

const observer = new Observer();

class Form {
    constructor() {
        this.inputList = [];
    }

    init(options) {
        this.wrapper = options.target;
        this.form = options.target.querySelector('form');
        this.successMessage = options.successMessage;
        this.action = this.form.getAttribute('action');

        this._getElements();
        this._subscribes();
        this._bindEvents();
    }

    /**
     * Метод получает дом элементы.
     * @private
     */
    _getElements() {
        this.submit = this.form.querySelector('.j-form-submit');
        this.successMessageWrap = this.wrapper.querySelector('.j-form-success');
        this.errorMessageWrap = this.wrapper.querySelector('.j-form-error');
        this.errorValidate = this.wrapper.querySelector('.j-input-error');
    }

    /**
     * Метод навешивает обработчики событий.
     * @private
     */
    _bindEvents() {
        this.submit.addEventListener('click', (event) => {
            event.preventDefault();
            this._send();
        });
    }

    /**
     * Метод содержит в себе коллбэки на события других модулей.
     * @private
     */
    _subscribes() {
        observer.subscribe('inputValidate', (input) => {
            this._changeState(input);
        });
    }

    /**
     * Метод оптправляет данные на сервер.
     * @private
     */
    _send() {
        this.inputs = this.wrapper.querySelectorAll('.j-input');
        if (!this.validateAll()) {
            return;
        }

        this.formData = new FormData(this.form);

        axios.post(this.action, this.formData)
            .then((response) => {
                const status = response.data.status;

                if (status) {
                    this._sendIsSuccess();
                } else {
                    throw new Error('Ошибка на сервере');
                }
            })
            .catch((err) => {
                this._sendIsError();
                console.error(err);
            });
    }

    /**
     * Метод изменяет состояние валидации инпута при настпуплении соответствующего события.
     * @param {HTMLInputElement} input - инпут для которого нужно изменить состояние.
     * @private
     */
    _changeState(input) {
        this.inputList.forEach((item) => {
            if (item === input) {
                item.state = input.state;
            }
        });
    }

    /**
     * Метод вызывается при успешной отправке запроса.
     * @private
     */
    _sendIsSuccess() {
        Utils.hide(this.errorMessageWrap);
        this.submit.classList.remove('is-error');

        this._showSuccessMessage();
        this.submit.classList.add('is-disabled');
    }

    /**
     * Метод вызывается при ошибке отправки запроса.
     * @private
     */
    _sendIsError() {
        this.errorMessageWrap.classList.add('is-show');
        this.submit.classList.add('is-error');

        this._showErrorMessage();
    }

    /**
     * Показывает сообщение об успешной отправкой формы.
     * @private
     */
    _showSuccessMessage() {
        Utils.show(this.successMessageWrap);
        Utils.hide(this.form);

        observer.publish('successForm');
    }

    /**
     * Показывает сообщение об ошибке
     * @private
     */
    _showErrorMessage() {
        Utils.show(this.errorMessageWrap);
        Utils.hide(this.form);
    }

    /**
     * Метод запускает проверку валдиации для всех инпутов.
     * @return {boolean} - true/false успешная/неуспешная проверка.
     */
    validateAll() {
        let validate = true;
        this.errorValidate.innerHTML = "";
        this.inputs.forEach((item) => {
            if (!item.checkValidity()) {
                this.errorValidate.innerHTML += item.name + ' - ' + item.validationMessage + '<br>';
                validate = false;
            }
        });

        return validate;
    }
}

export default Form;
