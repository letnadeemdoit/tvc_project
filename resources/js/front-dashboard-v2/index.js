import { Dropzone } from "dropzone";
window.Dropzone =  Dropzone;

import HSCore from "./hs.core";
window.HSCore = HSCore;

import HSScrollspy from "./hs.scrollspy";
window.HSScrollspy = HSScrollspy;

import HSStickyBlock from "./hs.sticky-block";
window.HSStickyBlock = HSStickyBlock;

require('./hs.dropzone');
import HSBsDropdown from './hs.bs-dropdown'

// INITIALIZATION OF BOOTSTRAP DROPDOWN
// =======================================================
HSBsDropdown.init()
window.HSBsDropdown = HSBsDropdown;


