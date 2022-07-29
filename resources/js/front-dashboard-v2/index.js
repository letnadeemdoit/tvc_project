import { Dropzone } from "dropzone";
window.Dropzone =  Dropzone;
window.HSCore = require('./hs.core');
require('./hs.dropzone');
import HSBsDropdown from './hs.bs-dropdown'

// INITIALIZATION OF BOOTSTRAP DROPDOWN
// =======================================================
HSBsDropdown.init()
window.HSBsDropdown = HSBsDropdown;


