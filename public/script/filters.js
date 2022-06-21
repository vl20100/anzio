$(function(){
    initFilters();
});

function initFilters()
{
    $("#filterIngredient").select2();

    initFiltersEvents();
}

function initFiltersEvents()
{
    $(".filterLink").off("click", onClick_filterLink).on("click", onClick_filterLink);

    $("#chk_vegan, #selectContaining, #filterIngredient").off("change", applyFilters).on("change", applyFilters);
}

function onClick_filterLink(event)
{
    var $source = $(event.currentTarget);

    if($source.text() === "+ Filtrer")
    {
        $(".filters").css("display", "flex");
        $source.text("- Filtrer");
    }
    else
    {
        $(".filters").css("display", "none");
        $source.text("+ Filtrer");
    }
}

function applyFilters()
{
    $(".pizza").removeClass("hidden");

    checkVegan();

    checkContent();
}

function checkVegan()
{
    if($("#chk_vegan:checked").length === 1)
    {
        $(".pizza:not(.vegan)").addClass("hidden");
    }
}

function checkContent()
{
    var $ingredients = $('#filterIngredient').find(':selected');

    var contains = $("#selectContaining").val() === "yes";

    // Contenant
        // Fromage ET tomate
    // Ne contenant pas
        // Fromage NI tomate (OU)

    var cssStr = "";

    $ingredients.each(function(index, item)
    {
        if(contains)
        {
            cssStr += "[data-" + $(item).data("name") + "='1']";
        }
        else
        {
            if(cssStr !== "")
                cssStr += ", ";
            cssStr += ".pizza[data-" + $(item).data("name") + "='1']";
        }
    });
    
    if(cssStr !== "")
    {
        if(contains)
        {
            $(".pizza:not(" + cssStr + ")").addClass("hidden");
        }
        else
        {
            $(cssStr).addClass("hidden");
        }
    }
}