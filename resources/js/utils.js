/**
 * @version 1.3
 * @author Kelnik Studios {http://kelnik.ru}
 * @link https://kelnik.gitbooks.io/kelnik-documentation/content/front-end/components/utils.html documentation
 */

/**
 * DEPENDENCIES
 */
import 'url-search-params-polyfill';
import {clearAllBodyScrollLocks, disableBodyScroll} from 'body-scroll-lock';

class Utils {
    /**
     * Метод устанавливает комфорную задержку выполнения анимации.
     * @return {Number} comfortableAnimationTimeValue - значение в мс.
     */
    static comfortableAnimationTime() {
        const comfortableAnimationTimeValue = 300;

        return comfortableAnimationTimeValue;
    }

    /**
     * Метод полностью очищает весь html элемент.
     * @param {Object} element - DOM-элемент, который необходимо очистить.
     */
    static clearHtml(element) {
        element.innerHTML = '';
    }

    /**
     * Метод вставляет содержимое в блок.
     * @param {Object} element - элемент в который нужно вставить.
     * @param {Object/string} content - вставляемый контент.
     */
    static insetContent(element, content) {
        if (typeof content === 'string') {
            element.insertAdjacentHTML('beforeend', content);
        } else if (typeof content === 'object') {
            element.appendChild(content);
        }
    }

    /**
     * Метод полностью удаляет элемент из DOM-дерева.
     * @param {Object} element - элемент, который необходимо удалить.
     */
    static removeElement(element) {
        // node.remove() не работает в IE11
        element.parentNode.removeChild(element);
    }


    /**
     * Метод показывает элемент.
     * @param {Node} element - элемент, который необходимо показать.
     */
    static show(element) {
        element.style.display = 'block';
    }

    /**
     * Метод скрывает элемент.
     * @param {Node} element - элемент, который необходимо скрыть.
     */
    static hide(element) {
        element.style.display = 'none';
    }

    /**
     * Метод отправляет ajax запрос на сервер.
     * @param {Object} data - отправляемые данные.
     * @param {String} url - маршрут по которому нужно произвести запрос.
     * @param {Function} callback -  функция обратного вызова, которая при успехе вызовет success, а при ошибке error.
     * @param {String} method -  метод для отправки запроса. POST по умолчанию
     */
    static send(data, url, callback = function() {}, method = 'POST') {
        const xhr = new XMLHttpRequest();
        const statusSuccess = 200;

        xhr.open(method, url);

        if (!(data instanceof FormData)) {
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        }
        xhr.setRequestHeader('x-requested-with', 'XMLHttpRequest');

        xhr.send(data);

        xhr.onload = function XHR() {
            if (xhr.status === statusSuccess) {
                const req = JSON.parse(this.responseText);

                callback.success(req);
            } else {
                callback.error(xhr.status);
            }

            if (callback.complete) {
                callback.complete();
            }
        };
    }

    /**
     * Метод проверяет наличие интернета
     * @return {boolean} - При наличии результатом будет true, а при отсутсвии false.
     */
    static checkInternetConnection() {
        return navigator.onLine;
    }

    /**
     * Метод проверяет присутствует ли ключ в объекте
     * @param {Object} object - проверяем объект
     * @param {String} key - ключ, наличие которого проверяет в объекте
     * @return {boolean} - присутствует или нет ключ в объекте
     */
    static keyExist(object, key) {
        return Object.prototype.hasOwnProperty.call(object, key);
    }

    /**
     * Метод проверяет пустой объект или нет
     * @param {Object} object - объект проверяемый на пустоту
     * @return {boolean} - true если пустой и false если полный
     */
    static isEmptyObject(object) {
        const empty = 0;

        return Object.keys(object).length === empty;
    }

    /**
     * Проверяет переданные данные на строку
     * @param {String} string - данные на проверку
     * @return {boolean} - возращает true, если строка, и false наоборот
     */
    static isString(string) {
        return typeof string === 'string';
    }

    /**
     * Узнает index элемента в родительской элемент
     * Аналог jquery.index()
     * @param {Node} element - искомый элемент
     * @return {number} - порядковый номер (индекс) в родительском элементе
     */
    static getElementIndex(element) {
        return Array.from(element.parentNode.children).indexOf(element);
    }

    /**
     * Проверяет, поддерживает ли устройство touch-события
     * @return {boolean} - возращает true, если Touch-устройство, и false наоборот
     */
    static isTouch() {
        return Boolean(typeof window !== 'undefined' &&
            ('ontouchstart' in window ||
                (window.DocumentTouch &&
                    typeof document !== 'undefined' &&
                    document instanceof window.DocumentTouch))) ||
            Boolean(typeof navigator !== 'undefined' && (navigator.maxTouchPoints || navigator.msMaxTouchPoints));
    }

    /**
     * Узнает находится ли элемент во вьюпорте
     * @param {Node} element - искомый элемент
     * @param {Number} offset - дополнительный отступ
     * @return {boolean} - возращает true, если элемент виден на экране, и false наоборот
     */
    static isInViewport(element, offset = 0) {
        const rect = element.getBoundingClientRect();
        const top = rect.top + offset;
        const left = rect.left + offset;
        const windowHeight = window.innerHeight || document.documentElement.clientHeight;
        const windowWidth = window.innerWidth || document.documentElement.clientWidth;
        const belowViewport = 0;

        const verticalInView = (top <= windowHeight) && ((top + rect.height) >= belowViewport);
        const horizontalInView = (left <= windowWidth) && ((left + rect.width) >= belowViewport);

        return verticalInView && horizontalInView;
    }

    /**
     * Фиксирует страницу для запрета прокрутки
     * @param {Node} element - кроме данного элемента у всех остальных сбросится скролл
     */
    static bodyFixed(element) {
        disableBodyScroll(element, {reserveScrollBarGap: true});
    }

    /**
     * Снимаем фиксирование страницы
     */
    static bodyStatic() {
        clearAllBodyScrollLocks();
    }

    /**
     * Метод конвертирует строку (можно с разрядами) в число
     * @param {string} str - необходимая строка.
     * @return {number} - сковертированное число.
     */
    static convertToNumber(str) {
        return parseFloat(str
            .toString()
            .replace(/\s/g, ''));
    }

    /**
     * Убирает все пробелы из строки
     * @param {string} str - необходимая строка.
     * @return {string} - преобразованная строка.
     */
    static replaceSpace(str) {
        return str.replace(/\s/g, '');
    }

    /**
     * Конвертирует число или строку в строку с рарядами.
     * @param {string/number} value - число или строка.
     * @return {string} - преобразованная строка.
     */
    static convertToDigit(value) {
        return Number(value).toLocaleString('ru-Ru');
    }

    /**
     * Конвертирует целое число в дробное
     * @param {string/number} value - число или строка.
     * @param {number} denominator - целый делитель.
     * @return {number} - преобразованная строка.
     */
    static convertToRank(value, denominator) {
        const result = Number(value);

        return result / denominator;
    }

    /**
     * Генерация псевдослучайных чисел в заданном  числовом интервале
     * @param {Number} min - минимальное псевдослучайное число
     * @param {Number} max - максимальное псевдослучайное число
     * @return {Number} - возращает псевдослучайное число в интервале [min, max]
     */
    static random(min, max) {
        return Math.floor((Math.random() * (max - min)) + min);
    }

    /**
     * Конвертирует строку в camel-сase
     * @param {string} string - необходимая строка
     * @return {string} - результат
     */
    static toCamelCase(string) {
        // eslint-disable-next-line no-useless-escape
        const dashRegEx = /\-([a-z])/ig;

        return string.replace(dashRegEx, (m, letter) => {
            return letter.toUpperCase();
        });
    }

    /**
     * Возваращает дата-атрибуты из всего массива атрибутов элемента
     * Стандартный dataset не работает для svg элементов в IE.
     * @param {object} element - дом элемент
     * @return {return} - объект с дата-атрибутами
     */

    static getDataSet(element) {
        const attributes = Array.from(element.attributes);
        // eslint-disable-next-line no-useless-escape
        const dataRegEx = /^data\-(.+)/;
        const dataset = {};
        const first = 1;

        attributes.forEach((item) => {
            const match = item.name.match(dataRegEx);

            if (match) {
                dataset[this.toCamelCase(match[first])] = item.value;
            }
        });

        return dataset;
    }

    /**
     * Выбирает окончание слова.
     * @param {number} n - количество
     * @param {array} words - масcив слов. Например показать еще ['квартиру', 'квартиры', 'квартир']
     * @return {string} - слово в правильном склонении.
     */
    static pluralWord(n, words) {
        /* eslint-disable  */
        const $i = n % 10 === 1 && n % 100 !== 11 ? 0 : n % 10 >= 2 && n % 10 <= 4 && (n % 100 < 10 || n % 100 >= 20) ? 1 : 2;
        /* eslint-enable*/

        return words[$i];
    }

    /**
     * Устанавиливает гет-параметры
     * @param {array} params - массив объектов (ключ/значение) для установки в гет
     */
    static setUrlParams(params) {
        const query = new URLSearchParams();

        params.forEach((item) => {
            query.append(item.param, item.value);
        });

        window.history.pushState(null, null, `?${query.toString()}`);
    }

    /**
     * Получает значение гет-параметра
     * @param {string} param - ключ для поиска в гет
     * @return {string} value - значение гет
     */
    static getUrlParams(param) {
        const get = window.location.search;
        const url = new URLSearchParams(get);

        return url.get(param);
    }

    /**
     * Возвращает булевое значение если текущий размер находится в интервале переданных брейкопинтов.
     * Например при 380 и переданных значениях (320 670) вернет true, во всех остальных случаях false.
     * @param {Number} min - минимальное значение ширины. Будет тру если больше или равно.
     * @param {Number} max - максимальное значение ширины. Будет тру если меньше.
     * @return {boolean} булевое значение если попадает в переданный интервал
     */
    static isBreakpoint(min, max) {
        return window.innerWidth >= min && window.innerWidth < max;
    }

    /**
     * Проверяет является ли текущий браузер IE
     * @return {boolean} true - является
     */
    static isIE() {
        const ua = window.navigator.userAgent;
        const msie = ua.indexOf('MSIE');

        // eslint-disable-next-line
        return msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./);
    }
}

export default Utils;
