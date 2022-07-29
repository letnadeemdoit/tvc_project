import { Dropzone } from "dropzone";
window.Dropzone =  Dropzone;
import HSCore from "./hs.core";
window.HSCore = HSCore;

require('./hs.dropzone');
import HSBsDropdown from './hs.bs-dropdown'

// INITIALIZATION OF BOOTSTRAP DROPDOWN
// =======================================================
HSBsDropdown.init()
window.HSBsDropdown = HSBsDropdown;


