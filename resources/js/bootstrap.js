import _ from 'lodash';
window._ = _;


try {
    window.jQuery = window.$ = require('jquery');
    window.bootstrap = require('bootstrap');
    window.select2 = require('select2');

    // Front Dashboard Js
    require('./front-dashboard-v2');

    require('jquery-ui/ui/widgets/datepicker.js');
    require('jquery-ui/ui/widgets/slider.js');
    require('jquery-ui/ui/widgets/button.js');
    require('jquery-ui/ui/widgets/selectable.js');
    require('jquery-ui/ui/widgets/selectmenu.js');
    require('jquery-ui/ui/widgets/controlgroup.js');
    require('jquery-ui/ui/widgets/dialog.js');
    // require('jquery-ui-timepicker-addon/src/jquery-ui-sliderAccess.js');
    require('jquery-ui-timepicker-addon');
} catch (e) {
    if (process.env.MIX_ENV === 'development') {
        console.log('Bootstrap, Jquery, Popper, Try -> Catch: ');
        console.log(e);
    }
}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
