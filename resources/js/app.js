require('./bootstrap');
import Form from './components/form';

const forms = Array.from(document.querySelectorAll('.j-form'));

if (forms.length) {
    forms.forEach((item) => {
        const form = new Form();

        form.init({target: item});
    });
}
