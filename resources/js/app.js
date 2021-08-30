require('./bootstrap');

import Alpine from 'alpinejs';
import Swal from 'sweetalert2';
var Turbolinks = require("turbolinks")

global.$ = global.jQuery = require('jquery');

Turbolinks.start()

window.Alpine = Alpine;

Alpine.start();

window.Swal = Swal;



