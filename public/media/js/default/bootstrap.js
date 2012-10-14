$(document).ready(function ()
{
    // Links werden im neuen Fenster geöffnet
    $('a:not([href^="/"]):not([href^="mailto:"])').attr('target', '_blank');

    // Textfeld wird größer bei Benutzung
    $("textarea").focus(function () {
        $(this).addClass("used");
    });

    // initialize scrollable
    $(".scrollable").scrollable({circular: 1});
});
