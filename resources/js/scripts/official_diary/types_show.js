
function checkType(type){
    if (type === 'file') {
        $("#div_file").show();
        $("#div_acts").hide();
    } else {
        $("#div_file").hide();
        $("#div_acts").show();
    }
}
