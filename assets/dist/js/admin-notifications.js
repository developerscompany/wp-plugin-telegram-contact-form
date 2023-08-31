/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./assets/src/js/admin-notifications.js ***!
  \**********************************************/
document.addEventListener('DOMContentLoaded', function () {
  // alert('notifications');
});
jQuery(document).ready(function ($) {
  var selectGlobalForm = $('.select-global-form select');
  selectGlobalForm.on('focus', function (e) {
    $(this).parent().addClass('active');
  });
  selectGlobalForm.on('blur', function (e) {
    $(this).parent().removeClass('active');
  });
});
/******/ })()
;
//# sourceMappingURL=admin-notifications.js.map