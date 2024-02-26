injectElementWithStyles = function(rule) {

    // http://www.thecssninja.com/javascript/noscope

    var style, div = document.createElement('div');

    style = ['&shy;','<style>',rule,'</style>'].join('');
    div.id = "temp-styles";
    div.innerHTML += style;
    $("html").append(div);
}

$(function() {

    var $el;

    $("#equation, #kind, #el").bind("change keyup blur focus", function() {

        $("#temp-styles").remove();

        var el = $("#el option:selected").val();
        var kind = $("#kind option:selected").val();
        var equation = $("#equation").val();

        if (kind == ':nth-child') {
          injectElementWithStyles("#list " + el + ":nth-child(" + equation + ") { background: #E18728; color: black; box-shadow: 0 0 5px black; }");
        }
        if (kind == ':nth-of-type') {
          injectElementWithStyles("#list " + el + ":nth-of-type(" + equation + ") { background: #E18728; color: black; box-shadow: 0 0 5px black; }");
        }
        if (kind == ':nth-last-child') {
          injectElementWithStyles("#list " + el + ":nth-last-child(" + equation + ") { background: #E18728; color: black; box-shadow: 0 0 5px black; }");
        }
        if (kind == ':nth-last-of-type') {
          injectElementWithStyles("#list " + el + ":nth-last-of-type(" + equation + ") { background: #E18728; color: black; box-shadow: 0 0 5px black; }");
        }


    });

    $("#equation").focus();

    $("#rec-1").on("click", function() {
        $("#el").val("li");
        $("#kind").val(":nth-child");
        $("#equation").val("3");

        $("#el").trigger("change");
    });

    $("#rec-2").on("click", function() {
        $("#el").val("li");
        $("#kind").val(":nth-child");
        $("#equation").val("-n+4");

        $("#el").trigger("change");
    });

    $("#rec-3").on("click", function() {
        $("#el").val("li");
        $("#kind").val(":nth-last-child");
        $("#equation").val("2");

        $("#el").trigger("change");
    });

    $("#rec-4").on("click", function() {
        $("#el").val("div");
        $("#kind").val(":nth-of-type");
        $("#equation").val("1");

        $("#el").trigger("change");
    });

    $("#rec-5").on("click", function() {
        $("#el").val("div");
        $("#kind").val(":nth-last-of-type");
        $("#equation").val("1");

        $("#el").trigger("change");
    });

    $("#rec-6").on("click", function() {
        $("#el").val("li");
        $("#kind").val(":nth-of-type");
        $("#equation").val("odd");

        $("#el").trigger("change");
    });

    $("#rec-7").on("click", function() {
        $("#el").val("li");
        $("#kind").val(":nth-of-type");
        $("#equation").val("5n+1");

        $("#el").trigger("change");
    });

    $("#rec-8").on("click", function() {
        $("#el").val("li");
        $("#kind").val(":nth-child");
        $("#equation").val("3n+2");

        $("#el").trigger("change");
    });

    $("#rec-9").on("click", function() {
        $("#el").val("li");
        $("#kind").val(":nth-child");
        $("#equation").val("n+7");

        $("#el").trigger("change");
    });

});