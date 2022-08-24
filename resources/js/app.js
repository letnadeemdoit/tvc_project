import './bootstrap';
import {TINYMCE_DEFAULT_CONFIG} from "./constants";
import Alpine from 'alpinejs';

// Tinymce
import tinymce from "tinymce";

tinymce.baseURL = '/js/vendor/tinymce/';
window.tinymce = tinymce;
window.TINYMCE_DEFAULT_CONFIG = TINYMCE_DEFAULT_CONFIG;

//Snackbar
window.toastr = require('toastr');
window.jSuites = require('jsuites');

import {Loader} from 'google-maps';
window.googleMaps = new Loader(process.env.MIX_GOOGLE_MAPS_API_KEY, {libraries: ['places']});

window.Cropper = require('cropperjs');
window.Lightbox2 = require('lightbox2');

import * as Calendar from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import interactionPlugin from '@fullcalendar/interaction';
import bootstrap5Plugin from '@fullcalendar/bootstrap5';

window.FullCalendar = Calendar;
window.dayGridPlugin = dayGridPlugin;
window.timeGridPlugin = timeGridPlugin;
window.listPlugin = listPlugin;
window.interactionPlugin = interactionPlugin;
window.bootstrap5Plugin = bootstrap5Plugin;

window.livewire.on('toastr', function (data) {
    let toastr = window.toastr;
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "5000",
        "timeOut": "5000",
        "extendedTimeOut": "5000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    switch (data.status) {
        case 'success':
            toastr.success(data.text);
            break;
        case 'error':
            toastr.error(data.text);
            break;
        case 'warning':
            toastr.warning(data.text);
            break;
        case 'info':
            toastr.info(data.text);
            break;
    }

});

window.livewire.hook('message.sent', (message, component) => {
    let event = message.updateQueue[0].payload.event;
    if (event && (
        event === 'destroyed-successfully' ||
        event.includes('cu-successfully') ||
        event.includes('Modal') ||
        event.includes('destroyable-confirmation-modal')
    )) {
        window.jSuites.loading.show();
    }
});

window.livewire.hook('message.processed', (message, component) => {
    let event = message.updateQueue[0].payload.event;
    if (event && (
        event === 'destroyed-successfully' ||
        event.includes('cu-successfully') ||
        event.includes('Modal') ||
        event.includes('destroyable-confirmation-modal')
    )) {
        window.jSuites.loading.hide();
    }
});

window.Alpine = Alpine;

Alpine.start();
