import './bootstrap';
import {TINYMCE_DEFAULT_CONFIG} from "./constants";
import Alpine from 'alpinejs';

// Tinymce
import tinymce from "tinymce";
tinymce.baseURL = '/js/vendor/tinymce/';
window.tinymce = tinymce;
window.TINYMCE_DEFAULT_CONFIG = TINYMCE_DEFAULT_CONFIG;

window.Alpine = Alpine;

Alpine.start();
