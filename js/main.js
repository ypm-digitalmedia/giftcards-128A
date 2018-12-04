$(document).ready(function() {


    $("button").addClass("btn btn-peabody");
    $("a[role=button]").addClass("btn btn-peabody");

    previewBarcodes();


    $(".cont").on("change", function() {
        previewBarcodes();
    });






});

function previewBarcodes() {
    var txt = "";

    var a = parseInt($("#input_starting").val());
    var b = $("#input_prefix").val();
    var c = parseInt($("#input_digits").val());
    var d = parseInt($("#input_count").val());

    var from = a;
    var to = a + d - 1;

    from = from.pad(c, 0);
    to = to.pad(c, 0);

    txt = b + from + " - " + b + to;

    $("#thePreview").html(txt);
}

Number.prototype.pad = function(size, char) {
    if (!char || typeof(char) == "undefined" || char == "") { char = "0"; }
    var s = String(this);
    while (s.length < (size || 2)) { s = char + s; }
    return s;
}