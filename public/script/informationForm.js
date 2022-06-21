$(function(){
    initInformationForm();
});

function initInformationForm()
{
    initInformationFormTinyMCE();

    initInformationFormEvents();
}

function initInformationFormEvents()
{

}

function initInformationFormTinyMCE()
{
    tinymce.init({
        selector: '#information_content'
    });
}